<?php
/**
 * 基础类
 * @author fermi：登录和权判断
 */
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {

    /**
     * 构造方法
     * 检测账户和权限
     */
    public function __construct() {
        parent::__construct();
        if(IS_AJAX){
            $this->checkLoginAjax();
            $this->checkAuthAjax();
        } else {
            $this->checkLogin();
            $this->checkAuth();
        }
    }


    /**
     * 检测是否登录
     */
    public function checkLogin(){
        if (!session("?ADMIN_ID")) {
          redirect(__ROOT__."/Admin/Login/login");
        }
    }

    /**
     * 检测是否登录ajax
     */
    public function checkLoginAjax(){
        if (!session("?ADMIN_ID")) {
          $this->ajaxReturn('unlogin');
          exit();
        }
    }

    /**
     * 检测权限
     */
    public function checkAuth(){
        $auth = new \Think\Auth();
        $rule_name = MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
        $result = $auth->check($rule_name, $_SESSION["ADMIN_ID"]);
        if(!$result){
          $this->error('您没有权限访问！', '/Admin/Index/index', 1);
          exit();
        }
    }

    /**
     * 检测权限ajax
     */
    public function checkAuthAjax(){
        $auth = new \Think\Auth();
        $rule_name = MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
        $result = $auth->check($rule_name, $_SESSION["ADMIN_ID"]);
        if(!$result){
          $this->ajaxReturn('unauth');
          exit();
        }
    }
}
