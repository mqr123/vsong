VSong.modules = {
	__construct:function(root,pjax){
		root.urls = root.getUrlParams();
		root.mod = root.urls[1] || 'home';
		root.page = root.urls[2] || 'index';
		root.district(root,'.vs-district',root.dir+'main/common/district/');
		//导航高亮
		var crrentUrl = document.URL.split('://'+document.domain)[1];
		var target = $('aside>a.btn[href^="'+crrentUrl+'"]');
		$('aside>a.btn.open').removeClass('open');
		if(target && root.urls[2]){
			target.addClass('open');
		}else{
			$('aside>a.btn').DOM[0].classList.add('open');
		}
		//学员详情导航
		var stuTarger = $('.details>nav>a.btn[href^="'+crrentUrl+'"]');
		$('.details>nav>a.btn.stu_open').removeClass('stu_open');
		if (stuTarger && root.urls[2]) {
			stuTarger.addClass('stu_open');
		}
		//地址
		var func = this[root.mod+'_'+root.page];
		if(typeof func === 'function')func(root,pjax);
		root.body.addClass('ready').attr({mod:root.mod,page:root.page});
		root.ready();
	},
	
	home_index:function(root){
		$('textarea').on('keyup',function(){
			var num = $('textarea').val().length;
			$('span.words').text(num+"/300字");
			if(num === 300){
				$('span.words').css('color','red');
			}else{
				$('span.words').css('color','#00a09d');
			}
		});
		//上传图片
		var formDom = $('#school-btn');
		//上传文件图片
		
		$('#license').on('change',function(){
			var _this = this;
			var file = this.files[0];
			var data = {};
			data.format = root.pathinfo(file.name).extension;
			data.name = file.name;
			data.size = file.size;
			data.type = file.type;
			var reader = new FileReader();
			reader.readAsDataURL(file);
			reader.onload = function(){
				if(['image/png','image/jpeg','image/jpg','image/gif'].indexOf(file.type)==-1){
					root.alert('文件类型只允许：png、jpg、gif',2,function(){
						
					});
					return;
				}
				if(file.size > 2048*1024){
					root.alert('文件大小超出限制，最大允许 2 MB',2,function(){
						
					});
					return;
				}
				data.src = this.result;
				_this.parentNode.style.backgroundImage = 'url('+this.result+')';
				formDom.data('license',JSON.stringify( data ));
				
			}
			reader.onerror = function(){	
			}
		});
	    //信息保存
		formDom.find('.school_btn').on('click',function(e){
			var box = new root.box({
				type:'confirm',
				title:'确认更新个人数据?',
				buttonText:'确定',
				auto:1,
				confirm:function(){
					box.close();
					preservation();
				},
			});
		});
		var preservation = function(e){
			formDom.form({
				auto:true,
				dataType:'json',
				check:function(data){
					console.log(data);
					data.license = formDom.data('license');
					var dist = $('.district .vs-district').DOM[0].result();
					[null,'province','city','county','town'].forEach(function(key,index){
							if(index==0)return;
							data[key] = dist[index]?dist[index].id:0;
						});
						data.district = dist[0];
					
					if(!root.isMobile(data.tel)){
						root.alert('手机格式有误',1);
						return;
					}
					return data;	
				},
				success:function(json){
					if(json.type == "success"){
						root.alert(json.msg || '保存成功','happy',1);
						root.self.location.reload();
					}
				},
				error:function(json){
					if(json.type == "error"){
						root.alert('操作失败','sad',2);
					}
				},
			});
		}
	},
		home_student:function(root){
		//添加学员
		var box;
		var students = $('.students');
		var addStudent = function(e){
			var addForm = function(e){
				$('#add-studentBtn').form(addStudentOpt(root));
			}
			box = new root.box({
			type:'confirm',
			title:'添加学员',
			buttonText:'立即添加',
			confirm:addForm,
			content:'<form action="'+root.appUrl+'/home/addStudent" id="add-studentBtn"><div class="add-wrap">'+
		            '   <label>'+
					' 		<div class="labes labe-l">'+
					' 			<div><span>用户名</span><span>*</span></div>'+
					' 			<div class="add-ipt ipt-l">'+
					' 			   <input type="text" class="username" name="username" id="aa" placeholder="输入用户名"/>'+
					' 			</div>'+
					'           <div class="show_labl username_labl">用户名已存在</div>'+
					' 		</div>'+
					' 		<div class="labes labe-r">'+
					' 			<div><span>手机号</span><span>*</span></div>'+
					' 			<div class="add-ipt ipt-r">'+
					' 			    <input type="text" class="phone" name="phone" placeholder="输入手机号"/>'+
					' 			</div>'+
					'           <div class="show_labl phone_labl">手机号已存在</div>'+
					' 		</div>'+
					' 	</label>'+
				    '   <label>'+
					' 		<div class="labes labe-l">'+
					' 			<div><span>学生姓名</span><span>*</span></div>'+
					' 			<div class="add-ipt ipt-l">'+
					' 			   <input type="text" name="relname" placeholder="输入姓名"/>'+
					' 			</div>'+
					' 		</div>'+
					' 		<div class="labes labe-r">'+
					' 			<div><span>性别</span></div>'+
					' 			<div class="isSex">'+
					' 			    <label class="ilb"><input type="radio" checked name="gender" value="1" />男</label>'+
					' 			    <label class="ilb" style="margin-left:30px;"><input type="radio" name="gender" value="2" />女</label>'+
					' 			</div>'+
					' 		</div>'+
					' 	</label>'+
				    '   <label>'+
					' 		<div class="labes labe-l">'+
					' 			<div><span>邮箱</span></div>'+
					' 			<div class="add-ipt ipt-l">'+
					' 			   <input type="text" class="email" name="email" placeholder="输入邮箱"/>'+
					' 			</div>'+
					'           <div class="show_labl email_labl">邮箱已存在</div>'+
					' 		</div>'+
					' 		<div class="labes labe-r">'+
					' 			<div><span>密码</span></div>'+
					' 			<div class="add-ipt ipt-l">'+
					' 			   <input type="password" name="password" placeholder="输入密码"/>'+
					' 			</div>'+
					' 		</div>'+
					' 	</label>'+
//					'   <input type="hidden" name="formhash" value="{$this->formhash()}">'+
					'   <label>'+
					' 		<div class="labes labe-l">'+
					' 			<div><span>家长姓名</span></div>'+
					' 			<div class="add-ipt ipt-l">'+
					' 			   <input type="text" name="parents" placeholder="家长姓名"/>'+
					' 			</div>'+
					' 		</div>'+
					' 		<div class="labes labe-r">'+
					' 			<div><span>家长电话</span></div>'+
					' 			<div class="add-ipt ipt-r">'+
					' 			    <input type="text" name="parents_phone" placeholder="家长电话"/>'+
					' 			</div>'+
					' 		</div>'+
					' 	</label>'+
					' 	<div class="warn">'+
					'        带*号为必填               '+
					' 	</div>'+
				    '</div></form>',
			});
			
			$('.username').on('blur',function(){
				var _class = $('.username');
				var show_name = $('.username_labl');
				var _name = 'username';
				root.verify(_class,_name,show_name);
			});
			$('.phone').on('blur',function(){
				var _class = $('.phone');
				var _name = 'phone';
				var show_name = $('.phone_labl');
				root.verify(_class,_name,show_name);
			});
			
			
		};
		$('.add-btn').click(function(){
			addStudent();
		});
		/*
		 * 验证正则
		 * root.isURL   root.isNumeric   root.isMobile
		 * root.isTel   root.isUsername  root.isRealname
		 * root.isMail  root.trim        root.isIdCard 
		 */
		 var addStudentOpt = function(root){
			return{
				auto:true,
				dataType:'json',
				//验证表单
				check:function(data){
					var formDom = document.getElementById('add-studentBtn');
					if(data.gender){
						data.gender = $('input[name="gender"]:checked',formDom).val();
					}
					if(data.username != ''){
						if(!root.isUsername(data.username)){
							root.alert('用户名输入有误','sad',1);
							return;
						}
					}else{
						root.alert('用户名为必填项','sad',1);
						return;
					}
					if(data.phone != ''){
						if(!root.isMobile(data.phone)){
							root.alert('手机格式有误，请重新输入','sad',1);
							return;
						}
					}else{
						root.alert('手机为必填项','sad',1);
						return;
					}
					if(data.relname != ''){
						if(!root.isRealname(data.relname)){
							root.alert('姓名格式有误，请重新输入','sad',1);
							return;
						}
					}else{
						root.alert('姓名为必填项','sad',1);
						return;
					}
					if (data.password.length < 6) {
						root.alert('密码不能小于6个字符，请重新输入','warn',1);
						return;
					}
					console.log(data);
					return data;
				}, 
				success:function(obj){
					 root.alert('添加成功','happy',2,function(){
					 	box.close();
					 	root.load();
					 });
				},
				error:function(e){
					 root.alert('添加失败','sad',2);
				}
			}
		};
		//搜索学员提交 updata 2017.10.24
		$('.search-btn').on('click',function(){
			var form = $('#school');
			form.form({
				auto:true,
				check:function(data){
					return data;
				},
				success:function(json){
					var newData = JSON.parse(json);
					var html = '';
					newData.list.forEach(function(newData){
						html += '<div class="students" url="/school/'+newData.url+'"><i></i><div class="students-headImg"><img src="'+root.url+'avatar/middle/'+newData.uid+'" /></div>';
						html += '<p class="student-uid">'+newData.uid+'</p>';
						html +=	'<p class="student-name">'+newData.username+'</p>';
						html +=	'<p class="student-phone">'+newData.phone+'</p>';
						html +=	'<span class="student-right_jt"><i class="icon_s icon-nor"></i></span>';
				  		html +=	'<span class="student-sex"><i class="icon_s icon-gender" gender="'+newData.gender+'"></i></span>';
						html += '</div>';
				  		return html;
					});
					$('.student-box>.stu-cont').html(html);
				},
				error:function(e){
				 	console.log(e);
				}
			});
		});
		
		/*
		 * 删除学员
		 */
		$('.delete-btn').on('click',function(){
			document.body.classList.toggle('student-delete');
			if(!document.body.classList.contains('student-delete')){
				$('.students').removeClass('selected');
			}
		});
		
		/*
		students.on('click',function(e){
			if(document.body.classList.contains('student-delete')){
				this.classList.toggle('selected');
				e.preventDefault();
				return false;
			}else{
				root.load(this.getAttribute('url'),$('.student-name',this).text());
			}
		});
		*/
		$('.student-box>.stu-cont').on('click','.students',function(e){
			if(document.body.classList.contains('student-delete')){
				this.classList.toggle('selected');
				e.preventDefault();
				return false;
			}else{
				root.load(this.getAttribute('url'),$('.student-name',this).text());
			}	
		});
		//取消事件
		$('.cancelBtn').on('click',function(){
			document.body.classList.remove('student-delete');
		});
		//确认删除
		$('.deleatBtn').on('click',function(){
			var url=$('#delete').attr('action');
			var selected = $('.student-delete .selected');
			var length = selected.DOM.length;
			console.log(length);
			if(length<1){
				root.alert('请选择要删除的学员!');
				return;
			}
			box = new root.box({
				type:'confirm',
				auto:1,
				smile:'warn',
				content:'确定要删除选中的 '+length+' 名学员？',
				buttonText:'立即删除',
				confirm:function(){
					var ids = [];
					selected.each(function(dom,index){
						ids.push(parseInt(dom.getAttribute('data-id')));
					});
					selected.remove();
					document.body.classList.remove('student-delete');
					box.close();
					var form = new FormData();
					form.append('ecode',root.ecode);
					form.append('ids',JSON.stringify(ids));
					root.request({
						url:url,
						dataType:'json',
						data:form,
						success:function(data){
							root.alert('删除成功','happy',2,function(){
							root.load();
								
							})
						},
						error:function(data){
							console.log(data);	
						}
					});
				}
			})
		});
		
	},
	
	home_release:function(root){
		var formDom = $('#issuance');
		//删除新闻事件
		$('.release-deleat').on('click',function(){
			document.body.classList.toggle('rel-delete');
		});
		$('.rel_cont').on('click',function(){
			if(!document.body.classList.contains('rel-delete'))return;
			this.classList.toggle('isdeleatd');
		});
		
		$('.new_deleteBtn').on('click',function(){
			var ids = this.parentNode.getAttribute('data-id');
			var box = new root.box({
				title:'',
				auto:1,
				type:'confirm',
				buttonText:'删除',
				content:'确定要删除本条新闻吗？',
				confirm:function(e){
					formDom.form({
						auto:true,
						check:function(data){
							data.ids =ids;
							box.close();
							return data;
						},
						success:function(json){
							var local = window.location.pathname;
							console.log(local);
							var newUrl = local.split('-')[0];
							var newJson = JSON.parse(json);
							if(newJson.type == 'success'){
								root.alert(json.msg || '删除成功','happy',2,function(){
									root.load(newUrl);
								});	
							}			
						},
						error:function(json){
							var newJson = JSON.parse(json);
							if(newJson.type == 'error'){
								root.alert(json.msg || '删除失败','sad',2,function(){
									root.load(root.dir + 'school/home/release/');
								});	
							}		
						}
					})
				}
			});
		});
		
		var m = 0;
		$('.fontsize').on('click',function(){
			if(m % 2 ==0){
				$('.fontsize-show').css('display','block');
			}else{
				$('.fontsize-show').css('display','none');
			}
			m++;
		})
		$('.font_size').on('click',function(){
			if(this.innerText == '小标题'){
				document.execCommand("fontsize", false,4);
			}else if(this.innerText == '中标题'){
				document.execCommand("fontsize", false,5);
			}else if(this.innerText == '大标题'){
				document.execCommand("fontsize", false,6);
			}
			$('.fontsize-show').css('display','none');
			m++;
		})
		$('.uploadImage').on('click',function(){
			var data = {};
			var box = new root.box({
				title:'<label class="ilb_hide">请选择要插入的图片<input id="image-load" class="ipt_hide" type="file" /></label>',
				width:600,height:400,
				type:'confirm',
				buttonText:'插入图片',
				content:'<div id="image-view"></div>',
				confirm:function(){
					if(data.src){
						document.getElementById('wysiwyg').focus();
						document.execCommand('insertimage',0,data.src);
						box.close();
					}else{
						root.alert('请选择图片');
					}
				}
			});
			$('#image-load').on('change',function(){
				var file = this.files[0];
				data.size = file.size;
				data.type = file.type;
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
					data.src = this.result;
					$('#image-view').html('<img src="'+data.src+'" />');
				}
			});
		});
		//上传图片
		$('#coverchange').on('change',function(){
			var _this = this;
			var file = this.files[0];
			var data = {};
			data.format = root.pathinfo(file.name).extension;
			data.name = file.name;
			data.size = file.size;
			data.type = file.type;
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
				data.src = this.result;
				_this.parentNode.style.backgroundImage = 'url('+this.result+')';
				formDom.data('license',JSON.stringify( data ));
			}
			reader.onerror = function(){
			}
		});
		//富文本编辑器
		var wysiwyg = $('#wysiwyg');
		$('.issuance_spans').on('click',function(e){
			var cmd = this.getAttribute('data-name');
			document.execCommand(cmd, true);
		});
		wysiwyg.on('input',function(){
			$('a',this).removeAttr('href');
			$('[contenteditable],style,script,input,audio,video,textarea,button,form,canvas,html,body,head,media',this).remove();
		});
		wysiwyg.on('paste',function(e){
			var clips = (e.clipboardData||window.clipboardData);
			var data = clips.getData('text/plain');
			if (data){
				console.log(clips);
				clips.setData('text/plain',data);
				return true;
			}
			e.preventDefault();
			return false;
		});
		
		//立即发布
		//立即发布
		$('.issuanceBtn').on('click',function(e){
			var data_type = $('input[name="type"]:checked').val();
			formDom.form({
				auto:true,
				check:function(data){
					var getData = document.getElementById('wysiwyg');
					data.license = formDom.data('license');
					data.content = getData.innerHTML?getData.innerHTML:'';
					if(data_type){
						data.type = data_type;
					}
					return data;
				},
				success:function(json){
					json=JSON.parse(json);
					if(json.type=='success'){
						root.alert('发布成功','happy',2,function(e){
							if(data_type == 0){
								root.load(root.dir + 'school/home/release/news');
							}else if(data_type == 1){
								root.load(root.dir + 'school/home/release/enrol');
							}else if(data_type == 2){
								root.load(root.dir + 'school/home/release/product');
							}
							
						});
					}
				},
				error:function(json){
					json=JSON.parse(json); 
				 	if(json.type=='error'){
						root.alert(json.msg || ' 发布失败',sad,2);
					}
				}
			});
		})
	},
	home_stuInfo:function(root){
		 //信息保存
		var formDom = $('#details-box');
		formDom.find('.etails_btn').on('click',function(root){
			preservation(root);
		});
		
		var preservation = function(e){
			if(formDom.disable)return;
			formDom.form({
				auto:true,
				dataType:'json',
				check:function(data){
					
					var dist = $('.district .vs-district').DOM[0].result();
					[null,'province','city','county','town'].forEach(function(key,index){
							if(index==0)return;
							data[key] = dist[index]?dist[index].id:0;
						});
						data.district = dist[0];
					if(!data.username || !root.isUsername(data.username)){
						root.alert('用户名不能为空！','sad',1);
						return;
					}
					if(!root.isMobile(data.phone)){
						root.alert('手机格式有误,请重新输入！','sad',1);
						return;
					}
					if(!root.isRealname(data.realname)){
						root.alert('姓名输入有误，请重新输入！','sad',1);
						return;
					}
					if(!root.isIdCard(data.idcard)){
						root.alert('身份证号输入有误，请核对后重新输入！','sad',1);
						return;
					}
					
					if(!root.isMobile(data.parents_phone)){
						root.alert('家长手机号格式有误,请重新输入！','sad',1);
						return;
					}
					if(!root.isMail(data.email)){
						root.alert('邮箱地址有误,请重新输入！','sad',1);
						return;
					}
					return data;	
				},
				success:function(json){
					if(json.type == "success"){
						root.alert(json.msg || '保存成功','happy',1,function(){
							root.load();
						});
						
					}
				},
				error:function(json){
					 if(json.type == "error"){
				 		root.alert('操作失败','sad',2,function(){
				 			root.load();
				 		});
					}
				},
			});
		}
	},
	
	home_message:function(root){
		var formDom = $('#isRead');
		var formDoms = $('.btnDel');
		$('.editBtn').on('click',function(){
			document.body.classList.toggle('edit');
		});
		
		$('.reade').on('click',function(){
			root.load(this.getAttribute('url'),$('.message',this).text());
		})
		
		$('.unRead').on('click',function(e){
			if(document.body.classList.contains('edit')){
				this.classList.toggle('edit-btn');
				e.preventDefault();	
				return false;
			}else{
				var ids = this.getAttribute('data-id');
				formDom.form({
					auto:true,
					check:function(data){
						data.ids =ids;
						return data;
					},	
					success:function(json){
					
						if(json.type == "success"){
							root.alert(json.msg ||'操作成功','happy',1);
						}
					},
					error:function(json){
							if(json.type == "success"){
							root.alert(json.msg ||'操作失败','sad',1);
						}
					}
				});
				root.load(this.getAttribute('url'),$('.message',this).text());
			}
		});
		$('.btn-msg').on('click',function(){
			var url = this.getAttribute('url');
			var ids = this.parentNode.childNodes[1].getAttribute('data-id');
			var box = new root.box({
				title:'',
				auto:1,
				type:'confirm',
				buttonText:'删除',
				content:'确定要删除本条消息吗？',
				confirm:function(e){
					var form = new FormData();
					form.append('ids',ids);
					box.close();
					root.request({
						url:url,
						dataType:'json',
						data:form,
						success:function(data){
							root.alert(data.msg || '删除成功',2,function(){
								root.load();
							})
						},
						error:function(data){
							root.alert(data.msg || '删除失败',2,function(){
								root.load();
							})	
						}
					});
					
					
					
					
//					formDoms.form({
//						auto:true,
//						check:function(data){
//							data.ids = ids;
//							console.log(data);
//							box.close();
//							return data;
//						},
//						success:function(json){
//							console.log(json);
//							if(json.type == 'success'){
//								root.alert(json.msg ||　'删除成功','happy',2,function(){
//									root.load();
//								})
//							}
//						},
//						error:function(json){
//							if(json.type == 'error'){
//								root.alert(json.msg ||　'删除失败','sad',2,function(){
//									root.load();
//								})
//							}
//						}
//					})
				}
			});
		})
		
		//设为已读事件
		$('.infor_read').on('click',function(){
			var ids = [];
			$('.unRead.edit-btn').each(function(dom,index){
				ids.push(parseInt(dom.getAttribute('data-id')));
			});
			formDom.form({
				auto:true,
				check:function(data){
					data.ids =JSON.stringify(ids);
					return data;
				},
			success:function(json){
					location.reload(true);   
				},
			error:function(e){
				}
			});
			
		});
		//取消事件
		$('.infor_cancel').on('click',function(){
			document.body.classList.remove('edit');
		});
	},
	//2017-10-18
	home_log:function(root){
		var formDom = $('#logForm');
		var logBtn = $('.logBtn');
		logBtn.on('click',function(){
			var ids = this.parentNode.parentNode.getAttribute('data-id');
			root.updata(formDom,ids);
		});
		$('.prev-page').on('click',function(){
			root.prevPage();
		});
		$('.next-page').on('click',function(){
			root.nextPage();
		});
	},
	//2017-10-18
	home_buy:function(root){
		var formDom = $('#buyForm');
		var buyBtn = $('.buyBtn');
		buyBtn.on('click',function(){
			var ids = this.parentNode.parentNode.getAttribute('data-id');
			root.updata(formDom,ids);
		});
		$('.prev-page').on('click',function(){
			root.prevPage()
		});
		$('.next-page').on('click',function(){
			root.nextPage();
		});
	},
	
	home_recharge:function(root){
		var formDom = $('#rechargeForm');
		var rechargeBtn = $('.rechargeBtn');
		rechargeBtn.on('click',function(){
			var ids = this.parentNode.parentNode.getAttribute('data-id');
			root.updata(formDom,ids);
		});
		$('.prev-page').on('click',function(){
			root.prevPage();
		});
		$('.next-page').on('click',function(){
			root.nextPage();
		});
	},
}