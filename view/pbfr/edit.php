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

<div class="table-responsive">
	<h2>Edit</h2>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th width="20"></th>
            	<th >id</th>
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
					<!-- Edit Start Here Note:Change The link-->
					<a type="button" class="btn btn-success" href="managePbfr.php?action=editpage&id=<?php echo $PropertiesId; ?>&pbfr=<?php echo $row->getid(); ?>">Edit</button>
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