var node_flag = 0;
var addAuthID = [];//添加的数组id
var addAuthName = [];//添加的数组name
var deleteAuthID = [];//删除的数组id

$(document).ready(function () {


    selectrolelist();

    $('#tt').tree({
        //url:'./Public/treegrid_data1.json',//获取远程数据的 URL 。
        url:'./?m=Admin&c=system&a=get_jurisdiction_list',
        animate:true,//定义当节点展开折叠时是否显示动画效果。
        checkbox:true,//定义是否在每个节点前边显示复选框
        lines:true,//定义是否显示树线条。
        cascadeCheck:false,//定义是否级联检查。
        formatter:function(node){//定义如何呈现节点文本。
            //console.log(node);
            return node.text;
            //return "<span id='"+ node.id +"'>"+node.name+"</span>";
        },
        onClick: function(node){

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
                    if(deleteAuthID[id] == id){
                        deleteAuthID.remove(id);
                        addAuthName[id] = text;
                    }else{
                        addAuthID[id] = id;
                        addAuthName[id] = text;
                    }
                    /*
                    console.log('添加');
                    console.log(addAuthID);console.log(addAuthName);
                    console.log(deleteAuthID);
                    */
                }else{
                    //删除
                    //删除时先看添加的数组中有无此条记录
                    //如果有的话就删除(删除添加数组中的记录)，如果没有的话则直接添加

                    if(addAuthID[id] == id){
                        addAuthID.remove(id);
                    }else{
                        deleteAuthID[id] = id;
                    }

                    if(addAuthName[id] != null){
                        addAuthName.remove(id);
                    }
                    /*
                    console.log('删除');
                    console.log(addAuthID);console.log(addAuthName);
                    console.log(deleteAuthID);
                    */
                }
                //权限文字
                var str = '';
                var flag = '1';
                for(var i=0;i< addAuthName.length;i++){
                    if(addAuthName[i] == '' || addAuthName[i] == undefined || addAuthName[i] == null){
                        continue;
                    }else{
                        if(flag != '1'){
                            str += ',';
                        }
                        str += addAuthName[i];
                        flag = '0';
                    }
                }
                $('textarea[name=privilegesname]').val(str);

                //要添加的权限
                var str1 = '';
                var flag1 = '1';
                for(var j=0;j < addAuthID.length;j++){
                    if(addAuthID[j] == '' || addAuthID[j] == undefined){
                        continue;
                    }else{
                        if(flag1 != '1'){
                            str1 += '|';
                        }

                        str1 += addAuthID[j];
                        flag1 = '0';
                    }
                }
                $('input[name=addAuth]').val(str1);

                //要删除的权限
                var str2 = '';
                var flag2 = '1';
                for(var k=0;k < deleteAuthID.length;k++){
                    if(deleteAuthID[k] == '' || deleteAuthID[k] == undefined){
                        continue;
                    }else{
                        if(flag2 != '1'){
                            str2 += '|';
                        }
                        str2 += deleteAuthID[k];
                        flag2 = '0';
                    }
                }
                $('input[name=deleteAuth]').val(str2);
            }else{
                if(bool == false){
                    addAuthName[id] = text;
                }
            }
        }
    });

    //添加、修改账户信息 form提交
    var detail = {
        beforeSubmit:checkroledetail,
        success:function (s) {
            if(s.msg == '登录信息失效，请重新登录！' || s.msg == '抱歉，您没有此权限！'){
                tishi(s.message);
            }else{
                tishi(s);
                if(s == '角色信息添加成功！' || s == '角色信息修改成功！'){
                    $('.layer_bg01').hide();
                    $('.layer_wrap01').hide();
                    addAuthID = [];
                    addAuthName = [];
                    deleteAuthID = [];
                    node_flag = 0;

                    selectrolelist();
                }
            }
        }
    };
    $('#detail').ajaxForm(detail);

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



