<html>
<head>
<script type="text/javascript">
function displayDiv() {
    var selectBox = document.getElementById("search_type");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
			if(selectedValue=='author')
			{document.getElementById("author_div").style.display="block";}
			else {document.getElementById("author_div").style.display="none";}
			if(selectedValue=='title')
			{document.getElementById("title_div").style.display="block";}
			else {document.getElementById("title_div").style.display="none";}
			if(selectedValue=='category')
			{document.getElementById("category_div").style.display="block";}
			else {document.getElementById("category_div").style.display="none";}
   }
</script>
</head>
<body>
<form method="post" name="search_library" action="search_library_action.php">
<div id="search_contents">
	<div id="search_by">
		<p><b>Search By:</b></p>
		<select name="search_type" id="search_type" style="width:140px;" onchange="displayDiv();">
			<option value='' select="selected">--ALL--</option>
			<option id="author" value='author' >Author</option>
			<option id="title" value='title'>Title</option>
			<option id="category" value='category'>Category</option>
		</select>
	</div>
	<div id="author_div" style="display:none">
		<p><b>Author:</b></p>
			<input type="text" name="author_name" style="width:138px;">
	</div>
	<div id="title_div" style="display:none">
		<p><b>Title:</b></p>
			<input type="text" name="title_name" style="width:138px;">
	</div>
	<div id="category_div" style="display:none">
		<p><b>Category:</b></p>
		<select name="category" style="width:140px;">
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
