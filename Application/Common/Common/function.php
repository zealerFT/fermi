<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: fermi
// +----------------------------------------------------------------------
// | 放些公共的方法，并且不涉及接口等比较单一的类调用方法，也可以放这
// +----------------------------------------------------------------------
/**
 * 传递数据以易于阅读的样式格式化后输出
 * @param int $data 数据
 * @param int $type
 * @return result
 */
if (!function_exists('debug')) {
    function debug($data, $type = '')
    {
        // 定义样式
      $str='<pre style="display: block;padding: 9.5px;margin: 44px 0 0 0;font-size: 13px;line-height: 1.42857;color: #333;word-break: break-all;word-wrap: break-word;background-color: #F5F5F5;border: 1px solid #CCC;border-radius: 4px;">';
      // 如果是boolean或者null直接显示文字；否则print
      if (is_bool($data)) {
          $show_data=$data ? 'true' : 'false';
      } elseif (is_null($data)) {
          $show_data='null';
      } else {
          $show_data=print_r($data, true);
          $str.=$show_data;
          $str.='</pre>';
          echo $str;
          exit;
      }
    }
}

/**
 * 检测参数是否有值
 * @param $data  数字、字符串、数字字符串数组
 * @return bool true:有值；false未设置、为空、空值
 */
function checkParamRecursive($data)
{
    if (!isset($data) || is_null($data)) {
        return false;
    }
    if (is_string($data)) {
        $data = trim($data);
    }
    if (empty($data)) {
        return false;
    }
    if (is_array($data)) {//数组检测
                foreach ($data as $value) {
                    if (checkParamRecursive($value)) {
                    } else {
                        return false;
                    }
                }
    }
    return true;
}
/**
 * 检测参数是否有值
 * @param $data,$data...   参数个数任意、类型可为数字、字符串、数字字符串数组
 * @return bool true:全部有值；false至少有一个数组成员，未设置、为空、空值
 */
function checkParam()
{
    $data = func_get_args();
    if (empty($data)) {//空数组
                return false;
    }
    foreach ($data as $value) {
        if (checkParamRecursive($value)) {
        } else {
            return false;
        }
    }
    return true;
}

/**
 * 实例化分页类
 * @param int $count 总数
 * @param int $pageNum 每页显示记录数
 * @param $class 分页点击样式，一般外层是整体控制，而内部点击需要单独写，在使用框架时可以很好的控制
 * @return object $page
 */
function createPage($count, $pageNum)
{
    $count = (int)($count);
    if (checkParam($count, $pageNum) && $count>0 && is_int($pageNum)) {
        //$Page = new \Think\Page($count, $pageNum);
        $Page = new \Org\Nx\Page($count, $pageNum);
        $Page->lastSuffix = false;
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('first', '首页');
        $Page->setConfig('last', '尾页');
        $page = $Page->show();
        return $page;
    }
    return '1';
}

/**
 * 实例化分页类-ajax
 * @param $count 总数
 * @param $pageNum 每页显示记录数
 * @param $fun  调用换页的ajax函数名
 * @param $pageNo 当前页数
 * @param $parameter 分页跳转的参数 array
 * @param $class 分页点击样式，一般外层是整体控制，而内部点击需要单独写，在使用框架时可以很好的控制
 * @return mixed|string
 */
function ajaxCreatePage($count, $pageNum, $fun, $pageNo, $parameter = '', $class = '')
{
    $count = (int)$count;
    $pageNum = (int)$pageNum;
    if (checkParam($count, $pageNum) && $count>0) {
        $Page = new \Think\AjaxPage($count, $pageNum, $fun, $parameter, $class); //第三个参数是你需要调用换页的ajax函数名
                $Page->lastSuffix = false;
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('first', '首页');
        $Page->setConfig('last', '尾页');
        $page = $Page->show($pageNo); // 产生分页信息，AJAX的连接在此处生成
                return $page;
    }
    return '1';
}

/**
 * 生成随机数
 * 用来给上传图片重新命名
 */
function guid()
{
    if (function_exists('com_create_guid')) {
        return com_create_guid();
    } else {
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
            .substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid, 12, 4).$hyphen
            .substr($charid, 16, 4).$hyphen
            .substr($charid, 20, 12)
            .chr(125);// "}"
        return $uuid;
    }
}

/**
 * app 图片上传
 * @return string 上传后的图片名
 */
function app_upload_image($path, $maxSize=52428800)
{
    ini_set('max_execution_time', '0');
    // 去除两边的/
    $path=trim($path, '.');
    $path=trim($path, '/');
    $config=array(
        'rootPath'  =>'./',         //文件上传保存的根路径
        'savePath'  =>'./'.$path.'/',
        'exts'      => array('jpg', 'gif', 'png', 'jpeg','bmp'),
        'maxSize'   => $maxSize,
        'autoSub'   => true,
        );
    $upload = new \Think\Upload($config);// 实例化上传类
    $info = $upload->upload();
    if ($info) {
        foreach ($info as $k => $v) {
            $data[]=trim($v['savepath'], '.').$v['savename'];
        }
        return $data;
    }
}

/**
 * 上传单个文件
 * @return string
 */
function uploadOne($file)
{
    $time = date('Ymd');
    $upload = new \Think\Upload();                                       // 实例化上传类
    $upload->maxSize = 20*1024*1024;                                     // 设置附件上传大小
    $upload->exts = array('jpg', 'png', 'gif', 'jpeg', 'bmp', 'pdf', 'doc');  // 设置附件上传类型
    $upload->rootPath = '../Upload/';                                    // 设置附件上传根目录
    $upload->savePath = 'layui/image/'.$time.'/';                        // 设置附件上传（子）目录
    $upload->saveName = array('guid','');                                //上传文件的保存规则，支持数组和字符串方式定义
    //$upload->saveExt = 'jpg';                                          //上传文件的保存后缀，不设置的话使用原文件后缀
    $upload->autoSub  = false;                                           //自动创建目录
    $upload->replace  = true;                                            //同名替换
    $info = $upload->uploadOne($_FILES[$file]);                          //执行上传操作调用上传方法upload，$info是当前数据对象
    if (!$info) {
        $this->error($upload->getError());
    } else {
        return $info['savepath'].$info['savename'];
    }
}

/**
 * app 视频上传
 * @return string 上传后的视频名
 */
function app_upload_video($path, $maxSize=52428800)
{
    ini_set('max_execution_time', '0');
    // 去除两边的/
    $path=trim($path, '.');
    $path=trim($path, '/');
    $config=array(
        'rootPath'  =>'./',         //文件上传保存的根路径
        'savePath'  =>'./'.$path.'/',
        'exts'      => array('mp4','avi','3gp','rmvb','gif','wmv','mkv','mpg','vob','mov','flv','swf','mp3','ape','wma','aac','mmf','amr','m4a','m4r','ogg','wav','wavpack'),
        'maxSize'   => $maxSize,
        'autoSub'   => true,
        );
    $upload = new \Think\Upload($config);// 实例化上传类
    $info = $upload->upload();
    if ($info) {
        foreach ($info as $k => $v) {
            $data[]=trim($v['savepath'], '.').$v['savename'];
        }
        return $data;
    }
}

/**
 * 上传单个文件-图瀑
 * @return string
 */
function uploadOneWaterfall($file)
{
    $time = date('Ymd');
    $upload = new \Think\Upload();                                       // 实例化上传类
  $upload->maxSize = 20*1024*1024;                                     // 设置附件上传大小
  $upload->exts = array('jpg', 'png', 'gif', 'jpeg', 'bmp', 'pdf', 'doc');  // 设置附件上传类型
  $upload->rootPath = './Upload/';                                    // 设置附件上传根目录
  $upload->savePath = 'picwaterfall/images/'.$time.'/';                        // 设置附件上传（子）目录
  $upload->saveName = array('guid','');                                //上传文件的保存规则，支持数组和字符串方式定义
  //$upload->saveExt = 'jpg';                                          //上传文件的保存后缀，不设置的话使用原文件后缀
  $upload->autoSub  = false;                                           //自动创建目录
  $upload->replace  = true;                                            //同名替换
  $info = $upload->uploadOne($_FILES[$file]);                          //执行上传操作调用上传方法upload，$info是当前数据对象
  if (!$info) {
      $this->error($upload->getError());
  } else {
      return $info['savepath'].$info['savename'];
  }
}


/**
 * 上传多个图片
 * @return array
 */
