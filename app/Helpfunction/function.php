<?php
function load($type,$name){
	if($type == 'lib'){
		$path = app_path()."/Libary/"."{$name}.php";
	}
	if($type == 'Helpfunction'){
		$path = app_path()."/Helpfunction/"."{$name}.php";
	}
	
	if(file_exists($path)){
		require($path);
	}else{
		echo "{$type}:{$name} không tồn tại";
	}
}