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
$grid->SelectCommand = 'SELECT wetlandID, sampleDate, dailyFlowRate, COD, BOD, suspSolids, pH, dissolvedOxy, temp, nitrogren, NH4N, NO3N, TON, phosphorous, PO4P FROM Sample';


$ID = jqGridUtils::GetParam('wetlandID', '2');

// Write the SQL Query
$search = jqGridUtils::GetParam('_search','false');
if($search == 'true')
{
	
	// get the date
	$from = jqGridUtils::GetParam('from','01/01/1995');
	$to = jqGridUtils::GetParam('to','31/12/2020');
	// Reformat it to DB appropriate search
	$from = jqGridUtils::parseDate('d/m/Y', $from, 'Ymd');
	$to = jqGridUtils::parseDate('d/m/Y', $to, 'Ymd');
	
	
    $cmd = 'SELECT wetlandID, sampleDate, dailyFlowRate, COD, BOD, suspSolids, pH, dissolvedOxy, temp, nitrogren, NH4N, NO3N, TON, phosphorous, PO4P FROM Sample WHERE wetlandID = '.$ID. ' AND sampleDate >= "'.$from.'" AND sampleDate <= "'.$to.'"'; 
    $_GET['_search'] = 'false';
    $grid->SelectCommand = 'SELECT wetlandID, sampleDate, dailyFlowRate, COD, BOD, suspSolids, pH, dissolvedOxy, temp, nitrogren, NH4N, NO3N, TON, phosphorous, PO4P FROM Sample WHERE wetlandID = '.$ID. ' AND sampleDate >= "'.$from.'" AND sampleDate <= "'.$to.'"';
    //$grid->debug = true;
} else {
	
	// use the standard SelectCommand
	$grid->SelectCommand = 'SELECT wetlandID, sampleDate, dailyFlowRate, COD, BOD, suspSolids, pH, dissolvedOxy, temp, nitrogren, NH4N, NO3N, TON, phosphorous, PO4P FROM Sample WHERE wetlandID = '.$ID;
	
}
// set the ouput format to json
$grid->dataType = 'json';
// Let the grid create the model
$grid->setColModel();
// Set the url from where we obtain the data
$grid->setUrl('includes/partials/samplesgrid.php');

// initialsearch
$sarr = <<< FFF
{ "groupOp":"AND",
	"rules":[
	  {"field":"wetlandID","op":"cn","data":"3"}
	 ]
}
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

// Change some property of the field(s)
$grid->setColProperty("wetlandID", array("label"=>"WetlandID", "width"=>60));
// Change some property of the field(s)
$grid->setColProperty("sampleDate", array(
	"label"=>"Sample Date",  "width"=>120,
	"formatter"=>"date",
	"formatoptions"=>array("srcformat"=>"Y-m-d H:i:s","newformat"=>"d/m/Y")
	)
);
$grid->setColProperty("dailyFlowRate", array("label"=>"Daily Flow Rate", "width"=>60));
$grid->setColProperty("COD", array("label"=>"COD", "width"=>60));
$grid->setColProperty("BOD", array("label"=>"BOD", "width"=>60));
$grid->setColProperty("suspSolids", array("label"=>"SS", "width"=>60));
$grid->setColProperty("pH", array("label"=>"pH", "width"=>60));
$grid->setColProperty("dissolvedOxy", array("label"=>"Oxy", "width"=>60));
$grid->setColProperty("temp", array("label"=>"Temp", "width"=>60));
$grid->setColProperty("nitrogren", array("label"=>"N", "width"=>60));
$grid->setColProperty("NH4N", array("label"=>"NH4N", "width"=>60));
$grid->setColProperty("NO3N", array("label"=>"NO3N", "width"=>60));
$grid->setColProperty("TON", array("label"=>"TON", "width"=>60));
$grid->setColProperty("phosphorous", array("label"=>"P", "width"=>60));
$grid->setColProperty("PO4P", array("label"=>"PO4P", "width"=>60));

// In order to enable the more complex search we should set multipleGroup option
// Also we need show query roo
$grid->setNavOptions('search', array(
		"multipleGroup"=>true,
		"showQuery"=>true
));

// Run the script
$grid->renderGrid('#grid','#pager',true, null, null, true,true);
$conn = null;
?>