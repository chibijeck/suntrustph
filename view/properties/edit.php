<?php		
		$properties = new properties();					
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
<h2>EDIT PROPERTIES</h2>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<tr>
				<th>         </th>
				<th>id          </th>
				<th>IMG    </th>
				<th>panotour    </th>
				<th>title       </th>
				<th>unit_type   </th>
				<th>location    </th>
				<th>price       </th>
				<th>status      </th>
				<th>created_at	</th>																	
			</tr>																				
			</tr>
		</thead>
		<tbody>
			<?php
									
				$properties = $properties->selectAll('ORDER BY created_at DESC');
				foreach($properties as $row){	
				?>
			<tr>
				
				<td>
					<!-- Edit Start Here -->
					<a type="button" class="btn btn-success" href="manageProperties.php?action=editpage&id=<?php echo $row->getid(); ?>">Edit</button>
				
					<!-- Edit End Here -->
				</td>		
				<td><?php echo $row->getid(); ?></td>			
				<td><img src="images/upload/small/<?php echo $row->getimg_name(); ?>" width="100"></td>			
				<td><?php echo $row->getpanotour(); ?></td>			
				<td><?php echo $row->gettitle(); ?></td>			
				<td><?php echo $row->getunit_type(); ?></td>			
				<td><?php echo $row->getlocation(); ?></td>			
				<td><?php echo $row->getprice(); ?></td>			
				<td><?php echo $row->getstatus(); ?></td>			
				<td><?php echo $row->getcreated_at(); ?></td>	
			</tr>			
			<?php
				}
				?>																					
		
		</tbody>
	</table>
</div>