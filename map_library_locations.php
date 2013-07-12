<?php
require_once("classes/LocationQuery.php");
require_once("classes/Location.php");
	$city = $_GET['chosencity'];
	$locq = new LocationQuery();
	$locations = $locq->getLocationsForCity($city);
?>
<!DOCTYPE html>
<html>
  <head>
    <style type="text/css">
html { height: 100% }
body { height: 100%; margin: 0; padding: 0 }
</style>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?&sensor=true">
    </script>
    <script type="text/javascript">
	var points = [
			<?php 	
				$points="";
				foreach($locations as $location) {
				$points.="['";
				$points.=$location->getAddressOne();
				$points.="',";
				$points.=$location->getLatitude();
				$points.=",";
				$points.=$location->getLongitude();
				$points.=",";
				$points.="5";
				$points.=",";
				$points.="'http://localhost/youseelibrary/our_library_cities.php?locationid=";
				$points.=$location->getLocationid();
				$points.="&lat=";
				$points.=$_GET['lat'];
				$points.="&long=";
				$points.=$_GET['long'];
				$points.="'],";
				}
				$points=substr($points,0,-1);
				echo $points;

			?>
		   ];
function setMarkers(map, locations) {
    var shape = {
        coord: [1, 1, 1, 20, 18, 20, 18, 1],
        type: 'poly'
    };
    for (var i = 0; i < locations.length; i++) {
        var flag = new google.maps.MarkerImage(
            'http://googlemaps.googlermania.com/google_maps_api_v3/en/Google_Maps_Marker.png',
        new google.maps.Size(37, 34),
        new google.maps.Point(0, 0),
        new google.maps.Point(0, 19));
        var place = locations[i];
        var myLatLng = new google.maps.LatLng(place[1], place[2]);
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            icon: flag,
            shape: shape,
            title: place[0],
            zIndex: place[3],
            url: place[4]
        });
        google.maps.event.addListener(marker, 'click', function () {
        window.location.href = this.url;
        });
    }
}
function initialize() {
var lat=<?php echo $_GET['lat'];?>;
var long= <?php echo $_GET['long'];?>;
    var myOptions = {
    center: new google.maps.LatLng(lat,long),
        zoom: 10,
        mapTypeId: google.maps.MapTypeId.HYBRID
    };

    var map = new google.maps.Map(document.getElementById("map_locations"), myOptions);
    map.setOptions({draggable: false, zoomControl: false, scrollwheel: false, disableDoubleClickZoom: true});
    setMarkers(map, points);

}
        google.maps.event.addDomListener(window,'load',initialize);
</script>
  </head>
  <body>

<div id="map_locations" style="width:800px; height:500px"></div>
  </body>
</html>
