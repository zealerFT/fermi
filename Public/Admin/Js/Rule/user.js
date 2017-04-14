//author：fermi
//用户操作
function adduser() {
  $("#ruleurl").attr('action', '');
  $("input[name=id]").val('');
  $("input[name=user_login]").val('');
  $("input[name=user_email]").val('');
  $("input[name=user_pass]").val('');
  $("input[name=re_pass]").val('');
  $("input[name=group_id]").val('');
  $("#userurl").attr('action', '/Admin/Rule/user_add');
  $('.layer_bg03').show();
  $('.layer_wrap03').show();
}

function edituser(obj, id) {
  $("#ruleurl").attr('action', '');
  $("input[name=id]").val('');
  $("input[name=user_login1]").val('');
  $("input[name=user_email1]").val('');
  $("input[name=user_pass1]").val('');
  $("input[name=re_pass1]").val('');
  $("#userurl_edit").attr('action', '/Admin/Rule/user_edit');
  $("input[name=id]").attr('value', id);
  var user_login = $(obj).attr('user_login');
  $("input[name=user_login1]").attr('value', user_login);
  var user_email = $(obj).attr('user_email');
  $("input[name=user_email1]").attr('value', user_email);
  $('.layer_bg04').show();
  $('.layer_wrap04').show();
}

$(document).ready(function(){
  getuserlist();


  var options1 = {
      beforeSubmit: showRequest,
      success: function(s) {
        console.log(s);
        if (s == 'unlogin') {
          tishi('登录已失效，请重新登录！2秒后跳转到登录页面！');
          window.setTimeout("window.location='/Admin/Login/login'", 2000);
        } else if(s == 'unauth') {
          tishi('抱歉，您没有操作权限！');
        } else if (s == "成功" || s == "修改成功" || s == "添加成功") {
            tishi(s);
            window.setTimeout("window.location='/Admin/Rule/userindex'", 1000);
        } else {
          tishi(s);
        }

      }
  };
  $("#ajaxUserSubmit").click(function() {
      $(".ajaxUserForm").ajaxSubmit(options1);
      return false;
  });


  var options2 = {
      beforeSubmit: showRequest_edit,
      success: function(s) {
        console.log(s);
        if (s == 'unlogin') {
          tishi('登录已失效，请重新登录！2秒后跳转到登录页面！');
          window.setTimeout("window.location='/Admin/Login/login'", 2000);
        } else if(s == 'unauth') {
          tishi('抱歉，您没有操作权限！');
        } else if (s == "成功" || s == "修改成功" || s == "添加成功") {
            tishi(s);
            window.setTimeout("window.location='/Admin/Rule/userindex'", 1000);
        } else {
          tishi(s);
        }

      }
  };
  $("#ajaxUserSubmit1").click(function() {
      $(".ajaxUserForm1").ajaxSubmit(options2);
      return false;
  });

  function showRequest() {
    var password = $("input[name=user_pass]").val();
    var username = $("input[name=user_login]").val();
    var email = $("input[name=user_email]").val();
    if($("input[name=user_login]").val() == ''){
        tishi('请填写用户名！');
        return false;
    }
    if(username.search(/^[a-zA-Z]+$/) === -1){
        tishi('用户名只能是英文！');
        return false;
    }

    if($("input[name=user_email]").val() == ''){
        tishi('请填写邮箱！');
        return false;
    }
    if(email.search(/\w+[@]{1}\w+[.]\w+/) === -1){
        tishi('请输入正确的邮箱格式！');
        return false;
    }
    if($("input[name=user_pass]").val() == ''){
        tishi('请填写密码！');
        return false;
    }
    if(password.search(/^\w{6,20}$/) === -1){
        tishi('密码必须是6-20位的数字、字母！');
        return false;
    }
    if($("input[name=re_pass]").val() !== $("input[name=user_pass]").val()){
        tishi('两次填写的密码不一致！');
        return false;
    }
    if($("#select_user").val() == '')
    {
      tishi('请选择一个角色！');
      return false;
    }
  }
  function showRequest_edit() {
    var password = $("input[name=user_pass1]").val();
    var username = $("input[name=user_login1]").val();
    var email = $("input[name=user_email1]").val();
    if($("input[name=user_login1]").val() == ''){
        tishi('请填写用户名！');
        return false;
    }
    if(username.search(/^[a-zA-Z]+$/) === -1){
        tishi('用户名只能是英文！');
        return false;
    }
    if($("input[name=user_email1]").val() == ''){
        tishi('请填写邮箱！');
        return false;
    }
    if(email.search(/\w+[@]{1}\w+[.]\w+/) === -1){
        tishi('请输入正确的邮箱格式！');
        return false;
    }
    if (password !== '') {
      if(password.search(/^\w{6,20}$/) === -1){
          tishi('密码必须是6-20位的数字、字母！');
          return false;
      }
      if($("input[name=re_pass1]").val() !== $("input[name=user_pass1]").val()){
          tishi('两次填写的密码不一致！');
          return false;
      }
    }
  }

})

