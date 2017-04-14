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

	<!--start-main-->
	<div class="header-bottom">
		<div class="container">
			<div class="logo wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".2s">
				<h1><a href="index.html">Fermi BLOG</a></h1>
				<p class="wobble-hover"><label class="of"></label>欢迎来到费腾的博客<label class="on"></label></p>
			</div>
		</div>
	</div>
<!-- banner -->

<div class="banner">
  <div class="container">
		<h2>费腾博客</h2>
		<p>欢迎来到我的博客，有什么意见和建议，请不要发给我，发给我我也不会看，谢谢！</p>
		<div class="ring-hover">
			<a target="_blank" href="<?php echo U('Article/index', array('id' => $list1['id']));?>">READ MORE</a>
		</div>
	</div>
</div>
	<!-- technology-left -->
	<div class="technology">
	<div class="container">
		<div class="col-md-9 technology-left">
		<div class="tech-no">
			<!-- technology-top -->

			 <div class="tc-ch wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".2s">

					<div class="tch-img swing-hover">
						<a href="<?php echo U('Article/index', array('id' => $list1['id']));?>"><img src="/Upload<?php echo ($list1['bigview'][0]); ?>" class="img-responsive" alt=""></a>
					</div>

					<h3 ><a href="<?php echo U('Article/index', array('id' => $list1['id']));?>"><?php echo ($list1['title']); ?></a>
					</h3>
					<h6>BY <a href="<?php echo U('Article/index', array('id' => $list1['id']));?>"><?php echo ($list1['author']); ?>  </a><?php echo ($list1['createdtime']); ?></h6>
						<p><?php echo ($list1['shortsynopsis']); ?></p>
						<div class="bht1 ring-hover">
							<a href="<?php echo U('Article/index', array('id' => $list1['id']));?>">点击查看</a>
						</div>
						<div class="soci">
							<ul>
								<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
                <script>
								window._bd_share_config=
								{
								"common":{
								"bdSnsKey":false,
								"bdText":false,
								"bdMini":"2",
								"bdMiniList":false,
								"bdPic":false,
								"bdStyle":"1",
								"bdSize":"16"},
								"share":{},
								//"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},
								//"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}
							  };
								with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
								</script>
							</ul>
						</div>
						<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
			<!-- technology-top -->
			<!-- technology-top -->
			<div class="w3ls">
				<?php if(is_array($list2)): foreach($list2 as $key=>$list2): ?><div class="col-md-6 w3ls-left wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".2s">
						 <div class="tc-ch">
							<div class="tch-img swing-hover">
								<a href="<?php echo U('Article/index', array('id' => $list2['id']));?>">
								<img src="/Upload<?php echo ($list2['bigview'][0]); ?>" class="img-responsive" alt=""></a>
							</div>

							<h3><a href="<?php echo U('Article/index', array('id' => $list2['id']));?>"><?php echo ($list2['title']); ?></a></h3>
							<h6>BY <a href="<?php echo U('Article/index', array('id' => $list2['id']));?>"><?php echo ($list2['author']); ?>  </a><?php echo ($list2['createdtime']); ?></h6>
								<p><?php echo ($list2['shortsynopsis']); ?></p>
								<div class="bht1 ring-hover">
									<a href="<?php echo U('Article/index', array('id' => $list2['id']));?>">看看喽</a>
								</div>
								<div class="soci">
									<ul>
										<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
		                <script>
										window._bd_share_config=
										{
										"common":{
										"bdSnsKey":false,
										"bdText":false,
										"bdMini":"2",
										"bdMiniList":false,
										"bdPic":false,
										"bdStyle":"1",
										"bdSize":"16"},
										"share":{},
										//"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},
										//"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}
									  };
										with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
										</script>
									</ul>
								</div>
								<div class="clearfix"></div>
						</div>
					</div><?php endforeach; endif; ?>
				<div class="clearfix"></div>
			</div>
			<!-- technology-top -->
			<?php if(is_array($list3)): foreach($list3 as $key=>$list3): ?><div class="wthree">
					 <div class="col-md-6 wthree-left wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".2s">
						<div class="tch-img swing-hover">
								<a href="<?php echo U('Article/index', array('id' => $list3['id']));?>">
								<img src="/Upload<?php echo ($list3['bigview'][0]); ?>" class="img-responsive" alt=""></a>
							</div>
					 </div>
					 <div class="col-md-6 wthree-right wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".2s">
							<h3><a href="<?php echo U('Article/index', array('id' => $list3['id']));?>"><?php echo ($list3['title']); ?></a></h3>
							<h6>BY <a href="<?php echo U('Article/index', array('id' => $list3['id']));?>"><?php echo ($list3['author']); ?>  </a><?php echo ($list3['createdtime']); ?></h6>
								<p><?php echo ($list3['shortsynopsis']); ?></p>
								<div class="bht1 ring-hover">
									<a href="<?php echo U('Article/index', array('id' => $list3['id']));?>">看看喽</a>
								</div>
								<div class="soci">
									<ul>
										<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
		                <script>
										window._bd_share_config=
										{
										"common":{
										"bdSnsKey":false,
										"bdText":false,
										"bdMini":"2",
										"bdMiniList":false,
										"bdPic":false,
										"bdStyle":"1",
										"bdSize":"16"},
										"share":{},
										//"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},
										//"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}
									  };
										with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
										</script>
									</ul>
								</div>
								<div class="clearfix"></div>
					 </div>
					 <div class="clearfix"></div>
				</div><?php endforeach; endif; ?>
			</div>
			<div class="wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".5s">
							<div class="layui-box layui-laypage layui-laypage-default">
								<?php echo ($page); ?>
							</div>
			</div>
			<!--google map-->
			<!-- <div class="wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".5s">
			    <div id="map"></div>
			</div> -->
		</div>
