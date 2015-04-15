<?php
require 'core/init.php';
include 'includes/overall/header.php';
if ($user->hasPermission('admin')) {
    ?>
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="login-panel panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Admin page, hello <a href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a>!</h3>
                    </div>
                    <div class="panel-body">
                        <ul>
                            <li><a href="maintainwetlands.php">Maintain Wetlands</a></li>
                            <li><a href="maintainarticles.php">Maintain Articles</a></li>
                            <li><a href="maintainusers.php">Maintain Registered Users</a></li>
                            <li><a href="uploadedfiles.php">Uploaded Files</a></li>
                        </ul>
                        <br>
                        <a href = "profile.php">Profile page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    Redirect::to('index.php');
    include 'includes/overall/footer.php';
}
?>