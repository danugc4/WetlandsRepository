<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" type="text/css" media="screen"
	href="jqgrid/themes/jquery-ui.theme.css" />
<link rel="stylesheet" type="text/css" media="screen"
	href="jqgrid/themes/ui.jqgrid.css" />

<script src="jqgrid/js/jquery.min.js" type="text/javascript"></script>
<script src="jqgrid/js/trirand/i18n/grid.locale-en.js"
	type="text/javascript"></script>
<script type="text/javascript">
		$.jgrid.no_legacy_api = true;
		$.jgrid.useJSON = true;
		$.jgrid.defaults.width = "700";
	</script>
<script src="jqgrid/js/trirand/jquery.jqGrid.min.js"
	type="text/javascript"></script>
</head>
	<?php
	require 'core/init.php';
	include 'includes/overall/header.php';	

 	if( $_GET["county"] )
	{
		$county = $_GET['county'];		
	}	
	if( $_GET["siteSource"] )
	{
		$siteSource = $_GET['siteSource'];		
	}	
	if( $_GET["pretreatment"] )
	{
		$pretreatment = $_GET['pretreatment'];		
	}
	if( $_GET["wetland"] )
	{
		$wetland = $_GET['wetland'];
	}	
	if( $_GET["wetlandID"] )
	{
		$wetlandID = $_GET['wetlandID'];
	} 
	?>
	
	<body>
	
	<div class="container">
		<div class="row">
			<div class="col-sm-9">
				<h4 id="wetland" data-id="<?php echo $wetlandID ?>">Wetland : <?php echo $wetland ?></h4>
				<h4>County : <?php echo $county ?></h4>
				<h4>SiteSource : <?php echo $siteSource ?></h4>
				<h4>Pretreatment : <?php echo $pretreatment ?></h4>
			</div>
		</div>
	</div> 
	 
	<div class="container">
		<div class="row">
			<div class="col-sm-9">

				<div id="sample-list"></div>

			</div>
		</div>
	</div>
	
	<div class = "container">
	
			
	        <?php 	       
	        include_once "partials/samplesgrid.php";
	        ?>		   
	  </div>	
	   <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>		 	    
	
<?php include 'includes/overall/footer.php'; ?>	
				
	</body>

</html>