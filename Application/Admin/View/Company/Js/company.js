/*弹出经理框*/
//添加经理
function addmanager() {
    $('#form2').attr('action','./?m=Admin&c=company&a=savemanagerinfo');
    $('#date3').val('');
    $('#date4').val('');
    $('#date5').val('');
    $('#date6').val('');
    $('#educationlevel').text('请选择');
    $('#post').text('请选择');
    $('#bbackground').text('请选择');
    $('input[name=educationlevel]').val('');
    $('input[name=post]').val('');
    $('input[name=bbackground]').val('');
    $('input[name=managerinfoid]').val('');
    $('input[name=psname]').val('');
    $('textarea[name=professionaltitles]').val('');
    $('textarea[name=remark]').val('');
    $(".layer_bg03").show();
    $(".layer_wrap03").show();
}
//修改经理
function editmanager(e){
  var eid = e;
  if (eid) {
    //修改
    $.ajax({
          url: "./?m=Admin&c=company&a=getmanagerinfodetail",
          data: "&eid=" + eid,
          type: "post",
          success:function(s){
            //console.log(s);
            $("#manageadd").empty();
            $("#manageadd").html(s);
            $(".layer_bg03").show();
            $(".layer_wrap03").show();
          }
      });
  }
};


//担当理财师信息弹出框
$(document).ready(function(){
  //加载公司简介预览图
  var picid = $('input[name=comid]').val();  //公司主页ID
  compropic(picid);
  investphipic(picid);
  //加载投资理念预览图
  //基金经理列表
  managelist(1);
  //基金经理
  var option2 = {
        beforeSubmit: showRequest2,
        success: function(s){
            tishi(s.msg);
            if(s.msg == "成功" || s.msg == "基金经理修改成功" || s.msg == "基金经理添加成功"){
                //window.setTimeout("window.location='./?m=Admin&c=company&a=company'",1000);
                $(".layer_bg03").hide();
                $(".layer_wrap03").hide();
                managelist(1);
            }
        }
    };
  $("#ManagerAjaxSubmit").click(function(){
      $("#form2").ajaxSubmit(option2);
      return false;
  });

 //公司主页
 var options = {
       beforeSubmit: showRequest,
       success: function(s){
           tishi(s.msg);
           if(s.msg == "成功" || s.msg == "修改成功" || s.msg == "添加成功"){
               window.setTimeout("window.location='./?m=Admin&c=company&a=company'",1000);
               //managelist(1);
           }
       }
   };
  $("#btnAjaxSubmit").click(function(){
      $("#form1").ajaxSubmit(options);
      return false;
  });

  //添加、修改公告详情
  var announmt = {
      beforeSubmit: showRequest3,
      success:function (s) {
          tishi(s.msg);
          if(s.msg == "成功" || s.msg == "公告修改成功" || s.msg == "公告添加成功"){
              $(".layer_bg04").hide();
              $(".layer_wrap04").hide();
              noticelist();
          }
      }
  };
  $('#announmtform').ajaxForm(announmt);


  function showRequest(){
      var compro = $("#textarea1").val();
      var investphilosophy = $("#textarea2").val();
      var companysvision = $("#textarea3").val();
      var contactus = $("#textarea4").val();
      //表单提交前验证
      if(compro == ''|| compro.length== 0){
          tishi('公司简介不能为空');
          return false;
      }
      if(investphilosophy == ''|| investphilosophy.length==0){
          tishi('投资理念不能为空');
          return false;
      }
      if(companysvision == ''|| companysvision.length==0){
          tishi('公司愿景不能为空');
          return false;
      }
      if(contactus == '' || contactus.length==0){
        tishi('联系我们不能为空');
        return false;
      }
  }

  function showRequest2(){
      var psname = $('input[name=psname]').val();
      var begindate = $('input[name=begindate]').val();
      var birthday = $('input[name=birthday]').val();
      var finpdate = $('input[name=finpdate]').val();
      var enddate = $('input[name=enddate]').val();
      var post = $('input[name=post]').val();
      var bbackground = $('input[name=bbackground]').val();
      var educationlevel = $('input[name=educationlevel]').val();
      //表单提交前验证
      if(psname == ''|| psname.length== 0){
          tishi('姓名不能为空');
          return false;
      }
      if(begindate == ''|| begindate.length==0){
          tishi('任职日期不能为空');
          return false;
      }
      if(post == '' || post.length==0){
        tishi('职务不能为空');
        return false;
      }
      if(bbackground == '' || bbackground.length==0){
        tishi('履历背景不能为空');
        return false;
      }
      if(educationlevel == '' || educationlevel.length==0){
        tishi('教育程度不能为空');
        return false;
      }
      if (birthday.search(/^(19|20)\d{2}-(0?\d|1[012])-(0?\d|[12]\d|3[01])$/) == -1){
        tishi("请输入正确的出生生日格式，例如：2008-08-08");
        return false;
      }
      if (finpdate.search(/^(19|20)\d{2}-(0?\d|1[012])-(0?\d|[12]\d|3[01])$/) == -1){
        tishi("请输入正确的从业日期格式，例如：2008-08-08");
        return false;
      }
      if (begindate.search(/^(19|20)\d{2}-(0?\d|1[012])-(0?\d|[12]\d|3[01])$/) == -1){
        tishi("请输入正确的任职日期格式，例如：2008-08-08");
        return false;
      }
      /*if (enddate.search(/^(19|20)\d{2}-(0?\d|1[012])-(0?\d|[12]\d|3[01])$/) == -1){
        tishi("请输入正确的离职日期格式，例如：2008-08-08");
        return false;
      }*/
  }

  function showRequest3(){
      var declaredate = $('input[name=declaredate]').val();
      var announmt_type = $('input[name=announmt_type]').val();
      var announmtid = $('input[name=announmtid]').val();
      //表单提交前验证
      if(declaredate == ''|| declaredate.length== 0){
          tishi('公告日期不能为空');
          return false;
      }
      if(announmt_type == ''|| announmt_type.length==0){
          tishi('公告类型不能为空');
          return false;
      }
      if (declaredate.search(/^(19|20)\d{2}-(0?\d|1[012])-(0?\d|[12]\d|3[01])$/) == -1){
        tishi("请输入正确的公告日期格式，例如：2008-08-08");
        return false;
      }
      if(announmtid == ''|| announmtid.length==0){
          tishi('公告编码不能为空');
          return false;
      }
  }

  function managelist(e) {
    var p = e;//分页
    $.ajax({
        url: "./?m=Admin&c=company&a=getmanagerinfoList",
        data: "&p="+p,
        type: "post",
        success:function(s){
          if(s.msg == '登录信息失效，请重新登录！' || s.msg == '抱歉，您没有此权限！'){
              tishi(s.message);
          }else{
              var htmls = '<tr><th>姓名</th><th>职位</th><th>操作</th></tr>';
              if(s.list == '' || s.list==null){
                  htmls += "<tr>";
                  htmls += "<td colspan='11'><div class='text-center'><div class='iconAll icon-045 mt60'></div><div class='cl-666 mt20 mb60  ft20 bold'>您还没有创建过基金经理，您可以点击“录入”来建立！</div></div></td>";
                  htmls += "</tr>";
              }else{
                  $.each(s.list, function(i, n){
                      htmls += "<tr>";
                      htmls += "<td>"+n.PSNAME+"</td>";
                      htmls += "<td>"+n.POST+"</td>";
                      htmls += "<td><a href='javascript:void(0);' onclick='editmanager(" + n.ID + ");'>详情</a> | ";
                      htmls += "<a href='javascript:void(0);'" + "onclick='delmanager(" + n.ID + ");'>删除</a></td>";
                      htmls += "</tr>";
                  });
              }
              $(".tabs1").html(htmls);
              if(s.page != ''){
                  $(".kkpager1").html(s.page);
              }
          }
        }
    });
  }

  $(document).on("dblclick","#deletepic1",function(){
      if(!window.confirm('确定要删除此图片吗?')){
          return false;
      }
      var picname = $(this).attr('picname');
      console.log(picname);
      $.ajax({
          url: "./?m=Admin&c=company&a=deletecompropic",
          data: "&id=" + picid + "&picname=" + picname,
          type: "post",
          success: function (s) {
            //console.log(s.old_compropic);
              tishi(s.msg);
              if(s.msg == '图片删除成功!'){
                $('input[name=old_compropic]').attr('value', s.old_compropic);
                  compropic(picid);
              }
          }
      });
  });


  $(document).on("dblclick","#deletepic2",function(){
      if(!window.confirm('确定要删除此图片吗?')){
          return false;
      }
      var picname = $(this).attr('picname');
      console.log(picname);
      $.ajax({
          url: "./?m=Admin&c=company&a=deleteinvestphipic",
          data: "&id=" + picid + "&picname=" + picname,
          type: "post",
          success: function (s) {
            //console.log(s.old_invest);
              tishi(s.msg);
              if(s.msg == '图片删除成功!'){
                $('input[name=old_invest]').attr('value', s.old_invest);
                  investphipic(picid);
              }
          }
      });
  });

});



