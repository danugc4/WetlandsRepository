<?php 
include 'includes/overall/header.php'; 
require 'core/init.php';
$user = new User();

if(Session::exists('home')) {
	echo '<p>', Session::flash('home'), '</p>';
}

if($user->hasPermission('admin')) {

	$member = DB::getInstance()->query('SELECT * FROM users');
	//$per = DB::getInstance()->query('SELECT `groups`.`name` FROM users, groups WHERE (`users`.`group` = groups.id)');
	 
		
		
		
		
		
		
?>

<div class="container">
    <div class="table-responsive">
                                      <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Username</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
													<th>Company</th>
													<th>Job title</th>
													<th>Join date</th>
													<th>Access level</th>
													
                                                </tr>
                                            </thead>
                                            <tbody>
											
                                                <?php foreach($member->results() as $member) {
												echo '<tr><td>', $member->username, '</td>', '<td>', $member->name,'</td>', '<td>', $member->email, '</td>', '<td>', $member->company, '</td>','<td>', $member->job_title, '</td>','<td>', $member->joined, '</td>','<td>', $member->group, '</td>','</tr>'; 
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