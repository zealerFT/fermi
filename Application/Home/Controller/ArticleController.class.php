<?php
/**
 * 文章详情
 * @author fermi
 *
 */
namespace Home\Controller;
use Think\Controller;
class ArticleController extends Controller {

    /**
     * 文章详情
     * @return html
     */
      public function index() {
        $id = I('id', '');
        $this->theArticle($id);
        $this->getLatelyArticle();
        $this->getFavouritesArticle();
        $this->display();
      }

    /**
     * 文章列表
     * @return html
     */
      public function articleList() {
        $id = I('id', '');
        $this->getArticleByClassify();
        $this->getArticleByTime();
        $this->getArticleByViews();
        $this->getFavouritesArticle();
        $this->display('list');
      }

      /**
       * 根据类型获取文章列表
       * @return ajax
       */
      public function getArticleByType() {
        if (IS_AJAX) {
          $type = I('type', '');
          $value = I('value', '');
          if ($type == 'all') {
            $where['status'] = 0;
          }
          if ($type == 'label') {
            $where['label'] = $value;
            $where['status'] = 0;
          }
          if ($type == 'createdtime') {
            $where['createdtime'] = array('like', '%'.$value.'%');
            $where['status'] = 0;
          }
          $order = 'createdtime desc';
          $page = I('p');
          $limit = '20';
          $params['type'] = '"'.$type.'"';
          $params['value'] = '"'.$value.'"';
          $params['page'] = $page;
          $class = 'my_layui';
          $data = D('Blog')->getBlogList($where, $page, $limit, $order);
          $page = ajaxCreatePage($data['total'], $limit, 'getListByType', $page, $params, $class);
          $page .= '<span class="layui-laypage-total">到第 <input type="number" min="1" onkeyup="this.value=this.value.replace(/\D/);" value="1" class="layui-laypage-skip"> 页 <button type="button" class="layui-laypage-btn">确定</button></span>';
          $data['page'] = $page;
          $this->ajaxReturn($data);
        } else {
          $data['list'] = 'faker';
          $this->ajaxReturn($data);
        }

      }


     /**
      * 文章主题内容
      * @param  [type] $id
      * @return html
      */
      private function theArticle($id) {
        $data = D('Blog')->getBlogData($id);
        $comment = D('Comment')->getCommentCount($id);
        $blogtype = D('Param')->selectParameter('blogtype', $data['type']);
        $bloglabel = D('Param')->selectParameter('bloglabel', $data['label']);
        $keywords = explode('|', $data['keywords']);
        $add['views'] = (int)$data['views'] + 1;
        M('Blog')->where('id=%d', $id)->save($add);
        $this->assign('blogtype', $blogtype);
        $this->assign('bloglabel', $bloglabel);
        $this->assign('keywords', $keywords);
        $this->assign('comment', $comment);
        $this->assign('list', $data);
      }

      /**
       * 最近发表文章
       * @return assign
       */
      private function getLatelyArticle() {
        $where['status'] = '0';
        $order = 'createdtime desc';
        $page = '1';
        $limit = '10';
        $data = D('Blog')->getBlogList($where, $page, $limit, $order);
        foreach($data['list'] as $key => $val) {
            $times = time() - strtotime($data['list'][$key]['createdtime']);
            $times = ceil($times/(60*60));
            if ($times < 24) {
              $times = $times."小时前";
            } else {
              $times = ceil($times/24).'天前';
            }
            $data['list'][$key]['times'] = $times;
            $data['list'][$key]['bigview'] = explode('|', $data['list'][$key]['bigview']);
        }
        $result = array_slice($data['list'], 0, 5);
        $this->assign('list4', $result);
      }

      /**
       * 点赞文章排行
       * @return assign
       */
       private function getFavouritesArticle() {
         $where['status'] = '0';
         $order = 'favourites desc';
         $page = '1';
         $limit = '10';
         $data = D('Blog')->getBlogList($where, $page, $limit, $order);
         foreach($data['list'] as $key => $val) {
             $times = time() - strtotime($data['list'][$key]['createdtime']);
             $times = ceil($times/(60*60));
             if ($times < 24) {
               $times = $times."小时前";
             } else {
               $times = ceil($times/24).'天前';
             }
             $data['list'][$key]['times'] = $times;
             $data['list'][$key]['bigview'] = explode('|', $data['list'][$key]['bigview']);
         }
         $result = array_slice($data['list'], 0, 5);
         $this->assign('list5', $result);
       }

      /**
       * 获取文章分类
       * @return array
       */
      private function getArticleByClassify() {
        $data = D('Blog')->getBlogByCount('label');
        foreach ($data as $key => $v) {
          $data[$key]['label_cn'] = D('Param')->selectParameter('bloglabel', $data[$key]['label']);
        }
        //mydebug($data);
        $this->assign('list1', $data);

      }

      /**
       * 获取文章归档
       * @return array
       */
      private function getArticleByTime() {
        $data = D('Blog')->getBlogByCount('createdtime', 'createdtime');
        foreach ($data as $key => $v) {
          $data[$key]['createdtime'] = date('Y-m', strtotime($data[$key]['createdtime']));
          $data[$key]['time'] = getCnTime($data[$key]['createdtime']);
        }
        //mydebug($data);
        $this->assign('list2', $data);

      }

      /**
       * 获取文章阅读排行
       * @return array
       */
      private function getArticleByViews() {
        $where['status'] = 0;
        $order = 'views desc';
        $page = I('p');
        $limit = '5';
        $data = D('Blog')->getBlogList($where, $page, $limit, $order);
        $this->assign('list3', $data['list']);
      }

      /**
       * 处理点赞功能
       * @return array
       */
      public function changefavourites() {
        $type = I('type', '');
        $id = I('id', '');
        if ( $type == 1 ) {
          $data = D('Blog')->getBlogData($id);
          $add['favourites'] = (int)$data['favourites'] + 1;
        } else {
          $data = D('Blog')->getBlogData($id);
          $add['favourites'] = (int)$data['favourites'] - 1;
          if ( $add['favourites'] < 0 ) {
            $add['favourites'] = 0;
          }
        }
        M('Blog')->where('id=%d', $id)->save($add);
        $this->ajaxReturn($add['favourites']);
      }


}
