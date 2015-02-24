<?php
require '../core/init.php';
$db = DB::getInstance();

if(isset($_GET['pretreatment'])) {
	
    $selectedPretreatment = $_GET['pretreatment'];
	$wetlands = $db->get('Wetland', array('pretreatmentType', '=', $selectedPretreatment), false)->results();

}
