<?php 
//check 1st if it is a ajax request 
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	require($folder_path . 'settings.php');	
	$form = new scontact();   	
	$name =  $form->cleanInput($_REQUEST['Name'], 30);
	$email =  $form->cleanInput($_REQUEST['Email'], 30);
	$message = $form->cleanInput($_REQUEST['Message'], 200);

	//--------------------------------------required Name
	if(empty($name)){
		$error_msg = "Name is required";
		$msg = '<div class="error_form">'. $error_msg .'</div>';
		$field_highlight = 'input[name="name"]';	
	}
	//--------------------------------------required email and correct format
	elseif(empty($email)){
		$error_msg = "Email is required";
		$msg = '<div class="error_form">'. $error_msg .'</div>';  
		$field_highlight = 'input[name="email"]';		
	}
	elseif (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
		$error_msg = "Invalid Email Format";
		$msg = '<div class="error_form">'. $error_msg .'</div>';
		$field_highlight = 'input[name="email"]';		
	}
	
	//--------------------------------------required Message

	elseif(empty($message)){
		$error_msg = "Message is required";
		$msg = '<div class="error_form">'. $error_msg .'</div>';  
		$field_highlight = 'textarea[name="message"]';			
	}

	//--------------------------------------Send Message
	else{	
	$html = 	'<table>						
						<tr>
							<td colspan="2"><h1> Aljon ngo</h1></td>
						</tr>
						
						<tr>
							<td valign="top"align="right"><strong>Name :</strong></td>
							<td> '.$name.'</td>
						</tr>
						
						<tr>
							<td valign="top"align="right"><strong>Email :</strong></td>
							<td> '.$email.'</td>
						</tr>
					
						<tr>
							<td valign="top"align="right"><strong>Message :</strong></td>
							<td> '. $message .'</td>
						</tr>
						</table>';
						
		$form->sendEmail($send_to,$subject,$html,$email,$Bcc);
						
		$error_msg = "Message Sent!";
		$msg = '<div class="correct_form">'. $error_msg .'</div>'; 
		$status	= "sent";				
	}	
	//output an json back to our contact form
	echo json_encode(array("form_message"=>$msg,"field"=>$field_highlight,"status"=>$status));
}else{
  //bring back the user to index if the tried to hard code the link of this email_process.php
  header('Location: /');
}

class scontact{
		public function cleanInput($field,$limit) {	
			$field = htmlentities(substr($field, 0, $limit), ENT_QUOTES);
			// Limit lines first, trim it if it exceed our limit
			//ENT_QUOTES means make all qoute to single qoute		

			$field = trim($field);
			// " " (ASCII 32 (0x20)), an ordinary space.
			// "\t" (ASCII 9 (0x09)), a tab.
			// "\n" (ASCII 10 (0x0A)), a new line (line feed).
			// "\r" (ASCII 13 (0x0D)), a carriage return.
			// "\0" (ASCII 0 (0x00)), the NUL-byte.
			// "\x0B" (ASCII 11 (0x0B)), a vertical ta

			$field = stripslashes($field);
			//Returns a string with backslashes stripped off. 
			//(\' becomes ' and so on.) Double backslashes (\\) are made into a single backslash (\). 

			$field = htmlspecialchars($field);
			// translations special char:
			// '&' (ampersand) becomes '&amp;'
			// '"' (double quote) becomes '&quot;' when ENT_NOQUOTES is not set.
			// "'" (single quote) becomes '&#039;' (or &apos;) only when ENT_QUOTES is set.
			// '<' (less than) becomes '&lt;'
			// '>' (greater than) becomes '&gt;'


			$field=filter_var($field, FILTER_SANITIZE_STRING);
			return $field;
		}	

		public function sendEmail($send_to,$subject,$html,$email,$bcc) {
			$headers  .= "From: " . $email . "\r\n";
			$headers .= "Reply-To: ". $email . "\r\n";
			
			if(!empty($bcc)){
			 $headers .= "BCC: ". $bcc ."\r\n";
			}
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";				
			mail($send_to,$subject,$html,$headers);					
		}
}
?>