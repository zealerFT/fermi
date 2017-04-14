<?php
/**
 * 前台登录
 * @author fermi
 *
 */
namespace Home\Controller;

use Think\Controller;

import("Org.ThinkSDK.ThinkOauth");
import('@.Api.SmsApi');

class LoginController extends Controller
{
    /**
   * 互联登录主入口
   * @param $type sns类型
   * @return url
   */
  public function snslogin()
  {
      $type = $_GET['type'];
      if ($type == 'qq' || $type == 'weibo') {
          //生成唯一字符串 用来防止CSRF
          $state = md5(uniqid(rand(), true));
          $sns  = \ThinkOauth::getInstance($type);
          //跳转到授权页面
          redirect($sns->getRequestCodeURL());
      } elseif ($type == 'weixin') {
          $this->success('微信互联登录需要经营许可证才能申请，暂时没有做！', '/Home/Index/index', 2);
      } else {
          $this->error('请不要私自伪装type值访问，因为这样没有任何意义！', '/Home/Index/index', 2);
      }
  }

  /**
   * 地址回调处理
   * @param $type 回调类型
   * @return function [description]
   */
  public function callback($type = null, $code = null)
  {
      $type = $_GET['type'];
      $code = $_GET['code'];
      if (empty($type) || empty($code)) {
          $this->error('没有接收到code值！');
      }
      $sns  = \ThinkOauth::getInstance($type);
      //腾讯微博需传递的额外参数
      $extend = null;
      if ($type == 'tencent') {
          $extend = array('openid' => $this->_get('openid'), 'openkey' => $this->_get('openkey'));
      }
      //获取openid和access_token
      $token = $sns->getAccessToken($code, $extend);
      //首先检查oauth_user表中有没有这条用户的信息
      $result = D('Oauth')->getQqUserInfoByToken($token['access_token'], $token['openid']);
      if (empty($result)) {
          switch ($type) {
            case 'qq':
              $user = \SmsApi::qq($token);
              break;
            case 'weibo':
              $user = \SmsApi::weibo($token);
              break;
            case 'weixin':
              $user = \SmsApi::weixin($token);
              break;
            default:
              $this->error('您正在试图伪造登录！');
              break;
          }
          //把API返回的数据拼接上access_token(3个月令牌，可续期)，openid(永久QQ用户标识)，用来验证此用户是否曾登陆过
          $user['access_token'] = $token['access_token'];
          $user['openid'] = $token['openid'];
          $this->stepOne($user, $type);
      } else {
          $this->stepThree($result['uid'], $type);
      }
  }

  /**
   * 首次登陆的用户
   * @param  Array $user 互联登录用户信息
   * @return redirect
   */
  public function stepOne($user, $type)
  {
      $result = D("Oauth")->saveQqUserInfo($user);
      if (false !== $result) {
          $this->stepThree($result, $type);
      } else {
          $this->error("登陆失败！");
      }
  }

  /**
   * 完善用户信息，添加email和tel字段  -- 暂时不执行！！
   * @param  Int $uid 用户ID
   * @return html
   */
  public function stepTwo($uid = null)
  {
      if ($_POST['submit']) {
          $qq_user_model = D('Oauth');
          //执行自动验证
          if ($qq_user_model->create() === false) {
              $this->error($qq_user_model->getError());
          }
          //修改用户信息
          $qq_user_model->where(array("uid" => I("post.uid")))->save();
          //跳转到第三步
          $this->stepThree(I('post.uid'));
      } else {
          $this->uid = $uid;
          $this->display("Login/stepTwo");
      }
  }

  //登陆和信息都完成后，记录用户登陆状态并跳转至首页
  public function stepThree($uid = null, $type)
  {
      isset($_GET['uid']) && $uid = $_GET['uid'];
      $qq_user = D('Oauth')->getQqUserInfo($uid);
      session("user", $qq_user);
      $this->success("恭喜<font color='red'>'.$type.'</font>用户".$qq_user['nickname'].",您已授权登陆成功！然而仅供测试，后续会关联评论用户登录！", U("Home/Index/index"), 3);
  }
}
