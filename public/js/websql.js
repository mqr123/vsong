/*+------------------------+
 + @ WebSQL                + 
 + @ Version 0.2           +
 + @ Author: 叶怀泼        +
 + @ Create: 2016-11-07    +
 + @ Update: 2017-08-27    +
 +-------------------------+*/
 if(typeof VSong == 'undefined')var VSong = {};
 (function(root){
	 "use strict";
	 var errMsg = {code:1,msg:'Your browser does not support openDatabase.'};
	 root.WebSQL = function(options){
		options = root.merge({
			database	: 'VSong',
			version		: '',
			desction	: 'VSong Database',
			size		: 100,
			pre			: 'VSong_',
			init		: function(){},
			error		: function(obj){
				root.self.location = root.dir + 'main/common/support';
			}
		},options);
		options.size = options.size * 1048576;
		if(typeof openDatabase == 'undefined'){
			root.isWebSQL = false;
			options.error(errMsg);
			return;
		}
		var db = window.openDatabase && window.openDatabase(options.database, options.version, options.desction, options.size * 1048576, options.init);
		if(!db)return options.error(errMsg);
		/*
		 * @ 格式化数据表属性
		 * @ attr 	Object|String	属性
		 */
		function setAttribute(attr){
			if(typeof attr == 'object'){
				var sql = "";
				for(var k in attr){
					sql += k + " " + root.trim(attr[k]) + ", ";
					delete attr[k];
				}
				sql = " (" + sql.substr(0,sql.length - 2) + ")";
				attr = k = null;
				return sql;
			}else if(typeof attr == 'string'){
				return " (" + attr + ")";
			}
			return "";
		}
		
		/*
		 * @ 格式化数据
		 * @ object		Object	数据
		 */
		function setValues(object){
			var key = '', value = '';
			for(var k in object){
				key += k + ",";
				value += "'"+object[k]+"',";
				delete object[k];
			}
			var sql =  "(" + key.substr(0, key.length - 1) + ") values(" + value.substr(0, value.length - 1) + ")";
			object = key = value = null;
			return sql;
		}
		
		/*
		 * @ 格式化查询条件
		 * @ where		Object|String	查询条件
		 */
		function setWhere(where){
			if(typeof where == 'string')return " WHERE " + where;
			if(typeof where == 'object'){
				var str = "", i = 0;
				for(var field in where){
					str += field + "='" + where[field] + "' AND "; i += 1;
				}
				where = i == 0?"":" WHERE " + str.substr(0, str.length - 5);
				str = i = field = null;
				return where;
			}
			return "";
		}
		
		//数据表
		this.table = function(tableName, pre){return (pre || options.pre) + tableName;}
	
		/*
		 * @ 执行SQLite语句
		 * @ sql		String			SQL语句
		 * @ list		Array			用于替换SQL语句 values(?, ?, ...) 中的问号
		 * @ callback	Function		回调
		 * @ error		Function		错误回调
		 */
		this.query = function(sql, list, callback, error){
			if(typeof list === 'function'){
				callback = list;
				error = callback;
				list = null;
			}	
			db.transaction(function(tx){
				tx.executeSql(sql,typeof list == 'object'?list:[], callback, error);
				sql = list = null;
			},error);
		}
		
		/*
		 * @ 查询数据表是否已存在
		 * @ table		String			数据表名
		 * @ callback	Function		回调
		 * @ error		Function		错误回调
		 */
		this.exists = function(table, callback, error){
			this.query("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='" + this.table(table) + "'", [], function(tx, results){
				var data = results.rows[0]["count(*)"];
				if(data > 0){
					callback && callback(data);
				}else if(error){
					error(tx);
				}
			}, error);
			table = null;
		}
		
		/*
		 * @ 删除数据表
		 * @ table		String			数据表名
		 * @ callback	Function		回调
		 * @ error		Function		错误回调
		 */
		this.drop = function(table, callback, error){
			this.query("DROP TABLE IF EXISTS " + this.table(table),[], callback, error);
			table = null;
		}
		
		/*
		 * @ 获取数据
		 * @ table		String			数据表名
		 * @ where		Object|String	查询条件
		 * @ callback	Function		回调
		 * @ error		Function		错误回调
		 */
		this.fetch = function(table, where, callback, error){
			var sql = "SELECT * FROM " + this.table(table) + setWhere(where);
			this.query(sql, [], callback, error);
			sql = table = where = null;
		}
		
		/*
		 * @ 添加数据
		 * @ table		String			数据表名
		 * @ data		Object|String	数据
		 * @ where		Object|String	查询是否已存在
		 * @ callback	Function		回调
		 * @ exists		Function		
		 * @ error		Function		错误回调
		 */
		this.insert = function(table, data, callback, error, where, exists){
			var _this = this, sql = "INSERT INTO " + _this.table(table) + setValues(data);
			if(where){
				this.fetch(table, where, function(tx, results){
					if(results.rows.length == 0){
						_this.query(sql, [], callback, error);
					}else if(exists){
						exists();
					}else if(error){
						error(tx, {code:2, msg:'exists'});
					}
					sql = null;
				},error);
			}else{
				this.query(sql, [], callback, error);
				sql = null;
			}
			table = where = data = null;
			return;
		}
		
		/*
		 * @ 删除数据
		 * @ table		String			数据表名
		 * @ where		Object			查询删除条件
		 * @ callback	Function		回调
		 * @ error		Function		错误回调
		 */
		this.delete = function(table, where, callback, error){
			if(typeof where != 'object'){
				error && error(db,{code:3,msg:'[where] is not object'});return;
			}
			var sql = "",list = [], i = 0;
			for(var k in where){
				list.push(where[k]);
				sql += k + "=? AND ";i += 1;
				delete where[k];
			}
			if(i == 0){
				error && error(db,{code:4,msg:'[where] is empty'});return;
			}
			sql = "DELETE FROM " + this.table(table) + " WHERE " + sql.substr(0, sql.length - 5);
			this.query(sql, list, callback, error);
			table = where = sql = i = k = null;
		}
		
		/*
		 * @ 更新数据
		 * @ table		String			数据表名
		 * @ set		Object			查询删除条件
		 * @ where		Object|String	查询删除条件
		 * @ callback	Function		回调
		 * @ error		Function		错误回调
		 */
		this.update = function(table, set, where, callback, error){
			if(typeof set != 'object'){
				error && error(db,{code:5,msg:'[set] is not object'});
				return;
			}
			var sql = "";
			for(var k in set){ sql += "`"+k+"`='"+set[k]+"',";delete set[k];}
			sql = "UPDATE "+this.table(table)+" SET " + sql.substr(0, sql.length - 1) + setWhere(where);
			this.query(sql,[],function(tx,result){
				if(result.rowsAffected == 1){
					callback && callback(tx, result);
				}else if(typeof error == 'function'){
					error && error(tx,{code:6,msg:'fail'});
				}
			},error);
			sql = k = set = where = table = null;
		}
		
		/*
		 * @ 创建数据表
		 * @ table		String			数据表
		 * @ attribute	Object|String	属性
		 * @ callback	Function		回调
		 * @ error		Function		错误回调
		 */
		this.create = function(table, attribute, callback, error, dontDrop){
			//delete table
			if(!dontDrop)this.drop(table);
			//create table
			this.query("CREATE TABLE IF NOT EXISTS " + this.table(table) + setAttribute(attribute),[], callback, error);
			table = attribute = null;
		}
			
		/*
		 * @ 删除
		 * @ list		Array		数据表名组
		 * @ callback	Function	回调
		 * @ error		Function	错误回调
		 */
		this.dropBatch = function(list, callback, error){
			if(typeof list != 'object')return;
			var _this = this;
			list.forEach(function(table){
				_this.drop(table, callback, error);
				sql = null;
			});
			list.splice(0,list.length);
		}
		
		/*
		 * @ 批量创建表
		 * @ data		String		数据表集
		 * @ retain		All			是否保留已存在
		 * @ callback	Function	回调
		 */
		this.createBach = function(data, retain, callback, error){
			for(var k in data){
				this.create(k, data[k], callback, error, retain);
				delete data[k];
			}
			data = k = null;
		}
	};
})(VSong);