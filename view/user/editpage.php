<?php
	$toUpdateId = $_GET['id'];
	$user = new user();	
	$user->selectOne($toUpdateId);		
			
	if(isset($_POST['updateUser'])){		
		try { 					
		
			//inesrt sa DB
			$user->setusername($_POST["username"]);  
			$user->setpassword($_POST["password"]);  
			$user->setemail($_POST["email"]);  			
			$user->setrole_id($_POST["role_id"]);  
			$user->setname($_POST["name"]);  
			$user->setage($_POST["age"]);  
			$user->setaddress($_POST["address"]);  
			$user->setcivil_status($_POST["civil_status"]);  
			$user->setnationality($_POST["nationality"]);  
			$user->setcontact_name($_POST["contact_name"]);  
			$user->setcontact_email($_POST["contact_email"]); 
			
			$user->update($toUpdateId);	
			?>		
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  <strong>Successfully updated <?php echo $user->getusername(); ?> </strong>
			</div>
			<?php
			} catch (Exception $e) {
				echo $e->getMessage(); 		
		}				
	}		
 ?>
        
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<h2>EDIT <?php echo $user->getusername(); ?> </h2>

			<form role="form" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" data-toggle="validator">		
			  
				<div class="form-group">
					<label for="exampleInputEmail1">User Name *</label>
					<input value="<?php echo $user->getusername(); ?>" type="text" class="form-control"  name="username" placeholder="Username for logging in"  data-error="Username is Required" required>
					<div class="help-block with-errors"></div>
				</div>					
		
				 <div class="form-group">
					<div class=" col-sm-6">
					<label for="inputPassword" class="control-label">Password *</label>
					  <input value="<?php echo $user->getpassword(); ?>" type="password"  class="form-control"  name="password" id="inputPassword" placeholder="Password" data-error="Password is Required" required>
					 <div class="help-block with-errors"></div>
					</div>

					<div class="form-group col-sm-6">
					<label for="inputPassword" class="control-label">Confirm Password *</label>
					  <input value="<?php echo $user->getpassword(); ?>" type="password" class="form-control" id="inputPasswordConfirm" data-error="Repeat Password" data-match="#inputPassword" data-match-error="Password must match" placeholder="Repeat Password" required>
					  <div class="help-block with-errors"></div>
					</div>
				</div>
				
				
				<div class="form-group">
					<label for="exampleInputEmail1">Email *</label>						
					<input value="<?php echo $user->getemail(); ?>" type="email" class="form-control"  name="email" placeholder="Email" data-error="Invalid email address format" required>	
					<div class="help-block with-errors"></div>							
				</div>						
		
		
				<div class="form-group">
					<label for="exampleInputEmail1">Role Level</label>							
					<select  class="form-control" name="role_id" >						
						<?php						
						$user_role = new user_role();									
						$user_role = $user_role->selectAll();	
						foreach($user_role as $role){	?>																						
							<option 
								value="<?php echo $role->getid(); ?>"
								<?php if( $role->getid() == $user->getrole_id() ){ ?> selected="selected" <?php } ?>															
								>
								<?php echo $role->getname(); ?> 
							</option>												
						<?php } ?>							
					</select>								
				</div> 		
					
					
					
					
					
				<div class="form-group">
					<label for="exampleInputEmail1">Name</label>						
					<input value="<?php echo $user->getname(); ?>" type="text" class="form-control"  name="name"  placeholder="Full Name">					
				</div>
				
				<div class="form-group">
					<label for="exampleInputEmail1">Age</label>						
					<input value="<?php echo $user->getage(); ?>" type="text" class="form-control"  name="age" placeholder="Age">			
				</div>
				
				<div class="form-group">
					<label for="exampleInputEmail1">Address</label>						
					<input value="<?php echo $user->getaddress(); ?>" type="text" class="form-control"  name="address" placeholder="Address">				
				</div>
				
				
				<div class="form-group">
					<label for="exampleInputEmail1">Civil Status</label>	
					<div class="radio">
					  <label>
						<input type="radio" name="civil_status"  value="single" required 	<?php if( $user->getcivil_status() == "single" ){ ?> checked="checked" <?php } ?>	>
						Single
					  </label>
					</div>
					<div class="radio">
					  <label>
						<input type="radio" name="civil_status"  value="married" required <?php if( $user->getcivil_status() == "married" ){ ?> checked="checked" <?php } ?> >
						Married
					  </label>
					</div>
				  </div>						
				
				
				  <div class="form-group">
					<label for="exampleInputEmail1">Nationality</label>	
					<div class="radio">
					  <label>
						<input class="radioNationality" type="radio" name="nationality"  value="local" required <?php if( $user->getnationality() == "local" ){ ?> checked="checked" <?php } ?> >
						Local
					  </label>
					</div>
					<div class="radio">
					  <label>
						<input class="radioNationality" type="radio" name="nationality"  value="foreign" required <?php if( $user->getnationality() == "foreign" ){ ?> checked="checked" <?php } ?> >
						Foreign
					  </label>
					</div>
				  </div>
				
				<div class="form-group displayNone">
					<label for="exampleInputEmail1">Representative's Name </label>						
					<input value="<?php echo $user->getcontact_name(); ?>" type="text" class="form-control"  name="contact_name" placeholder="">				
				</div>
				
				<div class="form-group displayNone">
					<label for="exampleInputEmail1">Representative's Email</label>						
					<input value="<?php echo $user->getcontact_email(); ?>" type="text" class="form-control"  name="contact_email" placeholder="">				
				</div>
				
				
				
				<button type="submit" class="btn btn-default" name="updateUser" >Update</button>
			</form>			
	</div>		 
</div>

<script>
$(function() {
	//for initialization
	valradinit = $('input[checked="checked"].radioNationality').val();
	if(valradinit == "foreign"){
		$(".displayNone").show();
	}else{
		$(".displayNone").hide();
	}
	
	//onchange
	$( ".radioNationality" ).change(function() {
		valrad = $(this).val();
	  	if(valrad == "foreign"){
			$(".displayNone").show();
		}else{
			$(".displayNone").hide();
		}
	});
});
</script>
