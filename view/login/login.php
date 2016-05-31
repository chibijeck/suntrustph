
<div class="container mainBody">		
			<div class="row">
				  <div class="col-md-3"></div>
				  <div class="col-md-6">
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
					<div class="panel panel-default">
					  <div class="panel-heading"><h2>Login</h2></div>					
					  <div class="panel-body">						
							<form class="registerForm" method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>" name="loginform" id="loginform" data-toggle="validator">		
								  <div class="form-group">
									<label for="">Username</label>
									<input type="text" name="username" class="form-control"  placeholder="Enter email" value="<?php if(isset($_POST['username'])){echo $_POST['username'];};?>" data-error="Username is Required" required>
									<div class="help-block with-errors"></div>
								  </div>
								  <div class="form-group">
									<label for="exampleInputPassword1">Password</label>
									<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" data-error="Password is Required" required>
									<div class="help-block with-errors"></div>
								  </div>							  
									
								  <button type="submit" name="loginBtn"  class="btn btn-default">Log In</button>
								  <a type="submit" class="btn btn-default" href="login.php?action=register" >Register</a>
							</form>		
						</div>
					</div>
				  </div>
				  <div class="col-md-3"></div>
				</div>
</div>