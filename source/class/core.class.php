<?php
# +--------------------------------------------------+
# + @ 核心类 Core
# + @ 参数：数组，传递 模版、COOKIE、MySQL等配置信息
# + @ 成员：
# + @ 		assign		参数：变量名，值 （向模板注入变量）
# + @ 		base64File	参数：路径，文件MIME类型 （文件转base64）
# + @ 		clear		参数：表名，文件夹 （清理缓存数据）
# + @ 		connect		参数：无  连接数据库
# + @ 		cookie		参数：名称, 值, 过期, 路径, 域名 （获取或设置Cookie值，当第二个参数为空字符串时，返回Cookie值，第二参数为false时，获取不解密的值，通常获取客户端传入的cookie）
# + @ 		createDir	参数：路径 （创建目录）
# + @ 		decode		参数：文本 （解密数据）
# + @ 		display		参数：模块名称（显示模板）
# + @ 		encode		参数：文本（加密数据）
# + @ 		form		参数：表名，查询条件，传入数据 （表单处理类）
# + @ 		formhash	参数：可选的混淆值 （生成表单hash值，防止非法请求）
# + @ 		getConfig	参数：键 （获取配置信息）
# + @ 		getPacker	参数：路径-可选（获得一个资源包；默认当前应用资源包，url需带1个参数）&&（url必须带有ecode参数）
# + @ 		clientIP	参数：无（获取客户端IP）
# + @		init		参数：无 （初始化）
# + @ 		json		参数：数组 | Array （将数组转换成JSON数据）
# + @ 		packer		参数：目标资源包名称，要打包的文件列表 （打包资源）
# + @ 		pathinit	参数：无 （初始化路径信息）
# + @ 		query		参数：语句	执行SQL语句
# + @ 		read		参数：路径，起读长度（读文件）
# + @ 		setConfig	参数：键，值 （设置配置信息）
# + @ 		url			参数：URL（转化当前URL）
# + @ 		worker		参数：数组
# + @ 		write		参数：路径，内容 （写文件）
# + @
# + @ 修改时间：2017/09/06 03:01
# + @ Copyright (C) 微熊科技 VSong.TV
# +--------------------------------------------------+
if(!defined('APP'))exit;
class Core{
	public $db			= null;		# 已连接的数据库
	public $db_type 	= '';		# 数据库连接类型
	public $param		= array();	# 传入的URL参数
	protected $ecode	= '';		# 使用于GET方法的验证码
	protected $pre		= 'vs_';	# 前缀
	protected $config	= array();	# 配置信息
	protected $dir		= '';
	# @ 用户信息	
	public $user = array(
		'uid'		=> 0,
		'gender'	=> 0,
		'group'		=> 0,
		'username'	=> ''
	);

	
	public function __construct()
	{
		#加载配置文件
		$this->config = include(__DIR__.'/../config/common.conf.php');
		
		#加载
		require(__DIR__.'/db.class.php');

	}

	# @ 向模板中注入变量
	# @ 参数：1、变量名，2、值
	public function assign($key, $val = NULL)
	{
		if (empty($key))return '';
		if (is_array($key))foreach ($key as $k=>$v)$this->config['GLOBALS'][$k] = $v;
		else $this->config['GLOBALS'][$key] = $val;	
	}
	#文件转为base64
	public function base64File($path, $mime = 'text/plain')
	{
		$file = '';
		$data = $this->read($path);
		$file = "data:$mime;base64,".chunk_split(base64_encode($data));
		return preg_replace('/\r\n/','',$file);
	}
	
	#清理数据缓存
	public function clear($table = null, $folder = null)
	{
		$dir = __ROOT__.'/cache/database';
		if($folder)$folder .= '/';
		if($table)$dir = $dir.'/'.$folder.$this->pre.$table;
		if(!is_dir($dir))return false;
		$files =  glob("$dir/*");
		foreach($files as $path)@unlink($path);
		return true;
	}
	
