<?php $spage =& $this->getVariable('spage'); $_G =& $this->getVariable('_G'); $page =& $this->getVariable('page'); $db =& $this->getVariable('db'); $music =& $this->getVariable('music'); $url =& $this->getVariable('url'); $prev =& $this->getVariable('prev'); $next =& $this->getVariable('next'); $pdot =& $this->getVariable('pdot'); $ndot =& $this->getVariable('ndot'); $range =& $this->getVariable('range'); $mmWhere =& $this->getVariable('mmWhere'); $key =& $this->getVariable('key'); $sdb =& $this->getVariable('sdb'); $myScene =& $this->getVariable('myScene');  ?>
<?php include $this->compile('common/header'); ?>
<!--<?php
$spage = !empty($_G['param'][2]) && is_numeric($_G['param'][2])?$_G['param'][2]:1;
$page = !empty($_G['param'][3]) && is_numeric($_G['param'][3])?$_G['param'][3]:1;
$db = new DB('music');
$music = $db->cache(3600)->limit(20,$page)->order('dateline',true)->select();
$url = $this->url('home/list/'.$_G['param'][0].'-'.$_G['param'][1].'-'.$spage);
$prev = $music['page']-1;
if($prev<1)$prev=1;
$next = $music['page']+1;
if($next>$music['total'])$next = $music['total'];
$pdot = '...';
$ndot = '...';
$range = $next > $page && $prev > 1? 2 : 5;

$mmWhere = "`uid`='".$_G['user']['uid']."' and `id` in (";
foreach($music['list'] as $key){
	if($key['price']>0)$mmWhere.= $key['id'].',';
}
$mmWhere = trim($mmWhere,',').')';
$sdb = new DB('my_music');
$myScene = $sdb->where($mmWhere)->field('id')->search();
$music['my'] = array();
foreach($myScene as $key)array_push($music['my'],$key['id']);
?>-->
<div class="fxd vs-list">
	<?php include $this->compile('common/scene'); ?>
	<div class="abs vs-list" id="music-list">
		<div class="abs list-head"></div>
		<div class="abs list-main">
			<div class="abs mlist">
				<?php if (count($music['list'])>0){ ?>
				<?php foreach ((array)$music['list'] as $key) { ?>
				<?php $key['isbuy'] = in_array($key['id'],$music['my']); ?>
				<a class="btn" data-id="<?php echo $key['id'];?>" level="<?php echo $key['level'];?>" isbuy="<?php echo $key['price']==0 || $key['isbuy']?1:0;?>">
					<?php 
					//$key['price'] = $key['price']==0 || $key['isbuy']?'开始游戏':('￥'.$key['price'].'元');
					$key['price'] = '今日免费';
					; ?>
					<span class="tools btn48 flt-r"><b x="<?php echo $key['price'];?>"><?php echo $key['price'];?></b></span>
					<span class="title" lv="1"><i class="icon icon-note"></i> <?php echo $key['title'];?></span>
					<span class="singer eps" x="艺人" title="<?php echo $key['singer'];?>"><?php echo $key['singer']?$key['singer']:'未知';?></span>
					<span class="author eps"><b>上传/<?php echo $key['author'];?></b><i class="dateline eps flt-r"><?php echo date('Y-m-d',$key['dateline']);?></i></span>
					<span></span>
				</a>
				<?php } ?>
				<?php }else{ ?>
				<a class="pjax" style="height:auto;" href="<?php echo $url.'-'.$next;?>">
					<span></span>
					<span>
						<i class="icon flt-l smile-warn" size="72" style="margin-right:1em"></i>
						404 Not Found!
						<p style="font-size:14px; text-align-last:center">没有更多数据，点此返回！</p>
					</span>
					<span></span>
				</a>
				<?php } ?>
			</div>
		</div>
		<div class="page abs fx">
			<div class="list">
			<?php if ($prev>1){ ?>
			<a class="btn pjax tls first" href="<?php echo $url.'-1';?>">&laquo;</a>
			<a class="btn pjax tls prev" href="<?php echo $url.'-'.$prev;?>">&larr;</a>	
			<?php } ?>
			<?php for ($i=1;$i <= $music['total'];$i += 1) { ?>
			<?php if ($i > $page - $range && $i < $page + $range){ ?>
			<?php if ($music['page'] == $i){ ?>
				<a class="open ilb"><?php echo $i;?></a>
			<?php }else{ ?>
				<a class="btn pjax" href="<?php echo $url.'-'.$i;?>"><?php echo $i;?></a>
			<?php } ?>
			
			<?php }else if ($page < $prev + 2 && $pdot){ ?>
			<?php echo $pdot;$pdot = null; ?>
			
			<?php }else if ($page > $next + 2 && $ndot){ ?>
			<?php echo $ndot;$ndot = null; ?>
			<?php } ?>
			<?php } ?>
			<?php if ($next > $page){ ?>
			<a class="btn pjax tls next" href="<?php echo $url.'-'.$next;?>">&rarr;</a>
			<a class="btn pjax tls last" href="<?php echo $url.'-'.$music['total'];?>">&raquo;</a>
			<?php } ?>
			</div>
		</div>
		<div class="abs list-foot"></div>
	</div>
</div>
<?php include $this->compile('common/footer'); ?>