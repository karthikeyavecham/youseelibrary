<?php
require_once("classes/CityQuery.php");
require_once("classes/City.php");

	$cityq = new CityQuery();
	$cities = $cityq->getCities();
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
    ['Hyderabad', 17.430375, 78.323078, 12, 'http://localhost/youseelibrary/our_library_locations.php?city=Hyderabad&lat=17.386027&long=78.487473'],
    ['Indore', 22.759126, 75.917169, 11, 'http://localhost/youseelibrary/our_library_locations.php?city=Indore,lat=17.386027,long=78.487473'],
    ['Bangalore', 12.842745, 77.663180, 10, 'http://localhost/youseelibrary/our_library_locations.php?city=Bangalore&lat=17.386027&long=78.487473']
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

    var myOptions = {
    center: new google.maps.LatLng(25.324167, 78.134766),
        zoom: 4,
        mapTypeId: google.maps.MapTypeId.HYBRID
    };
	
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    setMarkers(map, points);
}
        google.maps.event.addDomListener(window,'load',initialize);
</script>
  </head>
  <body>
<?php echo $points;?>
<div id="map_canvas" style="width:800px; height:500px"></div>
  </body>
</html>
