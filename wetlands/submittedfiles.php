<?php 
include 'includes/overall/header.php'; 
require 'core/init.php';
$user = new User();

if(Session::exists('home')) {
	echo '<p>', Session::flash('home'), '</p>';
}

if($user->hasPermission('admin')) {

	
	$the = DB::getInstance()->query('SELECT * FROM file ORDER BY uploaded DESC');
		
		//foreach($the->results() as $the) {
		/*echo $file->username, '<br>';
		echo $file->filename, '<br>';
		echo $file->uploaded, '<br>';
		}*/
		//echo $user->data()->username;
		//echo $_SESSION[$user->data()->username];
		
	//$_SESSION['user'];
	/* echo $user;
	echo "<table border='1'>";
echo "<tr> <th>Name</th> <th>Age</th> </tr>";
// keeps getting the next row until there are no more to get
if(!$the->count()) {
	echo 'no user';
	}else{
	// Print out the contents of each row into a table
	echo "<tr><td>"; 
	echo $the->results();
	//echo "</td><td>"; 
	//echo $the['age'];
	//echo "</td></tr>"; 
} 

echo "</table>";*/
?>
<div class="container">
    <div class="table-responsive">
                                      <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Filename</th>
                                                    <th>Uploaded by</th>
                                                    <th>Upload date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											
                                                <?php foreach($the->results() as $the) {
												echo '<tr><td>', '<a href="uploaded/' ,$the->filename, '" download>',  $the->filename, '</a>','</td>', '<td>', $the->username, '</td>', '<td>', $the->uploaded, '</td></tr>'; 
												}?> 
                                                
												</tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
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
	
	