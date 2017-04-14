<?php
/**
 * 公共方法（不需要验证权限）
 */
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller {
    /**
     * 设置消息显示页面的数据
     *
     * @param array $msg
     */
    private function setMsgPageData($msg = array()) {
        $_msg = $msg[0];
        $content = empty($msg[1])?"返回上一页":$msg[1];
        $url = empty($msg[2])?"-1":$msg[2];
        $http_referer = empty($_SERVER['HTTP_REFERER'])?"":$_SERVER['HTTP_REFERER'];
        if ($http_referer == "" && $url == ""){
            $url = "/";}
        if ($url == "-1") {
            $url = $http_referer;
        }elseif ($url == "" ) {
            $url = $http_referer;
        }
        $url_r = $http_referer;
        $showmsg = array('msg'=>$_msg,"url"=>$url,"content"=>$content,"url_r"=>$url_r);
        $this->assign('showmsg', $showmsg);
    }

    /**
     * 跳转到系统消息页面
     *
     * @param array $msg
     */
    public function msg($msg=array()){
        $this->setMsgPageData($msg);

        $this->display(C('TMPL_ACTION_JY_SUCCESS'));
    }

}
