<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>Tracking id  </th>
				<th>Property Id       </th>
				<th>Customer       </th>
				<th>Agent          </th>
				<th>created_at     </th>
				<th>Status     </th>
				<th>pbfr_id     </th>																								
			</tr>
		</thead>
		<tbody> 
			<?php 
				$ticket = new ticket();									
				$ticket = $ticket->selectAll('ORDER BY created_at DESC');	
				foreach($ticket as $row){	
				?>
			<tr <?php echo colorForRowTicket($row->getstatus()); ?>>
				<td><?php echo $row->getid(); ?></td>		
				<td><?php echo $row->getproperties_id(); ?></td>							
				<td><?php echo $row->getcustomer(); ?></td>							
				<td><?php echo $row->getagent(); ?></td>						
				<td><?php echo $row->getcreated_at(); ?></td>						
				<td><?php echo ticketDisplay($row->getstatus()); ?></td>						
				<td><?php echo $row->getpbfr_id() ?></td>						
			</tr>
			<tr <?php echo colorForRowTicket($row->getstatus()); ?>>
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
							$pbfr = new pbfr();									
							$pbfr = $pbfr->selectAll('WHERE id =' . $row->getpbfr_id());	
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