function uploadPictures($fielname, $type='')
{
    $time = date('Ymd');
    if (!empty($type)) {
        $path = "../Upload/houseproductpic/".$time."/";
        $path1 = "/Upload/houseproductpic/".$time."/";
    } else {
        $path = "../Upload/productpic/".$time."/";
        $path1 = "/Upload/productpic/".$time."/";
    }
      //上传文件
      $upload = new \Org\Other\PicUpload();                                     // 实例化上传类
      $upload -> set("path", $path);
    $upload -> set("maxsize", 50*1024*1024);
    $upload -> set("allowtype", array("gif", "png", "jpg","jpeg",'bmp'));
    $upload -> set("israndname", ture);
    if ($upload -> upload($fielname)) {
        $data = $upload->getFileName();
        foreach ($data as $key => $value) {
            $result[$key]['url'] = $path1.$data[$key];
            $result[$key]['name'] = $data[$key];
        }
        return $result;
    } else {
        return $upload->getErrorMsg();
    }
}


  function get_country_name($id)
  {
      $result = S('m_country_'.$id);
      if (empty($result)) {
          $data = M('m_country')->where("id = '%s'", array($id))->getField('name');
          if ($data) {
              $result = $data;
          }
          S('m_country_'.$id, $data);
      }
      return $result;
  }

  /**
   * 生成图片验证码
   * @param  $width   宽
   * @param  $height  高
   */
  function verify($width, $height, $id = '')
  {
      $config =    array(
          'imageW'      =>    $width,
          'imageH'      =>    $height,
          'fontSize'    =>    20,    // 验证码字体大小
          'length'      =>    4,     // 验证码位数
          'useNoise'    =>    false, // 关闭验证码杂点
          'useCurve'    =>    false, // 是否画混淆曲线
          'codeSet'     =>  '0123456789',             // 验证码字符集合
          'useImgBg'    =>  true,           // 使用背景图片
          'fontttf'     =>  '5.ttf',         // 验证码字体，不设置随机获取
      );
      ob_clean();
      $Verify = new \Think\Verify($config);
      $Verify->entry($id);
  }

  /**
   * 检测验证码
   * @param  [string] $code 验证码的值
   * @param  string $id   验证码标识
   * @return [blooen]
   */
  function check_verify($code, $id = '')
  {
      $verify = new \Think\Verify();
      return $verify->check($code, $id);
  }

  /**
   * 发送短信，单程
   * @param  [string] $mobile  手机号
   * @param  [string] $content 发送内容
   * @return [array]          返回信息
   */
  function send_sms_oneway($mobile, $content)
  {
      $retData['isSuccess'] = false;
      Vendor('nusoap.nusoap');
      $client = new nusoap_client('http://www.jianzhou.sh.cn/JianzhouSMSWSServer/services/BusinessService?wsdl', true);
      $client->soap_defencoding = 'utf-8';
      $client->decode_utf8 = false;
      $client->xml_encoding = 'utf-8';
      $params = array(
          'account' => 'sdk_huiyu',
          'password' => 'GreatKeeper2016',
          'destmobile' => $mobile,
          'msgText' => $content . "【创赢房管家】",
      );
      $result = $client->call('sendBatchMessage', $params);
      $err = $client->getError();
      if ($err) {
          $retData['errMsg'] = $err;
      } else {
          $code = $result['sendBatchMessageReturn'];
          if ($code > 0) {
              $retData['msg'] = '发送成功';
          } else {
              switch ($code) {
                  case -1:
                      $retData['errMsg'] = '余额不足';
                      break;
                  case -2:
                      $retData['errMsg'] = '帐号或密码错误';
                      break;
                  case -3:
                      $retData['errMsg'] = '连接服务商失败';
                      break;
                  case -4:
                      $retData['errMsg'] = '超时';
                      break;
                  case -5:
                      $retData['errMsg'] = '其他错误，一般为网络问题，IP受限等';
                      break;
                  case -6:
                      $retData['errMsg'] = '短信内容为空';
                      break;
                  case -7:
                      $retData['errMsg'] = '目标号码为空';
                      break;
                  case -8:
                      $retData['errMsg'] = '用户通道设置不对，需要设置三个通道';
                      break;
                  case -9:
                      $retData['errMsg'] = '捕获未知异常';
                      break;
                  case -10:
                      $retData['errMsg'] = '超过最大定时时间限制';
                      break;
                  case -11:
                      $retData['errMsg'] = '目标号码在黑名单里';
                      break;
                  case -12:
                      $retData['errMsg'] = '消息内容包含禁用词语';
                      break;
                  case -13:
                      $retData['errMsg'] = '没有权限使用该网关';
                      break;
                  case -14:
                      $retData['errMsg'] = '找不到对应的Channel ID';
                      break;
                  case -17:
                      $retData['errMsg'] = '没有提交权限，客户端帐号无法使用接口提交';
                      break;
                  case -20:
                      $retData['errMsg'] = '超速提交(一般为每秒一次提交)';
                      break;
                  default:
                      $retData['errMsg'] = '未知';
              }
          }
      }

      return $retData;
  }

 /**
  * 系统邮件发送函数
  * @param string $to    接收邮件者邮箱
  * @param string $name  接收邮件者名称
  * @param string $subject 邮件主题
  * @param string $body    邮件内容
  * @param string $attachment 附件列表
  * @return boolean
  */
 function send_email($to, $name, $subject = '', $body = '', $attachment = null)
 {
     date_default_timezone_set('Asia/Shanghai');
     $config = C('THINK_EMAIL');
     Vendor('Email.phpmailer');
     $mail = new \PHPMailer(); //PHPMailer对象
        $mail->CharSet = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
        $mail->IsSMTP();  // 设定使用SMTP服务
        $mail->SMTPDebug = 0;                     // 关闭SMTP调试功能
        $mail->SMTPAuth = true;                  // 启用 SMTP 验证功能
        $mail->SMTPSecure = 'ssl';                 // 使用安全协议
        $mail->Host = $config['SMTP_HOST'];  // SMTP 服务器
        $mail->Port = $config['SMTP_PORT'];  // SMTP服务器的端口号
        $mail->Username = $config['SMTP_USER'];  // SMTP服务器用户名
        $mail->Password = $config['SMTP_PASS'];  // SMTP服务器密码
        $mail->SetFrom($config['FROM_EMAIL'], $config['FROM_NAME']);
     $replyEmail = $config['REPLY_EMAIL'] ? $config['REPLY_EMAIL'] : $config['FROM_EMAIL'];
     $replyName = $config['REPLY_NAME'] ? $config['REPLY_NAME'] : $config['FROM_NAME'];
     $mail->AddReplyTo($replyEmail, $replyName);
     $mail->Subject = $subject;

        //邮件主体内容
        $mail->MsgHTML($body);
     $mail->Body = $body;
     $mail->AddAddress($to, $name);
     if (is_array($attachment)) { // 添加附件
                foreach ($attachment as $file) {
                    is_file($file) && $mail->AddAttachment($file);
                }
     }
     $msg = null;
        //发送邮件......
        $ret = $mail->Send() ? true : $mail->ErrorInfo; //发送邮件出错是不显示具体信息
        if ($ret == 1) {
            //$msg = '恭喜您，注册成功！<br/>请登录到您的邮箱及时激活您的帐号！';
                $msg = '邮件发送成功！';
        } else {
            $msg = '邮件发送失败！';
        }
     return $msg;
 }

 /**
  * 获取中文格式时间
  * @return string  2017年1月19日
  */
 function getCnTime($time)
 {
     $time = explode('-', $time);
     if (empty($time[2])) {
         if (empty($time[1])) {
             $time = $time[0].'年';
         }
         $time = $time[0].'年'.ltrim($time[1], '0').'月';
     } else {
         $time = $time[0].'年'.ltrim($time[1], '0').'月'.ltrim($time[2], '0').'日';
     }
     return $time;
 }

 /**
  * 传入时间戳,计算距离现在的时间
  * @param  number $time 时间戳
  * @return string       返回多少以前
  */
 function word_time($time)
 {
     $time = (int) substr($time, 0, 10);
     $int = time() - $time;
     $str = '';
     if ($int <= 2) {
         $str = sprintf('刚刚', $int);
     } elseif ($int < 60) {
         $str = sprintf('%d秒前', $int);
     } elseif ($int < 3600) {
         $str = sprintf('%d分钟前', floor($int / 60));
     } elseif ($int < 86400) {
         $str = sprintf('%d小时前', floor($int / 3600));
     } else {
         $str = date('Y-m-d H:i:s', $time);
     }
     return $str;
 }

 /**
  * 是否为闰年
  * @static
  * @access public
  * @return string
  */