//获取基金公告信息
function noticelist(){
    var htmls = "<a class='btn btn-green mb20' onclick='addannounmt()'>添加公告</a>";
    $('#announmt').parent().prev().html(htmls);
    compannounmtlist(1);
}

//获取基金列表信息
function compannounmtlist(e){
    $.ajax({
        url: "./?m=Admin&c=company&a=getcompannounmtlist",
        data: "&p=" + e,
        type: "post",
        success: function (s) {
            console.log(s);
            if(s.msg == '登录信息失效，请重新登录！' || s.msg == '抱歉，您没有此权限！'){
                tishi(s.message);
            } else {
              var htmls = "<tr><th >公告时间</th><th>公告类型</th><th>标题</th><th>附件</th><th>操作</th></tr>";
              if(s.list == '' || s.list == null){
                  htmls += "<tr><td style='text-align:center;' colspan='5'>无数据</td></tr>";
              }else{
                  $.each(s.list, function(i, n){
                      htmls += "<tr>";
                      htmls += "<td>"+ n.DECLAREDATE+"</td>";
                      htmls += "<td>"+ n.TYPE+"</td>";
                      htmls += "<td>"+ n.TITLE+"</td>";
                      if (n.SOURCELINK == null || n.SOURCELINK == '') {
                        htmls += "<td><span class='glyphicon glyphicon-download-alt'></span></td>";
                      } else {
                        htmls += "<td><a href='./?m=Admin&c=company&a=downfile&id="+ n.ID +"'><span class='glyphicon glyphicon-download-alt'></span></a></td>";
                      }
                      htmls += "<td><a href='#' onclick='return updateannounmt("+ n.ID +");' class='btn btn-green'>详情</a>";
                      htmls += "&nbsp;<a href='#' onclick='return deleteannounmt("+ n.ID +");' class='btn btn-green'>删除</a></td>";
                      htmls += "</tr>";
                  });
              }
              $("#announmt").html(htmls);
              if(s.page != ''){
                  $(".kkpager3").html(s.page);
              }
            }
        }
    });
}


