//关联人员
var mobile= $("#input-group-addon01");
    mobile.live("click",function(){
        $(".layer_bg01").show();
        $(".layer_wrap01").show();
    })
$("#mobile_search table tbody tr:not(:first)").live("dblclick",function(){
    var userid = $("input[name=userid]").val();        //关联人员ID
    useridval = userid + "|" + $(this).children("td").eq(0).text(); //拼接
    $("input[name=userid]").val(useridval);
    $("#userlist").children("tbody").append($(this));
    $("#userlist").attr('class', 'tabs');
    $(".error").empty();
    $(".layer_bg01").hide();
    $(".layer_wrap01").hide();
})

//关联产品
var product = $("#input-group-addon02");
    product.live("click",function(){
        $(".layer_bg02").show();
        $(".layer_wrap02").show();
    })
$("#product_search table tbody tr:not(:first)").live("dblclick",function(){
    var productid = $("input[name=productid]").val();
    productidval = productid + "|" + $(this).children("td").eq(0).text();
    $("input[name=productid]").val(productidval);//关联产品ID
    var newtr = $(this).prev("tr").attr("style", "");
    $("#productlist").children("tbody").append(newtr);//关联产品简称
    $("#productlist").attr('class', 'tabs');
    $(this).empty();
    $(".error").empty();
    $(".layer_bg02").hide();
    $(".layer_wrap02").hide();
})

//根据手机号码搜索账户信息 ---- 关联人员
function selectuserbymobile(){
    $(".clearmoblie table tbody").empty();
    var mobilekey = $('#mobilekey').val();
    $.ajax({
        url: "./?m=Admin&c=order&a=ajaxsearchassumeord",
        data: "&mobilekey=" + mobilekey,
        type: "post",
        success: function (s) {
            var htmls = '<tr class="firsttr"><th style="display:none"></th>' +
                    '<th>姓名</th><th>手机</th>' +
                    '<th>性别</th><th>属性</th></tr>'
                ;
            if (s != '' || s.length != 0) {
                $.each(s, function (i, n) {
                    htmls += "<tr>";
                    htmls += "<td style='display:none'>" + n.id + "</td>";
                    htmls += "<td>" + n.realname + "</td>";
                    htmls += "<td>" + n.mobilephone + "</td>";
                    htmls += "<td>" + n.sex + "</td>";
                    htmls += "<td>" + n.type + "</td>";
                    htmls += "</tr>";
                });
            }
            $('#insertempmobile').find('tbody').html(htmls);
        },
        error: function (xml) {
            tishi(xml);
        }
    });
}

//根据手机号码搜索账户信息 ---- 关联产品
function selectproduct(){
    $(".clearproduct table tbody").empty();
    var prokey = $('#productkey').val();
    $.ajax({
      url: "./?m=Admin&c=order&a=ajaxsearchproord",
      data: "&prokey="+prokey,
      type: "post",
      success:function(s){
          var htmls ='<tr class="firsttr"><th style="display:none"></th><th style="display:none"></th><th style="display:none">产品名称</th>' +
              '<th>产品名称</th>'+'<th>产品经理</th><th>销售状态</th>'+'<th>产品类型</th></tr>';
          if(s != '' || s.length != 0){
              $.each(s, function(i, n){
                  htmls += "<tr style='display:none'><td>" + n.proname + "</td></tr>"
                  htmls += "<tr>";
                  htmls += "<td style='display:none'>" +n.productid+"</td>";
                  htmls += "<td style='display:none'>" +n.id+"</td>";
                  htmls += "<td style='display:none'>" + n.proname + "</td>";
                  if((n.proname != '') && (n.proname != null) && (n.proname != undefined) ){
                      htmls += "<td>"+n.proname+"</td>";
                  }else{
                      htmls += "<td></td>";
                  }
                  if((n.promanagername != '') && (n.promanagername != null) && (n.promanagername != undefined) ){
                      htmls += "<td>"+n.promanagername+"</td>";
                  }else{
                      htmls += "<td></td>";
                  }
                  htmls += "<td>"+n.salestatus+"</td>";
                  htmls += "<td>"+n.protype+"</td>";
                  htmls += "</tr>";
              });
          }
          $('#insertproduct').find('tbody').html(htmls);
      },
      error:function(xml){
          tishi(xml);
      }
    });
}

