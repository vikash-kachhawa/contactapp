<?php
	if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
	include "../include/config.php";	
	
	$listid = mysqli_real_escape_string($con, clean_input($_POST["list-id"]));
	$contactarrstr = mysqli_real_escape_string($con, clean_input($_POST["contact-arr-str"]));
	
	$res['status'] = 0;
    $res['msg'] = "";
    
    if(isset($_POST))
	{

	    if($contactarrstr == "")
	    {
	        $res['msg'] = "No Contacts Selected !";
	    }
		elseif($listid == "0")
	    {
	        $res['msg'] = "Please enter list name";
	    }
		else
		{
			$contactarr = explode(",",$contactarrstr);
			foreach ($contactarr as $value) 
			{
				$sqlcheckcontactexist = "select id from list_contact_mapping where list_id = ".$listid." AND contact_id = ".$value;
	          	$rowcheckcontactexist = mysqli_query($con, $sqlcheckcontactexist);
	          	if (mysqli_num_rows($rowcheckcontactexist) <= 0)
	          	{
	          		$sqllistcontactmapping = "insert into list_contact_mapping (list_id,contact_id) values (".$listid.",".$value.")";

        			mysqli_query($con,$sqllistcontactmapping);
	          	}
			}

			$sqlgetlisthash = "select hash from saved_list where id = ".$listid;
	        $rowgetlisthash = mysqli_query($con, $sqlgetlisthash);

	        if (mysqli_num_rows($rowgetlisthash) > 0)
	        {
	        	$resgetlisthash = mysqli_fetch_array($rowgetlisthash);

				$rlink = getDomain()."/viewlist".getPageExt()."?i=".$listid."&h=".$resgetlisthash['hash'];
				$res['status'] = 1;
				$res['msg'] = $rlink;
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