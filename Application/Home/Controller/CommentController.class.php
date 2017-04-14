<?php
/**
 * 文章详情
 * @author fermi
 *
 */
namespace Home\Controller;
use Think\Controller;
class CommentController extends Controller {
  public function index() {
    $this->display();
  }

  /**
   * 添加评论
   */
  public function add() {
    if (IS_AJAX) {
      $email = I('email', '');
      $id = I('articleid', '');
      $nickname = I('nickname', '');
      $comment = $_POST['comment'];
      #以邮箱为标识，判断用户唯一性
      $user = D('User')->getUserDataByEmail($email);
      if (!empty($user)) {
        $map['id'] = $user['id'];
        $data['nickname'] = $nickname;
        $data['times'] = (int)$user['times'] + 1;
        $data['last_login_ip'] = get_client_ip();
        $data['last_login_time'] = date("Y-m-d H:i:s",time());
        D('User')->editData($map, $data);
        $data3['uid'] = $user['id'];   //关联用户ID
        $data3['bid'] = $id;           //关联文章ID
        $data3['content'] = $comment;
        $data3['createdtime'] = date("Y-m-d H:i:s",time());
        $result3 = D('Comment')->addData($data3);
        if ($result3 !== false) {
          $this->ajaxReturn("添加成功");
        } else {
          $this->ajaxReturn("添加失败");
        }
      } else {
        #首次评论用户
        $data1['nickname'] = $nickname;
        $data1['email'] = $email;
        $data1['createdtime'] = date("Y-m-d H:i:s",time());
        $data1['regtime'] = time();
        $data1['last_login_ip'] = get_client_ip();
        $data1['last_login_time'] = date("Y-m-d H:i:s",time());
        $data1['times'] = 1;
        $result1 = D('User')->addData($data1);
        #处理评论
        $data2['uid'] = $result1;   //关联用户ID
        $data2['bid'] = $id;        //关联文章ID
        $data2['content'] = $comment;
        $data2['createdtime'] = date("Y-m-d H:i:s",time());
        $result2 = D('Comment')->addData($data2);
        if ($result2 !== false) {
          $this->ajaxReturn("添加成功");
        } else {
          $this->ajaxReturn("添加失败");
        }
      }
    } else {
      $this->ajaxReturn('请不要伪造表单哦！');
    }

  }

  public function edit() {

  }

  public function delete() {

  }

  public function getcomment() {
    $bid = I('id', '');
    $filter['_string'] = "a.status=0 and b.status=0 and a.bid = '$bid'";
    $content = M('Comment')->alias('a')->join("left join `f_user` b on a.uid = b.id")->where($filter)->order('a.createdtime desc')->field('a.*,b.*')->select();
    $result['list'] = $content;
    $this->ajaxReturn($result);
  }

}
