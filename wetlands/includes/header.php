<?php 
require_once 'core/init.php';
$isLoggedIn = false;

if(Session::exists(Config::get('session/session_name'))) {

	$user = new User();
	if($user->isLoggedIn()) {
		$isLoggedIn = true;
	}
}
?>user

<header>
		<div class = "navbar navbar-inverse navbar-static-top">
			<div class = "container">
				<h1><br>Wetlands Database</h1>
				<button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
				<span class = "icon-bar"></span>
				<span class = "icon-bar"></span>
				<span class = "icon-bar"></span>
				</button>
				<div class = "collapse navbar-collapse navHeaderCollapse">
					<ul class = "nav navbar-nav navbar-right">
						<li><a href = "index.php">Home</a></li>
						<li><a href = "database.php">Database</a></li>
						<li><a href = "articles.php">Articles</a></li>
						<li><a href = "about.php">About</a></li>
						<li><a href = "contact.php">Contact</a></li>
						<li><a href = "profile.php">Profile</a></li>
						<?php if(!$isLoggedIn) { ?>						
						<li><a href = "login.php">Login</a></li>
						<?php } else {?>  						
						<li><a href = "logout.php">Logout</a></li>
						<?php } ?>  
					</ul>
				</div>				 
			</div>
		</div>
		
</header>
<?php if($isLoggedIn) { ?>	<div class="container"><h3>Hello <a href="#"><?php echo escape($user->data()->username); ?></a></h3></div><?php }?>