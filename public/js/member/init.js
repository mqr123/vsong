//
window.dir = VSong.dir;
VSong.getUrlParams = function(url) {
	url = url || document.URL;
	return url.split('//' + document.domain + window.dir)[1].split('/');
}

VSong.tools = {
	getUserGroup: function(id) {
		if(id < 0) return '违规用户';
		if(id >= 0 && id < 100) return '普通用户';
		if(id >= 100 && id < 150) return '版主';
		if(id >= 150 && id < 200) return '超级版主';
		if(id >= 200 && id < 250) return '管理员';
		if(id >= 250 && id <= 255) return '创始人';

	},
	getUserType: function(id) {
		switch(parseInt(id)) {
			case 1:
				id = '机构';
				break;
			case 2:
				id = '内部';
				break;
			case 3:
				id = '教师';
				break;
			case 4:
				id = '家长';
				break;
			default:
				id = '学员';
				break;
		}
		return id;
	},
	getUserGender: function(id, size) {
		if(size) return '<i class="icon icon-gender" gender="' + id + '" size="' + icon + '"></i>';
		switch(parseInt(id)) {
			case 1:
				id = '男';
				break;
			case 2:
				id = '女';
				break;
			default:
				id = '保密';
				break;
		}
		return id;
	}
}

VSong.init = function() {
	var root = this,
		showUsermenu = function(root) {
			var isEnter = false;
			$('header>.usermenu').on('mouseenter', function(e) {
				if(isEnter || root.user.uid <= 0) return;
				isEnter = 1;
				root.body.addClass('usermenu-open');
				this.onmouseleave = function() {
					this.onmouseleave = null;
					if(!isEnter) return;
					root.timeout(.5, function() {
						if(!isEnter) this.stop();
					}, function() {
						if(!isEnter) return;
						root.body.removeClass('usermenu-open');
						isEnter = null;
					});
				}
			});
			//退出事件
			root.body.click('.logout', function() {
				var box = new root.box({
					type: 'confirm',
					auto: 1,
					smile: 'warn',
					buttonText: '立即退出',
					content: '确定要退出当前帐号吗？',
					confirm: function() {
						var worker = new Worker(root.dir + 'member/common/logout');
						var error = function() {
							root.alert('退出失败');
						}
						var success = function() {
							root.self.location = root.dir;
						}
						worker.addEventListener('message', function(e) {
							if(e.data.type == 'success') {
								success();
							} else {
								error();
							}
						});
						worker.addEventListener('error', error);
					}
				});
			});

			//修改密码事件
			root.body.click('.changePsw', function() {
				var box = new root.box({
					type: 'confirm',
					title: '修改密码',
					buttonText: '确认修改',
					content: '<form id="change_box" action="'+root.appUrl+'/common/change"><div>' +
						'<label>' +
						'	 <span>原密码</span>' +
						'	 <input type="password" name="prePwd"  placeholder="请输入原密码" />' +
						'</label>' +
						'<label>' +
						'	 <span>新密码</span>' +
						'	 <input type="password" name="password" placeholder="请输入新密码" />' +
						'</label>' +
						'<label>' +
						'	 <span>确认密码</span>' +
						'	 <input type="password" name="surPwd"  placeholder="请再次输入密码" />' +
						'</label>' +
						'</div></form>',
					confirm: function() {
						//提交表单操作
						var changeBox = $('#change_box');
						changeBox.form({
							auto: true,
							dataType: 'json',
							check: function(data) {
								if(!data.prePwd) {
									root.alert('请填写原密码', 'warn');
									return;
								}
								if(data.prePwd == data.password) {
									root.alert('原密码和新密码一致', 'warn');
									return;
								}
								if(!data.password) {
									root.alert('请填写新密码', 'warn');
									return;
								}
								if(data.password.length<6) {
									root.alert('密码不小于6个字符', 'warn');
									return;
								}
								if(!data.surPwd) {
									root.alert('请再次输入密码', 'warn');
									return;
								}
								if(data.password != data.surPwd) {
									root.alert('两次密码不一致', 'warn');
									return;
								}
								return data;
							},
							success: function(json) {
								root.alert('修改成功', 'happy', 2, function() {
									box.close();
									var worker = new Worker(root.dir + 'member/common/logout');
									var error = function() {
										root.alert('退出失败');
									}
									var success = function() {
										root.self.location = root.dir;
									}
									worker.addEventListener('message', function(e) {
										if(e.data.type == 'success') {
											success();
										} else {
											error();
										}
									});
									worker.addEventListener('error', error);
								});
							},
							error: function(json) {
								root.alert(json.msg, 'sad', 2);
							}
						});
					}
				});
			});

			$('#member-menu').on('mouseenter', function() {
				isEnter = null;
				this.onmouseleave = function() {
					root.body.removeClass('usermenu-open');
					this.onmouseleave = null;
				}
			});
		};
	root.body = $(document.body);
	//视所有IE版本为非W3C标准浏览器
	if(root.self.navigator.userAgent.indexOf('Trident') != -1) $('html').removeClass('w3c');
	root.urls = root.getUrlParams();
	/*全屏*/
	root.fscn = new root.fullScreen(document.body);
	$('.fullscreen').click(root.fscn.toggle);
	root.alwaysFullscreen = function() {
		var screen = document.body.getAttribute('screen');
		if(screen != 'full' || root.self.screen.height != root.self.innerHeight) root.fscn.toggle();
	}

	//提示当前页码  下一页
	root.nextPage = function() {
		var local = window.location.href;
		console.log(local);
		var newUrl1 = local.split('-')[1];
		console.log(newUrl1);
		var newUrl2 = local.split('-')[0];
		var nextNum = $('#next-num').DOM[0].getAttribute('href').split('-')[1];
		var num = Number(newUrl1) + 1;
		if(newUrl1 == undefined) {
			root.load(newUrl2 + '/-' + '1')
		} else {
			if(Number(nextNum) <= Number(newUrl1)) {
				root.alert('当前页是最后一页', 'warn', 1);
			} else {
				root.load(newUrl2 + '-' + num);
			}
		}
	}
	//提示当前页码  上一页
	root.prevPage = function() {
		var local = window.location.href;
		var newUrl1 = local.split('-')[1];
		var newUrl2 = local.split('-')[0];
		var num = Number(newUrl1) - 1;
		if(newUrl1 == undefined) {
			root.alert('当前页是第一页', 'warn', 1, function() {
				root.load(newUrl2);
			});
		} else {
			if(newUrl1 == '1') {
				root.alert('当前页是第一页', 'warn', 1);
			} else {
				root.load(newUrl2 + '-' + num);
			}
		}

	}
	//数据提交删除   2017-10-18
	root.updata = function(formDom, ids) {
		var box = new root.box({
			type: 'confirm',
			auto: 1,
			smile: 'warn',
			title: '删除',
			buttonText: '确定',
			content: '确认删除吗？',
			confirm: function() {
				box.close();
				formDom.form({
					auto: true,
					dataType: 'json',
					check: function(data) {
						data.id = ids;
						return data;
					},
					success: function(json) {
						if(json.type == 'success') {
							root.alert('删除成功', 'happy', 2, function() {
								root.load();
							})
						}
					},
					error: function(json) {
						if(json.type == 'error') {
							root.alert('删除失败', 'sad', 2, function() {
								root.load();
							})
						}
					}
				});
			},
		});

	};

	//警告框
	root.alert = function(msg, smile, timeout, callback) {
		if(typeof smile === 'number') {
			if(timeout) callback = timeout;
			timeout = smile;
			smile = 'warn';
		}
		var box = new root.box({
			type: 'alert',
			smile: smile || 'warn',
			content: '<div type="tips">' + msg + '</div>',
			auto: 1,
			timeout: timeout || null,
			close: function() {
				callback && callback();
				box = null;
			}
		});
	};
	//Pjax
	var pjax = new root.pjax({
		selector: '.pjax',
		alwaysToSelf: true,
		container: '#container',
		titleSuffix: ' - VSong.TV',
		start: function() {
			document.body.classList.remove('ready');
			root.boxClear && root.boxClear();
		},
		complete: function() {

			root.modules.__construct(root);
		},
		selection: function(e) {}
	});
	root.resetUserData = function(user) {
		var html = ['', ''];
		if(typeof user === 'object') root.merge(root.user, user);
		if(root.user.uid <= 0 || user === null) {
			if(!user) {
				root.cookie('author', '', {
					expire: -1e5
				});
				root.user = {
					uid: 0,
					username: '',
					gender: 0,
					type: 0,
					group: 0,
					level: 0,
					exp: 0,
					score: 0,
					number: 0
				};
			}

			html[1] = '<a class="btn login"><span>登录</span></a> <a class="btn pjax" href="' + root.appUrl + '/common/register"><span>注册</span></a>';

		} else {
			var score = root.user.score > 0 && root.user.number > 0 ? root.user.score / root.user.number : 0;
			html[0] += '<div class="userinfo"><p class="ts">' + root.user.username + '</p><p><span title="UID"></span>' + root.user.uid + '</p></div>';
			html[0] += '<div class="userdata">' +
				'<p>' +
				'<span class="ilb" title="等级">' + root.user.level + '</span> ' +
				'<span class="ilb" title="类型"><a class="ilb">' + root.tools.getUserType(root.user.type) + '</a></span>' +
				'</p>' +
				'<p>' +
				'<span class="ilb" title="得分">' + score.toFixed(2) + '</span> ' +
				'<span class="ilb" title="权限"><a class="ilb">' + root.tools.getUserGroup(root.user.group) + '</a></span>' +
				'</p>' +
				'<p>' +
				'<span class="ilb" title="经验">' + root.user.exp + '</span> ' +
				'<span class="ilb" title="倍数">' + root.user.multiple + '</span>' +
				'</p>' +
				'<p><span class="ilb" title="注册时间"></span> <span class="il">' + root.date('Y/m/d', root.user.dateline) + '</span></p>' +
				'</div>';
			html[0] += '<div class="usermenu justify">' +
				'<a class="btn ts memberurl" href="' + root.url + 'member/manage/index"><i class="icon"></i>个人中心</a> ' +
				'<a id="backTo" class="btn ts pjax homepage"><i class="icon"></i>返回列表</a> ' +
				'<a class="btn ts logout"><i class="icon"></i>退出</a>' +
				'</div>';
			html[1] = '<a class="avatar"><img src="' + root.dir + 'avatar/small/' + root.user.uid + '" /></a>';
		}
		$('#member-menu').html(html[0]);
		$('header>.usermenu').html(html[1]);
		html.splice(0, 2);
		html = null;
	}
	root.load = function(url, options) {
		pjax.reload(url, options)
	}
	//在线
	root.online = function(data) {
		root.isOnline = true;
		root.resetUserData(data.user);
	}
	//离线
	root.offline = function(data) {
		root.isOnline = false;
		root.merge(root.user, {
			level: 0,
			socre: 0,
			number: 0,
			exp: 0
		});
		root.resetUserData();
	}

	showUsermenu(root);

	$(root.self).on('dragstart', function(e) {
		e.preventDefault();
		return false;
	}).on('mouseup', function() {
		document.body.classList.remove('eye-look');
	});
	root.ready();
	document.body.classList.add('ready');
	root.modules.__construct(root);
	
	
	
	//移动端“个人中心”导航判断
//	var browser = root.browser.platfrom;
//	if(browser=="iPhone"||browser=="Android"||browser=="WinPhone"){
//		$('body').attr('browser','mobile');
//	}
};