<?php
//定义回调URL通用的URL
//define('URL_CALLBACK', 'http://blog.feiteng.com/Home/Login/callback/type/');
define('URL_CALLBACK', 'http://www.feiteng.ren/Home/Login/callback/type/');
return array(
    //'配置项'=>'配置值'
  //腾讯QQ登录配置
  'THINK_SDK_QQ' => array(
    'APP_KEY'    => '101386982', //应用注册成功后分配的 APP ID
    'APP_SECRET' => 'a05963f94c8ef17e303cf9f6d51e9f2b', //应用注册成功后分配的KEY
    'CALLBACK'   => URL_CALLBACK . 'qq',
  ),
  //新浪微博配置
  'THINK_SDK_WEIBO' => array(
    'APP_KEY'    => '1629609478', //应用注册成功后分配的 APP ID
    'APP_SECRET' => 'f34abf261b65440c563b8d1f97c06d53', //应用注册成功后分配的KEY
    'CALLBACK'   => URL_CALLBACK . 'weibo',
  ),
  //腾讯微博配置
  'THINK_SDK_TENCENT' => array(
    'APP_KEY'    => '', //应用注册成功后分配的 APP ID
    'APP_SECRET' => '', //应用注册成功后分配的KEY
    'CALLBACK'   => URL_CALLBACK . 'tencent',
  ),
  //人人网配置
  'THINK_SDK_RENREN' => array(
    'APP_KEY'    => '', //应用注册成功后分配的 APP ID
    'APP_SECRET' => '', //应用注册成功后分配的KEY
    'CALLBACK'   => URL_CALLBACK . 'renren',
  ),
  //360配置
  'THINK_SDK_X360' => array(
    'APP_KEY'    => '', //应用注册成功后分配的 APP ID
    'APP_SECRET' => '', //应用注册成功后分配的KEY
    'CALLBACK'   => URL_CALLBACK . 'x360',
  ),
  //豆瓣配置
  'THINK_SDK_DOUBAN' => array(
    'APP_KEY'    => '', //应用注册成功后分配的 APP ID
    'APP_SECRET' => '', //应用注册成功后分配的KEY
    'CALLBACK'   => URL_CALLBACK . 'douban',
  ),
  //Github配置
  'THINK_SDK_GITHUB' => array(
    'APP_KEY'    => '', //应用注册成功后分配的 APP ID
    'APP_SECRET' => '', //应用注册成功后分配的KEY
    'CALLBACK'   => URL_CALLBACK . 'github',
  ),
  //Google配置
  'THINK_SDK_GOOGLE' => array(
    'APP_KEY'    => '', //应用注册成功后分配的 APP ID
    'APP_SECRET' => '', //应用注册成功后分配的KEY
    'CALLBACK'   => URL_CALLBACK . 'google',
  ),
  //MSN配置
  'THINK_SDK_MSN' => array(
    'APP_KEY'    => '', //应用注册成功后分配的 APP ID
    'APP_SECRET' => '', //应用注册成功后分配的KEY
    'CALLBACK'   => URL_CALLBACK . 'msn',
  ),
  //点点配置
  'THINK_SDK_DIANDIAN' => array(
    'APP_KEY'    => '', //应用注册成功后分配的 APP ID
    'APP_SECRET' => '', //应用注册成功后分配的KEY
    'CALLBACK'   => URL_CALLBACK . 'diandian',
  ),
  //淘宝网配置
  'THINK_SDK_TAOBAO' => array(
    'APP_KEY'    => '', //应用注册成功后分配的 APP ID
    'APP_SECRET' => '', //应用注册成功后分配的KEY
    'CALLBACK'   => URL_CALLBACK . 'taobao',
  ),
  //百度配置
  'THINK_SDK_BAIDU' => array(
    'APP_KEY'    => '', //应用注册成功后分配的 APP ID
    'APP_SECRET' => '', //应用注册成功后分配的KEY
    'CALLBACK'   => URL_CALLBACK . 'baidu',
  ),
  //开心网配置
  'THINK_SDK_KAIXIN' => array(
    'APP_KEY'    => '', //应用注册成功后分配的 APP ID
    'APP_SECRET' => '', //应用注册成功后分配的KEY
    'CALLBACK'   => URL_CALLBACK . 'kaixin',
  ),
  //搜狐微博配置
  'THINK_SDK_SOHU' => array(
    'APP_KEY'    => '', //应用注册成功后分配的 APP ID
    'APP_SECRET' => '', //应用注册成功后分配的KEY
    'CALLBACK'   => URL_CALLBACK . 'sohu',
  ),
);
