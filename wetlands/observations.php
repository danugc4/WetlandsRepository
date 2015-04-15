
<link href=".\css\styles_table.css" rel="stylesheet"> 
<script type="text/javascript" src="./js/jquery.min.js"></script>
    <script type="text/javascript" src="./js/hoverhighlight.js"></script>
	
	<style type="text/css">.hover { background-color: #fbec5d; }</style></head>
<?php

// Write the SQL Query
$ID = jqGridUtils::GetParam('wetlandID', '1');
$search = jqGridUtils::GetParam('_search','false');

$_GET['_search'] = 'false';
if($user->isLoggedIn())
{
$resultSet3 = DB::getInstance()->query("SELECT * FROM Observation");
$i=0;                     
$dateArray = Array();
$descriptionArray = Array();



foreach($resultSet3->results() as $result3)
	{
		$dateArray[$i]=$result3->observationID;
		$descriptionArray[$i]=$result3->description;
		
		$i++;
	}
		
if(count($dateArray)>0){
		echo "<table class='table scroll observationTable tableArticle'>
	       <colgroup class=\"hover\"></colgroup>
	       

		<thead>
        	<tr>
		<th width='7.5%'>Sample date</th>
            	<th width='4.6%'>Description</th>
            
        	</tr>
    		</thead>
    		<tbody>";
		$x=0;
		if (isset($resultSet))
		{
		for($c = 0; $c<count($dateArray); $c++)
		{
			$x++; 
			$class = ($x%2 == 0)? 'evenRow': 'oddRow';
			echo"<tr class='$class'>
			     <td width='20%'>$dateArray[$c]</td>
            		     <td width='80%'>$descriptionArray[$c]</td>
            		               </tr>";
	
		}	
		}
		echo"</tbody></table>";
}
}


 ?>
