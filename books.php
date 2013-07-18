<?php
require_once("classes/BiblioCopyQuery.php");
require_once("classes/BiblioCopy.php");
require_once ("classes/Paginated.php");
require_once ("classes/DoubleBarLayout.php");

	$bcq = new BiblioCopyQuery();
	
	if(isset($_GET['locationid']) && $_GET['locationid']!='')	{
		$locationid=$_GET['locationid'];
		$books=$bcq->getBooksByCriteria(NULL,NULL,NULL,NULL,$locationid);
	} else {
 		$books=$bcq->getBooksByCriteria($author,$title,$category,$city,$searchlocation);
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
<?php
if(isset($_GET['page']))
	$page = $_GET['page'];
else 
	$page=1;
$pagedResults = new Paginated($books, 5, $page);
while($book = $pagedResults->fetchPagedRow()) { ?>
<tr>
<td><?php echo $book["Category"] ?><td><?php echo $book["Title"] ?></td><td><?php echo $book["Author"] ?></td><td><?php echo $book["City"] ?>
</td><td><?php echo $book["Location"] ?></td><td><?php echo $book["Status"] ?></td>
</tr>
<?php }

$pagedResults->setLayout(new DoubleBarLayout());
echo $pagedResults->fetchPagedNavigation();

?>
</table>
</div>
</body>
</html>


