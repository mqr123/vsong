layui.config({
	base : window.DIR+"public/js/admin/"
}).use(['form','layer'],function(){
	var form = layui.form(),
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		layedit = layui.layedit,
		laydate = layui.laydate,
		$ = layui.jquery;
		console.log($('#send'))
	$('#send').click(function(){
		var school_val = $("[name=school]").val();
		var user_num = $("#user_num").attr('value');
		var recharge = $("#recharge").attr('value');
		var message_add = $("#message_add").attr('action');
		$.ajax({
			type:"POST",
			url:message_add,
			dataType:'json',
			data:{name:school_val,num:user_num,recharge:recharge},
			success:function(data){
//				console.log(data);
//				var data=JSON.parse(data);
				alert(data.msg);
			},
			error:function(data){
//				document.body.innerHTML=data.responseText;
//				console.log(data);
			}
		})
	});
	
	
		$('#buy').click(function(){
		var school_val = $("[name=school]").val();
		var user_num = $("#user_num").attr('value');
		var message_buy = $("#message_buy").attr('action');
		console.log(message_buy);
		$.ajax({
			type:"POST",
			url:message_buy,
			dataType:'json',
			data:{name:school_val,num:user_num},
			success:function(data){
//				console.log(data);
//				var data=JSON.parse(data);
				alert(data.msg);
			},
			error:function(data){
				document.body.innerHTML=data.responseText;
				console.log(data);
			}
		})
	});

})
