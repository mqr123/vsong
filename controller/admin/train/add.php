<?php
//param 传入的参数
if(!empty($this->param[0]) && $this->param[0] == 'post'){
    $check=array(
        'name' =>array(
            'min'	=> array(1,'添加的练习名称不能小于1个字符')
        ),
        'level' =>array(
            'min'	=> array(1,'添加的等级不能小于1个字符')
        )
    );

    #表单处理器
    $form		= $this->form('train');

    #处理结果提示
    $success	= '添加成功';
    $error		= '添加失败';
//	网址
    $url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
    $form
        ->check($check)
        #数据唯一性
        ->only('name,link')

        #设置表单项

        ->set('link',$url)

        #打包表单
        ->pack('name,link,level')

        #提交表单
        ->submit('insert', $success, $error);

    $result = $form->result();
    #清理缓存
    if($result['type'] == 'success'){
        $this->clear('train','trainList');
    }

    #输出处理结果
    echo $this->json($result);exit;

}else{
    $this->assign('param', $this->param);#向模板注入变量
    $this->display();#显示模板
}



