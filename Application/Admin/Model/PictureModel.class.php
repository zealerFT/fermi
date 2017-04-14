<?php
namespace Admin\Model;
/**
 * 图瀑model
 */
class PictureModel extends BaseModel {
  /**
   * 获取图片详情
   */
  public function getPicData($id) {
    $data = $this->where("id = '$id'")->find();
    return $data;
  }

  /**
   * 获图瀑列表
   * @param
   * @return array
   */
  public function getPicList($where, $page, $limit, $order='', $field='') {
      $model = M('Picture');
      $data = $this->getData($model, $where, $page, $limit, $order, $field);
      return $data;
  }

}
