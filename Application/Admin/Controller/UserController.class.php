<?php
/**
 * 用户管理(会员管理)
 * @author fermi 简易博客管理， 费腾博客第二版！
 */
namespace Admin\Controller;
use Think\Controller;
class UserController extends BaseController {
  /**
   * 首页
   * @return
   */
  public function index() {
    $this->assign('mode_name', 'user');
    $this->display();
  }

  /**
   * 用户列表
   * @return array
   */
  public function ajaxuserlist() {
    $nickname = I('nickname', '');
    $email = I('email', '');
    $where['status'] = '0';
    if (!empty($email)) {
      $where['email'] = array('like', '%'.$email.'%');
    }
    if (!empty($nickname)) {
      $where['nickname'] = array('like', '%'.$nickname.'%');
    }
    $order = 'id desc';
    $page = I('p');
    $limit = '10';
    $data = D('User')->getUserList($where, $page, $limit, $order);
    $page = ajaxCreatePage($data['total'], $limit, 'getuserlist', $page);
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
      $data = D('User')->getUserData($id);
      $url = "/Admin/User/edit/";
      $this->assign('list', $data);
      $this->assign('url', $url);
    } else {
      $url = "add";
      $this->assign('url', $url);
    }
    $this->assign('mode_name', 'user');
    $this->display();
  }

  /**
   * 添加用户
   * @return
   */
  public function add() {
    $data['nickname'] = I('nickname', '');
    $data['email'] = I('email', '');
    $data['phone'] = I('phone', '');
    $data['times'] = I('times', '');
    $data['last_login_ip'] = I('last_login_ip', '');
    $data['last_login_time'] = I('last_login_time', '');
    $data['remarks'] = I('remarks', '');
    $data['createdtime'] = date('Y-m-d H:i:s', time());
    $data['status'] = I('status', '');
    $result = D('User')->addData($data);
    if ($result !== false) {
      $this->ajaxReturn("添加成功");
    } else {
      $this->ajaxReturn("添加失败");
    }
  }

  /**
   * 编辑用户信息
   * @return
   */
  public function edit() {
    $map['id'] = I('id', '');
    $data['nickname'] = I('nickname', '');
    $data['email'] = I('email', '');
    $data['phone'] = I('phone', '');
    $data['times'] = I('times', '');
    $data['last_login_ip'] = I('last_login_ip', '');
    $data['last_login_time'] = I('last_login_time', '');
    $data['createdtime'] = I('createdtime', '');
    $data['remarks'] = I('remarks', '');
    $data['status'] = I('status', '');
    $result = D('User')->editData($map, $data);
    if ($result !== false) {
      $this->ajaxReturn("修改成功");
    } else {
      $this->ajaxReturn("修改失败");
    }
  }

  /**
   * 删除用户
   * @return ajax
   */
  public function deleteuser() {
    $id = I('id', '');
    $data['status'] = '1';
    $result = D('User')->editData("id=$id", $data);
    if ($result !== false) {
      $this->ajaxReturn('success');
    } else {
      $this->ajaxReturn('fail');
    }
  }


}
