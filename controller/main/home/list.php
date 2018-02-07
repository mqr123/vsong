<?php

if(empty($this->param[1]))$this->display('error','common',1);
if(!$_G['user']['uid'])$this->display('login','common',1);
$this->display($this->param[1]);