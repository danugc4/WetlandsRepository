<?php
require 'core/init.php';
include 'includes/overall/header.php';

$user = new User();

if(!$user->isLoggedIn()) {
	Redirect::to('index.php');
}

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'password_current' => array(
				'required' => true,
				'min' => 6),
			'password_new' => array(
				'required' => true,
				'min' => 6),
			'password_new_again' => array(
				'required' => true,
				'min' => 6,
				'matches' => 'password_new')
		));

		if($validation->passed()) {
			if(Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password) {
				echo 'Your current password is wrong.';
			} else {
				try {
					
					$salt = Hash::salt(32);	

					$user->update(array(
						'password' => Hash::make(Input::get('password_new'), $salt),
						'salt' => $salt
					));
					
					Session::flash('home', 'Your password has been changed!');
					Redirect::to('profile.php');

				} catch(Exception $e) {
					die($e->getMessage());
				}
			}
		} else {
			foreach($validate->errors() as $error) {
				echo $error, '<br>';
			}
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
                        <h3 class="panel-title">Change password</h3>
                    </div>
                    <div class="panel-body">
                        <form action="changepassword.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter current password" id="password_current" name="password_current" type="password">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter new password" name="password_new" id="password_new" type="password">
                                </div>
								<div class="form-group">
                                    <input class="form-control" placeholder="Confirm new password" name="password_new_again" id="password_new_again" type="password">
                                </div>
								<input type ="submit" value="Change" class="btn btn-lg btn-success btn-block"> 
								<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                            </fieldset>
                        </form>
						<div>
						<br><a href = "profile.php">Back to profile</a></p>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'includes/overall/footer.php'; ?>
