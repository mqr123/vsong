if(typeof VSong !== 'object')var VSong = {};VSong.cookieConfig = {"pre":"vSong_","expire":3600,"path":"\/","domain":""};
function navBar(data){
	var ulHtml = '<ul class="layui-nav layui-nav-tree">';
	for(var i=0;i<data.length;i++){
		data[i].icon = 'icon-text';
		if(data[i].spread === '1'){
			ulHtml += '<li class="layui-nav-item layui-nav-itemed">';
		}else{
			ulHtml += '<li class="layui-nav-item">';
		}
		if(data[i].children != undefined && data[i].children.length > 0){
			ulHtml += '<a href="javascript:;">';
			if(data[i].icon != undefined && data[i].icon != ''){
				if(data[i].icon.indexOf("icon-") != -1){
					ulHtml += '<i class="iconfont '+data[i].icon+'" data-icon="'+data[i].icon+'"></i>';
				}else{
					ulHtml += '<i class="layui-icon" data-icon="'+data[i].icon+'">'+data[i].icon+'</i>';
				}
			}
			ulHtml += '<cite>'+data[i].title+'</cite>';
			ulHtml += '<span class="layui-nav-more"></span>';
			ulHtml += '</a>'
			ulHtml += '<dl class="layui-nav-child">';
			for(var j=0;j<data[i].children.length;j++){
				data[i].children[j].icon = 'icon-text';
				ulHtml += '<dd><a href="javascript:;" data-url="'+data[i].children[j].href+'">';
				if(data[i].children[j].icon != undefined && data[i].children[j].icon != ''){
					if(data[i].children[j].icon.indexOf("icon-") != -1){
						ulHtml += '<i class="iconfont '+data[i].children[j].icon+'" data-icon="'+data[i].children[j].icon+'"></i>';
					}else{
						ulHtml += '<i class="layui-icon" data-icon="'+data[i].children[j].icon+'">'+data[i].children[j].icon+'</i>';
					}
				}
				ulHtml += '<cite>'+data[i].children[j].title+'</cite></a></dd>';
			}
			ulHtml += "</dl>"
		}else{
			ulHtml += '<a href="javascript:;" data-url="'+data[i].href+'">';
			
			if(data[i].icon != undefined && data[i].icon != ''){
				if(data[i].icon.indexOf("icon-") != -1){
					ulHtml += '<i class="iconfont '+data[i].icon+'" data-icon="'+data[i].icon+'"></i>';
				}else{
					ulHtml += '<i class="layui-icon" data-icon="'+data[i].icon+'">'+data[i].icon+'</i>';
				}
			}
			ulHtml += '<cite>'+data[i].title+'</cite></a>';
		}
		ulHtml += '</li>'
	}
	ulHtml += '</ul>';
	return ulHtml;
}

var $,tab,skyconsWeather;
layui.config({
	base : window.DIR+"public/js/admin/"
}).use(['bodyTab','form','element','layer','jquery'],function(){
	var form = layui.form(),
		layer = layui.layer,
		element = layui.element();
		$ = layui.jquery;
		tab = layui.bodyTab();

	//手机设备的简单适配
	var treeMobile = $('.site-tree-mobile'),
		shadeMobile = $('.site-mobile-shade')

	treeMobile.on('click', function(){
		$('body').addClass('site-mobile');
	});

	shadeMobile.on('click', function(){
		$('body').removeClass('site-mobile');
	});

	// 添加新窗口
	$(".layui-nav .layui-nav-item a").on("click",function(){
		tab.tabAdd($(this));

	})

	//公告层
	function showNotice(){
		layer.open({
	        type: 1,
	        title: "系统公告", //不显示标题栏
	        closeBtn: false,
	        area: '310px',
	        shade: 0.8,
	        id: 'LAY_layuipro', //设定一个id，防止重复弹出
	        btn: ['火速围观'],
	        moveType: 1, //拖拽模式，0或者1
	        content: '<div style="padding:15px 20px; text-align:justify; line-height: 22px; text-indent:2em;border-bottom:1px solid #e2e2e2;">'+
	        '<p>微熊科技正在加速改进中...</p>'+
	        '<p>8-27号更新 template.class->resource</p>'+
	        '<p>9-1号更新core.class->query, db.class</p>'+
	        '<p>期待中</p>'+
	        '<p>期待中</p>'+
	        '</div>',
	        success: function(layero){
				var btn = layero.find('.layui-layer-btn');
				btn.css('text-align', 'center');
				btn.on("click",function(){
					window.sessionStorage.setItem("showNotice","true");
				})
				if($(window).width() > 432){  //如果页面宽度不足以显示顶部“系统公告”按钮，则不提示
					btn.on("click",function(){
						layer.tips('系统公告', '#showNotice', {
							tips: 3
						});
					})
				}
	        }
	    });
	}
	//判断是否处于锁屏状态(如果关闭以后则未关闭浏览器之前不再显示)
	if(window.sessionStorage.getItem("lockcms") != "true" && window.sessionStorage.getItem("showNotice") != "true"){
		showNotice();
	}
	$(".showNotice").on("click",function(){
		showNotice();
	})

	//刷新后还原打开的窗口
	if(window.sessionStorage.getItem("menu") != null){
		menu = JSON.parse(window.sessionStorage.getItem("menu"));
		curmenu = window.sessionStorage.getItem("curmenu");
		var openTitle = '';
		for(var i=0;i<menu.length;i++){
			openTitle = '';
			if(menu[i].icon.split("-")[0] == 'icon'){
				openTitle += '<i class="iconfont '+menu[i].icon+'"></i>';
			}else{
				openTitle += '<i class="layui-icon">'+menu[i].icon+'</i>';
			}
			openTitle += '<cite>'+menu[i].title+'</cite>';
			openTitle += '<i class="layui-icon layui-unselect layui-tab-close" data-id="'+menu[i].layId+'">&#x1006;</i>';
			
			var dir = '/admin/';
			element.tabAdd("bodyTab",{
				title : openTitle,
		        content :"<iframe src='"+dir+menu[i].href+"' data-id='"+menu[i].layId+"'></frame>",
		        id : menu[i].layId
			});
			//定位到刷新前的窗口
			if(curmenu != "undefined"){
				if(curmenu == '' || curmenu == "null"){  //定位到后台首页
					element.tabChange("bodyTab",'');
				}else if(JSON.parse(curmenu).title == menu[i].title){  //定位到刷新前的页面
					element.tabChange("bodyTab",menu[i].layId);
				}
			}else{
				element.tabChange("bodyTab",menu[menu.length-1].layId);
			}
		}
	}

});

//捐赠弹窗
function donation(){
	layer.tab({
		area : ['260px', '367px'],
		tab : [{
			title : "微信",
			content : "<div style='padding:30px;overflow:hidden;background:#d2d0d0;'><img src='{$this->dir}/public/images/admin/wechat.jpg'></div>"
		},{
			title : "支付宝",
			content : "<div style='padding:30px;overflow:hidden;background:#d2d0d0;'><img src='{$this->dir}/public/images/admin/alipay.jpg'></div>"
		}]
	})
}
