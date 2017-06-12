<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'	=> 'mysql',
	'DB_HOST'	=> '127.0.0.1',
	'DB_NAME'	=> 'shop',
	'DB_USER'	=> 'root',
	'DB_PWD'	=> 'root',
	'LOG_RECORD' => true,
	'DB_SLQ_LOG' => true,
	'SALT'		=> 'j6I0YU5',
	//默认false 表示URL区分大小写 true则表示不区分大小写
	'URL_CASE_INSENSITIVE' => true,
	// URL访问模式,可选参数0,1,2,3,代表4种模式:
	// 0 (普通模式); 1 (PATHINFO模式); 2 (REWRITE 模式); 3 (兼容模式) 默认是1
	'URL_MODEL' => 2,
	// PATHINFO 模式下,各参数之间的分隔符
	//'URL_PATHINFO_DEPR' => '/'
);