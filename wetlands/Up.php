<?php
	

include  'uplo.php';
	$file = newFile();
	$file ->getPath('');
	$file ->getFile('', '', '');
	
?>

<html><body>
<form action="" method="post" enctype="multipart/form-data">
	
	<input type="file" name="file" if = "file"/> 
	
	<input type="submit" value="Upload" />
	
</form>
</body>