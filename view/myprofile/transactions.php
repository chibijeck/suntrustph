<h3>
Transactions
</h3>
Filter By: []
<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				
				<!--<th>Edit Payment Details</th>			-->
				<th>Property Id   </th>			
				<th>Property Title   </th>			
				<th width="130">Price          </th>
				<th>Building      </th>
				<th>Floor          </th>
				<th>Room Number      </th>
				<th>Type of Payment  </th>
				<th>Last Update  </th>																	
			</tr>
		</thead>
		<tbody>
			<?php 
				$currentUserid = $_SESSION['user_id'];
				$currentUsername = $_SESSION['username'];
				
				$payment = new payment();									
				$payment = $payment->selectAll('WHERE user_id = "'.$currentUserid.'" ORDER BY id DESC');	
				if(!empty($payment)){
						foreach($payment as $row){	
						?>
						<tr>
						<!--<td>-->
							<!-- Edit Start Here -->
						<!--	<a type="button" class="btn btn-success" href="myprofile.php?action=editpagepayment&id=<?php echo $row->getid(); ?>">Edit</button>-->
							<!-- Edit End Here -->
						<!--</td>-->
						
						<td>
							<?php echo $row->getproperties_id();?>								
						</td>
						
						<td>
							<?php 	
								$properties = new properties();	
								$properties->selectOne($row->getproperties_id());							
								echo $properties->gettitle();				
							?>
						</td>							
													
						<td><?php echo pesoFormat($row->getprice()); ?></td>

						<?php 
							//Bridge Ticketid - PropertyId
							$ticket = new ticket();									
							$ticket->selectOne($row->getticket_id());	//get pbfr_id from ticket		
							
							$pbfr = new pbfr();									
							$pbfr->selectOne($ticket->getpbfr_id());									
						?>		
						
						<td><?php echo $pbfr->getbuilding(); ?></td>							
						<td><?php echo $pbfr->getfloor(); ?></td>							
						<td><?php echo $pbfr->getroom(); ?></td>	


						
						<td>
							<?php echo typeofpaymentDisplay($row->gettype_of_payment()); ?>				
						</td>							
						<td>
							<?php echo $row->getcreated_at(); ?>				
						</td>							
					</tr>			
					<?php
						}
			}else{ ?>
					<div class="alert alert-danger alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					  <strong>There is no payment associated to your account. </strong>
					</div>
				<?php				
				}
				?>			
		</tbody>
	</table>
</div>