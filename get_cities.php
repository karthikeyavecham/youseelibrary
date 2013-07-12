<?php
require_once("classes/CityQuery.php");
require_once("classes/City.php");
	$cityq = new CityQuery();
	$cities = $cityq->getCities();
?>
<p><b><font>City </font></b></p>
		<select name="city" style="width:140px;">
			<option value='' select="selected">--ALL--</option>
<?php
 foreach ($cities as $c) { 
				echo '<option value="'.$c.getCityName().'" name="'.$c.getCityName().'">'.$c.getCityName().'</option>';

			    }
?>
		</select>


