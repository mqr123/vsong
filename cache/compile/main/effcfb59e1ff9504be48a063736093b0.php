<?php include $this->compile('common/header'); ?>
<style>
#play-mode,body[content] #disable-tips{ display:none;}
body[content] #play-mode,#disable-tips{ display:block;}
.logo{background-size:contain; height:30%; width:50%;}
</style>
<div class="fxd r logo"></div>
<div class="fxd list-box right r">
	<div class="list-box-head">
      <i></i>
      <div></div>
    </div>
	<div id="play-mode" class="list-box-cont">
    	<div style="margin-bottom:30px;"><a class="btn pjax flt-r" href="<?php echo $this->url(('home/index'));?>">返回首页</a><i class="icon icon-hello"></i></div>
        <div type="tips">
            <i class="icon smile-sad" size="72"></i>
            404 Not Found.
        </div>
        <p style="margin:20px;" align="right">您访问的页面不存在.</p>
    </div>
    
</div>

<?php include $this->compile('common/footer'); ?>
