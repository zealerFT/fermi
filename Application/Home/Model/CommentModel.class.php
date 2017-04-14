<?php
namespace Home\Model;
/**
 * 评论model
 */
class CommentModel extends BaseModel {
   /**
    * 获取评论类别
    * $bid 文章id
    */
   public function getCommentByBid($bid) {
     $data = $this->where("bid = '$bid'")->select();
     return $data;
   }

   public function getCommentCount($bid) {
     $data = $this->where("status = 0 and bid = '$bid'")->count();
     return $data;
   }

}
