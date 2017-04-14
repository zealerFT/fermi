<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html lang="zh-CN">
    <head>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta charset="utf-8" />
        <title>管理中心</title>
        <link rel="stylesheet" type="text/css" href="/Public/Admin/Css/backend.css" />
        <link rel="stylesheet" type="text/css" href="/Public/Admin/Css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="/Public/Admin/Css/base.css" />
        <link rel="stylesheet" type="text/css" href="/Public/Admin/Css/easyui.css" />
        <link rel="stylesheet" type="text/css" href="/Public/webuploader/css/webuploader.css" />
        <link rel="stylesheet" type="text/css" href="/Public/webuploader/css/style.css" />
        <script type="text/javascript" src="/Public/Admin/Js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="/Public/Admin/Js/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="/Public/Admin/Js/jquery.tools.min.js"></script>
        <!-- <script type="text/javascript" src="/Public/Admin/Js/bootstrap.min.js"></script> -->
        <script type="text/javascript" src="/Public/Admin/Js/Backend.js"></script>
        <script type="text/javascript" src="/Public/Admin/Js/Validform_v5.3.2_min.js"></script>
        <script type="text/javascript" src="/Public/Admin/Js/jedate.js"></script>
        <script type="text/javascript" src="/Public/Admin/Js/jquery-form.js"></script>
        <script type="text/javascript" src="/Public/Admin/Js/jquery.cookie.js"></script>
        <script type="text/javascript" src="/Public/Admin/Js/bootstrap-filestyle.min.js"></script>
        <script type="text/javascript" src="/Public/Admin/Js/echarts.js"></script>
        <script type="text/javascript" src="/Public/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="/Public/wysiwyg/bootstrap-wysiwyg.js"></script>
        <!-- layui-UI -->
        <link href="/Public/layui/css/layui.css" rel="stylesheet">
        <script src="/Public/layui/layui.js"></script>
        <!-- 配置文件 -->
        <script type="text/javascript" src="/Public/ueditor/ueditor.config.js"></script>
        <!-- 编辑器源码文件 -->
        <script type="text/javascript" src="/Public/ueditor/ueditor.all.js"></script>
        <!-- 百度上传插件 -->
        <script type="text/javascript" src="/Public/webuploader/js/webuploader.min.js"></script>
    </head>
    <body class="bg">
        <div class="wrapper">
            <!--header 头部-->
            <div class="navbar navbar-blue navbar-static-top navbar-font" role="navigation">
              <div class="navbar-header"></div>
                <div class="phone-box pull-left">
                    <i class="layui-icon" style="height:20px;font-size: 30px; color: #1E9FFF;">&#xe609;</i>
                    <span class="sevice">费腾fermi博客后台</span>
                </div>
                <div class="nav-box pull-left">
                    <ul class="nav-ul">
                        <li>
                          <i class="layui-icon" style="height:20px;font-size: 20px; color: #1E9FFF;">&#xe64c;</i>
                          <a href="<?php echo U('Home/Index/index');?>" target="_blank">首页</a>
                        </li>
                        <li>
                          <i class="layui-icon" style="height:20px;font-size: 20px; color: #1E9FFF;">&#xe629;</i>
                          <a href="<?php echo U('Home/Index/index');?>" target="_blank">google指数</a>
                        </li>
                        <li>
                          <i class="layui-icon" style="height:20px;font-size: 20px; color: #1E9FFF;">&#xe63c;</i>
                          <a href="<?php echo U('Home/Index/index');?>" target="_blank">计划</a>
                        </li>
                        <li>
                          <i class="layui-icon" style="height:20px;font-size: 20px; color: #1E9FFF;">&#xe642;</i>
                          <a href="<?php echo U('Home/Index/index');?>" target="_blank">Python</a>
                        </li>
                    </ul>
                </div>
                <div class="user-box pull-right">
                    <div class="user-name pull-left"><!--后台头像-->
                        <img style="width: 40px;height: 40px;border-radius: 50%;" class="mr5" src="<?php echo ($_SESSION['user']['avatar']); ?>">
                        <!-- src="<?php echo ($_SESSION['userinfo']['userpic']); ?>" -->
                        欢迎您，<?php echo ($_SESSION['user']['nickname']); ?>
                    </div>
                    <div class="pull-left mr10 relative">
                    <a href="#">
                    <i class="layui-icon" style="font-size:15px;color:#1E9FFF;">&#xe60c;</i>
                    <div class="top_message"></div>
                    </a>
                    </div>
                    <div class="out-btn pull-left">
                        <a href="/Admin/Login/logout"><i class="iconAll icon-013"></i>退出</a>
                    </div>
                </div>

