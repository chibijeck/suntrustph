<?php
	$toUpdateId = $_GET['id'];
	$ticket = new ticket();	
	$ticket->selectOne($toUpdateId);		
			
	if(isset($_POST['updateUser'])){		
		try { 					
		 
			//inesrt sa DB ng ticket
			$ticket->setproperties_id($_POST["properties_id"]);  
			$ticket->setcustomer($_POST["customer"]);  
			$ticket->setagent($_POST["agent"]);  				
			$ticket->setstatus($_POST["status"]); 
			$ticket->setcreated_at(date('Y-m-d H:i:s'));		
			
			$ticket->update($toUpdateId);	
			
			//***convert username to id, sa payment kc id gamit sa ticket username
			$userId = new user();
			$userId->selectOneField("username",$_POST["customer"]);
			//echo $userId->getid();
			//****Get property price				
			$properties = new properties();	
			$properties->selectOne($_POST["properties_id"]);
			//$properties->getprice();
			
			//get pbfr
			$pbfr = new pbfr();	
			$pbfr->selectOne($_POST['pbfr_id']);
			
			//create an input to payment if status if approved
			if( $_POST["status"] == 2){
				$payment = new payment();				
				$payment->setproperties_id($_POST["properties_id"]);  		
				$payment->setuser_id($userId->getid());  		
				$payment->setprice($properties->getprice());  		
				// $payment->setbuilding($_POST["building"]);  		
				// $payment->setfloor($_POST["floor"]);  		
				// $payment->setroom_number($_POST["room_number"]);  		
				$payment->settype_of_payment(1);  		
				$payment->setcreated_at(date('Y-m-d H:i:s'));		
				$payment->setticket_id($toUpdateId);		
						
				$payment->insert();	
				?>
				<div class="alert alert-success alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				  <strong>Successfully added Payment Data</strong>
				</div>
				
				<div class="alert alert-success alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				  <strong>Successfully updated PBFR status to Reserved</strong>
				</div>	
				
				<?php
				
				//change status pbfr					
				$pbfr->setstatus(1);//reserved for 1
				$pbfr->updateStatus($_POST['pbfr_id']);			
				
			}
			
			
			//get customer name and send data to it
			//send an Email to Customer
			
	
			$mailCustomer = new PHPMailer;
			$mailCustomer->From = fromSystemEmail;
			$mailCustomer->FromName = 'Suntrust';	
				
			
			$mailCustomer->addAddress($userId->getemail());  //send to customer
			$mailCustomer->isHTML(true);// Set email format to HTML							
			$mailCustomer->Subject = 'Reservation Request';
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
												<strong> Status : '. ticketDisplay($_POST["status"]) .' </strong>
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
									</table>'										
							;		

				if($_POST["status"] == 1 ){
					$mailCustomer->Body .= '
					<table>
					<tr>
						<td>
							&nbsp;
						</td>
					</tr>
					<tr>
						<td>
							<strong>Possible Reason for Rejection:</strong></br>
						</td>
					</tr>
					<tr>
						<td>
					1.	Incomplete documents submitted (Identification documents)
						</td>
					</tr>
					<tr>
						<td>
							2.	False information
						</td>
					</tr>
					<tr>
						<td>
							3.	Failure to pay the reservation fee
						</td>
					</tr>
					
					
							
					</table>
					';
				
				}
				
							
				$mailCustomer->send();	
			?>	

			
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  <strong>An Email Notification was send to <?php echo $userId->getemail() ?></strong>
			</div>
			
			
			
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  <strong>Successfully updated</strong>
			</div>
			<?php
			} catch (Exception $e) {
				echo $e->getMessage(); 		
		}				
	}		
 ?>
        
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<h2>EDIT TICKET #<?php echo $ticket->getid(); ?> </h2>

			<form role="form" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" data-toggle="validator">		
			  
				<div class="form-group">
					<label for="exampleInputEmail1">Properties Id *</label>				
					<select  class="form-control" name="properties_id" >																							
								
						<?php 
							//show status available condo only
							$properties = new properties();						
							$properties = $properties->selectAll('');	
							foreach($properties as $row){	
						?>
							<option
								<?php if($ticket->getproperties_id() == $row->getid() ){echo "selected";} ; ?>							
								value="<?php echo $row->getid(); ?>">Properties_ID# <?php echo $row->getid(); ?> - <?php echo $row->gettitle(); ?>
							</option>		
						<?php } ?>
					</select>	
				</div>	
				
				<!--div class="form-group">
					<label for="exampleInputEmail1">Customer Name *</label>					
					<select  class="form-control" name="customer" >																		
								
						<?php 
							//show role_id 1 for client only
							$user = new user();						
							$user = $user->selectAll('WHERE role_id = 1');	//show only client
							foreach($user as $row){	
						?>
							<option 
							<?php if($ticket->getcustomer() == $row->getusername() ){echo "selected";} ; ?>					
							value="<?php echo $row->getusername(); ?>"><?php echo $row->getusername(); ?></option>		
						<?php } ?>
					</select>
				</div-->	
				
				<div class="form-group">
					<label for="floor">Customer Name </label>
					<input type="hidden" class="form-control"  name="customer"  value="<?php echo $ticket->getcustomer(); ?>" data-error="Required" >
					<input type="text" class="form-control"  name=""  value="<?php echo $ticket->getcustomer(); ?>" disabled>
					
					<div class="help-block with-errors"></div>
				</div>	
				
				<div class="form-group">
					<label for="exampleInputEmail1">Agent Name *</label>
					<select  class="form-control" name="agent" >									
								
						<?php 
							//show role_id 5 for client sales
							$user = new user();						
							$user = $user->selectAll('WHERE role_id = 5');	//show only sales
							foreach($user as $row){	
						?>
							<option
							<?php if($ticket->getagent() == $row->getusername() ){echo "selected";} ; ?>							
							 value="<?php echo $row->getusername(); ?>"><?php echo $row->getusername(); ?></option>		
						<?php } ?>
					</select>
				</div>	
			
				<div class="form-group">
					<label for="exampleInputEmail1">Status</label>							
					<select  class="form-control" name="status" >																										
						<option value="0" <?php if($ticket->getstatus() == 0){ echo "selected=selected"; } ?>>Pending</option>							
						<option value="1" <?php if($ticket->getstatus() == 1){ echo "selected=selected"; } ?>>Reject</option>							
						<option value="2" <?php if($ticket->getstatus() == 2){ echo "selected=selected"; } ?>>Approved</option>					
					</select>								
				</div> 				
				<input type="hidden" value=<?php echo $ticket->getpbfr_id(); ?> name="pbfr_id" >
				<button type="submit" class="btn btn-default" name="updateUser" >Update</button>
			</form>			
	</div>		 
</div>

