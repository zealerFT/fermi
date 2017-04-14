<?php
namespace Admin\Controller;
class IndexController extends BaseController {

    public function index(){
      //$this->countuser();
      //$this->countorder();
      $this->display();
    }

    public function welcome(){
      $this->display();
    }

    /**
     * 用户统计
     * @return assign
     */
    private function countuser() {
      #昨日新增用户
      $yesterday = date("Y-m-d",strtotime("-1 day"));
      $where['createdtime'] = array('like', '%'.$yesterday.'%');
      $yesterday_user = M("User")->where($where)->count('id');
      #7天内新增用户
      $one_date = strtotime(date("Y-m-d"));                                     //关键时间戳，当天凌晨
      $seven_date = date("Y-m-d",strtotime("-7 day"));
      $seven_date = strtotime($seven_date);
      $filter['_string'] = 'regtime <= '.$one_date.' and regtime >='.$seven_date;
      $sevenday_user = M("User")->where($filter)->count('id');
      #30天内新增用户
      $last_month = date("Y-m-d",strtotime("last month"));
      $last_month = strtotime($last_month);
      $filter['_string'] = 'regtime <= '.$one_date.' and regtime >='.$last_month;
      $last_month_user = M("User")->where($filter)->count('id');
      #本月新增用户
      $this_month = explode('-', date('Y-m-d'));
      $this_month['2'] = '1';
      $this_month = implode('-', $this_month);
      $this_month = strtotime($this_month);
      $filter['_string'] = 'regtime <= '.$one_date.' and regtime >='.$this_month;
      $this_month_user = M("User")->where($filter)->count('id');
      #去年新增用户
      $last_year = explode('-', date('Y-m-d'));
      $last_year['0'] = $last_year['0'] - 1;
      $last_year['1'] = '1';
      $last_year['2'] = '1';
      $last_year = implode('-', $last_year);
      $last_year = strtotime($last_year);

      $this_year = explode('-', date('Y-m-d'));
      $this_year['1'] = '1';
      $this_year['2'] = '1';
      $this_year = implode('-', $this_year);
      $this_year = strtotime($this_year);
      $filter['_string'] = 'regtime <= '.$this_year.' and regtime >='.$last_year;
      $last_year_user = M("User")->where($filter)->count('id');
      #今年年新增用户
      $filter['_string'] = 'regtime <= '.$one_date.' and regtime >='.$this_year;
      $this_year_user = M("User")->where($filter)->count('id');

      $this->assign('yesterday_user', $yesterday_user);
      $this->assign('sevenday_user', $sevenday_user);
      $this->assign('last_month_user', $last_month_user);
      $this->assign('this_month_user', $this_month_user);
      $this->assign('last_year_user', $last_year_user);
      $this->assign('this_year_user', $this_year_user);
    }