	#获取客户端IP
	public function clientIP()
	{
		if(!empty($_SERVER['HTTP_X_REAL_IP']))$ip	= $_SERVER['HTTP_X_REAL_IP'];
		else if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown'))$ip = getenv('HTTP_CLIENT_IP');
		elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown'))$ip = getenv('HTTP_X_FORWARDED_FOR');
		elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown'))$ip = getenv('REMOTE_ADDR');
		elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown'))$ip = $_SERVER['REMOTE_ADDR'];
		preg_match('/[\d\.]{7,15}/', $ip, $ipmatches);
		$ip = !empty($ipmatches[0]) ? $ipmatches[0] : $ip;
		unset($ipmatches);
		return $ip;
	}
	
	#连接数据库
	protected function connect()
	{
		if($this->db)return $this->db;
		$conf = require(__DIR__.'/../config/db.conf.php');
	
		$this->pre	= $conf['pre'];
		$host		= !empty($conf['host'])		? $conf['host']		: 'localhost';
		$user		= !empty($conf['user'])		? $conf['user']		: 'root';
		$pwd		= !empty($conf['pwd'])		? $conf['pwd']		: 'root';
		$name		= !empty($conf['name'])		? $conf['name']		: 'test';
		$charset	= !empty($conf['charset'])	? $conf['charset']	: 'utf8';
		$connect	= $conf['long']	?'mysql_pconnect':'mysql_connect';
		
		$this->db_type = $conf['type'];
		if($this->db_type == 'pdo')
		{
			$attr = array(PDO::ATTR_PERSISTENT => $conf['long']?true:false);
			$this->db = new PDO("mysql:dbname=$name;host=$host", $user, $pwd, $attr);
			if(!$this->db)return trigger_error('数据库连接失败');
			$this->db->exec("SET NAMES $charset");
			$this->db->exec("SET CHARACTER SET $charset");
		}
		else if($this->db_type == 'mysql')
		{
			$this->db = $connect($host, $user, $pwd);
			if(!$this->db)return trigger_error('数据库连接失败');
			#定义字符集
			$keys = array('names','character_set_client','character_set_connection','character_set_results');
			foreach($keys as $k)mysql_query("set $k = '$charset'");
			#数据库名
			mysql_select_db($name);
		}
		return $this->db;
	}
	
	#创建目录
	protected function createDir($dir)
	{
		if(!$dir)return false;
		if(is_dir($dir) || mkdir($dir, 0777, true))return true;
	}
	
	# @ Cookie
	# @ 参数：1、名称，2、值，3、有效期，4、路径，5、域名
	# @ 只设置第1个参数时为获取Cookie，否则为设置Cookie
	public function cookie($name, $value = NULL, $expire = 0, $path = '/', $domain = NULL)
	{
		$pre = $this->config['cookie']['pre'];
		$port = $_SERVER['SERVER_PORT'] == 443 ? 1 : 0;
		if(($value === false || $value === NULL) && isset($_COOKIE[$pre.$name]))
		{
			return $value === false?$_COOKIE[$pre.$name]:$this->decode($_COOKIE[$pre.$name]);
		}
		else if($value || $value === '')
		{
			if($value === '')
			{
				setcookie("$pre$name", NULL, 0, $path, $domain, $port);
			}
			else
			{
				$timezone = (isset($this->config['timezone'])?$this->config['timezone']:0) * 3600;
				$expire = time() + ($expire?$expire:$this->config['cookie']['expire']) + $timezone;
				setcookie("$pre$name", $this->encode($value), $expire, $path, $domain, $port);
			}
		}
	}

	#解密
	public function decode($code = null)
	{
		if(!$code || $code == 'null')return '';
		$code=base64_decode($code); 
		$r = '';
		for ( $i = 0; $i<strlen($code); $i += 2)
		{
			$x1 = ord($code{$i});	
			$x1 = ($x1>=48 && $x1<58) ? $x1-48 : $x1-97+10;	
			$x2 = ord($code{$i+1});	
			$x2 = ($x2>=48 && $x2<58) ? $x2-48 : $x2-97+10;	
			$r .= chr((($x1 << 4) & 0xf0) | ($x2 & 0x0f));	
		} 
		return $r;
	}
	
