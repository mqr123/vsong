
VSong.init = function(w3d){
	var _this = this;
	var style1 = 'color:#fff;font-size:12px;padding:5px 10px;border-radius:30px;background:#00a09d;';
	/*+------ 本地数据库操作 --------------+*/
	// 创建 WebSQl 连接
	var db = new this.WebSQL({
		pre:this.cookieConfig?this.cookieConfig.pre:'vs_',
		database:'VSong',
		size:100
	});

	/*
	//执行语句
	//db.query("DROP TABLE IF EXISTS table");
	//删除表
	db.drop('test',function(){
		_this.log('数据表删除成功');
	},function(){
		_this.log('数据表删除失败');
	});
	*/
	var container = document.getElementById('container');

	var width, height;
	var scene = new w3d.Scene();
	var camera = new w3d.PerspectiveCamera( 75, width / height, 0.1, 1000 );
	var renderer = new w3d.WebGLRenderer();
	var stats = new w3d.Stats();
	container.appendChild( renderer.domElement );
	$('#tools').DOM[0].appendChild(stats.domElement);
	var geometry = new w3d.BoxGeometry( 1,1,1);
	var material = new w3d.MeshPhongMaterial( { color: 0xffaa88 } );
	var cube = new w3d.Mesh( geometry, material );
	var light = new w3d.AmbientLight(0x555555,0.5);
	var light2 = new w3d.PointLight(0xaa00ff,1);
	light2.position.y = 20;
	cube.rotation.x = -2;
	scene.add( cube,light, light2 );
	
	camera.position.z = 5;
	
	function render(){
		var timer = Date.now() * 0.003;
		stats.begin();
		cube.rotation.y -= 0.2;
		cube.position.x = Math.sin(timer) * 2;
		cube.position.y = Math.cos(timer) * 2;
		renderer.render(scene, camera);
		stats.end();
	};
	function resize(){
		width = container.offsetWidth;
		height = container.offsetHeight;
		camera.aspect = width / height;
		camera.updateProjectionMatrix();
		renderer.setSize( width, height );
	}

	resize();
	_this.animation(render);
	_this.self.addEventListener('resize',resize);

	//查询数据表是否存在
	db.exists('test',function(){
		// 数据表已存在
		_this.log('正在查询 '+db.table('test')+' 表 ...','color:#aaa');
		db.fetch('test',"`username`='vsong'",function(e,result){
			_this.log(result, '数据查询成功','color:rgba(200,100,0,.8);');
			for(var i=0;i<result.rows.length;i+=1){
				var regdate = _this.date('Y年m月d日 H点i分s秒', result.rows[i]['dateline']);
				_this.log('用户信息 ' + result.rows[i]['username']+'，注册于 '+ regdate,'color:#00a09d');
			}
			
		},function(e){
			_this.log(e, '数据查询失败','color:red');
		});
	},function(){
		// 数据表不存在
		db.create('test',{
			uid			: "INTEGER PRIMARY KEY AUTOINCREMENT",
			username	: "varchar(40) NOT NULL DEFAULT ''",
			gender		: "tinyint(1) NOT NULL DEFAULT '0'",
			dateline	: "int(10) NOT NULL DEFAULT '0'"
		},function(){
			_this.log('数据表创建成功，正在写入数据','color:gray');
			var data = {username:'vsong',gender:1,dateline:_this.time()};
			db.insert('test',data, function(e, obj){
				_this.log(obj.insertId, '数据写入成功, insertId:', 'color:green');
			},function(e){
				_this.log(e,'数据写入失败','color:red');
			});
		},function(e){
			_this.log(e,'数据表创建失败','color:red');
		});

	});
	
		
	function complete(){
		_this.ready();
	}
	
	// 创建场景
	console.log('\n\n');
	_this.log([this, w3d], '加载完毕',style1);
	console.log('\n\n');
	
	// 当网络可用时，自动联网模式
	_this.online = function(data){
		console.log('\n\n');
		_this.log(data, '在线模式',style1);
		console.log('\n\n');
		complete.call(this);
	}
	
	// 断网可使用离线模式
	_this.offline = function(e){
		console.log('\n\n');
		_this.log(e, '离线模式',style1+'color:red;');
		console.log('\n\n');
		complete.call(this);
	}
	
	//控制器
	_this.controls({
		//
		before:function(){_this.log('正在查找 MIDI 设备 ...','color:#aaa')},
		//
		success:function(){
			console.log('\n\n');
			_this.log('已连接 '+this.size+' 台 MIDI 设备','padding:10px 20px;border-radius:20px;background:#00a09d;color:#fff');
			console.log('\n\n');
		},
		//连接并得到设备
		change:function(port){_this.log('MIDI设备已就绪 《' + port.name + '》','color:#00a09d')},
		//按下或打击MIDI设备按键
		on:function(e){
			console.log('\n');
			_this.log('K = ' + e.keyCode + ', I = ' + e.intensity + ', T = ' + e.timeStamp.toFixed(3), style1);
		},
		//松开MIDI设备按键
		off:null,
		//
		error:function(){_this.log('浏览器不支持MIDI设备','color:red')}
	});
	
}

/*+--------------------------------
 * 不支持 WebGL 渲染
 * 可以通过 e.code 获得原因：
 *		1 为浏览器不支持
 *		2 为显卡不支持
 * 通过 e.msg 得到错误提示信息
 *
 * 如果是浏览器不支持，提示用户下载客户端或Chrome浏览器
 * 如果是显卡不支持，则使用CSS3渲染，或直接使用标签向用户展示内容
 *+-------------------------------*/
VSong.error = function(e, w3d){
	
	_this.log(e, 'Error','color:red');
}
