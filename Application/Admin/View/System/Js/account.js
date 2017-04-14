var node_flag = 0;//0初始值  1自己修改
var addRoleID = [];//添加的数组id
var addRoleName = [];//添加的数组name
var deleteRoleID = [];//删除的数组id
$(document).ready(function () {
    var e = 1;
    selaccountlist(e);



    //
    $(".detailform").Validform({
        tiptype:function(msg){
            if(msg != ''){
                tishi(msg);
            }
            $('#msg').val(msg);
        },
        datatype:{
            "double" : /^(([0-9]+\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\.[0-9]+)|([0-9]*[1-9][0-9]*))$/ ,//浮点类型
            "phone" : /^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/ //手机号码
        }
    });


    //添加、修改账户信息 form提交
    var detail = {
        //beforeSubmit:checkaccountdetail,
        success:function (s) {
            if(s.msg == '登录信息失效，请重新登录！' || s.msg == '抱歉，您没有此权限！'){
                tishi(s.message);
            }else{
                tishi(s);
                if(s == '账户信息添加成功！' || s == '账户信息修改成功！'){
                    $('.layer_bg01').hide();
                    $('.layer_wrap01').hide();
                    addRoleID = [];
                    addRoleName = [];
                    deleteRoleID = [];
                    node_flag = 0;
                    selaccountlist(e);
                }
            }
        }
    };
    $('#detail').ajaxForm(detail);

    //修改密码 form表单提交
    var password = {
        success:function (s) {
            if(s.msg == '登录信息失效，请重新登录！' || s.msg == '抱歉，您没有此权限！'){
                tishi(s.message);
            }else{
		tishi(s);
                if(s == '账户密码修改成功！'){
                    //$('.tabs-radio').removeAttr('checked');
                    $('.layer_bg02').hide();
                    $('.layer_wrap02').hide();
                }
            }
        }
    };
    $('#password').ajaxForm(password);

    jeDate({
        dateCell:"#date1",
        format:"YYYY-MM-DD",
        isTime:false,
        minDate:"1900-01-01"
    })

    $('#tt').tree({
        //url:'./Public/treegrid_data1.json',//获取远程数据的 URL 。
        url:'./?m=Admin&c=system&a=get_role_list',
        animate:true,//定义当节点展开折叠时是否显示动画效果。
        checkbox:true,//定义是否在每个节点前边显示复选框
        lines:true,//定义是否显示树线条。
        cascadeCheck:false,//定义是否级联检查。
        formatter:function(node){//定义如何呈现节点文本。
            return node.rolename;
            //return "<span id='"+ node.id +"'>"+node.name+"</span>";
        },
        onClick: function(node){
           //主动修改权限
            var bool = node.checked;//是否被选中 true选中 false没选中
            var id = node.id;//权限id
            var text = node.text;//权限名称
            if(node_flag == 1){
                if(bool == false){
                    //添加
                    //添加时先看删除的数组中有无此条记录
                    //如果有的话就删除(删除删除数组中的记录)，如果没有的话则直接添加
                    if(deleteRoleID[id] == id){
                        deleteRoleID.remove(id);
                        addRoleName[id] = text;
                    }else{
                        addRoleID[id] = id;
                        addRoleName[id] = text;
                    }
                    /*
                    console.log('添加');
                    console.log(addRoleID);console.log(addRoleName);
                    console.log(deleteRoleID);
                    */
                }else{
                    //删除
                    //删除时先看添加的数组中有无此条记录
                    //如果有的话就删除(删除添加数组中的记录)，如果没有的话则直接添加

                    if(addRoleID[id] == id){
                        addRoleID.remove(id);
                    }else{
                        deleteRoleID[id] = id;
                    }

                    if(addRoleName[id] != null){
                        addRoleName.remove(id);
                    }
                    /*
                    console.log('删除');
                    console.log(addRoleID);console.log(addRoleName);
                    console.log(deleteRoleID);
                    */
                }
                //权限文字
                var str = '';
                var flag = '1';
                for(var i=0;i< addRoleName.length;i++){
                    if(addRoleName[i] == '' || addRoleName[i] == undefined || addRoleName[i] == null){
                        continue;
                    }else{
                        if(flag != '1'){
                            str += ',';
                        }
                        str += addRoleName[i];
                        flag = '0';
                    }
                }
                $('input[name=role]').val(str);

                //要添加的权限
                var str1 = '';
                var flag1 = '1';
                for(var j=0;j < addRoleID.length;j++){
                    if(addRoleID[j] == '' || addRoleID[j] == undefined){
                        continue;
                    }else{
                        if(flag1 != '1'){
                            str1 += '|';
                        }

                        str1 += addRoleID[j];
                        flag1 = '0';
                    }
                }
                $('input[name=addRole]').val(str1);
                $('input[name=roleids]').val(str1);

                //要删除的权限
                var str2 = '';
                var flag2 = '1';
                for(var k=0;k < deleteRoleID.length;k++){
                    if(deleteRoleID[k] == '' || deleteRoleID[k] == undefined){
                        continue;
                    }else{
                        if(flag2 != '1'){
                            str2 += '|';
                        }
                        str2 += deleteRoleID[k];
                        flag2 = '0';
                    }
                }
                $('input[name=deleteRole]').val(str2);
            }else{
                if(bool == false){
                    addRoleName[id] = text;
                }
            }
        },
        onCheck: function(node){
            //主动修改权限
            var bool = node.checked;//是否被选中 true选中 false没选中
            var id = node.id;//权限id
            var text = node.text;//权限名称
            if(node_flag == 1){
                if(bool == false){
                    //添加
                    //添加时先看删除的数组中有无此条记录
                    //如果有的话就删除(删除删除数组中的记录)，如果没有的话则直接添加
                    if(deleteRoleID[id] == id){
                        deleteRoleID.remove(id);
                        addRoleName[id] = text;
                    }else{
                        addRoleID[id] = id;
                        addRoleName[id] = text;
                    }
                    /*
                    console.log('添加');
                    console.log(addRoleID);console.log(addRoleName);
                    console.log(deleteRoleID);
                    */
                }else{
                    //删除
                    //删除时先看添加的数组中有无此条记录
                    //如果有的话就删除(删除添加数组中的记录)，如果没有的话则直接添加

                    if(addRoleID[id] == id){
                        addRoleID.remove(id);
                    }else{
                        deleteRoleID[id] = id;
                    }

                    if(addRoleName[id] != null){
                        addRoleName.remove(id);
                    }
                    /*
                    console.log('删除');
                    console.log(addRoleID);console.log(addRoleName);
                    console.log(deleteRoleID);
                    */
                }
                //权限文字
                var str = '';
                var flag = '1';
                for(var i=0;i< addRoleName.length;i++){
                    if(addRoleName[i] == '' || addRoleName[i] == undefined || addRoleName[i] == null){
                        continue;
                    }else{
                        if(flag != '1'){
                            str += ',';
                        }
                        str += addRoleName[i];
                        flag = '0';
                    }
                }
                $('input[name=role]').val(str);

                //要添加的权限
                var str1 = '';
                var flag1 = '1';
                for(var j=0;j < addRoleID.length;j++){
                    if(addRoleID[j] == '' || addRoleID[j] == undefined){
                        continue;
                    }else{
                        if(flag1 != '1'){
                            str1 += '|';
                        }

                        str1 += addRoleID[j];
                        flag1 = '0';
                    }
                }
                $('input[name=addRole]').val(str1);
                $('input[name=roleids]').val(str1);

                //要删除的权限
                var str2 = '';
                var flag2 = '1';
                for(var k=0;k < deleteRoleID.length;k++){
                    if(deleteRoleID[k] == '' || deleteRoleID[k] == undefined){
                        continue;
                    }else{
                        if(flag2 != '1'){
                            str2 += '|';
                        }
                        str2 += deleteRoleID[k];
                        flag2 = '0';
                    }
                }
                $('input[name=deleteRole]').val(str2);
            }else{
                if(bool == false){
                    addRoleName[id] = text;
                }
            }
        }
    });

/**
*删除数组指定下标或指定对象
*/
Array.prototype.remove = function(obj){
    for(var i =0;i <this.length;i++){
        var temp = this[i];
        if(!isNaN(obj)){
            temp=i;
        }
        if(temp == obj){
            for(var j = i;j <this.length;j++){
                this[j]=this[j+1];
            }
            this.length = this.length-1;
        }
    }
}

});

