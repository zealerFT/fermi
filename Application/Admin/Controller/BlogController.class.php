<?php
/**
 * 博客管理
 * @author fermi 简易博客管理， 费腾博客第二版！
 */
namespace Admin\Controller;
use Think\Controller;
class BlogController extends BaseController {
  /**
   * 首页
   * @return
   */
  public function index() {
    $typelist = D('Param')->getParameter('blogtype');
    $labellist = D('Param')->getParameter('bloglabel');
    $this->assign('typelist', $typelist);
    $this->assign('labellist', $labellist);
    $this->assign('mode_name', 'blog');
    $this->display();
  }

  /**
   * 文章列表
   * @return array
   */
  public function ajaxbloglist() {
    $title = I('title', '');
    $createdtime = I('createdtime', '');
    $blogtype = I('blogtype', '');
    $bloglabel = I('bloglabel', '');
    $where['status'] = '0';
    if (!empty($createdtime)) {
      $where['createdtime'] = array('like', '%'.$createdtime.'%');
    }
    if (!empty($title)) {
      $where['title'] = array('like', '%'.$title.'%');
    }
    if (!empty($blogtype)) {
      $where['type'] = $blogtype;
    }
    if (!empty($bloglabel)) {
      $where['label'] = $bloglabel;
    }
    $order = 'id desc';
    $page = I('p');
    $limit = '10';
    $data = D('Blog')->getBlogList($where, $page, $limit, $order);
    $page = ajaxCreatePage($data['total'], $limit, 'getbloglist', $page);
    foreach ($data['list'] as $key => $v) {
      $data['list'][$key]['type'] = D('Param')->selectParameter('blogtype', $data['list'][$key]['type']);
      $data['list'][$key]['label'] = D('Param')->selectParameter('bloglabel', $data['list'][$key]['label']);
    }
    $data['list'] = $data['list'];
    $data['page'] = $page;
    $this->ajaxReturn($data);
  }

  /**
   * 文章详情
   * @return array
   */
  public function detail() {
    $id = I('id');
    if ($id) {
      $data = D('Blog')->getBlogData($id);
      $url = "/Admin/Blog/edit/";
      $blogtype = D('Param')->selectParameter('blogtype', $data['type']);
      $bloglabel = D('Param')->selectParameter('bloglabel', $data['label']);
      $this->assign('blogtype', $blogtype);
      $this->assign('bloglabel', $bloglabel);
      $this->assign('list', $data);
      $this->assign('url', $url);
    } else {
      $url = "add";
      $this->assign('url', $url);
    }
    $typelist = D('Param')->getParameter('blogtype');
    $labellist = D('Param')->getParameter('bloglabel');
    $this->assign('typelist', $typelist);
    $this->assign('labellist', $labellist);
    $this->assign('mode_name', 'blog');
    $this->display();
  }

  /**
   * 获取文章图片
   * @return ajax
   */
  public function getpic() {
    $data = D('Blog')->getBlogData(I('id', ''));
    $bigview = $data['bigview'];
    $bigview = explode('|', $bigview);
    $bigview['picture'] = $bigview;
    $this->ajaxReturn($bigview);
  }

