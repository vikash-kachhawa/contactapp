<?php
	if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
	include "../include/config.php";	
	
	$fid = mysqli_real_escape_string($con, clean_input($_POST["fidpost"]));
	$fname = mysqli_real_escape_string($con, clean_input($_POST["fnamepost"]));
	
	
	$res['status'] = 0;
    $res['msg'] = "";
    
    if(isset($_POST))
	{

		if($fid == "")
	    {
	        $res['msg'] = 'Error : Invalid Request!';
	    }
	    elseif($fname == "")
	    {
	        $res['msg'] = 'Please enter filter name';
	    }
		else
		{

			$sqlchecknameexist = "select * from related_to where name = '".$fname."' AND id != ".$fid;
          	$rowchecknameexist = mysqli_query($con, $sqlchecknameexist);
          	if (mysqli_num_rows($rowchecknameexist) > 0)
          	{
          		$res['status'] = 0;
				$res['msg'] = 'A filter with the same name already exist.';
          	}
          	else
          	{
				$sqlupdatefilter = "update related_to set name = '".$fname."' where id = ".$fid;

				if(mysqli_query($con,$sqlupdatefilter))	
				{	
					$res['status'] = 1;
					$res['msg'] = 'Filter updated Successfully. ';		
				}
				else
				{
					$res['msg'] = 'Error : Failed to update filter!';	   
				}
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