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
		var select='';
		$(document).ready(function(){
			//Select all dropdown items	
			$("#filter select").on('change', function() {
				var county = $('#county-select').val() || '%' ;
				var siteSource = $('#siteSource-select').val() || '%' ;
				var pretreatment = $('#pretreatment-select').val() || '%' ;				

				if ((county == '%') && (siteSource == '%') && (pretreatment == '%')) {
					$("#grid").search = false;
					$("#grid").setGridParam({          
		                 postData: {
			                 filters:'' },
			                 search: false
			        });
			        
				} else {
	                var f = {groupOp:"AND",rules:[]};
	
	                if (county != '%') {
	                	f.rules.push({field:"county",op:"cn",data:county});
	                }
	
	                if (siteSource != '%') {
	                	f.rules.push({field:"siteSource",op:"cn",data:siteSource});
	                }
	                if (pretreatment != '%') {
	                	f.rules.push({field:"pretreatment",op:"cn",data:pretreatment});
	                }
					
	                $("#grid").search = true;
	                
	                $("#grid").setGridParam({          
		                 postData: {
			                 filters:JSON.stringify(f)  },
			                 search: true
			        });
				}
				
                $("#grid").trigger("reloadGrid",[{page:1,current:true}]); 		 
				
			});
		});	
	</script>
	
	</head>
	<?php 
	require 'core/init.php';
	include 'includes/overall/header.php'; 
	
	$counties = array("Carlow","Cavan","Clare","Cork","Donegal","Dublin","Galway","Kerry","Kildare","Kilkenny","Laois","Leitrim","Limerick","Longford","Louth","Mayo","Meath","Monaghan","Offaly","Roscommon","Sligo","Tipperary","Waterford","Westmeath","Wexford","Wicklow");
	
	$db = DB::getInstance();
	
    $siteSources= $db->getAll('SiteSourceType', false)->results();
	$pretreatments= $db->getAll('PretreatmentType', false)->results();
	
	
	?>
	
	<body>
	<p></p>
	 <div class = "container" id="filter" >
	    <div class = "row">			
		    <div class = "col-sm-9">
			<select name="county"  id="county-select">
				<option value="%">All counties</option>
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
			<select name="siteSource"  id="siteSource-select">
				<option value="%">All source of waste water</option>
					 	<?php foreach($siteSources as $siteSource): ?> 
	 	     			 <option ><?php echo $siteSource['name']; ?></option> 
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
				<option value="%">All pretreatment types</option>
					 	<?php foreach($pretreatments as $pretreatment): ?> 
	 	     			 <option><?php echo $pretreatment['name']; ?></option> 
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