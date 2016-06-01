<?php		
		$user = new user();	
		$user_role = new user_role();			
		//****************** DELETE POST
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
<h2>EDIT USER</h2>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>             </th>
				<th>id             </th>
				<th>username       </th>
				<th>password       </th>
				<th>email          </th>
				<th>created_at     </th>
				<th>role_id        </th>
				<th>name           </th>
				<th>age            </th>
				<th>address        </th>
				<th>civil_status   </th>
				<th>nationality    </th>
				<th>contact_name   </th>
				<th>contact_email  </th>																					
			</tr>
		</thead>
		<tbody>
			<?php
									
				$user = $user->selectAll('ORDER BY created_at DESC');	
				foreach($user as $row){	
				?>
			<tr>
				
				<td>
					<!-- Edit Start Here -->
					<a type="button" class="btn btn-success" href="manageUser.php?action=editpage&id=<?php echo $row->getid(); ?>">Edit</button>
				
					<!-- Edit End Here -->
				</td>		
				<td><?php echo $row->getid(); ?></td>		
				<td><?php echo $row->getusername(); ?></td>		
				<td><?php echo base64_encode($row->getpassword()); ?></td>		
				<td><?php echo $row->getemail(); ?></td>		
				<td><?php echo $row->getcreated_at(); ?></td>		
				<td>
					<?php 					
						$user_role->selectOne($row->getrole_id());					
						echo $user_role->getname(); 					
					?>
				</td>		
				<td><?php echo $row->getname(); ?></td>		
				<td><?php echo $row->getage(); ?></td>		
				<td><?php echo $row->getaddress(); ?></td>		
				<td><?php echo $row->getcivil_status(); ?></td>		
				<td><?php echo $row->getnationality(); ?></td>		
				<td><?php echo $row->getcontact_name(); ?></td>		
				<td><?php echo $row->getcontact_email(); ?></td>		
			</tr>			
			<?php
				}
				?>																					
		
		</tbody>
	</table>
</div>