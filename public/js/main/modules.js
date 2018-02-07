
VSong.modules = {
	__construct:function(root,pjax){
		var func = this[root.mod+'_'+root.page];
		//四级地区联查
		root.district(root,'.vs-district',root.dir+root.name+'/common/district/');
		//cookie自动续期
		if(root.user.uid>0){
			var author = root.cookie('author');
			root.cookie('author',author,{expire:root.cookieConfig.expire});
		}
		root.backUrl = document.URL;
		//初始化模块函数
		if(typeof func === 'function')func(root,pjax);
		else if(func == 404)root.alert('页面正在建设中，请稍候访问！',3,function(){root.load(root.appUrl)});
	},
	home_index:function(root){
		var subjects = root.subjects || ['drum','guitar'];
		var proIndex = subjects.indexOf(root.body.attr('content'));
		var disabled = false;
		var backgrounds = $('#background').DOM[0];
		var backgroundArray = [];
		$('#tab-tools>a.btn').click(function(){
			if(disabled)return;
			disabled = true;
			var action = $(this).data('action');
			if(action == 'left'){
				proIndex -= 1;
				if(proIndex <0)proIndex = subjects.length-1;
			}
			if(action == 'right'){
				proIndex += 1;
				if(proIndex >= subjects.length)proIndex = 0;
			}

			root.body.addClass('bg-loading');
			var img = new Image();
			img.src = root.dir + 'public/images/'+root.name+'/bg-'+subjects[proIndex]+'.jpg';
			if(!backgroundArray[proIndex]){
				var bg = document.createElement('div');
				bg.style.backgroundImage = 'url('+img.src+')';
				bg.className = 'bg fxd full';
				backgrounds.appendChild(bg);
				bg = null;
			}else{
				backgrounds.appendChild(backgroundArray[proIndex]);
			}
			img.onload = function(){
				root.body.removeClass('bg-loading');
				document.title = root.lang[subjects[proIndex]] + ' - VSong.TV';
				history.replaceState({}, root.lang[subjects[proIndex]], root.appUrl + '/home/index/' + subjects[proIndex]);
				if(root.enabled && root.enabled.indexOf(subjects[proIndex])==-1){
					//root.alert((root.lang[subjects[proIndex]] || '该学科')+'未开启！','sad',2);
					$('#subjects-name').text(root.lang[subjects[proIndex]]);
					root.body.removeAttr('content');
				}else{
					root.cookie('subjects_name',subjects[proIndex],{expire:316e5});
					root.body.attr('content',subjects[proIndex]);
				}
				root.timeout(0.6, null, function(){
					disabled = false;
					var list = backgrounds.querySelectorAll('.bg');
					if(list.length>1){
						backgrounds.removeChild(list[0]);
					}
				});
				
				img = null;
			};
			img.onerror = function(){
				root.body.removeClass('bg-loading');
				disabled = false;
				img = null;
			}
		});
		
		/*模式列表*/
		$('#play-mode>a.btn').on('click',function(e){
			e.preventDefault();
			var action = $(this).data('action');
			var url = root.dir+root.name+'/home/list/'+subjects[proIndex]+'-'+action;
			root.backUrl = url;
			root.load(url, this.textContent + ' - ' + root.lang[subjects[proIndex]]);
			return false;
		});
	},
	home_list:function(){
		
	},
	home_download:function(root){
		$('#download-page>.bottom a[data-type]').click(function(e) {
            root.alert('客户端暂未上线，详情请关注我们微信公众号！','warn',5);
        });
	},
	common_register:function(root){
		var formDom = $('#form-regsiter');
		var handle = {
			username:{min:3,max:15,match:/^([\u0391-\uFFE5]{1}|[a-zA-Z]{1})+([a-zA-Z0-9_\u0391-\uFFE5])+$/},
			password:{min:6,max:32},
			phone:{min:11,max:11,match:/^(1[3-9]{1}[0-9]{9})$/},
			smscode:{match:/([1-9]{1})+(\d*$)/}
		}
		var check = function(key,value){
			var dom = $('input[name="'+key+'"]',formDom.DOM[0]);
			if(handle[key]){
				var min = handle[key].min;
				if(min && value.length<min){
					root.alert(dom.data('lang')+'不能小于 '+min+' 个字符',2,function(){dom.focus();formDom.disabled = false;});
					return;
				}
				var max = handle[key].max;
				if(max && value.length>max){
					root.alert(dom.data('lang')+'不能大于 '+max+' 个字符',2,function(){dom.focus();formDom.disabled = false;});
					return;
				}
				var match = handle[key].match;
				if(match && !match.test(value)){
					root.alert(dom.data('lang')+'格式不正确',2,function(){dom.select().focus();formDom.disabled = false;});
					return;
				}
			}
			return true;
		}
		var register_submit = function(){
			if(formDom.disabled)return;
			formDom.disabled = true;
			var form = formDom.form({
				auto:true,
				dataType:'json',
				check:function(data){
					for(var k in data){
						if(!check(k,data[k]))return;
					}
					return data;
				},
				success:function(json){
					root.alert(json.msg || '注册成功',1,function(){
						if(root.goto)root.self.location = json.goto;
						root.resetUserData(json.data);
						root.load(root.appUrl);
					})
				},
				error:function(json){
					var msg = typeof json === 'string'?json:(json.msg || '内部错误');
					root.log(json,'Error','color:red');
					root.alert(msg,2,function(){
						formDom.disabled = false;
					});
				}
			});
		}
		$('a.btn.submit',formDom.DOM[0]).click(register_submit);
		$('input',formDom.DOM[0]).on('focus',function(){
			var pnode = this.parentNode.parentNode.parentNode;
			pnode.classList.add('focus');
		}).on('blur',function(){
			var pnode = this.parentNode.parentNode.parentNode;
			pnode.classList.remove('focus');
		});
		formDom.on('keyup',function(e){
			if(e.keyCode == 13){
				for(var i=0;i<this.length;i+=1){
					if(this[i].type!='hidden' && this[i].type!='radio' && this[i].name){
						if(this[i].value == ''){
							this[i].focus();
							return;
						}
					}
				}
				register_submit();
			}
		});
	},
	home_list:function(root,pjax){
		if(root.user.uid==0)return;
		var defultSceneListIndex = function(c){return window.sceneListIndex>=0?window.sceneListIndex:1}
		if(root.urls[4]){
			root.windows(root.dir + 'game/frame/index/'+root.urls[4]+'/'+root.urls[3],{sceneListIndex:defultSceneListIndex()});
			return;
		}
		var sceneDom = document.getElementById('scene-list');
		var musicDom = document.getElementById('music-list');
		if(!sceneDom)return;
		var param = root.urls[3].split('-');
		var spage = param[2]?parseInt(param[2]):1;
		var mpage = param[3]?parseInt(param[3]):1;
		var selected = function(arr,i){
			if(arr.length == 0)return;
			$(sceneDom).removeClass('isFirst isLast');
			$('.list>a',sceneDom).removeClass('selected start');
			if(arr.length>=2){
				if(arr[i-1]){
					arr[i-1].classList.add('start');
				}else{
					sceneDom.classList.add('isFirst');
					arr[i].classList.add('start');
				}
			}
			if(arr.length == 1){
				arr[0].classList.add('start');
				$(sceneDom).addClass('isFirst isLast');
			}else if(i == arr.length-1){
				sceneDom.classList.add('isLast');
			}
			arr[i].classList.add('selected');
			sceneDom.value = $(arr[i]).data('id') || 0;
			window.sceneListIndex = i;
		}
		var sceneInit = function(){
			var scene = $('.list-main>.list>a',sceneDom);
			var slen = scene.DOM.length;
			var index = defultSceneListIndex(1);
			var total = parseInt(sceneDom.getAttribute('total') || 1);
			$('#scene-list>a.tls').on('click',function(){
				var _this = this;
				var isNext = this.classList.contains('next');
				if(total > 1){
					if(sceneDom.classList.contains('isFirst') && !isNext){
						root.load(root.appUrl + '/home/list/'+param[0]+'-'+param[1]+'-'+(spage<total?spage+1:1)+'-'+mpage);
						return;
					}
					if(sceneDom.classList.contains('isLast') && isNext){
						root.load(root.appUrl + '/home/list/'+param[0]+'-'+param[1]+'-'+(spage>1?spage-1:total)+'-'+mpage);
						return;
					}
				}
				scene.each(function(dom,i){
					if(dom.classList.contains('selected')){
						index = i;
						$(dom).removeClass('selected');
					}
				});
				index += isNext?1:-1;
				index = Math.max(index,0);
				index = Math.min(index,slen-1);
				var parents = scene.DOM[index].parentNode.parentNode.parentNode;
				//var isbuy = parseInt(scene.DOM[index].getAttribute('isbuy')||0);
				
				selected(scene.DOM,index);
			});
			selected(scene.DOM,index);
		}
		sceneInit();
		
		var selectDom = $('.mlist>a',musicDom);
		var selectPage = $('.page>.list>a');
		var selection = 0;
		var selectType = 'music';
		selectDom.each(function(dom,index){
			dom.setAttribute('tabindex',index);
			dom.setAttribute('music',index);
			dom.music = index;
		}).on('click',function(){
			var url = root.dir + 'game/frame/index/'+sceneDom.value + '-' + (this.getAttribute('data-id') || 0)+'/'+root.urls[3];
			var title = $('span.title',this).text() + ' - VSong.TV';
			if(document.body.stats != 'full')root.fscn.action('full');
			root.windows(url,title,{sceneListIndex:defultSceneListIndex()});
			root.noteOn = null;
		});
		selectPage.each(function(dom,index){
			index = selectDom.DOM.length + index;
			dom.setAttribute('tabindex',index);
			dom.index = index;
		});
		$('.mlist>a[music="'+(window.musicListIndex || 0)+'"]',musicDom).focus();
		root.controls({self:window}).on = function(e){
			if(document.body.classList.contains('game'))return root.noteOn = null;
			if(e.intensity<30)return;
			if(e.keyCode == 46)return $('a.tls.prev').click();
			if(e.keyCode == 42 || e.keyCode ==44)return $('a.tls.next').click();
			if([38,40,35,36].indexOf(e.keyCode)!=-1){
				if(selectDom.DOM.length==0)return;
				selectType = 'music';
				selection = $('[music="'+(window.musicListIndex||0)+'"]').DOM[0].music || 0;
				if(e.keyCode == 38 || e.keyCode == 40)selection -= 1;
				else selection += 1;
				if(selection<0)selection = selectDom.DOM.length-1;
				if(selection >= selectDom.DOM.length)selection = 0;
				window.musicListIndex = selection;
				return $('.mlist>a[music="'+selection+'"]').focus();
			}
			if(e.keyCode == 48 || e.keyCode ==47){
				if(selectPage.DOM.length==0)return;
				var opened = $('.page>.list>a.open');
				selectType = 'page';
				selection = opened.DOM,length>0?opened.DOM[0].index:0;
				if(e.keyCode == 47)selection += 1;
				else selection -= 1;
				if(selection < selectDom.DOM.length)selection = selectPage.DOM.length + selectDom.DOM.length - 1;
				if(selection >= selectPage.DOM.length + selectDom.DOM.length)selection = selectDom.DOM.length;
				var dom = $('.page>.list>a[tabindex="'+selection+'"]');
				if(dom.DOM.length==0)return;
				if(!dom.DOM[0].href)return dom.click();
				else return root.load(dom.DOM[0].href);
			}else if([49,52,55,57].indexOf(e.keyCode)!=-1){
				$('[music="'+(window.musicListIndex||selection)+'"]').click();
			}
		}
	},
	home_advice:function(root){
		$('#vcode').click(function(){
			var url = this.getAttribute('url') + '?s=' + Date.now();
			this.innerHTML = '<i class="btn verify" style="background-image:url('+url+')"></i>';
		});
		if(root.user.uid==0){
			root.load(root.dir+'main/common/login');
			return;
		}
		$('textarea').on('keyup',function(){
			var num = $('textarea').val().length;
			$('span.words').text(num+"/500字");
			if(num===500){
				$('span.words').css('color','red');
			}else{
				$('span.words').css('color','#9fb1b1');
			}
		})
		var adviceBox = $('#adviceBox');
		$('#adviceBtn').click(function(){
			adviceBox.form({
				auto:true,
				dataType:'json',
				check:function(data){
					if(data.type){
						data.type = $('input[type=radio]:checked').val();
					}
					if(!data.connect){
						root.alert('请输入内容', 'warn');
						return;
					}
					if(!data.phone){
						root.alert('请填写联系方式','warn');
						return;
					}
					if(!data.vcode){
						root.alert('请填写验证码','warn');
						return;
					}
					return data;
				},
				success:function(json){
					if(json.type == "success"){
						root.alert(json.msg || '数据提交成功',2,function(){
							window.location.href='';
						});
					}
				},
				error:function(json){
					if(json.type == "error"){
						root.alert(json.msg||'操作失败','sad',2);
					}
				}
			})
		})
	},
	home_help:function(root){
		$('.title_help span').click(function(){
			var index = $(this).attr('state');
			$('.title_help span.open').removeClass('open');
			$('.btn_cont.open').removeClass('open');
			$('.title_help span').DOM[index].classList.add('open');
			$('.btn_cont').DOM[index].classList.add('open');
		})
		$('.quest_type>a').click(function(){
			$('.quest_type>a.btn.open').removeClass('open');
			$(this).addClass('open');
		})
	}
}
