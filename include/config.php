<?php

    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\SMTP;
    // use PHPMailer\PHPMailer\Exception;

	$host="sepl-server.mysql.database.azure.com";
	$user="xasqsiiffk";
	$dbname="sepl-database";
	$password="RNH28WS6U30BLHLG$";

	$con = mysqli_connect($host, $user, $password, $dbname) or die("Something goes wrong try again later..!");

    date_default_timezone_set("Asia/Kolkata");
    
	function clean_input($data) 
	{
	  $data = trim($data);
	  return $data;
	}

	function getName($n) { 
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $randomString = ''; 
  
        for ($i = 0; $i < $n; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        } 
        return $randomString; 
    }

    function getNumber($n) { 
        $characters = '0123456789'; 
        $randomString = ''; 
  
        for ($i = 0; $i < $n; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        } 
        return $randomString; 
    }
	
    function getPageExt()
	{
		return "";
	}

	function getDomain()
	{
	    global $con;
		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
			$url = "https://";   
		else  
			$url = "http://";   
		$url.= $_SERVER['HTTP_HOST'];
		$url.= "/visiting-card";
		
		$finalurl = $url;

		return $finalurl;
	}

	function getImageDomain()
	{
	    $url = "http://localhost/costsheet";
	    return $url;
	}



// 	function smtp_mailer($to,$subject, $msg)
//     {
    
//         // require_once("../vendor/phpmailer/phpmailer/src/PHPMailer.php");

// require '../vendor/autoload.php';
//         $mail = new PHPMailer(); 
//         $mail->IsSMTP(); 
//         $mail->SMTPDebug = 0; 
//         // $mail->SMTPSecure = 'ssl';
//         // $mail->SMTPOptions = [
//         //     'ssl'=> [
//         //     'verify_peer' => false,
//         //     'verify_peer_name' => false,
//         //     'allow_self_signed' => true
//         //     ]
//         // ];
//         $mail->SMTPAuth = true;
//         //$mail->SMTPAutoTLS = false;
//         $mail->SMTPSecure = "tls";
//         $mail->isHTML(true);
//         $mail->Host = "smtp.gmail.com";
//         $mail->Port = 587;
//         $mail->Username = "vikasgopalani98@gmail.com";
//         $mail->Password = "cxec kdep vbyq mfky";
//         $mail->FromName = "SEPL";
//         $mail->Subject = $subject;
//         $mail->Body =$msg;
//         $mail->AddAddress($to);
//         $mail->Priority = 1;
//         if(!$mail->Send())
//         {
//             return 0;
//         }
//         else
//         {
//             return 1;
//         }
//     }

?>
