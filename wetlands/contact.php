<?php 
include 'core/init.php';
include 'includes/overall/header.php'; 
?>
	<div class="container">
	<div class="jumbotron">
	
            <div class="box">
                
                    <hr>
                    <h2 class="intro-text text-center"><strong>Contact Us<strong></h2><br>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, vitae, distinctio, possimus repudiandae cupiditate ipsum excepturi dicta neque eaque voluptates tempora veniam esse earum sapiente optio deleniti consequuntur eos voluptatem.</p>
                    <form role="form-success" action="mail.php" method="POST">
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Email Address</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Phone Number</label>
                                <input type="tel" class="form-control" name="number">
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group ">
                                <label>Message</label>
                                <textarea class="form-control" rows="10" name="message"></textarea>
                            </div>
                            <div class="form-group col-sm-12">
                                <input type="hidden" name="save" value="contact">
                                <button type="submit" class="btn btn-success" onclick="submissionMessage()">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


<?php include 'includes/overall/footer.php'; ?>
<html>
<body>
<script>
function submissionMessage()
{
alert("Thank you for your e-mail. It will be dealt with as soon as possible.");
}
</script>
</body>
</html>