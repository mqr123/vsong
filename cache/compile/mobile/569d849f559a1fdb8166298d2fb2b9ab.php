<?php $_G =& $this->getVariable('_G');  ?>
<?php if (!$this->pjax){ ?><!doctype html>
<!--[if !IE]><!--><html class="w3c" <?php if (in_array($_G['page'],array('index'))){ ?>_manifest="<?php echo $this->url(('home/cache/'.$_G['page']));?>"<?php } ?>><!--<![endif]-->
<head>
<meta charset="utf-8">
<title><?php echo isset($_G['title'])?$_G['title']:$this->lang('vs_title');?> - <?php echo $this->lang('vs_name');?> <?php echo $this->lang('vs_version');?></title>

<meta name="renderer" content="webkit" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<!--<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no,minimal-ui">-->
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
<!--<meta name="mobile-web-app-capable" content="yes">-->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="#00a09d">

<?php echo $this->resource('css','mobile',3,'
	<file src="reset" />
	<file src="global" />
    <file src="main/style" />
    <file src="mobile/style" />
');?> 
<link rel="shortcut icon" href="<?php echo $_G['dir'];?>favicon.ico">
</head>
<body loading="500" mod="<?php echo $_G['mod'];?>" page="<?php echo $_G['page'];?>" app="<?php echo APP; ?>">
	<div class="fxd full" id="loading"></div>
	<!--<header>
		<div class="top_nav"><i class="icon bicon-back" size='22'></i></div>
		<img src="<?php echo $_G['dir'];?>public/images/member/logo.png"/>
	</header>-->
	
	
	<main>
	    <div class="warp">
			<div id="container">	
<?php } ?>