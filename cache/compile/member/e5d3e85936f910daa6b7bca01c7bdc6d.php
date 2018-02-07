<?php $_G =& $this->getVariable('_G'); $data =& $this->getVariable('data'); $key =& $this->getVariable('key'); $total =& $this->getVariable('total');  ?>
<?php include $this->compile('common/header'); ?>
<div class="record">
	<!--<div class="record_nav">
		<a class="btn pjax open" mode='0'>学习</a>
		<a class="btn pjax" mode='1'>练习</a>
		<a class="btn pjax" mode='2'>游戏</a>
	</div>-->
	<div class="grade">
		<div class="chars_head">
			<div class="flt-l">
				<span>得分日志</span>
				<input page='study' state='pane'  type="date" value="<?php echo isset($_G['param'][0])?base64_decode($_G['param'][0]):date('Y-m-d',time());?>" />
			</div>
			<div class="iconS flt-r">
				 <i class="icon_m refresh btn" size="25"></i>
			</div>
		</div>
		
		<div id="chart_bar">
		
			<div class="vs-chart pane" type="pane" tip-x="分数/分" tip-y="时间/点" max="100" left="56" bottom="50" style="height:300px; min-width:520px; max-width:720px">
				<!--<?php foreach ((array)$data['list'] as $key) { ?>-->
				<option value="<?php echo $key['score'];?>"><?php echo date('H:i',$key['overtime']);?></option>
				<!--<?php } ?>-->
			</div>
		</div>
		
	</div>
	<div class="params">
		<div class="chars_head">
			<div class="flt-l">
				<span>演奏能力综合分析</span>
			</div>
			<div class="iconS flt-r">
				 <i class="icon_m refresh btn" size="25"></i>
			</div>
		</div>
		<div id="chart_pie" >
			<div class="vs-chart" style="min-height: 400px;" type="attr" color="rgba(0,180,170,.8)"  font-size="13">
				<!--<?php foreach ((array)$total['list'] as $k) { ?>-->
				<option color="#f60" max="100" value="<?php if ($k['number']!=0){  echo $k['score']/$k['number']; } ?>">得分</option>
				<option color="#00a09d" max="100" value="<?php if ($k['number']!=0){  echo $k['accuracy']/$k['number']; } ?>">乐感</option>
				<option color="#d6a" max="100" value="<?php if ($k['number']!=0){  echo $k['intensity']/$k['number']; } ?>">力度</option>
				<option color="#4CAF50" max="300" value="<?php echo $k['speed'];?>">速度</option>
				<!--<?php } ?>-->
			</div>
		</div>
		
	</div>
</div>
<?php include $this->compile('common/footer'); ?>