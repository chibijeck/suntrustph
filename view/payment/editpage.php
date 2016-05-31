<?php
	$toUpdateId = $_GET['id'];
	$payment = new payment();	
	$payment->selectOne($toUpdateId);		
			
	if(isset($_POST['updateUser'])){		
		try { 					
		
			//inesrt sa DB
			$payment->setproperties_id($_POST["properties_id"]);  		
			$payment->setuser_id($_POST["user_id"]);  		
			$payment->setprice($_POST["price"]);  		
			// $payment->setbuilding($_POST["building"]);  		
			// $payment->setfloor($_POST["floor"]);  		
			// $payment->setroom_number($_POST["room_number"]);  		
			$payment->settype_of_payment($_POST["type_of_payment"]);  			
			$payment->update($toUpdateId);	
			
			paymentStatusEmail($toUpdateId);	
			 
			
			
			?>	
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  <strong>An email notification was send to the customer</strong>
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
		<h2>EDIT PAYMENT #<?php echo $payment->getid(); ?> </h2>

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
								<?php if($payment->getproperties_id() == $row->getid() ){echo "selected";} ; ?>							
								value="<?php echo $row->getid(); ?>">Properties_ID# <?php echo $row->getid(); ?> - <?php echo $row->gettitle(); ?>
							</option>		
						<?php } ?>
					</select>	
				</div>	
				
				
							
				<div class="form-group">
					<label for="exampleInputEmail1">Customer Name *</label>					
					<select  class="form-control" name="user_id" >																		
								
						<?php 
							//show role_id 1 for client only
							$user = new user();						
							$user = $user->selectAll('WHERE role_id = 1');	//show only client
							foreach($user as $row){	
						?>
							<option 
							<?php if($payment->getuser_id() == $row->getid() ){echo "selected";} ; ?>					
							value="<?php echo $row->getid(); ?>"><?php echo $row->getusername(); ?></option>		
						<?php } ?>
					</select>
				</div>	
				
				<div class="form-group">
					<label for="exampleInputEmail1">Price *</label>
					<input type="text" class="form-control" value="<?php echo $payment->getprice(); ?>"  name="price" placeholder=""  data-error="Required" required>
					<div class="help-block with-errors"></div>
				</div>	
				
				<!--div class="form-group">
					<label for="exampleInputEmail1">building *</label>
					<input type="text" class="form-control" value="<?php echo $payment->getbuilding(); ?>"  name="building" placeholder=""  data-error="Required" required>
					<div class="help-block with-errors"></div>
				</div>	
				
				<div class="form-group">
					<label for="exampleInputEmail1">floor *</label>
					<input type="text" class="form-control"  value="<?php echo $payment->getfloor(); ?>" name="floor" placeholder=""  data-error="Required" required>
					<div class="help-block with-errors"></div>
				</div>					
				
				<div class="form-group">
					<label for="exampleInputEmail1">room_number *</label>
					<input type="text" class="form-control"  value="<?php echo $payment->getroom_number(); ?>" name="room_number" placeholder=""  data-error="Required" required>
					<div class="help-block with-errors"></div>
				</div-->		
				
				
				<div class="form-group">
					<label for="exampleInputEmail1">Type of Payment  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">More Info</button></label>							
					<select  class="form-control" name="type_of_payment" >																										
						<option value="1" <?php if($payment->gettype_of_payment() == 1){ echo "selected=selected"; } ?>>Option 1 (25/75)</option>							
						<option value="2" <?php if($payment->gettype_of_payment() == 2){ echo "selected=selected"; } ?>>Option 2 (STEP-UP 25% DP)</option>							
						<option value="3" <?php if($payment->gettype_of_payment() == 3){ echo "selected=selected"; } ?>>Option 3 (BALLOON)</option>					
						<option value="4" <?php if($payment->gettype_of_payment() == 4){ echo "selected=selected"; } ?>>Option 4 (STEP-UP BALLOON 25% DP)</option>					
					</select>								
				</div> 					
								
				<button type="submit" class="btn btn-default" name="updateUser" >Update</button>
			</form>			
	</div>		 
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Payment Schemes</h4>
	  </div>
	  <div class="modal-body">
		<table class="table table-bordered">
		  <tr>
			<td>Option 1 (25/75) </td>							
			<td>
				25% D.P. IN 48 MONTHS</br>
				75% AMORTIZATION
			</td>
		  </tr>
		  <tr>
			<td>Option 2 (STEP-UP 25% DP)</td>							
			<td>
				4%(1ST – 12TH MONTH)</br>
				5%(13TH – 24TH MONTH)</br>
				7%(25TH – 36TH MONTH)</br>
				9%(37TH – 48TH MONTH)</br>
				75% AMORTIZATION
			</td>
		  </tr>
		  <tr>
			<td>Option 3 (BALLOON)</td>							
			<td>
				MONTHLY DP:</br>
				1ST – 11TH MONTH</br>
				13TH – 23TH MONTH</br>
				25TH – 35TH MONTH</br>
				37TH – 48TH MONTH</br>
				5% BALLOON PAYMENTS – 12TH, 24TH, 36TH,,48th MONTHS</br>
				75% AMORTIZATION				
			</td>
		  </tr>
		  <tr>
			<td>Option 4 </br>(STEP-UP BALLOON 25% DP)</td>							
			<td>
				MONTHLY DP:</br>
				3%(1ST – 11TH MONTH)</br>
				4%(13TH – 23TH MONTH)</br>
				5%(25TH – 35TH MONTH)</br>
				7%(37TH – 47TH MONTH)</br>
				6% BALLOON PAYMENTS – 12TH, 24TH, 36TH , 48TH MONTHS</br>
				75% AMORTIZATION				
			</td>
		  </tr>
		</table>						
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>	
	  </div>
	</div>
  </div>
</div>
