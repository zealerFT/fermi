<?php
 
function list_dir($dir){
	$result = array();
	if (is_dir($dir)){
		$file_dir = scandir($dir);
		foreach($file_dir as $file){
			if ($file == '.' || $file == '..'){
				continue;
			}
			elseif (is_dir($dir.$file)){
				$result = array_merge($result, list_dir($dir.$file.'/'));
			}
			else{
				array_push($result, $dir.$file);
			}
		}
	}
	return $result;
}

 
$datalist=list_dir('./test/');

$filename = "test.zip"; //    
if(!file_exists($filename)){   
   
    $zip = new ZipArchive(); 
    if ($zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE) {   
        exit('无法打开文件，或者文件创建失败');
    }   
    foreach( $datalist as $val){   
        if(file_exists($val)){   
            $zip->addFile( $val, basename($val)); 
        }   
    }   
    $zip->close(); 
}  

if(!file_exists($filename)){   
    exit("无法找到文件");     
}   
header("Cache-Control: public"); 
header("Content-Description: File Transfer"); 
header('Content-disposition: attachment; filename='.basename($filename));      
header("Content-Type: application/zip");   
header("Content-Transfer-Encoding: binary");     
header('Content-Length: '. filesize($filename));    
@readfile($filename);
