;(function(root){
	"use strict";
	var version = (function(v){
		var str = v;
		for(var i = 0; i < 6 - v.toString().length; i+=1) str += ' ';
		return str;
	})(root.engineVersion?root.engineVersion:'Beta');
	root.log = function(data, title, style){
		if(typeof data === 'string' && !style){
			style = title || 'color;#00a09d';title = data;console.log('%c'+title, style);
		}else if(style && title && data)console.log('%c'+title, style, data);
		else if(typeof data === 'string' && !title && !style)console.log('%c'+data,'color:#00a09d');
		else console.log(data);
	}
	root.url = window.top.location.protocol + '//'+document.domain+root.dir;
	root.appUrl = root.url + root.name;
	if(typeof root.storage === 'function')root.storage = root.storage();
	root.log([
		'\t','\t',
		'____     __  ________',
		'\\   |   / / /   ___  \\',
		' |  |  / /  |  |   |_|   ______   _______    ______',
		' |  | / /   |  |____    /  __  \\  |  __  \\  /  __  \\',
		' |  |/ /    \\______  \\  |  | | |  |  | | |  |  | | |',
		' |    /      __    | |  |  | | |  |  | | |  |  | | |',
		' |   /      |  |___| |  |  |_| |  |  | | |  |  |_| |',
		' |__/       \\________/  \\______/  |__| |_|  \\____  |',
		'                                             _   | |',
		'       VSong.TV  Engine Version ' + version + '      | |__| |',
		'  *--------------------------------------*  \\______/',
		'\t\t\t  西安微熊科技有限公司','\t','\t'
	].join('\n'),'color:#00a09d;');

	root.ready = function(callback){
		var body = document.body;
		var timer = parseInt(body.getAttribute('loading'));
		if(window.self != window.top){
			body.style.background = 'none';
			var slt = '#background,footer,.fullscreen';
			if(root.page != 'summary')slt+=',header';
			else slt+=',header .warp.justify';
			$(slt).css('display','none');
			$('#interface').css('top','0');
		}

		body.setAttribute('stats','loading');
		root.timeout(0.6, null, function(){
			document.body.setAttribute('stats','ready');
			if(callback){
				callback.call(document.body);
				callback = null;
			}
		});
	}
	
	if(!root.self.THREE)root.self.THREE = {};
	if(typeof Detector === 'object' && !Detector.webgl){
		var obj = {};
		if(root.self.WebGLRenderingContext){
			obj.code = 1;
			obj.msg = '您的浏览器不支持.';
		}else{
			obj.code = 2;
			obj.msg = '您的显卡不支持.';
		}
		root.error && root.error(obj, root.self.THREE);
		delete root.self.THREE;
		return;
	}
	
	//初始化
	root.init && root.init.call(root,root.self.THREE);
	delete root.self.THREE;
	if(root.useWorker){
		//尝试连接服务器
		try{
			// 发起 Worker 请求，可用他来处理
			var worker = new Worker(root.dir + root.name + '/'+(root.workerMod || root.mod)+'/worker/'+root.ecode+'-'+root.version);
			// 监听成功事件
			worker.addEventListener('message', function(e){
				// 传值给 root 对象
				root.user = e.data.user;
				root.online && root.online.call(root, e.data);
				worker.terminate();// 结束执行
			});
			// 监听失败事件
			worker.addEventListener('error', function(e){
				// 离线操作
				root.offline && root.offline.call(root, e);
			});
		}catch(e){
			// 离线操作
			root.offline && root.offline.call(root, e);
		}
	}else{
		root.online && root.online.call(root, root.user);
	}
	root.self.addEventListener('contextmenu',function(e){
		e.preventDefault();
		if(root.contextmenu)root.contextmenu(e);
		return false;
	});
})(VSong);
VSong = undefined;
