<?php
require 'core/init.php';
include 'includes/overall/header.php';

$user = new User();

?>
<br><br>
	<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Forgotten your password?</h3>
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter registered e-mail address" id="email" name="email" type="text">
                                </div>
                                
								<input type ="submit" value="Change" class="btn btn-lg btn-success btn-block"> 
								<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                            </fieldset>
                        </form>
						<div>
						<br><a href = "login.php">Back to login</a></p>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $email = Input::get('email');
$db = DB::getInstance();
$useremails = $db->query('SELECT * FROM users');
$articleArray = Array();
$i = 0;
foreach($useremails->results() as $useremail)
{
	$userArray[$i]=$useremail->email;
}

if(Input::exists()) {
function generateRandomString($length = 10) {
    $characters = '23456789abcdefghijkmnprstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

			
				try {
					for($count = 0; $count<count($userArray); $count++)
					{
						if($userArray[$count]===$email)
						{				
						$newpassword = generateRandomString();
						$salt = Hash::salt(32);
						$passwordhashed = Hash::make($newpassword, $salt);
						$db->query("UPDATE `users` SET password='$passwordhashed', salt='$salt' WHERE email='$email';");
						$formcontent="From: The NUIG Constructed Wetlands Database \nMessage: Your password has been reset. Please contact us on our website if you did not request a password change. Your new password is $newpassword. Please change your password from the profile menu as soon as possible.";
						$recipient1 = $email;
						$subject = "Password Change";
						$mailheader = "From: The NUIG Constructed Wetland Database \r\n";
						mail($recipient1, $subject, $formcontent, $mailheader) or die("Error!");
						}
					}
				    }				catch(Exception $e) {
					die("There was an error updating the password.");
				}
			}
		
	

?>

<?php include 'includes/overall/footer.php'; ?>
