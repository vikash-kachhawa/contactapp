<?php
	if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
	include "../include/config.php";	
	
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

		if($personname == "")
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

			do 
			{
				$generatedhash = getName(30);

				$sqlcheckhashexist = "select id from contact where hash = '".$generatedhash."'";
                $rowcheckhashexist = mysqli_query($con, $sqlcheckhashexist);

                if (!(mysqli_num_rows($rowcheckhashexist) > 0))
                {
                		$uniqueOk = 1;
                }

			} while ($uniqueOk == 0);


			$sqladdvisitingcard = "insert into contact (hash,person_name,company_name,designation,company_address_1,company_address_2,company_address_3,business_email,personal_email,mobile_no,landline_no,website,residence_address_1,residence_address_2,residence_address_3,related_to,product_type,importance,group_type,category,cr_limit,created_on) values ('".$generatedhash."','".$personname."','".$companyname."','".$designation."','".$companyaddress1."','".$companyaddress2."','".$companyaddress3."','".$businessemail."','".$personalemail."','".$mobileno."','".$landlineno."','".$website."','".$residenceaddress1."','".$residenceaddress2."','".$residenceaddress3."','".$relatedto."','".$producttype."','".$importance."','".$group."','".$category."','".$crlimit."','".date('Y-m-d H:i:s')."')";

			if(mysqli_query($con,$sqladdvisitingcard))	
			{	
				$res['status'] = 1;
				$res['msg'] = 'Contact Added Successfully.';		
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
	echo mysqli_error($con);

	echo json_encode($res);
?>