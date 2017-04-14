<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
// | Author: fermi费腾 加入了多页跳转功能和修复bug！<ft910310@qq.com> <http://weibo.com/594feiteng>
// +----------------------------------------------------------------------
namespace Think;

class Page{
    public $firstRow; // 起始行数
    public $listRows; // 列表每页显示行数
    public $parameter; // 分页跳转时要带的参数
    public $totalRows; // 总行数
    public $totalPages; // 分页总页面数
    public $class; // 分页点击样式
    public $rollPage   = 5;// 分页栏每页显示的页数
    public $lastSuffix = true; // 最后一页是否显示总页数

    private $p       = 'p'; //分页参数名
    private $url     = ''; //当前链接URL
    private $nowPage = 1;

    // 分页显示定制
    private $config  = array(
        'header' => '<span class="rows">共 %TOTAL_ROW% 条记录</span>',
        'prev'   => '<<',
        'next'   => '>>',
        'first'  => '1...',
        'last'   => '...%TOTAL_PAGE%',
        'theme'  => '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%',
        'theme'  => '%UP_PAGE% %DOWN_PAGE% %FIRST% %PRE_PAGE% %LINK_PAGE% %NEXT_PAGE% %END%'
    );

    /**
     * 架构函数
     * @param array $totalRows  总的记录数
     * @param array $listRows  每页显示记录数
     * @param array $parameter  分页跳转的参数
     */
    public function __construct($totalRows, $listRows=20, $class = '', $parameter = array()) {
        C('VAR_PAGE') && $this->p = C('VAR_PAGE'); //设置分页参数名称
        /* 基础设置 */
        $this->totalRows  = $totalRows; //设置总记录数
        $this->listRows   = $listRows;  //设置每页显示行数
        $this->class   = $class;  //设置每页显示行数
        $this->parameter  = empty($parameter) ? $_GET : $parameter;
        $this->nowPage    = empty($_GET[$this->p]) ? 1 : intval($_GET[$this->p]);
        $this->nowPage    = $this->nowPage>0 ? $this->nowPage : 1;
        $this->firstRow   = $this->listRows * ($this->nowPage - 1);
    }

    /**
     * 定制分页链接设置
     * @param string $name  设置名称
     * @param string $value 设置值
     */
    public function setConfig($name,$value) {
        if(isset($this->config[$name])) {
            $this->config[$name] = $value;
        }
    }

    /**
     * 生成链接URL
     * @param  integer $page 页码
     * @return string
     */
    private function url($page){
        return str_replace(urlencode('[PAGE]'), $page, $this->url);
    }

    /**
     * 组装分页链接
     * @return string
     */
    public function show() {
        if(0 == $this->totalRows) return '';

        /* 生成URL */
        $this->parameter[$this->p] = '[PAGE]';
        $this->url = U(ACTION_NAME, $this->parameter);
        /* 计算分页信息 */
        $this->totalPages = ceil($this->totalRows / $this->listRows); //总页数
        if(!empty($this->totalPages) && $this->nowPage > $this->totalPages) {
            $this->nowPage = $this->totalPages;
        }
        $nowCoolPage = ceil($this->nowPage / $this->rollPage);//用来判断上五页跳转和首页文字显示
        $this->coolPages  = ceil($this->totalPages / $this->rollPage);//用来判断下五页跳转和尾页文字显示

        /* 计算分页零时变量 */
        $now_cool_page      = $this->rollPage/2;
        $now_cool_page_ceil = ceil($now_cool_page);
        $this->lastSuffix && $this->config['last'] = $this->totalPages;

        //上一页
        $up_row  = $this->nowPage - 1;
        $up_page = $up_row > 0 ? '<a class="prev1" href="' . $this->url($up_row) . '">' . $this->config['prev'] . '</a>' : '';

        //下一页
        $down_row  = $this->nowPage + 1;
        $down_page = ($down_row <= $this->totalPages) ? '<a class="next1" href="' . $this->url($down_row) . '">' . $this->config['next'] . '</a>' : '';
        //首页尾页和多页跳转功能
        if($nowCoolPage == 1){
            $the_first = "";
            $pre_Page = "";
        }else{
            $preRow =  $this->nowPage - $this->rollPage;
            $pre_Page = "<a href='". $this->url($preRow) ."'>上".$this->rollPage."页</a>";
            $the_first = '<a class="first" href="' . $this->url(1) . '">' . $this->config['first'] . '</a>';
        }
        if($nowCoolPage == $this->coolPages){
            $next_Page = "";
            $the_end = "";
        }else{
            $nextRow = $this->nowPage + $this->rollPage;
            //控制跳rollPage页不超过总页数
            if ($nextRow > $this->totalPages) {
              $nextRow = $this->totalPages;
            }
            $next_Page = "<a href='". $this->url($nextRow) ."'>下".$this->rollPage."页</a>";
            $the_end = '<a class="end" href="' . $this->url($this->totalPages) . '">' . $this->config['last'] . '</a>';
        }

        //数字连接
        $link_page = "";
        for($i = 1; $i <= $this->rollPage; $i++){
			  if(($this->nowPage - $now_cool_page) <= 0 ){
                $page = $i;
            }elseif(($this->nowPage + $now_cool_page - 1) >= $this->totalPages){
                $page = $this->totalPages - $this->rollPage + $i;
            }else{
                $page = $this->nowPage - $now_cool_page_ceil + $i;
            }
            if($page > 0 && $page != $this->nowPage){

                if($page <= $this->totalPages){
                    $link_page .= '&nbsp;<a class="num" href="' . $this->url($page) . '">' . $page . '</a>&nbsp;';
                }else{
                    break;
                }
            }else{
                if($page > 0 && $this->totalPages != 1){
                    $link_page .= '&nbsp;<span class="my_layui">' . $page . '</span>&nbsp';
                }else{
                    //$link_page .= '&nbsp;&nbsp;<span class="current">' . $page . '</span>&nbsp;&nbsp;';
                }
            }

        }

        //替换分页内容
        /*$page_str = str_replace(
            array('%HEADER%', '%NOW_PAGE%', '%UP_PAGE%', '%DOWN_PAGE%', '%FIRST%', '%LINK_PAGE%', '%END%', '%TOTAL_ROW%', '%TOTAL_PAGE%'),
            array($this->config['header'], $this->nowPage, $up_page, $down_page, $the_first, $link_page, $the_end, $this->totalRows, $this->totalPages),
            $this->config['theme']
          );*/
        $page_str = str_replace(
            array('%UP_PAGE%', '%DOWN_PAGE%', '%FIRST%', '%PRE_PAGE%', '%LINK_PAGE%', '%NEXT_PAGE%', '%END%'),
            array($up_page, $down_page, $the_first, $pre_Page, $link_page, $next_Page, $the_end),
            $this->config['theme']
          );
        //return "<div class=\"page clearfix\">{$page_str}</div>";
        return $page_str;
    }
}
