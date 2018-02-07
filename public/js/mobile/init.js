
VSong.getUrlParams = function(url){
	url = url || document.URL;
	return url.split('//'+document.domain+'/')[1].split('/');
}

VSong.tools = {
	getUserGroup:function(id){
		if(id < 0)return '违规用户';
		if(id >=0 && id <100)return '普通用户';
		if(id >=100 && id < 150)return '版主';
		if(id >=150 && id < 200)return '超级版主';
		if(id >=200 && id < 250)return '管理员';
		if(id >=250 && id <= 255)return '创始人';
		
	},
	getUserType:function(id){
		switch(id){
			case 1:id = '机构';break;
			case 2:id = '内部';break;
			case 3:id = '教师';break;
			case 4:id = '家长';break;
			default:id = '学员';break;
		}
		return id;
	},
	getUserGender:function(id, size){
		if(size)return '<i class="icon icon-gender" gender="'+id+'" size="'+icon+'"></i>';
		switch(id){
			case 1:id = '男';break;
			case 2:id = '女';break;
			default:id = '保密';break;
		}
		return id;
	}
}

VSong.init = function(){
	var root = this;
	root.body = $(document.body);
	//视所有IE版本为非W3C标准浏览器
	if(root.self.navigator.userAgent.indexOf('Trident')!=-1)$('html').removeClass('w3c');
	/*全屏*/
	root.fscn = root.fullScreen(document.body);
	root.urls = root.getUrlParams();
	$('.fullscreen').click(root.fscn.toggle);
	root.alwaysFullscreen = function(){
		var screen = document.body.getAttribute('screen');
		if(screen != 'full' || root.self.screen.height != root.self.innerHeight)root.fscn.toggle();
	}
	//警告框
	root.alert = function(msg,smile,timeout,callback){
		if(typeof smile === 'number'){
			if(timeout)callback = timeout;
			timeout = smile;
			smile = 'warn';
		}
		var box = new root.box({type:'alert',smile:smile||'warn',content:'<div type="tips">'+msg+'</div>',auto:1,timeout:timeout || null,close:function(){
			callback && callback();
			box =  null;
		}});
	};
	//退出事件
		root.body.click('.logout', function() {
			var box = new root.box({
				type: 'confirm',
				auto: 1,
				smile: 'warn',
				buttonText: '立即退出',
				content: '确定要退出当前帐号吗？',
				confirm: function() {
					root.self.location = root.dir;
				}
			});
		});
	//Pjax
	var pjax = new root.pjax({
		selector:'.pjax',
		alwaysToSelf:true,
		container:'#container',
		titleSuffix: ' - VSong.TV',
		start:function(){
			document.body.classList.remove('ready');
			root.boxClear && root.boxClear();
		},
		complete:function(){

			root.modules.__construct(root);
		},
		selection:function(e){
		}
	});
	root.resetUserData = function(user){
		var html = ['',''];
		if(typeof user === 'object')root.merge(root.user,user);
		if(root.user.uid <= 0 || user === null){
			if(!user){
				root.cookie('author','',{expire:-1e5});
				root.user = {uid:0,username:'',gender:0,type:0,group:0,level:0,exp:0,score:0,number:0};
			}
		}else{
			
		}
	}
	root.load = function(url,options){pjax.reload(url,options)}
	//在线
	root.online = function(data){
		root.isOnline = true;
		root.resetUserData(data.user);
	}
	//离线
	root.offline = function(data){
		root.isOnline = false;
		root.merge(root.user,{
			level:0,
			socre:0,
			number:0,
			exp:0
		});
		root.resetUserData();
	}
	
	//初始化模块
	root.modules.__construct(root);
	
	$(root.self).on('dragstart',function(e){
		e.preventDefault();
		return false;
	}).on('mouseup',function(){
		//root.alwaysFullscreen();
		document.body.classList.remove('eye-look');
	});
	root.ready();
	document.body.classList.add('ready');
};
