<?php $_G =& $this->getVariable('_G'); $nav =& $this->getVariable('nav'); $nav2 =& $this->getVariable('nav2'); $agent =& $this->getVariable('agent'); $is_mobile =& $this->getVariable('is_mobile'); $key =& $this->getVariable('key'); $value =& $this->getVariable('value');  ?>
<?php $_G['is_school_session'] = $this->cookie('is_school_session');
	  $_G['school_stats'] = $this->cookie('school_stats');
?>
<?php if (!$this->pjax){ ?><!doctype html>
<!--[if !IE]><!--><html class="w3c" <?php if (in_array($_G['page'],array('index'))){ ?>_manifest="<?php echo $this->url(('home/cache/'.$_G['page']));?>"<?php } ?>><!--<![endif]-->
<head>
<meta charset="utf-8">
<title><?php echo isset($_G['title'])?$_G['title']:$this->lang('vs_title');?> - <?php echo $this->lang('vs_name');?> <?php echo $this->lang('vs_version');?></title>

<meta name="renderer" content="webkit" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta name="viewport" content="width=device-width,initial-scale=1, user-scalable=no" />
<meta name="MSSmartTagsPreventParsing" content="True" />
<meta http-equiv="MSThemeCompatible" content="Yes" />

<!--针对移动端-->
<meta itemprop="name" content="VSong.view - Demo">
<meta itemprop="description" content="VSong.view - Demo">
<meta itemprop="image" content="">

<meta property="og:url" content="">
<meta property="og:type" content="article">
<meta property="og:title" content="VSong Execute - Demo">

<meta property="og:image" content="">
<meta property="og:description" content="VSong.view - Demo">
<meta property="og:site_name" content="VSong.view - Demo">

<meta name="theme-color" content="#00a09d">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="#00a09d">

<?php echo $this->resource('css','member',3,'
	<file src="reset" />
	<file src="global" />
    <file src="main/style" />
    <file src="member/style" />
');?> 
<link rel="shortcut icon" href="<?php echo $_G['dir'];?>favicon.ico">
</head>
<!--<?php
	$nav = array(
		'manage'	=> '个人中心',
		'index'		=> '加盟',
		'school'	=> '管理中心',
		'recharge'	=> '充值',
		//'setting'	=> '设置',
	);
	$nav2 = array(
		'study'		=> '学习记录',
		'index'		=> '常用资料',
		//'depot'		=> '仓库管理',
		'buy'		=> '购买记录',
		'pay'	=> '充值记录',
		'count'		=> '统计信息'
	);
	$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	$is_mobile = (strpos($agent, 'windows nt')) ? false : true; 
	if($_G['user']['type'] == 1  && $_G['school_stats']==2 && $is_mobile){
		unset($nav['school']);
	}
	if($_G['user']['type'] == 1  && $_G['school_stats']==2 ){
		unset($nav['index']);
	}
	else if($_G['user']['type'] == 1 && $_G['school_stats']!=2 && $is_mobile){
		unset($nav['school']);
	}else if($_G['user']['type'] == 0){
		unset($nav['school']);
	}
?>-->
<body loading="500" mod="<?php echo $_G['mod'];?>" page="<?php echo $_G['page'];?>" app="<?php echo APP; ?>">
	<div class="fxd full" id="loading"></div>
	<header>
	<div class="warp justify">
			<a class="logo flt-l" href="<?php echo $this->url(('../'));?>" ></a>
		
		<!--<?php if ((!empty($_G['user']['uid']))){ ?>-->
		<nav class='memberNav flt-r'>
			<a class="btn" href="<?php echo $this->url(('../'));?>">首页</a>
			<!--<?php foreach ((array)$nav as $key => $value) { ?>-->
			<!-- <?php if (isset($_G['is_school_session']) && $key=='school'){ ?> -->
			<a class="btn <?php echo $key;?>" href="<?php echo $this->url(('../../school/home/index'));?>" title="<?php echo $key;?>"><?php echo $value;?></a>	
			<!-- <?php }else{ ?> -->
			<a class="btn pjax <?php echo $key;?>" href="<?php echo $this->url(($key=='manage'?$key.'/study':'home/'.$key));?>"><?php echo $value;?></a>
			<!-- <?php } ?> -->
			<!--<?php } ?>-->
			
			<a class="btn changePsw">修改密码</a>
			<a class="btn ts logout">退出</a>
			
		</nav>
		<!--<?php } ?>-->
	</div>
	 <div class="slogan">
		<img src="<?php echo $_G['dir'];?>public/images/member/s_logo.png">
		<p>维颂，赢在音乐的起跑线</p>
	</div>
	</header>
<main>
    <div class="warp">
    	<div>
	    <aside type="userinfo">
			<div>
				 <i class="icon icon-gender" gender="<?php echo $_G['user']['gender'];?>"></i>	
				 <i size="16" class="icon icon-gender" gender="<?php echo $_G['user']['gender'];?>"></i>	
				<a class="avatar pjax" href="<?php echo $this->url(('manage/index'));?>">
					
					<img src="<?php echo $this->url(('../avatar/big/'.$_G['user']['uid']));?>"/>
				</a>
			</div> 
			<div><?php if ($_G['user']['uid']){ ?>UID: <?php echo $_G['user']['uid']; }else{ ?>游客<?php } ?></div>
		
			<aside type="manage">
				<!--<?php foreach ((array)$nav2 as $key => $value) { ?>-->
<!--				<a class="btn pjax <?php echo $key;?>" href="<?php echo $this->url(('manage/'.$key));?>"><i class="icon manage-<?php echo $key;?>"></i><?php echo $value;?></a> -->
				 <a class="btn pjax <?php echo $key;?>" href="<?php echo $this->url(('manage/'.$key));?>"><i class="icon_m manage-<?php echo $key;?>" size='45'></i><?php echo $value;?></a>
				<!--<?php } ?>-->
			</aside>
		</aside>
		</div>
		<div class="cont">
			<div id="container">
				
<?php } ?>