function isLeapYear($year='')
{
    if (empty($year)) {
        $year = $this->year;
    }
    return ((($year % 4) == 0) && (($year % 100) != 0) || (($year % 400) == 0));
}

 /**
  * 日期分析
  * 返回时间戳
  * @static
  * @access public
  * @param mixed $date 日期
  * @return string
  */
 function parse($date)
 {
     if (is_string($date)) {
         if (($date == "") || strtotime($date) == -1) {
             //为空默认取得当前时间戳
             $tmpdate = time();
         } else {
             //把字符串转换成UNIX时间戳
             $tmpdate = strtotime($date);
         }
     } elseif (is_null($date)) {
         //为空默认取得当前时间戳
         $tmpdate = time();
     } elseif (is_numeric($date)) {
         //数字格式直接转换为时间戳
         $tmpdate = $date;
     } else {
         if (get_class($date) == "Date") {
             //如果是Date对象
             $tmpdate = $date->date;
         } else {
             //默认取当前时间戳
             $tmpdate = time();
         }
     }
     return $tmpdate;
 }

 /**
  * 计算日期差
  *
  *  w - weeks
  *  d - days
  *  h - hours
  *  m - minutes
  *  s - seconds
  * @static
  * @access public
  * @param mixed $date 要比较的日期
  * @param string $elaps  比较跨度
  * @return integer
  */
 function dateDiff($date1, $date2, $elaps = "d")
 {
     $__DAYS_PER_WEEK__       = (7);
     $__DAYS_PER_MONTH__       = (30);
     $__DAYS_PER_YEAR__       = (365);
     $__HOURS_IN_A_DAY__      = (24);
     $__MINUTES_IN_A_DAY__    = (1440);
     $__SECONDS_IN_A_DAY__    = (86400);
     //计算天数差
     $__DAYSELAPS = (parse($date1) - parse($date2)) / $__SECONDS_IN_A_DAY__ ;
     switch ($elaps) {
         case "y"://转换成年
             $__DAYSELAPS =  $__DAYSELAPS / $__DAYS_PER_YEAR__;
             break;
         case "M"://转换成月
             $__DAYSELAPS =  $__DAYSELAPS / $__DAYS_PER_MONTH__;
             break;
         case "w"://转换成星期
             $__DAYSELAPS =  $__DAYSELAPS / $__DAYS_PER_WEEK__;
             break;
         case "h"://转换成小时
             $__DAYSELAPS =  $__DAYSELAPS * $__HOURS_IN_A_DAY__;
             break;
         case "m"://转换成分钟
             $__DAYSELAPS =  $__DAYSELAPS * $__MINUTES_IN_A_DAY__;
             break;
         case "s"://转换成秒
             $__DAYSELAPS =  $__DAYSELAPS * $__SECONDS_IN_A_DAY__;
             break;
     }
     return $__DAYSELAPS;
 }

 /**
  * 求两个日期之间相差的天数
  * (针对1970年1月1日之后，求之前可以采用泰勒公式)
  * @param string $day1
  * @param string $day2
  * @return number
  */
 function diffBetweenTwoDays($day1, $day2)
 {
     $second1 = strtotime($day1);
     $second2 = strtotime($day2);
     return round(abs($second1 - $second2) / 86400);
 }

/*
 +----------------------------------------------------------
 * 把换行转换为<br />标签
 +----------------------------------------------------------
 * @access public
 +----------------------------------------------------------
 * @param string $string 要处理的字符串
 +----------------------------------------------------------
 * @return string
 +----------------------------------------------------------
 */
// function nl2Br($string) {
//     return preg_replace("/(\015\012)|(\015)|(\012)/", "<br />", $string);
// }

/*
 +----------------------------------------------------------
 * 用于在textbox表单中显示html代码
 +----------------------------------------------------------
 * @access public
 +----------------------------------------------------------
 * @param string $string 要处理的字符串
 +----------------------------------------------------------
 * @return string
 +----------------------------------------------------------
 */
function hsc($string)
{
    return preg_replace(array("/&amp;/i", "/&nbsp;/i"), array('&', '&amp;nbsp;'), htmlspecialchars($string, ENT_QUOTES));
}

/*
 +----------------------------------------------------------
 * 输出安全的html，用于过滤危险代码
 +----------------------------------------------------------
 * @access public
 +----------------------------------------------------------
 * @param string $text 要处理的字符串
 * @param mixed $allowTags 允许的标签列表，如 table|td|th|td
 +----------------------------------------------------------
 * @return string
 +----------------------------------------------------------
 */
// function safeHtml($text, $allowTags = null) {
//     $text =  trim($text);
//     //完全过滤注释
//     $text = preg_replace('/<!--?.*-->/','',$text);
//     //完全过滤动态代码
//     $text =  preg_replace('/<\?|\?'.'>/','',$text);
//     //完全过滤js
//     $text = preg_replace('/<script?.*\/script>/','',$text);
//
//     $text =  str_replace('[','&#091;',$text);
//     $text = str_replace(']','&#093;',$text);
//     $text =  str_replace('|','&#124;',$text);
//     //过滤换行符
//     $text = preg_replace('/\r?\n/','',$text);
//     //br
//     $text =  preg_replace('/<br(\s\/)?'.'>/i','[br]',$text);
//     $text = preg_replace('/(\[br\]\s*){10,}/i','[br]',$text);
//     //过滤危险的属性，如：过滤on事件lang js
//     while(preg_match('/(<[^><]+)(lang|on|action|background|codebase|dynsrc|lowsrc)[^><]+/i',$text,$mat)){
//         $text=str_replace($mat[0],$mat[1],$text);
//     }
//     while(preg_match('/(<[^><]+)(window\.|javascript:|js:|about:|file:|document\.|vbs:|cookie)([^><]*)/i',$text,$mat)){
//         $text=str_replace($mat[0],$mat[1].$mat[3],$text);
//     }
//     if( empty($allowTags) ) { $allowTags = self::$htmlTags['allow']; }
//     //允许的HTML标签
//     $text =  preg_replace('/<('.$allowTags.')( [^><\[\]]*)>/i','[\1\2]',$text);
//     //过滤多余html
//     if ( empty($banTag) ) { $banTag = self::$htmlTags['ban']; }
//     $text =  preg_replace('/<\/?('.$banTag.')[^><]*>/i','',$text);
//     //过滤合法的html标签
//     while(preg_match('/<([a-z]+)[^><\[\]]*>[^><]*<\/\1>/i',$text,$mat)){
//         $text=str_replace($mat[0],str_replace('>',']',str_replace('<','[',$mat[0])),$text);
//     }
//     //转换引号
//     while(preg_match('/(\[[^\[\]]*=\s*)(\"|\')([^\2=\[\]]+)\2([^\[\]]*\])/i',$text,$mat)){
//         $text=str_replace($mat[0],$mat[1].'|'.$mat[3].'|'.$mat[4],$text);
//     }
//     //空属性转换
//     $text =  str_replace('\'\'','||',$text);
//     $text = str_replace('""','||',$text);
//     //过滤错误的单个引号
//     while(preg_match('/\[[^\[\]]*(\"|\')[^\[\]]*\]/i',$text,$mat)){
//         $text=str_replace($mat[0],str_replace($mat[1],'',$mat[0]),$text);
//     }
//     //转换其它所有不合法的 < >
//     $text =  str_replace('<','&lt;',$text);
//     $text = str_replace('>','&gt;',$text);
//     $text = str_replace('"','&quot;',$text);
//     //反转换
//     $text =  str_replace('[','<',$text);
//     $text =  str_replace(']','>',$text);
//     $text =  str_replace('|','"',$text);
//     //过滤多余空格
//     $text =  str_replace('  ',' ',$text);
//     return $text;
// }

/*
 +----------------------------------------------------------
 * 删除html标签，得到纯文本。可以处理嵌套的标签
 +----------------------------------------------------------
 * @access public
 +----------------------------------------------------------
 * @param string $string 要处理的html
 +----------------------------------------------------------
 * @return string
 +----------------------------------------------------------
 */
function deleteHtmlTags($string)
{
    while (strstr($string, '>')) {
        $currentBeg = strpos($string, '<');
        $currentEnd = strpos($string, '>');
        $tmpStringBeg = @substr($string, 0, $currentBeg);
        $tmpStringEnd = @substr($string, $currentEnd + 1, strlen($string));
        $string = $tmpStringBeg.$tmpStringEnd;
    }
    return $string;
}

/*
 +----------------------------------------------------------
 * 处理字符串，以便可以正常进行搜索
 +----------------------------------------------------------
 * @access public
 +----------------------------------------------------------
 * @param string $string 要处理的字符串
 +----------------------------------------------------------
 * @return string
 +----------------------------------------------------------
 */
function forSearch($string)
{
    return str_replace(array('%','_'), array('\%','\_'), $string);
}

/**
 * 日期数字转中文
 * 用于日和月、周
 * @static
 * @access public
 * @param integer $number 日期数字
 * @return string
 */
function numberToCh($number)
{
    $number = intval($number);
    $array  = array('一','二','三','四','五','六','七','八','九','十');
    $str = '';
    if ($number  ==0) {
        $str .= "十" ;
    }
    if ($number  <  10) {
        $str .= $array[$number-1] ;
    } elseif ($number  <  20) {
        $str .= "十".$array[$number-11];
    } elseif ($number  <  30) {
        $str .= "二十".$array[$number-21];
    } else {
        $str .= "三十".$array[$number-31];
    }
    return $str;
}

/**
 * 年份数字转中文
 * @static
 * @access public
 * @param integer $yearStr 年份数字
 * @param boolean $flag 是否显示公元
 * @return string
 */
