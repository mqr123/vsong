VSong.modules = {
	__construct: function(root, pjax) {
		root.urls = root.getUrlParams();
		root.mod = root.urls[1] || 'home';
		root.page = root.urls[2] || 'index';
		//导航高亮
		root.body.click('header nav>a.btn.pjax', function() {
			$('header nav>a.btn.pjax').removeClass('open');
			$(this).addClass('open');
		})
		var func = this[root.mod + '_' + root.page];
		if(typeof func === 'function') func(root, pjax);
		root.body.addClass('ready').attr({
			mod: root.mod,
			page: root.page
		});
		root.ready();
	},
	home_index: function(root) {
		//轮播图高度
		$('.scroll_show').addClass('open');

		var resetCover = function() {
			var width = window.innerWidth;
			var height = width * 0.4;
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
	},
	home_about:function(root){
		root.params = root.urls[3];
		if(root.params!='contact'){
			root.params = (root.params).split('-')[0];
		}
//		contact-10000
//		console.log(root);
		function loadBMap(callback){
			if(window.BMap){
				callback(BMap);
				return;
			}
			var js = document.createElement("script");
			js.src = "http://api.map.baidu.com/getscript?v=1.2";
			document.body.appendChild(js);
			root.timeout(5,function(){
				if(window.BMap){
					callback(BMap);
					this.stop();
				}
			});
			document.body.removeChild(js);
		}
		if(root.params=='contact'){
			var address = $('.mapStr').text();
			loadBMap(function(bmap) {
				var zoom = 16;
				var map = new bmap.Map("map"); // 创建Map实例
				map.enableScrollWheelZoom(true); //开启鼠标滚轮缩放
				var myGeo = new bmap.Geocoder();
				// 将地址解析结果显示在地图上,并调整地图视野
				myGeo.getPoint(address, function(point) {
					if(point) {
						map.centerAndZoom(point, zoom);
						map.addOverlay(new bmap.Marker(point));
					}
				}, "陕西省");
			});	
		}
	}

}