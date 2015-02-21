<?php


try{

if($_POST['send']){

require_once 'fileuploader.php';

$fileUploader=new FileUploader();

if($fileUploader->upload()){

echo "Target file uploaded successfully!";

}

}

}


catch(Exception $e){

echo $e->getMessage();

exit();

}

?>