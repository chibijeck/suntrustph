<?php
		// 1 instantation lang
		$properties = new properties();				
		//****************** DELETE POST
		//******************************
		if(isset($_POST['deleteSubmit'])){			
			//small delete
			unlink('images/upload/small/'. $_POST['deleteThisImg']);				
			//normal img delete
			unlink('images/upload/'. $_POST['deleteThisImg']);
			
			$properties->selectOne($_POST['deleteThisId']);							
			$properties->delete($_POST['deleteThisId']);			
			?>		
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  <strong><?php echo $_POST['deleteThisName']; ?> was Deleted </strong>
			</div>
			<?php
		}
?>

<div class="table-responsive">
<h2>DELETE PROPERTIES</h2>
	<table class="table table-bordered table-hover">
		<thead>
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
		</thead>
		<tbody>
			<?php 									
				$properties = $properties->selectAll('ORDER BY created_at DESC');	
				foreach($properties as $row){	
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
								<h4 class="modal-title" id="myModalLabel">Are you sure you want to delete ' <?php echo $row->gettitle(); ?> '?</h4>
							  </div>
							 
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									
								<input type="hidden" name="deleteThisName" value="<?php echo $row->gettitle(); ?>">
								<input type="hidden" name="deleteThisImg" value="<?php echo $row->getimg_name(); ?>">
								<input type="hidden" name="deleteThisId" value="<?php echo $row->getid(); ?>">
								<button type="submit" name="deleteSubmit" class="btn btn-primary">Delete</button>																
							  </div>
							</div>
						  </div>
					  </form>
					</div>
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