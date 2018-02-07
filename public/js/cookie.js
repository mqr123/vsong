if(typeof VSong =='undefined')var VSong = {};
(function (root) {
	"use strict";
	var pluses = /\+/g;
	var conf = root.cookieConfig || {
		pre:'pre_',path:'/',expire:604800,domain:document.domain
	}

	function encode(s) {return config.raw ? s : encodeURIComponent(s);}
	function decode(s) {return config.raw ? s : decodeURIComponent(s);}
	function stringifyCookieValue(value) {return encode(config.json ? JSON.stringify(value) : String(value));}
	function parseCookieValue(s) {
		if (s.indexOf('"') === 0) {s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');}
		try {s = decodeURIComponent(s.replace(pluses, ' '));return config.json ? JSON.parse(s) : s;} catch(e) {}
	}
	function read(s, converter) {
		var value = config.raw ? s : parseCookieValue(s);
		return typeof converter == 'function'? converter(value) : value;
	}
	var config = root.cookie = function (key, value, options) {
		options = root.merge(conf, options);
		key = conf.pre + key;
		if (value !== undefined && typeof value != 'function') {	
			if (typeof options.expire === 'number') {
				var time = options.expire, t = options.expire = new Date();
				t.setTime(+ t + time * 1e3 + 36e5*8);
			}
			return (document.cookie = [
				encode(key), '=', stringifyCookieValue(value),
				options.expire ? '; expires=' + options.expire.toUTCString() : '',
				options.path    ? '; path=' + options.path : '',
				options.domain  ? '; domain=' + options.domain : '',
				location.protocol == 'https:'  ? '; secure' : ''
			].join(''));
		}
		var result = key ? undefined : {};
		var cookies = document.cookie ? document.cookie.split('; ') : [];

		for (var i = 0, l = cookies.length; i < l; i++) {
			var parts = cookies[i].split('=');
			var name = decode(parts.shift());
			var cookie = parts.join('=');
			if (key && key === name) {
				result = read(cookie, value);
				break;
			}
			if (!key && (cookie = read(cookie)) !== undefined) {
				result[name] = cookie;
			}
		}

		return result;
	};
	root.removeCookie = function (key, options) {
		key = conf.pre + key;
		if (root.cookie(key) === undefined) {
			return false;
		}
		root.cookie(key, '', root.merge(options,{expire: -1}));
		return !root.cookie(key);
	};
	
})(VSong);
