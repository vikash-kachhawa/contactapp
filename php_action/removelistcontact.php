<?php
	if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
	include "../include/config.php";	
	
	$cid = mysqli_real_escape_string($con, clean_input($_POST["cidpost"]));
	$lid = mysqli_real_escape_string($con, clean_input($_POST["lidpost"]));
	
	
	$res['status'] = 0;
    $res['msg'] = "";
    
    if(isset($_POST))
	{

		if($cid == "" || $lid == "")
	    {
	        $res['msg'] = 'Error : Invalid Request!';
	    }
		else
		{

			$sqlremovecontact = "delete from list_contact_mapping where list_id = ".$lid." AND contact_id = '".$cid."'";

			if(mysqli_query($con,$sqlremovecontact))	
			{	
				$res['status'] = 1;
				$res['msg'] = 'Contact Removed Successfully. ';		
			}
			else
			{
				$res['msg'] = 'Error : Failed to remove contact!';	   
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