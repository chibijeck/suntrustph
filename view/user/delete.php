<?php
		// 1 instantation lang
		$user = new user();	
		$user_role = new user_role();			
		//****************** DELETE POST
		//******************************
		if(isset($_POST['deleteSubmit'])){				
			$user->selectOne($_POST['deleteThisId']);							
			$user->delete($_POST['deleteThisId']);			
			?>		
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  <strong><?php echo $_POST['deleteThisName']; ?> was Deleted </strong>
			</div>
			<?php
		}
?>

<div class="table-responsive">
<h2>DELETE USER</h2>
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
					<!-- Delete Start Here -->
					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $row->getid(); ?>">Delete</button>											
					<div class="modal fade" id="deleteModal<?php echo $row->getid(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <form method="post" id="delete" action="<?php echo $_SERVER['REQUEST_URI'] ?>" >
						  <div class="modal-dialog">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title" id="myModalLabel">Are you sure you want to delete ' <?php echo $row->getusername(); ?> '?</h4>
							  </div>
							 
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									
								<input type="hidden" name="deleteThisName" value="<?php echo $row->getusername(); ?>">
								<input type="hidden" name="deleteThisId" value="<?php echo $row->getid(); ?>">
								<button type="submit" name="deleteSubmit" class="btn btn-primary">Delete</button>																
							  </div>
							</div>
						  </div>
					  </form>
					</div>
				</td>		
				<td><?php echo $row->getid(); ?></td>		
				<td><?php echo $row->getusername(); ?></td>		
				<td><?php echo $row->getpassword(); ?></td>		
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