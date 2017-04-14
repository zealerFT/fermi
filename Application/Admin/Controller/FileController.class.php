<?php
/**
 * 文件管理
 * @author fermi -- 处理文件生成压缩的类
 */
namespace Admin\Controller;
use Think\Controller;
class FileController extends Controller {

 /**
  * 通过phpword生成文件
  * @return WORD 文件
  */
  public function downword() {
    $data = '今天是个好日子！';
    $filename = '第一份word';
    //word1($data, $filename); //直接下载
    word2($data, $filename); //phpword生成word文件
  }

  public function zip() {
    $result = list_dir('./test/');
    downzip($result);
  }

/**
 * 生成excel案例
 * @return Excel
 */
  public function raiseaccountexcel() {
    $product = M('Products')->where('ID=%d', I('productid'))->find();
    $data = array(
        array('收款行', $product['bank_name']),
        array('汇款时请备注', $product['remarks'])
       );
    $productname = $product['productname'].'(募集账户)';
    create_xls($data, $productname);
  }

  /**
    * 生成pdf 案例
    * @return pdf
  */
  public function raiseaccountpdf() {
    $product = M('Products')->where('ID=%d', I('productid'))->find();
    $html = "<p>产品名:".$product['productname']."</p>".
    "<p>汇款时请备注:".$product['remarks']."</p>";
    $productname = $product['productname'].'(募集账户)';
    pdf($html, 'Raiseaccount.pdf', 'D');
  }

  /**
   * 生成邮件html页面， fetch为返回html的TP方法，定位在Controller里
   * @param string $id
   * @return string 邮件主体
   */
  public function getordermailbody($id) {
    $order = M('order')->where("id = '%s'", array($id))->find();
    $this->assign('order', $order);
    $html = $this->fetch('ordermailbody');
    return $html;
  }

  /**
   * 生成短信样式
   * @param string $id
   * @return string 短信主体
   */
  public function getordersmsbody($id) {
    $order = M('order')->where("id = '%s'", array($id))->find();
    $product = M('Products')->where('ID=%d', $order['productid'])->find();
    $html = '恭喜您已成功签约'.$product['productname'].' ，更多内容请登录 www.feiteng.ren查看';
    return $html;
  }

 /**
  * 订单生成案例
  * @return Action -- 类似观察者模式，需要的时候调用相应的方法
  */
  public function order() {
    $body = $this->getordermailbody($id);
    $smsbody = $this->getordersmsbody($id);
    send_sms_oneway($result['contact'], $smsbody);
    think_send_mail($result['email'], $result['username'], '产品预约成功提示', $body);
  }

}
