<?php
	if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
	include "../include/config.php";	
	
	$listname = mysqli_real_escape_string($con, clean_input($_POST["list-name"]));
	$contactarrstr = mysqli_real_escape_string($con, clean_input($_POST["contact-arr-str"]));
	
	$res['status'] = 0;
    $res['msg'] = "";
    $uniqueOk = 0;
    
    if(isset($_POST))
	{

	    if($contactarrstr == "")
	    {
	        $res['msg'] = "No Contacts Selected !";
	    }
		elseif($listname == "")
	    {
	        $res['msg'] = "Please enter list name";
	    }
		else
		{

			$sqlchecknameexist = "select * from saved_list where list_name = '".$listname."'";
          	$rowchecknameexist = mysqli_query($con, $sqlchecknameexist);
          	if (mysqli_num_rows($rowchecknameexist) > 0)
          	{
          		$res['status'] = 0;
				$res['msg'] = 'A list with the same name already exist.';
          	}
          	else
          	{

          		do 
				{
					$listhash = getName(30);

					$sqlcheckhashexist = "select id from saved_list where hash = '".$listhash."'";
	                $rowcheckhashexist = mysqli_query($con, $sqlcheckhashexist);

	                if (!(mysqli_num_rows($rowcheckhashexist) > 0))
	                {
	                		$uniqueOk = 1;
	                }

				} while ($uniqueOk == 0);

				$sqlcreatelist = "insert into saved_list (hash,list_name,created_on) values ('".$listhash."','".$listname."','".date('Y-m-d H:i:s')."')";

				if(mysqli_query($con,$sqlcreatelist))	
				{	
					$sqlgetlistid = "select id from saved_list where hash = '".$listhash."'";
				    $rowgetlistid = mysqli_query($con, $sqlgetlistid);

				    if(mysqli_num_rows($rowgetlistid) > 0)
				    {  
				        $resgetlistid = mysqli_fetch_array($rowgetlistid);

				        $newlistid = $resgetlistid['id'];
				        $contactarr = explode(",",$contactarrstr);
				        $contactquerystr = "";

				        $commaval = 0;
				        foreach ($contactarr as $value) 
            			{
            				if($commaval == 0)
            				{
            					$contactquerystr .= "(".$newlistid.",".$value.")";
            					$commaval = 1;
            				}
            				else
            				{
            					$contactquerystr .= ", (".$newlistid.",".$value.")";
            				}
            			}	

						$sqllistcontactmapping = "insert into list_contact_mapping (list_id,contact_id) values ".$contactquerystr;

            			if(mysqli_query($con,$sqllistcontactmapping))	
						{	
							$rlink = getDomain()."/viewlist".getPageExt()."?i=".$newlistid."&h=".$listhash;
							$res['status'] = 1;
							$res['msg'] = $rlink;		
						}
						else
						{
							$res['msg'] = 'Error : Failed to add contacts to list';	   
						}

				    }
				    else
				    {
						$res['msg'] = "Error : Unexpected exception occured";		   
				    }		
				}
				else
				{
					$res['msg'] = 'Error : Failed to create list!';	   
				}

									
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