function yearToCh($yearStr, $flag=false)
{
    $array = array('零','一','二','三','四','五','六','七','八','九');
    $str = $flag? '公元' : '';
    for ($i=0;$i<4;$i++) {
        $str .= $array[substr($yearStr, $i, 1)];
    }
    return $str;
}

/**
 *  判断日期 所属 干支 生肖 星座
 *  type 参数：XZ 星座 GZ 干支 SX 生肖
 *
 * @static
 * @access public
 * @param string $type  获取信息类型
 * @return string
 */
function magicInfo($type)
{
    $result = '';
    $m      =   $this->month;
    $y      =   $this->year;
    $d      =   $this->day;

    switch ($type) {
    case 'XZ'://星座
        $XZDict = array('摩羯','宝瓶','双鱼','白羊','金牛','双子','巨蟹','狮子','处女','天秤','天蝎','射手');
        $Zone   = array(1222,122,222,321,421,522,622,722,822,922,1022,1122,1222);
        if ((100*$m+$d)>=$Zone[0]||(100*$m+$d)<$Zone[1]) {
            $i=0;
        } else {
            for ($i=1;$i<12;$i++) {
                if ((100*$m+$d)>=$Zone[$i]&&(100*$m+$d)<$Zone[$i+1]) {
                    break;
                }
            }
        }
        $result = $XZDict[$i].'座';
        break;

    case 'GZ'://干支
        $GZDict = array(
                    array('甲','乙','丙','丁','戊','己','庚','辛','壬','癸'),
                    array('子','丑','寅','卯','辰','巳','午','未','申','酉','戌','亥')
                    );
        $i= $y -1900+36 ;
        $result = $GZDict[0][$i%10].$GZDict[1][$i%12];
        break;

    case 'SX'://生肖
        $SXDict = array('鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡','狗','猪');
        $result = $SXDict[($y-4)%12];
        break;

    }
    return $result;
}

/**
 * 产生随机字串，可用来自动生成密码
 * 默认长度6位 字母和数字混合 支持中文
 * @param string $len 长度
 * @param string $type 字串类型
 * 0 字母 1 数字 其它 混合
 * @param string $addChars 额外字符
 * @return string
 */
// function randString($len=6, $type='', $addChars='')
// {
//     $str ='';
//     switch ($type) {
//         case 0:
//             $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.$addChars;
//             break;
//         case 1:
//             $chars= str_repeat('0123456789', 3);
//             break;
//         case 2:
//             $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ'.$addChars;
//             break;
//         case 3:
//             $chars='abcdefghijklmnopqrstuvwxyz'.$addChars;
//             break;
//         case 4:
//             $chars = "们以我到他会作时要动国产的一是工就年阶义发成部民可出能方进在了不和有大这主中人上为来分生对于学下级地个用同行面说种过命度革而多子后自社加小机也经力线本电高量长党得实家定深法表着水理化争现所二起政三好十战无农使性前等反体合斗路图把结第里正新开论之物从当两些还天资事队批点育重其思与间内去因件日利相由压员气业代全组数果期导平各基或月毛然如应形想制心样干都向变关问比展那它最及外没看治提五解系林者米群头意只明四道马认次文通但条较克又公孔领军流入接席位情运器并飞原油放立题质指建区验活众很教决特此常石强极土少已根共直团统式转别造切九你取西持总料连任志观调七么山程百报更见必真保热委手改管处己将修支识病象几先老光专什六型具示复安带每东增则完风回南广劳轮科北打积车计给节做务被整联步类集号列温装即毫知轴研单色坚据速防史拉世设达尔场织历花受求传口断况采精金界品判参层止边清至万确究书术状厂须离再目海交权且儿青才证低越际八试规斯近注办布门铁需走议县兵固除般引齿千胜细影济白格效置推空配刀叶率述今选养德话查差半敌始片施响收华觉备名红续均药标记难存测士身紧液派准斤角降维板许破述技消底床田势端感往神便贺村构照容非搞亚磨族火段算适讲按值美态黄易彪服早班麦削信排台声该击素张密害侯草何树肥继右属市严径螺检左页抗苏显苦英快称坏移约巴材省黑武培著河帝仅针怎植京助升王眼她抓含苗副杂普谈围食射源例致酸旧却充足短划剂宣环落首尺波承粉践府鱼随考刻靠够满夫失包住促枝局菌杆周护岩师举曲春元超负砂封换太模贫减阳扬江析亩木言球朝医校古呢稻宋听唯输滑站另卫字鼓刚写刘微略范供阿块某功套友限项余倒卷创律雨让骨远帮初皮播优占死毒圈伟季训控激找叫云互跟裂粮粒母练塞钢顶策双留误础吸阻故寸盾晚丝女散焊功株亲院冷彻弹错散商视艺灭版烈零室轻血倍缺厘泵察绝富城冲喷壤简否柱李望盘磁雄似困巩益洲脱投送奴侧润盖挥距触星松送获兴独官混纪依未突架宽冬章湿偏纹吃执阀矿寨责熟稳夺硬价努翻奇甲预职评读背协损棉侵灰虽矛厚罗泥辟告卵箱掌氧恩爱停曾溶营终纲孟钱待尽俄缩沙退陈讨奋械载胞幼哪剥迫旋征槽倒握担仍呀鲜吧卡粗介钻逐弱脚怕盐末阴丰雾冠丙街莱贝辐肠付吉渗瑞惊顿挤秒悬姆烂森糖圣凹陶词迟蚕亿矩康遵牧遭幅园腔订香肉弟屋敏恢忘编印蜂急拿扩伤飞露核缘游振操央伍域甚迅辉异序免纸夜乡久隶缸夹念兰映沟乙吗儒杀汽磷艰晶插埃燃欢铁补咱芽永瓦倾阵碳演威附牙芽永瓦斜灌欧献顺猪洋腐请透司危括脉宜笑若尾束壮暴企菜穗楚汉愈绿拖牛份染既秋遍锻玉夏疗尖殖井费州访吹荣铜沿替滚客召旱悟刺脑措贯藏敢令隙炉壳硫煤迎铸粘探临薄旬善福纵择礼愿伏残雷延烟句纯渐耕跑泽慢栽鲁赤繁境潮横掉锥希池败船假亮谓托伙哲怀割摆贡呈劲财仪沉炼麻罪祖息车穿货销齐鼠抽画饲龙库守筑房歌寒喜哥洗蚀废纳腹乎录镜妇恶脂庄擦险赞钟摇典柄辩竹谷卖乱虚桥奥伯赶垂途额壁网截野遗静谋弄挂课镇妄盛耐援扎虑键归符庆聚绕摩忙舞遇索顾胶羊湖钉仁音迹碎伸灯避泛亡答勇频皇柳哈揭甘诺概宪浓岛袭谁洪谢炮浇斑讯懂灵蛋闭孩释乳巨徒私银伊景坦累匀霉杜乐勒隔弯绩招绍胡呼痛峰零柴簧午跳居尚丁秦稍追梁折耗碱殊岗挖氏刃剧堆赫荷胸衡勤膜篇登驻案刊秧缓凸役剪川雪链渔啦脸户洛孢勃盟买杨宗焦赛旗滤硅炭股坐蒸凝竟陷枪黎救冒暗洞犯筒您宋弧爆谬涂味津臂障褐陆啊健尊豆拔莫抵桑坡缝警挑污冰柬嘴啥饭塑寄赵喊垫丹渡耳刨虎笔稀昆浪萨茶滴浅拥穴覆伦娘吨浸袖珠雌妈紫戏塔锤震岁貌洁剖牢锋疑霸闪埔猛诉刷狠忽灾闹乔唐漏闻沈熔氯荒茎男凡抢像浆旁玻亦忠唱蒙予纷捕锁尤乘乌智淡允叛畜俘摸锈扫毕璃宝芯爷鉴秘净蒋钙肩腾枯抛轨堂拌爸循诱祝励肯酒绳穷塘燥泡袋朗喂铝软渠颗惯贸粪综墙趋彼届墨碍启逆卸航衣孙龄岭骗休借".$addChars;
//             break;
//         default:
//             // 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数
//             $chars='ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789'.$addChars;
//             break;
//     }
//     if ($len>10) {//位数过长重复字符串一定次数
//         $chars= $type==1? str_repeat($chars, $len) : str_repeat($chars, 5);
//     }
//     if ($type!=4) {
//         $chars   =   str_shuffle($chars);
//         $str     =   substr($chars, 0, $len);
//     } else {
//         // 中文随机字
//         for ($i=0;$i<$len;$i++) {
//             $str.= self::msubstr($chars, floor(mt_rand(0, mb_strlen($chars, 'utf-8')-1)), 1, 'utf-8', false);
//         }
//     }
//     return $str;
// }

/**
 * 生成一定数量的随机数，并且不重复
 * @param integer $number 数量
 * @param string $len 长度
 * @param string $type 字串类型
 * 0 字母 1 数字 其它 混合
 * @return string
 */
