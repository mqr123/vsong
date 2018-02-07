//
window.dir = VSong.dir;
VSong.getUrlParams = function(url){
	url = url || document.URL;
	return url.split('//'+document.domain+window.dir)[1].split('/');
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
	var root = this,
	showUsermenu = function(root){
		var isEnter = false;
		$('header>.usermenu').on('mouseenter',function(e){
			if(isEnter || root.user.uid <= 0)return;
			isEnter = 1;
			root.body.addClass('usermenu-open');
			this.onmouseleave = function(){
				this.onmouseleave = null;
				if(!isEnter)return;
				root.timeout(.5,function(){
					if(!isEnter)this.stop();
				},function(){
					if(!isEnter)return;
					root.body.removeClass('usermenu-open');
					isEnter = null;
				});
			}
		});
		root.body.click('.logout',function(){
			var box =new root.box({
				type:'confirm',auto:1,smile:'warn',buttonText:'立即退出',content:'确定要退出当前帐号吗？',
				confirm:function(){
					box.close(function(){
						root.resetUserData(null);
						root.self.location = root.appUrl;
					});
				}
			});
		});
		
		$('#member-menu').on('mouseenter',function(){
			isEnter = null;
			this.onmouseleave = function(){
				root.body.removeClass('usermenu-open');
				this.onmouseleave = null;
			}
		});
	};
	root.browser._pre = root.browser.pre.replace(/-/g,'');
	root.body = $(document.body);
	//视所有IE版本为非W3C标准浏览器
	if(root.self.navigator.userAgent.indexOf('Trident')!=-1)$('html').removeClass('w3c');
	root.urls = root.getUrlParams();
	/*全屏*/
	root.fscn = new root.fullScreen(document.body);
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
	//Pjax
	var pjax = new root.pjax({
		selector:'.pjax',
		alwaysToSelf:true,
		container:'#container',
		titleSuffix: ' - VSong.TV',
		start:function(){
			root.body.removeClass('ready game');
			root.boxClear && root.boxClear();
		},
		complete:function(){
			var urls = root.getUrlParams();
			var crrentUrl = document.URL.split('://'+document.domain)[1];
			var target = $('header>.nav>a.btn[href^="'+crrentUrl+'"]');
			$('header>.nav>a.btn.open').removeClass('open');
			if(target && urls[2]){
				target.addClass('open');
			}else{
				$('header>.nav.comm>a.btn:first-child').addClass('open');
			}
			root.mod = urls[1] || 'home';
			root.page = urls[2] || 'index';
			root.urls = urls;
			root.ready();
			root.body.addClass('ready').attr({mod:root.mod,page:root.page});
			root.modules.__construct(root,pjax);
		},
		selection:function(e){
			if(this.classList.contains('login-submit')){
				var formid = this.getAttribute('formid');
				if(!formid)return;
				$('#'+formid).form(root.loginOptions(root));
				return true;
			}
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
			html[1] = '<a class="btn login"><span>登录</span></a> <a class="btn pjax" href="'+root.appUrl+'/common/register"><span>注册</span></a>';
		}else{
			var score = root.user.score>0 && root.user.number>0?root.user.score / root.user.number:0;
			html[0] += '<div class="userinfo"><p class="ts">'+root.user.username+'</p><p><span title="UID"></span>'+root.user.uid+'</p></div>';
			html[0] += '<div class="userdata">'+
				'<p>'+
					'<span class="ilb" title="等级">'+root.user.level+'</span> '+
					'<span class="ilb" title="类型"><a class="ilb">'+root.tools.getUserType(root.user.type)+'</a></span>'+
				'</p>'+
				'<p>'+
					'<span class="ilb" title="得分">'+score.toFixed(2)+'</span> '+
					'<span class="ilb" title="权限"><a class="ilb">'+root.tools.getUserGroup(root.user.group)+'</a></span>'+
				'</p>'+
				'<p>'+
					'<span class="ilb" title="经验">'+root.user.exp+'</span> '+
					'<span class="ilb" title="倍数">'+root.user.multiple+'</span>'+
				'</p>'+
				'<p><span class="ilb" title="注册时间"></span> <span class="il">'+root.date('Y/m/d',root.user.dateline)+'</span></p>'+
			'</div>';
			html[0] += '<div class="usermenu justify">'+
				'<a class="btn ts memberurl" onclick="window.open(\''+root.url+'member/manage/study\')"><i class="icon"></i>个人中心</a> '+
				'<a id="backTo" class="btn ts pjax homepage"><i class="icon"></i>返回列表</a> '+
				'<a class="btn ts logout"><i class="icon"></i>退出</a>'+
			'</div>';
			html[1] = '<a class="avatar"><img src="'+root.dir + 'avatar/small/'+root.user.uid+'" /></a>';
		}
		$('#member-menu').html(html[0]);
		$('header>.usermenu').html(html[1]);
		html.splice(0,2);html = null;
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
	
	showUsermenu(root);
	//登录框
	root.loginBox(root);
	
	//初始化模块
	root.modules.__construct(root,pjax);
	
	$(root.self).on('dragstart',function(e){
		e.preventDefault();
		return false;
	}).on('mouseup',function(){
		//root.alwaysFullscreen();
		document.body.classList.remove('eye-look');
	}).on('keydown',function(e){
		if([8,112,113,114,115,116,117,118,119,120,121,122,123].indexOf(e.keyCode) !=-1){
			if(e.keyCode == 8 && root.isEditorDom(e.target))return e.returnValue;
			e.preventDefault();
			if(e.keyCode == 122)root.fscn.toggle();
			return false;
		}
	});
	root.ready();
	document.body.classList.add('ready');

	window.oncontextmenu = function(){return false}
};
