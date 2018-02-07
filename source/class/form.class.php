<?php
/*----------------------------------+
| @ 表单处理						|
| @ Form							|
| @ 2017-08-18 07:29				|
| @ Copyright (C) 微熊科技 VSong.TV	|
+-----------------------------------*/
class Form extends Core{
	public $data = array();
	private $message = null;
	private $error = false;
	private $table = null;
	private $where = '';
	public $nsi = false;
	public function __construct($data = array(), $table = null, $where = '')
	{
		$this->data = $data;
		$this->table = $table;
		$this->where = $where;
	}
	# @ 设置表单项
	public function set($key = '', $value = '')
	{
		if($this->error)return $this;
		$this->data[$key] = $value;
		return $this;
	}
	# @ 检查表单
	# @ 参数 $check = array(
	#	键名，如：username
	#	key	=> array(
	#		min		=> array(num, msg),	可选（最小长度，错误提示），留空跳过判断
	#		max		=> array(num, msg),	可选（最大长度，错误提示），留空跳过判断
	#		path	=> array(reg, msg)	可选（正则表达，错误提示），留空跳过判断
	#		)
	#	)
	public function check($check = array())
	{
		if($this->error)return $this;
		foreach($check as $name => $arr)
		{
			foreach($arr as $key => $value){
				if(!empty($value[0]))
				{
					$empty = !isset($this->data[$name]);
					if($key == 'min' && ($empty || mb_strlen($this->data[$name]) < $value[0]))
					{
						if(!empty($value[1]))$this->message = $value[1];
						$this->error = true;
						unset($check,$arr,$value);
						return $this;
					}
					if($key == 'max' && ($empty || mb_strlen($this->data[$name]) > $value[0]))
					{
						if(!empty($value[1]))$this->message = $value[1];
						$this->error = true;
						unset($check,$arr,$value);
						return $this;
					}
					if($key == 'match' && ($empty || !preg_match($value[0], $this->data[$name])))
					{
						if(!empty($value[1]))$this->message = $value[1];
						$this->error = true;
						unset($check,$arr,$value);
						return $this;
					}
					
				}
			}
		}
		return $this;
	}
	# @ 整理表单，按规定字段赋值，移除多余数据
	# @ 参数：$names 要提交的键名，以半角逗号隔开
	public function pack($names = '')
	{
		if($this->error)return $this;
		$names = explode(',',$names);
		$data = array();
		foreach($names as $key)
		{
			if(!isset($this->data[$key]))
			{
				$this->message = '缺少表单项：'.$key;
				$this->error = true;
				
				return $this;
			}
			else
			{
				$data[$key] = $this->data[$key];
			}
		}
		#重新赋值
		unset($this->data);
		$this->data = $data;
		return $this;
	}
	
	#验证码
	public function verify($key = 'vcode', $code = null){
		if(empty($this->data[$key]) || strtolower($this->data[$key]) != strtolower($code)){
			$this->error = true;
			$this->message = '验证码错误';
		}
		return $this;
	}
	
	#验证hash
	public function hash($key = null){
		if(empty($this->data[$key]) || $this->data[$key] != $this->formhash()){
			$this->error = true;
			$this->message = '非法操作 [ '.$key.' ]';
		}
		return $this;
	}
	
	#表单唯一新查询
	public function only($names = '', $update = false, $msg = '数据已存在')
	{
		if($this->error)return $this;
		$names = explode(',',$names);
		$where = '';
		foreach($names as $name)
		{
			if(empty($this->data[$name]))return $this;
			$where .= "`$name`='{$this->data[$name]}' or ";
		}
		$db = new DB($this->table);
		$res = $db->where(trim($where,'or '))->search();
		if($res){
			unset($this->data);
			$this->message = $msg;
			$this->error = true;
			$this->data = $res;
		}
		return $this;
	}
	# @ 提交表单
	# @ 参数：$type ( insert | update | delete ) 必选
	# @ 参数：$success 成功消息（可选）
	# @ 参数：$error 失败消息（可选）
	public function submit($type, $success = '提交成功', $error = '提交失败')
	{
		if($this->error)return $this;
		if(!in_array($type,array('insert','update','delete'))){
			$this->error = true;
			$this->message = '提交类型未定义';
			return $this;
		}
		if(!$this->where && ($type == 'update' || $type == 'delete')){
			$this->message = 'where条件不能为空';
			$this->error = true;
			return $this;
		}
		$db = new DB($this->table);
		if($type == 'update' || $type == 'delete')$db->where($this->where);
		if($this->nsi && $type == 'insert'){
			$res = $db->insert($this->data,1);
		}else{
			$res = $db->$type($this->data);
		}
		if(!$res)
		{
			$this->message = $error;
			$this->error = true;
			unset($this->data,$db);
			return;
		}
		$this->message = $success;
		$this->error = false;
		unset($this->data);
		if($type == 'insert' && !$this->nsi)$this->data = array('id'=>$res);
		return $this; 
	}
	
	#返回结果
	public function result()
	{
		return array(
			'type'	=> $this->error?'error':'success',
			'msg'	=> $this->message,
			'data'	=> isset($this->data)?$this->data:null
		);
	}
}

?>