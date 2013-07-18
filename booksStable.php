<?php
require_once("classes/BiblioCopyQuery.php");
require_once("classes/BiblioCopy.php");
	
	$bcq = new BiblioCopyQuery();
	echo "Author is :".$author;
	
	if(isset($_GET['locationid']) && $_GET['locationid']!='')	{
		$locationid=$_GET['locationid'];
		$bcq->getBooksByCriteria(NULL,NULL,NULL,NULL,$locationid);
	} else {
 		$bcq->getBooksByCriteria($author,$title,$category,$city,$searchlocation);
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
<br />
<table id="table-search">
<tr style="background:#ccc">
<th>Category</th><th>Title</th><th>Author</th><th>City</th><th>Location</th><th>Status</th>
</tr>
<?php while ($book = $bcq->_conn->fetchRow()) { ?>
<tr>
<td><?php echo $book["Category"] ?><td><?php echo $book["Title"] ?></td><td><?php echo $book["Author"] ?></td><td><?php echo $book["City"] ?>
</td><td><?php echo $book["Location"] ?></td><td><?php echo $book["Status"] ?></td>
</tr>
<?php } ?>
</table>
</div>
</body>
</html>
