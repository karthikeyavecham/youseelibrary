<?php

$search_by=$_POST["search_type"];
$author=$_POST["author"];
$title=$_POST["title"];
$category=$_POST["category"];
$city=$_POST["city"];
$location=$_POST["location"];
$sql= "select ";
$where_condition="";
?>

<html>
<table class="primary" border=2  >
  <tr>
    <th id="title" align="left" nowrap="yes" <?php if($title!="") { echo "hidden"; $where_condition.="title \=$title\","; }?> >
      <?php echo "Title"; ?>
    </th>
    <th id="author" align="left" nowrap="yes" <?php if($author!="") { echo "hidden" ; $where_condition.="author\=$author\","; } ?>  >
      <?php echo "Author"; ?>
    </th>
    <th id="category" align="left" nowrap="yes" <?php if($category!="") { echo "hidden"; $where_condition.="category\=$category\","; }?> >
      <?php echo "Category"; ?>
    </th>
    <th id="city" align="left" nowrap="yes" <?php if($city!="") { echo "hidden"; $where_condition.= "loc_city\=$city\","; }?> >
      <?php echo "City"; ?>
    </th>
    <th id="location" align="left" nowrap="yes" <?php if($location!=""){ echo "hidden"; $where_condition.="loc_address_one\=$location\","; } ?> >
      <?php echo "Location"; ?>
    </th>
    <th id="status" align="left" nowrap="yes" <?php $where_condition.="status_cd = 'in' or status_cd='out' ";  ?> >
      <?php echo "Status"; ?>
    </th>
  </tr>
  </table>

<?php 
$sql.="select * from biblio,biblio_copy,biblio_location where ".$where_condition;

$resultQ=$this->_conn->_exec($sql);
echo $resultQ;
if($resultQ->getRowCount()==0)
{
?>
	<tr>
		<td valign="top" colspan="<?php echo H($copyCols); ?>" class="primary" colspan="2">
	          <?php echo "No Books Founds"; ?>
		</td>
	</tr>      
<?php 
}
else {
while ($result = $resultQ->fetchCopy()) {

?>
      <td id="title" valign="top" >
        <?php echo "get title from data base"; ?>
      </td>
      <td id="author" valign="top" >
        <?php echo "get author from data base"; ?>
      </td>
      <td id="category"  valign="top" >
        <?php echo "get category from data base"; ?>
      </td>
      <td id="city" valign="top" >
        <?php echo "get city from data base"; ?>
      </td>
      <td id="location" valign="top" >
        <?php echo "get location from data base"; ?>
      </td>

      <td id="status" valign="top" >
       <?php echo "get status from data base"; ?>
     </td>

    </tr>      

<?php 
}
if($search_by=="")
{
	echo "selected values\n search by:".$search_by." author: ".$author." title".$title;
}
else
	$sql.=" s.";


?>

</html>