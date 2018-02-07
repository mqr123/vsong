<?php $_G =& $this->getVariable('_G'); $sceneTypes =& $this->getVariable('sceneTypes'); $sWhere =& $this->getVariable('sWhere'); $sp =& $this->getVariable('sp'); $sdb =& $this->getVariable('sdb'); $scene =& $this->getVariable('scene'); $msWhere =& $this->getVariable('msWhere'); $key =& $this->getVariable('key'); $myScene =& $this->getVariable('myScene');  ?>
<?php if ($_G['user']['uid']){ ?>
<!--<?php if (!empty($_G['param'][1])){ ?>-->
<!--<?php
$sceneTypes = array('study'=>1,'train'=>2,'games'=>3);
$sWhere = "`type`='0'";
if(array_key_exists($_G['param'][1], $sceneTypes)){
	$sWhere .= " or `type`='".$sceneTypes[$_G['param'][1]]."'";
}
$sp = !empty($_G['param'][2])?$_G['param'][2]:1;
$sdb = new DB('scene');
$scene = $sdb->cache(3600,'scene-hd')->where($sWhere)->field('id,title,level,price')->limit(30,$sp)->select();
$msWhere = "`uid`='".$_G['user']['uid']."' and `id` in (";
foreach($scene['list'] as $key){
	if($key['price']>0)$msWhere.= $key['id'].',';
}
$msWhere = trim($msWhere,',').')';
$sdb = new DB('my_scene');
$myScene = $sdb->where($msWhere)->field('id')->search();
$scene['my'] = array();
foreach($myScene as $key)array_push($scene['my'],$key['id']);
?>-->
<nav style="margin:14px 55px auto auto;" class="nav fxd t r"><a class="btn pjax" href="<?php echo $this->url(('/'));?>"><span>返回</span></a></nav>
<?php if ($scene['length']>0){ ?>
<div class="abs" id="scene-list" total="<?php echo $scene['total'];?>" data-page="<?php echo $scene['page'];?>" data-length="<?php echo $scene['length'];?>" data-total="<?php echo $scene['total'];?>">
	<div class="vs-border"></div>
	<a class="abs fx tls prev" href="javascript:void(0);" tabindex="1"></a>
	<a class="abs fx tls next" href="javascript:void(0);" tabindex="2"></a>
	<div class="abs fx list-head"></div>
	<div class="abs fx list-main">
		<div class="list">
		<?php foreach ((array)$scene['list'] as $key) { ?>
			<?php $key['isbuy'] = in_array($key['id'],$scene['my']); ?>
			<a level="<?php echo $key['level'];?>" data-id="<?php echo $key['id'];?>" isbuy="<?php echo $key['price']==0 || $key['isbuy']?1:0;?>">
				<div>
					<h3><?php echo $key['title'];?></h3> 
					<p>
						<span>等级：<i><?php echo $key['level'];?></i> 级</span>
						<!--
						<?php if ($key['isbuy']){ ?>
						<span>已购买</span>
						<?php }else{ ?>
						<span>价格：<?php if ($key['price']>0){ ?><i><?php echo $key['price'];?></i> 元<?php }else{ ?>免费<?php } ?></span>
						<?php } ?>
						-->
						<span>今日免费</span>
					</p>
				</div>
				<img src="<?php echo $this->url(('../data/scene/'.$key['id'].'/thumb.jpg'));?>"/>
			</a>
		<?php } ?>
		</div>
	</div>
	<div class="abs fx list-foot"></div>
</div>
<?php }else{ ?>
<style>#music-list{ top:0}</style>
<?php } ?>
<!--<?php }else{ ?>-->
<style>#music-list{ top:0}</style>
<!--<?php } ?>-->
<style type="text/css">
body[mod="home"][page="list"] header{ display:none}
</style>
<?php }else{ ?>
<style type="text/css">
body[mod="home"][page="list"] header{ display:block}
</style>
<?php } ?>