// function buildCountRand($number, $length=4, $mode=1)
// {
//     if ($mode==1 && $length<strlen($number)) {
//         //不足以生成一定数量的不重复数字
//             return false;
//     }
//     $rand   =  array();
//     for ($i=0; $i<$number; $i++) {
//         $rand[] =   self::randString($length, $mode);
//     }
//     $unqiue = array_unique($rand);
//     if (count($unqiue)==count($rand)) {
//         return $rand;
//     }
//     $count   = count($rand)-count($unqiue);
//     for ($i=0; $i<$count*3; $i++) {
//         $rand[] =   self::randString($length, $mode);
//     }
//     $rand = array_slice(array_unique($rand), 0, $number);
//     return $rand;
// }

/**
 *  带格式生成随机字符 支持批量生成
 *  但可能存在重复
 * @param string $format 字符格式
 *     # 表示数字 * 表示字母和数字 $ 表示字母
 * @param integer $number 生成数量
 * @return string | array
 */
function buildFormatRand($format, $number=1)
{
    $str  =  array();
    $length =  strlen($format);
    for ($j=0; $j<$number; $j++) {
        $strtemp   = '';
        for ($i=0; $i<$length; $i++) {
            $char = substr($format, $i, 1);
            switch ($char) {
                case "*"://字母和数字混合
                    $strtemp   .= String::randString(1);
                    break;
                case "#"://数字
                    $strtemp  .= String::randString(1, 1);
                    break;
                case "$"://大写字母
                    $strtemp .=  String::randString(1, 2);
                    break;
                default://其他格式均不转换
                    $strtemp .=   $char;
                    break;
           }
        }
        $str[] = $strtemp;
    }
    return $number==1? $strtemp : $str ;
}

/**
 * 获取一定范围内的随机数字 位数不足补零
 * @param integer $min 最小值
 * @param integer $max 最大值
 * @return string
 */
function randNumber($min, $max)
{
    return sprintf("%0".strlen($max)."d", mt_rand($min, $max));
}

/**
 * 生成pdf
 * @param  string $html      需要生成的内容
 * @param  string $filename  文件名
 * @param  string $type      执行pdf方式 默认是I：在浏览器中打开，D：下载，F：在服务器生成pdf ，S：只返回pdf的字符串
 */
function pdf($html, $filename, $type='')
{
    vendor('Tcpdf.tcpdf');
    $pdf = new \Tcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // 设置打印模式
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle($filename);
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
    // 是否显示页眉
    $pdf->setPrintHeader(false);
    // 设置页眉显示的内容
    $pdf->SetHeaderData('logo.png', 60, 'greatkeeper.com', '创赢房管家', array(0,64,255), array(0,64,128));
    // 设置页眉字体
    $pdf->setHeaderFont(array('dejavusans', '', '12'));
    // 页眉距离顶部的距离
    $pdf->SetHeaderMargin('5');
    // 是否显示页脚
    $pdf->setPrintFooter(true);
    // 设置页脚显示的内容
    $pdf->setFooterData('Smartwin Portfolio PHX Co.,Ltd – B 股股份认购', array(0,64,0), array(0,64,128));
    // 设置页脚的字体
    $pdf->setFooterFont(array('dejavusans', '', '10'));
    // 设置页脚距离底部的距离
    $pdf->SetFooterMargin('10');
    // 设置默认等宽字体
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    // 设置行高
    $pdf->setCellHeightRatio(1);
    // 设置左、上、右的间距
    $pdf->SetMargins('10', '10', '10');
    // 设置是否自动分页  距离底部多少距离时分页
    $pdf->SetAutoPageBreak(true, '10');
    // 设置图像比例因子
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    $pdf->setFontSubsetting(true);
    $pdf->AddPage();
    // 设置字体
    // $pdf->SetFont('stsongstdlight', '', 8);
    // $pdf->SetFont('simli', '', 9);
    // $pdf->SetFont('simyou', '', 9);
    $pdf->SetFont('simhei', '', 9);
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
    $filename = date('Y-m-d', time())."_".$filename;
    if (empty($type)) {
        $type = "I";
    }
    $pdf->Output($filename, $type);
}

/**
 * 生成word --- header直接浏览器下载
 * @param  String $filename 文件名
 * @param  String $data    数据集合
 * @param  Html $html     如果有HTML
 * @return Word         WORD文档
 */
function word($data, $filename = '', $html = '')
{
    vendor('PHPWord.PHPWord');
  // New Word Document
  $PHPWord = new PHPWord();
  // New portrait section
  $section = $PHPWord->createSection();
  //$data = iconv('utf-8', 'gbk', $data);
  // Add text elements
  $section->addText($data);
    $section->addTextBreak(2);

    $section->addText('I am inline styled.', array('name'=>'Verdana', 'color'=>'006699'));
    $section->addTextBreak(2);

    $PHPWord->addFontStyle('rStyle', array('bold'=>true, 'italic'=>true, 'size'=>16));
    $PHPWord->addParagraphStyle('pStyle', array('align'=>'center', 'spaceAfter'=>100));
    $section->addText('I am styled by two style definitions.', 'rStyle', 'pStyle');
    $section->addText('I have only a paragraph style definition.', null, 'pStyle');
  //设置在浏览器下载
  header('Pragma: public');
    header('Expires: 0');
    header('Cache-Control:must-revalidate， post-check=0， pre-check=0');
    header('Content-Type:application/force-download');
    header('Content-Type:application/vnd.ms-word');
    header('Content-Type:application/octet-stream');
    header('Content-Type:application/download');
    header('Content-Disposition:attachment;filename='.$filename.'.docx');
    header('Content-Transfer-Encoding:binary');
  // Save File
  $objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
    $objWriter->save('php://output');
}

/**
 * 生成word --- 路径保存
 * @param  String $filename 文件名
 * @param  String $data    数据集合
 * @param  Html $html     如果有HTML
 * @return Word         WORD文档
 */
function word2($data, $filename = '', $html = '')
{
    vendor('PHPWord.PHPWord');
    $phpword = new \PHPWord();

  //设置默认样式
  $phpword->setDefaultFontName('仿宋');//字体
  $phpword->setDefaultFontSize(16);//字号

  //添加页面
  $section = $phpword->createSection();

  //添加目录
  $styleTOC  = ['tabLeader' => \PHPWord_Style_TOC::TABLEADER_DOT];
    $styleFont = ['spaceAfter' => 60, 'name' => 'Tahoma', 'size' => 12];
    $section->addTOC($styleFont, $styleTOC);

  //默认样式
  $section->addText('aaaa第一行文字第一行文字第一行文字第一行文字aaaa');
    $section->addTextBreak();//换行符

  //指定的样式
  $section->addText(
      'Hello world! 第二行文字第二行文字第二行文字.',
      [
          'name' => '宋体',
          'size' => 16,
          'bold' => true,
      ]
  );
    $section->addTextBreak(5);//多个换行符

  //自定义样式
  $myStyle = 'myStyle';
    $phpword->addFontStyle(
      $myStyle,
      [
          'name' => 'Verdana',
          'size' => 12,
          'color' => '1BFF32',
          'bold' => true,
          'spaceAfter' => 500,
      ]
  );
    $section->addText('第三行文字第三行文字', $myStyle);
    $section->addText('第四行文字', $myStyle);
    $section->addPageBreak();//分页符

  //添加文本资源
  $textrun = $section->createTextRun();
    $textrun->addText('I am bold', ['bold' => true]);
    $textrun->addText('I am italic', ['italic' => true]);
    $textrun->addText('I am colored', ['color' => 'AACC00']);

  //列表
  $listStyle = ['listType' => \PHPWord_Style_ListItem::TYPE_NUMBER];
    $section->addListItem('河北省', 0, null, $listStyle);
    $section->addListItem('石家庄', 1, null, $listStyle);
    $section->addListItem('邯郸', 1, null, $listStyle);
    $section->addListItem('魏县', 2, null, $listStyle);
    $section->addListItem('河南省', 0, null, $listStyle);
    $section->addListItem('郑州', 1, null, $listStyle);
    $section->addListItem('信阳', 1, null, $listStyle);

  //超级链接
  $linkStyle = ['color' => '0000FF', 'underline' => \PHPWord_Style_Font::UNDERLINE_SINGLE];
    $phpword->addLinkStyle('mylinkStyle', $linkStyle);
    $section->addLink('http://www.baidu.com', '百度', 'mylinkStyle');
    $section->addLink('http://www.lanrenkaifa.com', null, 'mylinkStyle');

  //添加图片
  $imageStyle = ['width' => 350, 'height' => 350, 'align' => 'center'];
    $section->addImage('__PUBLIC__/Admin/Images/Spiritedaway.jpg', $imageStyle);
    $section->addImage('__PUBLIC__/Admin/Images/top1.jpg');
  //$section->addMemoryImage('http://localhost/image.php');//添加GD生成图片

  //添加对象，支持后缀：'xls', 'doc', 'ppt'
  //$section->addObject(public_path().'/demo.xls',['align' => 'center']);

  //添加标题,支持1-9标题
  $phpword->addTitleStyle(1, ['bold' => true, 'color' => '1BFF32', 'size' => 38, 'name' => 'Verdana']);
    $section->addTitle('我是标题', 1);
    $section->addTitle('我是标题2', 1);
    $section->addTitle('我是标题3', 1);

  //添加表格
  $styleTable = [
      'borderColor' => '006699',
      'borderSize' => 6,
      'cellMargin' => 50,
  ];
    $styleFirstRow = ['bgColor' => '66BBFF'];//第一行样式
  $phpword->addTableStyle('myTable', $styleTable, $styleFirstRow);

    $table = $section->addTable('myTable');
    $table->addRow(400);//行高400
  $table->addCell(2000)->addText('名称');
    $table->addCell(2000)->addText('价格');
    $table->addCell(2000)->addText('数量');
    $table->addRow(400);//行高400
  $table->addCell(2000)->addText('小米手机');
    $table->addCell(2000)->addText('3999元');
    $table->addCell(2000)->addText('50');
    $table->addRow(400);//行高400
  $table->addCell(2000)->addText('苹果手机');
    $table->addCell(2000)->addText('5999元');
    $table->addCell(2000)->addText('10');

  //页眉与页脚
  $header = $section->createHeader();
    $footer = $section->createFooter();
    $header->addPreserveText('LanRenKaiFa.com');
    $footer->addPreserveText('学会偷懒，并懒出效率。 - LanRenKaiFa.com Page {PAGE} of {NUMPAGES}.');

  //设置文件夹
  $dir  = "./docfile/".date("Ymd")."/";
    if (!file_exists($dir)) {
        mkdir($dir, 777, true);
    }
    $filename = iconv('utf-8', 'gbk', $filename);
    if (empty($filename)) {
        $filename = $dir.date('His').'.doc';
    } else {
        $filename = $dir.$filename.'.doc';
    }
  //生成的文档为Word2007
  $writer = \PHPWord_IOFactory::createWriter($phpword, 'Word2007');
    $writer->save($filename);
}

