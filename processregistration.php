		<?php require_once ("classes/Member.php");?>	
		<?php require_once ("classes/MemberQuery.php");?>
		<?php require_once ("Email/class.phpmailer.php");?>		
		<?php require_once ("Email/config.php"); ?>
		
	
	<?php 
	$string; 										// Information of Registration
	$mailText;
	$mailText="This is to acknowledge that we have received information submitted by you as shown below and we thank you for Registering at <a href=\"www.yousee.in\">YouSee</a>. <br /><br />You may reply to this email or call +91-8008-884422 for any futher information you may like to have from <a href=\"www.yousee.in\">YouSee</a>";

	$mbrQ = new MemberQuery();
	$mbrQ->connect();
	
	$msg="";
	$email = $_POST['email'];
	$email_result = $mbrQ->DupEmail($email);
	if($email_result)
	{
		$msg = "<p> This email address has already been registered by a member. Please enter another email address.</p>";
		
	}
	
	$phone = $_POST['phone'];
	$phone_result = $mbrQ->DupPhone($phone);
	if($phone_result )
	{
		$msg.= ",<p> This Phone Number has already been registered by a member. Please enter another number. </p>";
		echo $msg;
		exit();
	}
	else if($email_result){
		echo $msg;
		exit();
	}
	
	
	if(registerMember())
	{
		$name=$_POST["fname"]." ".$_POST["lname"];
		sendEmail($_POST["email"],$name);
		buildMemberTable();
		$msg = "Your are Succesfully Registerd . You can now check out books from your nearest Library Location.You can check confirmation email from YouSee.";
		echo $msg;
	}


	function sendEmail($email,$displayName)
	{
		global $string, $mailText;
		try{
			$to = $email;
			$mail->AddAddress($to);
			$mail->AddBCC("karthikeya.vecham@gmail.com");
			$subject= "Acknowledgement-Information Submission";

			$body = "Dear " .$displayName. ",<br><br>".$mailText;
			$body.=$string;
			$body.="<br><br><br> From YouSee (+91-8008-884422) <br /> <a href=\"www.yousee.in\">www.yousee.in</a>";
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



	function registerMember()
	{
		global $mbrQ;
		$mbr = new Member();
		$mbr->setLastName($_POST["lname"]);
		$mbr->setFirstName($_POST["fname"]);
		$mbr->setWorkPhone($_POST["phone"]);
		$mbr->setEmail($_POST["email"]);
		$id=$mbrQ->insert($mbr);
		if($id!=null)
			return true;
		else 
			return false;
		}


	function showError()
	{
		echo "Registration failed.. Please re-submit Information..";
	}

	function buildMemberTable()
	{
		global $string;
		$string = "<div style=\"position: absolute; bottom: 0; width: 100%\">
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
				<td> ".$_POST['phone'] ."</td>
				</tr>
				<tr >
				<td>Email/Username</td>
				<td> ".$_POST['email']." </td>
				</tr>
				</table>";

	}
	echo $string;
	?>