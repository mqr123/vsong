<?php
class Template extends Core{
	protected $config = array();
	# @ 语言
	private $language = array(
		'vs_name'		=> 'VSong',
		'vs_title'		=> '维颂科技',
		'vs_url'		=> 'http://vsong.tv/?mod=vsong',
		'vs_version'	=> '2.0'
	);
	public function __construct($config = array(), $self = null)
	{
		$this->pjax = array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX'] === 'true';
		$this->config += $config;
		$this->self = $self;
		unset($config);
	}
	#512kb以下的文件
	private function url2bese64($file = null)
	{
		if(substr($file,5) == 'data:')return $file;
		$path = __DIR__.'/../..'.$file;
		if(!file_exists($path) || filesize($path) > 1024 * $this->config['css_url2base64'])return "url($file)";
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		$mime = 'image/'.($ext == 'jpg'?'jpeg':$ext);
		return 'url('.$this->base64File($path, $mime).')';
	}

	#静态资源
	private function resource($type = '', $name = '', $time = 0, $files = '')
	{
		$pack = false;
		$dir = trim(dirname($this->self),'\\').'/';
		$ext = $type;
		if($type == 'pack'){
			global $_G;
			$pack = $this->url('pack/'.$_G['page']."/$name-$time-1.0.pack");
			$execute = '<script class="VSONG-SCRIPT-CONFIG" src="'.$dir.'public/js/pack.min.js?v=1.4"></script>'.
			'<script>(function(root){'.
				'root.dir = \''.$dir.'\';root.name = \''.APP.'\';root.mod = \''.$_G['mod'].'\';'.
				'root.page = \''.$_G['page'].'\';root.packURL = \''.$pack.'\';root.workerPath = \'public/js/worker.min.js\';'.
				'root.user = '.$this->json($_G['user']).';root.ecode = \''.$_G['ecode'].'\';'.
				'root.execute(root.packURL,root.'.APP.'Progress || null, root.'.APP.'Complete || null);'.
				'var vsc = document.querySelectorAll(\'script,.VSONG-SCRIPT-CONFIG\');for(var i=0;i<vsc.length;i+=1)document.body.removeChild(vsc[i]);'.
				'})(VSong);</script>';
			$type = 'js';
			$ext = 'dll';
			$this->config['cache'] = false;
		}
		$filename	= 'cache/resource/'.APP."/$type/$name.$ext";
		$orgFile	= __DIR__.'/../../'.$filename;
		$path		= $dir.$filename;
		$mimetype	= $type == 'js'?'application/javascript':'text/'.$type;
		if(file_exists($orgFile))
		{
			$cacheTime = is_numeric($time)?$time:0;
			if((filemtime($orgFile) + $cacheTime) > time() || $time == 0){
			if($pack)return $execute;
			return $type == 'css'?
				'<link rel="stylesheet" href="'.$path.'" />':
				'<script type="text/javascript" src="'.$path.'"></script>';
			}
		}
		preg_match_all('/\<file src\=\"(.*?)\"(.*?)\>/si', $files, $list);
		if(!isset($list[1]))return '';
		$content = '';
		foreach($list[1] as $file)
		{
			$file =  __ROOT__."/public/$type/$file.$type";
			if(file_exists($file))$content .= $this->read($file)."\r\n";
		}
		
		if($type == 'css'){
			$content = preg_replace(array(
				'/\r\n|\t|\/\*(.*?)\*\/|\/\/(.*?)\r\n| ([ ]) /si',
				'/\-vs\-([a-z\-]+)\:(.*?)(;|\r\n)/',
				'/url\(([a-zA-Z_0-9\.\-\/]+)\)/',
				'/  /i',
				'/\[ROOT\]/',
				'/\[DIR\]/',
				'/\[APP\]/'
			), array(
				'',
				'-webkit-\\1:\\2;-moz-\\1:\\2;-ms-\\1:\\2;\\1:\\2;',
				'url('.$dir.'public/images/\\1)',
				' ',
				$dir,
				$dir.'public/',
				APP
			), $content);
			preg_match_all('/url\((.*?)\)/',$content, $match);
			$before = array();
			$after = array();
			foreach($match[0] as $key)$before[] = $key;
			foreach($match[1] as $val)$after[] = $this->url2bese64($val);
			$content = str_replace($before, $after, $content);
		}else{
			$content = 'if(typeof VSong !== \'object\')var VSong = {};VSong.cookieConfig = '.$this->json($this->config['cookie']).";\r\n$content";
		}
		
		$this->write($orgFile, $content);
		if($pack){
			$pack = __DIR__.'/../../cache/resource/'.APP."/$type/$name";
			$this->packer($pack.'.pack', array($pack.'.dll'));
			if($pack)return $execute;
		}else{
			$this->write($orgFile, $content);
		}
		return $type == 'css'?
			'<link resource="'.$type.'" rel="stylesheet" href="'.$path.'" />':
			'<script type="text/javascript" src="'.$path.'"></script>';
	}
	
