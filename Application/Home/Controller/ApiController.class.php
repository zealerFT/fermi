<?php
/**
 * 算法管理
 * @author fermi 开发api实例
 */
namespace Home\Controller;

use Think\Controller;

class ApiController extends BaseApiController
{

  /**
   * 尝试随意调用的回复
   * @return Ajax
   */
  public function __call($function_name, $args)
  {
      $result = array(
        'code' => '110',
        'clienttime' => time(),
        'servertime' => time(),
        'message_eu' => 'false',
        'message_cn' => '请勿随意尝试调用'.$function_name.'接口，请联系管理员申请接口权限！',
        'data' => ''
    );
      return $this->ajaxReturn($result, $format = 'JSON');
  }

 /**
  * 获取token
  * @return String
  */
  public function gettoken()
  {
      $this->clienttime = time();
      parent::getToken();
  }

  /**
   * 第一个接口测试
   * @return Ajax
   */
  public function firstopenapi()
  {
      $this->clienttime = time();
      parent::checkToken();
      if (!IS_POST) {
          $this->apiReturn(4105, '未使用POST请求');
      }
      $data = D('Country')->get_country_list();
      if ($data) {
          $this->apiReturn(0, 'Success', '数据请求成功', $data);
      } else {
          $this->apiReturn(4003, 'Fail', '数据请求失败');
      }
  }
}
