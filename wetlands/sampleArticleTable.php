<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link href=".\css\bootstrap.min.js" rel="stylesheet">
<link href=".\css\styles_table.css" rel="stylesheet">
<script type="text/javascript" src="./tablescroll.js"></script>
<script type="text/javascript" src="./js/jquery.min.js"></script>
<script type="text/javascript" src="./js/hoverhighlight.js"></script>
<style type="text/css">.hover { background-color: #fbec5d; }</style>

    <script>
        $("table").delegate('td', 'mouseover mouseleave', function(e) {
            if (e.type == 'mouseover') {
                $(this).parent().addClass("hover");
                $("colgroup").eq($(this).index()).addClass("hover");
            }
            else {
                $(this).parent().removeClass("hover");
                $("colgroup").eq($(this).index()).removeClass("hover");
            }
        });
    </script>
    <div class="container">
        <?php
        $resultSet = DB::getInstance()->query("SELECT * FROM Literature INNER JOIN WetlandLiterature ON Literature.LiteratureID=WetlandLiterature.LiteratureID WHERE wetlandID = $wetlandID ORDER BY listPriority, LiteratureDate DESC");
        echo"<table id='myTable' class='table scroll tableArticle tableArticle1'>
<colgroup class=\"hover\"></colgroup>
	       <colgroup ></colgroup>
	       <colgroup ></colgroup>
	       <colgroup ></colgroup>
	       <colgroup></colgroup>

		<thead>
        	<tr>
            	<th width='5%'>Year</th>
            	<th width='25%'>Author</th>
		<th width='25%'>Title</th>
            	<th width='10%'>Publisher</th>
            	<th width='35%'>DOI</th>
        	</tr>
    		</thead>
    		<tbody id ='scrollit'>";
        $x = 0;
        foreach ($resultSet->results() as $resultSet) {
            $x++;
            $class = ($x % 2 == 0) ? 'evenRow' : 'oddRow';
            echo "
			     <tr class='$class'>
            		     <td id='sortnr' width='5%'>$resultSet->LiteratureDate</td>
            		     <td id='sortnr' width='25%'><span title='$resultSet->LiteratureAuthor'>$resultSet->LiteratureAuthor</span></td>
			     <td id='sortnr' width='25%'><span title='$resultSet->LiteratureTitle'>$resultSet->LiteratureTitle</span></td>
            		     <td id='sortnr' width='10%'><span title='$resultSet->Publisher'>$resultSet->Publisher</span></td>
            		     <td id='sortnr' width='33.4%'><a href='$resultSet->DOI'>$resultSet->DOI</td>           
        	     	     </tr>";
        }
        echo"</tbody></table>";