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
	if( $_GET["wetlandID"] )
	{
		$wetlandID = $_GET['wetlandID'];
		echo "Welcome ". $wetlandID;
	}
	?>
	
	<body>
	<p>Hello Gary </p>
	 
	<div class="container">
		<div class="row">
			<div class="col-sm-9">

				<div id="sample-list"></div>

			</div>
		</div>
	</div>
		    <?php include "partials/samplesgrid.php";?>		 	    
			<?php include 'includes/overall/footer.php'; ?>	
				
	</body>

</html>