	#获取变量值
	private function & getVariable($key)
	{
		if (isset($this->config['GLOBALS'][$key]))
		{
			return $this->config['GLOBALS'][$key];
		}
		else
		{
			global $$key;
			if (isset($$key))
			{
				$this->assign($key,$$key);
			}
			return $$key;
		}
	}
	

	# @ 获得语言
	private function lang($key)
	{
		return isset($this->language[$key])?$this->language[$key]:"{lang $key}";
	}
	# @ 加载语言
	# @ 参数：语言模块
	private function loadLanguage($modules = null)
	{	
		$language = $this->cookie('language');
		$this->config['language'] = $language?$language:$this->config['language'];
		$dir = __DIR__.'/../../language/'.APP.'/'.$this->config['language'];
		$modules = is_array($modules)?$modules:array($modules);
		foreach($modules as $file)
		{
			if(file_exists("$dir/$file.lang.php"))
			{
				$lang = include("$dir/$file.lang.php");
				if(is_array($lang))
				{
					$this->language += $lang;
				}
			}
		}
		
	}
	
	# @ 设置语言
	# @ 参数：键，值
	public function setLanguage($key, $value = NULL)
	{
		if (is_array($key))$this->language += $key;
		else $this->language[$key] = $value;
	}
	
	#输出模板
	public function displays($page = null)
	{
		$this->loadLanguage($page);//读取模块语言
		$this->loadLanguage('common');//读取公共语言
		$isCache = $this->config['cache'] && $this->config['cache_time'] > 0;
		if($isCache)
		{
			$file = $this->getPath($page,'cache');
			if(file_exists($file) && filemtime($file) + $this->config['cache_time'] > time())
			{
				$content = $this->read($file,13);
			}
		}
		$path = $this->compile($page);
		if(!file_exists($path))
		{
			trigger_error('编译文件不存在'.($path?'( <a style="color:#d30">'.$path.'</a> )':''),E_USER_ERROR);
			return;
		}
		if ($this->config['gzip'] && ereg('gzip',$_SERVER['HTTP_ACCEPT_ENCODING']))
		{
			ob_start('ob_gzhandler');
		}else{
			ob_start();
		}
		include($path);
		$content = ob_get_contents();
		if($isCache)$this->write($file,'<?php exit;?>'.$content);
		return $content;
	}
	
	#编译
	private function compile($page)
	{
		$files = array(
			'html'	=> $this->getPath($page),
			'php'	=> $this->getPath($page,'compile')
		);
		#判断模板文件是否存在
		if (!file_exists($files['html']))
		{
			$files['html'] = __DIR__.'/../../view/error.html';
			//trigger_error('模板文件 ( <a style="color:#d30">'.$page.'.tv</a> ) 不存在', E_USER_ERROR);
			//return;
		}
		if (!$this->config['compel']){
			$htmltime = file_exists($files['html'])?filemtime($files['html']):0;
			$phptime = file_exists($files['php'])?filemtime($files['php']):0;
			if($htmltime <= $phptime)return $files['php'];
		}
		#判断模板文件大小限制
		if (filesize($files['html']) > $this->config['max_file_size'] * 1024 * 1024)
		{
			trigger_error('模版文件 ( <a style="color:#d30">'.$page.'.tv</a> ) 大小超出最大限制 ('.$this->config['max_file_size'].' MB)', E_USER_ERROR);
			return;
		}

		#模板文件
		$data = $this->read($files['html']);
		
		#如果模板为空,不进行编译
		if (empty($data))
		{
			$this->write($files['php'], $data);
			return $files['php'];
		}
		preg_match_all('/\<include file\=\"(([\w|-|\/]{1,})|(\$([_a-zA-Z][\w]+)))\"(.*?)\>/', $data, $include);
		$incCount = count($include[0]);
		
		#模板文件嵌套调用处理
		for ($i=0;$i< $incCount;$i++)
		{
			#编译相应调入模板文件
			$data = str_replace($include[0][$i],$this->config['tag'][0].'eval include $this->compile(\''.$include[1][$i].'\')'.$this->config['tag'][1],$data);
		}
		unset($include);
		#获取模板所使用变量
		preg_match_all('/\$([_a-zA-Z][\w]+)/', $data, $globalVariable);

		if (is_array($globalVariable[1]))
		{
			$globalVariable[1] = array_unique($globalVariable[1]);
			$globalVar = array('this','_GET','_POST','_COOKIE','_SERVER','_SESSION','_FILES','_ENV');
			$output = '';
			foreach ($globalVariable[1] as $val)
			{
				if (!in_array($val, $globalVar))
				{
					$output .= '$'.$val.' =& $this->getVariable(\''.$val.'\'); ';
				}
			}
		}
	
		#判断是否允许插入PHP
		if (!$this->config['php_tag'] === true)
		{
			$data = preg_replace('/<\?(=|php|)(.+?)\?>/is','&lt;?\\1\\2?&gt;',$data);
		}
		
		$data = $this->tagConvert($data);#转换

		#整理输出缓存内容
		if($output)$data = "<?php $output ?>\r\n$data";

		$this->write($files['php'], $data);
		$path = $files['php'];
		unset($files);$data = NULL;
		return $path;
	}

