function delcustomer(id){
    if(confirm('确定要删除吗？')){
        $.ajax({
            url:'./?m=Admin&c=customer&a=deleteCus',
            type:'post',
            data:'id='+id,
            success:function(s){
                console.log(s);
                if (s.isSuccess==true){
                    alert('删除成功');
                    location.reload(true);  //完成后刷新
                }else {
                    alert('删除失败');
                }
            },
            error:function(s){

            }
        });
    }else{
        return false;
    }
}


//上传文件
function upfile(){
    var formData = new FormData();
    files = $('input[type="file"]')[0].files;
    for(var i=0;i<files.length;i++){
        console.log(files[i].name);
        formData.append('Excel',files[i]);
    }
    console.log(formData);
//return false;
    $.ajax({
        url: './?m=Admin&c=customer&a=receive',  //server script to process data
        type: 'POST',
        xhr: function() {  // custom xhr
            myXhr = $.ajaxSettings.xhr();
            if(myXhr.upload){ // check if upload property exists
                myXhr.upload.addEventListener('progress',progressHandlingFunction, false); // for handling the progress of the upload
            }
            return myXhr;
        },
        //Ajax事件
        beforeSend: function(){
            console.log('uodata...');
        },
        success: function(s){
            console.log(s);
            if (s.isSuccess){
                alert('上传成功');
                location.reload(true);  //完成后刷新
            }else{
                alert('上传失败');
            }
        },
        error: function(s){
            console.log(s);
        },
        // Form数据
        data: formData,
        //Options to tell JQuery not to process data or worry about content-type
        cache: false,
        contentType: false,
        processData: false
    });
    function progressHandlingFunction(e){
        if(e.lengthComputable){
            $('progress').attr({value:e.loaded,max:e.total});
        }
    }
}


/*显示上传文件名*/
var inputElement = document.getElementById("fileup");
inputElement.addEventListener("change", handleFiles, false);

function handleFiles(){
    var fileList = this.files;
    var dd = document.getElementById('content');
    dd.innerHTML = '';
    for( var i = 0 ; i < fileList.length ; i++ ){
        dd.innerHTML += fileList[i].name+"<br>";
    }
}