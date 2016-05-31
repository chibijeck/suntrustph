<?php
	
		$payment = new payment();		
					
		//****************** DELETE POST
		//******************************
		if(isset($_POST['deleteSubmit'])){				
			$payment->selectOne($_POST['deleteThisId']);							
			$payment->delete($_POST['deleteThisId']);			
			?>		
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  <strong>Successfully Deleted </strong>
			</div>
			<?php
		}
?>

<div class="table-responsive">
<h2>DELETE Payment</h2>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>             </th>
				<th>Id </th>
				<th>Ticket Id </th>
				<th  width="150">Property Id   </th>
				<th width="150">User Id       </th>
				<th width="150">Price          </th>
				
				<th width="200">Type of Payment  </th>
				<th>Created At  </th>																					
			</tr>																					
			</tr>
		</thead>
		<tbody>
			<?php								
										
				$payment = $payment->selectAll('ORDER BY created_at DESC');	
				foreach($payment as $row){	
				?>
			<tr>
				
				<td>
					<!-- Delete Start Here -->
					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $row->getid(); ?>">Delete</button>											
					<div class="modal fade" id="deleteModal<?php echo $row->getid(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <form method="post" id="delete" action="<?php echo $_SERVER['REQUEST_URI'] ?>" >
						  <div class="modal-dialog">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title" id="myModalLabel">Are you sure?</h4>
							  </div>
							 
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									
								
								<input type="hidden" name="deleteThisId" value="<?php echo $row->getid(); ?>">
								<button type="submit" name="deleteSubmit" class="btn btn-primary">Delete</button>																
							  </div>
							</div>
						  </div>
					  </form>
					</div>
				</td>		
				
						
				<td><?php echo $row->getid(); ?></td>		
				<td><?php echo $row->getticket_id(); ?></td>		
				<td>
					<?php 	
						$properties = new properties();	
						$properties->selectOne($row->getproperties_id());							
						echo $row->getproperties_id() ." - ". $properties->gettitle();				
					?>
				</td>							
				<td>
					<?php 
						$user = new user();
						$user->selectOne($row->getuser_id());
						echo $row->getuser_id() ." - ". $user->getusername();	 					
					?>					
				</td>							
				<td><?php echo pesoFormat($row->getprice()); ?></td>
				
				<td>
					<?php echo typeofpaymentDisplay($row->gettype_of_payment()); ?>				
				</td>							
				<td><?php echo $row->getcreated_at(); ?></td>								
			</tr>
			<tr>
				<td></td>										
				<td></td>										
				<td colspan="6">
				<table class="table table-bordered table-hover">					
					<thead>
						<tr>							
							<th>Room Id</th>
							<th>building</th>
							<th>floor</th>
							<th>room</th>
							<th>status</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							//Bridge Ticketid - PropertyId
							$ticket = new ticket();									
							$ticket->selectOne($row->getticket_id());	//get pbfr_id from ticket		
							
							$pbfr = new pbfr();									
							$pbfr = $pbfr->selectAll('WHERE id =' . $ticket->getpbfr_id());	
							foreach($pbfr as $row){	
						?>
							<tr>
								<td><?php echo $row->getid();?></td>								
								<td><?php echo $row->getbuilding();?></td>
								<td><?php echo $row->getfloor();?></td>
								<td><?php echo $row->getroom();?></td>
								<td>
									<span class="
										<?php
										if($row->getstatus() == 0){
											echo "openStatus";										
										}else{
											echo "soldStatus";						
										}						
										?>						
										">
										 <?php echo pbfrStatus($row->getstatus());?>
									 <span>				
								
								</td>
								
							</tr>			
						<?php } ?>
					</tbody>			
				</table>
				</td>						
			</tr>			
			<?php
				}
				?>																					
																								
		
		</tbody>
	</table>
</div>