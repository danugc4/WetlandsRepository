<?php
require 'core/init.php';
$db = DB::getInstance();

$wetlandQuery = "SELECT PretreatmentType.id, PretreatmentType.name AS type, Wetland.name, Wetland.county FROM PretreatmentType LEFT JOIN Wetland ON PretreatmentType.id = Wetland.pretreatmentType";
$wetlands = $db->run($wetlandQuery);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Dropdowns</title>
	</head>
	<body>
	
		<form action"listing.php" method="get">
			<select name="pretreatment">
				<option value="">Choose a pretreatment type</option>
					 	<?php foreach($wetlands as $wetland): ?> 
	 	     			 <option value="<?php echo $wetland['id']; ?>"><?php echo $wetland['name']; ?></option> 
       					 <?php endforeach; ?> 
			</select>
		
		</form>
	      
	 	
	 	</body>
	 	</html>