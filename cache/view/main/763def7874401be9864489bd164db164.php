<?php exit;?>
<div class="fxd logo frame-head"></div>
<div class="fxd fy r frame-cont">
	<div class="list-box fx">
    	<div class="list-box-head">
        	<i></i>
            <div></div>
        </div>
    	<div class="list-box-cont form">
        <form id="form-login" onKeyUp="if(event.keyCode == 13){ for(var i=0;i<this.length;i+=1){
					if(this[i].type!='hidden' && this[i].name){
						if(this[i].value == ''){
							this[i].focus();
							return;
						}
					}
				};$('a.vBox-confirm',this).click()}" action="/main/common/login/071c84b0c874b36aa4807ee6d4ca6849">
        	<div class="items clr">
            	<h3>用户登录</h3>
            </div>
        	<div class="items">
            	<label>
                	<span><i class="icon icon-user"></i> 帐　号</span>
                	<div><input class="i1 i2" maxlength="15" name="account" autocomplete="off" autofocus type="text" placeholder="手机、用户名、UID"></div>
                </label>
            </div>
        	<div class="items pwd">
            	<a class="btn tls openyoureye"><i class="icon eye" size="22"></i></a>
            	<label>
                	<span><i class="icon icon-pass"></i> 密　码</span>
                	<div>
                    	<input class="i1 i2" maxlength="32" name="password" type="password" placeholder="请输入密码" oninput="$('#look-password').val(this.value)">
                        <input id="look-password" style="margin-top:11px;" class="i1 i2" type="text" placeholder="请输入密码">
                    </div>
                </label>
            </div>

        	<div class="items clr" align="center">
            	<label>
                	<span></span>
                	<div>
                      <a class="btn login-submit vBox-confirm pjax" formid="form-login"><span>立即登录</span></a>
                      <a class="btn pjax" href="/main/common/register"><i class="icon icon-btn"></i> 没有帐号，点此注册</a>
                    </div>
                </label>
            </div>
            <div class="items clr" style="height:60px;">
				            	<input type="hidden" name="formhash" value="54ec738d" />
            </div>
        </form>
        </div>
    </div>
</div>
	</main>
    <!--/* Container End */-->
    <footer>

    </footer>
<!--/* Interface End */-->
</div>
<script>
var VSong = {
	//程序版本号
	version: 1,
	//引擎版本号
	engineVersion:'2.0',
	// 解包进度
	executeProgress:function(f,p){
		console.log('Loaded:', f, p);
	},
	// 解包完成
	executeComplete:function(){
		console.log('Unpack completed.', this);
	},
	workerMod:'common',//锁定worker模块
	useWorker:true,//是否使用worker
	lang:{"vs_name":"VSong","vs_title":"维颂科技","vs_url":"http:\/\/vsong.tv\/?mod=vsong","vs_version":"2.0","drum":"架子鼓","guitar":"吉他","piano":"钢琴\/键盘","saxphone":"萨克斯","violin":"提琴"},
	subjects:null,
	enabled:null};
</script>
<script class="VSONG-SCRIPT-CONFIG" src="/public/js/pack.min.js?v=1.4"></script><script>(function(root){root.dir = '/';root.name = 'main';root.mod = 'home';root.page = 'list';root.packURL = '/main/pack/list/main-3-1.0.pack';root.workerPath = 'public/js/worker.min.js';root.user = {"uid":0,"gender":0,"group":0,"username":"","type":0};root.ecode = '071c84b0c874b36aa4807ee6d4ca6849';root.execute(root.packURL,root.mainProgress || null, root.mainComplete || null);var vsc = document.querySelectorAll('script,.VSONG-SCRIPT-CONFIG');for(var i=0;i<vsc.length;i+=1)document.body.removeChild(vsc[i]);})(VSong);</script></body>
</html>
