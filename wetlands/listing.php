<?php
require 'core/init.php';
$db = DB::getInstance();

$pretreatmentsdb = $db->getAll('PretreatmentType');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Dropdowns</title>
	</head>
	<body>
	
		<form action="listing.php" method="get">		
		
			<select name="pretreatment">
				<option value="">Choose a pretreatment type</option>
					 	<?php foreach($pretreatmentsdb->results() as $pretreatment): ?> 
	 	     			 <option value="<?php echo $pretreatment->id; ?>"><?php echo $pretreatment->name; ?></option> 
       					 <?php endforeach; ?> 
			</select>
		
		</form>
	      
	 	
	 	</body>
	 	</html>