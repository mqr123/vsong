<?php $_G =& $this->getVariable('_G'); $subjects_list =& $this->getVariable('subjects_list'); $subjects_enabled =& $this->getVariable('subjects_enabled'); $nav =& $this->getVariable('nav'); $cookiePname =& $this->getVariable('cookiePname'); $home =& $this->getVariable('home'); $key =& $this->getVariable('key'); $val =& $this->getVariable('val');  ?>
<?php if (!$this->pjax){ ?><!doctype html>
<!--[if !IE]><!--><html class="w3c cur" <?php if (in_array($_G['page'],array('index'))){ ?>_manifest="<?php echo $this->url(('home/cache/'.$_G['page']));?>"<?php } ?>><!--<![endif]-->
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

<?php echo $this->resource('css','main',3,'
	<file src="reset" />
	<file src="global" />
    <file src="main/style" />
    <file src="main/modules" />
');?> 
<link rel="shortcut icon" href="<?php echo $_G['dir'];?>favicon.ico">
</head>

<!--/*
<?php 
$subjects_list = array('drum','guitar','piano','saxphone','violin');
$subjects_enabled = array('drum');
$nav = array(
	'home'		=> array('首页','home/index'),
	'summery'	=> '公司简介',
	'down'		=> array('下载','home/download'),
	'help'	=> array('帮助','home/help'),
	'advice'	=> array('意见反馈','home/advice')
);
$cookiePname = $this->cookie('subjects_name',false);
$home = !empty($_G['param'][0]) && in_array($_G['param'][0],$subjects_list)?$_G['param'][0]:($cookiePname?$cookiePname:'drum');

; ?>
*/-->
<body loading="500" mod="<?php echo $_G['mod'];?>" page="<?php echo $_G['page'];?>" app="<?php echo APP; ?>" <?php if (in_array($home,$subjects_enabled)){ ?>content="<?php echo $home;?>"<?php } ?>>
<div class="fxd full" id="loading"></div>
<div class="fxd full" id="background">
  <div class="bg fxd full" style="background-image:url(<?php echo $this->url(('../public/images/main/bg-'.$home.'.jpg'));?>)"></div>
</div>
<a class="btn fullscreen min500"><i class="icon icon-screen" size="36"></i></a>
<div class="fxd t r" id="member-menu"></div>
<!--/* Interface Start */-->
<div class="fxd full" id="interface">
    <!--/* Header Start */-->
    <header class="fxd fx t bgc-dark justify">
    	<nav class="nav flt-r usermenu"></nav>
    	<nav class="nav comm">
        <?php foreach ((array)$nav as $key => $val) { ?>
			<?php if ($key != 'summery'){ ?>
            <a class="btn min600 <?php if ($_G['mod'].'/'.$_G['page'] == $val[1]){ ?>open<?php } ?> pjax" href="<?php echo $this->url(($val[1].(!empty($val[2])?'/'.$val[2]:'')));?>"><span><?php echo $val[0];?></span></a>
			<?php }else{ ?>
			<a class="btn min600" target="_blank" onclick="$('a.btn.min600.open').removeClass('open');$(this).addClass('open')" href="<?php echo $this->url(('../member/home/summary'));?>"><span><?php echo $val;?></span></a>
			<?php } ?>
        <?php } ?>
        </nav>
    </header>
    <!--/* Header End */-->
    
	<!--/* Navigation Start */-->
	<nav id="nav"></nav>
    <!--/* Navigation End */-->
    
    <!--/* Container Start */-->
    <main id="container">
<?php } ?>