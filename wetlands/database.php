<!DOCTYPE html>
<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" media="screen" href="jqgrid/themes/jquery-ui.theme.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="jqgrid/themes/ui.jqgrid.css" />

	<script src="jqgrid/js/jquery.min.js" type="text/javascript"></script>	
	<script src="jqgrid/js/trirand/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script type="text/javascript">
		$.jgrid.no_legacy_api = true;
		$.jgrid.useJSON = true;
		$.jgrid.defaults.width = "700";
	</script>
	<script src="jqgrid/js/trirand/jquery.jqGrid.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			//$("select").css("border", "3px solid red");	
			$("#filter select").on('change', function() {
				//var pretreatment = $("#pretreatment-select").val();
				var foo = $(this).val();
				$("select").css("border", "3px solid red");	

				//alert($("#pretreatment-select").html());
				//alert(foo);	
				$("#grid").jqGrid('setGridParam', {postData:{"pretreatment":foo}, search: true} );
				$("#grid").trigger("reloadGrid"); 		
				
			});
		});	
	</script>
	
	</head>
	<?php 
	require 'core/init.php';
	include 'includes/overall/header.php'; 
	
	$counties = array("Carlow","Cavan","Clare","Cork","Donegal","Dublin","Galway","Kerry","Kildare","Kilkenny","Laois","Leitrim","Limerick","Longford","Louth","Mayo","Meath","Monaghan","Offaly","Roscommon","Sligo","Tipperary","Waterford","Westmeath","Wexford","Wicklow");
	
	$db = DB::getInstance();
	
    $waterSources= $db->getAll('SiteSourceType', false)->results();
	$pretreatments= $db->getAll('PretreatmentType', false)->results();
	
	?>
	
	<body>

	 <div class = "container" id="filter" >
	    <div class = "row">			
		    <div class = "col-sm-9">
			<select name="county"  id="county-select">
				<option value="">Choose a county</option>
				      <?php foreach($counties as $county): ?>
				      <option> <?php echo $county; ?></option> 
				       <?php endforeach; ?>  
			</select>
			</div>
		</div>
	</div> 
   <br>
   	<div class = "container" id="filter" >
	    <div class = "row">			
		    <div class = "col-sm-9"> 
			<select name="waterSource"  id="waterSource-select">
				<option value="">Choose a source of waste water</option>
					 	<?php foreach($waterSources as $waterSource): ?> 
	 	     			 <option value="<?php echo $waterSource['id']; ?>" >
	 	     			 <?php echo $waterSource['name']; ?></option> 
       					 <?php endforeach; ?> 
			</select>   
			</div>
		</div>
	</div>
	 <br>
	<div class = "container" id="filter" >
	    <div class = "row">			
		    <div class = "col-sm-9"> 
			<select name="pretreatment"  id="pretreatment-select">
				<option value="">Choose a pretreatment type</option>
					 	<?php foreach($pretreatments as $pretreatment): ?> 
	 	     			 <option value="<?php echo $pretreatment['id']; ?>" >
	 	     			 <?php echo $pretreatment['name']; ?></option> 
       					 <?php endforeach; ?> 
			</select>   
			</div>
		</div>
	</div>
	<br>
	<div id="example"></div>
			
	<div class = "container">
	    <div class = "row">			
		    <div class = "col-sm-9">
			
		    <div id="wetlands-list"></div>
			
			</div>
		</div>
	</div>	  
			
			
	        <?php include "wetlandsgrid.php";?>			
		    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	 	    
			<?php include 'includes/overall/footer.php'; ?>	

	</body>
	
</html>