if(typeof VSong == 'undefined')var VSong = {};
(function(root){
	"use strict";
	var INDEX = 100000;
	var LENTH = 0;
	var MASK = document.createElement('div');
	MASK.className = 'fxd full vBox-mask bgc-dark';

	function createWindows(options, parents){
		var type = options.type === 'confirm'?'confirm':'alert';
		var box = document.createElement('div');
		box.className = 'vBox fxd';
		box.setAttribute('type',type);
		box.innerHTML = 
			'<div class="vBox-head"><span class="vBox-title vs-font">'+options.title+'</span><a tabindex="2" class="vBox-close btn"></a></div>'+
			'<div class="vBox-main"><div class="vBox-cont">'+
			(!options.smile?'<h3 class="vBox-cont-title hello" align="center"><i class="icon icon-hello"></i></h3>':'<i class="icon smile-'+options.smile+'" size="72"></i>')+
			options.content+'</div></div>'+
			'<div class="vBox-foot"><a class="vBox-confirm btn vs-font" tabindex="1"><span>'+options.buttonText+'</span></a></div>'
		if(LENTH <= 0){
			LENTH = 0;
			parents.appendChild(MASK);
			document.body.setAttribute('box',1);
		}
		LENTH += 1;
		parents.appendChild(box);
		var dom = {
			root:box,
			head:box.childNodes[0],
			main:box.childNodes[1],
			foot:box.childNodes[2]
		}
		box.style.zIndex = INDEX + LENTH;
		MASK.style.zIndex = box.style.zIndex;
		dom.title = dom.head.childNodes[0];
		dom.close = dom.head.childNodes[1];
		dom.cont = dom.main.childNodes[0];
		dom.confirm = dom.foot.childNodes[0];
		return dom;
	}
	function amount(n){
		if(root.isNumeric(n))return n + 'px';
		if(n.substr(n.length-1,1) == '%')return n;
		return 'auto';
	}
	root.box = function(options, parents){
		var _this = this;
		_this.options = root.merge({
			type:'alert',
			auto:true,
			title:'系统提示',
			content:'',
			buttonText:'好的',
			timeout:null,
			smile:null,
			close:null,
			width:null,
			height:null,
			confirm:null
		},options);
		_this.parents = parents || document.body;
		if(_this.options.confirm)_this.options.type = 'confirm';
		var dom = createWindows(_this.options, _this.parents);	
		dom.root.style.zIndex = INDEX + LENTH;
		if(_this.options.auto === true && !_this.options.width  && !_this.options.height){
			dom.root.classList.add('auto');
		}else{
			var rect = dom.root.getBoundingClientRect();
			if(_this.options.width)dom.main.style.width = amount(_this.options.width);
			if(_this.options.height)dom.main.style.height = amount(_this.options.height);
			if(root.browser){
				var pre = root.browser.pre.replace(/-/g,'');
				dom.root.style[(pre!=''?pre+'T':'t')+'ransform'] = 'scale(1)'+
					'translateX(-'+(rect.width/2 + _this.options.width / 4)+'px) '+
					'translateY(-'+(rect.height/2 + _this.options.height / 3)+'px)';
			}else{
				dom.root.style.margin = '-'+(rect.height/2 + _this.options.height / 3)+'px auto auto -'+(rect.width/2 + _this.options.width / 4)+'px';
			}
			dom.root.classList.add('noanim');
		}
		dom.close.addEventListener('click',function(){
			if(dom.close.closed)return;
			dom.close.closed = true;
			_this.close && _this.close.call(_this);
		});
		if(_this.options.type === 'confirm'){
			dom.confirm.addEventListener('click',function(){
				if(typeof _this.options.confirm === 'function'){
					_this.options.confirm.call(_this);
				}else{
					_this.close && _this.close.call(_this);
				}
			});
		}
		dom.root.classList.add('show');
		_this.DOM = dom;
		if(_this.options.timeout){
			_this.anim = new root.timeout(_this.options.timeout,null,function(){
				if(!_this.anim)return;	
				_this.close && _this.close.call(_this);
			});
		}
		return _this;
	}
	root.box.prototype.close = function(callback){
		var _this = this;
		if(_this.anim)_this.anim = null;
		var anim = root.timeout(0.3,null,function(){
			if(typeof _this.options.close === 'function')_this.options.close();
			for(var k in _this.options)delete _this.options[k];
			try{_this.parents.removeChild(_this.DOM.root)}catch(e){};
			LENTH -=1;
			MASK.style.zIndex = INDEX + LENTH - 1;
			if($('.vBox').DOM.length <= 0){
				LENTH = 0;
				document.body.removeAttribute('box');
				try{_this.parents.removeChild(MASK);}catch(e){};
			}
			delete _this.DOM;
			callback && callback();
			callback = _this = anim = null;
		});
		_this.DOM.root.classList.add('closed');
	}
	root.boxClear = function(){
		INDEX = 100000;
		LENTH = 0;
		var boxs = document.querySelectorAll('.vBox,.vBox-mask');
		for(var i=0;i<boxs.length;i+=1){
			var parents = boxs[i].parentNode || document.body;
			parents.removeChild(boxs[i]);
		}
		document.body.removeAttribute('box');
		boxs = null;
	}
})(VSong);