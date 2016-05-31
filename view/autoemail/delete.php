<?php 		
	$autoemail = new autoemail();
	if(isset($_POST["submitDelete"])){
		$autoemail->selectOne($_POST["deleteThisId"]);	
		$autoemail->delete($_POST["deleteThisId"]);
		?>		
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  <strong>Successfully Deleted </strong>
			</div>
		<?php
		}
?>		
		<div class="table-responsive">
	<h2>DELETE</h2>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th></th>
            	<th>id</th>
            	<th>test</th>
            	<th>day</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$autoemail = new autoemail();									
			$autoemail = $autoemail->selectAll('');	
			foreach($autoemail as $row){	
		?>
			<tr>
				<td>
					<!-- Delete Start Here -->
					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $row->getid(); ?>">Delete</button>											
					<div class="modal fade" id="deleteModal<?php echo $row->getid(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <form method="post" id="delete" action="<?php echo $_SERVER["REQUEST_URI"] ?>" >
						  <div class="modal-dialog">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title" id="myModalLabel">Are you sure?</h4>
							  </div>							 
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>								
								<input type="hidden" name="deleteThisId" value="<?php echo $row->getid(); ?>">
								<button type="submit" name="submitDelete" class="btn btn-primary">Delete</button>																
							  </div>
							</div>
						  </div>
					  </form>
					</div>
				</td>
        	 	<td><?php echo $row->getid();?></td>
        	 	<td><?php echo $row->gettest();?></td>
        	 	<td><?php echo $row->getday();?></td>
			</tr>			
		<?php } ?>
		</tbody>
	</table>
</div>