<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<title>费腾fermi博客--你的名字</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="/Public/Bootstrap/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<!-- <link href='/Public/Home/css/font.css' rel='stylesheet' type='text/css'> -->
<link href="/Public/Home/css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="/Public/ueditor/third-party/SyntaxHighlighter/shCoreDefault.css">
<!-- <link rel="stylesheet" href="/Public/font-awesome-3.2.1/css/font-awesome.min.css"> -->
<link href="/Public/Home/css/pintuer.css" rel='stylesheet' type='text/css' />
<link href="/Public/google/Css/googlemap.css" rel='stylesheet' type='text/css' />
<link href="/Public/flipTimer/css/flipTimer.css" rel='stylesheet' type='text/css' />
<script src="/Public/jquery/jquery-2.0.3.min.js"></script>
<script src="/Public/Home/Js/jquery-form.js"></script>
<!-- <script src="/Public/Bootstrap/Js/bootstrap.min.js"></script> -->
<!-- <script src="/Public/Home/Js/Backend.js"></script> -->
<script src="/Public/Home/Js/highcharts.js"></script>
<script src="/Public/Home/Js/echarts.js"></script>
<script src="/Public/ueditor/third-party/SyntaxHighlighter/shCore.js"></script>
<!-- layui-UI -->
<link href="/Public/layui/css/layui.css" rel="stylesheet">
<script src="/Public/layui/layui.js"></script>
<!-- animation-effect -->
<link href="/Public/Home/css/animate.min.css" rel="stylesheet">
<script src="/Public/Home/Js/wow.min.js"></script>
<script src="/Public/masonry/masonry.pkgd.min.js"></script>
<!-- pintuer.js -->
<script src="/Public/Home/Js/pintuer.js"></script>
<!-- flipTimer -->
<script src="/Public/flipTimer/js/jquery.flipTimer.js"></script>
<script>
 new WOW().init();

 $(function(){
    $('.dowebok').flipTimer();
});
</script>
<!-- //animation-effect -->
</head>
<body>
  <div class="header" id="ban">
  		<div class="container">
  			<!-- <div class="head-left wow fadeInLeft animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInLeft;">
  				<div class="header-search">
  						<div class="search">
  							<input class="search_box" type="checkbox" id="search_box">
  							<label class="icon-search" for="search_box"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></label>
  							<div class="search_form">
  								<form action="#" method="post">
  									<input type="text" name="Search" placeholder="Search...">
  									<input type="submit" value="Send">
  								</form>
  							</div>
  						</div>
  				</div>
  			</div> -->
  			<div class="header_right wow fadeInLeft animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInLeft;">
  			<nav class="navbar navbar-default">
  				<!-- Brand and toggle get grouped for better mobile display -->
  				<div class="navbar-header">
  					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
  						<span class="sr-only">Toggle navigation</span>
  						<span class="icon-bar"></span>
  						<span class="icon-bar"></span>
  						<span class="icon-bar"></span>
  					</button>
  				</div>

  				<!-- Collect the nav links, forms, and other content for toggling -->
  				<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
  					<nav class="link-effect-7" id="link-effect-7">
  						<ul class="nav navbar-nav">
  							<li class="active act shake-hover"><a href="<?php echo U('Index/index');?>">主页</a></li>
                <li class="shake-hover"><a  target="_blank" href="#">图瀑</a></li>
                <li class="shake-hover"><a  target="_blank" href="<?php echo U('Article/articleList');?>">文章列表</a></li>
  							<li class="shake-hover"><a  target="_blank" href="#">PHP</a></li>
  							<li class="shake-hover"><a  target="_blank" href="#">PYTHON</a></li>
  							<li class="shake-hover"><a  target="_blank" href="http://music.163.com/#/user/home?id=100410456">网易云</a></li>
  							<li class="shake-hover"><a  target="_blank" href="http://weibo.com/594feiteng">微博</a></li>
  							<li class="shake-hover"><a  target="_blank" href="http://github.com/zealerFT">github</a></li>
  						</ul>
  					</nav>
  				</div>
  				<!-- /.navbar-collapse -->
  			</nav>
  			</div>
  			<div class="nav navbar-nav navbar-right social-icons wow fadeInRight animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInRight;">
  					<ul>
              <li><a href="<?php echo U('Login/snslogin', array('type' => 'qq'));?>" class="qq"><img src="/Public/Home/images/qq.png" alt="" /></a></li>
              <li><a href="<?php echo U('Login/snslogin', array('type' => 'weixin'));?>" class="weixin"><img src="/Public/Home/images/weixin.png" alt="" /> </a></li>
              <li><a href="<?php echo U('Login/snslogin', array('type' => 'weibo'));?>" class="weibo"><img src="/Public/Home/images/weibo.png" alt="" /> </a></li>
  					</ul>
  			</div>
  			<div class="clearfix"> </div>
  		</div>
  	</div>

<style media="screen">
	.layui-laypage .my_layui {
		color: #999;
		font-weight: 700;
    background-color: rgb(72, 207, 174);
		color: #ffffff;
	}
	.text-center {
    text-align: center!important;
   }
</style>
<!-- banner -->
<div class="banner-1">
	<div class="container">
	</div>
