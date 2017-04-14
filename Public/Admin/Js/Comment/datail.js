//author：fermi
//图片详情
$(document).ready(function() {
    picid = $("#commentid").val();
    $("#CommentForm").submit(function(){
      layedit.sync(layeditIndex);
      $("#CommentForm").ajaxSubmit(options);
      return false;
    });
    var options = {
        success: function(s) {
          console.log(s);
          if (s == 'unlogin') {
              tishi('登录已失效，请重新登录！1秒后跳转到登录页面！');
              window.setTimeout("window.location='/Admin/Login/login/'", 1000);
          } else if(s == 'unauth') {
              tishi('抱歉，您没有操作权限！');
          } else if (s == "成功" || s == "修改成功" || s == "添加成功") {
              tishi(s + "，1秒后跳转到列表！");
              window.setTimeout("window.location='/Admin/Comment/index/'", 1000);
          } else {
             tishi(s);
          }
        }
    };
})
