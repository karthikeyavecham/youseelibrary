<?php
require_once("classes/BiblioCopyQuery.php");
require_once("classes/BiblioCopy.php");
	
	$bcq = new BiblioCopyQuery();
	if(isset($_GET['locationid']) && $_GET['locationid']!='')	{
		$locationid=$_GET['locationid'];
		$books = $bcq->getBooksByCriteria(NULL,NULL,NULL,NULL,$locationid);
	} else {
   		echo $city. ' '.$location.' '.$title.' '.$author.' '.$category.' ';
 		$books = $bcq->getBooksByCriteria($author,$title,$category,$city,$location);
	}
	
?>
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
html { height: 100% }
body { height: 100%; margin: 0; padding: 0 }
</style>
</head>
<body>
<div id="bookListing" style="width:800px; height:500px">
<table>
<tr>
<td>Title</td><td>Author</td><td>Status</td>
</tr>
<?php foreach ($books as $book) { ?>
<tr>
<td><?php echo $book["Category"] ?><td><?php echo $book["Title"] ?></td><td><?php echo $book["Author"] ?></td><td><?php echo $book["Status"] ?></td>
</tr>
<?php } ?>
</table>
</div>
</body>
</html>
