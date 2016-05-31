<?php
	$toUpdateId = $_GET["pbfr"];
	$propertyId= $_GET["id"];
	$pbfr = new pbfr();	
	$pbfr->selectOne($toUpdateId);

	if(isset($_POST["submitUpdate"])){		
		try { 
            $pbfr->setproperties_id($propertyId);
            $pbfr->setbuilding($_POST['building']);
            $pbfr->setfloor($_POST['floor']);
            $pbfr->setroom($_POST['room']);
            $pbfr->setstatus($_POST['status']);
            $pbfr->update($toUpdateId)
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  <strong>Update Successful</strong>
			</div>
			<?php
			} catch (Exception $e) {
				echo $e->getMessage(); 		
		}				
	}	
 ?>
	<div class="row">
	<div class="col-md-12">
		<h2>Edit</h2>
		<form role="form" method="post" action="<?php echo $_SERVER["REQUEST_URI"] ?>" data-toggle="validator">		
	 					
	 		<div class="form-group">
				<label for="building">building *</label>
				<input type="text" value="<?php echo $pbfr->getbuilding(); ?>" class="form-control"  name="building" placeholder=""  data-error="Required" required>
				<div class="help-block with-errors"></div>
			</div>	
			
	 		<div class="form-group">
				<label for="floor">floor *</label>
				<input type="text" value="<?php echo $pbfr->getfloor(); ?>" class="form-control"  name="floor" placeholder=""  data-error="Required" required>
				<div class="help-block with-errors"></div>
			</div>	
			
	 		<div class="form-group">
				<label for="room">room *</label>
				<input type="text" value="<?php echo $pbfr->getroom(); ?>" class="form-control"  name="room" placeholder=""  data-error="Required" required>
				<div class="help-block with-errors"></div>
			</div>				
	 		
			<div class="form-group">
					<label for="exampleInputEmail1">status</label>							
					<select  class="form-control" name="status" >																										
						<option value="0" <?php if($pbfr->getstatus() == 0){ echo "selected"; } ?>>Available</option>							
						<option value="1" <?php if($pbfr->getstatus() == 1){ echo "selected"; } ?>>Reserved</option>	
					</select>								
			</div> 
			<button type="submit" class="btn btn-default" name="submitUpdate" >Submit</button>
		</form>			
	</div>
	</div>