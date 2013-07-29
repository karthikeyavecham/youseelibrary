<?php
require_once ("shared/global_constants.php");
require_once ("classes/DmQuery.php");
require_once ("classes/CityQuery.php");
require_once ("classes/City.php");

$cityq = new CityQuery ();
$cities = $cityq->getCities ();

$dmq = new DmQuery ();
$categories = $dmq->getAssoc ( "collection_dm" );

// initialize these variables
$chosencity = '';
$searchlocation = '';
$author = '';
$title = '';
$category = '';

if (isset ( $_GET ['page'] ) && $_GET ['page'] != '') {
	
	$condition = $_GET ['condition'];
	
	if ($condition == 1) {
		$chosencity = $_GET ['chosencity'];
	} else if ($condition == 2) {
		
		$search_type = $_GET ['search_type'];
		
		if ($search_type == "author")
			$author = $_GET ['author'];
		if ($search_type == "title")
			$title = $_GET ['title'];
		if ($search_type == "category")
			$category = $_GET ['category'];
		
		$chosencity = $_GET ['chosencity'];
		$lat = $_GET ['lat'];
		$long = $_GET ['long'];
		$chosenlocationid = $_GET ['locationid'];
	} else if ($condition == 3) {
		
		$search_type = $_GET ['search_type'];
		
		if ($search_type == "author")
			$author = $_GET ['author'];
		if ($search_type == "title")
			$title = $_GET ['title'];
		if ($search_type == "category")
			$category = $_GET ['category'];
			
			// $citydetails=explode(",",$_GET['city']);
		$chosencity = $_GET ['chosencity'];
		$lat = $_GET ['lat'];
		$long = $_GET ['long'];
	} else if ($condition == 4) {
		
		$chosenlocationid = $_GET ['locationid'];
		$chosencity = $cityq->getCityOfLocation ( $chosenlocationid );
	} else if ($condition == 5) {
		
		$search_type = $_GET ['search_type'];
		
		if ($search_type == "author")
			$author = $_GET ['author'];
		if ($search_type == "title")
			$title = $_GET ['title'];
		if ($search_type == "category")
			$category = $_GET ['category'];
	}
} else if ((isset ( $_POST ['Submit'] ))) {
	$search_type = $_POST ['search_type'];
	
	if ($search_type == "author")
		$author = $_POST ['author'];
	if ($search_type == "title")
		$title = $_POST ['title'];
	if ($search_type == "category")
		$category = $_POST ['category'];
	
	$citydetails = explode ( ",", $_POST ['city'] );
	
	if (($citydetails != "") && ($citydetails [0] != "")) {
		
		if (isset ( $_POST ['locationid'] ) && ($_POST ['locationid'] != '')) {
			$chosenlocationid = $_POST ['locationid'];
			$condition = 2;
		} else
			$condition = 3;
		$chosencity = $citydetails [0];
		$lat = $citydetails [1];
		$_GET ['lat'] = $lat;
		$long = $citydetails [2];
		$_GET ['long'] = $long;
	} else {
		$condition = 5;
	}
} // this page can be re-entered when a city is chosen from the map. the $chosencity variable gets the city chosen.
else if (isset ( $_GET ['chosencity'] ) && $_GET ['chosencity'] != '') {
	$chosencity = $_GET ['chosencity'];
	$condition = 1;
} 
// this page can be re-entered when a location is chosen from the map. the $chosenlocation variable gets the location chosen.
else if (isset ( $_GET ['locationid'] ) && $_GET ['locationid'] != '') {
	$chosenlocationid = $_GET ['locationid'];
	$chosencity = $cityq->getCityOfLocation ( $chosenlocationid );
	$condition = 4;
} else
	$condition = 5;

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
<TITLE>UC is an exchange platform to channel Philanthropic Resources to
	Education, Health and Environmental services sectors</TITLE>
<meta http-equiv="content-type" content="text/ html;charset=utf-8">
<META NAME="Description"
	CONTENT="UC is an exchange platform to channel Philanthropic Resources to Education, Health and Environmental services sectors, in order to improve access to these services especially for the poor. These sectors need a much larger infusion of capital of various kinds including Financial, Intellectual and Social Capital.">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/div.css">
<link href="css/table.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="test/test.css">
<link rel="stylesheet" type="text/css" href="css/tabs.css">
<link rel="stylesheet" type="text/css" href="css/opencity.css">
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
					<td colspan="4">
						<div id="rightp" style="float: left"></div>
					</td>
				</tr>
				<tr>
					<td valign="top">
						<div class="container">
							<?php include 'search_library.php';?>
							<div class="cube-II">
								<div>
									<br> <br> <a href="opencityregistration.php"><font
										color="#0B3861"> <?php echo "Register to become a Member of the Library.";?>
									</font></a>
								</div>
								<div align="justify">
									<br> <br> <font color="#0B3861"><center><?php echo "OR";?> </center>
									</font>
								</div>
								<div align="justify">
									<br> <br> <font color="#0B3861"><?php echo "Contact the librarian at your chosen location to start using the library.";?> 
									</font>
								</div>
							</div>
						</div>
					</td>
					<td valign="top">
						<hr> <?php
						// when a city is clicked upon in the map, display the locations of the city that have a open library
						if ($condition == 1 || $condition == 2 || $condition == 3 || $condition == 4) {
							?>
						<div align="justify">
							 <br> 
							 <font style='color:#0B3861;font-weight:bold;font-size:16px;'><?php echo "To browse books in the Library click on any of the locations shown below or use the search bar on the left for advanced search.";?>
							</font><br><br> 
						</div>
						<div id="mapLocations">
							<?php
							include 'map_library_locations.php';
							?>
						</div> <?php
						} else {
							?>
						<div align="justify">
							 <br> 
							 <font style='color:#0B3861;font-weight:bold;font-size:16px;'><?php echo "To get a list of Library Locations click on a city shown in the map below or use the search bar on the left for advanced search.";?> <br>
							</font><br><br> 
						</div>
							<div id="mapCitiesWithBooks">
							<?php
							include 'map_library_cities.php';
							?>
						</div> <?php
						}
						if (($condition==2)||($condition==3) ) {
							?>
							<div id="mapCitiesWithBooks">
							<?php
							include 'display_search_conditions.php';
							?>
						</div> <?php
						}
						?>
						<div id="ListingBooksForClick">
							<?php
							include 'books.php';
							?>
						</div>
					</td>
				</tr>
			</table>
			<!--maincontentarea end-->

			<!--footer-->
			<?php  include 'footer.php' ;?>

		</div>
		<!--UC Certificate end-->
	</div>
	<!--wrapper end-->

</BODY>
</HTML>

