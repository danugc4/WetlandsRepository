<?php include 'includes/overall/header.php'; 
require 'core/init.php';

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
				'max' => 50),
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
					
				));

				Session::flash('home', 'You have succesfully uploaded your data!');
				Redirect::to('login.php');

			} catch(Exception $e) {
				die($e->getMessage());
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
                    <h3 class="panel-title">Upload Data</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post">
                        <fieldset>
							<div class="form-group" autocomplete="off">
								<input type="name" class="form-control" id="name" name="name" placeholder="Wetland name"  value="<?php echo escape(Input::get('name')); ?>">
							</div>
							<div class="form-group">
								<input type="email" class="form-control" name="email" id="email" placeholder="Sample Date" value="<?php echo escape(Input::get('email')); ?>">
							</div>
							<div class="form-group">
								<input type="company" class="form-control" id="company" name="company" placeholder="Sample Point" value="<?php echo escape(Input::get('company')); ?>">
							</div>
							<div class="form-group">
								<input type="job_title" class="form-control" name="job_title" id="job_title" placeholder="Daily flow rate" value="<?php echo escape(Input::get('job_title')); ?>">
							</div>
							<div class="form-group">
								<input type="username" class="form-control" id="username" name="username" placeholder="COD" autocomplete="off" value="<?php echo escape(Input::get('username')); ?>">
							</div>
							<div class="form-group">
								<input type="username" class="form-control" id="username" name="username" placeholder="BOD" autocomplete="off" value="<?php echo escape(Input::get('username')); ?>">
							</div>
							<div class="form-group">
								<input type="username" class="form-control" id="username" name="username" placeholder="Suspended solids" autocomplete="off" value="<?php echo escape(Input::get('username')); ?>">
							</div>
							<div class="form-group">
								<input type="username" class="form-control" id="username" name="username" placeholder="pH" autocomplete="off" value="<?php echo escape(Input::get('username')); ?>">
							</div>
							<div class="form-group">
								<input type="username" class="form-control" id="username" name="username" placeholder="Dissolved oxygen" autocomplete="off" value="<?php echo escape(Input::get('username')); ?>">
							</div>
							<div class="form-group">
								<input type="username" class="form-control" id="username" name="username" placeholder="Temperature" autocomplete="off" value="<?php echo escape(Input::get('username')); ?>">
							</div>
							<div class="form-group">
								<input type="username" class="form-control" id="username" name="username" placeholder="Total nitrogen" autocomplete="off" value="<?php echo escape(Input::get('username')); ?>">
							</div>
							<div class="form-group">
								<input type="username" class="form-control" id="username" name="username" placeholder="NH4 - N" autocomplete="off" value="<?php echo escape(Input::get('username')); ?>">
							</div>
							<div class="form-group">
								<input type="username" class="form-control" id="username" name="username" placeholder="NO3 - N" autocomplete="off" value="<?php echo escape(Input::get('username')); ?>">
							</div>
							<div class="form-group">
								<input type="username" class="form-control" id="username" name="username" placeholder="TON" autocomplete="off" value="<?php echo escape(Input::get('username')); ?>">
							</div>
							<div class="form-group">
								<input type="username" class="form-control" id="username" name="username" placeholder="Total Phosphorous" autocomplete="off" value="<?php echo escape(Input::get('username')); ?>">
							</div>
							<div class="form-group">
								<input type="username" class="form-control" id="username" name="username" placeholder="PO4 - P" autocomplete="off" value="<?php echo escape(Input::get('username')); ?>">
							</div>
					
							<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
							<button class="btn btn-lg btn-success btn-block" type="submit" value="Upload">Upload</button> 
                        </fieldset>
                    </form>
					
                </div>
            </div>
        </div>
    </div>
</div>
	
	
<?php include 'includes/overall/footer.php'; ?>