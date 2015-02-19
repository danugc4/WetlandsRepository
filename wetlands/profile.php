<?php 
require 'core/init.php';
include 'includes/overall/header.php';

$user = new User();

if(Session::exists('home')) {
	echo '<p>', Session::flash('home'), '</p>';
}

if($user->isLoggedIn()) {
?>

<br><br>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">Hello <a href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a>!</h3>
					</div>
					<div class="panel-body">
						<ul>
							<li><a href="changepassword.php">Change password</a></li>
							<li><a href="update.php">Update details</a></li>
							<li><a href="logout.php">Log out</a></li>
							
<?php

	if($user->hasPermission('admin', 'auth')) {
	?>
<li><a href="upload.php">Upload data</a></li>
								
						
	
	<?php
}
	if($user->hasPermission('admin')) {
	?>
<li><a href="admin.php">Admin</a></li>
								
						
	<?php
	}
if($user->hasPermission('admin', 'reg', 'auth')) {
 ?>
							
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




	
		
		
<?php include 'includes/overall/footer.php'; }}?>
	
	