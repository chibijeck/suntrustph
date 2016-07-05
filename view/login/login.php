
<div class="container mainBody">		
			<div class="row">
				  <div class="col-md-4"></div>
				  <div class="col-md-4">
				  <?php 							
					if(isset($_POST['loginBtn'])){					
							$username = $_POST['username']; //from form field user
							$password = $_POST['password']; //from from field pass
							$user = new user(); 							
							try { 								
								//check if user exist
								if($user->notExist('username',$username)){//returns true if not exist
									throw new Exception('									
										<div class="alert alert-danger alert-dismissible" role="alert">
										  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
										  <strong>User does not exist</strong>
										</div>									
									');	
								}									
								$user->selectOneField("username",$username);				
								$dbU = $user->getusername();
								$dbP = $user->getpassword();		
								$dbemail = $user->getemail();		
								$dbID = $user->getid();								
								$uRole = $user->getrole_id();				
						
							if($dbP != $password){
								throw new Exception('									
										<div class="alert alert-danger alert-dismissible" role="alert">
										  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
										  <strong>Incorrect Password</strong>
										</div>									
									');
							 }	
							if($uRole == 0){
								throw new Exception('									
										<div class="alert alert-danger alert-dismissible" role="alert">
										  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
										  <strong>Your account is not yet activated</strong>
										</div>									
									');
							 }	
							 
							//run this if user successfully logged in	
							if($dbU === $username && $dbP === $password){ //if both are equal
								$_SESSION['username'] = $dbU; 
								$_SESSION['current_password'] = $dbP; 
								$_SESSION['user_id'] = $dbID;
								$_SESSION['user_email'] = $dbemail;
								$_SESSION['role_id'] = $uRole;
								echo "login successful";	
								
								//check first if it cames to property page
							

								if(isset($_GET['ref'])){
									redirectTo($_SESSION['lastViewedPage']);									
								}else{
									redirectTo("myprofile.php?id=". $dbID );									
								}
							}
						} catch (Exception $e) {
							echo $e->getMessage(); 		
						}
						
					}
						
				?>
					<div class="panel panel-info">
					  <div class="panel-heading">
					  	<h3 class="panel-title">Login</h3>
					  </div>					
					  <div class="panel-body">						
							<form class="registerForm" method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>" name="loginform" id="loginform" data-toggle="validator">		
								  <div class="form-group">
									<label for="">Username</label>
									<input type="text" name="username" class="form-control"  placeholder="Enter email" value="<?php if(isset($_POST['username'])){echo $_POST['username'];};?>" data-error="Username is Required" required>
									<div class="help-block with-errors"></div>
								  </div>
								  <div class="form-group">
									<label for="exampleInputPassword1">Password</label>
									<a type="submit" data-toggle="modal" data-target="#myModal" href="#" style="float: right;">Forgot password?</a>
									<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" data-error="Password is Required" required>
									<div class="help-block with-errors"></div>
									
								  </div>							  
								<div class="form-group">
								  <button type="submit" name="loginBtn"  class="btn btn-primary">Log In</button>
								  <!--<a type="submit" class="btn btn-default" href="login.php?action=register" >Register</a>-->
								  </div>
							</form>		
						</div>
					</div>
				  </div>
				  <div class="col-md-4"></div>
				</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Forgot Password?</h4>
			</div>
	  		<form role="form" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
	  			<div class="modal-body">
					<div class="form-group">
						<label for="">Email</label>
						<input type="text" name="email" class="form-control"  placeholder="Enter email" value="<?php if(isset($_POST['username'])){echo $_POST['username'];};?>" data-error="Email is Required" required>
						<div class="help-block with-errors"></div>
					</div>				
				</div>
				<div class="modal-footer">
					<div class="form-group">
						<button type="submit" name="forgotBtn" class="btn btn-default">Submit</button>	
						<!--<button type="submit" name="forgotBtn" class="btn btn-default" data-dismiss="modal">Submit</button>	-->
					</div>
				</div>
			</form>
	  </div>
	</div>
</div>
<?php
	if(isset($_POST['forgotBtn'])){
		echo "<script>alert('Password has been sent to ".$_POST['email']."');</script>";
		$user = new user(); 
		$user->selectOneField("email", $_POST['email']);				
		$dbU = $user->getusername();
		$dbP = $user->getpassword();		
		//$dbemail = $user->getemail();	
			$mailCustomer = new PHPMailer;
			$mailCustomer->From = fromSystemEmail;
			$mailCustomer->FromName = 'Suntrust';	
			
			$mailCustomer->addAddress($_POST['email']);  //send to customer
			$mailCustomer->isHTML(true);// Set email format to HTML							
			$mailCustomer->Subject = 'Password Notification';
			$mailCustomer->Body ='<img src="http://suntrustph.com/images/logo.png" class="suntrust">';
			$mailCustomer->Body .= '<br><br>';
			$mailCustomer->Body .= 'Dear '.$dbU.',';
			$mailCustomer->Body .= '<br><br>';
			$mailCustomer->Body .= 'This email was sent automatically by Suntrust is response to your request to recover your password. <br>This is done for your protection; only you, the recipient of this email can take the next step is in the password recover process.';
			$mailCustomer->Body .= '<br><br>';
			$mailCustomer->Body .= 'Your password is <b>'. $dbP . '</b>';						
			$mailCustomer->Body .= '<br><br><br><br><br><br>';
			$mailCustomer->Body .= 'Copyright 2015. Suntrust Properties, Inc. All Rights Reserved.';
			$mailCustomer->send();
			//return true;
	}
			
?>