//搜索账户列表
function selaccountlist(p){
    e = p;

    //搜索条件
    var str = '';
    var accountname = $('#accountname1').val();
    var phone = $('#phone1').val();
    var realname = $('#realname1').val();
    if(accountname != '' && accountname != undefined){
        str += "&accountname="+accountname;
    }
    if(phone != '' && phone != undefined){
        str += "&mobilephone="+phone;
    }
    if(realname != '' && realname != undefined){
        str += "&realname="+realname;
    }
    //
    $.ajax({
        url: "./?m=Admin&c=system&a=get_account_list",
        data: "p="+p+str,
        type: "post",
        success: function (s) {
            if(s.msg == '登录信息失效，请重新登录！' || s.msg == '抱歉，您没有此权限！'){
                tishi(s.message);
            }else{
                if(s.page != ''){
                    $("#kkpager").html(s.page);
                }
                var htmls = '<tr><th width="2%"><input id="checkAll" class="tabs-radio" onclick="check_all()" type="checkbox" /></th>'
                    +'<th width="10%">账户名称</th><th width="10%">手机号码<th width="10%">真实姓名</th><th width="10%">类型</th>'
                    +'<th width="10%">所属角色</th><th width="10%">最后登录时间</th><th width="10%">修改时间</th></tr>';

                if((s.list == null) || (s.list == '')){
                    htmls += "<tr>";
                    htmls += "<td colspan='9'><div class='text-center'><div class='iconAll icon-045 mt60'></div><div class='cl-666 mt20 mb60 ft20 bold'>无数据！</div></div></td>";
                    htmls += "</tr>";
                }else{
                    $.each(s.list, function(i, n){
                        htmls += "<tr>";
                        htmls += "<td><input class='tabs-radio' name='acc' value='"+ n.id +"' type='checkbox'/></td>";
                        htmls += "<td>"+ n.accountname +"</td>";
                        htmls += "<td>"+ n.mobilephone +"</td>";
                        htmls += "<td>"+ n.realname +"</td>";
                        htmls += "<td>"+ n.type +"</td>";
                        if(n.roleName != undefined){
                           htmls += "<td>"+ n.roleName +"</td>";
                        }else{
                           htmls += "<td></td>";
                        }

                        htmls += "<td>"+ n.last_login_date +"</td>";
                        htmls += "<td>"+ n.modifiedtime +"</td>";
                        htmls += "</tr>";
                    });
                }
                $(".tabs").html(htmls);
            }
        },
        error: function (xml) {
            tishi(xml);
        }
    });
}

