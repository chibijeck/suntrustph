<?php
	$toUpdateId = $_GET["id"];
	$autoemail = new autoemail();	
	$autoemail->selectOne($toUpdateId);

	if(isset($_POST["submitUpdate"])){		
		try { 
            $autoemail->settest($_POST['test']);
            $autoemail->setday($_POST['day']);
            $autoemail->update($toUpdateId)
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
	<div class="">		
		<form role="form" method="post" action="<?php echo $_SERVER["REQUEST_URI"] ?>" data-toggle="validator">		
	 		
			<div class="form-group">
				<label for="test">Test (For testing purposes, ex: 2015-11-21 01:19:55 )</label>
				<input type="text" value="<?php echo $autoemail->gettest(); ?>" class="form-control"  name="test" placeholder=""  data-error="Required" required>
				<div class="help-block with-errors"></div>
			</div>	
			
	 		<div class="form-group">
				<label for="day">Day of the month *</label>
				<input type="text" value="<?php echo $autoemail->getday(); ?>" class="form-control"  name="day" placeholder=""  data-error="Required" required>
				<div class="help-block with-errors">Set to 0 to enable test mode</br>Ex: when set to 7, Email will send at exactly 7th day of the month , sample : 2015-12-07 00:00:00 </div>
			</div>	
			
			<button type="submit" class="btn btn-default" name="submitUpdate" >Submit</button>
		</form>			
	</div>