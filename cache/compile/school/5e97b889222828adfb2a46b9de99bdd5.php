<?php $_G =& $this->getVariable('_G'); $nav =& $this->getVariable('nav'); $nav2 =& $this->getVariable('nav2'); $key =& $this->getVariable('key'); $arr =& $this->getVariable('arr'); $data =& $this->getVariable('data'); $value =& $this->getVariable('value');  ?>
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

<?php echo $this->resource('css','school',3,'
	<file src="reset" />
	<file src="global" />
    <file src="main/style" />
    <file src="school/style" />
');?> 
<link rel="shortcut icon" href="<?php echo $_G['dir'];?>favicon.ico">
</head>
<!--<?php
	
$nav = array(
	//机构自己的首页地址
	'index'		=> array('首页',$this->url('../subsite'),0),
	'manage'	=> array('管理中心',$this->url('/'),1),
	'recharge'	=> array('个人中心',$this->url('../member/manage/index'),0),
	//'setting'	=> array('设置',$this->url('../member/home/setting'),0),
	//'help'		=> array('帮助',$this->url('../main/home/help'),0)
);
$nav2 = array(
	'wallet'    => '我的钱包',
	'index'		=> '机构信息',
	'student'	=> '我的学员',
	//'teacher'	=> '教师管理',
	//'material'	=> '我的教材',
	'release'	=> '发布中心'
); 

?>-->
<body loading="500" mod="<?php echo $_G['mod'];?>" page="<?php echo $_G['page'];?>" app="<?php echo APP; ?>">
<div class="fxd full" id="loading"></div>
<header>
	<div class="warp justify">
		<nav>
			<a class="logo flt-l" href="<?php echo $this->url(('../'));?>" ></a>
		
			<?php foreach ((array)$nav as $key => $arr) { ?>
			<a class="btn<?php if ($arr[2]){ ?> pjax open<?php } ?>" href="<?php echo $arr[1].'/home/index/'.$_G['user']['uid'];?>"><?php echo $arr[0];?></a>
			<?php } ?>
		</nav>
		<nav>
			<a class="btn changePsw">修改密码</a>
			<a class="btn ts logout">退出</a>
		</nav>
	</div>
</header>
<main>
	<div class="warp">
	<aside>
		<div class="information-box">
			<a href="<?php echo $this->url(('home/message/unread'));?>" class="btn pjax message">
				<span class="icon_s icon-infor icon_infor"></span>
				<i class="icon_s icon-readSmall" type="0"></i>
			</a>
		</div>
		<div class="userinfo">
			<!--<?php foreach ((array)$data['list'] as $key) { ?>-->
			<!--<p><?php echo $key['name'];?></p>-->
			<!--<?php } ?>-->
			<a class="avatar" href="<?php echo $this->url(('home/index'));?>">
				<img width="100%" src="<?php echo $this->url(('../avatar/big/'.$_G['user']['uid']));?>">
				<span class="gender">
					<i class="icon_s icon-gender" gender="<?php echo $_G['user']['gender'];?>"></i>
				</span>
			</a>
			<p><?php echo $_G['user']['uid']?'UID: '.$_G['user']['uid']:'游客';?></p>
			
		</div>
		<?php foreach ((array)$nav2 as $key => $value) { ?>
		
		<?php if ($key=='release'){ ?>
		<a class="btn pjax" href=" <?php echo $this->url(('home/release/news'));?>"><i class="icons icon-<?php echo $key;?>"></i><span class="h_span"> <?php echo $value;?></span></a>
		<?php }else{ ?>
		<a class="btn pjax" href="<?php echo $this->url(('home/'.$key));?>"><i class="icons icon-<?php echo $key;?>"></i><span class="h_span"> <?php echo $value;?></span></a>
		<?php } ?>
		
		
		<!--<a class="btn pjax" href="<?php echo $this->url(('home/'.$key));?>"><i class="icons icon-<?php echo $key;?>"></i><span class="h_span"><?php echo $value;?></span></a>-->
		<?php } ?>
	</aside>	
	<div id="container">
<?php } ?>