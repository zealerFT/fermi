<?php
/**
 * 前台首页
 * @author fermi
 *
 */
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    /**
     * 首页
     * @return html
     */
    public function index(){
      $page = I('p', '');
      $this->getRecommendArticle();
      $this->getHotArticle();
      $this->getOrdinaryArticle($page);
      $this->getLatelyArticle();
      $this->getFavouritesArticle();
      $this->display();
    }

    /**
     * 推荐文章
     * @return assign
     */
    private function getRecommendArticle() {
      $where['type'] = '1';
      $where['status'] = '0';
      $order = 'modifiedtime desc';  //最新修改为推荐的文章置顶
      $page = '1';
      $limit = '10';
      $data = D('Blog')->getBlogList($where, $page, $limit, $order);
      foreach($data['list'] as $key => $val) {
        $data['list'][$key]['bigview'] = explode('|', $data['list'][$key]['bigview']);
      }
      $this->assign('list1', $data['list'][0]);
    }

    /**
     * 热门文章
     * @return assign
     */
    private function getHotArticle() {
      $where['type'] = '2';
      $where['status'] = '0';
      $order = 'modifiedtime desc';
      $page = '1';
      $limit = '10';
      $data = D('Blog')->getBlogList($where, $page, $limit, $order);
      foreach($data['list'] as $key => $val) {
        $data['list'][$key]['bigview'] = explode('|', $data['list'][$key]['bigview']);
      }
      $data['list'] = array_slice($data['list'], 0, 2);
      $this->assign('list2', $data['list']);
    }

    /**
     * 普通文章
     * @return assign
     */
    private function getOrdinaryArticle($pagenow = '') {
      if (empty($pagenow)) {
        $page = '1';
      } else {
        $page = $pagenow;
      }
      $where['type'] = '3';
      $where['status'] = '0';
      $order = 'createdtime desc';
      $limit = '3';
      $data = D('Blog')->getBlogList($where, $page, $limit, $order);
      foreach($data['list'] as $key => $val) {
        $data['list'][$key]['bigview'] = explode('|', $data['list'][$key]['bigview']);
      }
      $page = createPage($data['total'], 3);
      $this->assign('list3', $data['list']);
      $this->assign('page', $page);
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



}
