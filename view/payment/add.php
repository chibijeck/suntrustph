<?php
	$payment = new payment();	
	if(isset($_POST['submitpayment'])){		
		try { 					
		
			//inesrt sa DB
			$payment->setproperties_id($_POST["properties_id"]);  		
			$payment->setuser_id($_POST["user_id"]);  		
			$payment->setprice($_POST["price"]);  		
			$payment->setbuilding($_POST["building"]);  		
			$payment->setfloor($_POST["floor"]);  		
			$payment->setroom_number($_POST["room_number"]);  		
			$payment->settype_of_payment($_POST["type_of_payment"]);  		
			$payment->setcreated_at(date('Y-m-d H:i:s'));		
		 			
			$payment->insert();	
			?>		
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  <strong>Successfully Added</strong>
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
		<h2>ADD NEW Payment</h2>

			<form role="form" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" data-toggle="validator">		
			  
		
				<div class="form-group">
					<label for="type_of_payment">properties id *
					</label>
					<select  class="form-control" name="properties_id" >																							
								
						<?php 
							//show status available condo only
							$properties = new properties();						
							$properties = $properties->selectAll('WHERE status = "Available"');	
							foreach($properties as $row){	
						?>
							<option value="<?php echo $row->getid(); ?>">Properties_ID# <?php echo $row->getid(); ?> - <?php echo $row->gettitle(); ?></option>		
						<?php } ?>
					</select>								
				</div> 					
				
				<div class="form-group">
					<label for="type_of_payment">User id *
					</label>
					<select  class="form-control" name="user_id" >																							
								
						<?php 
							//show role_id 1 for client only
							$user = new user();						
							$user = $user->selectAll('WHERE role_id = 1');	//show only client
							foreach($user as $row){	
						?>
							<option value="<?php echo $row->getid(); ?>">User_ID# <?php echo $row->getid(); ?> - <?php echo $row->getusername(); ?></option>		
						<?php } ?>
					</select>								
				</div> 		
				
				<div class="form-group">
					<label for="exampleInputEmail1">Price *</label>
					<input type="text" class="form-control"  name="price" placeholder=""  data-error="Required" required>
					<div class="help-block with-errors"></div>
				</div>	
				
				<div class="form-group">
					<label for="exampleInputEmail1">building *</label>
					<input type="text" class="form-control"  name="building" placeholder=""  data-error="Required" required>
					<div class="help-block with-errors"></div>
				</div>	
				
				<div class="form-group">
					<label for="exampleInputEmail1">floor *</label>
					<input type="text" class="form-control"  name="floor" placeholder=""  data-error="Required" required>
					<div class="help-block with-errors"></div>
				</div>					
				
				<div class="form-group">
					<label for="exampleInputEmail1">room_number *</label>
					<input type="text" class="form-control"  name="room_number" placeholder=""  data-error="Required" required>
					<div class="help-block with-errors"></div>
				</div>						
				
				
				<div class="form-group">
					<label for="type_of_payment">Type of Payment <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">More Info</button>							
					</label>
					<select  class="form-control" name="type_of_payment" >																										
						<option value="1">Option 1 (25/75) </option>							
						<option value="2">Option 2 (STEP-UP 25% DP)</option>							
						<option value="3">Option 3 (BALLOON)</option>					
						<option value="4">Option 4 (STEP-UP BALLOON 25% DP)</option>					
					</select>								
				</div> 				
						
				
				<button type="submit" class="btn btn-default" name="submitpayment" >Submit</button>
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