	#显示模板
	public function display($page = null, $mod = null, $exit = false)
	{
		#加载模版类
		require(__DIR__.'/template.class.php');
		#初始化模板
		$template = new Template($this->config, $this->self);
		$template->displays(($mod?$mod:$this->mod).'/'.($page?$page:$this->page));
		unset($template);
		if($exit)exit;
	}
	
	#加密
	public function encode($code)
	{
		$r = '';
		$hexes = array ('0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f');
		for ($i=0; $i<strlen($code); $i++){
			$r .= ($hexes [(ord($code{$i}) >> 4)] . $hexes[(ord($code{$i}) & 0xf)]);
		}
		return base64_encode($r);
	}
	
	# @ 表单处理类
	# @ 参数：1、表名，2、条件，3、传入的数据
	# @ 第3个参数通常留空，设置后处理该参数数据，而不再处理POST数据
	# @ 详情查看：source/class/form.class.php
	private function form($table = null, $where = '', $data = null)
	{
		if(!class_exists('Form'))require(__DIR__.'/form.class.php');
		$data = is_array($data)?$data:($_POST?$_POST:json_decode(file_get_contents('php://input'),1));
		return new Form($data, $table, $where);
	}
	
	# @ 表单hash值
	# @ 参数：混淆值
	public function formhash($specialadd = NULL)
	{
		if(!$specialadd)$specialadd = $this->clientIP();
		return substr(md5(substr(time(), 0, -7).$this->user['username'].$this->user['uid'].$specialadd), 8, 8);
	}

	#获取当前配置
	public function getConfig($key = NULL)
	{
		return $key?$this->config[$key]:$this->config;
	}
		
	#得到资源包
	public function getPacker($path = null){
		$form = $_POST?$_POST:json_decode(file_get_contents('php://input'),1);
		if(!isset($form['ecode']) || $form['ecode'] != $this->ecode)return;
		$path = $path?$path:(__DIR__.'/../../cache/resource/'.APP.'/js/'.$this->param[0].'.pack');
		setCacheHeader(!isset($this->param[1])?3600:$this->param[1], 'application/vsong-pack',$this->param[0].'.pack');
		return $this->read($path);
	}


	# @ 初始化
	# @ 参数：默认模块，默认页面
	public function init($mod = null, $page = null)
	{
		$this->mod = $mod?$mod:'home';
		$this->page = $page?$page:'index';
		$this->pathinit();
		$this->dir = trim(dirname($this->self).'/','\\');
		#解析用户COOKIE
		$keys = array('uid','username','gender','type','group');
		$author = $this->cookie('author');
		$author = $author?explode("\t",$author):array(0,'',0,0,0);
		if(count($author) !== 5)$author = array(0,'',0,0,0);
		for($i = 0; $i < count($keys); $i += 1)$this->user[$keys[$i]] = $author[$i];

		$this->ecode = md5($this->formhash().APP);
		global $_G;
		$_G = array(
			'ip'	=> $this->clientIP(),
			'dir'	=> $this->dir,
			'mod'	=> $this->mod,
			'page'	=> $this->page,
			'user'	=> $this->user,
			'param'	=> $this->param,
			'ecode'	=> $this->ecode
		);
		
		# 请求包裹 
		if($this->mod == 'pack' && !empty($_GET['ecode'])){echo $this->getPacker(null);exit;}
		
		#加载控制器（控制器目录/入口名称/模块/页面）
		$controller = 'controller/'.APP.'/'.$this->mod.'/'.$this->page.'.php';
		if(file_exists($controller))include($controller);
		else $this->display();
		
		unset($this->config,$this->db,$keys);
	}
	
