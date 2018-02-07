<?php $data =& $this->getVariable('data'); $key =& $this->getVariable('key');  ?>
<?php include $this->compile('common/header'); ?>
<style>
	.helpPage{background: #fff;border-radius: 10px;margin: 100px auto 0;width: 70%;}
	.helpPage>div{padding: 30px;color:#6B6B6B;line-height: 30px;}
	.quest_help{padding: 5px 0;border-top: 1px solid #e8f2f2;}
	.quest_help:nth-of-type(2){border-top: none;}
	.question{color: #00A09D;}
	.title_help{border-bottom: 1px solid #e8f2f2;}
	.title_help span{display:inline-block;padding: 10px 0;margin-right: 30px;border-bottom: 2px solid transparent;}
	.title_help span:hover,.title_help span.open{color: #00A09D;border-color: #00A09D;background: none;}
	.btn_cont{display: none;}
	.btn_cont.open{display: block;}
	.quest_type{font-size: 0;overflow: hidden;background: #f8f8f8;}
	.quest_type>a{color: #999;font-size:18px;display: inline-block;line-height: 50px;width: 20%;float: left;text-align: center;}
	.quest_type>a.open{color: #00A09D;background: #e9f4f4;}
	.quest_type>a:hover{color: #00A09D;}
	/*使用流程*/
	.use-book{padding: 20px 0;color: #00A09D;}
	.use-book>p{margin-left: 15px;}
	.use-book>p:before{content:'';width: 8px;height: 8px;background: #00A09D;position: absolute;margin: 10px 0 10px -15px;transform: rotate(45deg);}
</style>
	<div class="helpPage">
		<div>
			<div class="title_help">
				<span class="btn" state='0'>使用流程</span>
				<span class="btn open" state='1'>常见问题</span>
			</div>
			<!--使用流程-->
			<div class="btn_cont">
				<div class="use-book">
					<p>学生使用流程</p>
				</div>
				<div class="use-book">
					<p>机构使用流程</p>
				</div>
			</div>
			
			<!--常见问题-->
			<div class="btn_cont open">
				<!--问题分类-->
				<div class="quest_type">
					<a class="btn open" data-type='0'>教学</a>
					<a class="btn" data-type='1'>游戏</a>
					<a class="btn" data-type='2'>练习</a>
					<a class="btn" data-type='3'>技术</a>
					<a class="btn" data-type='4'>产品</a>
				</div>
				<?php foreach ((array)$data as $key) { ?>
				<div class="quest_help">
					<p class="question"><m>Q:</m><?php echo $key['question'];?></p>
					<p><m>A:</m><?php echo $key['answer'];?></p>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php include $this->compile('common/footer'); ?>
