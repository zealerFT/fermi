<?php
/**
 * 算法管理
 * @author fermi php接口api验证基本设计模式
 */
namespace Admin\Controller;
use Think\Controller;
class ApiController extends BaseController {
  /**
   * 检测token值
   * @return [type]
   */
  protected function checkToken() {
      $token = I('token');
      if (empty($token)) {
          $this->apiReturn(4101, '缺少token参数');
      } else if (!S($token)) {
          $this->apiReturn(4002, '当前token无效或超时');
      }
  }

/**
 * 获取token值
 * @return [type] [description]
 */
  public function getToken() {

      $this->appid = I('appid', 0);
      $this->appsecret = I('appsecret', 0);

      if (empty($this->appid)) {
          $this->apiReturn(4102, "缺少appid参数");
      }
      if (empty($this->appsecret)) {
          $this->apiReturn(4104, "缺少appsecret参数");
      }
      //获取申请过appid的开放用户信息
      $secret = M('ApiAuth')->where("app_id = '%s' and app_secret = '%s'", array($this->appid, $this->appsecret))->find();
      if ($secret) {
          $ori_str = S($this->appid . '_' . $this->appsecret);
          if ($ori_str) {       //重新获取就把以前的token删除
              S($ori_str, null);
          }
          //这里是token产生的机制  您也可以自己定义
          $nonce = $this->createNoncestr();
          $tmpArr = array($nonce, $this->appid, $this->appsecret);

          sort($tmpArr, SORT_STRING);
          $tmpStr = implode($tmpArr);
          $tmpStr = sha1($tmpStr);

          //这里做了缓存 'a'=>b 和'b'=>a格式的缓存
          $exp_time = 86400;
          S($this->appid . '_' . $this->appsecret, $tmpStr, $exp_time);
          S($tmpStr, $this->appid . '_' . $this->appsecret, $exp_time);

          $this->apiReturn(0, "token获取成功,有效期24小时", $tmpStr);
      } else {
          $this->apiReturn(4001, "获取token时appid或appsecret错误，请联系网站!");
      }
  }

  /**
   *  作用：产生随机字符串，不长于32位
   */
  function createNoncestr($length = 32) {
      $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
      $str = "";
      for ($i = 0; $i < $length; $i++) {
          $str.= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
      }
      return $str;
  }

  /**
   * @param int $code
   * @param string $message
   * @param array $data
   * @param string $format
   * @return string|void
   */
  protected function apiReturn($code, $message = '', $data = array(), $format = 'JSON') {
      if (!is_numeric($code)) {
          return '';
      }
      $result = array(
          'code' => strval($code),
          'message' => $message,
          'data' => $data
      );
      $data = array(
          'ip' => get_client_ip(),
          'service' => S(I('token')),
          'method' => ACTION_NAME,
          'msg' => json_encode($_REQUEST),
          'returnmsg' => json_encode($data),
      );
      M('apilog')->add($data);   //用来记录请求，存入数据库
      return $this->ajaxReturn($result, $format);
  }

  /**
   * 添加我的反馈 -- 测试接口
   */
  public function createFeedback() {
      $this->checkToken();
      if (!IS_POST) {        //用来定标准，一般查询可是get，其他建议post
          $this->apiReturn(4105, '未使用POST请求');
      }
      $uid = (int) decrypt(I('uid', 0));
      $content = trim(I('content'));
      if ($uid) {
          $retData = createFeedback($uid, $content);   //createFeedback表示从数据库获取数据的方法
          if ($retData['isSuccess'] == true) {
              $this->apiReturn(0, '数据请求成功！');
          } else {
              $this->apiReturn(4003, '数据请求失败！');
          }
      } else {
          $this->apiReturn(4100, '缺少参数uid');
      }
  }

  /**
   * 取得国家信息列表  -- 测试接口
   */
  public function getCountry() {
      $this->checkToken();
      $retData = get_country_list();
      if ($retData) {
          $this->apiReturn(0, '数据请求成功', $retData);
      } else {
          $this->apiReturn(4003, '数据请求失败');
      }
  }

}
