<?php
require_once("classes/BiblioCopyQuery.php");
require_once("classes/BiblioCopy.php");
require_once ("classes/Paginated.php");
require_once ("classes/DoubleBarLayout.php");

$bcq = new BiblioCopyQuery();


/*
 * Condition 2 from our_library_cities for book listing
*
* 2a - when a search button is clicked after choosing a location ($location)
* 2b - a location is clicked on the map then list all the books in that location
*
*/

/*
 * Condition 3 from our_library_cities for book listing
*
* when a search button is clicked  without choosing a location but choosing a city
* then display the locations in the city and the books in that city
*
*/

/*
 * Condition 4 from our_library_cities for book listing
*
* when a search button is clicked  without choosing a location
* show the cities and the books
*
*/

$books=$bcq->getBooksByCriteria($author,$title,$category,$chosencity,$chosenlocationid);
$_GET['author']=$author;
$_GET['title']=$title;
$_GET['search_type']=$search_type;
$_GET['category']=$category;
$_GET['city']=$chosencity;


?>
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
html {
	height: 100%
}

body {
	height: 100%;
	margin: 0;
	padding: 0
}
</style>
</head>
<body>
	<div id="bookListing" style="width: 800px; height: 500px">
		<br />
		<?php 
			if($books==null)
			{
				echo "<br></br><br></br><font style='color:red;font-weight:bold;font-size:16px;text-align:center;padding:20px' >No Books Found For The Given Search Criteria</font>\n";
				
			}
			else {
?>

		<table id="table-search">
			<tr style="background: #ccc">
				<th>Category</th>
				<th>Title</th>
				<th>Author</th>
				<th>City</th>
				<th>Location</th>
				<th>Status</th>
			</tr>
			<?php
			if(isset($_GET['page']))
				$page = $_GET['page'];
			else
				$page=1;
			$pagedResults = new Paginated($books, 5, $page);
while($book = $pagedResults->fetchPagedRow()) { ?>
			<tr>
				<td><?php echo $book["Category"] ?>
				
				<td><?php echo $book["Title"] ?></td>
				<td><?php echo $book["Author"] ?></td>
				<td><?php echo $book["City"] ?>
				</td>
				<td><?php echo $book["Location"] ?></td>
				<td><?php echo $book["Status"] ?></td>
			</tr>
			<?php }

			//set all the post or get variables depending on the condition of the book listing
			$queryVars = "";

			switch ($condition) {
				case 1:
					if (isset($chosencity) && $chosencity !='') {
						$queryVars .= "&chosencity=".$chosencity;
						$queryVars .= "&lat=".$_GET['lat'];
						$queryVars .= "&long=".$_GET['long'];
						$queryVars .= "&condition=1";
					}
					break;
				case 2:
					if (isset($citydetails) && $citydetails !='') {
						$queryVars .= "&city=".implode(",",$citydetails);

						$queryVars .= "&search_type=".$search_type;
						$queryVars .= "&author=".$author;
						$queryVars .= "&title=".$title;
						$queryVars .= "&category=".$category;
						$queryVars .= "&location=".$location;

						//type, author, title, category, location
						$queryVars .= "&lat=".$_GET['lat'];
						$queryVars .= "&long=".$_GET['long'];
					}
					$queryVars .= "&condition=2";
					break;
				case 3:
					if (isset($citydetails) && $citydetails !='') {
						$queryVars .= "&city=".implode(",",$citydetails);
						$queryVars .= "&search_type=".$search_type;
						$queryVars .= "&author=".$author;
						$queryVars .= "&title=".$title;
						$queryVars .= "&category=".$category;
						$queryVars .= "&location=".$location;

						//type, author, title, category
						$queryVars .= "&lat=".$_GET['lat'];
						$queryVars .= "&long=".$_GET['long'];
					}
					$queryVars .= "&condition=3";
					break;
				case 4:
					if (isset($chosenlocationid) && $chosenlocationid !='') {
						$queryVars .= "&locationid=".$chosenlocationid;
						$queryVars .= "&lat=".$_GET['lat'];
						$queryVars .= "&long=".$_GET['long'];
					}
					$queryVars .= "&condition=4";
					break;
					//condition 5 where a button is submitted without choosing a city or location
				case 5:
					$queryVars .= "&search_type=".$search_type;
					$queryVars .= "&author=".$author;
					$queryVars .= "&title=".$title;
					$queryVars .= "&category=".$category;
					$queryVars .= "&lat=".$_GET['lat'];
					$queryVars .= "&long=".$_GET['long'];
					$queryVars .= "&condition=5";

					break;
				default:
					if (isset($citydetails) && $citydetails !='') {
						//type, author, title, category
						$queryVars .= "&search_type=".$search_type;
						$queryVars .= "&author=".$author;
						$queryVars .= "&title=".$title;
						$queryVars .= "&category=".$category;
						$queryVars .= "&location=".$location;
						$queryVars .= "&lat=".$_GET['lat'];
						$queryVars .= "&long=".$_GET['long'];
					}
					$queryVars .= "&condition=5";
					break;
			}
			?>
			<tr>
				<?php   			
				$pagedResults->setLayout(new DoubleBarLayout());
				echo $pagedResults->fetchPagedNavigation($queryVars);
				
				
				
}
				?>
			</tr>
			<tr>
				<br>
				<br>
			</tr>
		</table>
	</div>
</body>
</html>


