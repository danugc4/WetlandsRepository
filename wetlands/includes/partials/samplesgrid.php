<?php
require_once  __DIR__.'/../../core/jq-config.php';
// include the jqGrid Class
require_once __DIR__.'/../../jqgrid/php/jqGrid.php';
// include the PDO driver class
require_once __DIR__.'/../../jqgrid/php/jqGridPdo.php';
// Connection to the server
// Connection to the server
$conn = new PDO(DB_DSN,DB_USER,DB_PASSWORD);

// Create the jqGrid instance
$grid = new jqGridRender($conn);


$custom = <<<CUSTOM
var id = $( "#wetland" ).data( "id" );
$("#grid").jqGrid('setGridParam', {postData:{"wetlandID": id}, search: true} );
$("#grid").trigger("reloadGrid");

CUSTOM;

global $ID;
if (isset($wetlandID)) {
	$ID = $wetlandID;
	$search = 'true';		
	
} else {	
	$grid->setJSCode($custom);
	//$search = jqGridUtils::GetParam('_search','false');
	$search = 'true';
	$ID = jqGridUtils::GetParam('wetlandID', '2');
}


// Write the SQL Query

if($search == 'true')
{

    // get the wetlandID
    
    
    //$_GET['_search'] = 'false';
    $grid->SelectCommand = 'SELECT wetlandID, sampleDate, dailyFlowRate, COD, BOD, suspSolids, pH, dissolvedOxy, temp, nitrogren, NH4N, NO3N, TON, phosphorous, PO4P FROM Sample WHERE wetlandID = '.$ID;
    //$grid->debug = true;
} else {
	

	//$grid->SelectCommand = 'SELECT wetlandID, COD, BOD FROM Sample';
	//$grid->SelectCommand = 'SELECT COD, BOD FROM Sample WHERE wetlandID = '.$GLOBALS['wetlandID'];
}
// set the ouput format to json
$grid->dataType = 'json';
// Let the grid create the model
$grid->setColModel();
// Set the url from where we obtain the data
$grid->setUrl('includes/partials/samplesgrid.php');
// Set grid caption using the option caption
$grid->setGridOptions(array(
		"caption"=>"Wetland Sample Data",
		"rowNum"=>10,
		"sortname"=>"wetlandID",
		"rowList"=>array(10,20,50)
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



// Run the script
$grid->renderGrid('#grid','#pager',true, null, null, true,true);
$conn = null;
?>