<!-- technology-right -->
<div class="col-md-3 technology-right">
    <div class="blo-top1">
      <div class="tech-btm">
          <!-- <form action="#" method="post" class=" wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".2s">
            <div class="input-group">
            <input type="text" placeholder="输入关键字搜索.." class="form-control">
            <span class="input-group-btn">
              <button type="button" class="btn btn-success">搜索</button>
            </span>
            </div>
          </form>
      <br> -->
      <iframe frameborder="no" border="0" marginwidth="0" marginheight="0" width=330 height=110 src="//music.163.com/outchain/player?type=0&id=463038767&auto=0&height=90"></iframe>
      <br><br>
      <h4>近期发表的文章</h4>
      <?php if(is_array($list4)): foreach($list4 as $key=>$list4): ?><div class="blog-grids wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".2s">
          <div class="blog-grid-left shake-hover">
            <a href="<?php echo U('Article/index', array('id' => $list4['id']));?>"><img src="/Upload<?php echo ($list4['bigview'][0]); ?>" class="img-responsive" alt=""></a>
          </div>
          <div class="blog-grid-right">
            <h5><a href="<?php echo U('Article/index', array('id' => $list4['id']));?>"><?php echo ($list4['littletitle']); ?></a></h5>
            <br>
            <span class="muted "><i class="icon-time"></i> <?php echo ($list4['times']); ?></span>&nbsp
            <span class="muted"><i class="icon-eye-open"></i> <?php echo ($list4['views']); ?>浏览</span>
          </div>
          <div class="clearfix"> </div>
        </div><?php endforeach; endif; ?>
      <h4>点赞文章排行</h4>
      <?php if(is_array($list5)): foreach($list5 as $key=>$list5): ?><div class="blog-grids wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".2s">
          <div class="blog-grid-left shake-hover">
            <a href="<?php echo U('Article/index', array('id' => $list5['id']));?>"><img src="/Upload<?php echo ($list5['bigview'][0]); ?>" class="img-responsive" alt=""></a>
          </div>
          <div class="blog-grid-right">
            <h5><a href="<?php echo U('Article/index', array('id' => $list5['id']));?>"><?php echo ($list5['littletitle']); ?></a></h5>
            <br>
            <span class="muted "><i class="icon-time"></i> <?php echo ($list5['times']); ?></span>&nbsp
            <span class="muted"><i class="icon-heart"></i> <?php echo ($list5['favourites']); ?>点赞</span>
          </div>
          <div class="clearfix"> </div>
        </div><?php endforeach; endif; ?>
        <div class="insta wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".2s">
          <h4>博主位置:)</h4>
          <!--google map-->
    			<div class="wow fadeInDown"  data-wow-duration=".8s" data-wow-delay=".5s">
    			    <div id="map"></div>
    			</div>
      </div>
      <p>不管前方的路有多苦，只要走的方向正确，不管多么崎岖不平，都比站在原地更接近幸福。</p>
      <P style="margin-left: 120px;">——宫崎骏《千与千寻》</p>
      </div>
    </div>
</div>
<script>
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 17,
    center: {lat: 31.347466, lng: 121.384487}
  });

  var marker = new google.maps.Marker({
    map: map,
    // Define the place with a location, and a query string.
    place: {
      location: {lat: 31.347466, lng: 121.384487},
      query: 'Google, Sydney, Australia'

    },
    // Attributions help users find your site again.
    attribution: {
      source: 'Google Maps JavaScript API',
      webUrl: 'https://developers.google.com/maps/'
    }
  });

  // Construct a new InfoWindow.
  var infoWindow = new google.maps.InfoWindow({
    content: 'Google Sydney'
  });

  // Opens the InfoWindow when marker is clicked.
  marker.addListener('click', function() {
    infoWindow.open(map, marker);
  });
}

</script>
<script async defer
        src="http://ditu.google.cn/maps/api/js?key=AIzaSyCGQnoLJfAY9jnzp9QGzKcDMxeSIjNCuig&signed_in=true&libraries=places&callback=initMap">
</script>
<div class="clearfix"></div>
<!-- technology-right -->

	</div>
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

<script>
layui.use(['util', 'jquery', 'laypage', 'layer'], function () {
		var util = layui.util, $ = layui.jquery, laypage = layui.laypage, layer = layui.layer;
		util.fixbar();
		$('.blog-header-menu-icon').on('click', function () {
				var $nav = $('.blog-header-menu-nav');
				$nav.toggle();
		});
});
$(function() {
$(".heart").on("click", function() {
	$(this).toggleClass("is-active");
});
});
</script>