//获取角色列表
function selectrolelist(){
    $.ajax({
        url: "./?m=Admin&c=system&a=get_role_list",
        data: "",
        type: "post",
        success: function (s) {
            if(s.msg == '登录信息失效，请重新登录！' || s.msg == '抱歉，您没有此权限！'){
                tishi(s.message);
            }else{
                var htmls = '<tr><th width="2%"><input id="checkAll" class="tabs-radio" onclick="check_all()" type="checkbox" /></th>'
                +'<th width="20%">角色名称</th><th width="8%">图标</th><th width="30%">描述<th width="40%">可访问资源</th>';
                if((s == null) || (s == '')){
                    htmls += "<tr>";
                    htmls += "<td colspan='5'><div class='text-center'><div class='iconAll icon-045 mt60'></div><div class='cl-666 mt20 mb60 ft20 bold'>无数据！</div></div></td>";
                    htmls += "</tr>";
                }else{
                    $.each(s, function(i, n){
                        htmls += "<tr>";
                        htmls += "<td><input class='tabs-radio' name='acc' value='"+ n.roleid +"' type='checkbox'/></td>";
                        htmls += "<td>"+ n.rolename +"</td>";
                        htmls += "<td>"+ n.iconcls +"</td>";
                        htmls += "<td>"+ n.description +"</td>";
                        htmls += "<td>"+ n.authname +"</td>";
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

//添加角色或修改角色前处理数据
function checkroledetail(){
    var name = $('input[name=name]').val();//角色名称
    if(name == ''){
        tishi('角色名称不能为空');
        return false;
    }
}

//添加角色
function addrole(){
    clearroledetail();
    $('#title').html('添加角色');
    $('#detail').attr('action','./?m=Admin&c=system&a=add_role');

    node_flag = 1;
    $('.layer_bg01').show();
    $('.layer_wrap01').show();
}

//修改角色
function updaterole(){
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
        var roleid = check_val[0];
    }else{
        tishi('不可以同时操作'+check_val.length+'条记录！');
        return false;
    }

    clearroledetail();
    $('#title').html('修改角色');
    $('#detail').attr('action','./?m=Admin&c=system&a=update_role');

    //获取账户详情
    $.ajax({
        url: "./?m=Admin&c=system&a=get_role_detail",
        data: "roleid="+roleid,
        type: "post",
        success:function(s){
            if(s.msg == '登录信息失效，请重新登录！' || s.msg == '抱歉，您没有此权限！'){
                tishi(s.message);
            }else if(s != ''){
                $('input[name=rid]').val(s.roleid);//角色id
                $('input[name=name]').val(s.rolename);//角色名称
                $('input[name=privilegesid]').val(s.authid);//权限id
                $('textarea[name=privilegesname]').val(s.authname);//权限名称
                $('textarea[name=description]').val(s.description);//描述

                if(s.authid != ''){
                    var auth = s.authid.split(",");
                    Auth = auth;
                    for(var i=0 ; i< auth.length ; i++){
                        setprivileges(Number(auth[i]));
                    }
                }
                node_flag = 1;

                $('.layer_bg01').show();
                $('.layer_wrap01').show();
            }else{
                tishi("角色信息有误！");
            }


        },
        error:function(xml){
            tishi(xml);
        }
    });



}

//设置角色所拥有权限
function setprivileges(authid){
    var node = $('#tt').tree('find', authid);
    console.log(node);
    $('#tt').tree('check', node.target);
}

//删除角色
function deleterole(){
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
        url: "./?m=Admin&c=system&a=delete_role",
        data: "roleid="+check_val,
        type: "post",
        success:function(s){
            if(s.msg == '登录信息失效，请重新登录！' || s.msg == '抱歉，您没有此权限！'){
                tishi(s.message);
            }else{
                tishi(s);
                if(s == '角色信息删除成功！'){
                    selectrolelist();
                }
            }
        },
        error:function(xml){
            tishi(xml);
        }
    });


}

//清空角色弹框输入值
function clearroledetail(){
    $('input[name=name]').val('');//角色名称
    $('input[name=privilegesid]').val('');//权限id
    $('textarea[name=privilegesname]').val('');//权限名称
    $('textarea[name=description]').val('');//描述

    $('.tree-checkbox').attr('class', 'tree-checkbox tree-checkbox0');
    $('input[name=addAuth]').val('');//添加的角色
    $('input[name=deleteAuth]').val('');//删除的角色
    addAuthID = [];
    addAuthName = [];
    deleteAuthID = [];
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

//统计数组
function count(o){
    var t = typeof o;
    if(t == 'string'){
        return o.length;
    }else if(t == 'object'){
        var n = 0;
        for(var i in o){
            n++;
        }
        return n;
    }
    return false;
}
