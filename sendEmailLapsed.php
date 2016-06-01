<?php 
date_default_timezone_set('Asia/Manila');
//Define Variables
$basepath = ""; 	
$linkbasepath = $_SERVER['SERVER_NAME']; 	
define("rootpath", $basepath );	
define("linkbasepath", "http://" . $linkbasepath . "/");	
define("adminEmail", "bjpcapstone@gmail.com");	
define("fromSystemEmail", "from@suntrust.com");		

include('class/compile.php');
$forceSend = $_GET['force'];

if(date('Y-m-d H:i:s') == date('Y-m-d 08:00:00') || $forceSend == 1){
	echo "<script>console.log('".date('Y-m-d H:i:s')."');</script>";
	$ticket = new ticket();	
	$stats = $ticket->updateStatus();

	$customer = $ticket->selectLapsed();
	foreach ($customer as $data) {
			sendEmailLapsed($data->customer);
	}
	
	
}

function sendEmailLapsed($customer){
		
	$customerUser = new user();
	$customerUser->selectOneField('username',$customer);
	
	$payment = new payment();
	$payment->selectOneField('user_id', $customerUser->getid());

	$pId = $payment->getid();

	if(!empty($pId)){
		pesoFormat($payment->getprice()); 
	
		//properties
		$properties = new properties();	
		$properties->selectOne($payment->getproperties_id());
		 
		//get ticket
		$ticket = new ticket();				
		$ticket->selectOne($payment->getticket_id());			
		
		//user
		$userId = new user();	
		$userId->selectOne($payment->getuser_id());
		
		//get from ticket
		$pbfr = new pbfr();	
		$pbfr->selectOne($ticket->getpbfr_id());	
		
		$mailCustomer = new PHPMailer;
		$mailCustomer->From = fromSystemEmail;
		$mailCustomer->FromName = 'Suntrust';	
		
		$mailCustomer->addAddress($userId->getemail());  //send to customer
		$mailCustomer->isHTML(true);// Set email format to HTML							
		$mailCustomer->Subject = 'Reservation Request - Lapsed';
		$mailCustomer->Body    = '
								<table>
									<tr>
										<td>
											<img src="http://suntrustph.com/images/logo.png" class="suntrust"> </br>
										</td>
									</tr>
									<tr>
										<td>
											The status of your reservation request for '. $properties->gettitle() .' has been Updated</br>
											
										</td>
									</tr>
									<tr>
										<td>
											<strong> Status : Lapsed </strong>
										</td>
									</tr>
									<tr>
										<td>
											&nbsp;
										</td>
									</tr>
								</table>	
								
								
							
							
								Details
								<table>
									<tr>
										<td>
											Tracking Id :
										</td>
										<td>
											' . $ticket->getid() .'
										</td>
									</tr>
									<tr>  
										<td>
											Customer username :
										</td>
										<td>
											' . $userId->getusername() .'
										</td>
									</tr>
									<tr>
										<td>
											Customer Email :
										</td>
										<td>
											' . $userId->getemail() .'
										</td>
									</tr>
								
									<tr>
										<td>
											Property  Name :
										</td>
										<td>
											' . $properties->gettitle() .'
										</td>
									</tr>
									<tr>
										<td>
											Property Unit Type :
										</td>
										<td>
											' . $properties->getunit_type() .'
										</td>
									</tr>
									<tr>
										<td>
											Property  location :
										</td>
										<td>
											' . $properties->getlocation() .'
										</td>
									</tr>
									<tr>
										<td>
											Property  Price :
										</td>
										<td>
											' . pesoFormat($properties->getprice()) .'
										</td>
									</tr>
									
									<tr>
										<td>
											Building :
										</td>
										<td>
											' . $pbfr->getbuilding() .'
										</td>
									</tr>
									<tr>
										<td>
											Floor :
										</td>
										<td>
											' . $pbfr->getfloor() .'
										</td>
									</tr>
									<tr>
										<td>
											Room :
										</td>
										<td>
											' . $pbfr->getroom() .'
										</td>
									</tr>
									<tr>
										<td>
											Date Updated :
										</td>
										<td>
											' . date('Y-m-d H:i:s') .'
										</td>
									</tr>	
								</table>
								
								
								<table>
									<td>
										&nbsp;
									</td>
									<tr>
										<td>
											<img src="http://suntrustph.com/images/iconbox.jpg" class="suntrust">
										</td>
										<td>
											&nbsp;Copyright 2015. Suntrust Properties, Inc. All Rights Reserved.
										</td>
									</tr>	
								</table>';		

			
				$mailCustomer->Body .= '
				<table>
					<tr>
						<td>
							&nbsp;
						</td>
					</tr>
					<tr>
						<td>
							<strong>Possible Reason for Lapsed:</strong></br>
						</td>
					</tr>
					<tr>
						<td>
							1.	Failure to pay the reservation fee
						</td>
					</tr>
					<tr>
						<td>
							2.	More than 15 days of ticket pending status
						</td>
					</tr>
				</table>
				';
			
			
			$mailCustomer->send();	
			
		}
}