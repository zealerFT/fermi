<?php
namespace Admin\Model;
/**
 * 图瀑model
 */
class UserModel extends BaseModel {
  /**
   * 获取图片详情
   */
  public function getUserData($id) {
    $data = $this->where("id = '$id'")->find();
    return $data;
  }

  /**
   * 获图瀑列表
   * @param
   * @return array
   */
  public function getUserList($where, $page, $limit, $order='', $field='') {
      $model = M('User');
      $data = $this->getData($model, $where, $page, $limit, $order, $field);
      return $data;
  }

}