<!--左侧导航-->
<div class="sidebar overflow" role="navigation">
    <div class="sidebar-nav">
        <!-- <div class="logoTop">
            <div></div>
        </div> -->
      <ul class="sidebar-ul">
           <li class="sldebar-li">
               <div class="link-title">
                   <i class="iconAll icon-018"></i><a href="<?php echo U('Index/index');?>" class="management-center">博客管理</a><i class="iconAll  icon-019 i"></i>
               </div>
               <ul class="tas-nav tas-ul">
                 <?php if(($mode_name) == "blog"): ?><li><a href="<?php echo U('Blog/index');?>"  class="link-item itemon"><i class="iconAll icon-023"></i>文章管理</a></li>
                 <?php else: ?>
                     <li><a href="<?php echo U('Blog/index');?>"  class="link-item"><i class="iconAll icon-023"></i>文章管理</a></li><?php endif; ?>
                 <?php if(($mode_name) == "picture"): ?><li><a href="<?php echo U('Picture/index');?>" class="link-item itemon"><i class="iconAll icon-048"></i>图瀑管理</a></li>
                     <?php else: ?>
                     <li><a href="<?php echo U('Picture/index');?>" class="link-item"><i class="iconAll icon-048"></i>图瀑管理</a></li><?php endif; ?>
                 <?php if($mode_name == comment): ?><li><a href="<?php echo U('Comment/index');?>"  class="link-item itemon"><i class="iconAll icon-047"></i>评论管理</a></li>
                     <?php else: ?>
                     <li><a href="<?php echo U('Comment/index');?>"  class="link-item"><i class="iconAll icon-047"></i>评论管理</a></li><?php endif; ?>
                 <?php if(($mode_name) == "user"): ?><li><a href="<?php echo U('User/index');?>" class="link-item itemon"><i class="iconAll icon-056"></i>会员管理</a></li>
                     <?php else: ?>
                     <li><a href="<?php echo U('User/index');?>" class="link-item"><i class="iconAll icon-056"></i>会员管理</a></li><?php endif; ?>
               </ul>
           </li>
        </ul>
        <ul class="sidebar-ul">
            <li class="sldebar-li">
                <div class="link-title">
                    <i class="iconAll icon-018"></i><a href="#" class="management-center">管理中心</a><i class="iconAll  icon-019 i icon-057"></i>
                </div>
                <ul class="tas-nav tas-ul">
                    <?php if(($mode_name) == "managementCenter"): ?><li><a href="#" class="link-item itemon"><i class="iconAll icon-020"></i>个人中心</a></li>
                    <?php else: ?>
                        <li><a href="#" class="link-item"><i class="iconAll icon-020"></i>个人中心</a></li><?php endif; ?>
                    <?php if(($mode_name) == "ruleindex"): ?><li><a href="<?php echo U('Admin/Rule/index');?>"  class="link-item itemon"><i class="iconAll icon-048"></i>权限管理</a></li>
                        <?php else: ?>
                        <li><a href="<?php echo U('Admin/Rule/index');?>"  class="link-item"><i class="iconAll icon-048"></i>权限管理</a></li><?php endif; ?>
                    <?php if(($mode_name) == "userindex"): ?><li><a href="<?php echo U('Admin/Rule/userindex');?>" class="link-item itemon"><i class="iconAll icon-021"></i>用户管理</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo U('Admin/Rule/userindex');?>" class="link-item"><i class="iconAll icon-021"></i>用户管理</a></li><?php endif; ?>
                    <?php if(($mode_name) == "roleindex"): ?><li><a href="<?php echo U('Admin/Rule/roleindex');?>" class="link-item itemon"><i class="iconAll icon-022"></i>角色管理</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo U('Admin/Rule/roleindex');?>" class="link-item"><i class="iconAll icon-022"></i>角色管理</a></li><?php endif; ?>
                    <?php if(($mode_name) == "commissio"): ?><li><a href="#" class="link-item itemon"><i class="iconAll icon-058"></i>数据统计</a></li>
                        <?php else: ?>
                        <li><a href="#" class="link-item"><i class="iconAll icon-058"></i>数据统计</a></li><?php endif; ?>
                    <?php if(($mode_name) == "accountManagement"): ?><li><a href="#"  class="link-item itemon"><i class="iconAll icon-025"></i>系统设置</a></li>
                    <?php else: ?>
                        <li><a href="#"  class="link-item"><i class="iconAll icon-025"></i>系统设置</a></li><?php endif; ?>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!--弹出提示框-->
<div class="layer_bg_tishi"></div>
<div class="layer_wrap_tishi border">
    <div class="topper clearfix">
        <span class="pull-left"><i class="iconAll icon-043"></i>提示信息</span>
    </div>
    <div class="pd30 bc-normal relative">
        <p class="text-center f14" id="message_error"></p>
    </div>
    <div class="l_footer"><a onclick="close_tishi()">确定</a></div>
</div>
<script>
    $(function(){
        var sldebar = $(".sldebar-li");
        var link = sldebar.find(".link-title");
        var a = sldebar.find("a");
        link.on("click",function(){
            $(this).next(".tas-ul").slideToggle();
            $(this).find(".i").toggleClass("icon-057");
        });
        a.each(function(i){
            if(a.eq(i).hasClass("itemon")){
                $(this).parent().parent().show();
                $(this).parent().parent().parent().parent().siblings().find('.tas-ul').hide();
            }
        });
    });
