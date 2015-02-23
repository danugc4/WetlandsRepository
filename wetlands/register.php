<?php include 'includes/overall/header.php'; 
require_once 'core/init.php';

if(Input::exists()) {

	if(Token::check(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'name' => array(
				'required' => false,
				'min' => 2,
				'max' => 50),
			'email' => array(
				'required' => true,
				'min' => 2,
				'max' => 50,
				'unique' => 'users'),
			'company' => array(
				'required' => false,
				'min' => 2,
				'max' => 50),
			'job_title' => array(
				'required' => false,
				'min' => 2,
				'max' => 50),
			'username' => array(
				'required' => true,
				'min' => 2,
				'max' => 20,
				'unique' => 'users'),
			'password' => array(
				'required' => true,
				'min' => 6),
			'password_again' => array(
				'required' => true,
				'matches' => 'password')
		));

		if($validation->passed()) {
			$user = new User();

			$salt = Hash::salt(32);

			try {
				$user->create(array(
					'name' => Input::get('name'),
					'email' => Input::get('email'),
					'company' => Input::get('company'),
					'job_title' => Input::get('job_title'),
					'username' => Input::get('username'),
					'password' => Hash::make(Input::get('password'), $salt),
					'salt' => $salt,
					'joined' => date('Y-m-d H:i:s'),
					'group' => 1
				));

				Session::flash('home', 'You have been registered and can now log in!');
				Redirect::to('login.php');

			} catch(Exception $e) {
				die($e->getMessage()); //TODO redirect to error page instead of die
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
                    <h3 class="panel-title">Register Now</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post">
                        <fieldset>
							<div class="form-group">
								<input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?php echo escape(Input::get('name')); ?>">
							</div>
							<div class="form-group">
								<input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="<?php echo escape(Input::get('email')); ?>">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="company" name="company" placeholder="Enter company name" value="<?php echo escape(Input::get('company')); ?>">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="job_title" id="job_title" placeholder="Enter job title" value="<?php echo escape(Input::get('job_title')); ?>">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="username" name="username" placeholder="Choose a username" autocomplete="off" value="<?php echo escape(Input::get('username')); ?>">
							</div>
							<div class="form-group">
								<input type="password" class="form-control" name="password" id="password" placeholder="Choose a password">
							</div>
							<div class="form-group">
								<input type="password" class="form-control" name="password_again" id="password_again" placeholder="Enter your password again">
							</div>
							<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
							<button class="btn btn-lg btn-success btn-block" type="submit" value="Register">Register</button> 
                        </fieldset>
                    </form>
					<div>
					<br><p>Already registered! <a href = "login.php">Login here!</a></p>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
	
	
<?php include 'includes/overall/footer.php'; ?>