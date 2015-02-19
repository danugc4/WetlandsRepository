<?php 
require 'core/init.php';
include 'includes/overall/header.php'; 

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		$user = new User();

		$remember = (Input::get('remember') === 'on') ? true : false;
		$login = $user->login(Input::get('username'), Input::get('password'), $remember);

		if($login) {
			Redirect::to('index.php');
		} else {
			echo '<p>Sorry, that username and password wasn\'t recognised.</p>';
		}
	}
}

?>
<br><br>
	<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
						<a href="forgot.html" class="pull-right ">Forgot password?</a>
						<br>
                    </div>
                    <div class="panel-body">
                        <form action="login.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" id="username" name="username" type="text" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password">
                                </div>
								<div class="checkbox">
									<label><input type="checkbox" name="remember" id="remember"> Remember me</label>
								</div>
								<input type ="submit" value="Log in" class="btn btn-lg btn-success btn-block"> 
								<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                            </fieldset>
                        </form>
						<div>
						<br><p>Dont have an account! <a href = "register.php">Register Here</a></p>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'includes/overall/footer.php'; ?>