<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<link rel="stylesheet" type="text/css" media="screen"
	href="jqgrid/themes/jquery-ui.theme.css" />
	<link rel="stylesheet" type="text/css" media="screen"
	href="jqgrid/themes/ui.jqgrid.css" />
	<script src="jqgrid/js/jquery.min.js" type="text/javascript"></script>
	<script src="jqgrid/js/trirand/i18n/grid.locale-en.js"	type="text/javascript"></script>

	<script src="js/galleria/galleria-1.4.2.min.js"></script> 

    <link rel="stylesheet" href="css/galleria/themes/classic/galleria.classic.css"/> 
    <script src="css/galleria/themes/classic/galleria.classic.min.js"></script> 

<script type="text/javascript">
		$.jgrid.no_legacy_api = true;
		$.jgrid.useJSON = true;
		$.jgrid.defaults.width = "700";
</script>
<script src="jqgrid/js/trirand/jquery.jqGrid.min.js"type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){ 
	
    $("#data_tabs li:eq(0) a").tab('show');
    $(".datepicker").datepicker({dateFormat:'dd/mm/yy'});
	
	$("#search").click(function(){
		var id = $( "#wetland" ).data( "id" );
		var from = mysqlDate($("#from").val());
		var to = mysqlDate($("#to").val());
				
		
		var f = {groupOp:"AND",rules:[]};
		f.rules.push({field:"wetlandID",op:"eq",data:id});			 
		if (from) { f.rules.push({field:"sampleDate",op:"ge",data:from}); }
		if (to) { f.rules.push({field:"sampleDate",op:"le",data:to}); }
		
		$("#grid").search = true;
		$("#grid").setGridParam({          
              postData: {
	             filters:JSON.stringify(f)  },
	             search: true
	    });		    		
		
		
		$("#grid").trigger("reloadGrid",[{page:1,current:true}]); 


	});

	function mysqlDate(date) {
		try {
			var mySQLdate = $.datepicker.parseDate( 'dd/mm/yy', date ) || false;		
		if (!mySQLdate) return false;	 
		} catch (e) { return false; }
		
		var splitter = date.split("/");
		console.log("splitter: " + splitter);
		return splitter[2]+'-'+splitter[1]+'-'+splitter[0];	 
	};


	var images = [
	              { image: 'images/wetlands/DSCN2579.jpg'},
	              { image: 'images/wetlands/IMG_1997.JPG'},
	              { image: 'images/wetlands/Leitrim6Mar2014 058.jpg'},
	              { image: 'images/wetlands/Leitrim6Mar2014 062.jpg'}
	          ];

    Galleria.configure({
              transition: 'fade',
              imageCrop: true,
              dataSource: images
          });
    Galleria.run('.galleria');	
});
</script>
</head>
	<?php
	require 'core/init.php';
	include 'includes/overall/header.php';	
	
	$wetlandID = (isset( $_GET["wetlandID"] )) ? $_GET["wetlandID"] : '';
	?>	
	<body>
	
	<div class="container">
		<div class="row">
			<div class="col-sm-9">
				<h4 id="wetland" data-id="<?php echo $wetlandID ?>">Wetland : <?php echo ((isset( $_GET["wetland"] )) ? $_GET['wetland'] : '') ?></h4>
				<h4>County : <?php echo ((isset( $_GET["county"] )) ? $_GET['county'] : '') ?></h4>
				<h4>SiteSource : <?php echo ((isset( $_GET["siteSource"] )) ? $_GET['siteSource'] : '') ?></h4>
				<h4>Pretreatment : <?php echo ((isset( $_GET["pretreatment"] )) ? $_GET['pretreatment'] : '') ?></h4>
			</div>
		</div>
	</div> 
	

	
	 
	<div class="container">
		<div class="row">
			<div class="col-sm-9">

			<ul class="nav nav-tabs" id="data_tabs">
		        <li><a data-toggle="tab" href="#samples_section">Sample Data</a></li>
		        <li><a data-toggle="tab" href="#wetland_section">Wetlands Details</a></li>
		        <li><a data-toggle="tab" href="#publications_section">Publication List</a></li>
		        <li><a data-toggle="tab" href="#observations_section">Observations</a></li>		        
		    </ul>

			</div>
		</div>
	</div>
	<div class="tab-content" >
		   <div id="samples_section" class="tab-pane fade in active">
		   	  <div>
				  From: <input id="from" class="datepicker" size="10"></input>
				  To: <input id="to" class="datepicker" size="10"></input>
				  <input id="search" type="button" value="Search"></input>
				  <br/>
				  <br/>
			  </div>				
		     <div><?php  
		     $_GET['wetlandID']= $wetlandID;
		     include_once "includes/partials/samplesgrid.php";  ?></div>	   
		  </div>
		  <div id="wetland_section" class="tab-pane fade">
		 	 <div class="galleria" style="width:400px; height:300px"/>
		  </div>
		  
		  <div id="publications_section" class="tab-pane fade">
		  	<p>publication listing</p>
		  </div>
		  <div id="observations_section" class="tab-pane fade">
		  	<p>observations</p>
		  </div>
	</div>	
	
	
	
		<?php include 'includes/footer_grid.php'; ?>
	</body>

</html>