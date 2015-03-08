<?php 
include 'includes/overall/header.php'; 
require 'core/init.php';
$user = new User();




if(Session::exists('home')) {
	echo '<p>', Session::flash('home'), '</p>';
}

if($user->hasPermission('auth')) {
$max = 50 * 1024;
$result = array();

if(Input::exists()) {


if (isset($_POST['upload'])) {
	
	$destination = __DIR__ . '/uploaded/';
    try {
    	$upload = new UploadFile($destination);
    	$upload->setMaxSize($max);
    	$upload->allowAllTypes();
    	$upload->upload();
    	$result = $upload->getMessages();
		
		
 
		
    } catch (Exception $e) {
    	$result[] = $e->getMessage();
    }
}
}


$error = error_get_last();
?>

<h1>Uploading Files</h1>
<?php if ($result || $error) { ?>
<ul class="result">
<?php 
if ($error) {
    echo "<li>{$error['message']}</li>";
}
if ($result) {
	foreach ($result as $message) {
	    echo "<li>$message</li>";
	}
}?>
</ul>
<?php } ?>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Upload your files!</h3>
                </div>
                <div class="panel-body">
					<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
						<p>
							<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max;?>">
							<label for="filename">Select File:</label>
							<input type="file" name="filename[]" id="filename" multiple>
							<input type="submit" name="upload" value="Upload File">
						</p>
					</form>
				</div>
            </div>
        </div>
    </div>
</div>

<?php



} else { ?>
<br><br>
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
	<p>You need to be an authorized user to access this page</p> <a href="login.php">Login here</a>
		</div>
	</div>
</div>


<?php include 'includes/overall/footer.php' ; }?>