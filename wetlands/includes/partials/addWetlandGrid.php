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
$grid->SelectCommand = 'SELECT Wetland.id, Wetland.name, Wetland.county, Wetland.siteSourceType, SiteSourceType.siteSourceName, Wetland.pretreatmentType, PretreatmentType.pretreatmentName, Wetland.siteSize, Wetland.siteDescription
FROM Wetland
INNER JOIN SiteSourceType
ON Wetland.siteSourceType = SiteSourceType.id
INNER JOIN PretreatmentType
ON Wetland.pretreatmentType = PretreatmentType.id';
// Set the table to where you update the data
$grid->table = 'Wetland';
$grid->setPrimaryKeyId("id");
$grid->serialKey = true;

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
$grid->setColProperty("name",array("label" => "Wetland Name", "width" => 120,"editable"=>true));
$grid->setColProperty("county", array("label" => "County", "width" => 120,"editable"=>true));
$grid->setColProperty("siteSourceType", array("label" => "Site Source Type","hidden"=>true, "editrules"=>array("edithidden" =>true), "width" => 120,"editable"=>true,"edittype" => "select", "editoptions"=>array("value"=>"1:Municipal;2:Agricultural;3:Industrial")));
$grid->setColProperty("siteSourceName", array("label" => "Site Source Type", "width" => 120, "editable"=>false));
$grid->setColProperty("pretreatmentName", array("label" => "Pretreatement Type", "width" => 120, "editable"=>false));
$grid->setColProperty("pretreatmentType", array("label" => "Pretreatment Type", "width" => 120,"hidden"=>true, "editrules"=>array("edithidden" =>true), "editable"=>true,"edittype" => "select", "editoptions"=>array("value"=>"1:Activated sludge treatment;2:Primary;3:Secondary")));
$grid->setColProperty("siteSize", array("label" => "Site Size", "Site Size" => 120, "editable"=>true));
$grid->setColProperty("siteDescription", array("label" => "Site Description", "width" => 120, "editable"=>true));





$grid->navigator = true;
// Enable only editing
$grid->setNavOptions('navigator', array("excel"=>false,"add"=>true,"edit"=>true,"del"=>true,"view"=>false, "search"=>false));
$grid->setNavOptions('edit', array("height"=>'auto',"dataheight"=>"auto","width"=>'auto',"closeAfterEdit"=>true,"editCaption"=>"Edit Wetland"));
$grid->setNavOptions('add', array("height"=>'auto',"dataheight"=>"auto","width"=>'auto',"closeAfterAdd"=>true, "reloadAfterSubmit"=>true, "addCaption"=>"Add Wetland", "bSubmit"=>"Add Wetland"));

$grid->renderGrid('#grid','#pager',true, null, null, true,true);
$conn = null;
?>

