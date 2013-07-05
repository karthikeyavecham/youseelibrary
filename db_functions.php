<?php
	include('prod_conn.php'); 
	
	$mode = $_POST['mode'];
	//$mode = "CHECK_REGISTRATION";
	$query = "";
	
	if($mode == "CATEGORY") {
		$query = "SELECT *
				  FROM 
				  item_category
				 ";
		
		$result = mysql_query($query);
		
		$return_data = "";
		if(mysql_num_rows($result) > 0){
			while($row = mysql_fetch_array($result)) {
				$return_data .= $row['category_id'] . ", " . $row['category'] ."; ";
			}		
			echo json_encode(array('Result' => 1, 'Message' => $return_data));
		} else {
			echo json_encode(array('Result' => 0, 'Message' => mysql_error($connectDB)));
		}
	} else if ($mode == "ITEM") {
		$category_id = $_POST['category_id'];
		$query = "SELECT item_id, donationitem
				  FROM 
				  items
				  WHERE
				  category_id = '$category_id'
				 ";
		
		$result = mysql_query($query);
		
		$return_data = "";
		if(mysql_num_rows($result) > 0){
			while($row = mysql_fetch_array($result)) {
				$return_data .= $row['item_id'] . ", " . $row['donationitem'] ."; ";
			}		
			echo json_encode(array('Result' => 1, 'Message' => $return_data));
		} else {
			echo json_encode(array('Result' => 0, 'Message' => mysql_error($connectDB)));
		}
	} else if ($mode == "DONORS_LIST") {
		//$input = "A";
		$input = $_POST['input_text'];
		$query = "SELECT donor_id, displayname, village_town, mobile_phone_no, preferred_email, org_grp_name
				  FROM 
				  donors
				  WHERE
				  displayname COLLATE UTF8_GENERAL_CI LIKE '%$input%'
				 ";
		
		$result = mysql_query($query);
		
		$return_data = "";
		if(mysql_num_rows($result) > 0){
			while($row = mysql_fetch_array($result)) {
				$return_data .= $row['donor_id'] . "," . $row['displayname'] . "," . $row['mobile_phone_no']. "," . $row['preferred_email'] . "," . $row['village_town'] . "," . $row['org_grp_name'] . ";";
			}		
			echo json_encode(array('Result' => 1, 'Message' => $return_data));
		} else {
			echo json_encode(array('Result' => 0, 'Message' => mysql_error($connectDB)));
		}
	} else if ($mode == "SUBMIT") {
		$donor = $_POST['donor'];
		$dod = $_POST['dod'];
		$placeofdonation = $_POST['placeofdonation'];
		$city = $_POST['city'];
		$item_id = $_POST['item_id'];
		$unit = $_POST['unit'];
		$quantity = $_POST['quantity'];
		$unit_val = $_POST['unit_val'];
		$cal_val = $_POST['cal_val'];
		$actual_value = $_POST['actual_value'];
		
		$query = "INSERT INTO donatewaste 
				 (donor_id, dateofdonation, placeofdonation, city, item_id, donationunit, donationquantity, donationunitvalue, donationcalculatedvalue, donationvalue) 
				 VALUES 
				 ('$donor','$dod','$placeofdonation','$city','$item_id','$unit','$quantity','$unit_val','$cal_val','$actual_value')
				 ";
		//echo json_encode(array('Result' => 1, 'Message' => $query));
		$result = mysql_query($query);
		if($result > 0) {
			echo json_encode(array('Result' => 1, 'Message' => "YES"));
		} else {
			echo json_encode(array('Result' => 0, 'Message' => mysql_error($connectDB)));
		}
	} else if ($mode == 'CERTIFICATES') {
		
			$query = "SELECT PROJECT_ID, PROJECT_DESCRIPTION, NAME
			            FROM (SELECT PROJECT_ID, PROJECT_DESCRIPTION, PROJECT_AREA, LOCATION, PARTNER_ID, TOTAL_VALUE, TOTAL_POSTPAID
			              FROM (SELECT CERTIFICATE_ID, PROJECT_ID, PARTNER_ID, SUM(VALUE) TOTAL_VALUE, SUM(POSTPAID) TOTAL_POSTPAID
			                FROM project_certificates LEFT OUTER JOIN (SELECT CERTIFICATE_ID, SUM(AMOUNT_FOR_PROJECT) POSTPAID
			                                                           FROM postpay_certificates GROUP BY CERTIFICATE_ID)PAID
			                 USING (CERTIFICATE_ID)
			                 GROUP BY  PROJECT_ID)SUMMARY
			            LEFT OUTER JOIN projects USING (PROJECT_ID))FULL
			          LEFT OUTER JOIN project_partners USING (PARTNER_ID)
			          ORDER BY  PROJECT_ID DESC
			          " ;

			$result = mysql_query($query);
			$projects = "";
			while ($row = mysql_fetch_assoc($result)) {
				$projects .= $row['PROJECT_ID'] . "^" . $row['PROJECT_DESCRIPTION'] . "^" . $row['NAME'] . ";";	
			}
			
			$query2 = "SELECT PROJECT_ID, CERTIFICATE_ID, DATE_FORMAT(START_DATE,'%d-%b-%Y') STARTDATE, DATE_FORMAT(COMPLETION_DATE,'%d-%b-%Y') COMPLETIONDATE, VALUE, (VALUE-POSTPAID) AVAILABLE
			            FROM project_certificates LEFT OUTER JOIN (SELECT CERTIFICATE_ID, SUM(AMOUNT_FOR_PROJECT) POSTPAID
			                                                  FROM postpay_certificates GROUP BY CERTIFICATE_ID)PAID
			            USING (CERTIFICATE_ID)
			            ORDER BY PROJECT_ID DESC 
			            ";

			$result2 = mysql_query($query2);
			$certificates = "";
			while ($row = mysql_fetch_assoc($result2)) {
			  $certificates .= $row['PROJECT_ID'] . "," . $row['CERTIFICATE_ID'] . "," . $row["STARTDATE"] . "," . $row["COMPLETIONDATE"] . "," . $row["VALUE"] . "," . $row["AVAILABLE"] . ";";
			}
			echo json_encode(array('Result' => 1, 'Projects' => $projects, 'Certificates' => $certificates));
	} else if ($mode == 'SUBMIT_DON_DETAILS') {
		$dod = $_POST['DOD'];
		$amount = $_POST['Amount'];
		$mode_pay = $_POST['MODE_PAY'];
		$ins_no = $_POST['INS_NO'];
		$ins_date = $_POST['INS_DATE'];
		$ins_nar = $_POST['INS_NAR'];
		$query = "INSERT INTO payments
				 (payment_date, mode_of_payment, instrument_no, instrument_date, instrument_amount, instrument_narration) 
				 VALUES 
				 ('$dod', '$mode_pay', '$ins_no', '$ins_date', '$amount', '$ins_nar')
				 ";
		$result = mysql_query($query);
		if($result > 0) {
			$query = "SELECT payment_id 
					  FROM payments
					  WHERE
					  payment_date = '$dod' AND mode_of_payment = '$mode_pay' AND instrument_no = '$ins_no' AND instrument_date = '$ins_date' AND instrument_amount = '$amount' AND instrument_narration = '$ins_nar'
					 ";
			$result = mysql_query($query);
			if(mysql_num_rows($result) > 0){
				$row = mysql_fetch_array($result);
				echo json_encode(array('Result' => 1, 'Message' => "YES", 'Payment_Id' => $row['payment_id']));
			} else {
				echo json_encode(array('Result' => 0, 'Message' => mysql_error($connectDB)));
			}
		} else {
			echo json_encode(array('Result' => 0, 'Message' => mysql_error($connectDB)));
		}
	} else if ($mode == 'SUBMIT_DON') {
		$payment_id = $_POST['Payment_Id'];
		$user_Id = $_POST['User_id'];
		$cer_id = $_POST['Certificate_id'];
		$amount_pr = $_POST['Amount_Pro'];
		$amount_op = $_POST['Amount_Op'];
		$query = "INSERT INTO postpay_certificates
				 (payment_id, certificate_id, donor_id, amount_for_project, amount_for_operations_grant) 
				 VALUES 
				 ('$payment_id', '$cer_id', '$user_Id', '$amount_pr', '$amount_op')
				 ";
		$result = mysql_query($query);
		if($result > 0) {
			echo json_encode(array('Result' => 1, 'Message' => "YES"));
		} else {
			echo json_encode(array('Result' => 0, 'Message' => mysql_error($connectDB)));
		}
	} 
	mysql_close();
?>