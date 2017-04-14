//author：fermi
//博客文章列表操作
getuserlist(1);
var nowpage = 1;
function getuserlist(page){
    if(page==null){
        page=nowpage;
    }
    var html = '';
    var data = 'p=' + page;
    nickname = $('input[name="nickname"]').val();
    email = $('input[name="email"]').val();
    if (nickname != '') {
        data += '&nickname=' + nickname;
    }
    if (email != '') {
        data += '&email=' + email;
    }
    $('.tabs').empty();
      $.ajax({
          url:'/Admin/User/ajaxuserlist/',
          type:'post',
          data:data,
          success:function(s){
            if (s == 'unlogin') {
              tishi('登录已失效，请重新登录！1秒后跳转到登录页面！');
              window.setTimeout("window.location='/Admin/Login/login/'", 1000);
            } else if (s == 'unauth') {
              tishi('抱歉，您没有操作权限！');
            } else if(s.list==null || s.list=='') {
              var htmls = "<tbody><tr><th><input id='checkAll' onclick='check_all()' type='checkbox' class='tabs-radio' /></th><th>昵称</th><th>邮箱</th><th>登录次数</th>" +
              "<th>IP</th><th>最后登录时间</th><th>操作</th></tr>";
              htmls += "<tr><td style='text-align:center;' colspan='8'><h1>无数据</h1></td></tr>";
            } else {
              var htmls = "<tbody><tr><th><input id='checkAll' onclick='check_all()' type='checkbox' class='tabs-radio' /></th><th>昵称</th><th>邮箱</th><th>登录次数</th>" +
              "<th>IP</th><th>最后登录时间</th><th>操作</th></tr>";
              if (s.list == '' || s.list == null) {
                  htmls += "<tr><td style='text-align:center;' colspan='7'>无数据</td></tr>";
              } else {
                  $.each(s.list, function(i, n) {
                      htmls += "<tr>";
                      htmls += "<td>" +
                      "<input id='pro"+ n.id+"' name='pro' type='checkbox' value='" + n.id + "' class='tabs-radio' />" +
                      "</td>";
                      htmls += "<td>" + n.nickname + "</td>";
                      htmls += "<td>" + n.email + "</td>";
                      htmls += "<td>" + n.times + "</td>";
                      htmls += "<td>" + n.last_login_ip + "</td>";
                      htmls += "<td>" + n.last_login_time + "</td>";
                      htmls += "<td><a href='/Admin/User/detail/id/" + n.id + "/' class='btn btn-green'>详情</a>";
                      htmls += "&nbsp;<a href='#' onclick='deleteuser(" + n.id + ");' class='btn btn-green'>删除</a></td>";
                      htmls += "</tr></tbody>";
                  });
              }
            }
              $('.tabs').html(htmls);
              if (s.page != '') {
                  $(".kkpager").html(s.page);
              }
          },
      });

}

  function deleteuser(id) {
    if (!window.confirm('确定要删除此用户吗?')) {
        return false;
    }
    $.ajax({
       url: "/Admin/User/deleteuser/",
       data:{id:id},
       type: "post",
       success: function(s) {
         console.log(s);
         if (s == 'unlogin') {
           tishi('登录已失效，请重新登录！1秒后跳转到登录页面！');
           window.setTimeout("window.location='/Admin/Login/login/'", 1000);
         } else if(s == 'unauth') {
           tishi('抱歉，您没有操作权限！');
         } else if(s == 'success') {
           tishi("删除成功！");
           getuserlist(1);
         } else {
           tishi("删除失败！");
         }
       }
     })
  }
