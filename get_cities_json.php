<?php
require_once("classes/CityQuery.php");
require_once("classes/City.php");

	$cityq = new CityQuery();
	$cities = $cityq->getCities();
 
	$points="";

	foreach($cities as $city) {
		$points.="'".$city->getCityName();
		$points.="',";
		$points.=$city->getLatitude();
		$points.=",";
		$points.=$city->getLongitude();
		$points.=",";
		$points.="5";
		$points.=",";
		$points.="'http://localhost/youseelibrary/our_library_cities.php?chosencity=";
		$points.=$city->getCityName();
		$points.="&lat=";
		$points.=$city->getLatitude();
		$points.="&long=";
		$points.=$city->getLongitude();
		$points.="',";
		$points.=$city->getCityid();
		$points.=";";
	}
 	echo $points;

?>


