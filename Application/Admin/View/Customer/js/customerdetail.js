/**
 * Created by Administrator on 2016/11/28.
 */
function customeradd(){
    adddata = $('#form1').serializeArray();
    console.log(adddata);
    /*必填值验证*/
    //if(adddata[2].value==''){
    //    alert('请填写名称');
    //    $('#proname').focus();
    //    return false;
    //}
    if($('input[name="customerid"]').val()==''){
        var url = './?m=Admin&c=customer&a=customeradd';
    }else{
        var url = './?m=Admin&c=customer&a=customerupdata';
    }
    adddata = $('#form1').serialize();      //获取所有表单
    $.ajax({
        url:url,
        type:'post',
        data:adddata,
        success:function(s){
            console.log(s);
            if (s.isSuccess==true){
                alert('提交成功');
                window.location.href='./?m=Admin&c=customer&a=customermanagement';    //跳转到列表页
            }else {
                alert('提交失败');
            }
        },
        error:function(s){
            console.log(s);
        }
    });
}
function updatachl(){
    adddata = $('#channel').serializeArray();
    console.log(adddata);
    adddata = $('#channel').serialize();      //获取所有表单
    $.ajax({
        url:'./?m=Admin&c=channel&a=channelupdata',
        type:'post',
        data:adddata,
        success:function(s){
            console.log(s);
            if (s.isSuccess==true){
                alert('修改成功');
                window.location.href='./?m=Admin&c=channel&a=channelmanagement';    //跳转到列表页
            }else {
                alert('修改失败');
            }
        },
        error:function(s){
            console.log(s);
        }
    });
}

//弹出框
$(".guiMo").on("click",function(){
    $(".guiMoBg").show();
    $(".guiMoBox").show();
});
$(".tuJing").on("click",function(){
    $(".tuJingBg").show();
    $(".tuJingBox").show();
})

function setgui(id,name){
    $('input[name="guimo"]').val(name);
    $('input[name="chl_scale"]').val(id);
    closeAll_1();

}
function settu(id,name){
    $('input[name="tujing"]').val(name);
    $('input[name="approach"]').val(id);
    closeAll_1();

}

//调用城市
/*客户扩展信息、账户基本信息--城市接口调用*/
function getCityList(){
    id = $('#provinces').children('option:selected').val();
    $('span[name=city]').text('请选择');
    $.ajax({
        url: "./?m=Admin&c=channel&a=ajaxgetcitylist",
        data: "province_id="+id,
        type: "post",
        success:function(s){
            var htmls ='';
            $.each(s,function(i, n){
                htmls += "<option value='"+ n.id+"'>"+n.city+"</option>";
            });
            $('#city').html(htmls);
        },
        error:function(xml){
        }
    });
}
getCityList();
