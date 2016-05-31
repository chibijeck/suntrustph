<?php 		
	$autoemail = new autoemail();
	if(isset($_POST["submitAdd"])){		
		try { 
            $autoemail->settest($_POST['test']);
            $autoemail->setday($_POST['day']);
            $autoemail->insert()
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
		<h2>ADD</h2>
		<form role="form" method="post" action="<?php echo $_SERVER["REQUEST_URI"] ?>" data-toggle="validator">		
	 		<div class="form-group">
				<label for="test">test *</label>
				<input type="text" class="form-control"  name="test" placeholder=""  data-error="Required" required>
				<div class="help-block with-errors"></div>
			</div>	
			
	 		<div class="form-group">
				<label for="day">day *</label>
				<input type="text" class="form-control"  name="day" placeholder=""  data-error="Required" required>
				<div class="help-block with-errors"></div>
			</div>	
			
			<button type="submit" class="btn btn-default" name="submitAdd" >Submit</button>
		</form>			
	</div>