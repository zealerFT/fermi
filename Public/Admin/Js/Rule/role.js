//author：fermi
//角色操作
function addrole() {
  $("#roleurl").attr('action', '');
  $("input[name=id]").val('');
  $("input[name=title]").val('');
  $("input[name=name]").val('');
  $("input[name=pid]").val('');
  $('input:radio:checked').attr('checked',false);
  $("#roleurl").attr('action', '/Admin/Rule/role_add');
  $('.layer_bg03').show();
  $('.layer_wrap03').show();
}

function editrole(obj, id, status) {
  $("#roleurl").attr('action', '');
  $("input[name=id]").val('');
  $("input[name=title]").val('');
  $("input[name=name]").val('');
  $("input[name=pid]").val('');
  $('input:radio:checked').attr('checked',false);
  $("input[name=id]").attr('value', id);
  var value = $(obj).attr('title');
  $("input[name=title]").attr('value', value);
  if (status == 1) {
    $("input[name=status]:eq(0)").attr("checked",'checked');
  } else {
    $("input[name=status]:eq(1)").attr("checked",'checked');
  }
  $("#roleurl").attr('action', '/Admin/Rule/role_edit');
  $('.layer_bg03').show();
  $('.layer_wrap03').show();
}
$(document).ready(function(){

  getrolelist();
    $("#ajaxrolesubmit").click(function() {
        $(".ajaxRoleForm").ajaxSubmit(options);
        return false;
    });
    var options = {
        beforeSubmit: showRequest,
        success: function(s) {
          if (s == 'unlogin') {
            tishi('登录已失效，请重新登录！1秒后跳转到登录页面！');
            window.setTimeout("window.location='/Admin/Login/login/'", 1000);
          } else if(s == 'unauth') {
            tishi('抱歉，您没有操作权限！');
          } else if (s == "成功" || s == "修改成功" || s == "添加成功") {
            window.setTimeout("window.location='/Admin/Rule/index/'", 1000);
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
      var val = $('input:radio[name="status"]:checked').val();
      if( val == null ){
          tishi('请选择权限状态！');
          return false;
      }
    }

})

//角色列表
function getrolelist(){
    $('.tabs').empty();
      // 理财产品
      $.ajax({
          url:'/Admin/Rule/role',
          type:'post',
          success:function(s){
            if (s == 'unlogin') {
              tishi('登录已失效，请重新登录！1秒后跳转到登录页面！');
              window.setTimeout("window.location='/Admin/Login/login/'", 1000);
            } else if(s == 'unauth') {
              tishi('抱歉，您没有操作权限！');
            }
              if(s.list==null || s.list==''){
                  var htmls = "<tbody><tr><th colspan='10%'><input id='checkAll' onclick='check_all()' type='checkbox' class='tabs-radio' /></th><th colspan='20%'>操作</th><th colspan='20%'>角色(分组名)</th><th colspan='20%'>状态</th><th colspan='30%' >拥有权限</th>";
                  htmls += "<tr><td style='text-align:center;' colspan='100%'><h1>无数据</h1></td></tr>";
              }else{
                var htmls = "<tbody><tr><th colspan='10%'><input id='checkAll' onclick='check_all()' type='checkbox' class='tabs-radio' /></th><th colspan='20%'>操作</th><th colspan='20%'>角色(分组名)</th><th colspan='20%'>状态</th><th colspan='30%' >拥有权限</th>";
                if (s.list == '' || s.list == null) {
                    htmls += "<tr><td style='text-align:center;' colspan='100%'>无数据</td></tr>";
                } else {
                  var rule = s.rule;  //所有权限对象列表
                    $.each(s.list, function(i, n) {
                        htmls += "<tr>";
                        htmls += "<td colspan='10%'>" +
                        "<input id='pro"+ n.id +"' name='pro' type='checkbox' value='" + n.id + "' class='tabs-radio' />" +
                        "</td>";
                        if (n.id == 1) {
                          htmls += "<td colspan='20%'><font color='red'>超级管理员还是别动了</font></td>";
                        } else {
                          htmls += "<td colspan='20%'>"
                          htmls += "<a href='javascript:void(0);' onclick='deleterole(" + n.id + ");' class='btn btn-green'>删除</a>&nbsp&nbsp"
                          htmls += "<a href='javascript:void(0);' title='" + n.title + "' onclick='editrole(this," + n.id + "," + n.status + ");' class='btn btn-green'>编辑</a>"
                          htmls += "</td>";
                        }
                        htmls += "<td colspan='20%'>" + n.title + "</td>";
                        if (n.status == 1) {
                          htmls += '<td colspan="20%"><i class="layui-icon" style="color: #9ACD32;">&#xe605;</i></td>';
                        } else {
                          htmls += '<td colspan="20%"><i class="layui-icon" style="color: #FF0000;">&#x1006;</i></td>';
                        }
                        htmls += "<td colspan='30%'>";
                        for (var j = 0; j < rule.length ; j++) {
                          //n.selectrule,当前角色所拥有的权限数组
                          //if用来判断当前的权限字符串，是否在当前角色的权限数组里
                            if (n.selectrule.Exists(rule[j].id)) {
                              htmls += "<input type='checkbox' onclick='changerule(" + n.id + "," + rule[j].id + ");' value='" + rule[j].id + "' checked/>";
                            } else {
                              htmls += "<input type='checkbox' onclick='changerule(" + n.id + "," + rule[j].id + ");' value='" + rule[j].id + "' />";
                            }
                            htmls += rule[j].title;
                            htmls += '&nbsp&nbsp';
                            //对当前循环到的权限做取模运算，没5个换行
                            if (j%5 == 4) {
                              htmls += "<br>";
                            }
                        }
                        htmls += "</td>";
                        htmls += "</tr></tbody>";
                    });

                }
              }
              $('.tabs').html(htmls);
          },
      });

}

//判断字符串在不在数组中
Array.prototype.Exists = function(v) {
    var b = false;
    for(var i=0;i<this.length;i++)
    {
      if(this[i]==v)
      {
        b = true;
        break;
      }
    }
    return b;
}

//改成当前权限
function changerule(id, rule) {
    $.ajax({
      url:'/Admin/Rule/changeonerule',
      data:{id:id,rule:rule},
      type:'post',
      success:function(s){
        if (s == 'unlogin') {
          tishi('登录已失效，请重新登录！1秒后跳转到登录页面！');
          window.setTimeout("window.location='/Admin/Login/login/'", 1000);
        } else if(s == 'unauth') {
          tishi('抱歉，您没有操作权限！');
        } else {
          tishi(s.info);
        }
      }
    })
}

function deleterole(id) {
  if (!window.confirm('确定要删除此角色(用户组)吗?')) {
      return false;
  }
  $.ajax({
     url: "/Admin/Rule/role_delete",
     data:{id:id},
     type: "post",
     success: function(s) {
       if (s == 'unlogin') {
         tishi('登录已失效，请重新登录！1秒后跳转到登录页面！');
         window.setTimeout("window.location='/Admin/Login/login/'", 1000);
       } else if(s == 'unauth') {
         tishi('抱歉，您没有操作权限！');
       } else if(s == 'success') {
         tishi("删除成功！");
       } else {
         tishi("删除失败！");
       }
     }
   })
}
