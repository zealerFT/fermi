<?php
namespace Admin\Model;
/**
 * 图瀑model
 */
class CommentModel extends BaseModel {

  /**
   * 获取评论详情
   */
  public function getComData($id) {
    $data = M('Comment')
            ->alias('a')
            ->join("left join `f_user` b on a.uid = b.id")
            ->join("left join `f_blog` c on a.bid = c.id")
            ->where("a.id = '$id'")
            ->field('a.*,b.nickname,b.email,b.last_login_ip,c.title')
            ->find();
    return $data;
  }

  /**
   * 获取评论列表
   * @param
   * @return array
   */
  public function getComList($where, $page, $limit, $order='', $field='') {
    $where['_string'] = '(b.status = 0) AND (c.status = 0)';
    $count = M('Comment')
             ->alias('a')
             ->join("left join `f_user` b on a.uid = b.id")
             ->join("left join `f_blog` c on a.bid = c.id")
             ->where($where)
             ->count();
    $result = M('Comment')
              ->alias('a')
              ->join("left join `f_user` b on a.uid = b.id")
              ->join("left join `f_blog` c on a.bid = c.id")
              ->where($where)
              ->order($order)
              ->page($page.','.$limit)
              ->field('a.*,b.nickname,b.email,b.last_login_ip,c.title')
              ->select();
    $data = array(
        'list'=>$result,
        'total'=>$count
        );
    return $data;
  }

}
