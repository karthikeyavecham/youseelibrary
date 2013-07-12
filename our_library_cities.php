<?php
require_once("shared/global_constants.php");
require_once("classes/DmQuery.php");
require_once("classes/CityQuery.php");
require_once("classes/City.php");

	$cityq = new CityQuery();
	$cities = $cityq->getCities();

	$dmq = new DmQuery();
	$categories = $dmq->getAssoc("collection_dm");

	//this page can be re-entered when a city is chosen from the map. the $chosencity variable gets the city chosen.
	$chosencity = '';
	if(isset($_GET['chosencity']) && $_GET['chosencity']!='')
		$chosencity=$_GET['chosencity'];

	//this page can be re-entered when a location is chosen from the map. the $chosenlocation variable gets the location chosen.
	$chosenlocationid = '';
	if(isset($_GET['locationid']) && $_GET['locationid']!='')
		$chosenlocationid=$_GET['locationid'];

	if(isset($_POST['Submit']))
	{
 		$search_type=$_POST['search_type'];

		if ($search_type == "author")	
			{$author=$_POST['author'];}

		if ($search_type == "title")
			{$title=$_POST['title'];}

		if ($search_type == "category")
			{$category=$_POST['category'];}

		$citydetails=explode(",",$_POST['city']);

 		if ($citydetails != "") {
			$location=$_POST['location'];
			$city=$citydetails[0];$_GET['chosencity']=$city;
			$lat=$citydetails[1];$_GET['lat']=$lat;
			$long=$citydetails[2];$_GET['long']=$long;
		}

 
	}

	
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
 <HEAD>
  <TITLE>UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors</TITLE>
  <meta http-equiv="content-type" content="text/ html;charset=utf-8">
  <META NAME="Description" CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/div.css">
<link href="css/table.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="test/test.css">
<link rel="stylesheet" type="text/css" href="css/tabs.css">
<link rel="stylesheet" href="scripts/jquery-ui.css">
<script src="scripts/jquery-1.8.3.js"></script>
<script src="scripts/jquery.ui.core.js"></script>
<script src="scripts/jquery.ui.widget.js"></script>
<script src="scripts/datepicker_ngo.js"></script>
<script type="text/javascript" src="scripts/custom_jquery.js"></script>
<link rel="stylesheet" href="css/slideshow.css">
</HEAD>
<BODY>

<!--wrapper begin-->
<div id="wrapper">

<!--header and navbar -->
<?php include 'header_navbar.php';?>
<!--maincontentarea begin-->
<div id="uccertificate-main">
<table>
<tr>
<td  colspan="4">
<div id="rightp" style="float:left">
</div>
</td>
</tr>
<tr>
<td valign="top">
<div class="left_div" style=" float:left" >
	<?php include 'search_library.php';?>
</div>
</td>
<td valign="top">
<hr>
<?php
//when a city is clicked upon in the map, display the locations of the city that have a open library
if( isset($_GET['chosencity']) && ( isset($_GET['chosencity']) !='') ) {
?>
<div id="mapLocations" >
<?php
include 'map_library_locations.php'; 
?>
</div>
<?php
//when entering the open city library link on the portal all cities have to be displayed
} else {
?>
<div id="mapCities">
<?php 
  include 'map_library_cities.php'; 
?>
</div>
<?php 
}
//When a location is chosen in the search bar ($location) OR when a location is clicked upon in the map ($chosenlocationid), display books in that location
if(  isset($location)  || isset($chosenlocationid)  ) {
?>
<div id="booksListing" >
<?php
echo $city. ' '.$location.' '.$title.' '.$author.' '.$category.' ';
include 'books.php'; 
?>
</div>
<?php 
}
?> 
</td>
</tr>
</table>
<!--maincontentarea end-->
</div>

<!--footer-->
<?php include 'footer.php' ;?>

</div>
<!--wrapper end-->

</BODY>
</HTML>