//查找
function selOrd(e){
    $('input[name=]').val(s.a);//渠道理财师
    $('input[name=]').val(s.a);//产品名称
    $('input[name=]').val(s.a);//结算方式
    $('input[name=]').val(s.a);//开始时间
    $('input[name=]').val(s.a);//结束时间

    var str =''; str1= ''; str2 =''; str3= ''; str4= ''

    if(cusname.length != 0){
        str1 = "&cusname="+cusname;
    }
    if(assume_fin_manager.length != 0){
        str2 = "&assume_fin_manager="+assume_fin_manager;
    }
    if(orderstatus.length != 0){
        str3 = "&orderstatus="+orderstatus;
    }
    if(proname.length != 0){
        str4 = "&proname="+proname;
    }
    var p = e;//分页
    str = str1+str2+str3+str4+str5+str6+str7+str8;
    console.log(str);

    $.ajax({
        url: "./?m=Admin&c=order&a=ajaxgetordlist",
        data: str+"&p="+p,
        type: "post",
        success:function(s){
          if(s.msg == '登录信息失效，请重新登录！' || s.msg == '抱歉，您没有此权限！'){
              tishi(s.message);
          }else{
              var htmls = '<tr><th width="5%"><input id="checkAll" onclick="check_all()" type="checkbox" class="tabs-radio" /></th>'
                          +'<th width="8%">创建时间</th><th width="10%">客户姓名</th><th width="12%">产品名称</th><th width="10%">理财经理</th>'
                          +'<th width="9%">预约金额(万)</th><th width="9%">打款金额(万)</th>'
                          +'<th width="7%">订单状态</th><th width="7%">冷静期标志</th>'
                          +'<th width="7%">回访标志</th><th width="10%">操作</th></tr>';

              if(s.list == '' || s.list==null){

                  htmls += "<tr>";
                  htmls += "<td colspan='11'><div class='text-center'><div class='iconAll icon-045 mt60'></div><div class='cl-666 mt20 mb60  ft20 bold'>您还没有创建过订单，您可以点击“录入”来建立！</div></div></td>";
                  htmls += "</tr>";


              }else{
                  $.each(s.list, function(i, n){
                      htmls += "<tr>";
                      htmls += "<td><input name='ord' type='checkbox' value='"+n.id+"' class='tabs-radio' /></td>";
                      htmls += "<td>"+n.createdtime+"</td>";
                      htmls += "<td>"+n.cusname+"</td>";
                      htmls += "<td class='text-left'>"+n.proname+"</td>";

                      if(n.cur_fin_manager != null){
                          htmls += "<td>"+n.cur_fin_manager+"</td>";
                      }else{
                          htmls += "<td></td>";
                      }
                      if(n.reservationamount != null){
                          htmls += "<td>"+n.reservationamount+"</td>";
                      }else{
                          htmls += "<td></td>";
                      }

                      if(n.payamount != null){
                          htmls += "<td>"+n.payamount+"</td>";
                      }else{
                          htmls += "<td></td>";
                      }
                          htmls += "<td>"+n.orderstatus+"</td>";
                          htmls += "<td>"+n.cooling_period_flg+"</td>";
                          htmls += "<td>"+n.follow_up_flg+"</td>";

                          var str1 = 'return orddel("'+ n.orderstatus +'");';
                          htmls += "<td><a href='./?m=Admin&c=order&a=orderdetail&eid=" + n.id + " '>详情</a> | <a href='./?m=Admin&c=order&a=deleteorder&eid=" + n.id + "onclick=''>删除</a></td>";
                          htmls += "</tr>";
                  });
              }
              $(".tabs").html(htmls);
              if(s.page != ''){
                  $("#kkpager").html(s.page);
              }
          }

        },
        error:function(xml){
            tishi(xml);
        }
    });
}
