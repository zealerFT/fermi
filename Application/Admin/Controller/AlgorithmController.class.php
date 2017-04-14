<?php
/**
 * 算法管理
 * @author fermi php基本数据结构算法
 */
namespace Admin\Controller;
use Think\Controller;
class AlgorithmController extends BaseController {
  /**
   * 无限极分类 -- 迭代引用方法
   * $items = array(
   * 1 => array('id' => 1, 'pid' => 0, 'name' => '安徽省'),
   * 2 => array('id' => 2, 'pid' => 0, 'name' => '浙江省'),
   * 3 => array('id' => 3, 'pid' => 1, 'name' => '合肥市'),
   * 4 => array('id' => 4, 'pid' => 3, 'name' => '长丰县'),
   * 5 => array('id' => 5, 'pid' => 1, 'name' => '安庆市'),
   * );
   * @return [type] [description]
   */
  public function getTree_one($arr= array()) {
    $tree = array();
    foreach($arr as $key => $val) {
      if (isset($arr[$val['pid']])) {
        $arr[$val['pid']]['son'][] = $arr[$val['id']];
      } else {
        $tree[] = $arr[$val['id']];
      }
    }
  }
  public function getTree_second($arr) {
    foreach($arr as $val) {
      $arr[$val['pid']]['son'][$val['id']] = &$arr[$val['id']];
    }
    return isset($arr[0]['son']) ? $arr[0]['son'] : array();
  }

/**
 * 获取想要的数据样式
 * @param  string $tree [description]
 * @return [type]       [description]
 */
  public function getTreeData($tree = ''){
      $tree = generateTree($arr);
      foreach($tree as $value){
          echo $value['name'].'<br>';
          if(isset($value['son'])){
              getTreeData($value['son']);
          }
      }
  }

/**
 * 无限极分类 -- 递归方法
 * @param  Array $arr 目标数组
 * @param  int  $pid   父ID
 * @param  integer $level 层级
 * @return Array
 */
  public function getTree_third($arr, $pid = 0, $level = 0) {
    static $list = array();
    foreach ($arr as $key => $value) {
      if ($value['pid'] == $pid) {
        $value['level'] = $level;
        $list[] = $value;
        getTree_third($arr, $value['id'], $level+1);
      }
    }
    return $list;
  }

  /**
   * 二分查找（数组里查找某个元素）--递归
   * @param   $array  目标数组
   * @param   $low    查找的起始位置
   * @param   $high   查找的结束位置
   * @param   $k      要查找的目标值
   * @return
   */
  public function bin_sch($array,  $low, $high, $k){
      if ( $low <= $high){
          $mid =  intval(($low+$high)/2 );
          if ($array[$mid] == $k){
              return $mid;
          }elseif ( $k < $array[$mid]){
              return  bin_sch($array, $low,  $mid-1, $k);
          }else{
              return  bin_sch($array, $mid+ 1, $high, $k);
          }
      }
      return -1;
  }

/**
 * 二分查找（数组里查找某个元素）--非递归
 * @param  Array  $arr  目标数组
 * @param  [type] $target
 * @return [type]
 */
 function binarySearch(Array $arr, $target) {
     $low = 0;
     $high = count($arr) - 1;
     while($low <= $high) {
        $mid = floor(($low + $high) / 2);
        if($arr[$mid] == $target) return $mid;
        if($arr[$mid] > $target) $high = $mid - 1;
        if($arr[$mid] < $target) $low = $mid + 1;
      }
      return false;
  }

  /**
   * 冒泡排序（数组排序）
   * @param  Array $array 目标数组
   * @return [type]
   */
  function bubble_sort($array)
  {
      $count = count($array);
      if ($count <= 0 ) return false;
      for($i=0 ; $i < $count; $i ++){
          for($j=$count-1 ; $j > $i; $j--){
              if ($array[$j] < $array[$j-1]){
                  $tmp = $array[$j];
                  $array[$j] = $array[$j-1];
                  $array[$j-1] = $tmp;
              }
          }
      }
      return $array;
  }

  /**
   * 快速排序（数组排序）
   * @param  Array $array 目标数组
   * @return [type]
   */
  function quick_sort($array) {
      if (count($array) <= 1) return $array;
      $key = $array[0];
      $left_arr  = array();
      $right_arr = array();
      for ($i= 1; $i < count($array); $i++){
          if ($array[$i] <= $key){
            $left_arr[] = $array[$i];
          } else {
            $right_arr[] = $array[$i];
          }
      }
      $left_arr = quick_sort($left_arr);
      $right_arr = quick_sort($right_arr);
      return array_merge($left_arr , array($key), $right_arr);
  }

}
