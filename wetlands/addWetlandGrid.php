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
$grid->SelectCommand = 'SELECT Wetland.id, Wetland.name, Wetland.county, SiteSourceType.name, PretreatmentType.name, Wetland.siteSize, Wetland.siteDescription
FROM Wetland
INNER JOIN SiteSourceType
ON Wetland.siteSourceType = SiteSourceType.id
INNER JOIN PretreatmentType
ON Wetland.pretreatmentType = PretreatmentType.id';
// Set the table to where you update the data
$grid->table = 'Wetlands';
$grid->setPrimaryKeyId("id");
$grid->serialKey = false;

// Set output format to json
$grid->dataType = 'json';
// Let the grid create the model
$grid->setColModel();
// Set the url from where we obtain the data
$grid->setUrl('includes/partials/addWetlandGrid.php');
// Set some grid options
$grid->setGridOptions(array(
    "caption"=>"Add/Edit Wetland",
    "rowNum"=>10,
    "rowList"=>array(10,20,30),
    "sortname"=>"id"
));

$grid->setColProperty("id", array("label" => "ID", "width" => 60,"editable"=>false ));
$grid->setColProperty("name", array("label" => "Name", "width" => 120,"editoptions" => array("readonly" => true)));
$grid->setColProperty("county", array("label" => "County", "width" => 120,"editable"=>false));
$grid->setColProperty("SiteSourceType.name", array("Site Source Type" => "Email", "width" => 120,"editable"=>false));
$grid->setColProperty("pretreatmentType.name", array("label" => "Company", "width" => 120,"editable"=>false));
$grid->setColProperty("siteSize", array("label" => "Date Joined", "Site Size" => 120, "editable"=>false));
$grid->setColProperty("siteDescription", array("label" => "Site Description", "width" => 120, "editable"=>false));

//, "edittype" => "select", "editoptions"=>array("value"=>"1:Registered;2:Administrator;3:Authorized")
//, groups.description
// Enable navigator

$grid->navigator = true;
// Enable only editing
$grid->setNavOptions('navigator', array("excel"=>false,"add"=>false,"edit"=>true,"del"=>false,"view"=>false, "search"=>false));
// Close the dialog after editing
$grid->setNavOptions('edit',array("closeAfterEdit"=>true,"editCaption"=>"Update User","bSubmit"=>"Update", "viewPagerButtons"=>false));

$grid->renderGrid('#grid','#pager',true, null, null, true,true);
$conn = null;
?>

