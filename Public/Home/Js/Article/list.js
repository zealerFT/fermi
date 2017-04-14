//文章列表操作
getListByType('all', 'all', '1');
function getListByType(type, value, page) {
  if(page == null){
      page = 1;
  }
  var htmls = '';
  var data = 'p=' + page;
  data += '&type=' + type;
  data += '&value=' + value;
  $('#list').empty();
    $.ajax({
        url:'/Home/Article/getArticleByType/',
        type:'post',
        data:data,
        success:function(s){
          console.log(s);
          if (s == 'unlogin') {
            tishi('登录已失效，请重新登录！1秒后跳转到登录页面！');
            window.setTimeout("window.location='/Admin/Login/login/'", 1000);
          } else if (s == 'unauth') {
            tishi('抱歉，您没有操作权限！');
          } else if(s.list == null || s.list == '') {
            htmls += '<li><h2>暂无相关文章</h2></li>';
          }  else if(s.list == 'faker') {
            htmls += '<li><h2>请不要伪造表单！</h2></li>';
          } else {
            if (s.list == '' || s.list == null) {
                htmls += '<li><h2>暂无相关文章</h2></li>';
            } else {
                $.each(s.list, function(i, n) {
                    htmls += '<li><h2>';
                    if (n.type == 1) {
                      htmls += '<a title=' + n.title + ' href="/Home/Article/index/id/' + n.id + '"><span style="color:#009688;">[推荐]</span>' + n.title + '</a>';
                    } else if (n.type == 2) {
                      htmls += '<a title=' + n.title + ' href="/Home/Article/index/id/' + n.id + '"><span style="color:#009688;">[火热]</span>' + n.title + '</a>';
                    } else {
                      htmls += '<a title=' + n.title + ' href="/Home/Article/index/id/' + n.id + '">' + n.title + '</a>';
                    }
                    htmls += '</h2><span class="blog-main-item-time">' + n.createdtime + '</span>';
                    htmls += '</li>';
                });
            }
          }
          $('#list').html(htmls);
          if (s.page != '') {
              $(".kkpager").html(s.page);
          }
        },
    });
}