</script>

<!--主题内容-->
<div id="page-wrapper">
    <div class="content">
        <div class="main-box">
            <div class="main-hd clearfix" id="change">
                <a class="btn btn-button pull-left mr20" href="javascript:void(0);" onclick="adduser();"><i class="iconAll icon-01"></i>添加用户</a>
            </div>
            <table class="tabs">

            </table>
        </div>
    </div>
</div>
<!-- 添加用户 -->
<div class="layer_bg layer_bg03"></div>
<div class="layer_wrap layer_wrap03 border mt-100 popping">
    <div class="topper clearfix">
        <span class="pull-left">添加角色</span><a onclick="closeAll_1()" class="pull-right"></a><br><br>
    </div>
    <form class="ajaxUserForm"  id="userurl" action="#" method="post" >
        <input type="hidden" name="id" value="">
        <div class="pl30 pr30 pt30 bc-normal relative layer-box overflow-y-scroll chanpin ">
          <table class=" uperrorForm tb_info">
              <tbody>
                  <tr>
                      <th><span class="red">*</span><font style="font-size:14px;font-family:'微软雅黑'">用户名</font></th>
                      <td colspan="3">
                          <input placeholder="例如：admin" class="input-text" type="text" name="user_login">
                      </td>
                  </tr>
                  <tr>
                      <th><span class="red">*</span><font style="font-size:14px;font-family:'微软雅黑'">邮箱</font></th>
                      <td colspan="3">
                          <input placeholder="例如：mayun@aliyun.com" class="input-text" type="email" name="user_email">
                      </td>
                  </tr>
                  <tr>
                      <th><span class="red">*</span><font style="font-size:14px;font-family:'微软雅黑'">密码</font></th>
                      <td colspan="3">
                          <input class="input-text" type="password" name="user_pass">
                      </td>
                  </tr>
                  <tr>
                      <th><span class="red">*</span><font style="font-size:14px;font-family:'微软雅黑'">重复密码</font></th>
                      <td colspan="3">
                          <input  class="input-text" type="password" name="re_pass">
                      </td>
                  </tr>
                  <tr>
                      <th><span class="red">*</span><font style="font-size:14px;font-family:'微软雅黑'">所属角色</font></th>
                      <td colspan="3">
                          <select id="select_user" class="" name="group_id">
                            <option value ="">请选择角色</option>
                            <?php if(is_array($role)): foreach($role as $key=>$role): ?><option value ="<?php echo ($role['id']); ?>"><?php echo ($role['title']); ?></option><?php endforeach; endif; ?>
                          </select>

                      </td>
                  </tr>
              </tbody>
          </table>
          <div class="btnbox text-center mt20 mb30">
              <input type="button" id="ajaxUserSubmit"  class="btn btn-green w60" value="确认">
              <a class="btn btn-default ml20" href="javascript:void(0);" onclick="closeAll_1()">取消</a>
          </div>
        </div>
    </form>
</div>
<!-- 编辑用户 -->
<div class="layer_bg04"></div>
<div class="layer_wrap04 border mt-100 popping">
    <div class="topper clearfix">
        <span class="pull-left">编辑角色</span><a onclick="closeAll_1()" class="pull-right"></a><br><br>
    </div>
    <form class="ajaxUserForm1"  id="userurl_edit" action="#" method="post" >
        <input type="hidden" name="id" value="">
        <div class="pl30 pr30 pt30 bc-normal relative layer-box overflow-y-scroll chanpin ">
          <table class=" uperrorForm tb_info">
              <tbody>
                  <tr>
                      <th><span class="red">*</span><font style="font-size:14px;font-family:'微软雅黑'">用户名</font></th>
                      <td colspan="3">
                          <input placeholder="例如：admin" class="input-text" type="text" name="user_login1">
                      </td>
                  </tr>
                  <tr>
                      <th><span class="red">*</span><font style="font-size:14px;font-family:'微软雅黑'">邮箱</font></th>
                      <td colspan="3">
                          <input placeholder="例如：mayun@aliyun.com" class="input-text" type="email" name="user_email1">
                      </td>
                  </tr>
                  <tr>
                      <th><font style="font-size:14px;font-family:'微软雅黑'">密码</font></th>
                      <td colspan="3">
                          <input class="input-text" type="password" name="user_pass1">
                      </td>
                  </tr>
                  <tr>
                      <th><font style="font-size:14px;font-family:'微软雅黑'">重复密码</font></th>
                      <td colspan="3">
                          <input  class="input-text" type="password" name="re_pass1">
                      </td>
                  </tr>
              </tbody>
          </table>
          <div class="btnbox text-center mt20 mb30">
              <input type="button" id="ajaxUserSubmit1"  class="btn btn-green w60" value="确认">
              <a class="btn btn-default ml20" href="javascript:void(0);" onclick="closeAll_1()">取消</a>
          </div>
        </div>
    </form>
</div>
<script src="/Public/Admin/Js/Rule/user.js"></script>
</div>
</div>
</body>
</html>