<?php
require 'core/init.php';
$db = DB::getInstance();
 
$pretreatments= $db->getAll('PretreatmentType', false)->results();


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Dropdowns</title>
	</head>
	<body>
	
			
		
			<select name="pretreatment"  id="pretreatment-select">
				<option value="">Choose a pretreatment type</option>
					 	<?php foreach($pretreatments as $pretreatment): ?> 
	 	     			 <option value="<?php echo $pretreatment['id']; ?>" >
	 	     			 <?php echo $pretreatment['name']; ?></option> 
       					 <?php endforeach; ?> 
			</select>
			
		    <div id="wetlands-list"></div>
	      	
	 	 <?php include 'includes/overall/footer.php'; ?>
	 	 <script src="js/global.js"></script>	 	 
	 	 </body>
	 	 </html>

	 	
	 	