<?php
require_once("classes/BiblioCopyQuery.php");
require_once("classes/BiblioCopy.php");
require_once "Paginated.php";
require_once "DoubleBarLayout.php";

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
<?php
$pagedResults = new Paginated($bcq, 10, 1);
echo "<ul>";
//echo "<th>".Category</th><th>Title</th><th>Author</th><th>City</th><th>Location</th><th>Status</th>

while($row = $pagedResults->fetchPagedRow()) {
  echo "<li>".$row["Category"]."\t".$row["Title"]."\t".$row["Author"]."\t".$row["City"]."\t".$row["Location"]."\t".$row["Status"]."</li>";
}
 
echo "</ul>";
 
$pagedResults->setLayout(new DoubleBarLayout());
echo $pagedResults->fetchPagedNavigation();
?>

</div>
</body>
</html>


