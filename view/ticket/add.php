<?php
	$ticket = new ticket();	
	if(isset($_POST['submitTicket'])){		
		try { 					
		
			//inesrt sa DB
			$ticket->setproperties_id($_POST["properties_id"]);  
			$ticket->setcustomer($_POST["customer"]);  
			$ticket->setagent($_POST["agent"]);  
			$ticket->setcreated_at(date('Y-m-d H:i:s'));		
			$ticket->setstatus($_POST["status"]); 			
			$ticket->insert();	
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
		<h2>ADD NEW TICKET</h2>

			<form role="form" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" data-toggle="validator">		
			  						
				<div class="form-group">
					<label for="type_of_payment">properties id *
					</label>
					<select  class="form-control" name="properties_id" >																							
								
						<?php 
							//show status available condo only
							$properties = new properties();						
							$properties = $properties->selectAll('');	
							foreach($properties as $row){	
						?>
							<option value="<?php echo $row->getid(); ?>">Properties_ID# <?php echo $row->getid(); ?> - <?php echo $row->gettitle(); ?></option>		
						<?php } ?>
					</select>								
				</div> 					
				
				
				<div class="form-group">
					<label for="exampleInputEmail1">Customer Name *</label>
					<select  class="form-control" name="customer" >																							
								
						<?php 
							//show role_id 1 for client only
							$user = new user();						
							$user = $user->selectAll('WHERE role_id = 1');	//show only client
							foreach($user as $row){	
						?>
							<option value="<?php echo $row->getusername(); ?>"><?php echo $row->getusername(); ?></option>		
						<?php } ?>
					</select>
				</div>	
				
				<div class="form-group">
					<label for="exampleInputEmail1">Agent Name *</label>
					<select  class="form-control" name="agent" >									
								
						<?php 
							//show role_id 1 for client only
							$user = new user();						
							$user = $user->selectAll('WHERE role_id = 5');	//show only client
							foreach($user as $row){	
						?>
							<option value="<?php echo $row->getusername(); ?>"><?php echo $row->getusername(); ?></option>		
						<?php } ?>
					</select>
				</div>	
			
				<div class="form-group">
					<label for="exampleInputEmail1">Status</label>							
					<select  class="form-control" name="status" >																										
						<option value="0">Pending</option>							
						<option value="1">Reject</option>							
						<option value="2">Approved</option>					
					</select>								
				</div> 		
					
				
			
				
				
				<button type="submit" class="btn btn-default" name="submitTicket" >Submit</button>
			</form>			
	</div>		 
</div>