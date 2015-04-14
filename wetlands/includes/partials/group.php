
<?php
require_once  __DIR__.'/../../core/jq-config.php';
// include the jqGrid Class
// include the PDO driver class
require_once __DIR__.'/../../jqgrid/php/jqGridPdo.php';
try {
    $conn = new PDO(DB_DSN,DB_USER,DB_PASSWORD);
    $SQL =  "SELECT group FROM users";
    $collation = jqGridDB::query($conn, "SET NAMES utf8");
    $group = jqGridDB::query($conn, $SQL);
    $result = jqGridDB::fetch_object($group, true, $conn);
    echo json_encode($result);
} catch (Exception $e) {
    echo $e->getMessage();
}