	#转换标示符
	private function tagSymbol($tag){
		$count = strlen($tag);
		$array = array('{','}','[',']','$','(',')','*','+','.','?','\\','^','|');
		$tags = '';
		for ($i=0;$i<$count;$i++){
			$tags .= (in_array($tag[$i],$array)?'\\':'').$tag[$i];
		}
		return $tags;
	}

	private function tagConvert($data = ''){

		#取得有效标示
		$prefix = '(?<!!)'.$this->tagSymbol($this->config['tag'][0]);
		$suffix = '((?<![!]))'.$this->tagSymbol($this->config['tag'][1]);
		
		 #相关标签转换
		$search = array(
			'/\<resource type="(.*?)" name="(.*?)"\ time="(.*?)">(.*?)\<\/resource\>/si',
			'/__([A-Z]*)__/i',
			'/'.$prefix.'(else if|elseif) (.*?)'.$suffix.'/i',
			'/'.$prefix.'for (.*?)'.$suffix.'/i',
			'/'.$prefix.'while (.*?)'.$suffix.'/i',
			'/'.$prefix.'(loop|foreach) (.*?)'.$suffix.'/i',
			'/'.$prefix.'if (.*?)'.$suffix.'/i',
			'/'.$prefix.'else'.$suffix.'/i',
			'/'.$prefix."(eval|_)( |[\r\n])(.*?)".$suffix.'/is',
			'/'.$prefix.'(_e (.*?)|([A-Z_]*))'.$suffix.'/is',
			'/'.$prefix.'_p (.*?)'.$suffix.'/i',
			'/'.$prefix.'\/(if|for|loop|foreach|eval|while)'.$suffix.'/i',
			'/'.$prefix.'((( *(\+\+|--) *)*?(([_a-zA-Z][\w]*\(.*?\))|\$((\w+)((\[|\()(\'|")?\$*\w*(\'|")?(\)|\]))*((->)?\$?(\w*)(\((\'|")?(.*?)(\'|")?\)|))){0,})( *\.?[^ \.]*? *)*?){1,})'.$suffix.'/i',
			'/(	| ){0,}(\r\n){1,}\";/',
			'/'.$prefix.'(\#|\*)(.*?)(\#|\*)'.$suffix.'/',
			'/'.$prefix.'lang ([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)'.$suffix.'/',
			'/'.$prefix.':U((.*?))'.$suffix.'/i'
		);
		$replace = array(
			'<?php echo $this->resource(\'\\1\',\'\\2\',\\3,\'\\4\');?>',
			'<?php echo __\\1__;?>',
			'<?php }else if (\\2){ ?>',
			'<?php for (\\1) { ?>',
			'<?php while (\\1) { ?>',
			'<?php foreach ((array)\\2) { ?>',
			'<?php if (\\1){ ?>',
			'<?php }else{ ?>',
			'<?php \\3; ?>',
			'<?php echo \\1; ?>',
			'<?php print_r(\\1);?>',
			'<?php } ?>',
			'<?php echo \\1;?>',
			'',
			'',
			'<?php echo $this->lang(\'\\1\');?>',
			'<?php echo $this->url(\\1);?>'
		);
		
		#在有必要时 开启  
		#ksort($search);
		#ksort($replace);
		
		#执行正则分析编译
		$data = preg_replace($search, $replace, $data);
		unset($search, $replace);
		#过滤敏感字符 
		$data = str_replace(array('!'.$this->config['tag'][1],'!'.$this->config['tag'][0],'?><?php'),array($this->config['tag'][1],$this->config['tag'][0],''),$data);
		return $data;
	}
	#获取模版路径
	private function getPath($page = NULL, $name = NULL){
		$style = $this->config['style']?$this->config['style'].'/':'';
		switch($name){
			case 'cache'	: $name = 'cache/view/'.APP.'/'.md5($this->config['language'].$style.$page.md5($_SERVER['REQUEST_URI'])).'.php';break;
			case 'compile'	: $name = 'cache/compile/'.APP.'/'.md5($this->getPath($page.$style)).'.php';break;
			case 'dir'		: $name = $this->config['view'].'/'.APP.'/'.$style;break;
			default			: $name = $this->getPath($page,'dir')."/$page.html";break;
		}
		return $name;
	}
}