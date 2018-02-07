/*
 * @ dom
 * @ update: 2017-09-05
 */
if (typeof VSong == "undefined") var VSong = {};
(function(root) {
	"use strict";
	if(typeof root.hasTouch === 'undefined'){
		root.hasTouch = !!("ontouchstart" in self || self.DocumentTouch && document instanceof DocumentTouch);
	}
	var click = root.hasTouch?'touchstart':'click';
	function DOM(str,parentObj){
		var dom,arr = [];
		if(typeof str === 'object'){
			if(str instanceof Array)arr = str;
			else if(root.isDOM(str))arr.push(str);
			return arr;
		}
		dom = (parentObj||document).querySelectorAll(str);
		for(var i=0;i<dom.length;i+=1)arr[i] = dom[i];
		return arr;
	}
	function selector(str, parentObj){
		var _this = this;
		_this.DOM = DOM(str,parentObj);
		['html,innerHTML','text,textContent','val,value'].forEach(function(arr){
			arr = arr.split(',');
			_this[arr[0]] = function(v){
				if(typeof v === 'undefined' && _this.DOM[0])return _this.DOM[0][arr[1]];
				_this.DOM.forEach(function(dom){dom[arr[1]] = v});
				return _this;
			}
		});
		['add','remove','toggle'].forEach(function(k){
			_this[k+'Class'] = function(name){
				_this.DOM.forEach(function(dom){
					name.split(' ').forEach(function(n){
						dom.classList[k](n)
					});
				});
				return _this;
			}
		});
		return _this;
	}
	selector.prototype.each = function(callback){
		callback && this.DOM.forEach(callback);
		return this;
	}
	selector.prototype.hasClass = function(className){
		if(this.DOM[0])return this.DOM[0].classList.contains(className);
		return false;
	}
	selector.prototype.prepend = function(data){
		if(typeof data === 'string')data = document.createTextNode(data);
		this.DOM.forEach(function(dom){
			if(dom.hasChildNodes()){
				dom.insertBefore(data, dom.firstChild); 
			}else{ 
				dom.appendChild(data);
			} 
		});
		return this;
	}
	selector.prototype.append = function(data){
		this.DOM.forEach(function(dom){
			if(typeof data === 'string'){
				dom.innerHTML += data;
			}else if(root.isDOM(data)){
				dom.appendChild(data);
			}
		});
		return this;
	}
	selector.prototype.duration = function(time){
		this.DOM.forEach(function(dom){
			dom.style.transitionDuration= time + 's';
			if(root.browser.pre != ''){
				dom.style[root.browser.pre.replace(/-/g,'')+'TransitionDuration'] = time + 's';
			}
		});
		return this;
	}
	function stylePx(key,value){
		if(typeof value === 'number' && [
			'width','height','lineHeight','top','right','button','left',
			'marginTop','marginRight','marginBottom','marginLeft',
			'paddingTop','paddingRight','paddingBottom','paddingLeft'
		].indexOf(key)!=-1){
			value += 'px';
		}
		return value;
	}
	selector.prototype.css = function(key, value, attr){
		if((typeof value === 'undefined' || value === null) && typeof key === 'string'){
			if(window.getComputedStyle){
				return window.getComputedStyle(this.DOM[0],attr || null).getPropertyValue(key);
			}
			return this.DOM[0].style.getPropertyValue(key);
		}
		this.DOM.forEach(function(dom){
			if(typeof key === 'object'){
				for(var k in key)dom.style[k] = stylePx(k,key[k]);
			}else{
				dom.style[key] = stylePx(key,value);
			}
		});
		return this;
	}
	selector.prototype.on = function(type, target, callback){
		if(typeof target === 'function'){
			callback = target;
			target = null;
		}
		if(!callback)return this;
		this.DOM.forEach(function(dom){
			dom.addEventListener(type, function(e){
				if(target){
					var targets = DOM(target,dom);
					if(targets.length>0){
						e.path.forEach(function(elm,index){
							for(var i=0;i<targets.length;i+=1){
								if(targets[i] === elm)callback.call(elm,e);
							}
						});
					}
				}else{
					callback.call(this,e);
				}
			});
		});
		return this;
	};
	selector.prototype.off = function(type, callback){
		this.DOM.forEach(function(dom){
			dom.removeEventListener(type, callback)
		});
		return this;
	};
	selector.prototype.remove = function(){
		this.DOM.forEach(function(dom){
			var parents = dom.parentNode || document.body;
			parents.removeChild(dom);
		});
		return this;
	};
	selector.prototype.transform = function(value,attr){
		if(!value)return this.css('transform',null,attr);
		return this.each(function(dom){
			if(root.browser.pre != ''){
				dom.style[root.browser.pre.replace(/-/g,'')+'Transform'] = value;
			}
			dom.style['transform'] = value;
		});
	}
	selector.prototype.click = function(target, callback){
		if(!target && !callback){
			this.DOM.forEach(function(dom){dom.click()});
			return this;
		}
		if(typeof target === 'function'){
			callback = target;
			target = null;
		}
		var handle = function(e){
			if(e.type == 'touchstart'){
				var touchend = function(ev){
					if(ev.cancelable && callback){
						ev.preventDefault();
						callback.call(this,ev);
					}
					this.removeEventListener(ev.type,touchend);
				}
				this.addEventListener('touchend', touchend);
			}else{
				callback.call(this, e);
			}
		}
		if(!target)return this.on(click, handle);
		return this.on(click, target, handle);
	};

	selector.prototype.select = function(){
		if(this.DOM.length==0)return this;
		this.DOM[0].select && this.DOM[0].select();
		return this;
	}
	selector.prototype.focus = function(){
		if(this.DOM.length==0)return this;
		this.DOM[0].focus && this.DOM[0].focus();
		return this;
	}
	selector.prototype.find = function(str){return $(str, this.DOM[0])}
	selector.prototype.attr = function(name, value){
		if(!name)return;
		if(typeof name === 'object'){
			this.DOM.forEach(function(dom){for(var k in name)dom.setAttribute(k,name[k])});
		}else if(typeof value === 'undefined' && this.DOM[0])return this.DOM[0].getAttribute(name);
		else this.DOM.forEach(function(dom){dom.setAttribute(name,value)});
		return this;
	}
	selector.prototype.removeAttr = function(name){
		if(!name)return;
		this.DOM.forEach(function(dom){name.split(' ').forEach(function(n){dom.removeAttribute(n)})});
		return this;
	}
	selector.prototype.data = function(name, value){
		if(!this.DOM[0])return this;
		if (typeof value === "undefined"){
			if (this.DOM[0].customData && name in this.DOM[0].customData)return this.DOM[0].customData[name];
			var key = this.DOM[0].getAttribute("data-" + name);
			if(key)return key;
			return undefined;
		}else{
			this.DOM.forEach(function(dom){
				if (!dom.customData)dom.customData = {};
				dom.customData[name] = value;
			});
			return this;
		}
	}
	selector.prototype.form = function(obj){
		var form = this.DOM[0];
		var check = null;
		if(obj.check){check = obj.check;delete obj.check;}
		if(form && form.length > 0 && form.tagName === 'FORM'){
			var o= {data:{}};
			if(root.merge)root.merge(o,obj);
			else for(var k in obj)o[k]=obj[k];
			if(form.action)o.url = form.action;
			for(var i=0;i<form.length;i+=1){
				if(form[i].name){
					o.data[form[i].name] = form[i].value;
				}
			}
			if(check && typeof check === 'function' && check.call(form,o.data)){
				if(o.data)o.data = JSON.stringify(o.data);
				return o.data && obj.auto === true && root.request?root.request(o,true):o;
			}
			return o;
		}
		return null;
	}
	
	selector.prototype.sms = function(code,phone,url){
		var dom = this.DOM[0],arr = code.split(',');
		if(dom.disabled || !arr[1] || arr[1] != root.ecode || !root.alert)return;

		if(!phone || !root.isMobile(phone.value)){
			root.alert('手机号码不正确.',3,phone && function(){$(phone).focus()});
			return;	
		}
		dom.disabled = true;
		var ntime = root.time();
		var ltime = parseInt(root.storage.get('sms_timer'));
		var times = 60;
		var isTime = false;
		if(ntime - ltime>0 && ltime){
			times = ntime - ltime;
			isTime = true;
		}
		if(times>60){
			root.storage.remove('sms_timer');
			times = 60;
			isTime = false;
		}
		var stoper = false;
		root.timeout(times, function(time){
			if(stoper){
				dom.disabled = false;
				dom.textContent = '重发';
				root.storage.remove('sms_timer');
				this.stop();
			}else{
				root.storage.set('sms_timer',root.time()-time);
				dom.innerHTML = '<font class="color">'+time + '<i>s</i></font>';
			}
		},function(){
			dom.disabled = false;
			root.storage.remove('sms_timer');
			dom.textContent = '重发';
		});

		if(isTime)return;

		root.request({
			url:url,dataType:'json',
			data:JSON.stringify({formhash:arr[0],ip:arr[2],phone:phone.value}),
			success:function(json){
				if(typeof root.storage === 'function')root.storage = root.storage();
				root.storage.set('sms_timer',root.time()-60);
				root.alert(this.dataType == 'form'?json:(json.msg || '短信发送成功.'),30,function(){dom.disabled = null;});
			},
			error:function(e){
				console.log(e,'color:red');
				root.storage.remove('sms_timer');
				root.alert(e.msg || '短信发送失败.',3,function(){dom.disabled = null;});
				stoper = true;
			}
		});
		return this;
	}
	
	root.dom = root.self.$ = function(str, p){return new selector(str, p)};
	if(root.request)root.self.$.ajax = root.request;
	
	root.windows = function(url,title,params){
		if(!url || (url.indexOf('//')>4 && url.split('//')[1].indexOf(document.domain)==-1))return;
		var windows = document.createElement('div');
		var frame = document.createElement('iframe');
		var container = root.dom(root.windowsContainerSelector || '#container').DOM[0] || window.top.document.body;
		frame.src = url;
		frame.frameborder = 0;
		frame.scrolling = 'none';
		windows.className = 'fxd full windows';
		windows.appendChild(frame);
		document.body.removeAttribute('stats');
		container.innerHTML = '';
		container.appendChild(windows);
		frame.onload = function(){
			windows.classList.add('ready');
			if(frame.contentWindow.initVSongWindows){
				if(params)root.merge(frame.contentWindow,params);
				frame.contentWindow.initVSongWindows.call(windows,root,function(str){return root.dom(str,frame.contentWindow.document.body)});
				frame.contentWindow.oncontextmenu = function(){return false;}
			}else{
				root.ready && root.ready();
			}
		}
	}
})(VSong);