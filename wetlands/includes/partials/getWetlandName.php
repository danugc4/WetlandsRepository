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

$s = "<select>";
$q = jqGridDB::query($conn,"SELECT name FROM Wetland");
while($row= jqGridDB::fetch_num($q)) {
    $s .= "<option value='".$row[0]."'>".$row[1]."</option>";
}
$s .= "</select>";
echo $s;