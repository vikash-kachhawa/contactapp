<?php
	if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
	include "../include/config.php";	
	
	$cid = mysqli_real_escape_string($con, clean_input($_POST["cidpost"]));
	$chash = mysqli_real_escape_string($con, clean_input($_POST["chashpost"]));
	
	
	$res['status'] = 0;
    $res['msg'] = "";
    
    if(isset($_POST))
	{

		if($cid == "" || $chash == "")
	    {
	        $res['msg'] = 'Error : Invalid Request!';
	    }
		else
		{

			$sqldeletecontact = "delete from contact where id = ".$cid." AND hash = '".$chash."'";

			if(mysqli_query($con,$sqldeletecontact))	
			{	
				$sqldeletelistcontact = "delete from list_contact_mapping where contact_id = ".$cid;
				if(mysqli_query($con,$sqldeletelistcontact))	
				{	
					$res['status'] = 1;
					$res['msg'] = 'Contact deleted Successfully. ';		
				}
				else
				{
					$res['msg'] = 'Error : Failed to delete list contact!';	   
				}		
			}
			else
			{
				$res['msg'] = 'Error : Failed to delete contact!';	   
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