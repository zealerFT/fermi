//author：fermi
//博客文章列表操作
getcomlist(1);
var nowpage = 1;
function getcomlist(page){
    if(page==null){
        page=nowpage;
    }
    var html = '';
    var data = 'p=' + page;
    title = $('input[name="title"]').val();
    createtime = $('input[name="createtime"]').val();
    nickname = $('input[name="nickname"]').val();
    if (title != '') {
        data += '&title=' + title;
    }
    if (nickname != '') {
        data += '&nickname=' + nickname;
    }
    if (createtime != '') {
        data += '&createtime=' + createtime;
    }
    $('.tabs').empty();
      $.ajax({
          url:'/Admin/Comment/ajaxcomlist/',
          type:'post',
          data:data,
          success:function(s){
            console.log(s);
            if (s == 'unlogin') {
              tishi('登录已失效，请重新登录！1秒后跳转到登录页面！');
              window.setTimeout("window.location='/Admin/Login/login/'", 1000);
            } else if (s == 'unauth') {
              tishi('抱歉，您没有操作权限！');
            } else if(s.list==null || s.list=='') {
              var htmls = "<tbody><tr><th><input id='checkAll' onclick='check_all(this)' type='checkbox' class='tabs-radio' /></th><th>标题</th><th>用户</th><th>邮箱</th>" +
              "<th>IP地址</th><th>发布时间</th><th>操作</th></tr>";
              htmls += "<tr><td style='text-align:center;' colspan='8'><h1>无数据</h1></td></tr>";
            } else {
              var htmls = "<tbody><tr><th><input id='checkAll' onclick='check_all(this)' type='checkbox' class='tabs-radio' /></th><th>标题</th><th>用户</th><th>邮箱</th>" +
              "<th>IP地址</th><th>发布时间</th><th>操作</th></tr>";
              if (s.list == '' || s.list == null) {
                  htmls += "<tr><td style='text-align:center;' colspan='7'>无数据</td></tr>";
              } else {
                  $.each(s.list, function(i, n) {
                      htmls += "<tr>";
                      htmls += "<td>" +
                      "<input id='pro"+ n.id+"' name='pro' type='checkbox' value='" + n.id + "' class='tabs-radio' />" +
                      "</td>";
                      htmls += "<td>" + n.title + "</td>";
                      htmls += "<td>" + n.nickname + "</td>";
                      htmls += "<td>" + n.email + "</td>";
                      htmls += "<td>" + n.last_login_ip + "</td>";
                      htmls += "<td>" + n.createdtime + "</td>";
                      htmls += "<td><a href='/Admin/Comment/detail/id/" + n.id + "/' class='btn btn-green'>详情</a>";
                      htmls += "&nbsp;<a href='#' onclick='deletepic(" + n.id + ");' class='btn btn-green'>删除</a></td>";
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

  function deletepic(id) {
    if (!window.confirm('确定要删除此评论吗?')) {
        return false;
    }
    $.ajax({
       url: "/Admin/Comment/deletecomment/",
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
           getcomlist(1);
         } else {
           tishi("删除失败！");
         }
       }
     })
  }

function check_all(obj){
    $(".tabs input[type='checkbox']").prop('checked', $(obj).prop('checked'));
}
