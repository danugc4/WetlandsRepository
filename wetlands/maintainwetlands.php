<?php 
require 'core/init.php';
include 'includes/overall/header.php';
$user = new User();

if(Session::exists('home')) {
	echo '<p>', Session::flash('home'), '</p>';
}

if($user->hasPermission('admin')) {

	$wetland = DB::getInstance()->query('SELECT * FROM Wetland');
	
	 
		
			
		
		
		
		
		
?>

<div class="container">
    <div class="table-responsive">
                                      <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>County</th>
													<th>Source</th>
													<th>Pretreatment</th>
													<th>Size</th>
													<th>Description</th>
													
                                                </tr>
                                            </thead>
                                            <tbody>
											
                                                <?php foreach($wetland->results() as $wetland) {
												
												echo '<tr><td>', $wetland->id, '</td>', '<td>', $wetland->name,'</td>', '<td>', $wetland->county, '</td>', '<td>', $wetland->siteSourceType, '</td>','<td>', $wetland->pretreatmentType, '</td>','<td>', $wetland->siteSize,'</td>','<td>', $wetland->siteDescription, '</td>','</tr>'; 
												
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