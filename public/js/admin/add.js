layui.config({
	base : window.DIR+"public/js/admin/"
}).use(['form','layer','layedit','laydate','element'],function(){
	var form = layui.form(),
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		layedit = layui.layedit,
		laydate = layui.laydate,
		$ = layui.jquery,
		element = layui.element(); //Tab的切换功能，切换事件监听等，需要依赖element模块

	 $.fn.extend({
       serializeObject:function(){
           if(this.length>1){
              return false;
           }
           var arr=this.serializeArray();
           var obj=new Object;
           $.each(arr,function(k,v){
              obj[v.name]=v.value;
           });
           return obj;
       }
    });
    
    //1.管理员操作
	$('#admin-form .submit').on('click',function(){
		var url =$('#admin-form').attr('action');
		var aform = $('#admin-form').serializeObject();
		$.ajax({
			url:url,
			type:"post",
			data:aform,
			dataType:'json',
			success:function(obj){
				 console.log(obj);
				 window.location.href = window.DIR+"admin/Administrator/index";
			},
			error:function(obj){
				document.body.innerHTML = obj.responseText;
			 	console.log(obj);
			}
		});
	});
	
	//2.教学模式修改/编辑
	$('#study-form .submit').on('click',function(){
		var url =$('#study-form').attr('action');
		var form = $('#study-form').serializeObject();
		
		$.ajax({
			url:url,
			type:"post",
			data:form,
			dataType:'json', 
			success:function(obj){
				console.log(obj.type);
				if(obj.type == "success"){
					 console.log(obj);
					 alert('操作成功！');
					 window.location.href = window.DIR+"admin/study/index";
					// console.log(window.DIR+"admin/study/index");
				}else{
					console.log(obj);
					alert('操作失败');
				}
			},
			error:function(obj){
//				if(obj.type == "error"){
//					 console.log(obj);
//					 alert('失败！');
//					// window.location.href = window.DIR+"admin/study/index";
//					// console.log(window.DIR+"admin/study/index");
//				}
				document.body.innerHTML = obj.responseText;
			 	console.log(obj);
			}
		});
	});
	
	//3.练习模式添加/修改
	$('#train-form .submit').on('click',function(){
		var url =$('#train-form').attr('action');
		var form = $('#train-form').serializeObject();
		$.ajax({
			url:url,
			type:"post",
			data:form,
			dataType:'json', 
			success:function(obj){
				console.log(obj.type);
				if(obj.type == "success"){
					 console.log(obj);
					 alert('操作成功！');
					 window.location.href = window.DIR+"admin/train/index";
					
				}else{
					console.log(obj);
					alert('操作失败');
				}
			},
			error:function(obj){
				document.body.innerHTML = obj.responseText;
			 	console.log(obj);
			}
		});
	});

	//4.游戏模式添加/修改	
	$('#game-form .submit').on('click',function(){
		var url =$('#game-form').attr('action');
		var aform = $('#game-form').serializeObject();
		$.ajax({
			url:url,
			type:"post",
			data:aform,
			dataType:'json',
			success:function(obj){
				 console.log(obj);
				 if(obj.type == "success"){
					 console.log(obj);
					 alert('操作成功！');
					 window.location.href = window.DIR+"admin/game/index";
					
				}else{
					console.log(obj);
					alert('操作失败');
				}
			},
			error:function(obj){
				document.body.innerHTML = obj.responseText;
			 	console.log(obj);
			}
		});
	});
	//5.音乐操作
	$('#music-form .submit').on('click',function(){
		var url =$('#music-form').attr('action');
		var aform = $('#music-form').serializeObject();
		$.ajax({
			url:url,
			type:"post",
			data:aform,
			dataType:'json',
			success:function(obj){
				 console.log(obj);
				 if(obj.type == "success"){
					 console.log(obj);
					 alert('操作成功！');
					 window.location.href = window.DIR+"admin/music/index";
					
				}else{
					console.log(obj);
					alert('操作失败');
				}
			},
			error:function(obj){
				document.body.innerHTML = obj.responseText;
			 	console.log(obj);
			}
		});
	});
	
	//6.充值操作
	$('#recharge-form .submit').on('click',function(){
		var url =$('#recharge-form').attr('action');
		var aform = $('#recharge-form').serializeObject();
		$.ajax({
			url:url,
			type:"post",
			data:aform,
			dataType:'json',
			success:function(obj){
				 console.log(obj);
				if(obj.type == "success"){
					 console.log(obj);
					 alert('充值成功！');
					 window.location.href = window.DIR+"admin/recharge/index";
					
				}else{
					console.log(obj);
					alert('充值失败');
					window.location.href = window.DIR+"admin/recharge/index";
				}
			},
			error:function(obj){
				document.body.innerHTML = obj.responseText;
			 	console.log(obj);
			}
		});
	});
	//7.帮助
	$('#news-form .submit').on('click',function(){
		var url =$('#news-form').attr('action');
		var form1 = $('#news-form').serializeObject();
		$.ajax({
			url:url,
			type:"post",
			data:form1,
			dataType:'json',
			success:function(obj){
				 console.log(obj);
				 if(obj.type == "success"){
					 console.log(obj);
					 alert('操作成功！');
					 window.location.href = window.DIR+"admin/help/index";
					
				}else{
					console.log(obj);
					alert('操作失败');
				}
			},
			error:function(obj){
				document.body.innerHTML = obj.responseText;
			 	console.log(obj);
			}
		});
	});
	//8.新闻发布
	
	$('#conts-form .submit').on('click',function(){
		//判断文件读取是否完成
		if(btn.classList.contains('wait'))return false;
		var url =$('#conts-form').attr('action');
		var form1 = $('#conts-form').serializeObject();
		console.log(fileData)
		form1.files = JSON.stringify(fileData);
		//console.log(form1.files);
		$.ajax({
			url:url,
			type:"post",
			data:form1,
			dataType:'json',
			success:function(obj){
				 console.log(obj);
				 if(obj.type == "success"){
					 console.log(obj);
					 alert('操作成功！');
					 window.location.href = window.DIR+"admin/news/index";
					
				}else{
					console.log(obj);
					alert('操作失败');
				}
			},
			error:function(obj){
//				document.body.innerHTML = obj.responseText;
			 	console.log(obj);
			}
		});
	});
	
	//9.机构操作
	$('#school-form .submit1').on('click',function(){
		var url1 =$('#school-form').attr('action');
		var form2 = $('#school-form').serializeObject();
		$.ajax({
			url:url1,
			type:"post",
			data:form2,
			dataType:'json',
			success:function(obj){
				 console.log(obj);
				 if(obj.type == "success"){
					 console.log(obj);
					 alert('操作成功！');
					 window.location.href = window.DIR+"admin/member/index";
					
				}else{
					console.log(obj);
					alert('操作失败');
				}
			},
			error:function(obj){
				
				document.body.innerHTML = obj.responseText;
			}
		});
	});
  
  	element.on('tab(test)', function(elem){
    location.hash = 'test='+ $(this).attr('lay-id');
  });
	
	//10.登陆
	$('#login-form .submit').on('click',function(){
			var url =$('#login-form').attr('action');
			var form3 = $('#login-form').serializeObject();
			$.ajax({
				url:url,
				type:"post",
				data:form3,
				dataType:'json',
				success:function(obj){
					alert(obj.msg);
					location.href="/../../../admin/home/index";
				},
				error:function(obj){
					 document.body.innerHTML = obj.responseText;
				}
			});
		});

	//11.用户操作
	$('#member-form .submit').on('click',function(){
		var url =$('#member-form').attr('action');
		var form3 = $('#member-form').serializeObject();
		$.ajax({
			url:url,
			type:"post",
			data:form3,
			dataType:'json',
			success:function(obj){
				//alert(obj.msg);
				if(obj.type == "success"){
					 console.log(obj);
					 layer.alert('操作成功！');
					// layer.msg('操作成功！');
					 window.location.href = window.DIR+"admin/member/index";
					
				}else{
					console.log(obj);
					alert('操作失败');
					window.location.href = window.DIR+"admin/member/index";
				}
				
			},
			error:function(obj){
				 document.body.innerHTML = obj.responseText;
			}
		});
	});
	//12.用户详情资料修改
	$('#test-form .submit').on('click',function(){
		var url =$('#test-form').attr('action');
		var form1 = $('#test-form').serializeObject();
		$.ajax({
			url:url,
			type:"post",
			data:form1,
			dataType:'json',
			success:function(obj){
				 console.log(obj);
				 if(obj.type == "success"){
					 console.log(obj);
					 alert('操作成功！');
					 window.location.href = window.DIR+"admin/member/index";
					
				}else{
					console.log(obj);
					alert('操作失败');
				}
			},
			error:function(obj){
				document.body.innerHTML = obj.responseText;
			 	console.log(obj);
			}
		});
	});
	
	//13.密码修改
	$('#change-form .submit').on('click',function(){
		var url =$('#change-form').attr('action');
		var form = $('#change-form').serializeObject();
		
		$.ajax({
			url:url,
			type:"post",
			data:form,
			dataType:'json',
			success:function(obj){
				 console.log(obj);
				  if(obj.type == "success"){
					 console.log(obj);
					 alert('操作成功！');
					 window.location.href = window.DIR+"admin/Administrator/index";
				
				}else{
					console.log(obj);
					alert('操作失败');
				}
			},
			error:function(obj){
				 document.body.innerHTML = obj.responseText;
			}
		});
	});

});
