<?php 
	include("includes/header.php");

	$mail = new PHPMailer;


	// $mail->From = "info@suntrustph.com";	
	// // $mail->SetFrom('info@suntrustph.com', 'Suntrust');

	// $mail->FromName = 'info@suntrustph.com';	
	// $mail->addAddress('aljonngo@gmail.com');  //send to user

	
	$mail->From = 'from@example.com';
	$mail->FromName = 'Suntrust';	
	$mail->addAddress('aljonngo@gmail.com');           
	
	

	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'Here is the subject';
	$mail->Body    = 'This is the HTML message body <b>in bold!</b>';

	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo 'Message has been sent';
	}
	
	
	
	include("includes/footer.php");
?>