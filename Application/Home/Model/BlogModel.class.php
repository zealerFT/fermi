<?php
namespace Home\Model;
/**
 * 博客model
 */
class BlogModel extends BaseModel {

  public function getBlogData($id) {
    $data = $this->where("id = '$id'")->find();
    return $data;
  }

  /**
   * 分类获取文章
   * @param  $id   文章
   * @param  $type
   * @return
   */
  public function getBlogDataByType($id, $type='') {
    $data = $this->where("id = '$id'")->find();
    return $data;
  }

  /**
   * 获文章列表
   * @param  $where
   * @return array
   */
  public function getBlogList($where, $page, $limit, $order='', $field='') {
      $model = M('Blog');
      $data = $this->getData($model, $where, $page, $limit, $order, $field);
      return $data;
  }

  /**
   * 获文章统计分类查询
   * @param  $type  要分类的标识
   * @return array
   */
  public function getBlogByCount($type, $like = '') {
      if (empty($like)) {
        $data= $this->query("SELECT $type,count(id) as size
                    FROM  f_blog
                    WHERE status = '0'
                    GROUP BY $type;
                    ");
      } else {
        $data= $this->query("SELECT $type,count(id) as size
                    FROM  f_blog
                    WHERE status = '0'
                    GROUP BY DATE_FORMAT($like,'%m-%Y');
                    ");
      }
      return $data;
  }



}
