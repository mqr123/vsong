VSong.modules = {
	__construct:function(root,pjax){
		root.urls = root.getUrlParams();
		root.mod = root.urls[1] || 'home';
		root.page = root.urls[2] || 'index';
		//导航高亮 
		var crrentUrl = document.URL.split('://'+document.domain)[1];
		var target = $('header nav>a.btn[href^="'+(root.mod == 'manage'?'/member/manage/':crrentUrl)+'"]');
		$('header nav>a.btn.open').removeClass('open');
		if(target && root.urls[2]){
			target.addClass('open');
			if(root.mod == 'manage'){
				$('aside[type="manage"]>a.open').removeClass('open');
				target = $('aside[type="manage"]>a[href^="'+crrentUrl+'"]');
				target.addClass('open');
			}
		}else{
			$('header nav:last-child>a.btn:first-child').addClass('open');
		}
		//地址
		root.district(root, '.vs-district', root.dir + 'main/common/district/');
		var func = this[root.mod+'_'+root.page];
		if(typeof func === 'function')func(root,pjax);
		root.body.addClass('ready').attr({mod:root.mod,page:root.page});
		root.ready();
	},

	home_index:function(root){
		$('textarea').on('keyup',function(){
			var num = $('textarea').val().length;
			$('span.words').text(num+"/100字");
			if(num===100){
				$('span.words').css('color','red');
			}else{
				$('span.words').css('color','#9fb1b1');
			}
		})
		var joinBox = $('#joinBox');
		//上传文件图片
		$('input[type=file]').on('change',function(){
			var _this = this;
			var file = this.files[0];
			var reader = new FileReader();
			reader.readAsDataURL(file);
			reader.onload = function(){
				if(['image/png','image/jpeg','image/jpg','image/gif'].indexOf(file.type)==-1){
					root.alert('文件类型只允许：png、jpg、gif',2);
					return;
				}
				if(file.size > 2048*1024){
					root.alert('文件大小超出限制，最大允许 2 MB',2);
					return;
				}
				$('.up').css('backgroundImage','url('+this.result+')').css('backgroundSize','contain');
				joinBox.data('license',this.result);
			}
			reader.onerror = function(){
				root.alert('上传失败',2);
			}
			
		});
		//‘加盟’提交按钮
		$('#joinSubmit').click(function() {
			joinBox.form({
				auto: true,
				dataType: 'json',
				//验证表单
				check: function(data) {
					data.license = joinBox.data('license');
					var dist = $('#joinBox .vs-district').DOM[0].result();
					[null,'province','city','county','town'].
					forEach(function(key,index){
							if(index==0)return;
							data[key] = dist[index]?dist[index].id:0;
						});
						data.district = dist[0];
						
					if(!data.name) {
						root.alert('请填写机构名称', 'warn');
						return;
					}
					if(!data.ceo) {
						root.alert('请填写负责人姓名', 'warn');
						return;
					}
					if(!data.tel || !root.isMobile(data.tel)) {
						root.alert('手机号有误', 'warn');
						return;
					}
					if(!data.province) {
						root.alert('请填写所在地址', 'warn');
						return;
					}
					if(!data.license) {
						root.alert('请上传营业执照', 'warn');
						return;
					}
					// console.log(data);
					return data;
				},
				success: function(json) {
					//console.log(json.msg);
					if(json.type == "success"){
							root.alert('资料提交成功,请等待','sad',2);
							console.log(json);
					}
				},
				error: function(json) {
					if(json.type == "error"){
							root.alert('操作失败','sad',2);
							console.log(json);
					}
					if(json.type == "er"){
						box = new root.box({
							type:'confirm',title:'完善信息',buttonText:'去完善',height:260,
							content:'<p style="text-align:center;font-size:20px;margin-top:40px;">您当前的信息不完整，请先完善信息</p >',
							confirm:function(){
								root.self.location = root.dir + 'member/manage/index';
							},
						});
						return;
					}
				}
			});
		})

	},
	home_recharge:function(root){
		//支付方式切换
		root.body.on('click','.pay_text>a', function() {
			$('.pay_text>a').removeClass('isChoose');
			$(this).addClass('isChoose');
			var methodType = $(this).attr("method");
			if(methodType == "0") {
				$('.id_box').removeClass('open');
			} else {
				$('.id_box').addClass('open');
			}
		})
		root.body.on('click',".radio_box", function() {
			var state = $(this).attr("state");
			$('.radio_box').removeClass('r');
			$(this).addClass('r');
			$('.payInput,.rangeInput').val(100);
			$('.l_pay').text(100);
			 if(state == "0") {
				$('.payInput,.rangeInput').attr('max', '5000');
				$(".r_pay").text("5000");
			} else {
				$(".r_pay").text("50000");
				$('.payInput,.rangeInput').attr('max', '50000');
			}
  
		});

		//充值金额控制器
		root.body.on('input', '.payInput', function() {
			var a = $(this).val(),
				b = parseFloat($('.r_pay').text());
			var val = a > b ? b : a;
			$('.rangeInput').val(val);
			$(this).val(val);
			$('.l_pay').text(val);
		})
		root.body.on('input', '.rangeInput', function() {
			$('.payInput').val($(this).val());
			$('.l_pay').text($(this).val());
		})

		//“充值”提交按钮
		root.body.on('click','#paySubmit', function() {
			var type = $('.isChoose').attr('method'); //0自己   1他人
			var way = $('.r').attr('state'); //0支付宝  1微信
			var payContent = $('.payContent');
			payContent.form({
				auto: true,
				dataType: 'json',
				//表单验证
				check: function(data) {
					data.Gender = root.user.gender;
					data.way = way;
					// data.time = Date.parse(new Date());
					data.amount = (parseInt($('input.payInput').val())).toFixed(2);
					if(type == '1') {
						if(data.uid.length < 3) {
							root.alert('账号不能小于3个字符', 'warn');
							return;
						} else if(root.isNumeric(data.uid)) {
							if(data.uid.length < 5) {
								root.alert('UID必须大于5位数', 'warn');
								return;
							} else if(data.uid.length == 11 && !root.isMobile(data.uid)) {
								root.alert('手机号码有误', 'warn');
								return;
							}
						} else if(!root.isUsername(data.uid)) {
							root.alert('账号可以使UID、用户名或手机号', 'warn');
							return;
						}
					}else{
						data.uid = root.user.uid;
					}
					console.log(data);
					return data;
				},
		
				success: function(json) {
				 	if(json.type == "success"){
						root.alert('充值成功','happy',2);
					}
				},
				error: function(json) {
					if(json.type == "error"){
							root.alert(json.msg,'sad',2);
					}

				}

			});
		})
	},
	
	//机构后台登陆验证
	  home_school: function(root) {
		$('#schoolCheck').click(function() {
			var checkBox = $('.checkBox');
			checkBox.form({
				auto: true,
				dataType: 'json',
				check: function(data) {
					if(!data.password) {
						root.alert('请填写密码', 'warn');
						return;
					}
					return data;
				},
				success: function(data) {
					if(data.type == "success"){
						root.alert('验证成功','happy',2,function(){
							window.location = root.url + 'school/home/index';
						});
							
					}
				},
				error: function(data) {
					if(data.type == "error"){
							root.alert(data.msg,'sad',2);
							$('input[type=password]').val('');
					}
				}
			})
		})

	},
	manage_index:function(root){
		$('.into_btn').on('click',function(){
			$('.show-block').css('display','block');
		})
		$('.close-show-block').on('click',function(){
			$('.show-block').css('display','none');
		})
		
		$('span.target').click(function(e){
			if(e.target.className === 'cur'){
				$(this).addClass('focus');
			}else{
				$(this).removeClass('focus');
			}
			if(e.target.nodeName==="LI"){
				$('.target a.cur').text(e.target.innerText);
				var datas = e.target.attributes[0].value;
				$('.target a.cur').attr('data', datas);
			}
		});
		
		var num = $('textarea').val().length;
		$('span.words').text(num+"/100字");
		$('textarea').on('keyup',function(){
			var num = $('textarea').val().length;
			$('span.words').text(num+"/100字");
			if(num===100){
				$('span.words').css('color','red');
			}else{
				$('span.words').css('color','#9fb1b1');
			}
		})

		if($('input[name=idcard]').val()){
			$('input[name=idcard]').attr('disabled','true');
			var currVal = $('input[name=idcard]').val();
			var vals = currVal.match(/([\d]{10})([\dX]{8})/);
			var a = vals[1]+"********";
			$('input[name=idcard]').val(a)
		}
		//个人中心“保存”按钮
		$('#manageSubmit').click(function() {
			var sure = function(){
				var manageBox = $('#manageBox');
				manageBox.form({
					auto: true,
					dataType: 'json',
					//表单验证
					check: function(data) {
						box.close();
						var dist = $('#manageBox .vs-district.address').DOM[0].result();
							[null,'province','city','county','town'].forEach(function(key,index){
							if(index==0)return;
							data[key] = dist[index]?dist[index].id:0;
						});
						data.district = dist[0];
						if(vals){
							data.idcard = vals[0];							
						}
						var sid = $('span.subsite a.cur').attr('data');
						var flag = true;
						if(typeof sid == 'string'){
							//请选择
							if(sid === 'choose'){
								//未选 择
								flag = true;
							}else{
								//选择了
								data.sid = sid;
								flag = false;
							}
						}else{
							//有值
							flag = false;
						}
						
						if(!data.username || !root.isUsername(data.username)) {
							root.alert('用户名有误', 'warn');
							return;
						}
						if(!data.tellphone || !root.isMobile(data.tellphone)) {
							root.alert('用户手机号有误', 'warn');
							return;
						}
						if(!data.realname || !root.isRealname(data.realname)) {
							root.alert('请填写真实姓名', 'warn');
							return;
						}
						if(!data.idcard || !root.isIdCard(data.idcard)) {
							root.alert('身份证号码有误', 'warn');
							return;
						}		
						if(!data.email || !root.isMail(data.email)) {
							root.alert('邮箱有误', 'warn');
							return;
						}
//						if(flag){
//							root.alert('请选择机构', 'warn');
//							return;
//						}
//						if(!data.province) {
//							root.alert('请填写所在地址', 'warn');
//						return;
//						}
						console.log(data);
						return data;
					},
					success: function(json,e) {
						box.close();
						if(json.type == "success"){
							root.alert('更新成功','happy',2);
							root.self.location.reload();
						}
					},
					error: function(json) {
						box.close();
						if(json.type == "error"){
							root.alert('操作失败','sad',2);
						}
					}
				})
			}
			var box = new root.box({
				type:'confirm',
				title:'确认更新个人数据?',
				buttonText:'确定',
				auto:1,
				confirm:sure
			});
		})

	},
	//2017-10-18
	manage_buy:function(root){
		var formBuy = $('.form_buy');
		var deleteBtn = $('span.delete_btn a.btn');
		deleteBtn.click(function(){
			var liId = this.parentNode.parentNode.getAttribute('data-id');
			root.updata(formBuy,liId);
		});
		$('.prev-page').on('click',function(){
			root.prevPage();
		});
		$('.next-page').on('click',function(){
			root.nextPage();
		});
	},
	//2017-10-18
	manage_pay:function(root){
		var formPay = $('.form_pay');
		var deleteBtn = $('span.delete_btn a.btn');
		deleteBtn.click(function(){
			var liId = this.parentNode.parentNode.getAttribute('data-id');
			root.updata(formPay,liId);
		});
		$('.prev-page').on('click',function(){
			root.prevPage();
		});
		$('.next-page').on('click',function(){
			root.nextPage();
		});
	},
	
	manage_study: function(root) {
		if(root.page == 'study') {
			$('aside[type=manage] a.btn.study').addClass('open');
		}
		//类型切换
		root.body.on('click','.record_nav>a', function() {
			$('.record_nav>a').removeClass('open');
			$(this).addClass('open');
		});
		$('input').on('change',function(){
			root.load(root.dir+'member/manage/study/'+root.self.btoa(this.value));
		})
		$('i.refresh').on('click',function(){
			var val = $('input[page=study]').val();
			root.load(root.dir+'member/manage/study/'+root.self.btoa(val));			
		})
		new root.chart('.vs-chart');
	}
}
