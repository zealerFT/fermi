<?php
return array(
	/* 数据库设置 */
		'DB_TYPE'               =>  'mysqli',     		// 数据库类型
		'DB_HOST'               =>  '114.215.85.174', 		// 服务器地址
		'DB_NAME'               =>  'feitengblog',	// 数据库名
		'DB_USER'               =>  'root',      		// 用户名
		'DB_PWD'                =>  '84da2a5f48',        // 密码
		'DB_PORT'               =>  '3306',        		// 端口
    'DB_PREFIX'             =>  'f_',    // 数据库表前缀
    'DB_PARAMS'          	  =>  array(), // 数据库连接参数
    'DB_DEBUG'  			      =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
    'DB_DEPLOY_TYPE'        =>  0, // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
    'DB_RW_SEPARATE'        =>  false,       // 数据库读写是否分离 主从式有效
    'DB_MASTER_NUM'         =>  1, // 读写分离后 主服务器数量
    'DB_SLAVE_NO'           =>  '', // 指定从服务器序号
    'TMPL_TEMPLATE_SUFFIX'  =>  '.html',
    'URL_MODEL'             =>  2,
		'DEFAULT_MODULE'        => 'Home', // 默认模块
		'MODULE_ALLOW_LIST'     => array('Home','Admin'),
		'TOKEN'                 =>  'feiteng',  //WeChat的token验证值
		/* 模板引擎设置 */
		'TMPL_CONTENT_TYPE'     =>  'text/html', // 默认模板输出类型
		// //默认错误跳转对应的模板文件
		// 'TMPL_ACTION_ERROR' => 'Public:error';
		// //默认成功跳转对应的模板文件
		// 'TMPL_ACTION_SUCCESS' => 'Public:success';
    //'ACTION_CACHE_ON'       => false,//关闭控制器缓存
    /* 邮件配置 */
    'THINK_EMAIL' => array(
      'SMTP_HOST'   => 'smtp.exmail.qq.com', 	//SMTP服务器
      'SMTP_PORT'   => '465', 				//SMTP服务器端口
      'SMTP_USER'   => 'service@greatkeeper.com', //SMTP服务器用户名
      'SMTP_PASS'   => 'greatkeeper8664', 	//SMTP服务器密码
      'FROM_EMAIL'  => 'service@greatkeeper.com', //发件人EMAIL
      'FROM_NAME'   => 'theGreatKeeperAdmin', //发件人名称
      'REPLY_EMAIL' => '', 					//回复EMAIL（留空则为发件人EMAIL）
      'REPLY_NAME'  => '', 					//回复名称（留空则为发件人名称）
    ),

		/* 权限配置 */
		'AUTH_CONFIG' => array(
			'AUTH_ON'           => true,                      // 认证开关
			'AUTH_TYPE'         => 1,                         // 认证方式，1为实时认证；2为登录认证。
			'AUTH_GROUP'        => 'f_auth_group',        // 用户组数据表名
			'AUTH_GROUP_ACCESS' => 'f_auth_group_access', // 用户-用户组关系表
			'AUTH_RULE'         => 'f_auth_rule',         // 权限规则表
			'AUTH_USER'         => 'users'             // 用户信息表
		),
);
