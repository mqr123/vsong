VSong.loginOptions = function(root){
	return {
		auto:true,
		dataType:'json',
		//验证表单
		check:function(data){
			var form = this,err = null;
			if(data.account.length<3){
				err = '帐号不能小于 3 个字符';
			}else if(root.isNumeric(data.account)){
				if(data.account.length < 5){
					err = 'UID必须大于 5 位数';
				}else if(data.account.length == 11 && !root.isMobile(data.account)){
					err = '手机号码有误';
				}
			}else if(!root.isUsername(data.account)){
				err = '帐号可以是UID、用户名或手机号';
			}
			if(err){
				root.alert(err,2,function(){$('input[name="account"]',form).focus()});
				return;
			}
			if(data.password.length<6){
				root.alert('密码不能小于 6 个字符',2,function(){$('input[name="password"]',form).focus()});
				return;
			}
			return data;
		},
		success:function(obj){
			var goto = function(){
				root.resetUserData(obj.data);
				if(root.loginBackUrl)return root.load(root.loginBackUrl);
				root.load();
				goto = null;
			}
			root.alert(obj.msg || '登陆成功','happy',1,function(){
				if(obj.url)root.self.location = obj.url;
				else if(typeof box === 'object')box.close(goto);
				else goto();
			});
		},
		error:function(e){
			console.log(e);
			root.alert(e.msg || '未知错误','sad',2,e.field?function(){
				var dom  =$('input[name="'+e.field+'"]').DOM[0];
				$('input[name="'+e.field+'"]').select().focus();
			}:null);
		}
	}
}
VSong.loginBox = function(root){
	var box;
	var loginBox = function(){
		var loginForm = function(){
			$('#vBox-login').form(root.loginOptions(root));
		}
		box = new root.box({
			type:'confirm',title:'用户登录',buttonText:'立即登录',
			//close:function(){},
			confirm:loginForm,
			content:'<form id="vBox-login" action="'+root.appUrl+'/common/login/'+root.ecode+'"><div class="box-login">'+
			'<div class="items">'+
			'	<label>'+
			'	  <span class="justify">帐号</span>'+
			'	  <input type="text" name="account" maxlength="20" autocomplete="off" placeholder="手机、用户名、UID" />'+
			'	</label>'+
			'</div>'+
			'<div class="items pwd">'+
			'	<span class="flt-r min500">'+
			'	  <a class="btn openyoureye"><i class="icon eye" size="22"></i></a>'+
			'	</span>'+
			'	<label>'+
			'	  <span class="justify">密码</span>'+
			'	  <input type="password" name="password" oninput="document.getElementById(\'box-login-lookpwd\').value=this.value" maxlength="32" placeholder="请输入密码" />'+
			'	  <input type="text" id="box-login-lookpwd" maxlength="32" placeholder="请输入密码" />'+
			'	</label>'+
			'</div>'+
			'<div class="items clr">'+
			'	<label>'+
			'	  <span class="justify">　</span>'+
			'	  <div class="justify">'+
			'		<a class="btn pjax" href="'+root.appUrl+'/common/register">没有账号&raquo;</a>'+
			'		<a class="btn pjax" href="'+root.appUrl+'/common/forget">找回密码&raquo;</a>'+
			'	  </div>'+
			'	</label>'+
			'</div>'+
			'</div></form>'
		});
		$('#vBox-login').on('keyup',function(e){
			if(e.keyCode == 13){
				for(var i=0;i<this.length;i+=1){
					if(this[i].type!='hidden' && this[i].name){
						if(this[i].value == ''){
							this[i].focus();
							return;
						}
					}
				}
				loginForm();
			}
		});
	}
	/*登录框*/
	root.body.on('click','a.login',function(e){
		if(root.user.uid>0)return;
		loginBox();
	});
	//显示或隐藏密码域
	root.body.on('mousedown','.items.pwd .openyoureye',function(){
		root.body.addClass('eye-look');
	});	
}