<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>Id </th>
				<th>Ticket Id </th>
				<th  width="150">Property Id   </th>
				<th width="150">User Id       </th>
				<th width="150">Price          </th>
				<!--th>Building      </th>
				<th>Floor          </th>
				<th>Room Number      </th-->
				<th width="200">Type of Payment  </th>
				<th>Created At  </th>			
																								
			</tr>
		</thead>
		<tbody>
			<?php 
				$payment = new payment();									
				//$payment = $payment->selectAll('ORDER BY created_at DESC');	
				$payment = $payment->selectPayment('ORDER BY p.id DESC');
				foreach($payment as $row){	
				?>
			<tr>
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