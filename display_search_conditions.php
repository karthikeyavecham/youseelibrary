
	<div id="searchConditionsDisplayed" style="width: 800px; height: 50px">
		<table>
			<tr><font style=" color:#369;font-weight:normal;font-size:12px;"><br>Search By: </font>
			<font style=" color:#369;font-weight:normal;font-size:11px;">&nbsp;&nbsp;&nbsp;
			<?php if ((isset($category)) && ($category != '')) echo "Category: "?></font>
			<font style=" color:#333;font-weight:bold;font-size:11px;">
			<?php echo $category." ";?></font>
			<font style=" color:#369;font-weight:normal;font-size:11px;">&nbsp;&nbsp;&nbsp;
			<?php if ((isset($title)) && ($title != '')) echo "Title: ";?>&nbsp;</font>
			<font style=" color:#333;font-weight:bold;font-size:11px;">
			<?php echo $title." ";?></font>
			<font style=" color:#369;font-weight:normal;font-size:11px;">&nbsp;&nbsp;&nbsp;
			<?php if ((isset($author)) && ($author != '')) echo "Author: ";?>&nbsp;</font>
			<font style=" color:#333;font-weight:bold;font-size:11px;">
			<?php echo $author." ";?></font>
			<font style="color:#369;font-weight:normal;font-size:11px;">&nbsp;&nbsp;&nbsp;
			<?php if (((isset($_POST['city'])) && ($_POST['city'] != '')) || isset($_GET['chosencity'])) echo "City: ";?>&nbsp;&nbsp;</font>
			<font style="color:#333;font-weight:bold;font-size:11px;">
			<?php echo $chosencity." ";?></font>
			<font style="color:#369;font-weight:normal;font-size:11px;">&nbsp;&nbsp;&nbsp;
			<?php if ( isset($_POST['locationid']) && ($_POST['locationid']!='') ) {
			$locq=new LocationQuery();
				$searchedloc=$locq->get($_POST['locationid']);	
				$searchlocation=$searchedloc->getAddressOne()." ".$searchedloc->getAddressTwo();
				echo "Location: ";
			}
			else if(isset($_GET['location'])){
				$searchlocation=$_GET['location'];
				echo "Location: ";
			}
				?></font>
			<font style=" color:#333;font-weight:bold;font-size:11px;">
			<?php echo $searchlocation; ?>
				</font>
			</tr>
		</table>
	</div>
