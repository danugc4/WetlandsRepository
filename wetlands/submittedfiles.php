<?php
require 'core/init.php';
include 'includes/overall/header.php';



if (Session::exists('home')) {
    echo '<p>', Session::flash('home'), '</p>';
}
if ($user->isLoggedIn()) {
if ($user->hasPermission('admin')) {



    $the = DB::getInstance()->query('SELECT file.filename, file.uploaded, users.username
FROM file
INNER JOIN users
ON file.username = users.id ORDER BY uploaded DESC');
    ?>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Filename</th>
                        <th>Uploaded by</th>
                        <th>Upload date</th>
                    </tr>
                </thead>
                <tbody>

    <?php
    foreach ($the->results() as $the) {



        echo '<tr><td>', '<a href="uploaded/', $the->filename, '" download>', $the->filename, '</a>', '</td>', '<td>', $the->userID, '</td>', '<td>', $the->uploaded, '</td></tr>';
    }
    ?> 

                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>







    


    <?php include 'includes/overall/footer.php';
}
}else{
Redirect::to('index.php'); }?>
	
