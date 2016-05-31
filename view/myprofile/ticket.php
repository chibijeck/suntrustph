
<h3>
Ticket
</h3>
<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>				
				<th>Tracking Id</th>		
				<th>Property Link</th>		
				<th>Property ID </th>		
				<th>Property Title </th>		
				<th>Assigned Agent </th>
				<th>Created At     </th>
				<th>Status     </th>
																								
			</tr>
		</thead>
		<tbody>
			<?php 
				$currentUserid = $_SESSION['user_id'];
				$currentUsername = $_SESSION['username'];
				
				$ticket = new ticket();									
				$ticket = $ticket->selectAll('WHERE customer = "'.$currentUsername.'" ORDER BY created_at DESC');
				if(!empty($ticket)){
						foreach($ticket as $row){	
						?>
						<tr>	
							<td>#<?php echo $row->getid(); ?></td>	
							<td>	
								<a type="button" target="_blank" class="btn btn-default" href="viewProperty.php?action=viewPageProperties&id=<?php echo $row->getproperties_id(); ?>">View Property</button>
							</td>						
							<td><?php echo $row->getproperties_id(); ?></td>							
							<td><?php 
								$properties = new properties();	
								$properties->selectOne($row->getproperties_id());
								echo $properties->gettitle(); ?>
							</td>							
											
							<td><?php echo $row->getagent(); ?></td>						
							<td><?php echo $row->getcreated_at(); ?></td>						
							<td><?php echo ticketDisplay($row->getstatus()); ?></td>						
						</tr>			
					<?php
						}
				}else{
				?>
					<div class="alert alert-danger alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					  <strong>There is no ticket associated to your account. </strong>
					</div>
				<?php				
				}
				?>																					
		
		</tbody>
	</table>
</div>