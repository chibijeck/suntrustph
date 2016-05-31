<?php
	$PropertiesId = $_GET["id"];
	$properties = new properties();	
	$properties->selectOne($PropertiesId);
	?>

<div class="row">
  <div class="col-md-3"><img class="img-responsive" src="images/upload/small/<?php echo $properties->getimg_name(); ?>" >	</div>
  <div class="col-md-9">
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
		<tr>
			<td>Title</td>
			<td><?php echo $properties->gettitle(); ?></td>
		</tr>
		<tr>
			<td>Unit Type</td>
			<td><?php echo $properties->getunit_type();?></td>
		</tr>
		<tr>
			<td>Location</td>
			<td><?php echo $properties->getlocation();?></td>
		</tr>
		<tr>
			<td>Price</td>
			<td> <?php echo pesoFormat($properties->getprice());?></td>
		</tr>
		</table>
	</div>
  
  </div>
</div>
</br>	

<?php 		
	$pbfr = new pbfr();
	if(isset($_POST["submitDelete"])){
		$pbfr->selectOne($_POST["deleteThisId"]);	
		$pbfr->delete($_POST["deleteThisId"]);
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
				<th width="20"></th>
            	<th>id</th>
            	<th>properties_id</th>
            	<th>building</th>
            	<th>floor</th>
            	<th>room</th>
            	<th>status</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$pbfr = new pbfr();									
			$pbfr = $pbfr->selectAll('WHERE properties_id =' . $PropertiesId . ' ORDER BY building ASC,floor ASC,room ASC');	
			foreach($pbfr as $row){	
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
        	 	<td><?php echo $row->getproperties_id();?></td>
        	 	<td><?php echo $row->getbuilding();?></td>
        	 	<td><?php echo $row->getfloor();?></td>
        	 	<td><?php echo $row->getroom();?></td>
        	 	<td><?php echo $row->getstatus();?></td>
			</tr>			
		<?php } ?>
		</tbody>
	</table>
</div>