<?php 
?>

<html>
<body>
<form method="post" name="search_library" action="search_library_action.php">
<div id="search_contents">
<div id="search_by">
	<p><b>Search By:</b></p>
	<select name="search_type" style="width:140px;">
		<option value='' select="selected">--ALL--</option>
		<option value='author'>Author</option>
		<option value='title'>Title</option>
		<option value='category'>Category</option>
	</select>
</div>
<div id="author" hidden>
	<p><b>Author:</b></p>
	<select name="author" style="width:140px;">
		<option value='' select="selected" >--ALL--</option>
		<?php
			include 'database_constants.php';
			mysql_connect("$dbhost","$dbuser","$dbpass");
			mysql_select_db("$dbdatabase");
			$sql=mysql_query("select author from biblio");
			while($row=mysql_fetch_array($sql))
			{
				$id=$row['bibid'];
				$data=$row['author'];
				echo '<option value="'.$id.'" name="'.$data.'" >'.$data.'</option>';
			}
		?>
	</select>
</div>
<div id="title" hidden>
	<p><b>Title:</b></p>
	<select name="title" style=" width:140px;">
		<option value='' select="selected">--ALL--</option>
		<?php
			include 'database_constants.php';
			mysql_connect("$dbhost","$dbuser","$dbpass");
			mysql_select_db("$dbdatabase");
			$sql=mysql_query("select title from biblio");
			while($row=mysql_fetch_array($sql))
			{
				$id=$row['bibid'];
				$data=$row['title'];
				echo '<option value="'.$id.'" name="'.$data.'" >'.$data.'</option>';
			}
		?>
</select>
</div>
<div id="category" hidden>
	<p><b>Category:</b></p>
	<select name="category" style=" width:140px;">
		<option value='' select="selected">--ALL--</option>
		<?php
			include 'database_constants.php';
			mysql_connect("$dbhost","$dbuser","$dbpass");
			mysql_select_db("$dbdatabase");
			$sql=mysql_query("select * from collection_dm");
			while($row=mysql_fetch_array($sql))
			{
				$id=$row['code'];
				$data=$row['description'];
				echo '<option value="'.$id.'" name="'.$data.'">'.$data.'</option>';
			}
		?>
</select>
</div>
<div id="city">
	<p><b>City:</b></p>
	<select name="city" style="width:140px;">
		<option value='' select="selected">--ALL--</option>
		<?php
			$city=array('Banglore','Bhopal','Hyderabad','Indore','Kolkata','Mumbai');
			for($i = 0, $size = count($city); $i < $size; $i++)
			{
				echo "<option value=\"".$city[$i]."\" title=\"".$city[$i]."\">".$city[$i]."</option>";
			}
		?>
	</select>
</div>
<div id="location">
	<p><b>Location:</b></p>
	<select name="location" style="width:140px;">
		<option value='' select="selected">--ALL--</option>
		<option value='hyderabad'>Hyderabad</option>
		<option value='bangalore'>Bangalore</option>
		<option value='delhi'>Delhi</option>
		<option value='mumbai'>Mumbai</option>
		<option value='etc'>Etc.,</option>
	</select>
</div>
</br></br>
<input type="submit" value="Submit">
</div>
</form>
</body>
</html>
