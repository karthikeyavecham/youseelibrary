<?php $thispage = "registrationResult"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration Confirmation</title>
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/table.css">
</head>

<body class="wrapper" style="width: 1000px;background:white; margin-right: auto; margin-left: auto; margin-top: -8px;">
<?php include 'header_navbar.php';?>
<?php
$string; // Information of Registration  
session_start();
if(isset($_SESSION['POST']))
{	
	$_POST=$_SESSION['POST'];
	unset($_SESSION['POST']);
}

include_once("opencity_conn.php");
$con= mysql_connect("$dbhost","$dbuser","$dbpass"); 	//establishes database connection
if (!$con) // if connection fails
{
	die('Could not connect: ' . mysql_error()); // error is shown
}

mysql_select_db("$dbdatabase");



$defaultUsername;
$userid;
$mailText;
if(isset($_POST['donorSubmit']))
{
	//echo "donor";
	$defaultUsername=$_POST['preferredEmail'];
	$mailText="This is to acknowledge that we have received information submitted by you as shown below and we thank you for Registering at <a href=\"www.yousee.in\">YouSee</a>. <br /><br />You may reply to this email or call +91-8008-884422 for any futher information you may like to have from <a href=\"www.yousee.in\">YouSee</a>";
	registerDonor();
	$username=$defaultUsername;
	echo "Your are Succesfully Registerd . You can now check out books from your nearest Library Location.You can check confirmation email from YouSee.";
}



function sendEmail($email,$displayName)
{
	global $string, $mailText;
	require_once ("Email/class.phpmailer.php");
	require_once 'Email/config.php';
	try{
		$to = $email;
		$mail->AddAddress($to);
		$mail->AddBCC("karthikeya.vecham@gmail.com");
		$subject= "Acknowledgement-Information Submission";

		$body =  "Dear  " .$displayName. ",<br><br>".$mailText;
		$body.=$string;
		$body.="<br><br><br> From YouSee  (+91-8008-884422) <br /> <a href=\"www.yousee.in\">www.yousee.in</a>";
		$mail->Subject = $subject;
		$mail->Body = $body;
		if($mail->Send())
		{
			;
		}
		else{
			echo "<script>alert('email failed');</script>";
			$mail->ErrorInfo;
			showError();
		}
	}
	catch (phpmailerException $e) {
		echo $e->errorMessage();
		echo "<script>alert('Message failed');</script>";
		//showError();
	}
}



function registerDonor()
{
	global $defaultDisplayName,$defaultUsername;
	$insertUserQuery="INSERT INTO members(first_name,last_name,work_phone,email) VALUES(fname,lname,phno,preferredEmail)";
	buildTable();
	if (!mysql_query($insertUserQuery))
	{
		showError();
		exit();
	}
	sendEmail($defaultUsername,$defaultDisplayName);
}


function showError()
{
	echo "Registration failed.. Please re-submit Information..";
}

function buildDonorTable()
{ 
	global $string;
$string  = "<div style=\"position: absolute; bottom: 0; width: 100%\">
  
</div>
<br /><br /><span style=\"margin-left:50px\"><b>Information Submitted</b></span>
<br /><br />
<table style=\"border-collapse:collapse;\" border=\"0\" bordercolor=\"#999999\">
	<tr style=\"background-color:#CCCFFF;\">
    <td>First Name</td>
    <td> ".$_POST['fname']." </td>
  </tr>
  <tr >
    <td>Last Name</td>
    <td> ". $_POST['lname']." </td>
  </tr>
  <tr style=\"background-color:#CCCFFF;\">
    <td>Contact Number</td>
    <td>  ".$_POST['phno'] ."</td>
  </tr>
  <tr >
    <td>Email/Username</td>
    <td>  ".$_POST['preferredEmail']." </td>
  </tr>
</table>";

} 
?>
 
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />

<?php include 'footer.php' ; ?>
</body>
</html>