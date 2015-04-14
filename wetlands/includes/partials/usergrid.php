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
$grid->SelectCommand = 'SELECT users.id, users.username, users.name, users.email, users.company, users.job_title, users.joined, users.access, groups.description
FROM users
INNER JOIN groups
ON users.access = groups.id';
// Set the table to where you update the data
$grid->table = 'users';
$grid->setPrimaryKeyId("id");
$grid->serialKey = false;

// Set output format to json
$grid->dataType = 'json';
// Let the grid create the model
$grid->setColModel();
// Set the url from where we obtain the data
$grid->setUrl('includes/partials/usergrid.php');
// Set some grid options
$grid->setGridOptions(array(
    "caption"=>"Member's Table",
    "rowNum"=>10,
    "rowList"=>array(10,20,30),
    "sortname"=>"id"
));

$grid->setColProperty("id", array("label" => "ID", "width" => 60,"editable"=>false ));
$grid->setColProperty("username", array("label" => "Username", "width" => 120,"editoptions" => array("readonly" => true)));
$grid->setColProperty("name", array("label" => "Name", "width" => 120,"editable"=>false));
$grid->setColProperty("email", array("label" => "Email", "width" => 120,"editable"=>false));
$grid->setColProperty("company", array("label" => "Company", "width" => 120,"editable"=>false));
$grid->setColProperty("joined", array("label" => "Date Joined", "width" => 120, "editable"=>false));
$grid->setColProperty("job_title", array("label" => "Job Title", "width" => 120, "editable"=>false));
$grid->setColProperty("access", array("label" => "Access level", "width" => 120, "hidden"=>true, "editrules"=>array("edithidden" =>true), "editable"=>true,"edittype" => "select", "editoptions"=>array("value"=>"1:Registered;2:Administrator;3:Authorized")));
$grid->setColProperty("description", array("label" => "Description", "width" => 120, "editable"=>false));


$grid->navigator = true;
// Enable only editing
$grid->setNavOptions('navigator', array("excel"=>true,"add"=>false,"edit"=>true,"del"=>false,"view"=>false, "search"=>false));
// Close the dialog after editing
$grid->setNavOptions('edit',array("closeAfterEdit"=>true,"editCaption"=>"Update User","bSubmit"=>"Update", "viewPagerButtons"=>false));

$grid->renderGrid('#grid','#pager',true, null, null, true,true);
$conn = null;
?>

