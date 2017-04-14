<?php
/**
 * 评论管理
 * @nickname fermi 简易博客管理， 费腾博客第二版！
 */
namespace Admin\Controller;
use Think\Controller;
class CommentController extends BaseController {
  /**
   * 首页
   * @return
   */
  public function index() {
    $this->assign('mode_name', 'comment');
    $this->display();
  }

  /**
   * 图瀑列表
   * @return array
   */
  public function ajaxcomlist() {
    $title = I('title', '');
    $createtime = I('createtime', '');
    $nickname = I('nickname', '');
    $where['a.status'] = 0;
    if (!empty($createtime)) {
      $where['a.createdtime'] = array('like', '%'.$createtime.'%');
    }
    if (!empty($title)) {
      $where['c.title'] = array('like', '%'.$title.'%');
    }
    if (!empty($nickname)) {
      $where['b.nickname'] = array('like', '%'.$nickname.'%');
    }
    $order = 'a.id desc';
    $page = I('p');
    $limit = '10';
    $data = D('Comment')->getComList($where, $page, $limit, $order);
    $page = ajaxCreatePage($data['total'], $limit, 'getcomlist', $page);
    $data['list'] = $data['list'];
    $data['page'] = $page;
    $this->ajaxReturn($data);
  }

  /**
   * 详情
   * @return
   */
  public function detail() {
    $id = I('id');
    if ($id) {
      $data = D('Comment')->getComData($id);
      $url = "/Admin/Comment/edit/";
      $this->assign('list', $data);
      $this->assign('url', $url);
    } else {
      $url = "add";
      $this->assign('url', $url);
    }
    $this->assign('mode_name', 'comment');
    $this->display();
  }

  /**
   * 添加评论 - 暂时没有用到
   * @return
   */
  public function add() {
    $data['content'] = $_POST['content'];
    $data['createdtime'] = date('Y-m-d H:i:s', time());
    $data['status'] = 0;
    $result = D('Picture')->addData($data);
    if ($result !== false) {
      $this->ajaxReturn("添加成功");
    } else {
      $this->ajaxReturn("添加失败");
    }
  }

  /**
   * 编辑评论
   * @return
   */
  public function edit() {
    $map['id'] = I('id', '');
    $data['content'] = $_POST['content'];
    $data['status'] = 0;
    $result = D('Comment')->editData($map, $data);
    if ($result !== false) {
      $this->ajaxReturn("修改成功");
    } else {
      $this->ajaxReturn("修改失败");
    }
  }

  /**
   * 删除评论
   * @return ajax
   */
  public function deletecomment() {
    $id = I('id', '');
    $data['status'] = '1';
    $result = D('Comment')->editData("id=$id", $data);
    if ($result !== false) {
      $this->ajaxReturn('success');
    } else {
      $this->ajaxReturn('fail');
    }
  }


}
