<?php
require 'core/init.php';
include 'includes/overall/header.php';
?>
<script src="js/galleria/galleria-1.4.2.min.js"></script> 
<link rel="stylesheet" href="css/galleria/themes/classic/galleria.classic.css"/>
<script src="css/galleria/themes/classic/galleria.classic.min.js"></script> 
<script type="text/javascript">
    $.jgrid.no_legacy_api = true;
    $.jgrid.useJSON = true;
    $.jgrid.defaults.width = "700";
</script>
<script src="jqgrid/js/trirand/jquery.jqGrid.min.js"type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $("#data_tabs li:eq(0) a").tab('show');
        $(".datepicker").datepicker({dateFormat: 'dd/mm/yy'});

        $("#search").click(function() {
            var id = $("#wetland").data("id");
            var from = mysqlDate($("#from").val());
            var to = mysqlDate($("#to").val());


            var f = {groupOp: "AND", rules: []};
            f.rules.push({field: "wetlandID", op: "eq", data: id});
            if (from) {
                f.rules.push({field: "sampleDate", op: "ge", data: from});
            }
            if (to) {
                f.rules.push({field: "sampleDate", op: "le", data: to});
            }

            $("#grid").search = true;
            $("#grid").setGridParam({
                postData: {
                    filters: JSON.stringify(f)},
                search: true
            });


            $("#grid").trigger("reloadGrid", [{page: 1, current: true}]);


        });

        function mysqlDate(date) {
            try {
                var mySQLdate = $.datepicker.parseDate('dd/mm/yy', date) || false;
                if (!mySQLdate)
                    return false;
            } catch (e) {
                return false;
            }

            var splitter = date.split("/");
            console.log("splitter: " + splitter);
            return splitter[2] + '-' + splitter[1] + '-' + splitter[0];
        }
        ;
    });
</script>
<?php
$wetlandID = (isset($_GET["wetlandID"])) ? $_GET["wetlandID"] : '';
?>
<div class="container">
    <div class="row">
        <div class="col-sm-offset-1">
			<table>
				<tr class="tableWetland">				
						<td class='wetlandr1c1' rowspan='3'><h4 id="wetland" data-id="<?php echo $wetlandID ?>"><strong>Wetland:</strong></h4></td>				
						<td class='wetlandr1c2' rowspan="3"><h4><?php echo ((isset($_GET["wetland"])) ? $_GET['wetland'] : '') ?></h4></td> 
					<td><strong>County:</strong></td>
					<td> <?php echo ((isset($_GET["county"])) ? $_GET['county'] : '') ?></td>
				</tr>

				<tr class="tableWetland">
					<td><strong>Pretreatment:</strong></td><td> <?php echo ((isset($_GET["pretreatment"])) ? $_GET['pretreatment'] : '') ?></td>
				</tr>
				<tr class="tableWetland">
					<td><strong>Source of Waste Water:</strong></td><td><?php echo ((isset($_GET["siteSource"])) ? $_GET['siteSource'] : '') ?></td>
				</tr>
			</table>
        </div>
    </div>
</div> 
<div class="container">
    <div class="row">
        <div class="col-sm-offset-1">

            <ul class="nav nav-tabs" id="data_tabs">
                <li><a data-toggle="tab" href="#samples_section">Sample Data</a></li>
                <li><a data-toggle="tab" href="#wetland_section">Wetlands Details</a></li>
                <li><a data-toggle="tab" href="#publications_section">Publication List</a></li>		        
            </ul>
        </div>
    </div>
</div>
<div class="tab-content" >
    <div id="samples_section" class="tab-pane fade in active col-sm-offset-2">
        <br>
        <div>
            From: <input id="from" class="datepicker" size="10"></input>
            To: <input id="to" class="datepicker" size="10"></input>
            <input id="search" type="button" value="Search"></input>
            <br/>
            <br/>
        </div>				
        <div><?php
            $_GET['wetlandID'] = $wetlandID;
            include_once "includes/partials/samplesgrid.php";
            ?></div>	   
    </div>
    <div id="wetland_section" class="tab-pane fade col-sm-offset-4">
        <br><br>
        <div><?php
            $_GET['wetlandID'] = $wetlandID;
            include_once "resources.php";
            ?></div>
    </div>
    <div id="publications_section" class="tab-pane fade ">
        <br>
        <div><?php $wetlandID = $_GET['wetlandID']; include_once"sampleArticleTable.php"; ?></div>
    </div>
</div>	
<?php include 'includes/footer_grid.php'; ?>
	