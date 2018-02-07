<?php
# 公共配置
return array(
	'tag'				=> '{}',					# 模板标签
	'view'				=> 'view',					# 模板目录
	'style'				=> null,					# 风格
	'compel'			=> false,					# 强制编译
	'gzip'				=> false,					# 开启GZIP压缩
	'php_tag'			=> true,					# 支持PHP标签
	'url_rewrite'		=> true,					# URL伪静态
	'cache'				=> true,					# 页面缓存(全局)
	'max_file_size'		=> 2,						# 文件大小最大限制MB
	'cache_time'		=> 3600,					# 缓存时间, 0 为不缓存
	'cache_static'		=> 604800,					# 静态缓存时间, 0 为不缓存
	'language'			=> 'chinese_simple',		# 语言目录
	'timezone'			=> 8,						# 时区
	'css_url2base64'	=> 64,						# 将css文件里的url转成base64， 最大文件限制，默认 8 KB，大于这个值则返回原路径。
	# COOKIE 配置
	'cookie' => array(
		'pre'		=> 'vSong_',	# Cookie前缀
		'expire'	=> 3600,		# 过期时间
		'path'		=> '/',			# 路径
		'domain'	=> ''			# 域名
	)
);
