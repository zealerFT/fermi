$(document).ready(function () {

    //
    /*
    $('#tree1').treegrid({
        //url:"./?m=Admin&c=system&a=get_jurisdiction_list",//./Public/treegrid_data1.json
        url:"./Public/treegrid_data1.json",//
        idField:'authid',
        treeField:'name',
        animate:"true",
        rownumbers:true,
        collapsible: true,
        fitColumns: true,
        autoScroll: false,
        onContextMenu: onContextMenu,
        //onDblClickCell:function(){layer()},
        columns:[[
            {title:'名称',field:'name',formatter:function(value,rowData,rowIndex){
                return "&nbsp;" + rowData.name;
            },width:fixWidth(0.1)},
            {field:'address',title:'权限地址',width:fixWidth(0.1),align:'center'},
            {field:'action',title:'操作名',width:fixWidth(0.1),align:'center'},
            {field:'description',title:'权限描述',width:fixWidth(0.1),align:'center'},
            {field:'seq',title:'排序',width:fixWidth(0.1),align:'center'},
            //{field:'SuperiorAuthority',title:'上级权限',width:fixWidth(0.1),align:'center'}
        ]]
    });
    */

    /*
    树
    $('#tt').tree({
        url:'./Public/treegrid_data1.json',//获取远程数据的 URL 。
        animate:true,//定义当节点展开折叠时是否显示动画效果。
        checkbox:true,//定义是否在每个节点前边显示复选框
        lines:true,//定义是否显示树线条。
        formatter:function(node){//定义如何呈现节点文本。
            return node.name;
        }
    });
    */

    //树形网格
    $('#tt').treegrid({
        //url:'./Public/treegrid_data1.json',//   ./Public/treegrid_data1.json
        url: "./?m=Admin&c=system&a=get_jurisdiction_list", // ./?m=Admin&c=system&a=get_jurisdiction_list
        idField: "id",
        treeField: "text",
        animate: "true",// 定义当节点展开折叠时是否显示动画效果
        columns:[[
            {field:'text',title:'名称',formatter:function(value,rowData,rowIndex){
                console.log(rowData);
                return "&nbsp;" + rowData.text;
            },width:200},
            {field:'description',title:'操作名',width:200,align:'center'},
            {field:'actionurl',title:'地址',width:750,align:'center'},
        ]]
    });



    //展开
    $("#consle").bind("click",consleclick);
    //收缩
    $("#collapseAll").bind("click",collapseAll);
    //刷新
    $("#refresh").bind("click",refresh);

    $('#tt').treegrid('collapseAll',2);
});

function onContextMenu(e,row){
    e.preventDefault();
    $(this).treegrid('select', row.id);
    $('#mm').menu('show',{
        left: e.pageX,
        top: e.pageY
    });
}

function fixWidth(percent)  {
    var w = $("#main-box").width()- 30;
    return  w * percent ;
}

function layer(){
    var row = $('#tree1').datagrid('getSelected');
    $("#name").text(row.name);
    $("#address").text(row.address);
    $("#desc").text(row.desc);
    $("#Sequence").val(row.Sequence);
    $("#SuperiorAuthority").val(row.SuperiorAuthority);
    $(".layer_bg").show();
    $(".layer_wrap").show();
}

//展开
function consleclick(){
    var node = $('#tt').treegrid('expandAll');
}
//收缩
function collapseAll(){
    var node = $('#tt').treegrid('collapseAll',2);
}
//刷新
function refresh(){
    var node = $('#tt').treegrid('reload');
}

//获取权限列表
function getjurlist(){
    $.ajax({
        url: "./?m=Admin&c=system&a=get_jurisdiction_list",
        data: "",
        type: "post",
        success:function(s){
            console.log(s);
        },
        error:function(xml){
            tishi(xml);
        }
    });

}
