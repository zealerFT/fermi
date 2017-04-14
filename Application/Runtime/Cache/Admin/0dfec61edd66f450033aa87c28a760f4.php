<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<meta name="keywords" content="Flat Dark Web Login Form Responsive Templates, Iphone Widget Template, Smartphone login forms,Login form, Widget Template, Responsive Templates, a Ipad 404 Templates, Flat Responsive Templates" />
<link href="/Public/Admin/Login/css/style.css" rel='stylesheet' type='text/css' />
<!--webfonts-->

<!--//webfonts-->
<script src="/Public/Admin/Js/jquery-1.8.3.min.js"></script>
<script src="/Public/Admin/Js/jquery-form.js"></script>
</head>
<body>
<script>$(document).ready(function(c) {
	$('.close').on('click', function(c){
		$('.login-form').fadeOut('slow', function(c){
	  		$('.login-form').remove();
		});
	});
});
</script>
 <!--SIGN UP-->
 <h1>费腾fermi博客后台登录</h1>
<div class="login-form">
		<div class="close">
		</div>
				<div class="head-info">
						<label class="lbl-1"> </label>
						<label class="lbl-2"> </label>
						<label class="lbl-3"> </label>
				</div>
		<div class="clear"> </div>
		<div class="avtar">
			  <img src="/Public/Admin/Login/images/avtar.png" />
		</div>
		<form id="LoginForm" class="LoginForm" action="/Admin/Login/dologin" method="post">
				<input name='username' type="text" class="text" value="username" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'username';}" >
				<div class="key">
				  <input name="password" type="password" value="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'password';}">
				</div>
		</form>
		<div class="signin">
			  <input id="LoginSubmit" type="submit" value="Login" >
		</div>
</div>
<script src="/Public/Admin/Login/Js/login.js"></script>
<script type="text/javascript">

</script>
</body>
</html>