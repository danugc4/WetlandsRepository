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


$grid->SelectCommand = 'SELECT county, SiteSourceType.name AS siteSource, pretreatment, wetland FROM SiteSourceType RIGHT JOIN (SELECT Wetland.county, Wetland.name AS Wetland, PretreatmentType.name AS Pretreatment, Wetland.siteSourceType FROM Wetland LEFT JOIN PretreatmentType ON pretreatmentType = PretreatmentType.id) AS Data ON Data.siteSourceType=SiteSourceType.id';


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
    "sortname"=>"county",
    "rowList"=>array(10,20,50)
    ));

// Change some property of the field(s)
$grid->setColProperty("county", array("label"=>"County", "width"=>120));
$grid->setColProperty("siteSource", array("label"=>"SiteSource", "width"=>120));
$grid->setColProperty("pretreatment", array("label"=>"Pretreatment", "width"=>320));
$grid->setColProperty("wetland", array("label"=>"Wetland", "width"=>240));

// Run the script
$grid->renderGrid('#grid','#pager',true, null, null, true,true);
?>