<?php $param =& $this->getVariable('param'); $_G =& $this->getVariable('_G');  ?>
<?php include $this->compile('common/header'); ?>
<style>
#play-mode,body[content] #disable-tips{ display:none;}
body[content] #play-mode,#disable-tips{ display:block;}
.logo{background-size:contain; height:30%; width:45%; top:10%;}
</style>
<div class="fxd r logo"></div>
<nav class="fxd justify" id="tab-tools">
  <a class="btn fbtn" data-action="left"><i class="icon icon-left" size="90"></i></a>
  <a class="btn fbtn" data-action="right"><i class="icon icon-right" size="90"></i></a>
</nav>
<div class="fxd list-box right r">
	<div class="list-box-head">
      <i></i>
      <div></div>
    </div>
    <?php $param = !empty($_G['param'][0])?$_G['param'][0]:'drum'; ?>
	<div id="play-mode" class="list-box-cont">
    	<a class="btn big fbtn vs-font" href="<?php echo $this->url(('home/list/'.$param.'-study'));?>" data-action="study"><span>教学模式</span></a>
    	<a class="btn big fbtn vs-font" href="<?php echo $this->url(('home/list/'.$param.'-train'));?>" data-action="train"><span>练习模式</span></a>
    	<a class="btn big fbtn vs-font" href="<?php echo $this->url(('home/list/'.$param.'-games'));?>" data-action="games"><span>游戏模式</span></a>
    </div>
	<div id="disable-tips" class="list-box-cont" align="center">
    	<div style="margin-bottom:30px;"><i class="icon icon-hello"></i></div>
        <div type="tips">
    	<i class="icon smile-warn" size="72"></i>
        [<a id="subjects-name"><?php echo $this->lang($param);?></a>] 未开启
        </div>
        <p style="margin-right:20px; text-align:right;">敬请期待！</p>
    </div>
    
</div>

<?php include $this->compile('common/footer'); ?>
