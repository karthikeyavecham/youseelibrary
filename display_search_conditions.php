<html>
<head>
<script type="text/javascript">
</script>
</head>
<body>
	<div id="searchConditionsDisplayed" style="width: 800px; height: 50px">
		<table>
			<tr><font style=" color:#0B3861;font-weight:bold;font-size:16px;"><br>Search Details: </font>
			<font style=" color:red;font-weight:bold;font-size:14px;">&nbsp;&nbsp;&nbsp;
			<?php if ((isset($category)) && ($category != '')) echo "Category: "?></font>
			<font style=" color:blue;font-size:14px;">
			<?php echo $category." ";?></font>
			<font style=" color:red;font-weight:bold;font-size:14px;">&nbsp;&nbsp;&nbsp;
			<?php if ((isset($title)) && ($title != '')) echo "Title: ";?>&nbsp;</font>
			<font style=" color:blue;font-size:14px;">
			<?php echo $title." ";?></font>
			<font style=" color:red;font-weight:bold;font-size:14px;">&nbsp;&nbsp;&nbsp;
			<?php if ((isset($author)) && ($author != '')) echo "Author: ";?>&nbsp;</font>
			<font style=" color:blue;font-size:14px;">
			<?php echo $author." ";?></font>
			<font style=" color:red;font-weight:bold;font-size:14px;">&nbsp;&nbsp;&nbsp;
			<?php if ((isset($_POST['city'])) && ($_POST['city'] != '')) echo "City: ";?>&nbsp;&nbsp;</font>
			<font style=" color:blue;font-size:14px;">
			<?php echo $chosencity." ";?></font>
			<font style=" color:red;font-weight:bold;font-size:14px;">&nbsp;&nbsp;&nbsp;
			<?php if ( isset($_POST['locationid']) && ($_POST['locationid']!='') ) echo "Location: ";?></font>
			<font style=" color:blue;font-size:14px;">
			<?php echo $chosenlocationid." ";?></font>
			</tr>
		</table>
	</div>
</body>
</html>