//添加公告信息
function addannounmt(){
    $('#date8').val('');
    $('#announmtType').text('请选择');
    $('input[name=announmt_type]').val('');
    $('input[name=title]').val('');
    $('textarea[name=content]').val('');
    $('input[name=announmtid]').val('');
    $('textarea[name=memo]').val('');
    $('#noticeid').val('');
    //清空文件上传file内容兼容火狐
    $("#sourcefile").empty();
    var htmls = '<input type="file" name="sourcefile" class="filestyle btn btn-green mr20" data-badge="false">';
    htmls += '<script>$(":file").filestyle({input:false});</script>';
    $("#sourcefile").html(htmls);
    $('#announmtform').attr('action','./?m=Admin&c=company&a=savecompannounmt');

    $(".layer_bg04").show();
    $(".layer_wrap04").show();
}
//修改公告信息
function updateannounmt(id){
    $('#date8').val('');
    $('#announmtType').text('请选择');
    $('input[name=announmt_type]').val('');
    $('input[name=title]').val('');
    $('textarea[name=content]').val('');
    $('input[name=announmtid]').val('');
    $('textarea[name=memo]').val('');
    $('#noticeid').val(id);
    //清空文件上传file内容兼容火狐
    $("#sourcefile").empty();
    var htmls = '<input type="file" name="sourcefile" class="filestyle btn btn-green mr20" data-badge="false">';
    htmls += '<script>$(":file").filestyle({input:false});</script>';
    $("#sourcefile").html(htmls);
    $('#announmtform').attr('action','./?m=Admin&c=company&a=updatecompannounmt');
    //获取详情
    $.ajax({
        url: "./?m=Admin&c=company&a=getcompannounmtdetail",
        data: "&id=" + id,
        type: "post",
        success: function (s) {
            console.log(s);
            if(s!=''){
                $('#date8').val(s.DECLAREDATE);
                $('#announmtType').text(s.TYPE);
                //$('input[name=announmtType]').val(s.TYPE);
                $('input[name=announmt_type]').val(s.typeValue);
                $('input[name=announmtid]').val(s.ANNOUNMTID);
                $('input[name=title]').val(s.TITLE);
                $('textarea[name=content]').val(s.CONTENT);
                $('textarea[name=memo]').val(s.MEMO);
                $('input[name=noticeid]').val(s.ID);
                $('input[name=sourcelink]').val(s.SOURCELINK);
            }
        }
    });

    $(".layer_bg04").show();
    $(".layer_wrap04").show();
    return false;
}
//删除公告信息
function deleteannounmt(id){
    if(!window.confirm('你确定要删除此公告吗？')){
        return false;
    }
    $.ajax({
        url: "./?m=Admin&c=company&a=deletecompannounmt",
        data: "&eid=" + id,
        type: "post",
        success: function (s) {
            tishi(s.msg);
            if(s.msg == '公告删除成功!'){
                noticelist(1);
            }
        },
        error: function (xml) {
            tishi(xml);
        }
    });
    return false;
}