   /**
    * 订单统计
    * @return assign
    */
    private function countorder() {
      #由于订单没有生成订单的时间戳，在不修改数据库的情况下，选择订单ID为判断条件
      #昨日订单
      $yesterday = date("Y-m-d",strtotime("-1 day"));
      $where['createtime'] = array('like', '%'.$yesterday.'%');
      $yesterday_order = M("Order")->where($where)->count('id');
      $where['status'] = '1';
      $where['state'] = '0';
      $yesterday_one_order = M("Order")->where($where)->count('id');//预约成功
      //mydebug(M("Order")->getLastSql());
      $where['status'] = '2';
      $yesterday_two_order = M("Order")->where($where)->count('id');//签协议成功
      $where['status'] = '3';
      $yesterday_three_order = M("Order")->where($where)->count('id');//上传打款凭证成功
      unset ($where['status']);
      $where['state'] = '1';
      $yesterday_fail_order = M("Order")->where($where)->count('id');//失效订单

      #7天内新增订单
      $one_date = date("Ymd") * 100000;                                           //关键订单号，当天凌晨
      $seven_date = date("Ymd",strtotime("-7 day"));
      $seven_date = $seven_date * 100000;
      $filter['_string'] = 'order_number <= '.$one_date.' and order_number >='.$seven_date;
      $sevenday_order = M("Order")->where($filter)->count('id');
      $filter['_string'] = 'status = 1 and state = 0 and order_number <= '.$one_date.' and order_number >='.$seven_date;
      $sevenday_one_order = M("Order")->where($filter)->count('id');
      $filter['_string'] = 'status = 2 and state = 0 and order_number <= '.$one_date.' and order_number >='.$seven_date;
      $sevenday_two_order = M("Order")->where($filter)->count('id');
      $filter['_string'] = 'status = 3 and state = 0 and order_number <= '.$one_date.' and order_number >='.$seven_date;
      $sevenday_three_order = M("Order")->where($filter)->count('id');
      $filter['_string'] = 'state = 1 and order_number <= '.$one_date.' and order_number >='.$seven_date;
      $sevenday_fail_order = M("Order")->where($filter)->count('id');

      #30天内新增订单
      $last_month = date("Ymd",strtotime("last month"));
      $last_month = $last_month * 100000;
      $filter['_string'] = 'order_number <= '.$one_date.' and order_number >='.$last_month;
      $lastmonth_order = M("Order")->where($filter)->count('id');
      $filter['_string'] = 'status = 1 and state = 0 and order_number <= '.$one_date.' and order_number >='.$last_month;
      $lastmonth_one_order = M("Order")->where($filter)->count('id');
      $filter['_string'] = 'status = 2 and state = 0 and order_number <= '.$one_date.' and order_number >='.$last_month;
      $lastmonth_two_order = M("Order")->where($filter)->count('id');
      $filter['_string'] = 'status = 3 and state = 0 and order_number <= '.$one_date.' and order_number >='.$last_month;
      $lastmonth_three_order = M("Order")->where($filter)->count('id');
      $filter['_string'] = 'state = 1 and order_number <= '.$one_date.' and order_number >='.$last_month;
      $lastmonth_fail_order = M("Order")->where($filter)->count('id');

      #本月新增订单
      $this_month = explode('-', date('Y-m-d'));
      $this_month['2'] = '01';
      $this_month = implode('', $this_month) * 100000;
      $filter['_string'] = 'order_number <= '.$one_date.' and order_number >='.$this_month;
      $thismonth_order = M("Order")->where($filter)->count('id');
      $filter['_string'] = 'status = 1 and state = 0 and order_number <= '.$one_date.' and order_number >='.$this_month;
      $thismonth_one_order = M("Order")->where($filter)->count('id');
      $filter['_string'] = 'status = 2 and state = 0 and order_number <= '.$one_date.' and order_number >='.$this_month;
      $thismonth_two_order = M("Order")->where($filter)->count('id');
      $filter['_string'] = 'status = 3 and state = 0 and order_number <= '.$one_date.' and order_number >='.$this_month;
      $thismonth_three_order = M("Order")->where($filter)->count('id');
      $filter['_string'] = 'state = 1 and order_number <= '.$one_date.' and order_number >='.$this_month;
      $thismonth_fail_order = M("Order")->where($filter)->count('id');

      $yes_order = array('0' => $yesterday_one_order, '1' => $yesterday_two_order, '2' => $yesterday_three_order, '3' => $yesterday_fail_order, '4' => $yesterday_order);
      $seven_order = array('0' => $sevenday_one_order, '1' => $sevenday_two_order, '2' => $sevenday_three_order, '3' => $sevenday_fail_order, '4' => $sevenday_order);
      $lastmonth_order = array('0' => $lastmonth_one_order, '1' => $lastmonth_two_order, '2' => $lastmonth_three_order, '3' => $lastmonth_fail_order, '4' => $lastmonth_order);
      $thismonth_order = array('0' => $thismonth_one_order, '1' => $thismonth_two_order, '2' => $thismonth_three_order, '3' => $thismonth_fail_order, '4' => $thismonth_order);
//mydebug($seven_order);
      $this->assign('yes_order', $yes_order);
      $this->assign('seven_order', $seven_order);
      $this->assign('lastmonth', $lastmonth_order);
      $this->assign('thismonth', $thismonth_order);
    }

    public function count_time_user() {
      $date1 = I('date1', '');
      $date1 = strtotime($date1);
      $date2 = I('date2', '');
      $date2 = strtotime($date2);
      $filter['_string'] = 'regtime <= '.$date2.' and regtime >='.$date1;
      $count_user = M("User")->where($filter)->count('id');
      $this->ajaxReturn($count_user);
    }

}
