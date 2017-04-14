//author：fermi
//权限操作
function addrule() {
  $("#ruleurl").attr('action', '');
  $("input[name=id]").val('');
  $("input[name=title]").val('');
  $("input[name=name]").val('');
  $("input[name=pid]").val('');
  $('input:radio:checked').attr('checked',false);
  $("input[name=pid]").attr('value', 0);
  $("#ruleurl").attr('action', '/Admin/Rule/add');
  $('.layer_bg03').show();
  $('.layer_wrap03').show();
}

function addsonrule(id, pid) {
  $("#ruleurl").attr('action', '');
  $("input[name=id]").val('');
  $("input[name=title]").val('');
  $("input[name=name]").val('');
  $("input[name=pid]").val('');
  $('input:radio:checked').attr('checked',false);
  $("input[name=pid]").attr('value', id);
  $("#ruleurl").attr('action', '/Admin/Rule/add');
  $('.layer_bg03').show();
  $('.layer_wrap03').show();
}

function editrule(id, pid, status, title, name) {
  $("#ruleurl").attr('action', '');
  $("input[name=id]").val('');
  $("input[name=title]").val('');
  $("input[name=name]").val('');
  $("input[name=pid]").val('');
  $('input:radio:checked').attr('checked', false);
  $("input[name=id]").attr('value', id);
  $("input[name=pid]").attr('value', pid);
  $("input[name=title]").attr('value', title);
  $("input[name=name]").attr('value', name);
  if (status == 1) {
    $("input[name=status]:eq(0)").attr("checked",'checked');
  } else {
    $("input[name=status]:eq(1)").attr("checked",'checked');
  }
  $("#ruleurl").attr('action', '/Admin/Rule/edit');
  $('.layer_bg03').show();
  $('.layer_wrap03').show();
}

$(document).ready(function(){
    $("#ajaxrulesubmit").click(function() {
        $(".ajaxRuleForm").ajaxSubmit(options);
        return false;
    });
    var options = {
        beforeSubmit: showRequest,
        success: function(s) {
          if (s == 'unlogin') {
            tishi('登录已失效，请重新登录！1秒后跳转到登录页面！');
            window.setTimeout("window.location='/Admin/Login/login'", 1000);
          } else if(s == 'unauth') {
            tishi('抱歉，您没有操作权限！');
          } else if (s == "成功" || s == "修改成功" || s == "添加成功") {
              tishi(s);
              window.setTimeout("window.location='/Admin/Rule/index'", 1000);
          } else {
            tishi(s);
          }
        }
    };

    function showRequest() {
      if($("input[name=title]").val() == ''){
          tishi('请填写标题！');
          return false;
      }
      if($("input[name=name]").val() == ''){
          tishi('请填写动作！');
          return false;
      }
      var val = $('input:radio[name="status"]:checked').val();
      if( val == null ){
          tishi('请选择权限状态！');
          return false;
      }
    }

})

function deleterule(id) {
    if (!window.confirm('确定要删除此权限吗?')) {
        return false;
    }
    $.ajax({
       url: "/Admin/Rule/delete",
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
           window.setTimeout("window.location='/Admin/Rule/index'", 1000);
         } else {
           tishi("请选择没有子权限的进行删除，保证操作不影响其他权限！");
         }
       }
     })

}
