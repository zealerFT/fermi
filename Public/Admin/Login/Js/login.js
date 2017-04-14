//author：fermi
//登录操作
$(document).ready(function() {
    $("#LoginSubmit").click(function() {
        $("#LoginForm").ajaxSubmit(options);
        return false;
    });
    var options = {
        beforeSubmit: showRequest,
        success: function(s) {
          console.log(s);
            if (s == 'unlogin') {
              tishi('登录已失效，请重新登录！2秒后跳转到登录页面！');
              window.setTimeout("window.location='/Admin/Login/login/'", 1000);
            } else if(s == 'unauth') {
              tishi('抱歉，您没有操作权限！');
            } else if (s == "成功" || s == "登录成功！") {
                alert(s);
                window.setTimeout("window.location='/Admin/Blog/index/'", 1000);
            } else {
              alert(s);
            }
        }
    };
    function showRequest() {
      if($("input[name=username]").val() == ''){
          tishi('请填写账号！');
          return false;
      }
      if($("input[name=password]").val() == ''){
          tishi('请填写密码！');
          return false;
      }
    }
})
