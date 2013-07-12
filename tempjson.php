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

     var points = new Array();
 
function setMarkers(map, cities) {
	alert("test");
    var shape = {
        coord: [1, 1, 1, 20, 18, 20, 18, 1],
        type: 'poly'
    };
    for (var i = 0; i < cities.length; i++) {
        var flag = new google.maps.MarkerImage(
            'http://googlemaps.googlermania.com/google_maps_api_v3/en/Google_Maps_Marker.png',
        new google.maps.Size(37, 34),
        new google.maps.Point(0, 0),
        new google.maps.Point(0, 19));
        var place = cities[i];
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


    var lines = [];

    var myOptions = {
    center: new google.maps.LatLng(25.324167, 78.134766),
        zoom: 4,
        mapTypeId: google.maps.MapTypeId.HYBRID
    };
	
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    map.setOptions({draggable: false, zoomControl: false, scrollwheel: false, disableDoubleClickZoom: true});
    $.ajax({
		url : "get_cities_json.php",
		success : function(returnData){
		    	lines = returnData.split(";");
			for (var i=0;i<lines.length;i++) { points[i] = new Array(); points [i] = lines[i].split(","); 	}
		}
	});
	console.log(points[0]);
    setMarkers(map, points);
}
        google.maps.event.addDomListener(window,'load',initialize);
</script>
</head>
<body>
	<div id="map_canvas" style="width:800px; height:500px"></div>
</body>
</html>