/**
 * 生成word 修改header方法
 * @param string $data 需要生成的内容
 * @param string $filename 文件名
 * @version 开启php_com_dotnet模块
 *
 */
function cword($data, $fileName='')
{
    if (empty($data)) {
        return '';
    }
    $data = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns="http://www.w3.org/TR/REC-html40">'.$data.'</html>';
    $dir  = "./docfile/".date("Ymd")."/";
    if (!file_exists($dir)) {
        mkdir($dir, 777, true);
    }
    if (empty($fileName)) {
        $fileName=$dir.date('His').'.doc';
    } else {
        $fileName =$dir.$fileName.'.doc';
    }
    $writefile = fopen($fileName, 'wb') or die("创建文件失败"); //wb以二进制写入
    fwrite($writefile, $data);
    fclose($writefile);
    return $fileName;
}

/**
 * 遍历整个文件夹
 * @param String $path 文件夹路径
 * @param Zip $zip
 * 循环的读取文件夹下的所有文件和文件夹
 * 其中$filename = readdir($handler)是每次循环的时候将读取的文件名赋值给$filename，
 * 为了不陷于死循环，所以还要让$filename !== false。
 * 一定要用!==，因为如果某个文件名如果叫'0'，或者某些被系统认为是代表false，用!=就会停止循环
 */
function addFileToZip($path, $zip)
{
    $handler = opendir($path);                           //打开当前文件夹由$path指定。
    while (($filename = readdir($handler)) !== false) {
        if ($filename != "." && $filename != "..") {       //文件夹文件名字为'.'和‘..’，不要对他们进行操作
        if (is_dir($path . "/" . $filename)) {           //如果读取的某个对象是文件夹，则递归
           addFileToZip($path . "/" . $filename, $zip);
        } else { //将文件加入zip对象
           $zip->addFile($path . "/" . $filename);
        }
        }
    }
    @closedir($path);
}

/**
 * 执行下载
 * @return Zip 压缩文件
 */
function dozip()
{
    $zip = new ZipArchive();
    if ($zip->open('images.zip', ZipArchive::OVERWRITE) === true) {
        addFileToZip('images/', $zip); //调用方法，对要打包的根目录进行操作，并将ZipArchive的对象传递给方法
    $zip->close(); //关闭处理的zip文件
    }
}

/**
 * 打包下载zip -- 多文件打包一起压缩下载
 * @param $filelist
 * @return Zip 压缩文件
 */
function downzip($datalist)
{
    $filename = "./test/test.zip"; //最终生成的文件名（含路径）
  if (!file_exists($filename)) {
      //重新生成文件
      $zip = new ZipArchive();//使用本类，linux需开启zlib，windows需取消php_zip.dll前的注释
      if ($zip->open($filename, ZIPARCHIVE::CREATE)!==true) {
          exit('无法打开文件，或者文件创建失败');
      }
      foreach ($datalist as $val) {
          if (file_exists($val)) {
              $zip->addFile($val, basename($val));
          }
      }
      $zip->close();//关闭
  }
    if (!file_exists($filename)) {
        exit("无法找到文件"); //即使创建，仍有可能失败。。。。
    }
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header('Content-disposition: attachment; filename='.basename($filename)); //文件名
  header("Content-Type: application/zip"); //zip格式的
  header("Content-Transfer-Encoding: binary"); //告诉浏览器，这是二进制文件
  header('Content-Length: '. filesize($filename)); //告诉浏览器，文件大小
  @readfile($filename);
}

/**
 * 使用curl获取远程数据
 * @param  string $url url连接
 * @return string      获取到的数据
 */
function curl_get_contents($url)
{
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);                //设置访问的url地址
    // curl_setopt($ch,CURLOPT_HEADER,1);               //是否显示头部信息
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);               //设置超时
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);   //用户访问代理 User-Agent
    curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_HOST']);        //设置 referer
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);          //跟踪301
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        //返回结果
    $r=curl_exec($ch);
    curl_close($ch);
    return $r;
}

/**
 * CURL登陆获取cookie，用来模拟登陆获取登录后的远程页面
 * @param   $username 用户名
 * @param   $password 密码
 * @param   $url 请求页面地址
 * @param   $cookie 远程页面cookie值
 * @return  $output 获取cookie信息（带sessionID）
 */
function curlLogin($username, $password, $url)
{
    $url = 'http://cloud.rongli.com/?c=login&a=curllogin';
    $cookie = dirname(__FILE__).'/cookie.txt';
    $post_data = 'username='.$username.'&password='.$password.'&org_account_id=539';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);//是否显示头信息
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie); //设置Cookie信息保存在指定的文件中
    curl_setopt($curl, CURLOPT_POST, 1);//post方式提交
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data); //要提交的信息
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}
/**
 * CURL执行登陆跳转
 * @param   $url 请求页面地址
 * @param   $cookie 远程页面cookie值
 * @return  $rs 有登录信息的远程页面
 */
function get_content($url)
{
    $url = 'http://cloud.rongli.com/?c=management&a=index';
    $cookie = dirname(__FILE__).'/cookie.txt';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie); //读取cookie
    curl_exec($ch);
    $rs = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    curl_close($ch);
    return $rs;
}

/**
 * 生成不重复的随机数
 * @param  int $start  需要生成的数字开始范围
 * @param  int $end 结束范围
 * @param  int $length 需要生成的随机数个数
 * @return array       生成的随机数
 */
function get_rand_number($start=1, $end=10, $length=4)
{
    $connt=0;
    $temp=array();
    while ($connt<$length) {
        $temp[]=rand($start, $end);
        $data=array_unique($temp);
        $connt=count($data);
    }
    sort($data);
    return $data;
}

/**
 * 生成一定数量的随机数，并且不重复
 * @param integer $number 数量
 * @param string $len 长度
 * @param string $type 字串类型
 * 0 字母 1 数字 其它 混合
 * @return string
 */
function build_count_rand($number, $length=13, $mode=1)
{
    if ($mode==1 && $length<strlen($number)) {
        //不足以生成一定数量的不重复数字
        return false;
    }
    $rand   =  array();
    for ($i=0; $i<$number; $i++) {
        $rand[] = rand_string($length, $mode);
    }
    $unqiue = array_unique($rand);
    if (count($unqiue)==count($rand)) {
        return $rand;
    }
    $count   = count($rand)-count($unqiue);
    for ($i=0; $i<$count*3; $i++) {
        $rand[] = rand_string($length, $mode);
    }
    $rand = array_slice(array_unique($rand), 0, $number);
    return $rand;
}

/**
 * 数组转xls格式的excel文件
 * @param  array  $data      需要生成excel文件的数组
 * @param  string $filename  生成的excel文件名
 *
 */