///////////////////////////////////////////招聘啊
function saverecruit() {
   var recruitid = $('input:radio[name="radio"]:checked').val();  //当前选中招聘主键ID
   if (recruitid == '' || recruitid == null) {
     tishi("请先选择一条招聘信息,再进行编辑或添加操作！");
     return false;
   }
   var position = $('input:radio[name="radio"]:checked').parent().next(".supervise-text").children().children('#position').val();
   var enddate = $('input:radio[name="radio"]:checked').parent().next(".supervise-text").children().eq(1).children('.enddate').val();
   var content = $('input:radio[name="radio"]:checked').parent().next(".supervise-text").children().eq(2).children('#content').val();
   var requirements = $('input:radio[name="radio"]:checked').parent().next(".supervise-text").children().eq(3).children('#requirements').val();
   console.log(recruitid);
   //拼接参数
   var str =''; str1= ''; str2 =''; str3= ''; str4= ''
   if(position.length != 0){
     str1 = "&position="+position;

   }
   if(enddate.length != 0){
      str2 = "&enddate="+enddate;
   }
   if(content.length != 0){
     str3 = "&content="+content;
   }
   if(requirements.length != 0){
     str4 = "&requirements="+requirements;
   }
   //var p = e;//分页
   str = str1+str2+str3+str4;
   if (recruitid == 'add') {
     //添加
     //console.log("添加");
     $.ajax({
           url: "./?m=Admin&c=company&a=saverecruitment",
           data: {position:position, enddate:enddate, content:content, requirements:requirements},
           type: "post",
           dataType: "json",
           success:function(s){
             tishi(s.msg);
             if(s.msg == "成功" || s.msg == "招聘信息添加成功"){
                 recruitlist();
             }
           }
       });
   } else{
      //console.log("编辑");
      //有id编辑
      $.ajax({
            url: "./?m=Admin&c=company&a=updaterecruitment",
            data: {position:position, enddate:enddate, content:content, requirements:requirements, recruitid:recruitid},
            type: "post",
            dataType: "json",
            success:function(s){
              tishi(s.msg);
              if(s.msg == "成功" || s.msg == "招聘信息修改成功"){
                  recruitlist();
              }
            }
        });
   }
}

