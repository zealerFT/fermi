<?php
namespace Admin\Model;
/**
 * 博客model
 */
class BlogModel extends BaseModel {

  public function getBlogData($id) {
    $data = $this->where("id = '$id'")->find();
    return $data;
  }

  /**
   * 获文章列表
   * @param
   * @return array
   */
  public function getBlogList($where, $page, $limit, $order='', $field='') {
      $model = M('Blog');
      $data = $this->getData($model, $where, $page, $limit, $order, $field);
      return $data;
  }

}
