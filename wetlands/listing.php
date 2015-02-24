<?php
require 'core/init.php';
$db = DB::getInstance();
 
$pretreatments= $db->getAll('PretreatmentType', false)->results();

if(isset($_GET['pretreatment'])) {
	$selectedPretreatment = $_GET['pretreatment'];
	$wetlands = $db->get('Wetland', array('pretreatmentType', '=', $selectedPretreatment), false)->results();
}
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
					 	<?php foreach($pretreatments as $pretreatment): ?> 
	 	     			 <option value="<?php echo $pretreatment['id']; ?>" 
	 	     			 <?php echo (isset($selectedPretreatment) && $selectedPretreatment == $pretreatment['id']) ? ' selected' : '' ?>>
	 	     			 <?php echo $pretreatment['name']; ?></option> 
       					 <?php endforeach; ?> 
			</select>
			<input type="submit" value="Show details">
		</form>     
	      	
	 	
	 	</body>
	 	</html>