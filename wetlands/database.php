<!DOCTYPE html>
<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" media="screen" href="jqgrid/themes/jquery-ui.theme.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="jqgrid/themes/ui.jqgrid.css" />

	<script src="jqgrid/js/jquery.min.js" type="text/javascript"></script>


    </script>
	
	
	</head>
	<?php 
	require 'core/init.php';
	include 'includes/overall/header.php'; 
	?>
	<body>
	
      <div>
          From: <input id="from" class="datepicker" size="10"></input>
          To: <input id="to" class="datepicker" size="10"></input>
          <input id="search" type="button" value="Search"></input>
          <br/>
          <br/>
      </div>
	 <div class = "container">
			<div class = "row">			
			<div class = "col-sm-9">
	      <?php include "wetlandsgrid.php";?>
	   </div>
	</div>		
		<?php include 'includes/overall/footer.php'; ?>	
	</body>
	
</html>