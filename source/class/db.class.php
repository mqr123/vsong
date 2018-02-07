<?php
/*----------------------------------+
| @ 表单处理						|
| @ Form							|
| @ 2017-08-18 05:01				|
| @ Copyright (C) 微熊科技 VSong.TV	|
+-----------------------------------*/
class DB extends Core{
	public $table = '';
	private $inquiry = 'mysql_query';
	private $_type = MYSQL_ASSOC;
	private $_cache = 0;
	private $_folder = '';
	private $number = 0;
	private $page = 1;
	private $method = array(
		'field'		=> '*',	# 'type count(type)'
		'where'		=> '',	# 
		'order'		=> '',	# 
		'limit'		=> '',	# 
		'group'		=> '',	# 'group by type'
		'have'		=> ''	# 'having avg(x) > 1'
	);
	public function __construct(){
		$num = func_num_args();
		if($num < 1)trigger_error('DB类至少包含一个参数.',E_USER_ERROR);
		$args = func_get_args();
		foreach($args as $t)$this->table .= $this->pre . $t . ',';
		$this->table = trim($this->table, ',');
		unset($args);
	}

	#定义方法
	public function __call($func,$arr){
		$func = strtolower($func);
		if(array_key_exists($func, $this->method)){
			$this->method[$func] = $arr[0];
		}
		return $this;
	}
	#设置类型
	public function type($type = MYSQL_ASSOC){
		$this->_type = $type;
		return $this;
	}
	#设置缓存
	public function cache($time = 0, $folder = null){
		$this->_cache = $time;
		$this->_folder = trim($folder,'/');
		return $this;
	}
	#无缓冲模式
	public function unbuffered($unbuffered = true){
		if($unbuffered)$this->inquiry = 'mysql_unbuffered_query';
		return $this;
	}
	#
	public function where($sql = null){
		if($sql)$this->method['where'] = 'WHERE '.$sql;
		return $this;
	}
	#
	public function field($field = '*'){
		if($field)$this->method['field'] = "$field";
		return $this;
	}
	#
	public function order($field = '', $desc = false){
		$this->method['order'] = 'ORDER BY '.$field.($desc === true?' DESC':'');
		return $this;
	}
	#
	public function group($field = ''){
		$this->method['group'] = 'GROUP BY '.$field;
		return $this;
	}
	#
	public function limit($number = 0, $page = 1){
		$first = ($page - 1) * $number;
		$this->number = $number;
		$this->page = $page;
		$this->method['limit'] = "LIMIT $first,$number";
		return $this;
	}
	#
	public function sql($type = null){
		$sql = '';
		switch($type){
			case 'update':break;
			case 'insert':break;
			default:
				$sql = "SELECT {$this->method['field']} FROM $this->table ".
				"{$this->method['where']} {$this->method['group']} ".
				"{$this->method['order']} {$this ->method['limit']} {$this->method['have']}";
			break;
		}
		return $sql;
	}
	
	#查找
	public function select(){
		$sql = $this->sql();
		$file = __DIR__.'/../../cache/database/'.$this->table.'/'.$this->_folder.'/'.md5($sql.$this->_cache).'.php';
		#判断是否缓存
		if($this->_cache && file_exists($file)){
			if(time() < filemtime($file) + $this->_cache){
				return json_decode($this->read($file,13),1);
			}
		}
		$db = $this->connect();
		$numrows = preg_replace('/(LIMIT||limit) ([\d]+),([\d]+)/','',$sql);
		if($this->db_type == 'pdo'){
			$query = $db->prepare($sql, array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => $this->inquiry == 'mysql_unbuffered_query'?true:false));
			$query->execute();
			$list = $query->fetchAll(PDO::FETCH_ASSOC);
			$numrows = $db->query($numrows);
			$length = $numrows->rowCount();
		}else{
			$query_type = $this->inquiry;
			$query = $query_type($sql, $db);
			$list = array();
			while($fetch = mysql_fetch_array($query, $this->_type))$list[] = $fetch;
			$length = mysql_num_rows($query_type($numrows));
			unset($fetch);
		}
		$data = array(
			'list'	=> $list,
			'length' => $length,
			'page'	=> $this->page,
			'total'	=> $this->number?ceil($length/$this->number):1
		);
		unset($list);
		if($this->_cache)$this->write($file, '<?php exit;?>'.$this->json($data));
		return $data;

	}
	
	#删除
	public function delete(){
		$db = $this->connect();
		$sql = "DELETE FROM $this->table {$this->method['where']}";
		if($this->db_type == 'pdo'){
			return $db->exec($sql);
		}else{
			return mysql_query($sql, $db);
		}
	}
	#更新
	public function update($data = array()){
		$db = $this->connect();
		$value = '';
		foreach($data as $key => $val){
			$value .= "`$key`='".addslashes($val)."',";
		}
		$sql = "UPDATE $this->table SET ".trim($value,",")." {$this->method['where']}";
		if($this->db_type == 'pdo'){
			return $db->exec($sql);
		}else{
			return mysql_query($sql, $db);
		}
	}
	#插入
	public function insert($data = array(),$nsi = false){
		$db = $this->connect();
		$field = '';$value = '';
		foreach($data as $key => $val){
			$field .= "`$key`,";
			$value .= "'".addslashes($val)."',";
		}
		$sql = "INSERT INTO $this->table (".trim($field,",").") VALUES (".trim($value,",").")";
		if($this->db_type == 'pdo'){
			$res = $db->exec($sql);
			return $nsi?$res:$db->lastInsertId();
		}else{
			$query = mysql_query($sql, $db);
			return $query?mysql_insert_id():0;
		}
	}
	
	#及时查询
	public function search($index = null, $key = null){
		$sql = $this->sql();
		$db = $this->connect();
		if($this->db_type == 'pdo'){
			$query = $db->prepare($sql, array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => $this->inquiry == 'mysql_unbuffered_query'?true:false));
			$query->execute();
			$data = $query->fetchAll(PDO::FETCH_ASSOC);
		}else{
			$query = $this->inquiry;
			$query = $query($sql, $db);
			$data = mysql_fetch_array($query, $this->_type);
		}
		$result = ($index || $index === 0) && isset($data[$index])?$data[$index]:$data;
		unset($data);
		if($key)return isset($result[$key])?$result[$key]:null;
		return $result;
	}
}

?>