//获取招聘信息列表
function recruitlist(){
    var html = '<div class="clearfix s-top"><a class="btn btn-button pull-left mr20 btn-remove" onclick="deleterecruit();" href="javascript:void(0);"><i class="iconAll icon-060"></i>删除</a><a class="btn btn-button pull-left mr20 " onclick="saverecruit();" href="javascript:void(0);"><i class="iconAll icon-01"></i>保存</a></div>';
    html += '<div class="textatea-box" id="recruitbox"></div>';
    $('.supervise-three').html(html);
    getrecruitlist(1);
}

//招聘信息列表
function getrecruitlist(e) {
  var p = e;//分页
  $.ajax({
      url: "./?m=Admin&c=company&a=getrecruitmentlist",
      data: "&p=" + p,
      type: "post",
      success: function (s) {
          console.log(s);
          if(s.msg == '登录信息失效，请重新登录！' || s.msg == '抱歉，您没有此权限！'){
              tishi(s.message);
          } else {
            var htmls = "";
            var htmls = "<div>";
            htmls += "<label><input type='radio' name='radio' value='add' class='radio'></label>";
            htmls += "<div class='supervise-text'><div><p>招聘岗位：</p><input type='text' id='position' name='position' class='input-text'></div>";
            htmls += "<div><p>截止日期：</p><input id='date7'  type='text' name='enddate' class='input-text enddate'></div>";
            htmls += "<div><p>岗位描述：</p><textarea id='content' name='content'></textarea></div><div><p>任职要求：</p><textarea id='requirements' name='requirements'></textarea></div>";
            htmls += "</div></div>";
            htmls += '<script>jeDate({dateCell:"#date7",format:"YYYY-MM-DD",isTime:false,minDate:"1900-01-01"})</script>';
            if(s.list == '' || s.list == null){

            }else{
                $.each(s.list, function(i, n){
                    var dateint = parseInt(n.ID) + 8;  //用来给每个信息绑定date插件弹窗
                    htmls += '<script>jeDate({dateCell:"#date' + dateint + '",format:"YYYY-MM-DD",isTime:false,minDate:"1900-01-01"})</script>';
                    htmls += "<div>";
                    htmls += "<input type='hidden' name='recruitid' class='input-text' value='" + n.ID + "'>"
                    htmls += "<label><input type='radio' name='radio' value='" + n.ID + "' class='radio'></label>";
                    htmls += "<div class='supervise-text'><div><p>招聘岗位：</p><input type='text' id='position' name='position' class='input-text' value='" + n.position + "'></div>";
                    htmls += "<div><p>截止日期：</p><input id='date" + dateint + "'  type='text' name='enddate' class='input-text enddate' value='" + n.enddate + "'></div>";
                    htmls += "<div><p>岗位描述：</p><textarea id='content' name='content'>" + n.content + "</textarea></div><div><p>任职要求：</p><textarea id='requirements' name='requirements'>" + n.requirements + "</textarea></div>";
                    htmls += "</div></div>";
                });
            }
            $("#recruitbox").append(htmls);
            if(s.page != ''){
                $(".kkpager3").html(s.page);
            }
          }
      }
  });
}

//删除公告信息
function deleterecruit(){
    var recruitid = $('input:radio[name="radio"]:checked').val();  //当前选中招聘主键ID
    if (recruitid == '' || recruitid == null) {
      tishi("请先选择一条存在的招聘信息,再进行删除操作！");
      return false;
    }
    if (recruitid == 'add') {
      tishi("请先选择一条存在的招聘信息,再进行删除操作！");
      return false;
    }
    if(!window.confirm('你确定要删除此招聘信息吗？')){
        return false;
    }
    $.ajax({
        url: "./?m=Admin&c=company&a=deleterecruitment",
        data: "&recruitid=" + recruitid,
        type: "post",
        success: function (s) {
            tishi(s.msg);
            if(s.msg == '招聘信息删除成功!'){
                recruitlist();
            }
        },
        error: function (xml) {
            tishi(xml);
        }
    });
    return false;
}