</div>
<body class="blog-body">
<div class="layui-main blog-container">
<div class="blog-nav">
    <nav>
			<div class="wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".5s">
        <blockquote class="layui-elem-quote" style="margin-bottom:0;">分类</blockquote>
        <ul>
					<li>
							<a href="javascript:void(0);" onclick="getListByType('all', 'all', '1');">全部</a>
							<aside></aside>
					</li>
						<?php if(is_array($list1)): foreach($list1 as $key=>$list1): ?><li>
	                <a href="javascript:void(0);" onclick="getListByType('label', <?php echo ($list1['label']); ?>, '1');"><?php echo ($list1['label_cn']); ?></a>
	                <aside>(<?php echo ($list1['size']); ?>)</aside>
	            </li><?php endforeach; endif; ?>
        </ul>
			</div>
    </nav>
    <nav>
			<div class="wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".5s">
        <blockquote class="layui-elem-quote" style="margin-bottom:0;">归档</blockquote>
        <ul>
					<?php if(is_array($list2)): foreach($list2 as $key=>$list2): ?><li>
								<a href="javascript:void(0);" onclick="getListByType('createdtime', '<?php echo ($list2['createdtime']); ?>', '1');" ><?php echo ($list2['time']); ?></a><span style="margin-left:10px;">(<?php echo ($list2['size']); ?>)</span>
						</li><?php endforeach; endif; ?>
        </ul>
			</div>
    </nav>
    <nav>
			<div class="wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".5s">
        <blockquote class="layui-elem-quote" style="margin-bottom:0;">阅读排行</blockquote>
        <ul>
						<?php if(is_array($list3)): foreach($list3 as $key=>$list3): ?><li>
	                <a title="<?php echo ($list3['title']); ?>" href="/Home/Article/index/id/<?php echo ($list3['id']); ?>"><?php echo ($list3['title']); ?></a>
	            </li><?php endforeach; endif; ?>
        </ul>
			</div>
    </nav>
</div>
<div class="wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".5s">
		<div class="blog-main">
		    <ul id="list">
		    </ul>
				<div class="text-center">
						<div class="layui-box layui-laypage layui-laypage-default kkpager">
							
						</div>
				</div>
		</div>
</div>
<div class="clearfix"></div>
</div>
<div class="footer" style="background-color:#B8B8B8;height:180px;">
		<div class="container" style="background-color:">

			<div class="col-md-3 footer-left wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".2s">
				<h4>联系博主</h4>
				<p>如果您有什么想问的，想要了解的，可通过下面的邮箱联系博主。<a href=mailto:spuerfei@gmail.com>spuerfei@gmail.com</a></p>
			</div>
			<div class="col-md-3 footer-middle wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".2s">
			<h4>关于博客</h4>
			<div class="mid-btm">
				<p>整套博客系统较为简单，实现一些基本的功能，有需要的可以联系博主哦！QQ:1250835706</p>
			</div>
			</div>
			<div class="col-md-6 footer-right wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".2s">
				<div class="dowebok" >
						<div class="hours"></div>
						<div class="minutes"></div>
						<div class="seconds"></div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="copyright wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".2s" style="background-color:#2B2B2B">
				<div class="container">
					<p>Copyright © 2017　你的名字　All Rights Reserved　皖ICP备16024806号-1</p>
				</div>
			</div>
</body>
</html>

<script src="/Public/Home/Js/Article/list.js"></script>
    <script>

        layui.use(['util', 'jquery', 'laypage', 'layer'], function () {
            var util = layui.util, $ = layui.jquery, laypage = layui.laypage, layer = layui.layer;
            util.fixbar();
            $('.blog-header-menu-icon').on('click', function () {
                var $nav = $('.blog-header-menu-nav');
                $nav.toggle();
            });
						laypage({
							cont: 'demo7'
							,pages: 5
							,skip: true
						});
        });

    </script>
    <script>

			// layui.config({
			// 		base: '/Public/layui/custom/' //自定义模块的目录
			// });
			//
			// layui.use(['highlight', 'jquery', 'flow'], function () {
			// 		var highlight = layui.highlight
			// 		, $ = layui.jquery
			// 		, flow = layui.flow;
			//
			// 		var keywork = ''
			// 		if (keywork !== '')
			// 				highlight.handler(keywork);
			//
			// 		var $item = $('.blog-header .layui-nav > .layui-nav-item');
			// 		$item.removeClass('layui-this');
			//
			// 		$item.each(function (i) {
			// 				if (i == 0 || i == 2)
			// 						$(this).addClass('layui-this');
			// 		});
			//
			// 		if(2 > 1){
			// 				flow.load({
			// 						elem: '#list' //指定列表容器
			// 						, isAuto: false
			// 						, done: function (page, next) { //到达临界点（默认滚动触发），触发下一页
			// 								var lis = [];
			// 								var p = location.search!==''?location.search:location.pathname;
			// 								//以Ajax请求为例，请求下一页数据（注意：page是从2开始返回）
			// 								$.getJSON('/Home/AJaxLoadList?page=' + page+'&p='+p, function (res) {
			// 										//假设你的列表返回在data集合中
			// 										layui.each(res.data, function (index, item) {
			// 												lis.push('<li> <h2> <a title="' + item.Title + '" href="' + location.origin + '/detail-' + item.Id + '">' +
			// 														item.Title + '</a></h2><span class="blog-main-item-time">' + item.CreateTime + '</span></li>');
			// 										});
			// 										//执行下一页渲染，如果不存在数据，则告诉flow已经没有更多
			// 										next(lis.join(''), res.page === page ? 0 : page);
			// 								});
			// 						}
			// 				});
			// 		}
			// });
    </script>