function create_xls($data, $filename='Raiseaccount.xls')
{
    ini_set('max_execution_time', '0');
    Vendor('PHPExcel.PHPExcel');
    $filename=str_replace('.xls', '', $filename).'.xls';
    $phpexcel = new PHPExcel();
    $phpexcel->getProperties()
        ->setCreator("Maarten Balliauw")
        ->setLastModifiedBy("Maarten Balliauw")
        ->setTitle("Office 2007 XLSX Test Document")
        ->setSubject("Office 2007 XLSX Test Document")
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Test result file");
    $phpexcel->getActiveSheet()->fromArray($data);
    $phpexcel->getActiveSheet()->setTitle('Sheet1');
    $phpexcel->setActiveSheetIndex(0);
    //设置列宽
    $phpexcel->getActiveSheet()->getColumnDimension('C')->setWidth('30');
    // 设置行高
    $phpexcel->getActiveSheet()->getRowDimension('9')->setRowHeight(20);
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$filename");
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0
    $objwriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
    $objwriter->save('php://output');
    exit;
}

/**
   * 目录遍历函数
   * @access public
   * @param string $path		要遍历的目录名
   * @param string $mode		遍历模式,一般取FILES,这样只返回带路径的文件名
   * @param array $file_types		文件后缀过滤数组
   * @param int $maxdepth		遍历深度,-1表示遍历到最底层
   * @return void
   */
function searchdir($path, $mode = "FULL", $file_types = array(".html",".php"), $maxdepth = -1, $d = 0)
{
    if (substr($path, strlen($path)-1) != '/') {
        $path .= '/';
    }
    $dirlist = array();
    if ($mode != "FILES") {
        $dirlist[] = $path;
    }
    if ($handle = @opendir($path)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != '.' && $file != '..') {
                $file = $path.$file ;
                if (!is_dir($file)) {
                    if ($mode != "DIRS") {
                        $extension = "";
                        $extpos = strrpos($file, '.');
                        if ($extpos!==false) {
                            $extension = substr($file, $extpos, strlen($file)-$extpos);
                        }
                        $extension=strtolower($extension);
                        if (in_array($extension, $file_types)) {
                            $dirlist[] = $file;
                        }
                    }
                } elseif ($d >= 0 && ($d < $maxdepth || $maxdepth < 0)) {
                    $result = searchdir($file.'/', $mode, $file_types, $maxdepth, $d + 1) ;
                    $dirlist = array_merge($dirlist, $result);
                }
            }
        }
        closedir($handle) ;
    }
    if ($d == 0) {
        natcasesort($dirlist);
    }

    return($dirlist) ;
}

/**
 * 遍历文件夹
 * @param  String $dir 文件路径
 * @return [type]      [description]
 */
function list_dir($dir)
{
    $result = array();
    if (is_dir($dir)) {
        $file_dir = scandir($dir);
        foreach ($file_dir as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            } elseif (is_dir($dir.$file)) {
                $result = array_merge($result, list_dir($dir.$file.'/'));
            } else {
                array_push($result, $dir.$file);
            }
        }
    }
    return $result;
}

/**
 * 返回文件格式
 * @param  string $str 文件名
 * @return string      文件格式
 */
function file_format($str)
{
    // 取文件后缀名
    $str=strtolower(pathinfo($str, PATHINFO_EXTENSION));
    // 图片格式
    $image=array('webp','jpg','png','ico','bmp','gif','tif','pcx','tga','bmp','pxc','tiff','jpeg','exif','fpx','svg','psd','cdr','pcd','dxf','ufo','eps','ai','hdri');
    // 视频格式
    $video=array('mp4','avi','3gp','rmvb','gif','wmv','mkv','mpg','vob','mov','flv','swf','mp3','ape','wma','aac','mmf','amr','m4a','m4r','ogg','wav','wavpack');
    // 压缩格式
    $zip=array('rar','zip','tar','cab','uue','jar','iso','z','7-zip','ace','lzh','arj','gzip','bz2','tz');
    // 文档格式
    $text=array('exe','doc','ppt','xls','wps','txt','lrc','wfs','torrent','html','htm','java','js','css','less','php','pdf','pps','host','box','docx','word','perfect','dot','dsf','efe','ini','json','lnk','log','msi','ost','pcs','tmp','xlsb');
    // 匹配不同的结果
    switch ($str) {
        case in_array($str, $image):
            return 'image';
            break;
        case in_array($str, $video):
            return 'video';
            break;
        case in_array($str, $zip):
            return 'zip';
            break;
        case in_array($str, $text):
            return 'text';
            break;
        default:
            return 'image';
            break;
    }
}

/**
 * 删除指定的标签和内容
 * @param array $tags 需要删除的标签数组
 * @param string $str 数据源
 * @param string $content 是否删除标签内的内容 0保留内容 1不保留内容
 * @return string
 */
function strip_html_tags($tags, $str, $content=0)
{
    if ($content) {
        $html=array();
        foreach ($tags as $tag) {
            $html[]='/(<'.$tag.'.*?>[\s|\S]*?<\/'.$tag.'>)/';
        }
        $data=preg_replace($html, '', $str);
    } else {
        $html=array();
        foreach ($tags as $tag) {
            $html[]="/(<(?:\/".$tag."|".$tag.")[^>]*>)/i";
        }
        $data=preg_replace($html, '', $str);
    }
    return $data;
}

/**
 * 传递ueditor生成的内容获取其中图片的路径
 * @param  string $str 含有图片链接的字符串
 * @return array       匹配的图片数组
 */
function get_ueditor_image_path($str)
{
    $preg='/\/Upload\/image\/u(m)?editor\/\d*\/\d*\.[jpg|jpeg|png|bmp]*/i';
    preg_match_all($preg, $str, $data);
    return current($data);
}

/**
 * 字符串截取，支持中文和其他编码
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $suffix 截断显示字符
 * @param string $charset 编码格式
 * @return string
 */
function re_substr($str, $start=0, $length, $suffix=true, $charset="utf-8")
{
    if (function_exists("mb_substr")) {
        $slice = mb_substr($str, $start, $length, $charset);
    } elseif (function_exists('iconv_substr')) {
        $slice = iconv_substr($str, $start, $length, $charset);
    } else {
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']  = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("", array_slice($match[0], $start, $length));
    }
    $omit=mb_strlen($str) >=$length ? '...' : '';
    return $suffix ? $slice.$omit : $slice;
}

/**
 * 取得根域名
 * @param type $domain 域名
 * @return string 返回根域名
 */
function get_url_to_domain($domain)
{
    $re_domain = '';
    $domain_postfix_cn_array = array("com", "net", "org", "gov", "edu", "com.cn", "cn", "ren");
    $array_domain = explode(".", $domain);
    $array_num = count($array_domain) - 1;
    if ($array_domain[$array_num] == 'cn') {
        if (in_array($array_domain[$array_num - 1], $domain_postfix_cn_array)) {
            $re_domain = $array_domain[$array_num - 2] . "." . $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
        } else {
            $re_domain = $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
        }
    } else {
        $re_domain = $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
    }
    return $re_domain;
}

/**
 * 将路径转换加密
 * @param  string $file_path 路径
 * @return string            转换后的路径
 */
function path_encode($file_path)
{
    return rawurlencode(base64_encode($file_path));
}

/**
 * 将路径解密
 * @param  string $file_path 加密后的字符串
 * @return string            解密后的路径
 */
function path_decode($file_path)
{
    return base64_decode(rawurldecode($file_path));
}

/**
 * 把用户输入的文本转义（主要针对特殊符号和emoji表情）
 */
function emoji_encode($str)
{
    if (!is_string($str)) {
        return $str;
    }
    if (!$str || $str=='undefined') {
        return '';
    }

    $text = json_encode($str); //暴露出unicode
    $text = preg_replace_callback("/(\\\u[ed][0-9a-f]{3})/i", function ($str) {
        return addslashes($str[0]);
    }, $text); //将emoji的unicode留下，其他不动，这里的正则比原答案增加了d，因为我发现我很多emoji实际上是\ud开头的，反而暂时没发现有\ue开头。
    return json_decode($text);
}

/**
 * 检测是否是手机访问
 */
function is_mobile()
{
    $useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    $useragent_commentsblock=preg_match('|\(.*?\)|', $useragent, $matches)>0?$matches[0]:'';
    function _is_mobile($substrs, $text)
    {
        foreach ($substrs as $substr) {
            if (false!==strpos($text, $substr)) {
                return true;
            }
        }
        return false;
    }
    $mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
    $mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');

    $found_mobile=_is_mobile($mobile_os_list, $useragent_commentsblock) ||
              _is_mobile($mobile_token_list, $useragent);
    if ($found_mobile) {
        return true;
    } else {
        return false;
    }
}

/**
 * 将utf-16的emoji表情转为utf8文字形
 * @param  string $str 需要转的字符串
 * @return string      转完成后的字符串
 */