//公司简介图
function compropic(id) {
    $(".addpic1").empty();
    $.ajax({
        url: "./?m=Admin&c=company&a=getcompropic",
        data: "&id=" + id,
        type: "post",
        success: function (s) {
          htmls = '';
          if(s.compropic_name == '' || s.compropic_name == null){

          }else{
            $.each(s.compropic_name, function(i, n){
              htmls += '<label class=""><div class="fileList" >';
              htmls += '<img  id="deletepic1" picname="' + n + '" class="iconAll icon-055" src="' + s.compropic_url + n + '">';
              htmls += '</div></label>';
            });
          }
          $(".addpic1").append(htmls);
        }
    });
}

//投资理念图
function investphipic(id) {
  $(".addpic2").empty();
  $.ajax({
      url: "./?m=Admin&c=company&a=getinvestphipic",
      data: "&id=" + id,
      type: "post",
      success: function (s) {
        htmls = '';
        if(s.investphipic_name == '' || s.investphipic_name == null){

        }else{
          $.each(s.investphipic_name, function(i, n){
            htmls += '<label class=""><div class="fileList" >';
            htmls += '<img id="deletepic2" picname="' + n + '" class="iconAll icon-055" src="' + s.investphipic_url + n + '">';
            htmls += '</div></label>';
          });
        }
        $(".addpic2").append(htmls);
      }
  });
}


/*下载图片*/
function downfile(e) {
  var proid = e;
  $.ajax({
      url: "./?m=Admin&c=company&a=downfile",
      data: "&id=" + proid,
      type: "post",
      success: function (s) {
        tishi(s);
      }
  });
}

/*图片添加*/
var content = $(".content");
var adder = content.find(".adder");
var nav = content.find(".nav");
adder.each(function(i){
    adder.eq(i).click(function(){
        var add_label = $('.add_label');
        var num = add_label.length;
        if(num==30){
            adder.eq(i).hide();
        }else {
            var num1 = num;
            var filename_id = 'file_name' + num1;
            var preview_id = 'preview' + num1;
            var htmls = "<label class='add_label'><div class='fileList' id='" + preview_id + "'><img class='iconAll icon-055'/>";
            htmls += "</div><input type='file' id='" + filename_id + "' name='aptitude_file_names"+i+"[]'  onchange=" +
                    "previewImage(this,'" + filename_id + "','" + preview_id + "') /></label>";
            //nav.eq(i).before(htmls);
            var apppic = 'add_labe' + i;
            var obj = $('.' + apppic + '');
            console.log(apppic);
            obj.before(htmls);
        }
    });
});

/*文件上传图片预览-小图*/
function previewImage(file,viewid,nameid)
{
    var MAXWIDTH  = 130;
    var MAXHEIGHT = 79;
    var div = document.getElementById(nameid);
    if (file.files && file.files[0])
    {
        div.innerHTML ='<img id='+viewid+'>';
        var img = document.getElementById(viewid);
        img.onload = function(){
            var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
            img.width  =  240;
            img.height =  150;
        };
        var reader = new FileReader();
        reader.onload = function(evt){img.src = evt.target.result;}
        reader.readAsDataURL(file.files[0]);
    }
    else{
        var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
        file.select();
        var src = document.selection.createRange().text;
        div.innerHTML = '<img id=imghead>';
        var img = document.getElementById('imghead');
        img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
        var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
        status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
        div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;"+sFilter+src+"\"'></div>";
    }
}
/*图片缩放*/
function clacImgZoomParam( maxWidth, maxHeight, width, height ){
    var param = {top:0, left:0, width:width, height:height};
    if( width>maxWidth || height>maxHeight )
    {
        rateWidth = width / maxWidth;
        rateHeight = height / maxHeight;

        if( rateWidth > rateHeight )
        {
            param.width =  maxWidth;
            param.height = Math.round(height / rateWidth);
        }else
        {
            param.width = Math.round(width / rateHeight);
            param.height = maxHeight;
        }
    }

    param.left = Math.round((maxWidth - param.width) / 2);
    param.top = Math.round((maxHeight - param.height) / 2);
    return param;
}