  /**
   * 删除文章图片
   * @return ajax
   */
  public function deletepic() {
    $id = I('id', '');
    $url = I('picname', '');
    $dirurl = 'Upload'.$url;  //服务器文件地址，用来删除服务器相应文件
    if ($url) {
        $result = D('Blog')->getBlogData(I('id', ''));
        if ($result['bigview']) {
            $picture = explode('|', $result['bigview']);
            foreach( $picture as $k=>$v) {
                if($url == $v) unset($picture[$k]);
            }
            $picture = array_values($picture);
            if (empty($picture)) {
              $data['bigview'] = '';
            } else {
              $picture = implode('|', $picture);
              $data['bigview'] = $picture;
            }
        } else {
          $this->ajaxReturn('数据库没有此图片，你是如何触发删除的呢？');
        }
        if(D('Blog')->editData("id=$id", $data)){
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
   * 文章添加
   * @return ajax
   */
  public function add() {
    if (IS_AJAX) {
      #处理图片
      if (!empty($_FILES['filedata']['tmp_name'])) {
        $time = date('Ymd');
        $upload = new \Think\Upload();                                            // 实例化上传类
        $upload->maxSize = 20*1024*1024;                                          // 设置附件上传大小
        $upload->exts = array('jpg','png','gif','jpeg','psd','rar','zip','doc','xls','ppt','pdf','html','php','txt','bmp','js','xlsx','docx');                     // 设置附件上传类型
        $upload->rootPath = './Upload/';                                          // 设置附件上传根目录
        $upload->savePath = 'blog/'.$time.'/';                                    // 设置附件上传（子）目录
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
          $data['bigview'] = $file_names;
        }
      }
      #处理表单数据
      $data['title'] = I('title');
      $data['status'] = 0;
      $data['littletitle'] = I('littletitle');
      $data['type'] = I('blogtype');
      $data['author'] = I('author');
      $data['label'] = I('bloglabel');
      $data['keywords'] = I('keywords');
      $data['shortsynopsis'] = $_POST['shortsynopsis'];
      $data['synopsis'] = $_POST['synopsis'];
      $data['createdtime'] = date("Y-m-d H:i:s",time());
      $data['modifiedtime'] = date("Y-m-d H:i:s",time());
      $result = D('Blog')->addData($data);
      if ($result!==false) {
        $this->ajaxReturn("添加成功");
      } else {
        $this->ajaxReturn("添加失败");
      }
    } else {
      $this->ajaxReturn('请不要伪造表单提交哦！');
    }

  }

  /**
   * 文章编辑
   * @return ajax
   */
  public function edit() {
    if (IS_AJAX) {
      #处理图片
      if (!empty($_FILES['filedata']['tmp_name'])) {
        $time = date('Ymd');
        $upload = new \Think\Upload();                                            // 实例化上传类
        $upload->maxSize = 20*1024*1024;                                          // 设置附件上传大小
        $upload->exts = array('jpg','png','gif','jpeg','psd','rar','zip','doc','xls','ppt','pdf','html','php','txt','bmp','js','xlsx','docx');                     // 设置附件上传类型
        $upload->rootPath = './Upload/';                                          // 设置附件上传根目录
        $upload->savePath = 'blog/'.$time.'/';                                    // 设置附件上传（子）目录
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
          $result = D('Blog')->getBlogData(I('id', ''));
          if (!empty($result['bigview'])) {
            $data['bigview'] = $result['bigview'].'|'.$file_names;
          } else {
            $data['bigview'] = $file_names;
          }
        }
      }
      #处理表单数据
      $map['id'] = I('id');
      $data['title'] = I('title');
      $data['littletitle'] = I('littletitle');
      $data['type'] = I('blogtype');
      $data['label'] = I('bloglabel');
      $data['author'] = I('author');
      $data['keywords'] = I('keywords');
      $data['shortsynopsis'] = $_POST['shortsynopsis'];
      $data['synopsis'] = $_POST['synopsis'];
      $data['modifiedtime']=date("Y-m-d H:i:s",time());
      $result = D('Blog')->editData($map, $data);
      if ($result!==false) {
        $this->ajaxReturn("修改成功");
      } else {
        $this->ajaxReturn("修改失败");
      }
    } else {
      $this->ajaxReturn('请不要伪造表单提交哦！');
    }

  }

  /**
   * 删除文章（伪删除）
   * @return ajax
   */
   public function deleteblog() {
       $id = I('id', '');
       $data['status'] = '1';
       $result = D('Blog')->editData("id=$id", $data, M('Blog'));
       if ($result !== false) {
         $this->ajaxReturn('success');
       } else {
         $this->ajaxReturn('fail');
       }
   }


}
