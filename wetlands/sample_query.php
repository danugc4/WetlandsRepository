<?php
require 'core/init.php';
include 'includes/overall/header.php';
?>

<script type="text/javascript">
    var select = '';
    $(document).ready(function() {
        //Select all dropdown items	
        $("#filter select").on('change', function() {
            var county = $('#county-select').val() || '%';
            var siteSource = $('#siteSource-select').val() || '%';
            var pretreatment = $('#pretreatment-select').val() || '%';

            if ((county == '%') && (siteSource == '%') && (pretreatment == '%')) {
                $("#grid").search = false;
                $("#grid").setGridParam({
                    postData: {
                        filters: ''},
                    search: false
                });

            } else {
                var f = {groupOp: "AND", rules: []};

                if (county != '%') {
                    f.rules.push({field: "county", op: "cn", data: county});
                }

                if (siteSource != '%') {
                    f.rules.push({field: "siteSource", op: "cn", data: siteSource});
                }
                if (pretreatment != '%') {
                    f.rules.push({field: "pretreatment", op: "cn", data: pretreatment});
                }

                $("#grid").search = true;

                $("#grid").setGridParam({
                    postData: {
                        filters: JSON.stringify(f)},
                    search: true
                });
            }

            $("#grid").trigger("reloadGrid", [{page: 1, current: true}]);

        });
    });
</script>
<?php
$counties = array("Carlow", "Cavan", "Clare", "Cork", "Donegal", "Dublin", "Galway", "Kerry", "Kildare", "Kilkenny", "Laois", "Leitrim", "Limerick", "Longford", "Louth", "Mayo", "Meath", "Monaghan", "Offaly", "Roscommon", "Sligo", "Tipperary", "Waterford", "Westmeath", "Wexford", "Wicklow");
$db = DB::getInstance();
$siteSources = $db->getAll('SiteSourceType', false)->results();
$pretreatments = $db->getAll('PretreatmentType', false)->results();
?>
<p></p>

<div class="row">
    <div class="col-sm-offset-2">
        <div class = "container" id="filter" >
            <div class = "row">			
                <select name="county"  id="county-select">
                    <option value="%">All counties</option>
                    <?php foreach ($counties as $county): ?>
                        <option> <?php echo $county; ?></option> 
                    <?php endforeach; ?>  
                </select>
            </div>
        </div> 
        <br>
        <div class = "container" id="filter" >
            <div class = "row">			
                <select name="siteSource"  id="siteSource-select">
                    <option value="%">All source of waste water</option>
                    <?php foreach ($siteSources as $siteSource): ?> 
                        <option ><?php echo $siteSource['siteSourceName']; ?></option> 
                    <?php endforeach; ?> 
                </select>   
            </div>
        </div>
        <br>
        <div class = "container" id="filter" >
            <div class = "row">			
                <select name="pretreatment"  id="pretreatment-select">
                    <option value="%">All pretreatment types</option>
                    <?php foreach ($pretreatments as $pretreatment): ?> 
                        <option><?php echo $pretreatment['pretreatmentName']; ?></option> 
                    <?php endforeach; ?> 
                </select>   
            </div>
        </div>
    </div>
    <br>
    <div id="example"></div>
    <div class = "container">
        <div class = "row">			           
            <div id="wetlands-list"></div>    
        </div>
    </div>	
    <div class = "container">
        <div class="col-sm-offset-1">
            <button id="getselected">Get Sample Data for Selected Wetland</button>
        </div>
    </div><br>
    <div class = "container">
        <div class="col-sm-offset-1">
            <?php include "includes/partials/wetlandsgrid.php"; ?>	
        </div>
    </div>
</div>	        	    


<?php include 'includes/footer_grid.php'; ?> 

