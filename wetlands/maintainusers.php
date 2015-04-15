<?php
require 'core/init.php';
include 'includes/overall/header.php';
if ($user->hasPermission('admin')) {
    ?>  
<br><br>
        <div class="row">
            <div class="col-sm-offset-3">
                <div class = "container">
                    <?php include "includes/partials/usergrid.php"; ?> 
                    <br><a href = "admin.php">Admin page</a>
                </div>
            </div>
        </div>      
  
    <?php
} else {
    Redirect::to('index.php');
    include 'includes/overall/footer.php';
}
?>


