<?php
	if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
	include "../include/config.php";	
	
	$lid = mysqli_real_escape_string($con, clean_input($_POST["lidpost"]));
	$lhash = mysqli_real_escape_string($con, clean_input($_POST["lhashpost"]));
	
	
	$res['status'] = 0;
    $res['msg'] = "";
    
    if(isset($_POST))
	{

		if($lid == "" || $lhash == "")
	    {
	        $res['msg'] = 'Error : Invalid Request!';
	    }
		else
		{

			$sqldeletelistcontact = "delete from list_contact_mapping where list_id = ".$lid;

			if(mysqli_query($con,$sqldeletelistcontact))	
			{	
				$sqldeletelist = "delete from saved_list where id = ".$lid." AND hash = '".$lhash."'";

				if(mysqli_query($con,$sqldeletelist))	
				{	
					$res['status'] = 1;
					$res['msg'] = 'List deleted Successfully. ';		
				}
				else
				{
					$res['msg'] = 'Error : Failed to delete list!';	   
				}		
			}
			else
			{
				$res['msg'] = 'Error : Failed to delete list contact!';	   
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