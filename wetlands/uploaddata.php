<?php
require 'core/init.php';
include 'includes/overall/header.php';

;




if (Session::exists('home')) {
    echo '<p>', Session::flash('home'), '</p>';
}

if ($user->isLoggedIn()) {


    if ($user->hasPermission('auth')) {
        
        $result = array();

        if (Input::exists()) {


            if (isset($_POST['upload'])) {

                $destination = __DIR__ . '/uploaded/';
                try {
                    $upload = new UploadFile($destination);
                    
                    
                    $upload->upload();
                    $result = $upload->getMessages();
                } catch (Exception $e) {
                    $result[] = $e->getMessage();
                }
            }
        }


        $error = error_get_last();
        ?>

        <h1>Uploading Files</h1>
        <?php if ($result || $error) { ?>
            <ul class="result">
                <?php
                if ($error) {
                    echo "<li>{$error['message']}</li>";
                }
                if ($result) {
                    foreach ($result as $message) {
                        echo "<li>$message</li>";
                    }
                }
                ?>
            </ul>
        <?php } ?>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Upload your files!</h3>
                        </div>
                        <div class="panel-body">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                <p>
                                    
                                    <label for="filename">Select File:</label>
                                    <input type="file" name="filename[]" id="filename" multiple>
                                    <input type="submit" name="upload" value="Upload File">
                                </p>
                                <br>
                                <a href = "profile.php" class = "navbar-btn btn-danger btn">Profile page</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php
        include 'includes/overall/footer.php';
    }
} else {
    Redirect::to('index.php');
}
?>