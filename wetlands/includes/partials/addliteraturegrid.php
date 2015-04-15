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
$grid->SelectCommand = 'SELECT * FROM Literature';
// Set the table to where you update the data
$grid->table = 'Literature';
$grid->setPrimaryKeyId("LiteratureID");
$grid->serialKey = true;

// Set output format to json
$grid->dataType = 'json';
// Let the grid create the model
$grid->setColModel();
// Set the url from where we obtain the data
$grid->setUrl('includes/partials/addliteraturegrid.php');
// Set some grid options
$grid->setGridOptions(array(
    "caption"=>"Add/Edit Publication",
    "rowNum"=>10,
    "rowList"=>array(10,20,30),
    "sortname"=>"LiteratureID"
));

$grid->setColProperty("LiteratureID", array("label" => "ID", "width" => 60,"editable"=>false ));
$grid->setColProperty("LiteratureTitle",array("label" => "Title", "width" => 120,"editable"=>true));
$grid->setColProperty("LiteratureAuthor", array("label" => "Author", "width" => 120,"editable"=>true));
$grid->setColProperty("LiteratureDate", array("label" => "Year", "width" => 120, "editable"=>true));
$grid->setColProperty("Publisher", array("label" => "Publisher", "width" => 120, "editable"=>true));
$grid->setColProperty("DOI", array("label" => "DOI", "width" => 120, "editable"=>true));
$grid->setColProperty("listPriority", array("label" => "Priority", "width" => 120, "editable"=>true));




$grid->navigator = true;
// Enable only editing
$grid->setNavOptions('navigator', array("excel"=>false,"add"=>true,"edit"=>true,"del"=>true,"view"=>false, "search"=>false));
$grid->setNavOptions('edit', array("height"=>'auto',"dataheight"=>"auto","width"=>'auto',"closeAfterEdit"=>true,"editCaption"=>"Edit Publication"));
$grid->setNavOptions('add', array("height"=>'auto',"dataheight"=>"auto","width"=>'auto',"closeAfterAdd"=>true, "reloadAfterSubmit"=>true, "addCaption"=>"Add Publication", "bSubmit"=>"Add Publication"));

$grid->renderGrid('#grid','#pager',true, null, null, true,true);
$conn = null;
?>