	#数组转JSON
	public function json($data = array(),$exit = false)
	{
		if (version_compare(PHP_VERSION,'5.4.0','<')){
			$str = json_encode($data);
			unset($data);
			$json = preg_replace_callback('/\\\u([0-9a-f]{4})/i',function($matchs){
				return iconv('UCS-2BE', 'UTF-8', pack('H4', $matchs[1]));
			},$str);
		}else{
			$json = json_encode($data, JSON_UNESCAPED_UNICODE);
		}
		if(!$exit)return $json;
		echo $json;exit;
	}
	#输出JSON数据
	protected function msg($msg = '', $type = 'error', $options = array())
	{
		$arr = array('type'=>$type,'msg'=>$msg);
		if(is_array($options)){
			foreach($options as $key => $value){
				$arr[$key] = $value;
			}
			unset($options);
		}
		$this->json($arr,1);
	}

	# @ 初始化路径信息
	private function pathinit()
	{
		$this->self = $_SERVER['PHP_SELF'];
		if(!empty($_SERVER['PATH_INFO']))
		{
			$pathinfo = $_SERVER['PATH_INFO'];
			$this->self = substr($this->self, 0, strlen($this->self) - strlen($pathinfo) - ($this->config['url_rewrite']?4:0));
			$pathinfo = explode('/',trim($pathinfo,'/'));
			#
			if(!empty($pathinfo[0]))$this->page = $pathinfo[0];
			if(!empty($pathinfo[1]))
			{
				$this->mod = $pathinfo[0];
				$this->page = $pathinfo[1];
				if(!empty($pathinfo[2]))
				{
					preg_match_all('/([a-zA-Z0-9_\x7f-\xff\+\=\.\|,]+)/i',$pathinfo[2],$param);
					$this->param = $param[0];
				}
			}
		}
		else
		{	
			if($this->config['url_rewrite'])$this->self = trim($this->self,'.php');
		}
		
	}
	
	# @ 执行SQL
	# @ 参数：sql语句
	public function query($sql = '', $insert_id = false)
	{
		$db = $this->connect();
		if($this->db_type == 'pdo')
		{
			if($insert_id){
				$db->exec($sql);
				return $db->lastInsertId();
			}
			$query = $db->prepare($sql, array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY =>true));
			$query->execute();
			return $query->fetch();
		}
		else
		{
			$query = mysql_query($sql, $db);
			return $query?($insert_id?mysql_insert_id():0):null;
		}
	}
	
	# @ 读取缓存
	# @ 参数：1、缓存路径，2、起始字节数
	protected function read($path, $start = 0){
		if (function_exists('file_get_contents')){
			$cont = file_get_contents($path);
		}else{
			$fopen = fopen($path,'r');
			$cont = '';
			do {
				$data = fread($fopen,1024);
				if (strlen($data)===0) break;
				$cont .= $data;
			}
			while(1);
			fclose($fopen);
		}
		return  $start?substr($cont, $start):$cont;
	}

	# @ 打包资源
	# @ 参数：1、要生成的文件路径，2、要打包的文件列表
	public function packer($filename = 'data/untitled.pack', $list = array())
	{
		if(!class_exists('ZipArchive'))return;
		$pack = new ZipArchive();
		$pack->open($filename, ZipArchive::CREATE);
		foreach($list as $file)
		{
			if(file_exists($file))$pack->addFile($file, basename($file));
		}
		$pack->close();
		return true;
	}

	# @ 设置配置
	# @ 参数：键，值
	public function setConfig($key, $value = NULL)
	{
		if (is_array($key))$this->config += $key;
		else $this->config[$key] = $value;
	}


	# @ 处理URL
	# @ 参数：url
	public function url($url = '')
	{
		return $this->self.'/'.trim($url,'/');
	}
	
	# @ 输出Worker数据
	# @ 参数：Array
	public function worker($data = array())
	{
		echo 'this.postMessage('.$this->json($data).');';exit;
	}
	
	# @ 写文件
	# @ 参数：1、路径，2、内容
	protected function write($path, $content = '')
	{
		if(!$path)return;
		$this->createDir(dirname($path));
		$openFile = fopen($path,'w');
		flock($openFile, LOCK_EX + LOCK_NB);
		$writeFile = fwrite($openFile, $content);
		fclose($openFile);
		return $writeFile;
	}
	#public function __destruct(){}
}

