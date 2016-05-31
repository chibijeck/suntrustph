<?php		
		$ticket = new ticket();		
		//****************** Edit POST
		//******************************
		if(isset($_POST['editSubmit'])){			
				
			$user->setusername($_POST["username"]); 							
			$user->update($_POST['editid']);			
			?>		
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  <strong><?php echo $_POST['username']; ?> was UPDATED </strong>
			</div>
			<?php
		}
?>

<div class="table-responsive">
<h2>EDIT TICKET</h2>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<tr>
				<th>             </th>
				<th>Tracking id  </th>
				<th>Property Id       </th>
				<th>Customer       </th>
				<th>Agent          </th>
				<th>created_at     </th>
				<th>Status     </th>																					
			</tr>																					
			</tr>
		</thead>
		<tbody>
			<?php
									
				$ticket = $ticket->selectAll('ORDER BY created_at DESC');	
				foreach($ticket as $row){	
				?>
			<tr <?php echo colorForRowTicket($row->getstatus()); ?>>
				
				<td>
					<!-- Edit Start Here -->
					<a type="button" class="btn btn-success" href="manageTicket.php?action=editpage&id=<?php echo $row->getid(); ?>">Edit</button>
				
					<!-- Edit End Here -->
				</td>		
				<td><?php echo $row->getid(); ?></td>		
				<td><?php echo $row->getproperties_id(); ?></td>							
				<td><?php echo $row->getcustomer(); ?></td>							
				<td><?php echo $row->getagent(); ?></td>						
				<td><?php echo $row->getcreated_at(); ?></td>						
				<td><?php echo ticketDisplay($row->getstatus()); ?></td>						
				
			</tr>			
			<?php
				}
				?>																					
		
		</tbody>
	</table>
</div>