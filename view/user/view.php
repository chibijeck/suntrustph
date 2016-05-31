<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
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
				$user = new user();	
				$user_role = new user_role();					
				$user = $user->selectAll('ORDER BY created_at DESC');	
				foreach($user as $row){	
				?>
			<tr>
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