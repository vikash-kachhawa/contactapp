<?php
	if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
	include "../include/config.php";	
	
	$cid = mysqli_real_escape_string($con, clean_input($_POST["c-id"]));
	$chash = mysqli_real_escape_string($con, clean_input($_POST["c-hash"]));
	$personname = mysqli_real_escape_string($con, clean_input($_POST["person-name"]));
	$personname = mysqli_real_escape_string($con, clean_input($_POST["person-name"]));
	$companyname = mysqli_real_escape_string($con, clean_input($_POST["company-name"]));
	$designation = mysqli_real_escape_string($con, clean_input($_POST["designation"]));
	$companyaddress1 = mysqli_real_escape_string($con, clean_input($_POST["company-address-1"]));
	$companyaddress2 = mysqli_real_escape_string($con, clean_input($_POST["company-address-2"]));
	$companyaddress3 = mysqli_real_escape_string($con, clean_input($_POST["company-address-3"]));
	$businessemail = mysqli_real_escape_string($con, clean_input($_POST["business-email"]));
	$personalemail = mysqli_real_escape_string($con, clean_input($_POST["personal-email"]));
	$mobileno = mysqli_real_escape_string($con, clean_input($_POST["mobile-no"]));
	$landlineno = mysqli_real_escape_string($con, clean_input($_POST["landline-no"]));
	$website = mysqli_real_escape_string($con, clean_input($_POST["website"]));
	$residenceaddress1 = mysqli_real_escape_string($con, clean_input($_POST["residence-address-1"]));
	$residenceaddress2 = mysqli_real_escape_string($con, clean_input($_POST["residence-address-2"]));
	$residenceaddress3 = mysqli_real_escape_string($con, clean_input($_POST["residence-address-3"]));
	$relatedto = mysqli_real_escape_string($con, clean_input($_POST["related-to"]));
	$producttype = mysqli_real_escape_string($con, clean_input($_POST["product-type"]));
	$importance = mysqli_real_escape_string($con, clean_input($_POST["importance"]));
	$crlimit = mysqli_real_escape_string($con, clean_input($_POST["cr-limit"]));
	$group = mysqli_real_escape_string($con, clean_input($_POST["group"]));
	$category = mysqli_real_escape_string($con, clean_input($_POST["category"]));
	
	
	$res['status'] = 0;
    $res['msg'] = "";
    $uniqueOk = 0;
    
    if(isset($_POST))
	{

		if($cid == "" || $chash == "")
	    {
	        $res['msg'] = 'Error : Missing Credentials';
	    }
	    elseif($personname == "")
	    {
	        $res['msg'] = 'Please enter person name.';
	    }
	    elseif(!preg_match("/^[a-zA-Z\s]*$/",$personname))
	    {
	        $res['msg'] = 'Please enter a valid person name.';
	    }
	    elseif($companyname == "")
	    {
	        $res['msg'] = 'Please enter company name.';
	    }
	    elseif($designation == "")
	    {
	        $res['msg'] = 'Please enter designation.';
	    }
		else
		{


			$sqlupdatecontact = "update contact set 
				person_name = '".$personname."',
				company_name = '".$companyname."',
				designation = '".$designation."',
				company_address_1 = '".$companyaddress1."',
				company_address_2 = '".$companyaddress2."',
				company_address_3 = '".$companyaddress3."',
				business_email = '".$businessemail."',
				personal_email = '".$personalemail."',
				mobile_no = '".$mobileno."',
				landline_no = '".$landlineno."',
				website = '".$website."',
				residence_address_1 = '".$residenceaddress1."',
				residence_address_2 = '".$residenceaddress2."',
				residence_address_3 = '".$residenceaddress3."',
				related_to = '".$relatedto."',
				product_type = '".$producttype."',
				importance = '".$importance."',
				group_type = '".$group."',
				category = '".$category."',
				cr_limit = '".$crlimit."'
				where id = ".$cid." AND hash = '".$chash."'";

			if(mysqli_query($con,$sqlupdatecontact))	
			{	
				$res['status'] = 1;
				$res['msg'] = 'Contact updated Successfully. ';		
			}
			else
			{
				$res['msg'] = 'Error : Failed to add card!';	   
			}	
		}
	}
	else
	{
		$res['msg'] = "Error: Invalid submission method!";
	}
	//echo mysqli_error($con);

	echo json_encode($res);
?>