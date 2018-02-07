if(typeof VSong != 'object')var VSong = {};
;(function(root){
	"use strict";
	if(typeof root != 'object')return;
	var exists = function(str, list){
		for(var i=0;i<list.length;i+=1){
			if(str && str.toLowerCase().indexOf(list[i].toLowerCase())!=-1)return true;
		}
	}
	var filter = function(event, arr, callback){
		var m = event || event.port;
		if(arr.length > 0 ){
			if(!exists(m.name, arr)){callback(event);}
		}else{
			callback(event);
		}
	}
	root.MIDI = function(options){
		var _this		= this;
		var opts		= typeof options == 'object' ? options : {};
		_this.filter	= options.filter || [];
		_this.error		= opts.error	|| function(){};
		_this.before	= opts.before	|| function(){};
		_this.success	= opts.success	|| function(){};
		_this.change	= opts.change	|| function(){};
		_this.on		= opts.on		|| function(){};
		_this.off		= opts.off		|| function(){};
		_this.size		= 0;
		_this.access	= null;
		return this;	
	};
	root.MIDI.prototype.init = function(){
		var _this = this;_this.size = 0;
		_this.before();
		if(!navigator.requestMIDIAccess){
			_this.error(0);
			return this;
		}
		if(_this.access){
			_this.access.onstatechange = null;
			_this.access.inputs.forEach(function(e){
				e.onmidimessage = null;
				e.onstatechange = null;
			});
			delete _this.access;
			_this.access = null;
		}
		navigator.requestMIDIAccess({sysex:false}).then(function(access){
			//console.log(access);
			access.onstatechange = function(event){
				filter(event, _this.filter, _this.change);
			}
			access.inputs.forEach(function(port){
				filter(port, _this.filter, function(p){
					_this.size += 1;
					p.onmidimessage = function(e){
						if(e.data[2] > 0 && (e.data[0] == 153 || e.data[0] == 157)){
							if(port.convert){e.data[1] = port.convert(e.data[1]);}
							e.keyCode = e.data[1];
							e.intensity = e.data[2];
							switch (e.data[0]){
								case 153:_this.on(e);break;
								case 157:_this.off(e);break;
							}
						}
					};
				});
			});
			_this.success(access);
			_this.access = access;
		},_this.error);
		return this;
	}
})(VSong);