//添加账户
function addaccount(){
    clearaccountdetail();
    $('#title').html('添加账户');
    $('#detail').attr('action','./?m=Admin&c=system&a=add_account_basic');
    $('input[name=type]').val('1');//账户类型
    $('span[name=type]').text('普通客户');

    node_flag = 1;
    $('.layer_bg01').show();
    $('.layer_wrap01').show();
}

//修改账户
function updateaccount(){
    var obj = document.getElementsByName('acc');
    check_val = [];
    for (k in obj) {
        if (obj[k].checked)
            check_val.push(obj[k].value);
    }
    if (check_val.length == 0){
        tishi('当前无选中记录');
        return false;
    }else if(check_val.length == 1){//空数组
        var accountid = check_val[0];
    }else{
        tishi('不可以同时操作'+check_val.length+'条记录！');
        return false;
    }

    clearaccountdetail();
    $('#title').html('修改账户');
    $('#detail').attr('action','./?m=Admin&c=system&a=update_account_basic');

    //获取账户详情
    $.ajax({
        url: "./?m=Admin&c=system&a=get_account_basic",
        data: "accountid="+accountid,
        type: "post",
        success:function(s){
            if(s.msg == '登录信息失效，请重新登录！' || s.msg == '抱歉，您没有此权限！'){
                tishi(s.message);
            }else if(s != ''){
		    $('input[name=aid]').val(s.id);//账户名称
                $('input[name=accountname]').val(s.accountname);//账户名称
                $('input[name=phone]').val(s.mobilephone);//手机号码
                $('input[name=realname]').val(s.realname);//真实姓名
                $('input[name=birthday]').val(s.birthday);//出生日期
                $('input[name=sex]').val(s.sex);//性别
                $('input[name=identitycard]').val(s.identity_card_num);//身份证号码
                $('textarea[name=remark]').val(s.remarks);//备注
                $('input[name=type]').val(s.type);//账户类型
                $('span[name=type]').text(s.type);
                $('input[name=roleids]').val(s.roleid);
                $('input[name=role]').val(s.roleName);//角色
                //设置角色
                if(s.roleid != '' && s.roleid != undefined){
                    var role = s.roleid.split(",");
                    for(var i=0 ; i< role.length ; i++){
                        setrolelist(Number(role[i]));
                    }
                }
                node_flag = 1;
                $('.layer_bg01').show();
                $('.layer_wrap01').show();
            }else{
                tishi("账户信息有误！");
            }
        },
        error:function(xml){
            tishi(xml);
        }
    });
}

