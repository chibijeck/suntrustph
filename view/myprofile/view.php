<div style="padding:20px 10px;">
	<a type="button" href="myprofile.php" class="btn btn-default" > View My Profile</a>
	<a class="btn btn-default" href="myprofile.php?action=editpage" role="button">Edit my Profile</a>
</div>

<div class="table-responsive">
	<table class="table table-bordered table-hover">	
		<tbody>
			<?php 
				$currentUserid = $_SESSION['user_id'];
				$user = new user();	
				$user_role = new user_role();					
				
				$user->selectOne($currentUserid);				
				?>
			<tr>
				<td>User Id</td>
				<td><?php echo $user->getid(); ?></td>
			</tr>	
			<tr>	
				<td>Username</td>
				<td><?php echo $user->getusername(); ?></td>
			</tr>	
			<tr>	
				<td>Email</td>					
				<td><?php echo $user->getemail(); ?></td>
			</tr>	
			<tr>	
				<td>Date Joined</td>					
				<td><?php echo $user->getcreated_at(); ?></td>
			</tr>	
			<tr>	
				<td>Role</td>					
				<td>
					<?php 					
						$user_role->selectOne($user->getrole_id());					
						echo $user_role->getname(); 					
					?>
				</td>
			</tr>	
			<tr>	
				<td>Name</td>					
				<td><?php echo $user->getname(); ?></td>
			</tr>	
			<tr>	
				<td>Age</td>					
				<td><?php echo $user->getage(); ?></td>	
			</tr>	
			<tr>	
				<td>Address</td>					
				<td><?php echo $user->getaddress(); ?></td>	
			</tr>	
			<tr>	
				<td>Civil Status</td>					
				<td><?php echo $user->getcivil_status(); ?></td>
			</tr>	
			<tr>	
				<td>Nationality</td>					
				<td><?php echo $user->getnationality(); ?></td>
			</tr>	
			<?php
				if($user->getnationality() == "foreign"){
				?>	
			<tr>	
				<td>Representatives Name</td>					
				<td><?php echo $user->getcontact_name(); ?></td>
			</tr>	
			<tr>	
				<td>Representatives Email</td>					
				<td><?php echo $user->getcontact_email(); ?></td>		
			</tr>			
			<?php
				}
				?>																					
		
		</tbody>
	</table>
</div>