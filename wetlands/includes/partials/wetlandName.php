<?php
require_once  __DIR__.'/../../core/jq-config.php';
// include the jqGrid Class
require_once __DIR__.'/../../jqgrid/php/jqGrid.php';
// include the PDO driver class
require_once __DIR__.'/../../jqgrid/php/jqGridPdo.php';
// Connection to the server
$conn = new PDO(DB_DSN,DB_USER,DB_PASSWORD);
// Tell the db that we use utf-8
//$conn->query("SET NAMES utf8");



// Create the jqGrid instance
$grid = new jqGridRender($conn);
// Write the SQL Query
$grid->SelectCommand = 'SELECT name FROM Wetland';
// set the ouput format to json
$grid->dataType = 'json';
$grid->table ="Wetland";
$grid->setPrimaryKeyId("name");
$grid->serialKey = false;
// Let the grid create the model
$grid->setColModel();
// Set the url from where we obtain the data
$grid->setUrl('includes/partials/wetlandName.php');
// Set grid caption using the option caption
$grid->setGridOptions(array(
    //"caption"=>"Customers",
    "rowNum"=>10,
    "sortname"=>"CompanyName",
    "viewrecords"=>false,
    "pginput"=>false
    //"rowList"=>array(10,20,50)
    ));
$grid->setColProperty("name", array("editrules"=>array("required"=>true)));
$grid->navigator = true;
$grid->toolbarfilter = true;
$grid->setNavOptions('navigator', array("add"=>false,"edit"=>false,"excel"=>false, "search"=>false));
// and just enable the inline
$grid->inlineNav = true;
$grid->renderGrid('#grid2','#pager2',true, null, null, true,true);