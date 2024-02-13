<?php
	if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
	include "../include/config.php";	
	
	$fname = mysqli_real_escape_string($con, clean_input($_POST["related-to-filter-name"]));
	
	$res['status'] = 0;
    $res['msg'] = "";
    
    if(isset($_POST))
	{

		if($fname == "")
	    {
	        $res['msg'] = 'Please enter filter name';
	    }
		else
		{

			$sqlchecknameexist = "select * from related_to where name = '".$fname."'";
          	$rowchecknameexist = mysqli_query($con, $sqlchecknameexist);
          	if (mysqli_num_rows($rowchecknameexist) > 0)
          	{
          		$res['status'] = 0;
				$res['msg'] = 'A filter with the same name already exist.';
          	}
          	else
          	{
				$sqladdfilter = "insert into related_to (name) values ('".$fname."')";

				if(mysqli_query($con,$sqladdfilter))	
				{	
					$res['status'] = 1;
					$res['msg'] = 'Filter added Successfully. ';		
				}
				else
				{
					$res['msg'] = 'Error : Failed to add filter!';	   
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