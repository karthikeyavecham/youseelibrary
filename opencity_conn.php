<?php

//DB host
$dbhost = "localhost";

//Username with privileges to connect to database for querying purpose
$dbuser = "opencitylibrary";

//Password of the above user account
$dbpass = "opencitylibrary";

//Database which will be selected before performing any insertion, updation or deletion
$dbdatabase = "opencitylibrary";

$connectDB = mysql_connect("$dbhost", "$dbuser", "$dbpass");
	if (!$connectDB) {
		echo "ERROR: Couldn't Connect";
	} 
	mysql_select_db("$dbdatabase", $connectDB);
?>