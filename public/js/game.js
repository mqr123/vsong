
VSong.game = function (root,options){
	var loader = new THREE.ObjectLoader();
	var game = this, camera, scene, renderer;
	var defaultMonsters = new THREE.Group();
	var tips = root.dom('#loading-tips');
	var events = {};
	var $rhythm = 0;
	var $attack = 0;
	var $intensity = 0;
	this.root = root;
	this.config = {
		scale		: 1,
		rotateY		: -Math.PI/2,		
		startX		: 15,		//开始位置
		startZ		: 6.5,		//开始位置
		delay		: 0,		//音频延迟
		altitude	: 1,		//场景海拔高度
		space		: 0.84,		//怪物Y间距
		speed		: 0.14,		//速度
		attack		: -3.7,		//攻击位置
		range		: 0.5,
		keys		: [null,null,null,null,null,null,null,null,null]
	};
	this.userData = {
		uid:root.user.uid,
		username:root.user.username,
		level:root.user.level,
		life:{value:100,max:100},
		exp:{value:0,max:100},
		score:0,
		group:0,
		rhythm:0,
		intensity:0
	};
	this.progress={value:0,max:100};
	this.music = {
		title:'Unknow',
		singer:'Unknow',
		author:'Unknow',
		tempo:120,
	};
	this.stats = 'loading';
	this.width = 500;
	this.height = 500;
	this.events = {};
	//this.mixers = [];
	this.playing = false;
	if(typeof root.storage === 'function'){
		root.storage = new root.storage();
	}
	this.noSleep = new NoSleep();
	/******** UI Start *********/	
	if(!('registerElement' in document))return;
	root.toNumber = function(value){
		if(typeof value === 'null')return 0;
		return /[\d]/.test(value)?parseFloat(value):value;
	}
	game.uiTools = {
		play:null,
		fullscreen:null,
		setting:null
	}
	var UISPACE = {};
	var uiOptions = {
		tools:{
			create:function(){
				this.className = 'fxd';
				for(var k in game.uiTools){
					game.uiTools[k] = this.append(k);
					game.uiTools[k].className = 'btn';
				}
				game.uiTools.fullscreen.addEventListener('click',function(){
					root.fscn.toggle();
				});
				game.uiTools.play.addEventListener('click',function(){
					game.toggle();
				});
				game.uiTools.setting.addEventListener('click',function(){
					root.alert('暂未开放',2);
				});
			}
		},
		progress:{
			change:function(key,o,v){
				if(!game.ui || key != 'value')return;
				v = root.toNumber(v);
				this.children[0].value = v;
				if(v >= game.progress.max){
					return game.win();
				}
				game.progress.value = v;
			},
			create:function(){
				var dom = document.createElement('progress');
				dom.value = game.progress.value;
				dom.max = game.progress.max;
				this.className = 'fxd';
				this.append(dom);
			}
		}
	};
	function element(name,opts,pre){
		if(!name)return;
		if(!opts)opts = {};
		var parents = (opts.parents || document.body);
		var proto = Object.create(HTMLElement.prototype);
		proto.createdCallback = opts.create || null;//元素创建后调用
		proto.attachedCallback = opts.init || null;//元素附加到文档后调用
		proto.detachedCallback = opts.remove || null;//从文档中移除元素后调用
		proto.attributeChangedCallback = opts.change || null;//元素任一属性变更后调用,参数(name, orginValue, currentValue)
		proto.content = function(txt,nn){
			if(typeof txt === 'undefined')return root.toNumber(this.textContent || 0);
			var org = root.toNumber(this.textContent);
			this.textContent = nn?txt:root.toNumber(txt);
			opts.change && opts.change.call(this,'text', org, this.textContent);
			return this;
		};
		proto.remove = function(){
			this.parentNode.removeChild(this);
		};
		proto.append = function(key,option){
			if(key instanceof HTMLElement || key instanceof HTMLProgressElement){
				this.appendChild(key);
				return this;
			}
			option = option || {};
			option.parents = this;
			return element(key,option);
		};
		proto.setNumber = function(num){
			var org = this.getNumber();
			num = num.toString();
			for(var value = '', i = 0;i<num.length;i+=1)value += '<i n="'+num[i]+'"></i>';
			opts.change && opts.change.call(this,'number', org, num);
			this.innerHTML = value;
			return this;
		}
		proto.getNumber = function(){
			var n = this.querySelectorAll('i[n]');
			for(var value = '',i = 0; i< n.length; i += 1){
				value += i.n;
			}
			return value!=''?parseFloat(value):0;
		}
		proto.attr = function(key,value){
			if(!key)return this;
			if(typeof key === 'object'){
				for(var k in key)this.setAttribute(k,key[k]);
				return this;
			}
			if(typeof value === 'undefined'){
				value = this.getAttribute(key);
				return root.toNumber(value);
			}
			this.setAttribute(key,value);
			return this;
		};
		var tagName = (pre || 'ui-')+name;
		if(!UISPACE[tagName])UISPACE[tagName] = document.registerElement(tagName,{prototype:proto});
		var dom = new UISPACE[tagName]();
		parents.appendChild(dom);
		return dom;
	}
	function UIElement(callback){
		this.dom = element('ui',null,'vsong-');
		callback.call(this);
		return this;
	}
	UIElement.prototype.get = function(name,callback){
		var dom = this.dom.querySelectorAll('ui-'+name);
		if(!callback)return dom[0];
		if(dom[0])callback.call(dom[0]);
		return this;
	}
	UIElement.prototype.theme = function(name){
		this.dom.setAttribute('skin',name || 'default');
		return this;
	}
	UIElement.prototype.add = function(name,opts){
		opts.parents = this.dom;
		element(name,opts);
		return this;
	}
	this.ui = (function(uis){
		var ui = new UIElement(function(){
			this.className = 'fxd';
			if(typeof uis === 'object')for(var k in uis)this.add(k,uis[k]);
		});
		ui.theme();
		return ui;
	})(uiOptions);
	//this.ui.theme('vsong');
	/****** UI End ***************/
	this.speed = 0.1;
	var prevTime;
	function dispatch( array, event ){
		for ( var i = 0, l = array.length; i < l; i ++ )array[ i ]( event );
	}
	function materialRepeat(m,x,y){
		m.wrapS = m.wrapT = m.map.wrapS = m.map.wrapT = THREE.RepeatWrapping;
		m.map.repeat.set(x||1,y||1);
	}
	function alwaysfullscreen(e){
		var screen = root.self.document.body.getAttribute('screen');
		if(screen!='full')root.fscn.toggle();
	}
	function noteOn(e){
		if(!game.isReady || e.intensity < 20)return;
		if(!game.playing && [51,53,56,59].indexOf(e.keyCode)!=-1)return root.load(root.backUrl);
		if(!game.playing && e.intensity >= 40){
			if(game.stats === 'ended'){
				if(e.keyCode == 40 || e.keyCode == 38){
					game.reset();
					game.play();
				}else if(e.keyCode == 35 || e.keyCode == 36){
					root.load(root.backUrl);
				}
			}
			else if(game.stats != 'paused')game.toggle();
		}
		if(e.type)alwaysfullscreen(e);
		e.index = note2index(e.keyCode);
		game.monsters.children.forEach(function(mesh){
			if(!mesh.userData.isDeath && mesh.userData.inAttack && mesh.userData.index == e.index){
				//计算节奏感
				if(mesh.userData.inAttack <= 0 && mesh.userData.inAttack >= -0.5){
					//Good
					$rhythm += 1;
				}
				//计算力度
				var inIntent = e.intensity / mesh.userData.intensity;
				if(inIntent < 1.4 && inIntent > 0.8){
					//Good
					$intensity += 1;
				}
				if(mesh.mixer)delete mesh.mixer;
				mesh.userData.isDeath = mesh.position.y;
			}
		});
		dispatch( events.attack, arguments );
		//e.note = e.keyCode;game.addMonster(e);
		//console.log(e);
	}

	function note2index(note,index){
		if(index)return index;
		switch(note){
			case 49:
			case 52:
			case 55:
			case 57:index = 8;break;
			case 46:index = 7;break;
			case 42:
			case 44:index = 6;break;
			case 51:
			case 53:
			case 56:
			case 59:index = 5;break;
			case 48:index = 4;break;
			case 47:index = 3;break;
			case 37:
			case 38:
			case 39:
			case 40:index = 2;break;
			case 45:
			case 43:
			case 41:index = 1;break;
			case 35:
			case 36:index = 0;break;
			default:index = 0;break;
		}
		return index;
	}
	/*
	var debugDom = document.createElement('div');
	debugDom.className = 'fxd debug';
	root.dom(document.body).prepend(debugDom);
	*/
	game.renderDelay = 0;
	var delayArray = [];
	var delayTime = 0;
	var delayIndex = 0;
	var delayMax = 60;
	function animate( time ){
		delayTime = Date.now();
		if(!game.isFocus)game.focus();
		//game.mixers.forEach(function(mixer){mixer.update(0.01)});
		try {dispatch( events.update, { time: prevTime, delta: time - prevTime} );}
		catch(e){console.error((e.message||e),(e.stack||""));}
		renderer.render( scene, camera );
		prevTime = time;
		
		if(!game.playing){
			if(game.holder){
				game.holder --;
				if(game.holder <= 0){
					game.holder = null;
					return;
				}
			}else return;
		}
		game.monsters.children.forEach(function(mesh,index){
			var life = mesh.userData.intensity / 100;
			if(mesh.userData.isDeath){
				if(!mesh.userData.attcked){
					mesh.userData.attcked = true;
					$attack += 1;
					scoreChange();
					/*
					debugDom.innerHTML = 
					'intensity: ' + $intensity + '<br>'+
					'rhythm: ' + $rhythm + '<br>'+
					'attack: ' + $attack + '<br>'+
					'Total: ' + MIDI.Player.data.length + '<br>'+
					'Monsters: ' + game.monsters.children.length;
					*/
					
				}
				if(!mesh.userData.mtl){	
					try{
						if(game.ui.life && game.ui.life.value < game.ui.life.max)game.ui.life.value += life/2;
					}catch(e){};
					mesh.userData.mtl = new THREE.MeshStandardMaterial({transparent:true,color:'#f30'});
					mesh.material = mesh.userData.mtl;
					mesh.castShadow = false;
				}
				mesh.position.x += game.speed;
				mesh.position.y -= 0.1;
				mesh.material.opacity -= 0.01;
				var s = mesh.scale.x * mesh.material.opacity;
				mesh.scale.set(s,s,s);
				if(mesh.material.opacity <= 0){
					game.monsters.remove(mesh);
				}
				return;
			}
			if(mesh.mixer)mesh.mixer.update(0.01);
			game.speed = game.config.speed * 60 / MIDI.Player.BPM;
			var now = mesh.userData.time - game.audio.currentTime;
			if(game.audio.playing && now>game.config.attack){
				mesh.position.x = (now - game.config.attack) * 5 + game.config.attack;
				//mesh.position.x = now * MIDI.Player.BPM + game.config.attack;
				//debugDom.innerHTML = now;
			}else{
				mesh.position.x -= game.speed;
			}
			//mesh.position.x = game.audio.currentTime - mesh.userData.time
			//debugDom.innerHTML = mesh.position.x + game.audio.currentTime - mesh.userData.time;
			
			var range = game.config.range;
			var overlast = mesh.position.x >= game.config.attack - range;
			var overfirst = mesh.position.x <= game.config.attack + range;
			if(overlast && overfirst){
				mesh.userData.inAttack = overlast?mesh.position.x - game.config.attack - range:game.config.attack + range - mesh.position.x;
				//自动攻击
				if(game.autoAttack && mesh.position.x <= game.config.attack)
					noteOn({keyCode:mesh.userData.note,intensity:mesh.userData.intensity,type:'message',timeStamp:Date.now()});
			}else if(!mesh.userData.counterattack && mesh.position.x < game.config.attack - range && mesh.userData.intensity){
				if(game.ui.life.value>0)game.ui.life.value -= mesh.userData.intensity / 100;
				else game.over();
				mesh.userData.inAttack = null;
				mesh.userData.counterattack = true;
			}
			if(mesh.position.x <= game.config.attack - 3){
				game.monsters.remove(mesh);
			}
		});
		
		/**** 延迟测试 *****/
		delayIndex += 1;
		delayArray[delayIndex] = Date.now() - delayTime;
		if(delayIndex > delayMax){
			delayIndex = 0;
			game.renderDelay = eval(delayArray.join('+')) / delayMax;
			//debugDom.innerHTML = '<p>延迟：'+(game.renderDelay).toFixed(3)+' 毫秒</p>';
		}
	}
	function scoreChange(){
		game.userData.score = Math.min($attack / MIDI.Player.data.length * 200,100).toFixed(2);
		game.ui.score.content(game.userData.score,true);
	}
	function addGameUI(){
		/***** ADD UI *****/
		//Information
		game.ui.add('information',{
			create:function(){
				var keys = {title:'标题',singer:'歌手',author:'上传',tempo:'速度'}
				for(var k in keys){
					var dom = this.append('info');
					dom.attr({title:keys[k],key:k});
					dom.textContent = game.music[k];
				}
				this.className = 'fxd';
			}
		});
		//Avatar
		game.ui.add('avatar',{
			create:function(){
				this.className = 'fxd btn';
				this.style.backgroundImage = 'url('+root.dir+'avatar/middle/'+game.userData.uid+')';
			}
		});
		//User
		game.ui.add('user',{
			create:function(){
				this.className = 'fxd';
				this.content(game.userData.username);
			}
		});
		//Level
		game.ui.add('level',{
			create:function(){
				this.className = 'fxd';
				this.content(game.userData.level);
			}
			//,change:function(){game.userData.level = this.content();}
		});
		//Score
		game.ui.add('score',{
			create:function(){
				this.className = 'fxd';
				this.content(game.userData.score);
				game.ui.score = this;
			}
		});
		//Life
		game.ui.add('life',{
			create:function(){
				var dom = document.createElement('progress');
				dom.value = game.userData.life.value;
				dom.max = game.userData.life.max;
				this.append(dom);
				game.ui.life = dom;
				//this.append('icon');
				this.className = 'fxd prg';
			}
		});
	}
	this.load = function (callback){
		renderer = new THREE.WebGLRenderer( {alpha:true, antialias: true } );
		renderer.setClearColor( 0x000000 );
		renderer.setPixelRatio( window.devicePixelRatio );
		var json = this.AppData;
		this.anisotropy = renderer.capabilities.getMaxAnisotropy();
		if ( json.project.gammaInput ) renderer.gammaInput = true;
		if ( json.project.gammaOutput ) renderer.gammaOutput = true;
		if ( json.project.shadows ){
			renderer.shadowMap.enabled = true;
			//renderer.shadowMap.type = THREE.PCFSoftShadowMap;
		}
		renderer.vr.enabled = json.project.vr;
		root.dom(game.ui.dom).prepend(renderer.domElement);

		
		this.setScene( loader.parse( json.scene ) );
		this.setCamera( loader.parse( json.camera ) );

		events = {
			init: [],
			ready: [],
			stop: [],
			keydown: [],
			keyup: [],
			mousedown: [],
			mouseup: [],
			mousemove: [],
			touchstart: [],
			touchend: [],
			touchmove: [],
			update: [],
			attack: []
		};

		var scriptWrapParams = 'game,renderer,scene,camera,root';
		var scriptWrapResultObj = {};
		for ( var eventKey in events ){

			scriptWrapParams += ',' + eventKey;
			scriptWrapResultObj[ eventKey ] = eventKey;

		}

		var scriptWrapResult = JSON.stringify( scriptWrapResultObj ).replace( /\"/g, '' );
		var setSource = function(source,argms){
			if(typeof source === 'function'){
				source = source.toString();
				var first = source.indexOf('{');
				var last = source.lastIndexOf('}');
				source = source.substr(first+1, last-first-1);
			}
			return source + '\nreturn ' + argms + ';' ;
		}
		for(var uuid in json.scripts ){
			var object = scene.getObjectByProperty( 'uuid', uuid, true );
			if ( object === undefined ){
				console.warn( 'Engine.game: Script without object.', uuid );
				continue;
			}
			var scripts = json.scripts[ uuid ];
			for ( var i = 0; i < scripts.length; i ++ ){
				var script = scripts[ i ];
				var functions = (
					new Function(scriptWrapParams,setSource(script.source,scriptWrapResult)).bind(object))(this, renderer, scene, camera);
					
				for ( var name in functions ){
					if ( functions[ name ] === undefined ) continue;
					if ( events[ name ] === undefined ){
						console.warn( 'Engine.game: Event type not supported (', name, ')' );
						continue;
					}
					events[ name ].push( functions[ name ].bind( object ) );
				}
			}
		}
		var midi = root.controls({self:window});
		midi.on = noteOn;
		dispatch( events.init, arguments );
		callback && callback.call(this,renderer,scene,camera);
	};
	
	this.repeat = function(material, x, y){
		if(typeof material === 'object'){
			if(material.type.indexOf('Material')!=-1)materialRepeat(material,x,y);
			else if(material.length)material.forEach(function(mtrl,index){materialRepeat(mtrl,x,y)});
		}
	}
	this.setCamera = function ( value ){

		camera = value;
		camera.aspect = this.width / this.height;
		camera.updateProjectionMatrix();

		if ( renderer.vr.enabled ){

			WEBVR.checkAvailability().catch( function( message ){
				game.ui.dom.appendChild( WEBVR.getMessageContainer( message ) );

			});

			WEBVR.getVRDisplay( function ( device ){
				renderer.vr.setDevice( device );
				game.ui.dom.appendChild( WEBVR.getButton( device, renderer.domElement ) );

			});

		}

	};
	
	this.setScene = function ( value ){scene = value;};
	this.setSize = function ( width, height ){
		this.width = width;
		this.height = height;
		if ( camera ){
			camera.aspect = this.width / this.height;
			camera.updateProjectionMatrix();
		}
		if ( renderer )renderer.setSize( width, height );
	};
/*
dLight.castShadow = true;
dLight.shadowCameraVisible = true;
dLight.shadowDarkness = 0.2;
dLight.shadowMapWidth = dLight.shadowMapHeight = 1000;
*/
	this.addMonster = function(e, name){
		var mesh;
		if(!name){
			mesh = this.objects[note2index(e.note)].clone();
			if(mesh.geometry && mesh.geometry.animations.length>0){
				mesh.mixer = new THREE.AnimationMixer(mesh);
				mesh.mixer.clipAction(mesh.geometry.animations[0], mesh).setDuration(mesh.userData.speed || 0.5).startAt(Math.random()).play();
			}
			var size = 0.1 + e.velocity / 128 * mesh.scale.x;
			if(mesh.userData.scaleAdd)size += mesh.userData.scaleAdd;
			mesh.scale.set(size, size, size);
		}else{
			mesh = this.objects[e].clone();
		}
		mesh.castShadow = mesh.userData.shadow?true:false;
		//mesh.position.x -= game.renderDelay / 10;
		if(e.note){
			mesh.userData.note = e.note;
			mesh.userData.time = e.now / 1000 - game.delay;
			//mesh.position.x = game.config.startX + (mesh.userData.time - game.audio.currentTime);
		}
		mesh.userData.intensity = e.velocity;
		this.monsters.add(mesh);
		return mesh;
	}
	//加载完毕
	this.audio = new Audio();
	this.ready = function (data){
		if(this.isReady)return;
		this.isReady = true;
		//装载数据
		['multiple','group','gender','uid','type'].forEach(function(k){data.user[k] = parseInt(data.user[k])});
		['dateline','id','level','uid'].forEach(function(k){data.music[k] = parseInt(data.music[k])});
		['price','delay'].forEach(function(k){data.music[k] = parseFloat(data.music[k])});
		game.distance = game.config.startX - game.config.attack;
		root.merge(this.music,data.music);
		root.merge(this.userData,data.user);
		var src = data.src?root.url+data.src+'?s='+root.time():data.sound;
		if(!src)return root.errorGoBack('无可用的音频资源');
		/*
		//怪物过场
		//defaultMonsters.position.z = -50;
		//defaultMonsters.position.y = -50;
		//defaultMonsters.scale.set(0.1,0.1,0.1);
		defaultMonsters.position.x = -game.config.startX;
		game.config.keys.forEach(function(key,index){
			var mesh = game.objects[index];
			mesh.castShadow	 = mesh.userData.shadow?true:false;
			defaultMonsters.add(mesh);
		});
		scene.add(defaultMonsters);
		*/
		
		game.delay = game.config.delay + 3.78;
		game.loading({type:'music',value:0,max:100,time:Date.now()});
		game.ui.progress = document.querySelectorAll('ui-progress>progress')[0];
		game.audio.src = src;
		game.audio.addEventListener('canplaythrough',function(){
			if(game.midiFile)return;
			game.midiFile = data.mid;
			MIDI.Player.loadFile(game.midiFile,function(){
				game.ui.progress.max = game.audio.duration;
				game.ui.get('information ').children[3].textContent = Math.floor(MIDI.Player.BPM) + ' 拍 / 分钟';
				tips.text('音乐已就绪');
				game.loading({type:'music',value:100,max:100,time:Date.now()});
			});
			
			delete data.mid;data = null;
		});
		game.audio.addEventListener('timeupdate',function(e){
			if(game.music.demo && this.currentTime > game.music.demo){
				game.demo();
			}
			game.ui.progress.value = game.audio.currentTime;
			if(this.duration - 0.1 <= this.currentTime){
				game.success = true;
			}
		});
		game.audio.addEventListener('playing',function(e){
			game.state('playing');
		});
		
		game.audio.addEventListener('play',function(e){
			var midiCurrent = MIDI.Player.currentTime / 1000 - game.delay;
			if(midiCurrent != game.audio.currentTime)game.audio.currentTime = midiCurrent;
			game.audio.volume = 1;
			game.audio.playing = true;
			console.log('audio.play');
		});
		game.audio.addEventListener('pause',function(e){
			MIDI.Player.once = false;
			game.audio.playing = false;
			game.audio.volume = 0;
			console.log('audio.paused');
		});
		game.audio.addEventListener('ended',function(e){
			game.audio.playing = false;
			game.stop();
		});
		game.audio.addEventListener('error',function(e){
			console.log('audio.error');
		});
		
		MIDI.Player.addListener(function(e){
			if(game.stats !== 'playing'){
				MIDI.Player.pause();
				return;
			}
			if(e.message == 144 && !MIDI.Player.once){
				//MIDI.Player.once = true;
				game.addMonster(e);
			}
		});
		game.reset();
		game.isReady = true;
		delete data.sound,data.user,data.music;
		addGameUI();//添加UI
	};
	var warp = root.dom(window.top.document.body);
	this.demo = function(){
		this.demoing = true;
		this.pause();
		var box = root.box({
			auto:1,type:'confirm',smile:'happy',
			title:'试玩结束',
			content:'《'+game.music.title+'》试玩 '+game.music.demo+' 秒已结束！<br>如果您喜欢这首曲谱，请购买！<br>价格：￥ '+game.music.price+' 元',
			buttonText:'立即购买',
			confirm:function(){
				root.dom(box.DOM.root).remove();
				game.demoing = false;
				delete game.music.demo;
				//game.play();
				root.alert('购买成功',2);
			}
		});
		root.dom(box.DOM.close).on('click',function(){
			root.load(root.backUrl);
		});
	}
	this.resize = function(){
		if(!this.isReady)return;
		var windows = root.self || window;
		if(!windows)return;
		var width = windows.innerWidth;
		var height = windows.innerHeight;
		camera.aspect = width / height;
		if(camera.aspect<1){
			var size = (height - width) / 2;
			warp.duration(0.3).css({width:height,height:width}).transform('rotate(90deg) translate('+size+'px,'+size+'px)');
			game.setSize(height,width);
		}else{
			warp.duration(0.3).css({width:width,height:height}).transform('rotate(0) translate(0,0)');
			game.setSize(width,height);
		}
		renderer.render(scene,camera);
	}
	this.reset = function(playing){
		game.firstStart = false;
		prevTime = performance.now();
		//for(var k in this.events)document.addEventListener(k,this.events[k]);
		dispatch( events.ready, arguments );
		renderer.animate(animate);
		MIDI.Player.stop();
		if(game.ui.life){
			root.merge(game.ui.life,game.userData.life);
			//game.ui.life.value = game.ui.life.max = game.userData.life.max;
		}
		$intensity = $rhythm = $attack = game.userData.score = game.audio.volume = 0;
		game.success = false;
		game.state('completed');
		game.resize();
	}
	
	this.play = function(){
		if(!this.isReady || this.demoing || game.holder || game.stats === 'over' || game.stats === 'ended')return;
		game.playing = true;
		if(!this.firstStart){
			this.firstStart = true;
	
			root.timeout(game.delay,function(){
				if(!game.playing){
					game.firstStart = false;
					game.stop();
					console.log('强制停止');
					this.stop();
				}
			},function(){
				game.audio.play();
			});
			MIDI.Player.resume();
		}else{
			game.audio.play();
		}
		game.state('playing');
		MIDI.Player.start();
		game.noSleep.enable();
		alwaysfullscreen();
		window.top.document.body.classList.add('game-playing');
	}
	this.pause = function(stats){
		if(stats !== 'over')game.audio.pause();
		if(stats === 'ended'){
			game.audio.currentTime = 0;
			MIDI.Player.stop();
		}else{
			MIDI.Player.pause();
		}
		game.playing = false;
		game.state(stats || 'paused');
		game.noSleep.disable();
		window.top.document.body.classList.remove('game-playing');
	}
	this.toggle = function(){
		if(!this.playing)this.play();
		else this.pause();
	}
	this.levelUp = function(){}
	this.over = function(){
		game.playing = false;
		game.pause('over');
		var anim = new root.animation(function(){
			if(game.monsters.children.length == 0){
				root.alert('<div class="tips"><h3>游戏结束</h3><div>挑战失败</div></div>', 2,function(){
					root.load(root.backUrl);
				});
				game.stop();
				anim.stop();
				return;
			}
			game.monsters.children.forEach(function(mesh){
				if(mesh.mixer){	
					if(mesh.rotation.y > 0.5)mesh.rotation.y -= 0.02;
					if(mesh.rotation.y < 0.3)mesh.rotation.y += 0.02;
					if(mesh.rotation.x > -0.5)mesh.rotation.x -= 0.02;
					if(mesh.position.y < 4)mesh.position.y += 0.01;
					if(mesh.position.y > 6)mesh.position.y -= 0.01;
					mesh.mixer.update(0.01);
					mesh.scale.x += 0.005;mesh.scale.y = mesh.scale.z = mesh.scale.x;
				}else{
					mesh.scale.x -= 0.003;mesh.scale.y = mesh.scale.z = mesh.scale.x;
				}
				mesh.position.x += 0.001;
				mesh.position.z += 0.02;
				if(mesh.position.z > 15){
					delete mesh.mixer;
					game.monsters.remove(mesh);
				}
			});
			if(game.audio.volume > 0.1)game.audio.volume -= 0.002;
			renderer.render( scene, camera );
		});
	}

	this.save = function(data){
		var form = new FormData();
		var saveOptions = {url:root.url+'game/form/saving',dataType:'json',data:form};
		if(options.debug){
			//saveOptions.success = function(json){console.log('success',json)};
			saveOptions.error = function(e){
				if(e.msg)root.alert(e.msg);
				console.log('error',e);
			};
		}
		if(typeof data === 'object')for(var k in data)form.append(k, data[k]);
		else{
			var overTime = Date.now() / 1000;
			form.append('mode', 2);
			form.append('formhash', options.formhash);
			form.append('speed', MIDI.Player.BPM);
			form.append('starttime', Math.floor(overTime - game.audio.duration));
			form.append('overtime', Math.floor(overTime));
			form.append('score', game.userData.score);
			form.append('intensity', Math.min($intensity / MIDI.Player.data.length * 200,100));
			form.append('accuracy', game.autoAttack?100:Math.min($rhythm / MIDI.Player.data.length * 200,100));
		}
		root.request(saveOptions,1);
	}
	this.stop = function (){
		game.pause('ended');
		//for(var k in game.events)document.removeEventListener(k,game.events[k]);
		if(!game.monsters)return;
		dispatch( events.stop, arguments );
		game.monsters.children.forEach(function(mesh){
			if(mesh.mixer)delete mesh.mixer;
			game.monsters.remove(mesh);
		});
		if(game.success){
			//game.userData.intensity = (game.userData.intensity + $intensity)/2;
			root.alert('<div class="tips "><h3>挑战成功！</h3>'+
			'得分：'+game.userData.score + '<br>'+
			'力度：'+$intensity+ '<br>'+
			'节奏：'+$rhythm+ '</div>'+
			'<br>本窗口消失后：打击军鼓再战一次；打击底鼓返回列表。', 5);
			//上传数据 ...
			this.save();
		}
		renderer.animate( null );
	};
	
	this.dispose = function (){
		while ( game.ui.dom.children.length ){game.ui.dom.removeChild( dom.firstChild )}
		renderer.dispose();
		camera = undefined;
		scene = undefined;
		renderer = undefined;
	};
	this.state = function(stats){
		this.stats = stats;
		document.body.setAttribute('stats',stats);
		switch(stats){
			case 'completed':document.body.classList.add('ready');break;
		}
	};
	this.loading = function(e){
		var prgsTip = document.getElementById('loading-tips');
		var prgsBar = document.getElementById('loading-progress');
		switch(e.type){
			case 'download':
				prgsTip.textContent = '正在下载资源包 ...';
				break;
			case 'unpack':
				prgsTip.textContent = '正在解压资源包 ...';
				break;
			case 'music':
				prgsTip.textContent = '正在获取音乐数据 ...';
				break;
		}
		prgsBar.max = e.max;
		prgsBar.value = e.value;
		//console.log(e.type,e);
	}
	this.focus = function(){
		window.focus();
	}
	window.addEventListener('focus',function(){
		game.isFocus = true;
	});
	window.addEventListener('blur',function(){
		if(game.playing)game.pause();
		game.isFocus = false;
	});
	window.addEventListener('keydown',function(e){
		if(game.stats == 'over')return;
		if(e.keyCode == 13){
			if(game.stats === 'ended')game.reset();
			else game.toggle();
		}
		if(e.keyCode === 118 && game.userData.group === 255 && game.userData.uid === 10000){
			
			game.autoAttack = game.autoAttack?false:true;
		}
	});
	//window.top.addEventListener('beforeunload',this.save);
	window.top.addEventListener('resize',function(){
		game.resize();
	});
	return this;
};
