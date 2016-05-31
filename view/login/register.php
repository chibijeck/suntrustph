    
<div class="container mainBody">		
	<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
				<?php
					$user = new user();	
					if(isset($_POST['submitUser'])){		
						try {

							//Username must be unique
							if(!$user->notExist('username',$_POST["username"])){//returns true if not exist
								throw new Exception('									
									<div class="alert alert-danger alert-dismissible" role="alert">
									  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
									  <strong>User already exist</strong>
									</div>									
								');	
							}															
						
							//inesrt sa DB
							$user->setusername($_POST["username"]);  
							$user->setpassword($_POST["password"]);  
							$user->setemail($_POST["email"]);  
							$user->setcreated_at(date('Y-m-d H:i:s'));		
							$user->setrole_id("0"); //set to inactive 
							$user->setname($_POST["name"]);  
							$user->setage($_POST["age"]);  
							$user->setaddress($_POST["address"]);  
							$user->setcivil_status($_POST["civil_status"]);  
							$user->setnationality($_POST["nationality"]);  
							$user->setcontact_name($_POST["contact_name"]);  
							$user->setcontact_email($_POST["contact_email"]); 							
							$user->insert();	
							
							
							//after insert get id immediately to add it on our activation link
							$getId = new user();	
							$getId->selectOneField("username",$_POST["username"]);	
							$activationLink = linkbasepath ."login.php?action=activate&id=". $getId->getid() ."&key=".md5($getId->getid());
							
							
							//send an activation email
							$mail = new PHPMailer;
							$mail->From = fromSystemEmail;
							$mail->FromName = 'Suntrust';	
								
							
							$mail->addAddress($_POST["email"]);  //send to user
							$mail->isHTML(true);// Set email format to HTML							
							$mail->Subject = 'User Registration Successful';
							$mail->Body    = 'Please click the link to activate your account </br>
												<a href="'.$activationLink.'">'.$activationLink.'</a>';
							$mail->send();
							
							?>		
							<div class="alert alert-success alert-dismissible" role="alert" style="text-align:center;">
							  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							  <strong>Registration Successful.</br>An email has been sent to <strong><?php echo $_POST["email"];?></strong>.</br>Please click the link to activate your account.</strong>
							</div>
							<?php
							} catch (Exception $e) {
								echo $e->getMessage(); 		
						}				
					}		
					
					
				 ?>
					<div class="panel panel-default">
					  <div class="panel-heading"><h2>Register</h2></div>
					  <div class="panel-body">	
							<form role="form" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" data-toggle="validator">		
							  
								<div class="form-group">
									<label for="exampleInputEmail1">User Name *</label>
									<input type="text" class="form-control"  name="username" placeholder="Username for logging in"  data-error="Username is Required" required>
									<div class="help-block with-errors"></div>
								</div>					
						
								 <div class="form-group">
									<div class=" col-sm-6">
									<label for="inputPassword" class="control-label">Password *</label>
									  <input type="password"  class="form-control"  name="password" id="inputPassword" placeholder="Password" data-error="Password is Required" required>
									 <div class="help-block with-errors"></div>
									</div>

									<div class="form-group col-sm-6">
									<label for="inputPassword" class="control-label">Confirm Password *</label>
									  <input type="password" class="form-control" id="inputPasswordConfirm" data-error="Repeat Password" data-match="#inputPassword" data-match-error="Password must match" placeholder="Repeat Password" required>
									  <div class="help-block with-errors"></div>
									</div>
								</div>
								
								
								<div class="form-group">
									<label for="exampleInputEmail1">Email *</label>						
									<input type="email" class="form-control"  name="email" placeholder="Email" data-error="Invalid email address format" required>	
									<div class="help-block with-errors"></div>							
								</div>				
														

								
								<div class="form-group">
									<label for="exampleInputEmail1">Name</label>						
									<input type="text" class="form-control"  name="name" placeholder="Full Name" data-error="Letters Only"   pattern="^[a-zA-Z ]*$">					
									<div class="help-block with-errors"></div>
								</div>
								
								<div class="form-group"> 
									<label for="exampleInputEmail1">Age</label>						
									<input type="text" class="form-control"  name="age" placeholder="Age" data-error="Numbers Only"  pattern="\d*" maxlength="2" >
									<div class="help-block with-errors"></div>									
								</div>
								
								<div class="form-group">
									<label for="exampleInputEmail1">Address</label>						
									<input type="text" class="form-control"  name="address" placeholder="Address">				
								</div>
								
								
								<div class="form-group">
									<label for="exampleInputEmail1">Civil Status *</label>	
									<div class="radio">
									  <label>
										<input type="radio" name="civil_status"  value="single" required>
										Single
									  </label>
									</div>
									<div class="radio">
									  <label>
										<input type="radio" name="civil_status"  value="married" required>
										Married
									  </label>
									</div>
								  </div>						
								
								
								  <div class="form-group">
									<label for="exampleInputEmail1">Nationality *</label>	
									<div class="radio">
									  <label>
										<input class="radioNationality" type="radio" name="nationality"  value="local" required>
										Local
									  </label>
									</div>
									<div class="radio">
									  <label>
										<input class="radioNationality" type="radio" name="nationality"  value="foreign" required>
										Foreign
									  </label>
									</div>
								  </div>
								
								<div class="form-group displayNone">
									<label for="exampleInputEmail1">Representative's Name </label>						
									<input type="text" class="form-control"  name="contact_name" placeholder="">				
								</div>
								
								<div class="form-group displayNone">
									<label for="exampleInputEmail1">Representative's Email</label>						
									<input type="text" class="form-control"  name="contact_email" placeholder="">				
								</div>
								
								
								
								<button type="submit" class="btn btn-default" name="submitUser" >Register</button>
							</form>			
						</div>
					</div>
				</div>
				<div class="col-md-3"></div>
		</div>
</div>

<script>
$(function() {
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