function escape_sequence_decode($str)
{
    $regex = '/\\\u([dD][89abAB][\da-fA-F]{2})\\\u([dD][c-fC-F][\da-fA-F]{2})|\\\u([\da-fA-F]{4})/sx';
    return preg_replace_callback($regex, function ($matches) {
        if (isset($matches[3])) {
            $cp = hexdec($matches[3]);
        } else {
            $lead = hexdec($matches[1]);
            $trail = hexdec($matches[2]);
            $cp = ($lead << 10) + $trail + 0x10000 - (0xD800 << 10) - 0xDC00;
        }

        if ($cp > 0xD7FF && 0xE000 > $cp) {
            $cp = 0xFFFD;
        }
        if ($cp < 0x80) {
            return chr($cp);
        } elseif ($cp < 0xA0) {
            return chr(0xC0 | $cp >> 6).chr(0x80 | $cp & 0x3F);
        }
        $result =  html_entity_decode('&#'.$cp.';');
        return $result;
    }, $str);
}

/**
 * 获取当前访问的设备类型
 * @return integer 1：其他  2：iOS  3：Android
 */
function get_device_type()
{
    //全部变成小写字母
    $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    $type = 1;
    //分别进行判断
    if (strpos($agent, 'iphone')!==false || strpos($agent, 'ipad')!==false) {
        $type = 2;
    }
    if (strpos($agent, 'android')!==false) {
        $type = 3;
    }
    return $type;
}

/**
 * 导入excel文件
 * @param  string $file excel文件路径
 * @return array        excel文件内容数组
 */
function import_excel($file)
{
    // 判断文件是什么格式
    $type = pathinfo($file);
    $type = strtolower($type["extension"]);
    $type=$type==='csv' ? $type : 'Excel5';
    ini_set('max_execution_time', '0');
    Vendor('PHPExcel.PHPExcel');
    // 判断使用哪种格式
    $objReader = PHPExcel_IOFactory::createReader($type);
    $objPHPExcel = $objReader->load($file);
    $sheet = $objPHPExcel->getSheet(0);
    // 取得总行数
    $highestRow = $sheet->getHighestRow();
    // 取得总列数
    $highestColumn = $sheet->getHighestColumn();
    //循环读取excel文件,读取一条,插入一条
    $data=array();
    //从第一行开始读取数据
    for ($j=1;$j<=$highestRow;$j++) {
        //从A列读取数据
        for ($k='A';$k<=$highestColumn;$k++) {
            // 读取单元格
            $data[$j][]=$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue();
        }
    }
    return $data;
}

/**
 * 生成二维码
 * @param  string  $url  url连接
 * @param  integer $size 尺寸 纯数字
 */
function qrcode($url, $size=4)
{
    Vendor('Phpqrcode.phpqrcode');
    QRcode::png($url, false, QR_ECLEVEL_L, $size, 2, false, 0xFFFFFF, 0x000000);
    exit($url);
}

/**
 * curl 函数
 * @param string $url 请求的地址
 * @param string $type POST/GET/post/get
 * @param array $data 要传输的数据
 * @param string $err_msg 可选的错误信息（引用传递）
 * @param int $timeout 超时时间
 * @param array 证书信息
 * @author liw@alltosun.com
 */
function go_curl($url, $type, $data = false, &$err_msg = null, $timeout = 20, $cert_info = array())
{
    $type = strtoupper($type);
    if ($type == 'GET' && is_array($data)) {
        $data = http_build_query($data);
    }
    $option = array();
    if ($type == 'POST') {
        $option[CURLOPT_POST] = 1;
    }
    if ($data) {
        if ($type == 'POST') {
            $option[CURLOPT_POSTFIELDS] = $data;
        } elseif ($type == 'GET') {
            $url = strpos($url, '?') !== false ? $url.'&'.$data :  $url.'?'.$data;
        }
    }
    $option[CURLOPT_URL]            = $url;
    $option[CURLOPT_FOLLOWLOCATION] = true;
    $option[CURLOPT_MAXREDIRS]      = 4;
    $option[CURLOPT_RETURNTRANSFER] = true;
    $option[CURLOPT_TIMEOUT]        = $timeout;
    //设置证书信息
    if (!empty($cert_info) && !empty($cert_info['cert_file'])) {
        $option[CURLOPT_SSLCERT]       = $cert_info['cert_file'];
        $option[CURLOPT_SSLCERTPASSWD] = $cert_info['cert_pass'];
        $option[CURLOPT_SSLCERTTYPE]   = $cert_info['cert_type'];
    }
    //设置CA
    if (!empty($cert_info['ca_file'])) {
        // 对认证证书来源的检查，0表示阻止对证书的合法性的检查。1需要设置CURLOPT_CAINFO
        $option[CURLOPT_SSL_VERIFYPEER] = 1;
        $option[CURLOPT_CAINFO] = $cert_info['ca_file'];
    } else {
        // 对认证证书来源的检查，0表示阻止对证书的合法性的检查。1需要设置CURLOPT_CAINFO
        $option[CURLOPT_SSL_VERIFYPEER] = 0;
    }
    $ch = curl_init();
    curl_setopt_array($ch, $option);
    $response = curl_exec($ch);
    $curl_no  = curl_errno($ch);
    $curl_err = curl_error($ch);
    curl_close($ch);
    // error_log
    if ($curl_no > 0) {
        if ($err_msg !== null) {
            $err_msg = '('.$curl_no.')'.$curl_err;
        }
    }
    return $response;
}

/**
 * 方法库-压缩函数，主要是发送http页面内容过大的时候应用
 * @param string $content 内容
 * @return string
 */
function gzip(&$content)
{
    if (!headers_sent()&&extension_loaded("zlib")&&strstr($_SERVER["HTTP_ACCEPT_ENCODING"], "gzip")) {
        $content = gzencode($content, 2);
        header("Content-Encoding: gzip");
        header("Vary: Accept-Encoding");
        header("Content-Length: ".strlen($content));
    }
    return $content;
}

//简单编码函数（与php_decode函数对应）
function php_encode($str)
{
    if ($str=='' && strlen($str)>128) {
        return false;
    }
    for ($i=0; $i<strlen($str); $i++) {
        $c = ord($str[$i ]);
        if ($c>31 && $c <107) {
            $c += 20 ;
        }
        if ($c>106 && $c <127) {
            $c -= 75 ;
        }
        $word = chr($c);
        $s .= $word;
    }
    return $s;
}
//简单解码函数（与php_encode函数对应）
function php_decode($str)
{
    if ($str=='' && strlen($str)>128) {
        return false;
    }
    for ($i=0; $i<strlen($str); $i++) {
        $c  = ord($word);
        if ($c>106 && $c<127) {
            $c = $c-20;
        }
        if ($c>31 && $c< 107) {
            $c = $c+75 ;
        }
        $word = chr($c);
        $s .= $word ;
    }
    return $s;
}
//简单加密函数（与php_decrypt函数对应）
function php_encrypt($str)
{
    $encrypt_key = 'abcdefghijklmnopqrstuvwxyz1234567890';
    $decrypt_key = 'ngzqtcobmuhelkpdawxfyivrsj2468021359';
    if (strlen($str) == 0) {
        return  false;
    }
    for ($i=0;  $i<strlen($str); $i ++) {
        for ($j=0; $j <strlen($encrypt_key); $j ++) {
            if ($str[$i] == $encrypt_key [$j]) {
                $enstr .=  $decrypt_key[$j];
                break;
            }
        }
    }
    return $enstr;
}
//简单解密函数（与php_encrypt函数对应）
function php_decrypt($str)
{
    $encrypt_key = 'abcdefghijklmnopqrstuvwxyz1234567890';
    $decrypt_key = 'ngzqtcobmuhelkpdawxfyivrsj2468021359';
    if (strlen($str) == 0) {
        return  false;
    }
    for ($i=0;  $i<strlen($str); $i ++) {
        for ($j=0; $j <strlen($decrypt_key); $j ++) {
            if ($str[$i] == $decrypt_key [$j]) {
                $enstr .=  $encrypt_key[$j];
                break;
            }
        }
    }
    return $enstr;
}

/**
 * 生成唯一的订单号 20110809111259232312
 * 2011-年日期
 * 08-月份
 * 09-日期
 * 11-小时
 * 12-分
 * 59-秒
 * 2323-微秒
 * 12-随机值
 * @return string
 */
function trade_no()
{
    list($usec, $sec) = explode(" ", microtime());
    $usec = substr(str_replace('0.', '', $usec), 0, 4);
    $str  = rand(10, 99);
    return date("YmdHis").$usec.$str;
}

/**
 * 方法库-sign签名方法
 * @param $array 需要加密的参数
 * @param $secret 秘钥
 * @param $signName sign的名称，sign不会进行加密
 */
function sign($array, $secret, $signName = "sign")
{
    if (count($array) == 0) {
        return "";
    }
    ksort($array); //按照升序排序
  $str = "";
    foreach ($array as $key => $value) {
        if ($signName == $key) {
            continue;
        }
        $str .= $key . "=" . $value . "&";
    }
    $str = rtrim($str, "&");
    return md5($str . $secret);
}
