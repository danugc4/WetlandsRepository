<header>

    <div class = "navbar navbar-inverse navbar-static-top">
        <div class = "container">
            <h1>Constructed Wetlands</h1>
            <button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
                <span class = "icon-bar"></span>
                <span class = "icon-bar"></span>
                <span class = "icon-bar"></span>
            </button>
            <div class = "collapse navbar-collapse navHeaderCollapse">
                <ul class = "nav navbar-nav navbar-right">
                    <li><a href = "index.php">Home</a></li>
                    <li><a href = "sample_query.php">Database</a></li>
                    <li><a href = "articles.php">Articles</a></li>
                    <li><a href = "about.php">About</a></li>
                    <li><a href = "contact.php">Contact</a></li>
                    <?php
                    if ($user->isLoggedIn()) {

                    
                    ?>



                    <li><a href = "profile.php">Profile</a></li>
                    <li><a href = "logout.php">Logout</a></li>
                    <?php
                    }else {
                        ?>

                        <li><a href = "login.php">Login</a></li>
                        <li><a href = "register.php">Register</a></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</header>




