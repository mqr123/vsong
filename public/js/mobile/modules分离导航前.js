VSong.modules = {
	__construct: function(root, pjax) {
		root.urls = root.getUrlParams();
		root.mod = root.urls[1] || 'home';
		root.page = root.urls[2] || 'index';
		var func = this[root.mod + '_' + root.page];
		if(typeof func === 'function') func(root, pjax);
		root.body.addClass('ready').attr({
			mod: root.mod,
			page: root.page
		});
		root.ready();
	},
	common_login: function(root) {
		//导航切换
		$('.formBox .tab_btn span').on('click', function() {
			$('.formBox .tab_btn span').removeClass('open')
			$(this).addClass('open')
			var isLogin = $(this).DOM[0].classList.contains('login_btn'),
				isRegist = $(this).DOM[0].classList.contains('regist_btn');
			if(isLogin) {
				$('.mobile_login').addClass('open')
			} else {
				$('.mobile_login').removeClass('open')
			}
			if(isRegist) {
				$('.mobile_regist').addClass('open')
			} else {
				$('.mobile_regist').removeClass('open')
			}
		});
		//用户名失去焦点判断
		$('.username').on('blur',function(){
			if($('.username').val()){
				var data = new FormData();
				data.append('username',JSON.stringify($('.username').val()));
				root.request({
					url:root.appUrl+'/home/verify/username',
					dataType:'json',
					data:data,
					success:function(data){
						$('.wranMsg').text('用户名已存在!').css('color','red');
						$('.username').focus();
					},
					error:function(data){
						$('.wranMsg').text('');
					}
				});
			}
			
		})
		//手机号失去焦点判断
		$('.phone').on('blur',function(){
			if($('.phone').val()){
				var data = new FormData();
				data.append('phone',JSON.stringify($('.phone').val()));
				root.request({
					url:root.appUrl+'/home/verify/phone',
					dataType:'json',
					data:data,
					success:function(data){
						$('.wranMsg').text('手机号已存在!').css('color','red');
						$('.phone').focus();
					},
					error:function(data){
						$('.wranMsg').text('');
					}
				});
			}
			
		})
		
		
		
		
		//找回密码页面
		$('a.forgetPage').on('click', function() {
			$('.mobile_login,.mobile_regist').removeClass('open')
			$('.mobile_forget').addClass('open')
			$('.formBox .tab_btn span').addClass('hide')
			$('.formBox .tab_btn .forget_btn').addClass('open')
		})
		//返回登录页面
		$('.backLogin').on('click',function(){
			$('.mobile_login').addClass('open');
			$('.login_btn').addClass('open');
			$('.login_btn').removeClass('hide');
			$('.regist_btn').removeClass('hide');
			$('.forget_btn ').removeClass('open');
			$('.forget_btn ').removeClass('hide');
			$('.mobile_forget').removeClass('open');
		})
		//显示或隐藏密码域
		var dom1 = $('.pwdBox .openyoureye').DOM[0];
		showPsw('touchstart',dom1,function(){
			root.body.addClass('eye-look');
		})
		var dom2 = $('.pwdBox .openyoureye').DOM[1];
		showPsw('touchstart',dom2,function(){
			root.body.addClass('eye-look');
		})
		var dom3 = $('.pwdBox .mobile-eye1').DOM[0];
		showPsw('touchstart',dom3,function(){
			root.body.addClass('eye-look1');
		})
		showPsw('touchend',dom3,function(){
			root.body.removeClass('eye-look1');
		})
		var dom4 = $('.pwdBox .mobile-eye2').DOM[0];
		showPsw('touchstart',dom4,function(){
			root.body.addClass('eye-look2');
		})
		showPsw('touchend',dom4,function(){
			root.body.removeClass('eye-look2');
		})
		//移动端事件
		function showPsw(type,obj,callback){
			obj.addEventListener(type,function(){
				callback();
			})
		}
		//登陆表单提交
		var loginForm = $('.mobile_login');
		$('.Login').on('touchstart', function() {
			loginForm.form({
				auto: true,
				dataType: 'json',
				check: function(data) {
					var err = null;
					if(data.account.length < 3) {
						err = '帐号不能小于 3 个字符';
					} else if(root.isNumeric(data.account)) {
						if(data.account.length < 5) {
							err = 'UID必须大于 5 位数';
						} else if(data.account.length == 11 && !root.isMobile(data.account)) {
							err = '手机号码有误';
						}
					} else if(!root.isUsername(data.account)) {
						err = '帐号可以是UID、用户名或手机号';
					}
					if(err) {
						root.alert(err,'warn',2)
						$('input[name="account"]').focus()
						return;
					}
					if(data.password.length < 6) {
						root.alert('密码不能小于 6 个字符','warn',2);
						$('input[name="account"]').focus()
						return;
					}
					$('.Login').addClass('open').text('正在登陆')
					return data;
				},
				success: function(json) {
					if(json.type == 'success'){
						root.resetUserData(json.data);
						root.load(root.dir+'mobile/home/index');
					}
				},
				error: function(json) {
					root.alert(json.msg);
					$('.Login').removeClass('open').text('重新登陆');
				}
			})
		});
		//注册表单提交
		var registForm = $('.mobile_regist');
		$('.Regist').on('touchstart', function() {
			registForm.form({
				auto: true,
				dataType: 'json',
				check: function(data) {
					if(data.gender){
						data.gender = $('.mobile-gender input[name="gender"]:checked').val();
					}
					if(data.username){
						if(!root.isUsername(data.username)){
							root.alert('昵称格式不正确，请重新输入！','warn',2);
							return;
						}
					}else{
						root.alert('昵称不能为空！','warn',2);
						return;
					}
					if(data.phone){
						if(!root.isMobile(data.phone)){
							root.alert('手机格式不正确，请重新输入！','warn',2);
							return;
						}
					}else{
						root.alert('手机号不能为空！','warn',2);
						return;
					}
//					if(data.smscode){
//						
//					}else{
//						alert('验证码不能为空！');
//						return;
//					}
					if(data.password.length < 6) {
						root.alert('密码不能小于 6 个字符','warn',2);
						return;
					}
					return data;
				},
				success: function(json) {
					if(json.type == 'success'){
						root.alert('注册成功，赶快去登录吧!','happy',2,function(){
							root.load();
						})
					}
				},
				error: function(json) {
					root.alert(json.msg);
					
				}
			})
		});
		
		//找回密码表单提交
		var mobile_forget = $('.mobile_forget');
		$('.Forget').on('touchstart',function(){
			mobile_forget.form({
				auto:true,
				dataType:'json',
				check:function(data){
					if(data.phone){
						if(!root.isMobile(data.phone)){
							root.alert('手机格式不正确，请重新输入！','warn',2);
							return;
						}
					}else{
						root.alert('手机号不能为空！','warn',2);
						return;
					}
					if(data.password){
						if(data.password.length<6){
							root.alert('密码不能小于6个字符！','warn',2);
							return;
						}
					}else{
						root.alert('密码不能为空！','warn',2);
						return;
					}
					if(data.pwd){
						if(data.pwd != data.password){
							root.alert('两次密码输入不一致！','warn',2);
							return;
						}
					}else{
						root.alert('请再次输入密码！','warn',2);
						return;
					}
					return data;
				},
				success:function(json){
					root.load(root.dir+'mobile/common/login');
				},
				error:function(json){
					root.alert(json.msg);
				}
			})
		});
	},
	home_index:function(root){
		//个人中心
		$('.myInfo').on('click',function(){
			var cookieVal = getCookie('vSong_author');
			if(cookieVal){
				window.location.href = root.dir + 'member/manage/study';
			}else{
				root.load(root.dir+'mobile/common/login');
			}
		})
		function getCookie(name)
		{
			var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
			if(arr=document.cookie.match(reg))
			return unescape(arr[2]);
			else
			return null;
		}
		
		//轮播图高度
		$('.scroll_show').addClass('open');
		var resetCover = function() {
			var width = window.innerWidth;
			var height = width * 0.49;
			if(root.page == 'index') $('#home-cover').DOM[0].style.height = height + 'px';
		}
		resetCover();
		window.addEventListener('resize', resetCover)
		//解决导航跳转轮播图会重新创建的bug
		var flag = true;
		$('nav>a.btn').click(function(){
			if(flag) playScroll.stop();
			flag = false;
		})
		/*
		 * 轮播图事件
		 */
		$('.scroll_page span').DOM[0].classList.add('open');
		$('.scroll_img div.imgs').DOM[0].classList.add('open');
		var playScroll = autoScroll(0);
		
		//pc端轮播图点击事件
		$('.scroll_ctrl>.warp>a.btn').click(function() {
			var obj = $(this);
			actionScroll(obj);
		})
		//移动端轮播图手势事件
		var touchObj = $('.scroll_img');
		var startX,action;
		touchObj.on('touchstart',function(e){
			var even = e||event;
			var target = even.targetTouches[0];
			startX = target.pageX;
			even.preventDefault();
		})
		touchObj.on('touchmove',function(e){
			var even = e||event;
			var target = even.targetTouches[0];
			endX = target.pageX;
			var x = endX-startX;
			if(x>0)action = 'left';
			if(x<0)action = 'right';
			even.preventDefault();
		})
		touchObj.on('touchend',function(){
			actionScroll('',action);
			action = '';
		})
		function autoScroll(index) {
			var count = $('.scroll_img>.imgs').DOM.length;
			var i = 0,
				s = 3;
			var anim = new root.animation(function(c) {
				i++;
				if(i > 60 * s) {
					i = 0;
					index += 1;
					if(index >= count) index = 0;
					if(root.page == 'index') $('.scroll_img>.imgs.open').removeClass('open');
					if(root.page == 'index') $('.scroll_img>.imgs').DOM[index].classList.add('open');
					if(root.page == 'index') $('.scroll_page>span.open').removeClass('open');
					if(root.page == 'index') $('.scroll_page>span').DOM[index].classList.add('open');
				}
			});
			return anim;
		}
		function actionScroll(obj,action){
			playScroll.stop();
			if(!action&&(root.browser.platfrom=="Windows"||root.browser.platfrom=="Mac"))var action = obj.data('action');
			var imgIndex = $('.scroll_img>.imgs.open').data('index');
			imgIndex = parseInt(imgIndex);
			var count = $('.scroll_img>.imgs').DOM.length;
			if(action == 'left') {
				imgIndex -= 1;
				if(imgIndex < 0) imgIndex = count - 1;
			}
			if(action == 'right') {
				imgIndex += 1;
				if(imgIndex >= count) imgIndex = 0;
			}
			$('.scroll_img>.imgs.open').removeClass('open');
			$('.scroll_img>.imgs').DOM[imgIndex].classList.add('open');
			$('.scroll_page>span.open').removeClass('open');
			$('.scroll_page>span').DOM[imgIndex].classList.add('open');
			playScroll = autoScroll(imgIndex);
		}
		
		
		
		// 导航点击事件
		$('.mobile_footer .dropBtn').on('touchstart',function(){
			var state = $(this).attr('state');
			if($(this).attr('state')=='0'){
				$(this).addClass('open');
				$(this).attr('state','1');
			}else{
				$(this).removeClass('open');	
				$(this).attr('state','0');
			}
		})
		$('.dropBtn .drop_down a').on('touchstart',function(){
			$('.mask_advice.open').removeClass('open');
			if(this.getAttribute('type')=='about'){
				document.documentElement.scrollTop  = $(".mobile-title").DOM[0].offsetTop;
				window.pageYOffset  = $(".mobile-title").DOM[0].offsetTop;
				document.body.scrollTop = $(".mobile-title").DOM[0].offsetTop;
			}else if(this.getAttribute('type')=='modul'){
				document.documentElement.scrollTop  = $(".three-model").DOM[0].offsetTop;
				window.pageYOffset  = $(".three-model").DOM[0].offsetTop;
				document.body.scrollTop  = $(".three-model").DOM[0].offsetTop;
			}else if(this.getAttribute('type')=='school'){
				document.documentElement.scrollTop  = $(".school-rank").DOM[0].offsetTop;
				window.pageYOffset  = $(".school-rank").DOM[0].offsetTop;
				document.body.scrollTop  = $(".school-rank").DOM[0].offsetTop;
			}else if(this.getAttribute('type')=='stu'){
				document.documentElement.scrollTop  = $(".student-show").DOM[0].offsetTop;
				window.pageYOffset  = $(".student-show").DOM[0].offsetTop;
				document.body.scrollTop  = $(".student-show").DOM[0].offsetTop;
			}else if(this.getAttribute('type')=='contact'){
				document.documentElement.scrollTop  = $(".contact-us").DOM[0].offsetTop;
				window.pageYOffset  = $(".contact-us").DOM[0].offsetTop;
				document.body.scrollTop  = $(".contact-us").DOM[0].offsetTop;
			}else if(this.getAttribute('type')=='advice'){
				if(root.user.uid==0){
					root.load(root.dir+'mobile/common/login');
					return;
				}
				$('.mask_advice').addClass('open');
			}
		});
		
		$('textarea').on('keyup',function(){
			var num = $('textarea').val().length;
			$('span.words').text(num+"/500字");
			if(num===500){
				$('span.words').css('color','red');
			}else{
				$('span.words').css('color','#9fb1b1');
			}
		})
		$('.fix_mask').on('touchstart',function(){
			$('.mask_advice.open').removeClass('open');
		})
		var adviceBox = $('#adviceBox');
		$('#adviceBtn').on('touchstart',function(){
			adviceBox.form({
				auto:true,
				dataType:'json',
				check:function(data){
					if(data.type){
						data.type = $('input[type=radio]:checked').val();
					}
					if(!data.connect){
						root.alert('请输入内容', 'warn');
						return;
					}
					if(!data.phone){
						root.alert('请填写联系方式','warn');
						return;
					}
					console.log(data);
					return data;
				},
				success:function(json){
					console.log(json);
					if(json.type == "success"){
						root.alert('数据提交成功',2,function(){							
							$('.mask_advice.open').removeClass('open');
						});
						
					}
				},
				error:function(json){
					console.log(json);
					if(json.type == "error"){
						root.alert('操作失败','sad',2);
					}
				}
			})
		})
		
		
		
		//三种模式切换
		$('.moduMask').on('touchstart',function(){
			$('.moduMask').removeClass('modu_mask');
			this.classList.add('modu_mask');
		})
	}

}