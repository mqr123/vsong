VSong.district = function(root,selector,url){
	"use strict";
	var dbExists,db,main = document.querySelectorAll(selector);
	if(main.length < 1)return;
	var table = 'district', maxLevel = 4;
	db = root.db || new root.WebSQL({
		pre:root.cookieConfig?root.cookieConfig.pre:'vSong_',
		database:'VSong',
		size:100,
		error:function(){
			root.self.location = root.dir + 'main/common/support';
	}});

	
	function next(obj){return obj.nextElementSibling||obj.nextSibling;}
	function ulClear(ul){
		var li = ul.querySelectorAll('li');for(var i=0;i<li.length;i+=1)this.removeChild(li[i]);
	}
	function clearSpan(level){
		var span = this.querySelectorAll('span');for(var i=0;i<span.length;i+=1)if(i>=level)this.removeChild(span[i]);
	};
	function numberChange(){
		var li = this.ul.querySelectorAll('li');
		if(li.length == 0)this.span.parentNode.removeChild(this.span);
		else{
			this.a.textContent = this.a.title || '请选择';
		}
	}
	function load(options){
		if(typeof options !== 'object')return;
		var worker = new Worker(url + (options.upid||'')+(options.params?options.params:''));
		worker.addEventListener('message',function(e){
			if(e.data && e.data.list)options.success(e.data.list);
			else options.error(e);
			worker.terminate();// 结束执行
		});
	}

	function fetch(where,callback,error,create){
		if(dbExists){
			db.fetch(table,where,function(e,result){
				if(result.rows.length > 0){
					callback(result.rows);
				}else{
					create && create();
				}
			},error);
		}else{
			db.create(table,{
				id		: "mediumint(8) NOT NULL DEFAULT '0'",
				name	: "varchar(40) NOT NULL DEFAULT ''",
				upid	: "mediumint(8) NOT NULL DEFAULT '0'",
				level	: "tinyint(4) NOT NULL DEFAULT '0'"
			},function(){
				dbExists = true;
				create();
			},error);
		}
	}
	function loadData(upid,callback,error,isId){load({upid:upid,params:isId?'/id':'',success:callback,error:error})}
	function setData(data,_this){
		var li = document.createElement('li');
		li.textContent = data.name;
		li.value = data.id;
		li.upid	= data.upid;
		li.level = data.level;
		li.onclick = function(){
			this.level = parseInt(this.level);
			this.upid = parseInt(this.upid);
			if(this.level == 1){
				if(this.value >= 32 && this.value <= 36)maxLevel = 2;
				else if([1,2,9,22].indexOf(this.value)!=-1)maxLevel = 3;
				else maxLevel = 4;
			}
			_this.span.data = {id:this.value,name:this.textContent,level:this.level,upid:this.upid};
			_this.a.title = _this.a.textContent = this.textContent;
			clearSpan.call(_this.span.parentNode,this.level);
			if(this.level<maxLevel)create(this.value,next(_this.span));
			_this.span.classList.remove('focus');
		}
		_this.ul.appendChild(li);
	}
	function read(upid){
		var _this = this;
		var success = function(){
			loadData(upid,function(list){
				ulClear(_this.ul);
				list.forEach(function(data){
					setData(data,_this);db.insert(table,data);
				});numberChange.call(_this);
			},function(){
				if(upid)_this.span.parentNode.removeChild(_this.span);
			});
		}
		fetch("`upid`='"+(upid||0)+"'",function(result){
			for(var i=0;i<result.length;i+=1)setData(result[i],_this);
			numberChange.call(_this);
		},success,success);
	}

	function init(){
		if(this.completed)return;
		this.completed = true;
		var _this = this;
		var value = _this.getAttribute('value');
		if(value){
			var arr = value.split(',');
			if(arr.length>0)_this.innerHTML = '';
			arr.forEach(function(id,i){
				id = parseInt(id);
				var success = function(result,insert){
					var res = result[0];
					if(!res)return;
					var span = document.createElement('span');
					var a = document.createElement('a');
					var ul = document.createElement('ul');
					span.appendChild(a);
					span.appendChild(ul);
					events.call(span,a,ul,res.upid);
					a.textContent = a.title = res.name;
					span.data = res;
					_this.appendChild(span);
				}
				if(!dbExists && i === 0){
					loadData(0,function(result){
						success(result,1);
					},null,true);
				}
				fetch({id:id},success,function(){
					loadData(id,function(result){
						success(result,1);
					},null,true);
				},function(){
					loadData(id,function(result){
						success(result,1);
					},null,true);
				});
		
			});
		}
	}
	function events(a,ul,upid){
		this.addEventListener('click',function(e){
			if(e.target === a){
				this.classList.add('focus');
				if(ul.childNodes.length===0){
					a.textContent = 'Loading...';
					read.call({span:this,a:a,ul:ul},upid);
				}
			}else if(e.target.tagName == 'SPAN'){
				this.classList.remove('focus');
			}
		});
	}
	function create(upid,parents){
		var span = parents || document.createElement('span');
		var a = document.createElement('a');
		var ul = document.createElement('ul');
		a.classList.add('cur');
		a.textContent = '请选择';
		events.call(span,a,ul,upid);
		if(!parents){
			for(var i=0;i<main.length;i+=1){
				main[i].appendChild(span);
				init.call(main[i]);
				main[i].result = function(){
					var arr = [''],s = this.querySelectorAll('span');
					for(var i=0;i<s.length;i+=1){
						if(s[i].data){ arr[0] += s[i].data.name;arr[s[i].data.level] = s[i].data;}
					};return arr;
				}
			}
		}else span.innerHTML = '';
		span.appendChild(a);
		span.appendChild(ul);
	}
	db.exists(table,function(){
		dbExists = true;
		create();
	},function(){
		dbExists = false;
		create();
	});
	
}