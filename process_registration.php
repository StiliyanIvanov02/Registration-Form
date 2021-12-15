<?php
require_once('config.php');

require('vendor/phpmailer/phpmailer/src/PHPMailer.php');
require('vendor/phpmailer/phpmailer/src/Exception.php');
require('vendor/phpmailer/phpmailer/src/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if(isset($_POST)){

	$firstname 			= $_POST['firstname'];
	$lastname 			= $_POST['lastname'];
	$email 				= $_POST['email'];
	$phonenumber		= $_POST['phonenumber'];
	$password 			= sha1($_POST['password']);
	$token       		= sha1($_POST['email']).rand(10,9999);
	$email_verification_link  = "<a href='localhost/registration_form/verify_email.php?key=".$_POST['email']."&token=".$token."'>Click and Verify Email</a>";

		$sql = "INSERT INTO users (firstname, lastname, email, phonenumber, password, token, email_verification_link ) VALUES(?,?,?,?,?,?,?)";
		try
		{
			$stmtinsert = $db->prepare($sql);
			$result = $stmtinsert->execute([$firstname, $lastname, $email, $phonenumber, $password, $token, $email_verification_link]);
		}
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
			http_response_code(500);
		}
		if($result)
		{
			$mail = new PHPMailer();

			$mail->IsSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true; 
			$mail->SMTPSecure = 'tls';
			$mail->Port = 587; 
			
			$mail->Username = "stiliyan.testing@gmail.com";
			$mail->Password = "Test!123";
			$mail->setFrom("stiliyan.testing@gmail.com", "Stiliyan Ivanov");

			$mail->Subject  =  'Confirm Registration';
			$mail->IsHTML(true);
			$mail->Body    =  $email_verification_link;              

			$mail->AddAddress($email, $firstname.' '.$lastname);

			if($mail->Send())
			{
				echo "Successfully registered. Check your inbox to confirm your registration.";
			}
			else
			{
				echo "There was a problem with your confirmation email.";
			}

			$mail->smtpClose();
		}
		else
		{
			echo json_encode(
				array(
					"status" => "500",
					"message" => "There was a problem with your registration. Please try again.")
			);
		}
}
