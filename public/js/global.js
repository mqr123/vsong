if(typeof VSong == 'undefined')var VSong = {};
(function(root){
	"use strict";
	//Window
	root.self = typeof global === 'object'?global:(typeof self === 'object'?self:(window || {}));
	//Console
	root.self.console = root.self.console || {log:function(){},warn:function(){},error:function(){},info:function(){}};
	//Get function name
	if(typeof Function.prototype.getName != 'function'){
		Function.prototype.getName = function(){
			return this.name || this.toString().match(/function\s*([^(]*)\(/)[1];
		}
	}

	//对象合并
	root.merge = function(){
		for(var i = 1; i < arguments.length; i += 1){
			if(typeof arguments[i] === 'object'){
				for(var k in arguments[i])arguments[0][k] = arguments[i][k];
			}
		}
		return arguments[0];
	}
	//判断浏览器
	root.browser = (function(kie){
		var ua = root.self.navigator.userAgent;
		var obj = {pre:'',name:'unknow',version:0,platfrom:'unknow'};
		if(ua.indexOf("Opera")>-1){
			obj.pre = '-o-';
			obj.name = 'Opera';
			obj.version = ua.match(/Version\/([0-9\.]+)/)[1];
		}else if(ua.indexOf("Chrome")>-1){
			obj.pre = '-webkit-';
			obj.name = 'Chrome';
			obj.version = ua.match(/Chrome\/([0-9\.]+)/)[1];
		}else if((ua.indexOf("compatible") > -1 && ua.indexOf("MSIE") > -1 && ua.indexOf("Opera")==-1) || ua.indexOf("Trident") > -1){
			obj.pre = '-ms-';
			obj.name = 'MSIE';
			obj.version = ua.match(/MSIE ([0-9\.]+)/)[1];
			if(!obj.version)obj.version = ua.match(/rv:([0-9\.]+)\)/)[1];
		}else if(ua.indexOf("Firefox")>-1){
			obj.pre = '-moz-';
			obj.name = 'Firefox';
			obj.version = ua.match(/Firefox\/([0-9\.]+)/)[1];
		}else if(ua.indexOf("Safari")>-1){
			obj.pre = '-webkit-';
			obj.name = 'Safari';
			obj.version = ua.match(/Version\/([0-9\.]+)/)[1];
		}
		obj.version = parseFloat(obj.version);
		if(ua.indexOf("Android") > -1){
			obj.platfrom = 'Android';
		}else if(ua.indexOf("iPhone") > -1){
			obj.platfrom = 'iPhone';
		}else if(ua.indexOf('Windows Phone') > -1){
			obj.platfrom = 'WinPhone';
		}else if(ua.indexOf('Windows') > -1){
			obj.platfrom = 'Windows';
		}else if(ua.indexOf('Mac') > -1){
			obj.platfrom = 'Mac';
		}
		return obj;
	})();
	
	root.hasTouch = !!("ontouchstart" in root.self || root.self.DocumentTouch && document instanceof DocumentTouch);
	root.isURL=function(url){return /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/.test(url)};
	root.isNumeric=function(number){return /(0|^[1-9]\d*$)/.test(number)};
	root.isMobile=function(number){return /^(1[3-9]{1}[0-9]{9})$/.test(number)};
	root.isTel=function(tel){return /^(\(\d{3,4}\)|\d{3,4}-|\s)?\d{7,14}$/.test(tel)}
	root.isUsername=function(str){return /^([\u0391-\uFFE5]|\w|\d|_)+$/.test(str)};
	root.isRealname=function(str){return /^([\u0391-\uFFE5])+$/.test(str)};
	root.isMail=function(mail){return /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/.test(mail)};
	root.trim=function(str){if(typeof str !== 'string')str.toString();return str.replace(/(\s+)$/g, '').replace(/^\s+/g, '');};
	root.isIdCard=function(code){if (!code || !/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/.test(code))return false;if (code.length == 18){code=code.split('');var b=[7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2],c=[1, 0, 'X', 9, 8, 7, 6, 5, 4, 3, 2],d=0,e=0,f=0;for (var i=0; i < 17; i++){e=code[i];f=b[i];d += e * f;}var g=c[d % 11];if (g != code[17])return false;}return true;}
	root.replace=function(search, replace, str, regswitch){
		var regswitch = !regswitch ? 'ig' : regswitch;
		search.forEach(function(s,i){
			var re = new RegExp(s, regswitch);
			str=str.replace(re, typeof replace == 'string' ? replace : (replace[i] ? replace[i] : replace[0]));
		});
		search.splice(0,search.length);
		replace.splice(0,replace.length);
		search = replace = null;
		return str;
	};
	
	root.isDOM = function(obj){
		return (typeof HTMLElement !== 'function')?function(obj){

			return obj instanceof HTMLElement;
		}:function(obj){
			
			return obj && typeof obj === 'object' && obj.nodeType === 1 && typeof obj.nodeName === 'string';
		}
	}
	root.htmlSpecialChars=function(str){return root.replace(['&', '<', '>','"'], ['&amp;', '&lt;', '&gt;', '&quot;'], str)};
	root.addSlashes=function(str){return root.replace(['\\\\', '\\\'', '\\\/', '\\\(', '\\\)', '\\\[', '\\\]', '\\\{', '\\\}', '\\\^', '\\\$', '\\\?', '\\\.', '\\\*', '\\\+', '\\\|'], ['\\\\', '\\\'', '\\/', '\\(', '\\)', '\\[', '\\]', '\\{', '\\}', '\\^', '\\$', '\\?', '\\.', '\\*', '\\+', '\\|'], str)};
	root.isEditorDom = function(dom){return dom.localName == 'input' || dom.localName == 'textarea' || (dom.contentEditable && dom.contentEditable == 'true')}
	root.pathinfo=function(path){
		var obj = {};
		obj.basename = path.replace( /.+[\/\\]/ig,"" ).replace(/\?+([^\?\\]+)$/ig,"");
		obj.dirname = path.replace( /[^\/\\]+$/ig , "" ).replace(/\/+$/ig,"");
		obj.filename = obj.basename.replace( /\.[^.]+$/i , "" );
		obj.extension = obj.basename.replace( /.+[.]([^.\\\/]+)$/ig , "$1" );
		obj.fullname = obj.dirname + '/' + encodeURIComponent(obj.basename);
		return obj;
	};
	root.time=function(){return Math.floor(new Date().getTime() / 1000)};
	root.date=function(str,time){var now=new Date();if(time){now.setTime(time * 1000);}var Y=now.getFullYear(),y=now.getYear() - 100,m=now.getMonth() + 1,d=now.getDate(),H=h=now.getHours(),i=now.getMinutes(),s=now.getSeconds(),l='AM';if(h>12){h -= 12;l='PM';}var h=H>12?H-12:H;m=m < 10 ? '0' + m : m;d=d < 10 ? '0' + d : d;H=H < 10 ? '0' + H : H;h=h < 10 ? '0' + h : h;i=i < 10 ? '0' + i : i;s=s < 10 ? '0' + s : s;var res=!str ? Y + "-" + m + "-" + d + " " + H + ":" + i + ":" + s: root.replace(['Y','y','m','d','H','h','i','s'],[Y,y,m,d,H,h,i,s],str);return str.indexOf('h')!=-1?res+' '+l:res;};
	root.capslock = function(onlock,unlock){
		var locked = false,first;
		root.self.addEventListener('keydown',function(e){
			if(e.code.indexOf('Key') == 0 && !locked && ((!e.shiftKey && e.key == e.key.toUpperCase()) || (e.shiftKey && e.key == e.key.toLowerCase()))){
				locked = true;
				first = true;
				onlock && onlock.call(this,e);
			}else if(e.code == 'CapsLock'){
				if(locked){
					locked = false;
					unlock && unlock.call(this,e);
				}else if(first){
					locked = true;
					onlock && onlock.call(this,e);
				}
			}
		});
	}
	//全屏
	root.fullScreen = function(dom){
		var _this	= this, pre = root.browser.pre.replace(/-/g,'');
		var events	= function(e){
			dom.stats = dom.stats == 'full'?'normal':'full';
			document.body.setAttribute('screen',dom.stats);
		};
		dom = dom || document.body;
		dom.stats = 'normal';
		document.addEventListener("fullscreenchange", events);
		document.addEventListener(pre+"fullscreenchange", events);
		_this.action = function(full){
			if(full && dom.stats == 'normal'){
				dom.fullScreen = dom.requestFullscreen || dom[pre+'RequestFullScreen'];
				dom.fullScreen();
			}else{
				var key = (!document.cancelFullScreen?pre+'C':'c')+'ancelFullScreen';
				if(document[key]){
					document[key]();
				}
			}
		}
		_this.toggle = function(){
			return _this.action(dom.stats == 'normal'?true:false);
		}
		return _this;
	};

	//本地储存
	root.storage = function(pre){
		if(!localStorage)return;
		pre = pre || 'vs_';
		if(root.cookieConfig)pre = root.cookieConfig.pre;
		this.get = function(key){
			if(!key)return;
			var value = localStorage.getItem(pre + key);
			return value;
		}
		this.set = function(key,value){
			if(!key && !value)return;
			localStorage.setItem(pre+key,value);
			value = null;
			return this;
		};
		this.remove = function(key){
			if(!key)return;
			localStorage.removeItem(pre+key);
		};
		return this;
	}
	//请求
	root.request = function(options, checking){
		var opts = root.merge({
			data:null,
			async:false,
			dataType:'form',
			start:null,
			success:null,
			error:null
		},options);
		if(!opts.url)return;
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function(){
			if(xhr.readyState === 4){
				if(xhr.status === 200){
					if(opts.dataType == 'json'){
						if(xhr.responseText === '' && opts.error){
							opts.error && opts.error({type:'error',msg:'Not Data.'});
							return;
						}
						if(!opts.success)return;
						try{
							var data = JSON.parse(xhr.responseText);
							if(!checking)return opts.success(data);
							if(data.type == 'success'){
								return opts.success(data);
							}
							opts.error && opts.error(data);
						}catch(e){
							opts.error && opts.error({type:'error',msg:xhr.responseText||'内部错误',event:e});
						}	
					}else{
						opts.success && opts.success(xhr.responseText);
					}
				}else if(xhr.status === 404){
					opts.error && opts.error({type:'error',msg:'404 Not Found'});
				}
			}
		}
		opts.start && opts.start();
		xhr.upload.onprogress = options.progress || null;
		xhr.onerror = function(e){
			opts.error && opts.error({type:'error',msg:'Unknow.',event:e});
		}
		xhr.open(opts.data?'POST':'GET', opts.url);
		if(opts.dataType == 'pjax')xhr.setRequestHeader("X-PJAX", true);
		xhr.send(opts.data);
	}
	root.animation = function(callback){
		var _this = this;
		var request = requestAnimationFrame || mozRequestAnimationFrame || webkitRequestAnimationFrame;
		var cancel = cancelAnimationFrame || mozCancelAnimationFrame || webkitCancelAnimationFrame;
		var requestID = null;
		var startTime = Date.now();
		var animate = function(){
			callback.call(_this,{startTime:startTime,currentTime:Date.now()});
			requestID = request && request(animate);
		}
		animate();
		_this.cancel = function(){
			cancel(requestID);
			delete _this.cancel;
			delete _this.stop;
			_this = animate = request = cancel = requestID = callback = null;
		}
		_this.stop = function(callEnd){
			callEnd && callEnd();
			_this.cancel();
			callEnd = null;
		}
		return this;
	}
	root.timeout = function(time, change, callback){
		var total = time * 60, times = total;
		var animate = new root.animation(function(){
			times --;
			change && change.call(animate, Math.ceil(times / 60), times / total, times);
			if(times <= 0 && this.stop)this.stop(callback);
		});
	}
	root.dataUrlToBlob = function(data){
		var arr = data.split(','),mime = arr[0].match(/:(.*?);/)[1],base64 = root.self.atob(arr[1]), n = base64.length, u8arr = new Uint8Array(n);
		while (n--)u8arr[n] = base64.charCodeAt(n);
		return new Blob([u8arr], { type: mime });
    }
    root.blobToDataUrl = function(blob, callback){
		var reader = new FileReader();
		reader.onload = function (e){callback(e.target.result);}
		reader.readAsDataURL(blob);
    }
	root.base64 = (function(){
		var str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
		function buffer(input) {
			var bytes = Math.ceil( (3*input.length) / 4.0);
			var ab = new ArrayBuffer(bytes);
			decode(input, ab);
			return ab;
		};
		function decode(input, arrayBuffer) {
			var lkey1 = str.indexOf(input.charAt(input.length-1));		 
			var lkey2 = str.indexOf(input.charAt(input.length-1));		 
			var bytes = Math.ceil( (3*input.length) / 4.0);
			if (lkey1 == 64) bytes--; //padding chars, so skip
			if (lkey2 == 64) bytes--; //padding chars, so skip
			var uarray;
			var chr1, chr2, chr3;
			var enc1, enc2, enc3, enc4;
			var i = 0;
			var j = 0;
			if (arrayBuffer)uarray = new Uint8Array(arrayBuffer);
			else uarray = new Uint8Array(bytes);
			input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
			for (i=0; i<bytes; i+=3) {	
				enc1 = str.indexOf(input.charAt(j++));
				enc2 = str.indexOf(input.charAt(j++));
				enc3 = str.indexOf(input.charAt(j++));
				enc4 = str.indexOf(input.charAt(j++));
				chr1 = (enc1 << 2) | (enc2 >> 4);
				chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
				chr3 = ((enc3 & 3) << 6) | enc4;
				uarray[i] = chr1;			
				if (enc3 != 64) uarray[i+1] = chr2;
				if (enc4 != 64) uarray[i+2] = chr3;
			}
			return uarray;	
		}
		return {
			decode:decode,
			buffer:buffer
		};
	})();
})(VSong);