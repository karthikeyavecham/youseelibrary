<html>
<head>
<script type="text/javascript">
</script>
</head>
<body>
	<div id="searchConditionsDisplayed" style="width: 800px; height: 50px">
		<table>
			<tr style="background: #ccc">
				<th>Search Details:</th>
			</tr>
			<?php 
			if ((isset($category)) && ($category != '')) echo "<td>Category:  ".$category." </td><td>\t</td>";
			if ((isset($title)) && ($title != '')) echo "<td>Title: ".$title." </td><td>\t</td>";
			if ((isset($author)) && ($author != '')) echo "<td>Author: ".$author." </td><td>\t</td>";
			if ((isset($_POST['city'])) && ($_POST['city'] != '')) echo "<td>City: ".$chosencity." </td><td>\t</td>";
			if ( isset($_POST['location']) && ($_POST['location']!='') ) echo "<td>Location: ".$chosenlocationid." </td><td>\t</td>";
			?>
			</tr>
		</table>
	</div>
</body>
</html>
