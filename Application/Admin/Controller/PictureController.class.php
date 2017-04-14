<?php
/**
 * 图瀑管理
 * @author fermi 简易博客管理， 费腾博客第二版！
 */
namespace Admin\Controller;
use Think\Controller;
class PictureController extends BaseController {
  /**
   * 首页
   * @return
   */
  public function index() {
    $this->assign('mode_name', 'picture');
    $this->display();
  }

  /**
   * 图瀑列表
   * @return array
   */
  public function ajaxpiclist() {
    $title = I('title', '');
    $createtime = I('createtime', '');
    $author = I('author', '');
    $where['status'] = '0';
    if (!empty($createtime)) {
      $where['createtime'] = array('like', '%'.$createtime.'%');
    }
    if (!empty($title)) {
      $where['title'] = array('like', '%'.$title.'%');
    }
    if (!empty($author)) {
      $where['author'] = array('like', '%'.$author.'%');
    }
    $order = 'id desc';
    $page = I('p');
    $limit = '10';
    $data = D('Picture')->getPicList($where, $page, $limit, $order);
    $page = ajaxCreatePage($data['total'], $limit, 'getbloglist', $page);
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
      $data = D('Picture')->getPicData($id);
      $url = "/Admin/Picture/edit/";
      $this->assign('list', $data);
      $this->assign('url', $url);
    } else {
      $url = "add";
      $this->assign('url', $url);
    }
    $this->assign('mode_name', 'picture');
    $this->display();
  }

  /**
   * 获取文章图片
   * @return ajax
   */
  public function getpic() {
    $data = D('Picture')->getPicData(I('id', ''));
    $bigview = $data['url'];
    $bigview = explode('|', $bigview);
    $bigview['picture'] = $bigview;
    $this->ajaxReturn($bigview);
  }

  /**
   * 删除单个图片
   * @return ajax
   */
  public function deleteonepic() {
    $id = I('id', '');
    $url = I('picname', '');
    $dirurl = 'Upload'.$url;  //服务器文件地址，用来删除服务器相应文件
    if ($url) {
        $result = D('Picture')->getPicData(I('id', ''));
        if ($result['url']) {
            $picture = explode('|', $result['url']);
            foreach( $picture as $k=>$v) {
                if($url == $v) unset($picture[$k]);
            }
            $picture = array_values($picture);
            if (empty($picture)) {
              $data['url'] = '';
            } else {
              $picture = implode('|', $picture);
              $data['url'] = $picture;
            }
        } else {
          $this->ajaxReturn('数据库没有此图片，你是如何触发删除的呢？');
        }
        if(D('Picture')->editData("id=$id", $data)){
            unlink($dirurl);
            $this->ajaxReturn('success');
        }else{
            $this->ajaxReturn('fail');
        }
    } else {
      $this->ajaxReturn('没指定图片你删个啥子哟！');
    }

  }

  /**
   * 上传图片
   * @return
   */
  public function upload() {

  }

  /**
   * 添加图瀑
   * @return
   */
  public function add() {
    if (!empty($_FILES['filedata']['tmp_name'])) {
      $time = date('Ymd');
      $upload = new \Think\Upload();                                            // 实例化上传类
      $upload->maxSize = 20*1024*1024;                                          // 设置附件上传大小
      $upload->exts = array('jpg','png','gif','jpeg','psd','rar','zip','doc','xls','ppt','pdf','html','php','txt','bmp','js','xlsx','docx');                     // 设置附件上传类型
      $upload->rootPath = './Upload/';                                          // 设置附件上传根目录
      $upload->savePath = 'Picture/'.$time.'/';                                 // 设置附件上传（子）目录
      $upload->saveName = array('guid','');                                     //上传文件的保存规则，支持数组和字符串方式定义
      $upload->autoSub  = false;                                                //自动创建目录
      $upload->replace  = true;                                                 //同名替换
      $info = $upload->upload();                                                //执行上传操作调用上传方法upload，$info是当前数据对象
      if ($info) {
        for($i = 0; $i < count($info); $i++){
            if($i != 0){
                $file_names .= '|';
            }
            $file_names .= '/'.$info[$i]['savepath'].$info[$i]['savename'];
        }
        $data['url'] = $file_names;
      }
    }
    $data['title'] = I('title', '');
    $data['author'] = I('author', '');
    $data['source'] = I('source', '');
    $data['annotation'] = $_POST['annotation'];
    $data['createtime'] = date('Y-m-d H:i:s', time());
    $data['status'] = 0;
    $result = D('Picture')->addData($data);
    if ($result !== false) {
      $this->ajaxReturn("添加成功");
    } else {
      $this->ajaxReturn("添加失败");
    }
  }

  /**
   * 编辑图瀑
   * @return
   */
  public function edit() {
    if (!empty($_FILES['filedata']['tmp_name'])) {
      $time = date('Ymd');
      $upload = new \Think\Upload();                                            // 实例化上传类
      $upload->maxSize = 20*1024*1024;                                          // 设置附件上传大小
      $upload->exts = array('jpg','png','gif','jpeg','psd','rar','zip','doc','xls','ppt','pdf','html','php','txt','bmp','js','xlsx','docx');                     // 设置附件上传类型
      $upload->rootPath = './Upload/';                                          // 设置附件上传根目录
      $upload->savePath = 'Picture/'.$time.'/';                                 // 设置附件上传（子）目录
      $upload->saveName = array('guid','');                                     //上传文件的保存规则，支持数组和字符串方式定义
      $upload->autoSub  = false;                                                //自动创建目录
      $upload->replace  = true;                                                 //同名替换
      $info = $upload->upload();                                                //执行上传操作调用上传方法upload，$info是当前数据对象
      if ($info) {
        for($i = 0; $i < count($info); $i++){
            if($i != 0){
                $file_names .= '|';
            }
            $file_names .= '/'.$info[$i]['savepath'].$info[$i]['savename'];
        }
        $result = D('Picture')->getPicData(I('id', ''));
        if (!empty($result['url'])) {
          $data['url'] = $result['url'].'|'.$file_names;
        } else {
          $data['url'] = $file_names;
        }
      }
    }
    $map['id'] = I('id', '');
    $data['title'] = I('title', '');
    $data['author'] = I('author', '');
    $data['source'] = I('source', '');
    $data['annotation'] = $_POST['annotation'];
    $data['status'] = 0;
    $result = D('Picture')->editData($map, $data);
    if ($result !== false) {
      $this->ajaxReturn("修改成功");
    } else {
      $this->ajaxReturn("修改失败");
    }
  }

  /**
   * 删除图瀑（伪删除）
   * @return ajax
   */
   public function deletepic() {
       $id = I('id', '');
       $data['status'] = '1';
       $result = D('Picture')->editData("id=$id", $data, M('Picture'));
       if ($result !== false) {
         $this->ajaxReturn('success');
       } else {
         $this->ajaxReturn('fail');
       }
   }

}
