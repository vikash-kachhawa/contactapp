<?php
	if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
	include "../include/config.php";	
	
	$fid = mysqli_real_escape_string($con, clean_input($_POST["fidpost"]));	
	
	$res['status'] = 0;
    $res['msg'] = "";
    
    if(isset($_POST))
	{

		if($fid == "")
	    {
	        $res['msg'] = 'Error : Invalid Request!';
	    }
		else
		{

			$sqldeletefilter = "delete from product_type where id = '".$fid."'";

			if(mysqli_query($con,$sqldeletefilter))	
			{	
				
				$sqldeletecontacts = "update contact set product_type = '0' where product_type = '".$fid."'";
				if(mysqli_query($con,$sqldeletecontacts))	
				{	
					$res['status'] = 1;
					$res['msg'] = 'Filter deleted Successfully. ';		
				}
				else
				{
					$res['msg'] = 'Error : Failed to delete filter!';	   
				}		
			}
			else
			{
				$res['msg'] = 'Error : Failed to delete related contacts!';	   
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