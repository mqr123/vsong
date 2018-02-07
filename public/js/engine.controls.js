;(function(root){

	root.getMidiFilter = function(){
		if(typeof root.storage === 'function')root.storage = root.storage();
		var value = root.storage.get('midi_filter');
		return value?value.split(','):[];
	}
	var midi;
	var convertKey = function(k){
		var key = 0;
		switch(k){
			case 65:
			case 32:key = 36;break;//底鼓
			case 83:
			case 68:key = 38;break;//军鼓
			case 72:
			case 74:
			case 66:key = 42;break;//踩镲
			case 75:
			case 85:key = 46; break;//开嚓
			case 89:key = 49; break;//强音镲
			case 87:key = 48; break;//高音桶鼓
			case 69:key = 47; break;//中音通鼓
			case 70:key = 43; break;//低音桶鼓
			case 82:
			case 73:key = 51;break;//叮叮镲
		};
		return key;
	}
	// 初始化控制器
	root.controls = function(options){
		options = root.merge({
			self:window,
			before:null,
			success:null,
			change:null,
			on:null,
			off:null,
			error:null
		},options);
		var noteOn = function(e){
			if(midi.disabled)return;
			var on = midi.on || options.on;
			on && on(e);
		};
		var noteOff = function(e){
			if(midi.disabled)return;
			options.off && options.off(e);
		};
		(options.self || root.self).addEventListener('keydown',function(e){
			var key = convertKey(e.keyCode);
			key > 0 && noteOn({keyCode:key,intensity:120,timeStamp:e.timeStamp});
		});
		(options.self || root.self).addEventListener('keyup',function(e){
			var key = convertKey(e.keyCode);
			key > 0 && noteOff({keyCode:key,timeStamp:e.timeStamp});
		});
		if(midi){
			midi.on = root.noteOn || noteOn;
			return midi;
		}
		midi = new root.MIDI({
			filter: root.getMidiFilter(),
			before: options.before,
			success: options.success,
			change: function(e){
				if(e.port.type == 'input'){
					options.change && options.change(e.port);
					if(e.port.connection != 'open' && !e.port.checked){
						e.port.checked = true;
						var timer = setTimeout(function(){midi.init();clearTimeout(timer);},200);
					}
				}
			},
			on: noteOn,
			off:noteOff,
			error:options.error
		}).init();
		root.midi = midi;
		return midi;
	}
})(VSong);