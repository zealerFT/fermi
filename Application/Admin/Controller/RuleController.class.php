<?php
/**
  * 后台权限管理
  * @author fermi：自然卷的人都不会太坏
 */
namespace Admin\Controller;
class RuleController extends BaseController {

  /**
   * 权限列表
   */
  public function index(){
      $data = D('AuthRule')->getTreeData('tree','id','title');
      $this->assign('list', $data);
      $this->assign('mode_name', 'ruleindex');
      $this->display();
  }

  /**
   * ajax权限列表数据
   * @return array
   */
  public function rulelist(){
      $data = D('AuthRule')->getTreeData('tree','id','title');
      $this->ajaxReturn($data);
  }

  /**
   * 添加权限
   */
  public function add(){
      $data = I('post.');
      unset($data['id']);
      $result = D('AuthRule')->addData($data);
      if (false !== $result) {
        $this->ajaxReturn('添加成功');
      } else {
        $this->ajaxReturn('添加失败');
      }

  }

  /**
   * 修改权限
   */
  public function edit(){
      $data = I('post.');
      $map=array(
          'id'=>$data['id']
          );
      $result = D('AuthRule')->editData($map,$data);
      if ($result >= 0) {
        $this->ajaxReturn('修改成功');
      } else {
        $this->ajaxReturn('修改失败');
      }
  }

  /**
   * 删除权限
   */
  public function delete(){
      $id = I('post.id');
      $map=array(
          'id'=>$id
          );
      $result = D('AuthRule')->deleteData($map);
      if($result){
          $this->ajaxReturn('success');
      }else{
          $this->ajaxReturn('fail');
      }

  }

  //============================>>>>>角色(用户组)<<<<<=============================//
      /**
       * 角色列表
       */
      public function roleindex(){
          $this->assign('mode_name', 'roleindex');
          $this->display();
      }

      /**
       * 角色列表
       */
      public function role(){
          $data = D('AuthGroup')->select();
          $data1 = D('AuthRule')->select();
          foreach ($data as $key => $value) {
            $data[$key]['selectrule'] = explode(',', $data[$key]['rules']);
          }
          $result['list'] = $data;
          $result['rule'] = $data1;
          $this->ajaxReturn($result);
      }

      /**
       * 改变单个权限选项
       * @return ajax
       */
      public function changeonerule() {
          $id = I('id', '');
          $rule = I('rule', '');
          $data = D('AuthGroup')->where('id=%d', $id)->find();
          $result = explode(',', $data['rules']);
          if (FALSE !== $key = array_search($rule, $result)) {
            unset($result[$key]);
          } else {
            array_push($result, $rule);
            sort($result);
          }
          $newdata = array("rules" => join(",", $result));
          $map = array('id'=>$id);
          if (false !== D('AuthGroup')->editData($map, $newdata)) {
            $this->ajaxReturn(array("info" => "修改成功!"));
          } else {
            $this->ajaxReturn(array("info" => "修改失败!"));
          }
      }

      /**
       * 添加角色
       */
      public function role_add(){
          $data=I('post.');
          unset($data['id']);
          $result = D('AuthGroup')->addData($data);
          if (false !== $result) {
            $this->ajaxReturn('添加成功');
          } else {
            $this->ajaxReturn('添加失败');
          }
      }

      /**
       * 修改角色
       */
      public function role_edit(){
          $data=I('post.');
          $map=array(
              'id'=>$data['id']
              );
          $result = D('AuthGroup')->editData($map,$data);
          if ($result >= 0) {
            $this->ajaxReturn('修改成功');
          } else {
            $this->ajaxReturn('修改失败');
          }
      }

      /**
       * 删除角色
       */
      public function role_delete(){
          $id=I('get.id');
          $map=array(
              'id'=>$id
              );
          $result = D('AuthGroup')->deleteData($map);
          if($result){
              $this->ajaxReturn('success');
          }else{
              $this->ajaxReturn('fail');
          }
      }

//============================>>>>>用户<<<<<=============================//
      /**
       * 用户列表
       */
      public function userindex(){
          $data = D('AuthGroup')->where('status = 1')->getField('id,title');
          $role = array();
          foreach ($data as $key => $value) {
            $role[] = array('id' => $key, 'title' => $value);
          }
          $this->assign('role', $role);
          $this->assign('mode_name', 'userindex');
          $this->display();
      }

      /**
       * 用户列表
       */
      public function user(){
          $data = D('AuthGroup')->where('status = 1')->getField('id,title');
          $role = array();
          foreach ($data as $key => $value) {
            $role[] = array('id' => $key, 'title' => $value);
          }
          $filter['_string'] = '(a.status=1)';
          $user = M('Users')->alias('a')->join("left join `f_auth_group_access` b on a.uid = b.uid")->join("left join `f_auth_group` c on b.group_id = c.id")->where($filter)->field('a.*,c.title')->select();
          $result['list'] = $user;
          $result['roleon'] = $role;
          $this->ajaxReturn($result);
      }

      /**
       * 改变用户对应角色
       * @return ajax
       */
      public function changeuserrole() {
        $data['group_id'] = I('roleid');
        $map=array('uid' => I('useruid'));
        if (false !== D('AuthGroupAccess')->editData($map, $data)) {
          $this->ajaxReturn(array("info" => "修改成功!"));
        } else {
          $this->ajaxReturn(array("info" => "修改失败!"));
        }

      }

      /**
       * 添加角色
       */
      public function user_add() {
        $data = I('post.');
        $data['user_login'] = I('user_login');
        $data['user_email'] = I('user_email');
        $data['user_pass'] = MD5(I('user_pass'));
        $data['create_time'] = date('Y-m-d H:i:s');
        $result = D('Users')->addData($data);
        if (false !== $result) {
          $where['id'] = $result;
          $data = array();
          $data['uid'] = $result;
          D('Users')->editData($where, $data);
          $data['group_id'] = I('group_id');
          D('AuthGroupAccess')->addData($data);
          $this->ajaxReturn('添加成功');
        } else {
          $this->ajaxReturn('添加失败');
        }

      }

      /**
       * 编辑角色
       */
      public function user_edit() {
        $data = I('post.');
        $data['user_login'] = I('user_login1');
        $data['user_email'] = I('user_email1');
        $pass = I('user_pass1');
        if (!empty($pass)) {
          $data['user_pass'] = md5($pass);
        }
        $where['id'] = I('id');
        $result = D('Users')->editData($where, $data);
        if (false !== $result) {
          $this->ajaxReturn('修改成功');
        } else {
          $this->ajaxReturn('修改失败');
        }

      }

      /**
       * 删除角色
       */
      public function user_delete() {
        $id = I('post.id');
        $map['id'] = $id;
        $data['status'] = 0;
        $result = D('Users')->editData($map, $data);
        if($result){
            $this->ajaxReturn('success');
        }else{
            $this->ajaxReturn('fail');
        }
      }

}
