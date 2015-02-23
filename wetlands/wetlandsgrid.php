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
// We suppose that mytable exists in your database
$grid->SelectCommand = 'SELECT name, county FROM Wetland';

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
$grid->setColProperty("name", array("label"=>"name", "width"=>240));
$grid->setColProperty("county", array("label"=>"county", "width"=>120));

// Run the script
$grid->renderGrid('#grid','#pager',true, null, null, true,true);
?>