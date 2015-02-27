<?php
class newFile{
	private $file_path;
	
	public function getPath($file_path){
	$this->file_path - $file_path;
	
	}
	public function getFile($file_name, $file_type, $file_size, $file_error){
	
	$file_name = $FILES['file']['name'] . '<br />';
	$file_type = $FILES['file']['type'] . '<br />';
	$file_size = $FILES['file']['size'] . '<br />';
	$file_error = $FILES['file']['error'] . '<br />';
	$file_path = $FILES['file']['tmp_name'];
	
	if ( $file_error > 0) {
	echo 'error:' . $file_error;
	
	}else{
	echo 'File Name ' . file_name;
	echo 'file_type ' . file_type;
	echo 'file_size ' . file_size;
	echo 'file_path ' . file_path;
	
	}
	}
	}
	?>