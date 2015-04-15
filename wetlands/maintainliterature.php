<?php 
require 'core/init.php';
include 'includes/overall/header.php';
$user = new User();

if(Session::exists('home')) {
	echo '<p>', Session::flash('home'), '</p>';
}

if($user->hasPermission('admin')) {

	$publication = DB::getInstance()->query('SELECT * FROM Literature');
	
	 
		
			
		
		
		
		
		
?>

<div class="container">
    <div class="table-responsive">
                                      <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Title</th>
                                                    <th>Author</th>
													<th>Year</th>
													<th>Publisher</th>
													<th>DOI</th>
													<th>List priority</th>
													
                                                </tr>
                                            </thead>
                                            <tbody>
											
                                                <?php foreach($publication->results() as $publication) {
												
												echo '<tr><td>', $publication->LiteratureID, '</td>', '<td>', $publication->LiteratureTitle,'</td>', '<td>', $publication->LiteratureAuthor, '</td>', '<td>', $publication->LiteratureDate, '</td>','<td>', $publication->Publisher, '</td>','<td>', $publication->DOI,'</td>','<td>', $publication->listPriority, '</td>','</tr>'; 
												
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