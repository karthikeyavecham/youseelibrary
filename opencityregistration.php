<?php $thispage ="registration";
$regPage="";
?>

<?php session_start();
?>

<?php
$msg=" ";
/** Validate captcha */

if (isset($_POST['donorSubmit']))
{

	if (empty($_SESSION['captcha']) || trim(strtolower($_POST['captcha'])) != $_SESSION['captcha']) {

		$captcha_message = "Invalid captcha";
		$style = "background-color: #FF606C";
		$msg="Captcha entered is incorrect";
			
	} else {
		$captcha_message = "Valid captcha";
		$style = "background-color: #CCFF99";
		echo "before ";
		$_SESSION['POST']=$_POST;

		echo "after ";
		echo "jfksdjg ";
		header("Location: processRegistrations.php");

		exit();

	}

	//header("Location: processRegistrations.php");



}
if (isset($_POST['ngoSubmit']))
{

	if (empty($_SESSION['captcha']) || trim(strtolower($_POST['captchango'])) != $_SESSION['captcha']) {

		$captcha_message = "Invalid captcha";
		$style = "background-color: #FF606C";
		$msg="Captcha entered is incorrect";
			
	} else {
		$captcha_message = "Valid captcha";
		$style = "background-color: #CCFF99";
		echo "before ";
		$_SESSION['POST']=$_POST;

		echo "after ";
		echo "jfksdjg ";
		header("Location: processRegistrations.php");

		exit();

	}

	//header("Location: processRegistrations.php");



}


?>


<!doctype html>
<html lang="en">
<head>
<title>Registration</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="test/test.css">

<link rel="stylesheet" href="scripts/jquery-ui.css">
<script src="scripts/jquery.min.js"></script>
<script src="scripts/jquery.ui.core.js"></script>
<script src="scripts/jquery.ui.widget.js"></script>
<script src="scripts/datepicker.js"></script>
<script type="text/javascript">
		$(function() {
		$( "#dob" ).datepicker();
		$( "#dobngo" ).datepicker();
	});
	</script>
<script src="scripts/tabscripts.js"></script>
<script src="scripts/reg_validatorv4.js" type="text/javascript"></script>
<script type="text/javascript">
function redirectToOpenCityLibraryListing() {
	window.location.href="our_library_cities.php";
}
</script>
</head>
<body>
	<div id="wrapper">
		<div style="background: #FFF;">
			<?php include("header_navbar.php"); ?>


			<table>
				<tr>
					<td>
						<p>
							<strong>Registration Form</strong>
						</p>
					</td>
				</tr>
			</table>

			<div id="donorRegScreen" style="display: block;">
				<form name="donor" action="<?php echo $_SERVER['PHP_SELF'];?>"
					method="post">
					<input type="hidden" name="formName" value="donorReg" />



					<div style="margin-left: 30px;">
						<fieldset>
							<legend>Personal & Contact Info</legend>
							<div>

								<table border="0">
									<tr>
										<td><label for="firstName">First name*</label></td>
										<td><input name="fname" type="text" id="firstName" value="" />
										</td>
										<td><div class="error" id="donor_fname_errorloc"></div></td>
									</tr>
									<tr>
										<td><label for="lastName">Last name*</label></td>
										<td><input name="lname" type="text" id="lastName" value="" />
										</td>
										<td><div class="error" id="donor_lname_errorloc"></div></td>
									</tr>
									<tr>
									
									
									<tr>
										<td>Gender</td>
										<td><p>
												<label> <input type="radio" name="gender" value="M"
													id="radio_m" /> Male
												</label> <label> <input type="radio" name="gender" value="F"
													id="radio_f" /> Female
												</label> <br />
											</p></td>
										<td><div class="error" id="donor_fname_errorloc"></div></td>
									</tr>
									<tr>
										<td><label for="phone_number">Phone number*</label>
										</td>
										<td><input placeholder="Enter your 10 digit Mobile no.. "
											type="text" maxlength="10" name="phno" id="phone_number"
											value="" />
										</td>
										<td>
											<div class="error" id="donor_phno_errorloc"></div>
										</td>
									</tr>
									<tr>
										<td><label for="personal_emailid">Preferred Email ID*<br /> <span
												style="font-size: 10px">(Default Login username) 
										
										</label>
										</td>
										<td><input type="text" placeholder="example@yourdomain.com"
											value="" name="preferredEmail" id="preferred_emailid" />
										</td>
										<td>
											<div class="error" id="donor_preferredEmail_errorloc"></div>
										</td>
									</tr>
									<tr>
										<td><label for="password">Password*</label>
										</td>
										<td><input type="password" name="password" id="password"
											value="" /></td>
										<td><div class="error" id="donor_password_errorloc"></div></td>
									</tr>
									<tr>
										<td><label for="password">Retype Password*</label></td>
										<td><input type="password" name="repassword" id="cpassword"
											value="" /></td>
										<td><div class="error" id="donor_repassword_errorloc"></div></td>
									</tr>
								</table>
						
						</fieldset>
					</div>
					<script type="text/javascript">
 	var frmvalidator  = new Validator("donor");
	frmvalidator.EnableFocusOnError(true);
	frmvalidator.EnableOnPageErrorDisplay();
	frmvalidator.EnableMsgsTogether();
	frmvalidator.addValidation("fname","req","please enter first name");
	frmvalidator.addValidation("lname","req","please enter last name");
  </script>
					<script type="text/javascript">
		frmvalidator.addValidation("phno", "req", "	*Please enter  your Phone Number");
		frmvalidator.addValidation("preferredEmail", "email", "	*Please enter your Email properly");
		frmvalidator.addValidation("preferredEmail", "req", "	*Please enter your Email.");
		frmvalidator.addValidation("password", "req", "	please enter your password");
		frmvalidator.addValidation("cpassword", "req", "	retype Password cannot be empty");
		frmvalidator.addValidation("password", "minlen=6", "	password should have atleast 6 characters");
		frmvalidator.addValidation("password","eqelmnt=cpassword","The confirmed password is not same as your new password");
	
		</script>
					</fieldset>
					<fieldset style="margin-left: 30px;">
						<legend>Confirm That You are not a Robot</legend>
						<table>
							<tr>
								<td>&nbsp</td>
								<td>
									<p>
										<strong>Write the following word:</strong>
									</p> <img src="captcha/captcha.php" id="captcha" /><br /> <a
									href="#"
									onclick="
		document.getElementById('captcha').src='captcha/captcha.php?'+Math.random();
		document.getElementById('captcha-form').focus();"
									id="change-image">Not readable? Change text.</a><br /> <br /> <input
									type="text" name="captcha" id="captcha-form" autocomplete="off" /><br />
								</td>
								<td style="color: red;"><?php echo $msg; ?></td>
							</tr>
						</table>
					</fieldset>
					<script type="text/javascript">


		</script>
					<div style="margin-left: 100px;">
						<input id="register" style="visibility: visible" name="submit"
							type="submit" value="Register" /> <input id="register"
							style="visibility: visible" name="cancel" type="button"
							value="Cancel" onclick="redirectToOpenCityLibraryListing()">
					</div>

				</form>
				<br /> <br />
			</div>
			<br /> <br />
		</div>
	</div>
	<div style="width: 1000px; margin-right: auto; margin-left: auto;">
		<?php include("footer.php"); ?>
	</div>
</body>
</html>
<?php
/*
 Version Track
1 - 17May13 - Vivek - Registration form modified.
*/
?>
