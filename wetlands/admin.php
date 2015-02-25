<?php 
require 'core/init.php';
include 'includes/overall/header.php';

$user = new User();

if(Session::exists('home')) {
	echo '<p>', Session::flash('home'), '</p>';
}

if($user->hasPermission('admin')) {
?>

<br><br>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">Admin page, hello <a href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a>!</h3>
					</div>
					<div class="panel-body">
						<ul>
							<li><a href="maintainwetlands.php">Maintain wetlands</a></li>
							<li><a href="maintainarticles.php">Maintain articles</a></li>
							<li><a href="member'slist.php">Member's list</a></li>
							</ul>
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
	<p>You need to be an admin to access this page</p> <a href="login.php">Login here</a>
		</div>
	</div>
</div>


<?php include 'includes/overall/footer.php'; }?>