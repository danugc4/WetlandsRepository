<?php
require_once 'core/jq-config.php';
// include the jqGrid Class
require_once "jqgrid/php/jqGrid.php";
// include the PDO driver class
require_once "jqgrid/php/jqGridPdo.php";
// Connection to the server
$conn = new PDO(DB_DSN,DB_USER,DB_PASSWORD);

// Create the jqGrid instance
$grid = new jqGridRender($conn);

// Write the SQL Query
$search = jqGridUtils::GetParam('_search','false');

if($search == 'true')
{

	// get the date
	$pretreatment = jqGridUtils::GetParam('pretreatment','1');
	//$to = jqGridUtils::GetParam('to','12/31/1999');
	// Reformat it to DB appropriate search
	//$from = jqGridUtils::parseDate('d/m/Y', $from, 'Y-m-d');
	//$to = jqGridUtils::parseDate('d/m/Y', $to, 'Y-m-d');

	$_GET['_search'] = 'false';
	$grid->SelectCommand = 'SELECT county, SiteSourceType.name AS SiteSource, Pretreatment, Wetland FROM SiteSourceType RIGHT JOIN (SELECT Wetland.county, Wetland.name AS Wetland, PretreatmentType.name AS Pretreatment, Wetland.siteSourceType, PretreatmentType.id FROM Wetland LEFT JOIN PretreatmentType ON pretreatmentType = PretreatmentType.id) AS Data ON Data.siteSourceType=SiteSourceType.id WHERE Data.id = "'.$pretreatment.'"';
	//$grid->debug = true;
} else {
	// use the standard SelectCommand
	$grid->SelectCommand = 'SELECT county, SiteSourceType.name AS SiteSource, Pretreatment, Wetland FROM SiteSourceType RIGHT JOIN (SELECT Wetland.county, Wetland.name AS Wetland, PretreatmentType.name AS Pretreatment, Wetland.siteSourceType FROM Wetland LEFT JOIN PretreatmentType ON pretreatmentType = PretreatmentType.id) AS Data ON Data.siteSourceType=SiteSourceType.id';
}
// Write the SQL Query
// We suppose that mytable exists in your database


// set the ouput format to json
$grid->dataType = 'json';
// Let the grid create the model
$grid->setColModel();
// Set the url from where we obtain the data
$grid->setUrl('wetlandsgrid.php');
// Set grid caption using the option caption
$grid->setGridOptions(array(
    "caption"=>"Wetlands",
    "rowNum"=>10,
    "sortname"=>"name",
    "rowList"=>array(10,20,50)
    ));

// Change some property of the field(s)
$grid->setColProperty("county", array("label"=>"county", "width"=>120));
$grid->setColProperty("SiteSource", array("label"=>"SiteSource", "width"=>120));
$grid->setColProperty("Pretreatment", array("label"=>"Pretreatment", "width"=>320));
$grid->setColProperty("Wetland", array("label"=>"Wetland", "width"=>240));

// Run the script
$grid->renderGrid('#grid','#pager',true, null, null, true,true);
?>