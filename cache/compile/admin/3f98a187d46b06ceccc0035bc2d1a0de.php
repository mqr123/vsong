<?php $_G =& $this->getVariable('_G');  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Vsong后台管理</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="Access-Control-Allow-Origin" content="*">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">

	<link rel="icon" href="<?php echo $_G['dir'];?>favicon.ico">
	<?php echo $this->resource('css','child_header',30,'
	  <file src="admin/layui" />
	  <file src="admin/main"/>
	  <file src="admin/user"/>
	  <file src="admin/district"/> 
	');?>
	<script>
		window.DIR = "<?php echo $this->dir;?>/";
	</script>
	
	<style type="text/css">
		.layui-form-item .layui-inline{ width:33.333%; float:left; margin-right:0; }
		@media(max-width:1240px){
			.layui-form-item .layui-inline{ width:100%; float:none; }
		}
	</style>
	
	<script type="text/javascript" src="<?php echo $this->dir;?>/public/js/layui/layui.js"></script>	
</head>