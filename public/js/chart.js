if(typeof VSong === 'undefined')var VSong = new Object();
;(function(root){
	"use strict";
	if(!root.isDOM){
		root.isDOM = function(obj){
			return (typeof HTMLElement !== 'function')?function(obj){
				return obj instanceof HTMLElement;
			}:function(obj){
				return obj && typeof obj === 'object' && obj.nodeType === 1 && typeof obj.nodeName === 'string';
			}
		}
	}
	function selectors(str,parents){
		var arr = [];
		if(typeof str == 'object' && str.length)arr = str;
		else if(typeof str == 'string'){
			var dom = (parents || document).querySelectorAll(str);
			for(var i=0;i<dom.length;i+=1)arr.push(dom[i]);
		}else if(root.isDOM(str))arr.push(str);
		return arr;
	}
	function createArc(ctx,x,y,r,clr,bg){
		ctx.beginPath();
		ctx.arc(x, y, r, 0, Math.PI * 2);
		if(bg){
			ctx.fillStyle = bg;
			ctx.fill();
		}
		if(clr)ctx.strokeStyle = clr;
		ctx.stroke();
	}
	function showArcData(ctx,list,s, fc, fs, bc,bgc){
		var k = s - s * 0.2, n = s - fs;
		list.forEach(function(obj,i){
			var m = (Math.PI * 2) / list.length * i;
			var x = Math.sin(m) * k + s;
			var y = Math.cos(m) * k + s;
			createLine(ctx, s, s, x, y, 'rgba(0,0,0,.08)');
			createArc(ctx, x, y, 5, 'transparent', obj.color);
			createFont(ctx, obj.text || '', fc, Math.sin(m) * n + s, Math.cos(m) * n + s, fs);
		});
		var first = [0,0];
		ctx.beginPath();
		list.forEach(function(obj,i){
			var v = obj.value / (obj.max || 100);
			var m = (Math.PI * 2) / list.length * i;
			var x = Math.sin(m) * (k*v) + s;
			var y = Math.cos(m) * (k*v) + s;
			if(i == 0)first = [x,y];
			ctx.lineTo( x, y);
		});
		ctx.lineTo( first[0], first[1]);
		ctx.fillStyle = bgc;
		ctx.fill();
		ctx.strokeStyle = bc;
		ctx.stroke();
		ctx = null;
	}
	function createLG(ctx, x, y, s, h, start, end){
		var grd = ctx.createLinearGradient(0,y,0, h);
		grd.addColorStop(0, start || "#00a09d");
		grd.addColorStop(1,end || "rgba(0,180,170,0.02)");
		ctx.beginPath();
		ctx.fillStyle = grd;
		ctx.fillRect(x,y,s,h-y);
		ctx.stroke();
	}
	function createLine(ctx,x1,y1,x2,y2,clr){
		ctx.beginPath();
		ctx.moveTo(x1,y1);
		ctx.lineTo(x2,y2);
		if(clr)ctx.strokeStyle = clr;
		ctx.stroke();
	}
	function createFont(ctx,txt,clr,x,y,size,font){
		size = size || 12;
		ctx.beginPath();
		ctx.font = font || size+"px Microsoft Yahei";
		if(clr)ctx.fillStyle = clr;
		ctx.fillText(txt, x - size * txt.length / 2, y);
		ctx.stroke();
	}
	
	root.chart = function(selector, datas, error){
		var _this = this;
		//_this.update = [];
		_this.DOM = selectors(selector || '.vs-chart');
		_this.DOM.forEach(function(dom,index){
			var type = dom.getAttribute('type') || 'pane';
			var func = _this[type+'Chart'];
			if(typeof func === 'function'){
				var canvas = document.createElement('canvas');
				if(!canvas.getContext){
					if(typeof error === 'function')error();
					else dom.innerHTML = '您的浏览器不支持';
					return;
				}
				//_this.update.push(function(){func(canvas,selectors('option',dom),dom,index)});
				canvas.draggable = false;
				func(canvas,selectors('option',dom),dom,datas,index);
			}
		});
		//window.addEventListener('resize',function(){_this.update.forEach(function(render){render()})});
		return this;
	}
	root.chart.prototype.attrChart = function(canvas,options,dom, datas, index){
		var data = datas || [];
		if(!datas){
			options.forEach(function(option){
				var d = {text:option.textContent,value:parseFloat(option.value),max:parseFloat(option.getAttribute('max'))};
				var c = option.getAttribute('color');
				d.color = c || 'rgba(0,180,170,.5)';
				data.push(d);
				option.parentNode.removeChild(option);
			});
		}
		dom.innerHTML = '';
		dom.appendChild(canvas);
		var size = Math.min(dom.offsetWidth, dom.offsetHeight);
		var ctx = canvas.getContext('2d');
		var fc = dom.getAttribute('color') || 'rgba(0,0,0,.5)';
		var fs = parseInt(dom.getAttribute('font-size') || 13);
		var bc = dom.getAttribute('border-color') || 'rgba(0,180,170,.5)';
		var bgc = dom.getAttribute('background-color') || 'rgba(0,180,170,.2)';
		var s = size/2;
		canvas.width = size;
		canvas.height = size;
		for(var i=0,l=5;i<l;i+=1)createArc(ctx, s, s, s - (i+1) * (s / l) ,'rgba(0,0,0,'+(i==0?'.13':'.08')+')');
		showArcData(ctx, data, s, fc, fs, bc, bgc);
		canvas = null;
	}
	root.chart.prototype.paneChart = function(canvas,options,dom, datas, index){
		var data = datas || [];
		if(!datas){
			options.forEach(function(option){
				data.push({text:option.textContent,value:parseFloat(option.value)});
				option.parentNode.removeChild(option);
			});
		}
		dom.innerHTML = '';
		dom.appendChild(canvas);
		var width = dom.offsetWidth, height= dom.offsetHeight;
		var ctx = canvas.getContext('2d');
		var fc = dom.getAttribute('color') || '#00a09d';
		var fs = parseInt(dom.getAttribute('font-size') || 13);
		var bc = dom.getAttribute('border-color') || 'rgba(0,0,0,.3)';
		var left = parseInt(dom.getAttribute('left') || 50);
		var bottom = parseInt(dom.getAttribute('left') || 30);
		var max = parseInt(dom.getAttribute('max') || 100);
		var step = parseInt(dom.getAttribute('step') || 20);
		var length = parseInt(dom.getAttribute('length') || 24);
		var w = width - left, h = height - bottom;
		var dc = 'rgba(0,0,0,.08)';
		canvas.width = width;
		canvas.height = height;

		createLine(ctx, left, 0, left, h, bc);
		createLine(ctx, left, h, w, h, bc);
		var stepOne = 0;
		var ft = "12px Microsoft Yahei";
		for(var hi = 0, horizon = 12; hi < horizon; hi += 1){
			stepOne = h / horizon;
			var hy = stepOne * hi;
			createLine(ctx, left, hy, w, hy, 'rgba(0,0,0,'+(hi%2 ==0?'0.1':'0.04')+')');
		}
		var xOne = 0;
		for(var pi = 0, portrait = length; pi < portrait; pi += 1){
			xOne = (w-left) / portrait;
			var px = (w-left) / portrait * (pi+1) + left;
			createLine(ctx, px , 0, px, h, dc);
			ctx.beginPath();
			ctx.font = ft;
			ctx.fillStyle = 'rgba(0,0,0,.4)';

			ctx.fillText((pi<10?'0'+pi:pi), px - 6 - xOne, h + 14);
			ctx.stroke();
		}
		step = max / 100 * step;
		for(var a = 0, len = Math.floor(max / step); a < len; a += 1){
			ctx.beginPath();
			ctx.font = ft;
			ctx.fillStyle = 'rgba(0,0,0,.4)';
			ctx.fillText(Math.floor(step * (a + 1)), 0, h - (a+1) * stepOne * 2 + 4);
			ctx.stroke();
		}
		ctx.beginPath();
		ctx.fillStyle = fc;
		ctx.fillText(dom.getAttribute('tip-x') || 'Value', 0, 12);
		ctx.fillText(dom.getAttribute('tip-y') || 'Key', 0, h + 14);
		ctx.stroke();
		var arc = dom.getAttribute('arc');
		var ny = stepOne * 2;
		var nh = stepOne * 10 + ny;
		var s = max / (nh-ny);
		data.forEach(function(obj){
			obj.value = obj.value * step / 20;
			obj.value > max?max:obj.value;
			var arr = obj.text.split(':');
			var tx = parseInt(arr[0]) * xOne + left + (arr[1]?parseInt(arr[1]) / 60 * xOne:0);
			var score = 100 / max * obj.value;
			var color = ['#00a09d','rgba(0,180,170,.1)'];
			/*if(score>max)score = max;
			else */if(score<0)score = 0;
			var y = (max-score) / s + ny;
			//y = y / step;
			if(score>=80)color = ['rgba(0,150,30,.75)','rgba(0,180,0,.1)'];
			else if(score<60)color = ['#f30','rgba(200,150,0,.1)'];
			createLG(ctx, tx, arc?y+1:y, arc?3:6, nh, color[0], color[1]);
			if(arc)createArc(ctx, tx+1.5, y-1, 3, color[0], color[0]);

		});
		canvas = null;
	}
	root.loadChart = function(options){
		if(typeof options !== 'object')return;
		if(options.length){
			var data = options;
			options = {data:data}
		}
		if(typeof options.data !== 'object' || !options.data.length || options.data.length == 0)return;
		var target = options.target || document.body;
		var type = options.type || 'pane';
		var dom = document.createElement('div');
		dom.setAttribute('type',type);
		dom.setAttribute('max',options.max || options.data.length);
		if(options.config){
			for(var k in options.config){
				var key = k.replace(/([A-Z])/,'-$1').toLowerCase();
				dom.setAttribute(key,options.config[k]);
			}
		}
		if(options.height)dom.style.height = options.height + 'px';
		if(options.width)dom.style.width = options.width + 'px';
		if(options.class){
			options.class.split(' ').forEach(function(n){
				dom.classList.add(n);
			});
		}
		if(options.click){
			dom.addEventListener('click',options.click);
		}
		selectors(target)[0].appendChild(dom);
		return new root.chart(dom,options.data,options.error);
	}
})(VSong);