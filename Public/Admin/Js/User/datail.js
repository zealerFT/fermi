//author：fermi
//图片详情
$(document).ready(function() {
    userid = $("#userid").val();
    $("#UserSubmit").click(function() {
        $("#UserForm").ajaxSubmit(options);
        return false;
    });
    var options = {
        beforeSubmit: showRequest,
        success: function(s) {
          console.log(s);
          if (s == 'unlogin') {
              tishi('登录已失效，请重新登录！1秒后跳转到登录页面！');
              window.setTimeout("window.location='/Admin/Login/login/'", 1000);
          } else if(s == 'unauth') {
              tishi('抱歉，您没有操作权限！');
          } else if (s == "成功" || s == "修改成功" || s == "添加成功") {
              tishi(s + "，1秒后跳转到列表！");
              window.setTimeout("window.location='/Admin/User/index/'", 1000);
          } else {
             tishi(s);
          }
        }
    };
    function showRequest() {
        email = $("input[name=email]").val();
        if($("input[name=nickname]").val() == ''){
            tishi('请填写昵称！');
            return false;
        }
        if($("input[name=email]").val() == ''){
            tishi('请填写邮箱！');
            return false;
        }
        if(email.search(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/) === -1){
            tishi('请填写正确的邮箱格式！');
            return false;
        }
    }
})