//设置角色列表赋值
function setrolelist(id){
    var node = $('#tt').tree('find', id);
    $('#tt').tree('check', node.target);
}

//删除账户
function deleteaccount(){
    //单选或多选
    var obj = document.getElementsByName('acc');
    check_val = [];
    for (k in obj) {
        if (obj[k].checked)
            check_val.push(obj[k].value);
    }
    if (check_val.length == 0){
        tishi('当前无选中记录');
        return false;
    }

    //确认删除
    var returnVal = window.confirm("您确定要删除选中的记录吗？");
    if(!returnVal){
        return false;
    }

    //删除
    $.ajax({
        url: "./?m=Admin&c=system&a=delete_account_basic",
        data: "accountid="+check_val,
        type: "post",
        success:function(s){
            if(s.msg == '登录信息失效，请重新登录！' || s.msg == '抱歉，您没有此权限！'){
                tishi(s.message);
            }else{
                tishi(s);
                if(s == '账户信息删除成功！'){
                    selaccountlist(e);
                }
            }
        },
        error:function(xml){
            tishi(xml);
        }
    });


}

//修改密码
function updatepassword(){
    $('input[name=accid]').val('');
    $('input[name=password]').val('');

    var obj = document.getElementsByName('acc');
    check_val = [];
    for (k in obj) {
        if (obj[k].checked)
            check_val.push(obj[k].value);
    }
    if (check_val.length == 0){
        tishi('当前无选中记录');
        return false;
    }else if(check_val.length == 1){//空数组
        $('input[name=accid]').val(check_val[0]);

        $('.layer_bg02').show();
        $('.layer_wrap02').show();
    }else{
        tishi('不可以同时修改'+check_val.length+'条记录！');
        return false;
    }
}

//清除搜索条件
function clearsearch(){
    //清除搜索条件
    $('#accountname1').val('');//清空账户名称
    $('#phone1').val('');//清空手机号码
    $('#role_id').html('全部');//清空角色
    $('#roleid').val('');//清空角色
    //重新搜索
    selaccountlist(1);
}

//清除账户详情
function clearaccountdetail(){
    $('input[name=accountname]').val('');//账户名称
    $('input[name=phone]').val('');//手机号码
    $('input[name=realname]').val('');//真实姓名
    $('input[name=state]').val('');//状态
    $('input[name=role]').val('');//角色
    $('input[name=birthday]').val('');//出生日期
    $('input[name=sex]').val('');//性别
    $('input[name=identitycard]').val('');//身份证号码
    $('textarea[name=remark]').val('');//备注
    $('input[name=type]').val('');//账户类型
    $('span[name=type]').text('全部');

    //$('#tt').tree('unselectAll',$('#tt').tree('getSelected').target);
    $('.tree-checkbox').attr('class', 'tree-checkbox tree-checkbox0');
    $('input[name=addRole]').val('');//添加的角色
    $('input[name=deleteRole]').val('');//删除的角色
    $('input[name=role]').val('');//角色
    $('input[name=roleids]').val('');
    addRoleID = [];
    addRoleName = [];
    deleteRoleID = [];
    node_flag = 0;
}

//全选效果
function check_all(){
    var type = $('#checkAll').attr('checked');
    if(type == 'checked'){
        //全部选择效果
        $('.tabs-radio').attr('checked','true');
    }else{
        //全部取消效果
        $('.tabs-radio').removeAttr('checked');
    }
}
