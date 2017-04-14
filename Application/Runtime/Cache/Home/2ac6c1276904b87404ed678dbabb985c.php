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

<!-- banner -->
<div class="banner-1">
	<div class="container">
		<!-- <h2>没错，这里就是文章的内容啦！</h2> -->
		<!-- <p>欢迎来到我的博客，有什么意见和建议，请不要发给我，发给我我也不会看，谢谢！</p> -->
	</div>
</div>
	<!-- technology-left -->
<div class="technology" style="margin-top: 0em;">
	<div class="container">
		<div class="col-md-9 technology-left">
			<div class="agileinfo">
				<!-- <div class="layui-main blog-container"> -->
						<div class="blog-detail-main">
								<blockquote class="layui-elem-quote">
										<span style="font-size:30px;"><?php echo ($list['title']); ?></span><br><br>
										<span style="font-size:15px">
												作者：<cite style="color:#00BFFF;"><?php echo ($list['author']); ?></cite>
										</span>&nbsp;
										<span style="font-size:15px">
												发表时间：<cite style="color:#20B2AA;"><?php echo ($list['createdtime']); ?></cite>
										</span>&nbsp;
										<a href="#comment-m" style="font-size:15px">
												<span>
														<cite style="color:#DC143C;"><?php echo ($comment); ?></cite> 评
												</span>
										</a>&nbsp;
										<span style="font-size:15px">
												<cite style="color:#20B2AA;"><?php echo ($list['views']); ?></cite> 阅
												<span>
													<cite style="color:#DC143C;padding-left:10px;" id="changelove" ><?php echo ($list['favourites']); ?></cite>
												</span>
										</span>&nbsp;
										<span class="stageBox">
											<div class="stage">
												<div id="favourites" class="heart"></div>
											</div>
										</span>
								</blockquote>
								<article class="blog-detail-content">
									<?php echo ($list['synopsis']); ?>
							  </article>
							  <br><br>
								<blockquote class="layui-elem-quote">
										<span style="font-size:15px">
											分类：
											<a class="btn btn-warning bounce-hover" href="javascript:void(0);"><?php echo ($bloglabel); ?></a>
										</span>&nbsp;<br><br>
										<span style="font-size:15px">
											标签：
											<?php if(is_array($keywords)): foreach($keywords as $key=>$keywords): ?><a class="btn btn-success shake-hover" href="javascript:void(0);"><?php echo ($keywords); ?></a>
												<!-- &nbsp&nbsp --><?php endforeach; endif; ?>
										</span>
								</blockquote>
								<blockquote class="layui-elem-quote" id="comment-m">查看评论</blockquote>
								<br>
								<div class=""><!--blog-detail-comment-box-->
								    <form id="CommentForm" action="#" class="layui-form layui-form-pane" method="post">
											      <input type="hidden" name="articleid" value="<?php echo ($list['id']); ?>" />
														<div class="layui-form-item">
																<label class="layui-form-label">昵称</label>
																<div class="layui-input-block">
																		<input id="nickname" lay-verify="nickname" type="text" name="nickname" required placeholder="这里留下你的大名哦 ^_^ " class="layui-input">
																</div>
														</div>
														<div class="layui-form-item">
																<label class="layui-form-label">邮箱</label>
																<div class="layui-input-block">
																	<input id="email" lay-verify="email" type="email" name="email" required placeholder="这里留下你的邮箱哦，方便我们能联系到你吖 " class="layui-input">
																</div>
														</div>
														<div class="layui-form-item layui-form-text">
																<label class="layui-form-label">评论内容</label>
																<div class="layui-input-block">
																		<textarea id="comment-text" lay-verify="comment" name="comment" ></textarea>
																</div>
														</div>
														<div class="layui-form-item">
																<button class="layui-btn" lay-submit lay-filter="*">发表</button>
																<button type="reset" class="layui-btn layui-btn-primary">重置</button>
														</div>
														<!-- <div class="layui-form-item"> -->
															<!-- <button class="btn btn-primary" type="submit" lay-submit id="CommentSubmit">发表</button> -->
														<!-- </div> -->
								    </form>
						        <ul class="blog-detail-comment-list">
										</ul>
								</div>
				   </div>
			  <!-- </div> -->
     </div>
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

<script src="/Public/Home/Js/Article/article.js"></script>
<script>
		layui.use(['layedit', 'util', 'jquery', 'form'], function () {
				layedit = layui.layedit
				    , util = layui.util
						, $ = layui.jquery
						, form = layui.form();
				//回到顶部
				util.fixbar();
				$('.blog-header-menu-icon').on('click', function () {
						var $nav = $('.blog-header-menu-nav');
						$nav.toggle();
				});
				//建立编辑器
				layeditIndex = layedit.build('comment-text', {
						tool: ['strong', 'italic', 'underline', '|', 'left', 'center', 'right', 'face'],
						height: 180
				});
				//自定义验证规则
				form.verify({
						nickname: function (value) {
								if (value === '') return '少侠，请留名^_^';
						},
						email: function (value) {
								if (value === '') return '少侠，请留下联系方式吧^_^';
								if (!/^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/.test(value)) {
										return '少侠，你留下的电子邮箱不对哦，再试试？';
								}
						},
						comment: function (value) {
								var v = layedit.getText(layeditIndex);
								if (v.length === 0) {
										return '少侠，既然来了，就留下点什么呗';
								}
								if (v.length <= 10) return '写得太少了，再写点吧.拜托了^_^';
						}
				});
		});

		//百度编辑器代码高亮
    SyntaxHighlighter.all();
</script>