<?php 		
	$pbfr = new pbfr();
	if(isset($_POST["submitAdd"])){		
		try { 
            $pbfr->setproperties_id($_GET['id']);
            $pbfr->setbuilding($_POST['building']);
            $pbfr->setfloor($_POST['floor']);
            $pbfr->setroom($_POST['room']);
            $pbfr->setstatus($_POST['status']);
            $pbfr->insert()
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  <strong>Successfully Added</strong>
			</div>
			<?php
			} catch (Exception $e) {
				echo $e->getMessage(); 		
		}				
	}	
 ?>
	<div class="row">
	<div class="col-md-12">
	
		<h2>ADD</h2>
		<form role="form" method="post" action="<?php echo $_SERVER["REQUEST_URI"] ?>" data-toggle="validator">		
	 				
	 		<div class="form-group">
				<label for="building">building *</label>
				<input type="text" class="form-control"  name="building" placeholder=""  data-error="Required" required>
				<div class="help-block with-errors"></div>
			</div>	
			
	 		<div class="form-group">
				<label for="floor">floor *</label>
				<input type="text" class="form-control"  name="floor" placeholder=""  data-error="Required" required>
				<div class="help-block with-errors"></div>
			</div>	
			
	 		<div class="form-group">
				<label for="room">room *</label>
				<input type="text" class="form-control"  name="room" placeholder=""  data-error="Required" required>
				<div class="help-block with-errors"></div>
			</div>				
			
			<div class="form-group">
					<label for="exampleInputEmail1">status</label>							
					<select  class="form-control" name="status" >																										
						<option value="0" >Available</option>							
						<option value="1">Reserved</option>	
					</select>								
			</div> 
			
			<button type="submit" class="btn btn-default" name="submitAdd" >Submit</button>
		</form>			
	</div>
	</div>