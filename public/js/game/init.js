;(function(root){
	var game;
	var backUrl = root.backUrl;
	var vloaders = root.load;
	root.errorGoBack = function(msg,url){
		root.alert(msg,3,function(){
			vloaders(url || backUrl);
		});
	}
	
	if(typeof Detector === 'object' && !Detector.webgl){
		var obj = {};
		if(root.self.WebGLRenderingContext){
			obj.code = 1;
			obj.msg = '您的浏览器不支持.';
		}else{
			obj.code = 2;
			obj.msg = '您的显卡不支持.';
		}
		return root.errorGoBack(obj.msg);
		//root.error && root.error(obj, THREE);
		delete window.THREE;
		return;
	}
	if(!(window.AudioContext || window.webkitAudioContext))return root.errorGoBack('您的浏览器不支持H5音频');
	function debugBuuttons(url){
		var button = document.createElement( 'a' );
		button.className = 'fxd b l btn';
		button.id = 'game-edit';
		button.href = root.url + '_/editor/#file=http://'+document.domain+ url.replace('app.pak','app.json');
		button.target = '_blank';
		button.textContent = '编辑场景';
		document.body.appendChild( button );
	}
	function gameExit(msg){
		root.alert(msg, 2, function(){
			if(game){
				game.stop();
				game = null;
			}
			root.load(root.backUrl);
			THREE = root = undefined;
		});
	}
	function decodeMTL(text){
		var mtl = new THREE.MTLLoader().parse(text).getAsArray();
		console.log(mtl);
		return [];
	}
	function geometryData(data, map){
		var mesh, isAnim = data.geometry.animations && data.geometry.animations.length>0;
		if (!data.materials)data.materials = [ new THREE.MeshLambertMaterial({color:12105912})];
		data.materials.forEach(function(mtl,i){
			if(map)mtl.map = map;
			if(isAnim)mtl.skinning = true;
		});
		if (isAnim) {
			mesh = new THREE.SkinnedMesh(data.geometry, data.materials, false);
			/*
			var mixer = new THREE.AnimationMixer(mesh);
			mixer.clipAction(mesh.geometry.animations[0], mesh).setDuration(data.userData && data.userData.speed?data.userData.speed:0.5).startAt(Math.random()).play();
			game.mixers.push(mixer);
			*/
		} else {
			mesh = new THREE.Mesh(data.geometry, data.materials);
		}
		//mesh.castShadow = true;
		//mesh.receiveShadow = true;
		data = null;
		return mesh;	
	}
	function setMonster(index, data, map){
		var mesh;
		if(data && data.metadata && data.metadata.type){
			if(data.metadata.type === 'Object'){
				var loads = new THREE.ObjectLoader();
				mesh = loads.parse(data);
			}else if(data.metadata.type === "Geometry"){
				var loads = new THREE.JSONLoader();
				mesh = geometryData(loads.parse(data),map);	
			}
			//if(data.userData)root.merge(mesh.userData || {}, data.userData);
		}else{
			var mtl = new THREE.SpriteMaterial();
			if(RESOURCE_OTHERS && RESOURCE_OTHERS.bubble){
				var textureLoader = new THREE.TextureLoader();
				mtl.map = textureLoader.load(RESOURCE_OTHERS.bubble);
			}else{
				mtl.color = index == 7?new THREE.Color(1,0.5,0.3):new THREE.Color(1,1,1);
			}
			mesh = new THREE.Sprite(mtl);
			mesh.isBubble = true;
		}
		//
		if(game.config.keys[index] && game.config.keys[index][3])root.merge(mesh.userData,game.config.keys[index][3]);
		
		//
		mesh.rotation.y = game.config.rotateY;
		mesh.position.z = game.config.startZ;	
		mesh.position.x = game.config.startX;
		mesh.position.y = game.config.altitude + game.config.space * index;
		if(mesh.userData.altitude)mesh.position.y += mesh.userData.altitude;
		mesh.scale.set(game.config.scale,game.config.scale,game.config.scale);
		if(index >= 7)mesh.position.y -= game.config.space;
		mesh.name = game.config.keys[index];
		mesh.userData.index = index;
		game.objects[index] = mesh;
	}
	
	//解包完成
	function unpackComplete(){
		if(!game)return gameExit('游戏初始化失败');
		if(!game.AppData.scene)return gameExit('资源包为空');
		game.AppData.project.shadow = false;
		game.AppData.scene.images.forEach(function(obj){
			var key = obj.url.split('?')[0];
			if(game.files[key]){
				obj.url = game.files[key];
			}else if(obj.url.indexOf('data:image/')!==0){
				obj.url = root.pathinfo(game.sceneUrl).dirname+'/'+obj.url;
			}
		});
		//装载怪物
		if(typeof game.config.keys !== 'object' || game.config.keys.length < 9)return gameExit('配置文件错误（config.keys 不完整）');
		game.config.keys.forEach(function(obj, index){
			if(!obj||obj.length==0)return setMonster(index);
			var geo,map;
			obj.forEach(function(name, i){
				if(game.files[name]){
					if(i == 0)geo = game.files[name];//模型
					else if(i == 1)map = game.files[name];//贴图
					else if(i == 2)geo.materials = game.files[name];
				}
			});
			setMonster(index,geo,map);
		});
		//装载数据
		game.load(onCompleted);
	}

	//初始化
	function onCompleted(renderer,scene,camera){
		var group = new THREE.Group();
		group.name = 'monsters';
		scene.add(group);
		game.setSize( window.innerWidth, window.innerHeight );
		root.ready(function(){this.classList.add('game')});
		var worker = new Worker(game.dataUrl);
		worker.addEventListener('message',function(e){
			if(e.data.type === 'success'){
				game.monsters = scene.getObjectByName('monsters');
				game.ready(e.data.data);
				document.body.appendChild( game.ui.dom );
				if(game.debug === true )debugBuuttons(game.sceneUrl);
				root = undefined;
			}else gameExit(e.data.msg);
		});
	}
	
	//初始化游戏
	root.initGame = function(url,options){
		game = new root.game(root,options);
		game.objects = [];
		game.files = null;
		game.AppData = {};
		game.sceneUrl = url;
		game.dataUrl = root.url+'game/resource/worker/music-'+options.scene+'-'+options.id;
		game.debug = options.debug;
		//Debug版
		if(game.debug === true){
			var sceneDir = root.dir+'data/scene/'+options.scene+'/';
			game.sceneUrl = sceneDir+'app.json?t='+root.time();
			var loaders = new THREE.FileLoader();
			loaders.load(game.sceneUrl,function(txt){
				game.AppData = JSON.parse(txt);
				game.AppData.scene.images.forEach(function(obj){obj.url = sceneDir + obj.url;});
				var objects = {};
				var progress = {max:9,value:0};
				var change = function(){
					progress.value ++;
					if(progress.value == progress.max)game.load(onCompleted);
				}
				var setData = function(){
					game.config.keys.forEach(function(arr,index){
						if(!arr){
							change();
							setMonster(index);
							return;
						}
						var map;
						if(arr[1]){
							var tload = new THREE.TextureLoader();
							map = tload.load(sceneDir+arr[1]);
						}
						if(!objects[arr[0]]){
							new THREE.FileLoader().load(sceneDir + arr[0]+'?t='+root.time(),function(data){
								objects[arr[0]] = JSON.parse(data);
								setMonster(index, objects[arr[0]], map);
							});
						}else setMonster(index, objects[arr[0]], map);
						change();
					});
				}
				root.request({
					url:sceneDir+'config.json?t='+root.time(),
					dataType:'json',
					success:function(conf){
						root.merge(game.config, conf);
						setData();
					},
					error:setData
				});
			});
			return;
		}
		//发布版
		root.unpack(game.sceneUrl, game.loading, function(list){
			var progress = {max:0,value:0};
			var change = function(value){
				if(value)progress.value ++;
				if(progress.value == progress.max)unpackComplete();
			}
			var tips = root.dom('#loading-tips',document.body);
			list.forEach(function(file, index){
				if(file.text){
					if(!game.files)game.files = {};
					if(file.name === 'app.json'){
						root.merge(game.AppData, JSON.parse(file.text));
						tips.text('场景数据装载完毕');
					}else if(file.name === 'config.json'){
						root.merge(game.config, JSON.parse(file.text));
						tips.text('配置信息加载完毕');
					}else if(file.name.lastIndexOf('.mtl') === file.name.length - 4){
						game.files[file.name] =decodeMTL(file.text);
					}else{
						progress.max += 1;
						tips.text('正在读取文件...（'+progress.value+'/'+progress.max+'）');
						root.blobToDataUrl(file.reader.data,function(data){
							
							if(file.name.lastIndexOf('.json') === file.name.length - 5){
								//加载模型
								tips.text('正在解压模型...（'+progress.value+'/'+progress.max+'）');
								var loads = new THREE.FileLoader();
								loads.load(data, function(txt){
									game.files[file.name] = JSON.parse(txt);
									change(1);
									tips.text('模型解压完成（'+progress.value+'/'+progress.max+'）');
								},null,function(){
									change(1);
									tips.text('模型解压失败');
								});
							}else if(file.name.lastIndexOf('.png') === file.name.length - 4 && file.name.indexOf('image-')!==0){
								//加载贴图
								tips.text('正在解压贴图...（'+progress.value+'/'+progress.max+'）');
								var loads = new THREE.TextureLoader();
								game.files[file.name] = loads.load(data);
								change(1);
								tips.text('贴图解压完成（'+progress.value+'/'+progress.max+'）');
							}else{
								tips.text('正在解压文件...（'+progress.value+'/'+progress.max+'）');
								game.files[file.name] = data;
								change(1);
								tips.text('文件完成（'+progress.value+'/'+progress.max+'）');
							}
						});
					}
				}
			});
		},null,function(e){
			gameExit('无法获取资源包');
		});
	}
	if(root.self){
		root.self.addEventListener('contextmenu',function(e){
			e.preventDefault();
			return false;
		});
	}
	//全屏
	var fullscreenchange = function(e){
		document.body.setAttribute('screen',e.target.getAttribute('screen'));
		//console.log(e);
	}
	fullscreenchange({target:window.top.document.body});
	var pre = root.browser.pre.replace(/-/g,'');
	root.self.document.addEventListener("fullscreenchange", fullscreenchange);
	root.self.document.addEventListener(pre+"fullscreenchange", fullscreenchange);
})(VSong);