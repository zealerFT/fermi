//author：fermi
//文章详情
$(document).ready(function() {
    blogid = $("#blogid").val();
    blogpicture(blogid);
    $("#BlogSubmit").click(function() {
        layedit.sync(layeditIndex); //layui:用于同步编辑器内容到textarea
        $("#BlogForm").ajaxSubmit(options);
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
              tishi(s + "，1秒后跳转到文章列表！");
              window.setTimeout("window.location='/Admin/Blog/index/'", 1000);
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
        if($("input[name=littletitle]").val() == ''){
            tishi('请填写小标题！');
            return false;
        }
        if($("input[name=author]").val() == ''){
            tishi('请填写作者！');
            return false;
        }
        if($("input[name=blogtype]").val() == ''){
            tishi('请选择文章类型！');
            return false;
        }
        if($("input[name=bloglabel]").val() == ''){
            tishi('请选择文章标签！');
            return false;
        }
    }

})
//文章配图
function blogpicture(id) {
    $(".addpic").empty();
    $.ajax({
        url: "/Admin/Blog/getpic/",
        data: "&id=" + id,
        type: "post",
        success: function(s) {
          var htmls = '';
          if (s == 'unlogin') {
            tishi('登录已失效，请重新登录！2秒后跳转到登录页面！');
            window.setTimeout("window.location='/Admin/Login/login/'", 2000);
          } else if (s == 'unauth') {
            tishi('抱歉，您没有权限查看配图！');
          } else if(s.picture == '' || s.picture == null) {
          } else {
              $.each(s.picture, function(i, n) {
                  htmls += '<label class=""><div class="fileList" >';
                  htmls += '<img  id="deletepic" picname="' + n + '" class="iconAll_add" src="/Upload/' + n + '">';
                  htmls += '</div></label>';
              });
          }
          $(".addpic").append(htmls);
        }
    });
}
//删除配图
$(document).on("dblclick", "#deletepic", function() {
    if (!window.confirm('确定要删除此图片吗?')) {
        return false;
    }
    var picname = $(this).attr('picname');
    $.ajax({
        url: "/Admin/Blog/deletepic/",
        data: "&id=" + blogid + "&picname=" + picname,
        type: "post",
        success: function(s) {
          if (s == 'unlogin') {
            tishi('登录已失效，请重新登录！2秒后跳转到登录页面！');
            window.setTimeout("window.location='/Admin/Login/login/'", 2000);
          }
          if (s == 'unauth') {
            tishi('抱歉，您没有操作权限！');
          } else if(s == 'success'){
            blogpicture(blogid);
          } else {
            tishi('删除失败');
          }
        }
    });
});
/*图片添加*/
var content = $(".content");
var adder = content.find(".adder");
var nav = content.find(".nav");
adder.each(function(i) {
    adder.eq(i).click(function() {
        var add_label = $('.add_label');
        var num = add_label.length;
        if (num == 30) {
            adder.eq(i).hide();
        } else {
            var num1 = num;
            var filename_id = 'file_name' + num1;
            var preview_id = 'preview' + num1;
            var htmls = "<label class='add_label'><div class='fileList' id='" + preview_id + "'><img class='iconAll_add'/>";
            htmls += "</div><input type='file' id='" + filename_id + "' name='filedata[]'  onchange=" +
                    "previewImage(this,'" + filename_id + "','" + preview_id + "') /></label>";
            var apppic = 'add_labe' + i;
            var obj = $('.' + apppic + '');
            obj.before(htmls);
        }
    });
});
/*文件上传图片预览-小图*/
function previewImage(file, viewid, nameid)
{
    var MAXWIDTH = 130;
    var MAXHEIGHT = 79;
    var div = document.getElementById(nameid);
    if (file.files && file.files[0])
    {
        div.innerHTML = '<img id=' + viewid + '>';
        var img = document.getElementById(viewid);
        img.onload = function() {
            var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
            img.width = 240;
            img.height = 150;
        };
        var reader = new FileReader();
        reader.onload = function(evt) {
            img.src = evt.target.result;
        }
        reader.readAsDataURL(file.files[0]);
    }
    else {
        var sFilter = 'filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
        file.select();
        var src = document.selection.createRange().text;
        div.innerHTML = '<img id=imghead>';
        var img = document.getElementById('imghead');
        img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
        var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
        status = ('rect:' + rect.top + ',' + rect.left + ',' + rect.width + ',' + rect.height);
        div.innerHTML = "<div id=divhead style='width:" + rect.width + "px;height:" + rect.height + "px;margin-top:" + rect.top + "px;" + sFilter + src + "\"'></div>";
    }
}
/*图片缩放*/
function clacImgZoomParam(maxWidth, maxHeight, width, height) {
    var param = {top: 0, left: 0, width: width, height: height};
    if (width > maxWidth || height > maxHeight)
    {
        rateWidth = width / maxWidth;
        rateHeight = height / maxHeight;

        if (rateWidth > rateHeight)
        {
            param.width = maxWidth;
            param.height = Math.round(height / rateWidth);
        } else
        {
            param.width = Math.round(width / rateHeight);
            param.height = maxHeight;
        }
    }
    param.left = Math.round((maxWidth - param.width) / 2);
    param.top = Math.round((maxHeight - param.height) / 2);
    return param;
}