//角色列表
function getuserlist(){
    $('.tabs').empty();
      // 理财产品
      $.ajax({
          url:'/Admin/Rule/user',
          type:'post',
          success:function(s){
            if (s == 'unlogin') {
              tishi('登录已失效，请重新登录！2秒后跳转到登录页面！');
              window.setTimeout("window.location='/Admin/Login/login'", 2000);
            } else if(s == 'unauth') {
              tishi('抱歉，您没有操作权限！');
            }
              if(s.list==null || s.list==''){
                  var htmls = "<tbody><tr><th colspan='5%'><input id='checkAll' onclick='check_all()' type='checkbox' class='tabs-radio' /></th><th colspan='15%'>用户名</th><th colspan='30%'>所属角色</th><th colspan='15%'>用户邮箱</th><th colspan='15%'>最后登录IP</th><th colspan='20%' >最后登录时间</th><th colspan='20%' >操作</th>";
                  htmls += "<tr><td style='text-align:center;' colspan='100%'><h1>无数据</h1></td></tr>";
              }else{
                var htmls = "<tbody><tr><th colspan='5%'><input id='checkAll' onclick='check_all()' type='checkbox' class='tabs-radio' /></th><th colspan='15%'>用户名</th><th colspan='30%'>所属角色</th><th colspan='15%'>用户邮箱</th><th colspan='15%'>最后登录IP</th><th colspan='20%' >最后登录时间</th><th colspan='20%' >操作</th>";
                if (s.list == '' || s.list == null) {
                    htmls += "<tr><td style='text-align:center;' colspan='100%'>无数据</td></tr>";
                } else {
                    var role = s.roleon  //有效的角色名
                    //console.log(role);
                    $.each(s.list, function(i, n) {
                        htmls += "<tr>";
                        htmls += "<td colspan='5%'>" +
                        "<input id='pro"+ n.id +"' name='pro' type='checkbox' value='" + n.id + "' class='tabs-radio' />" +
                        "</td>";
                        htmls += "<td colspan='15%'>" + n.user_login + "</td>";
                        if (n.id == 1) {
                          htmls += "<td colspan='30%'><font color='red'>超级管理员还是别动了</font></td>";
                        } else {
                          htmls += '<td colspan="30%"><select id="changegruop" useruid="' + n.uid + '" name="group_id" class="">';
                          for (var i = 0; i < role.length; i++) {
                            if (n.title == role[i].title) {
                              htmls += '<option value="'+ role[i].id +'" selected>'+ role[i].title +'</option>';
                            } else {
                              htmls += '<option value="'+ role[i].id +'">'+ role[i].title +'</option>';
                            }
                          }
                        }
                        htmls += '</select></td>';
                        htmls += "<td colspan='15%'>" + n.user_email + "</td>";
                        htmls += "<td colspan='15%'>" + n.last_login_ip + "</td>";
                        htmls += "<td colspan='20%'>" + n.last_login_time + "</td>";
                        if (n.id == 1) {
                          htmls += "<td colspan='20%'>";
                          htmls += "<a href='javascript:void(0);' class='btn btn-default'>编辑</a>&nbsp&nbsp";
                          htmls += "<a href='javascript:void(0);' class='btn btn-default'>删除</a>";
                          htmls += "</td>";
                        } else {
                          htmls += "<td colspan='20%'>";
                          htmls += "<a href='javascript:void(0);' user_login='" + n.user_login + "' user_email='" + n.user_email + "' onclick='edituser(this, " + n.id + ");' class='btn btn-green'>编辑</a>&nbsp&nbsp";
                          htmls += "<a href='javascript:void(0);' onclick='deleteuser(" + n.id + ");' class='btn btn-green'>删除</a>";
                          htmls += "</td>";
                        }
                        htmls += "</tr></tbody>";
                    });

                }
              }
              $('.tabs').html(htmls);
          },
      });

}

  //改变用户角色
  $(document).on("change", "#changegruop", function() {
      var useruid = $(this).attr("useruid");
      var roleid = $(this).val();
      $.ajax({
        url:'/Admin/Rule/changeuserrole',
        data:{roleid:roleid,useruid:useruid},
        type:'post',
        success:function(s) {
          if (s == 'unlogin') {
            tishi('登录已失效，请重新登录！2秒后跳转到登录页面！');
            window.setTimeout("window.location='/Admin/Login/login'", 2000);
          } else if(s == 'unauth') {
            tishi('抱歉，您没有操作权限！');
          } else {
            tishi(s.info);
          }
        }
      })
  })

  function deleteuser(id) {
      if (!window.confirm('确定要删除此用户吗?')) {
          return false;
      }
      $.ajax({
         url: "/Admin/Rule/user_delete",
         data:{id:id},
         type: "post",
         success: function(s) {
           if (s == 'unlogin') {
             tishi('登录已失效，请重新登录！2秒后跳转到登录页面！');
             window.setTimeout("window.location='/Admin/Login/login'", 2000);
           } else if(s == 'unauth') {
             tishi('抱歉，您没有操作权限！');
           } else if(s == 'success') {
             tishi("删除成功！");
             window.setTimeout("window.location='/Admin/Rule/userindex'", 1000);
           } else {
             tishi("请选择没有子权限的进行删除，保证操作不影响其他权限！");
           }
         }
       })

  }
