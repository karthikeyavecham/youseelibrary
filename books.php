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
if(isset($_GET['page'])&&($_GET['page']!=''))
{
	$page=$_GET['page'];
	$lastcount = ($page-1)*10;
	$count=$_GET['numberofrecords'];
} else {
	$page=1;
	$lastcount=0;
	$count = $bcq->getCountOfBooksByCriteria($author, $title, $category, $chosencity, $chosenlocationid);
}
$books=$bcq->getBooksByCriteria($author,$title,$category,$chosencity,$chosenlocationid,$lastcount);


?>
	<div id="bookListing" style="width:800px; height: 500px">
		<br />
		<?php 
			if($books==null)
			{
				echo "<br></br><br></br><font style='color:red;font-weight:bold;font-size:16px;text-align:center;padding:20px' >No Books Found </font>\n";
				
			}
			else {
?>

		<table id="table-search" width="100%">
		<tr><td colspan="100" style="background:#eee;color:#333;font-size:15px;text-align:center;font-weight:bold;">Books Listing</td></tr>
			<tr style="background: #ccc">
				<th>Category</th>
				<th>Title</th>
				<th>Author</th>
				<th>City</th>
				<th>Location</th>
				<th>Status</th>
			</tr>
			<?php
			$pagedResults = new Paginated($books,$count,10, $page);
			while($book = $pagedResults->fetchPagedRow()) { ?>
			<tr>
				<td><?php echo $book["Category"] ?>
				
				<td><?php echo $book["Title"] ?></td>
				<td><?php echo $book["Author"] ?></td>
				<td><?php echo $book["City"] ?>
				</td>
				<td><?php echo $book["Location"] ?></td>
				<td style="color : <?php if($book["Status"]=="available") echo "green"; else echo "red"; ?>"><?php echo $book["Status"] ?></td>
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
						$queryVars .= "&numberofrecords=".$count;
					}
					break;
				case 2:
					//if (isset($citydetails) && $citydetails !='') {
					if (isset($chosencity) && $chosencity !='') {
						$queryVars .= "&chosencity=".$chosencity;

						$queryVars .= "&search_type=".$search_type;
						$queryVars .= "&author=".$author;
						$queryVars .= "&title=".$title;
						$queryVars .= "&category=".$category;
						$queryVars .= "&location=".$searchlocation;

						//type, author, title, category, location
						$queryVars .= "&lat=".$_GET['lat'];
						$queryVars .= "&long=".$_GET['long'];
					}
					$queryVars .= "&condition=2";
					$queryVars .= "&numberofrecords=".$count;
					break;
				case 3:
					if (isset($chosencity) && $chosencity !='') {
						$queryVars .= "&chosencity=".$chosencity;
						$queryVars .= "&search_type=".$search_type;
						$queryVars .= "&author=".$author;
						$queryVars .= "&title=".$title;
						$queryVars .= "&category=".$category;
						$queryVars .= "&location=".$searchlocation;

						//type, author, title, category
						$queryVars .= "&lat=".$_GET['lat'];
						$queryVars .= "&long=".$_GET['long'];
					}
					$queryVars .= "&condition=3";
					$queryVars .= "&numberofrecords=".$count;
					break;
				case 4:
						$queryVars .= "&location=".$chosenlocationid;
						$queryVars .= "&lat=".$_GET['lat'];
						$queryVars .= "&long=".$_GET['long'];
					$queryVars .= "&condition=4";
					$queryVars .= "&numberofrecords=".$count;
					break;
					//condition 5 where a button is submitted without choosing a city or location
				case 5:
					$queryVars .= "&search_type=".$search_type;
					$queryVars .= "&author=".$author;
					$queryVars .= "&title=".$title;
					$queryVars .= "&category=".$category;
					if(isset($_GET['lat']))
					$queryVars .= "&lat=".$_GET['lat'];
					if(isset($_GET['long']))
					$queryVars .= "&long=".$_GET['long'];
					$queryVars .= "&condition=5";
					$queryVars .= "&numberofrecords=".$count;

					break;
				default:
					if (isset($chosencity) && $chosencity !='') {
						//type, author, title, category
						$queryVars .= "&search_type=".$search_type;
						$queryVars .= "&author=".$author;
						$queryVars .= "&title=".$title;
						$queryVars .= "&category=".$category;
						$queryVars .= "&location=".$searchlocation;
						$queryVars .= "&lat=".$_GET['lat'];
						$queryVars .= "&long=".$_GET['long'];
					}
					$queryVars .= "&condition=5";
					$queryVars .= "&numberofrecords=".$count;
					break;
			}
			?>
			<tr>
				<?php   			
				$pagedResults->setLayout(new DoubleBarLayout());
				echo $pagedResults->fetchPagedNavigation($queryVars);
				?>
			</tr>
		</table>
		<?php echo $pagedResults->fetchPagedNavigation($queryVars); }?>

	</div>


