<?php
/**
 * 登陆功能模块
 */
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller{
  /**
   * 登录主页
   * @return html
   */
   public function login() {
     if(isset($_SESSION['ADMIN_ID'])){//已经登录
       redirect(__ROOT__."/Admin/Index/index");
     } else {
       $this->display();
     }
   }

  /**
   * 登录执行
   * @return ajax
   */
   public function dologin() {
       $name = I("post.username");
       if(empty($name)){
         $this->ajaxReturn('用户名不能为空！');
       }
       $pass = I("post.password");
       if(empty($pass)){
         $this->ajaxReturn('密码不能为空！');
       }
      //  $code = I("post.verify");
      //  if(empty($code)){
      //    $this->ajaxReturn('验证码不能为空！');
      //  }
       if(strpos($name,"@")>0){//邮箱登陆
         $where['user_email'] = $name;
       }else{
         $where['user_login'] = $name;
       }
       $result = M('Users')->where($where)->find();
       if($result != null){
         if($result['user_pass'] == md5($pass)){
          //  if (!check_verify($code, 1)) {
          //    $this->ajaxReturn('验证码不正确！');
          //  }
           //登入成功页面跳转
           $_SESSION["ADMIN_ID"] = $result["id"];
           $_SESSION['user'] = $result;
           $result['last_login_ip'] = get_client_ip();
           $result['last_login_time'] = date("Y-m-d H:i:s");
           M('Users')->save($result);
           setcookie("admin_username",$name,time()+30*24*3600,"/");
           $this->ajaxReturn('登录成功！');
         }else{
           $this->ajaxReturn('密码不正确！');
         }
       }else{
         $this->ajaxReturn('用户不存在！');
       }

   }
   /**
    * 生成验证码
    * @param  [string] $width  验证码宽
    * @param  [string] $height 验证码高
    * @return [image]
    */
   public function getverify($width, $height) {
      verify($width, $height, 1);
   }

  /**
   * 登出
   * @return html
   */
   public function logout(){
      session('ADMIN_ID',null);
      session('user',null);
      redirect(__ROOT__."/Admin/Login/login");
   }

}
