<?php
require_once  __DIR__.'/../core/jq-config.php';
// include the jqGrid Class
require_once __DIR__.'/../jqgrid/php/jqGrid.php';
// include the PDO driver class
require_once __DIR__.'/../jqgrid/php/jqGridPdo.php';
// Connection to the server
$conn = new PDO(DB_DSN,DB_USER,DB_PASSWORD);

// Create the jqGrid instance
$grid = new jqGridRender($conn);

// Write the SQL Query
$grid->SelectCommand = 'SELECT wetlandID, county, SiteSourceType.name AS siteSource, pretreatment, wetland FROM SiteSourceType RIGHT JOIN (SELECT Wetland.id AS wetlandID, Wetland.county, Wetland.name AS Wetland, PretreatmentType.name AS Pretreatment, Wetland.siteSourceType FROM Wetland LEFT JOIN PretreatmentType ON pretreatmentType = PretreatmentType.id) AS Data ON Data.siteSourceType=SiteSourceType.id';


// set the ouput format to json
$grid->dataType = 'json';
// Let the grid create the model
$grid->setColModel();
// Set the url from where we obtain the data
$grid->setUrl('partials/wetlandsgrid.php');
// Set grid caption using the option caption
$grid->setGridOptions(array(
    "caption"=>"Wetlands",
    "rowNum"=>10,
    "sortname"=>"wetlandID",
    "rowList"=>array(10,20,50)
    ));

// Change some property of the field(s)
$grid->setColProperty("wetlandID", array("label"=>"ID", "width"=>60));
$grid->setColProperty("county", array("label"=>"County", "width"=>120));
$grid->setColProperty("siteSource", array("label"=>"SiteSource", "width"=>120));
$grid->setColProperty("pretreatment", array("label"=>"Pretreatment", "width"=>320));
$grid->setColProperty("wetland", array("label"=>"Wetland", "width"=>240));


$custom = <<<CUSTOM

jQuery("#getselected").click(function(){
    var selr = jQuery('#grid').jqGrid('getGridParam','selrow');
	var selr_data = jQuery('#grid').jqGrid('getRowData',selr);		
	
    if(selr) {
		var params=$.param(selr_data);
		window.location.href='sample.php?'+params;
	}
    return false;
});
CUSTOM;
		
$grid->setJSCode($custom);

// Run the script
$grid->renderGrid('#grid','#pager',true, null, null, true,true);
?>