<?php 
	include("includes/header.php");
	$viewId = $_POST['propertyId'];
	$pbfrId = $_POST['pbfrId'];
	$properties = new properties();	
	$properties->selectOne($viewId);	
		
	$pbfr = new pbfr();	
	$pbfr->selectOne($pbfrId);
?>	

<div class="container mainBody">
	<div class="row">	
					
<?php 
//******************************************************************//
//*********************** RESERVE Function***************************//
//******************************************************************//

if(isset($_POST['submitReserve'])){						
		$ticket = new ticket();	
		//inesrt sa DB
		$dateCur = date('Y-m-d H:i:s');
		$ticket->setproperties_id($viewId);  
		$ticket->setcustomer($_SESSION['username']);  
		// $ticket->setagent($_POST["agent"]);  
		$ticket->setcreated_at($dateCur);		
		$ticket->setstatus(0); 			
		$ticket->setpbfr_id($pbfrId);//pbfr id 			
		$ticket->insert();

		//get previously inserted id
		$ticket->selectOneField("created_at",$dateCur);		

			
		//send an Email to Admin/sales
		$mailAdmin = new PHPMailer;
		$mailAdmin->From = fromSystemEmail;
		$mailAdmin->FromName = 'Suntrust';	
			
		
		if($properties->getunit_type() == "Studio" ){
			$reservationFee =  pesoFormat(10000);
		}elseif($properties->getunit_type() == "1 Bedroom"){
			$reservationFee =  pesoFormat(20000);
		}else{
			$reservationFee =  pesoFormat(30000);
		}
		
		
		$mailAdmin->addAddress(adminEmail);  //send to admin
		$mailAdmin->isHTML(true);// Set email format to HTML							
		$mailAdmin->Subject = 'Reservation Request';
		$mailAdmin->Body    = '<strong>Reservation Request</strong></br>
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
											' . $_SESSION['username'] .'
										</td>
									</tr>
									<tr>
										<td>
											Customer Email :
										</td>
										<td>
											' . $_SESSION['user_email'] .'
										</td>
									</tr>
									<tr>
										<td>
											Property  ID :
										</td>
										<td>
											' . $viewId .'
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
											Reservation  Time :
										</td>
										<td>
											' . $dateCur .'
										</td>
									</tr>	
									
									<tr>
										<td>
											Reservation  Fee :
										</td>
										<td>
											' . $reservationFee .'
										</td>
									</tr>														
									
									
								</table>'								
						;
						
		$mailAdmin->send();	

		//send an Email to Customer
		$mailCustomer = new PHPMailer;
		$mailCustomer->From = fromSystemEmail;
		$mailCustomer->FromName = 'Suntrust';	
		// $mailCustomer->AddAttachment("excel/1BR 4.5M.xls");
		
		$mailCustomer->addAddress($_SESSION['user_email']);  //send to customer
		$mailCustomer->isHTML(true);// Set email format to HTML							
		$mailCustomer->Subject = 'Reservation Request';
		$mailCustomer->Body    = '<strong>Reservation Request</strong></br>
								Your reservation request for '. $properties->gettitle() .' has been submitted</br>
								We will update you through email as soon as we process your reservation request.
								</br></br>
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
											' . $_SESSION['username'] .'
										</td>
									</tr>
									<tr>
										<td>
											Customer Email :
										</td>
										<td>
											' . $_SESSION['user_email'] .'
										</td>
									</tr>
									<tr>
										<td>
											Property  ID :
										</td>
										<td>
											' . $viewId .'
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
											Reservation  Time :
										</td>
										<td>
											' . $dateCur .'
										</td>
									</tr>			
									
									<tr>
										<td>
											Reservation  Fee :
										</td>
										<td>
											' . $reservationFee .'
										</td>
									</tr>	
									
								</table>'								
						;

		$mailCustomer->send();	

	}		
		?>

	<h1>Reservation Request has been sent Successfully</h1>

	<?php echo '</br>
								<table class="table table-striped">
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
											' . $_SESSION['username'] .'
										</td>
									</tr>
									<tr>
										<td>
											Customer Email :
										</td>
										<td>
											' . $_SESSION['user_email'] .'
										</td>
									</tr>
									<tr>
										<td>
											Property  ID :
										</td>
										<td>
											' . $viewId .'
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
											Reservation  Time :
										</td>
										<td>
											' . $dateCur .'
										</td>
									</tr>														
									
									<tr>
										<td>
											Reservation  Fee :
										</td>
										<td>
											' . $reservationFee .'
										</td>
									</tr>
									
								</table>'								
						;
		?>
		<i>A copy of details was sent to your email</i>
		
	</div>			
</div>		




<?php
	include("includes/footer.php");	
?>	