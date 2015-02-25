<!DOCTYPE html>
<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" media="screen" href="jqgrid/themes/jquery-ui.theme.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="jqgrid/themes/ui.jqgrid.css" />

	<script src="jqgrid/js/jquery.min.js" type="text/javascript"></script>	
	
	</head>
	<?php 
	require 'core/init.php';
	include 'includes/overall/header.php'; 
	$db = DB::getInstance();
	
	$pretreatments= $db->getAll('PretreatmentType', false)->results();
	
	?>
	
	<body>

	 <div class = "container">
			<div class = "row">			
			<div class = "col-sm-9">
			<br>
			<select name="pretreatment"  id="pretreatment-select">
				<option value="">Choose a pretreatment type</option>
					 	<?php foreach($pretreatments as $pretreatment): ?> 
	 	     			 <option value="<?php echo $pretreatment['id']; ?>" >
	 	     			 <?php echo $pretreatment['name']; ?></option> 
       					 <?php endforeach; ?> 
			</select>
			
		    <div id="wetlands-list"></div>
			<br>
			
			
	          <?php include "wetlandsgrid.php";?>
	   		</div>
			</div>		
			</div>	
				
		    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	 	    <script src="js/global.js" type="text/javascript"></script>
			<?php include 'includes/overall/footer.php'; ?>	

	</body>
	
</html>