<?php
 require_once("classes/LocationQuery.php");
 require_once("classes/Location.php");
 $city = $_GET['city'];
 $locq = new LocationQuery();
 $locations = $locq->getLocationsForCity($city);
?>
<p><b><font color="red">Choose Location</font></b></p>
		<select name="location" style="width:140px;">
			<option value='' select="selected">--ALL--</option>
<?php
 foreach ($locations as $l) { 
				echo '<option value="'.$l->getLocationid().'" name="'.$l->getAddressOne().'">'.$l->getAddressOne().'</option>';
			    }
?>
		</select>

