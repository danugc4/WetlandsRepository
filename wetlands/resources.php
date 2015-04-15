

	<head>
		<link href=".\css\bootstrap.min.css" rel="stylesheet">
		<link href=".\css\styles.css" rel="stylesheet">
		<link href=".\css\bootstrap.min.js" rel="stylesheet">
		<link href=".\css\styles_table.css" rel="stylesheet">
	
	
	<style type="text/css"></style>
</head>


<body onload="start()">

<script language="javascript" type="text/javascript">

var javArray = new Array();
<?php 

$db = DB::getInstance();
require_once  __DIR__.'/core/jq-config.php';

    	$resultSet = $db->query("SELECT * FROM Wetland INNER JOIN Resource ON Wetland.id=Resource.wetlandID WHERE Wetland.id = $ID");
$i=0;
$j=0;
$k=0;
$resourceArray = Array();
$siteDesc = Array();
foreach($resultSet->results() as $result)
	{
		$resourceArray[$i]=$result->description;
		$siteDesc[$i]=$result->siteDescription;
		$i++;

	}
if(count($resourceArray)==0)
{

    	$resultSet = $db->query("SELECT * FROM Resource WHERE wetlandID = $ID");
	foreach($resultSet->results() as $result)
	{
		$resourceArray[$j]=$result->description;
		$j++;
echo $resourceArray[$j];
	}
	if(count($resourceArray)==0)
	{    	
		$resultSet = $db->query("SELECT * FROM Wetland WHERE wetlandID = $ID");
		foreach($resultSet->results() as $result)
		{
			$siteDesc[$k]=$result->siteDescription;
			$k++;
		}	
	}
}

$phpArray = json_encode($resourceArray);
echo "function followUp()
{javArray = " .$phpArray. ";

	
}";


?>

var imageData= new Array();

function start()
{	followUp();
	arrayFill(javArray);
}
function arrayFill(javArray)
{
	imageData = javArray.slice();

}

preloadThumbnails();


var imageIndexFirst = 0;

var imageIndexLast = 3;

var continueScroll = 0;

var maxIndex = imageData.length-1;

var minIndex = 0;


function preloadThumbnails() {

imageObject = new Image();

for (i = 0; i < imageData.length; ++ i)

imageObject.src = imageData[i];

}

function changeImage(ImageToChange,MyimageData){

document.getElementById(ImageToChange).setAttribute('src',MyimageData)

}


function changeImageOnMouseOver(ImageToChange,imageIndex){

document.getElementById(ImageToChange).setAttribute('onmouseover','handleThumbOnMouseOver(' + imageIndex + ');')

}


function handleThumbOnMouseOver(imageIndex){

changeImage('imageLarge',imageData[imageIndex]);


}



function scrollImages(scrollDirection) {



var currentIndex;


if (scrollDirection == 'up')

{



if (imageIndexLast < imageData.length-1)

{



imageIndexLast = imageIndexLast + 1;

imageIndexFirst = imageIndexFirst + 1;

currentIndex = imageIndexLast;

changeImage('image4',imageData[currentIndex]);

changeImageOnMouseOver('image4',currentIndex);

currentIndex = imageIndexLast - 1;

setTimeout("changeImage('image3',imageData[" + currentIndex + "])",25);

setTimeout("changeImageOnMouseOver('image3'," + currentIndex + ")",25);

currentIndex = imageIndexLast - 2;

setTimeout("changeImage('image2',imageData[" + currentIndex + "])",50);

setTimeout("changeImageOnMouseOver('image2'," + currentIndex + ")",50);

currentIndex = imageIndexLast - 3;

setTimeout("changeImage('image1',imageData[" + currentIndex + "])",75);

setTimeout("changeImageOnMouseOver('image1'," + currentIndex + ")",75);



}

}

else

{


if (imageIndexFirst != minIndex)

{


imageIndexLast = imageIndexLast - 1;

imageIndexFirst = imageIndexFirst - 1;
currentIndex = imageIndexFirst;

changeImage('image1',imageData[currentIndex]);

changeImageOnMouseOver('image1',currentIndex);

currentIndex = imageIndexFirst + 1;

setTimeout("changeImage('image2',imageData[" + currentIndex + "])",25);

setTimeout("changeImageOnMouseOver('image2'," + currentIndex + ")",25);

currentIndex = imageIndexFirst + 2;

setTimeout("changeImage('image3',imageData[" + currentIndex + "])",50);

setTimeout("changeImageOnMouseOver('image3'," + currentIndex + ")",50);

currentIndex = imageIndexFirst + 3;

setTimeout("changeImage('image4',imageData[" + currentIndex + "])",75);

setTimeout("changeImageOnMouseOver('image4'," + currentIndex + ")",75);


}

}

}



function scrollPrevious() {

continueScroll = 1;

scrollImages('down');

}


function scrollNext() {

continueScroll = 1;

scrollImages('up');

}





</script>
<div id="resources"><div id="resources-left">
<table class="nonhighlight"><tr><td><div id="siteResources"><?php if (count($siteDesc)>0){echo $siteDesc[0];} else{echo"No site details available.";} ?>
</td></tr>
</table>

</div>
<div id="resources-right">
<table class ="nonhighlight"border="0" cellpadding="5" cellspacing="0" /*width="600px"*/>


<tr>
<?php 
if(count($resourceArray)>0){
echo <<<cell1
<td align="center" colspan="6">

<img height="400" src="$resourceArray[0]" style="border-right: 1px solid; border-top: 1px solid; border-left: 1px solid;

border-bottom: 1px solid" width="600" id="imageLarge"/></td>

</tr>



<tr>

<td id="scrollPreviousCell">

<button type="button" class="btn btn-success"onclick="scrollPrevious();">Previous</button></td>

<td>

<img id="image1" height="100" src="$resourceArray[0]" style="border-right: 1px solid; border-top: 1px solid; border-left: 1px solid;

border-bottom: 1px solid" width="100" onmouseover="handleThumbOnMouseOver(0);" /></td>

cell1;
}
if(count($resourceArray)>1)
{
echo <<<cell2
<td>

<img id="image2" height="100" src="$resourceArray[1]" style="border-right: 1px solid; border-top: 1px solid; border-left: 1px solid;

border-bottom: 1px solid" width="100" onmouseover="handleThumbOnMouseOver(1);" /></td>
cell2;
}
if(count($resourceArray)>2)
{
echo <<<cell3
<td>

<img id="image3" height="100" src="$resourceArray[2]" style="border-right: 1px solid; border-top: 1px solid; border-left: 1px solid;

border-bottom: 1px solid" width="100" onmouseover="handleThumbOnMouseOver(2);" /></td>
cell3;
}
if(count($resourceArray)>3)
{
echo <<<cell4
<td>

<img id="image4" height="100" src="$resourceArray[3]" style="border-right: 1px solid; border-top: 1px solid; border-left: 1px solid;

border-bottom: 1px solid" width="100" onmouseover="handleThumbOnMouseOver(3);" /></td>
cell4;
}
if(count($resourceArray)>0)
echo <<<cell5
<td id="scrollNextCell">

<button type="button" class="btn btn-success"onclick="scrollNext();">Next</button></td>
cell5;
if(count($resourceArray)==0)
{
	echo "No images to view at the moment.";
}
?>
</tr>
<tr><td><br><br><br>
</td></tr>



</table>

</div>
</div>


	

</body>