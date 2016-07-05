<?php
	function adminSideMenu(){
	?>
		<div class="panel panel-default">		
				<div class="panel-body">
					<ul class="nav nav-pills nav-stacked">
						 <li><a href="manageUser.php">User</a></li>
						 <li><a href="manageProperties.php">Properties</a></li>
						 <li><a href="manageTicket.php">Ticket</a></li>
						 <li><a href="managePayment.php">Payment</a></li>
						 <li><a href="manageReport.php">Reports</a></li>
					</ul>
				</div>
		</div>
	<?php
	}
	
	function redirectTo($var){
		header("Location: " . $var);
	}
	
	function adminOnly($var){
		if($var == 6){
			return true;
		}else{
			return false;
		}
	}
	
	function pesoFormat($val){
		if(empty($val)){
			$val = 0;
		}	
		return "&#8369; " . number_format($val, 2, '.', ',');
	}
	
	function ticketDisplay($val){

		if($val == 0){
			return "Pending";
		}

		if($val == 1){
			return "Rejected";
		}	

		if($val == 2){
			return "Approved";
		}		
			
		if($val == 3){
			return "Lapsed";
		}	
		
		
	}
	
	function commissionStatus($val){

		if($val == 0){
			return "Pending";
		}

		if($val == 1){
			return "Hold";
		}	

		if($val == 2){
			return "Receiving";
		}		
		if($val == 3){
			return "Hold";
		}
	}
	function commissionColorBtn($val){
		if($val == 0){
			return 'warning';
		}

		if($val == 1){
			return 'danger';
		}	

		if($val == 2){
			return 'success';
		}
		if($val == 3){
			return 'danger';
		}
	}

	function typeofpaymentDisplay($val){
		if($val == 1){
			return "Option 1 (25/75)";
		}

		if($val == 2){
					return "Option 2 (STEP-UP 25% DP)";
		}	

		if($val == 3){
					return "Option 3 (BALLOON)";
		}	
		
		if($val == 4){
					return "Option 4 (STEP-UP BALLOON 25% DP)";
		}
		if($val == 5){
					return "Option 5 (CUSTOM PAYMENT)";
		}		
	
	}
	
	function colorForRowTicket($val){
		if($val == 0){
			return 'class="warning"';
		}

		if($val == 1){
			return 'class="danger"';
		}	

		if($val == 2){
			return 'class="success"';
		}		
	
	}
	
	function pbfrStatus($val){
		if($val == 0){
			return 'Available';
		}

		if($val == 1){
			return 'Reserved';
		}		
	
	}
	
	//e2 for admin panel when changed the payment method
	function paymentStatusEmail($paymentId){
			$payment = new payment();	
			$payment->selectOne($paymentId);	
			
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
			$mailCustomer->Subject = 'Payment Information Notification';
			$mailCustomer->Body    = '
									<table>
										<tr>
											<td>
												<img src="http://suntrustph.com/images/logo.png" class="suntrust"> </br>
											</td>
										</tr>
										<tr>
											<td>
													Your payment option for '. $properties->gettitle() .' has been changed.
											</td>
										</tr>
										<tr>
																						
											'. billCalcu($payment->getprice(),$payment->gettype_of_payment()) .'
										</tr>
										<tr>											
											<td>
												&nbsp;
											</td>
										</tr>
										
									</table>			
								
									
									<table>										
										<tr>											
											<td>
												Details
											</td>
										</tr>
										<tr>
											<td>
												Tracking Id :
											</td>
											<td>
												' . $payment->getticket_id() .'
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

									</br></br>
									<table>
										<tr>
											<td>
												<img src="http://suntrustph.com/images/iconbox.jpg" class="suntrust">
											</td>
											<td>
												&nbsp;Copyright 2015. Suntrust Properties, Inc. All Rights Reserved.
											</td>
										</tr>	
									</table>'									
							;						
				$mailCustomer->send();
	
	}

	function upcomingbillEmail($paymentId, $id = NULL){
			$payment = new payment();
			if(empty($id)){
				$payment->selectOne($paymentId);	
			}else{
				$payment->selectOneField('user_id', trim($paymentId));	
			}
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
				$mailCustomer->Subject = 'Upcoming Bill Notification';
				$mailCustomer->Body    = '
										
										<table>
											<tr>
												<td>
													<img src="http://suntrustph.com/images/logo.png" class="suntrust"> </br>
												</td>
											</tr>
											<tr>
												<td>
													Good day! We would like to remind you about the upcoming due date for your payment.												
												</td>
											</tr>
											
											<tr>																						
												'. billCalcu($payment->getprice(),$payment->gettype_of_payment()) .'
											</tr>										
										
											<tr>
												<td>
													&nbsp;
												</td>
											</tr>
										</table>									
										
									
										<table>
											<tr>
												<td>
													Details
												</td>
											</tr>
											<tr>
												<td>
													Tracking Id :
												</td>
												<td>
													' . $payment->getticket_id() .'
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
											<tr>									
												<td>
													&nbsp;
												</td>
											</tr>	
											<tr>									
												<td>
													Please disregard this email if you have already paid your due balance.
												</td>
											</tr>	
											<tr>									
												<td>
													&nbsp;
												</td>
											</tr>	
										</table>
										
										<table>
											<tr>
												<td>
													<img src="http://suntrustph.com/images/iconbox.jpg" class="suntrust">
												</td>
												<td>
													&nbsp;Copyright 2015. Suntrust Properties, Inc. All Rights Reserved.
												</td>
											</tr>	
										</table>'									
								;						
					$mailCustomer->send();
					return true;
			}else{
				echo "<div class='alert alert-danger alert-dismissible' role='alert'>
						  <button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
						  <strong>No properties linked to this account</strong>
						</div>";
					return false;
			}
			
			
	
	}
	
	function billCalcu($amount,$option){
	if($option == 1){
		$msg = '
		<table class="table">
			<tr>
				<td><strong>Option 1 (25/75)</strong></td>	
				<td> &nbsp;&nbsp; Total Price : '. pesoFormat($amount) .'</td>	
			</tr>			
			
			<tr>		
				<td>	
					'. pesoFormat($amount*.25) .'
				</td>		
				<td>	
					25% D.P. IN 48 MONTHS			
				</td>
			</tr>
			<tr>	
				<td>	
					'. pesoFormat($amount*.75) .'			
				</td>		
				<td>			
					75% AMORTIZATION
				</td>
			</tr>
			</table>
			';
	}elseif($option == 2){			
	$msg = '
	<table class="table"> 
			<tr>
				<td><strong>Option 2 (STEP-UP 25% DP)</td>	
				<td> &nbsp;&nbsp; Total Price : '. pesoFormat($amount) .'</td>	
			</tr>
			<tr>		
				<td>'. pesoFormat($amount*.04) .'				
				</td>		
				<td>4%(1ST - 12TH MONTH)</br>				
				</td>
			</tr>
			<tr>		
				<td>'. pesoFormat($amount*.05) .'				
				</td>		
				<td>5%(13TH - 24TH MONTH)</br>				
				</td>
			</tr>
			<tr>		
				<td>'. pesoFormat($amount*.07) .'				
				</td>		
				<td>7%(25TH - 36TH MONTH)</br>				
				</td>
			</tr>
			<tr>		
				<td>'. pesoFormat($amount*.09) .'				
				</td>		
				<td>9%(37TH - 48TH MONTH)</br>				
				</td>
			</tr>
			<tr>		
				<td>'. pesoFormat($amount*.75) .'				
				</td>		
				<td>75% AMORTIZATION			
				</td>
			</tr>
		</table>
			';
	}elseif($option == 3){
	$msg = '
	<table class="table">			 
			<tr>
				<td><strong>Option 3 (BALLOON)</strong></td>
				<td> &nbsp;&nbsp; Total Price : '. pesoFormat($amount) .'</td>					
			</tr>
			
			<tr>	
				<td>				
				</td>		
				<td>MONTHLY DP:				
				</td>			
			</tr>
			<tr>		
				<td>				
				</td>		
				<td>1ST - 11TH MONTH				
				</td>
			</tr>
			<tr>		
				<td>				
				</td>		
				<td>13TH - 23TH MONTH				
				</td>
			</tr>
			<tr>		
				<td>				
				</td>		
				<td>25TH - 35TH MONTH				
				</td>
			</tr>
			<tr>		
				<td>				
				</td>		
				<td>37TH - 48TH MONTH				
				</td>
			</tr>
			<tr>		
				<td>'. pesoFormat($amount*.05) .'				
				</td>		
				<td>5% BALLOON PAYMENTS - 12TH, 24TH, 36TH,,48th MONTHS				
				</td>
			</tr>
			<tr>		
				<td>'. pesoFormat($amount*.75) .'				
				</td>		
				<td>75% AMORTIZATION				
				</td>
			</tr>
		</table>
		';
	}else{
	$msg = '
	<table class="table">		  
			  
		   <tr>
				<td><strong>Option 4 (STEP-UP BALLOON 25% DP)</strong></td>	
				<td> &nbsp;&nbsp; Total Price : '. pesoFormat($amount) .'</td>	
			</tr>
			
			<tr>		
				<td>				
				</td>		
				<td>MONTHLY DP:				
				</td>
			</tr>
			<tr>		
				<td>'. pesoFormat($amount*.03) .'				
				</td>		
				<td>3%(1ST - 11TH MONTH)				
				</td>
			</tr>
			<tr>		
				<td>'. pesoFormat($amount*.04) .'				
				</td>		
				<td>4%(13TH - 23TH MONTH)				
				</td>
			</tr>
			<tr>		
				<td>'. pesoFormat($amount*.05) .'				
				</td>		
				<td>5%(25TH - 35TH MONTH)				
				</td>
			</tr>
			<tr>		
				<td>'. pesoFormat($amount*.07) .'				
				</td>		
				<td>7%(37TH - 47TH MONTH)				
				</td>
			</tr>
			<tr>		
				<td>'. pesoFormat($amount*.06) .'				
				</td>		
				<td>6% BALLOON PAYMENTS - 12TH, 24TH, 36TH , 48TH MONTHS				
				</td>
			</tr>
			<tr>		
				<td>'. pesoFormat($amount*.75) .'				
				</td>		
				<td>75% AMORTIZATION					
				</td>
			</tr>
		
			</table>	
		';
	}
		
		
	return $msg;
	
	}
	
	
	
	function emailLoanPayment($paymentId,$loanCalculation,$html){
			$payment = new payment();	
			$payment->selectOne($paymentId);	
			
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
			$mailCustomer->Subject = 'Payment Information Notification';
			$mailCustomer->Body = $html;
			$mailCustomer->send();
	}