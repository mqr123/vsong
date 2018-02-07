/*
 * @ pjax
 * @ update: 2017-09-05
 */
 if (typeof VSong == "undefined") var VSong = {};
;(function(root) {
	"use strict";
	if(!root.dom)return;
	var $body = root.body || $(document.body);
	var state = {
		title: document.title,
		url:document.URL
	}
	var options = {
		selector:'.pjax',
		container:'body',
		titleSuffix: ' - VSong.TV',
		start:null,
		complete:null,
		error:null
	};
	var request = function(opts, isPop){
		options.start && options.start();
		root.request({
			url:opts.url,
			dataType:'pjax',
			success:function(data){
				$(opts.container || options.container).html(data);
				if(!isPop){
					state = root.merge(state,{title:opts.title,url:opts.url});
					root.self.history.pushState(state, opts.title, opts.url);
				}else{
					root.self.history.replaceState({}, opts.title, opts.url);
				}
				options.complete && options.complete();
			},
			error:options.error || function(data){console.log(data)}
		});
	}
	root.resetFrames = function(doc){
		$('link[resource="css"]').each(function(dom) {
			var link = document.createElement('link');
			link.rel = 'stylesheet';
			link.href = dom.href;
			doc.getElementsByTagName('head')[0].appendChild(link);
		});
		doc.body.style.background = 'none';
	}
	root.pjax = function(option){
		var _this = this;
		options = root.merge(options,option);
		state.container = options.container;
		$body.click(options.selector+(options.alwaysToSelf?',a[target="_blank"]':''),function(e){
			e.preventDefault();
			var url = this.href || this.getAttribute('url');
			var title = this.textContent || this.title;
			//if(url === location.href)return false;
			var slt = options.selection && options.selection.call(this,e);
			if(!url || slt)return true;
			if(this.target == '_blank' && root.windows)return root.windows(url,title);//
			root.self.history.replaceState(state, title, url);
			_this.reload(url, title);
			return false;	
		});
		return this;
	}

	root.pjax.prototype.reload = function(url, opts){
		var _this = this, o = {url:url || document.URL,title:document.title,container:state.container};
		if(typeof opts === 'string'){
			o.title = opts;
		}else{
			o = root.merge(o,opts);
		}
		if(o.title.indexOf(o.titleSuffix)==-1)o.title +=  options.titleSuffix;
		document.title = o.title;
		request(o);
	}

	var isPop = ('state' in window.history), orgUrl = location.href;
	window.addEventListener('popstate', function(e) {
		var isInit = !isPop && location.href == orgUrl;
		isPop = true;
		if (isInit)return;
		if(e.state && e.state.container){
			document.title = e.state.title;
			request(e.state,1);
		}
	});
})(VSong);