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
			'name' => array(
				'required' => true,
				'min' => 2,
				'max' => 50),
			'email' => array(
				'required' => true,
				'min' => 2,
				'max' => 50),
			'company' => array(
				'required' => true,
				'min' => 2,
				'max' => 50),
			'job_title' => array(
				'required' => true,
				'min' => 2,
				'max' => 50)
		));

		if($validation->passed()) {

			try {
				$user->update(array(
					'name' => Input::get('name'),
					'email' => Input::get('email'),
					'company' => Input::get('company'),
					'job_title' => Input::get('job_title')
				));
			} catch(Exception $e) {
				die($e->getMessage());
			}

			Session::flash('home', 'Your details have been updated.');
			Redirect::to('index.php');
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
                    <h3 class="panel-title">Update account information</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post">
                        <fieldset>
							<div class="form-group">
								<input type="name" class="form-control" id="name" name="name" placeholder="Enter name" value="<?php echo escape($user->data()->name); ?>">
							</div>
							<div class="form-group">
								<input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="<?php echo escape($user->data()->email); ?>">
							</div>
							<div class="form-group">
								<input type="company" class="form-control" id="company" name="company" placeholder="Enter company name" value="<?php echo escape($user->data()->company); ?>">
							</div>
							<div class="form-group">
								<input type="job_title" class="form-control" name="job_title" id="job_title" placeholder="Enter job title" value="<?php echo escape($user->data()->job_title); ?>">
							</div>
							<button class="btn btn-lg btn-success btn-block" type="submit" value="Update">Update</button> 
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








