<?php
require_once  __DIR__.'/../../core/jq-config.php';
// include the jqGrid Class
require_once __DIR__.'/../../jqgrid/php/jqGrid.php';
// include the PDO driver class
require_once __DIR__.'/../../jqgrid/php/jqGridPdo.php';
// Connection to the server
$conn = new PDO(DB_DSN,DB_USER,DB_PASSWORD);
// Tell the db that we use utf-8
$conn->query("SET NAMES utf8");

// Create the jqGrid instance
$grid = new jqGridRender($conn);
// Write the SQL Query
$grid->SelectCommand = 'SELECT wetlandID, sampleDate, dailyFlowRate, COD_inlet, COD_outlet, BOD_inlet, BOD_outlet FROM SampleView';

// set the ouput format to json
$grid->dataType = 'json';
// Let the grid create the model
$grid->setColModel();
// Set the url from where we obtain the data
$grid->setUrl('includes/partials/samplesgrid.php');


if (isset( $_GET["wetlandID"] )) {
$wetlandID = $_GET["wetlandID"];
// initialsearch
$sarr = <<< FFF
{"groupOp":"AND","rules":[{"field":"wetlandID","op":"eq","data":"$wetlandID"}]}
FFF;
	
// Set grid caption using the option caption
$grid->setGridOptions(array(
		"caption"=>"Wetland Sample Data",
		"rowNum"=>15,
		"sortname"=>"wetlandID",
		"rowList"=>array(10,20,50),
		// set the initila search upon loading
		"search"=>true,
		// setr criteria
		"postData"=>array( "filters"=> $sarr )
));
} else {
	// Set grid caption using the option caption
	$grid->setGridOptions(array(
			"caption"=>"Wetland Sample Data",
			"rowNum"=>15,
			"sortname"=>"wetlandID",
			"rowList"=>array(10,20,50)				
	));	
}

// Change some property of the field(s)
$grid->setColProperty("wetlandID", array("label"=>"WetlandID", "width"=>70));
// Change some property of the field(s)
$grid->setColProperty("sampleDate", array(
	"label"=>"Sample Date",  "width"=>120,
	"formatter"=>"date",
	"formatoptions"=>array("srcformat"=>"Y-m-d H:i:s","newformat"=>"d/m/Y")
	)
);

$grid->setColProperty("dailyFlowRate", array("label"=>"Daily Flow Rate", "width"=>70));
$grid->setColProperty("COD_inlet", array("label"=>"COD_inlet", "width"=>70));
$grid->setColProperty("COD_outlet", array("label"=>"COD_outlet", "width"=>70));
$grid->setColProperty("BOD_inlet", array("label"=>"BOD_inlet", "width"=>70));
$grid->setColProperty("BOD_outlet", array("label"=>"BOD_outlet", "width"=>70));
/*$grid->setColProperty("suspSolids_inlet", array("label"=>"SS_inlet", "width"=>70));
$grid->setColProperty("suspSolids_outlet", array("label"=>"SS_outlet", "width"=>70));
$grid->setColProperty("pH_inlet", array("label"=>"pH_inlet", "width"=>70));
$grid->setColProperty("pH_outlet", array("label"=>"pH_outlet", "width"=>70));
 $grid->setColProperty("dissolvedOxy_inlet", array("label"=>"Oxy_inlet", "width"=>70));
$grid->setColProperty("dissolvedOxy_outlet", array("label"=>"Oxy_outlet", "width"=>70));
$grid->setColProperty("temp_inlet", array("label"=>"Temp_inlet", "width"=>70));
$grid->setColProperty("temp_outlet", array("label"=>"Temp_outlet", "width"=>70));
$grid->setColProperty("nitrogen_inlet", array("label"=>"N_inlet", "width"=>70));
$grid->setColProperty("nitrogen_outlet", array("label"=>"N_outlet", "width"=>70));
$grid->setColProperty("NH4N_inlet", array("label"=>"NH4N_inlet", "width"=>70));
$grid->setColProperty("NH4N_outlet", array("label"=>"NH4N_outlet", "width"=>70));
$grid->setColProperty("NO3N_inlet", array("label"=>"NO3N_inlet", "width"=>70));
$grid->setColProperty("NO3N_outlet", array("label"=>"NO3N_outlet", "width"=>70));
$grid->setColProperty("TON_inlet", array("label"=>"TON_inlet", "width"=>70));
$grid->setColProperty("TON_outlet", array("label"=>"TON_outlet", "width"=>70));
$grid->setColProperty("phosphorous_inlet", array("label"=>"P_inlet", "width"=>70));
$grid->setColProperty("phosphorous_outlet", array("label"=>"P_outlet", "width"=>70));
$grid->setColProperty("PO4P_inlet", array("label"=>"PO4P_inlet", "width"=>70));
$grid->setColProperty("PO4P_outlet", array("label"=>"PO4P_outlet", "width"=>70)); */

// Run the script
$grid->renderGrid('#grid','#pager',true, null, null, true,true);
$conn = null;
?>