if(typeof VSong !== 'object')var VSong = {};VSong.cookieConfig = {"pre":"vSong_","expire":3600,"path":"\/","domain":""};
 layui.config({
	base : window.DIR+"public/js/admin/"
	}).use(['form','layer','jquery','laypage'],function(){
	var form = layui.form(),
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		laypage = layui.laypage,
		$ = layui.jquery;

	//添加管理员
	$(".usersAdd_btn").click(function(){
		var index = layui.layer.open({
			title : "添加",
			type : 2,
			content : "add",
			success : function(layero, index){

			}
		})
		//改变窗口大小时，重置弹窗的高度，防止超出可视区域（如F12调出debug的操作）
		$(window).resize(function(){
			layui.layer.full(index);
		})
		layui.layer.full(index);
	});
	
	//添加用户
	$(".insert_btn").click(function(){
		var index = layui.layer.open({
			title : "账号添加",
			type : 2,
			content : "insert",
			success : function(layero, index){

			}
		})
		//改变窗口大小时，重置弹窗的高度，防止超出可视区域（如F12调出debug的操作）
		$(window).resize(function(){
			layui.layer.full(index);
		})
		layui.layer.full(index);
	});
	//添加帮助
	$(".helpAdd_btn").click(function(){
		var index = layui.layer.open({
			title : "添加帮助",
			type : 2,
			content : "add",
			success : function(layero, index){

			}
		})
		//改变窗口大小时，重置弹窗的高度，防止超出可视区域（如F12调出debug的操作）
		$(window).resize(function(){
			layui.layer.full(index);
		})
		layui.layer.full(index);
	})

    //全选
	form.on('checkbox(allChoose)', function(data){
		var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"])');
		child.each(function(index, item){
			item.checked = data.elem.checked;
		});
		form.render('checkbox');
	});

	//通过判断是否全部选中来确定全选按钮是否选中
	form.on("checkbox(choose)",function(data){
		var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"])');
		var childChecked = $(data.elem).parents('table').find('tbody input[type="checkbox"]:not([name="show"]):checked')
		if(childChecked.length == child.length){
			$(data.elem).parents('table').find('thead input#allChoose').get(0).checked = true;
		}else{
			$(data.elem).parents('table').find('thead input#allChoose').get(0).checked = false;
		}
		form.render('checkbox');
	})


  
})
