//评论操作
$(document).ready(function() {
    articleid = $("input[name=articleid]").val();
    getcomment(articleid);
    $("#CommentForm").submit(function() {
        nickname = $("#nickname").val();
        email = $("#email").val();
        layedit.sync(layeditIndex);
        comment = $("textarea[name=comment]").val();
        $.ajax({
          url:'/Home/Comment/add/',
          type:'post',
          data:{articleid:articleid,nickname:nickname,email:email,comment:comment},
          success:function(s){
              console.log(s);
              if (s == "成功" || s == "评论成功！" || s == "添加成功") {
                getcomment(articleid)
                alert('发表成功');
              } else {
                alert(s);
              }
          }
        })
        return false;
    });

})

/*加载评论模块*/
function getcomment(articleid) {
  var htmls = '';
  $.ajax({
    url:'/Home/Comment/getcomment/',
    type:'post',
    data:{id:articleid},
    success:function(s){
      if (s.list !== '' && s.list !== null) {
        $.each(s.list, function(i, n) {
          htmls += '<li><div class="blog-detail-comment-user">';
          htmls += '<span class="blog-detail-comment-user-nickname">' + n.nickname + '</span>';
          htmls += '<span class="blog-detail-comment-user-time">' + n.createdtime + '</span>';
          htmls += '</div><div class="blog-detail-comment-content">' + n.content + '</div>';
          htmls += '</li>';
        });
      }
      $(".blog-detail-comment-list").html(htmls);
    }
  })
}

//处理点赞功能
$(function() {
  $(".heart").on("click", function() {
    $(this).toggleClass("is-active");
    if ($("#favourites").is('.is-active')) {
      $.ajax({
        url:'/Home/Article/changefavourites/',
        type:'post',
        data:{id:articleid,type:1},
        success:function(s){
          $("#changelove").html(s);
        }
      })
    } else {
      $.ajax({
        url:'/Home/Article/changefavourites/',
        type:'post',
        data:{id:articleid,type:2},
        success:function(s){
          $("#changelove").html(s);
        }
      })
    }
  });
});
