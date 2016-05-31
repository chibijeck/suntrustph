<?php
	$viewId = $_GET['id'];
	$properties = new properties();	
	$properties->selectOne($viewId);		
 ?>			
		<div class="row">		
			<div class="col-md-5">
				<img src="images/upload/<?php echo $properties->getimg_name(); ?>" class="img-responsive">
				<h1><?php echo $properties->gettitle();?></h1>
				<table class="table">
				  <tr>
					<td>
						Unit Type
					</td>
					<td>
						<?php echo $properties->getunit_type();?>
					</td>
				  </tr>
				  <tr>
					<td>
						Location
					</td>
					<td>
						<?php echo $properties->getlocation();?>
					</td>
				  </tr>
				  <tr>
					<td>
						Price
					</td>
					<td>
						 <?php echo pesoFormat($properties->getprice());?>
					</td>
				  </tr> 
				  <tr>
					<td>
						Status
					</td>
					<td>
						<span class="
						<?php if($properties->getstatus() == "Available"){
							echo "openStatus";
						}elseif($properties->getstatus() == "Reserved"){
							echo "reservedStatus";
						}else{
							echo "soldStatus";						
						}						
						?>						
						">
						 <?php echo $properties->getstatus()?>
						 <span>
					</td>
				  </tr>			  
				  
				  <tr>
					<td colspan="2">
					
					
					 <?php if(!isset($_SESSION['user_id'])){ ?>
						 <a 
									<?php if($properties->getstatus() != "Available"){
										echo 'style="display:none;"';
									}					
									?>						 
						 
						 type="button"  href="login.php?action=login&ref=true"  class="btn btn-primary">Reserve</a>
					 <?php 
						//set session last view para bumalik d2 sa page nato after mag login
						$_SESSION['lastViewedPage'] = $_SERVER['REQUEST_URI'];
					 }else { ?>
					 
						<a type="button"  href="pbfrReservation.php?id=<?php echo $viewId; ?>"  class="btn btn-primary"
							<?php if($properties->getstatus() != "Available"){
								echo 'style="display:none;"';
							}					
							?>				
						
						>Reserve</a>
						
						<?php 
						//******************************************************************//
						//*********************** RESERVE Function***************************//
						//******************************************************************//
					
							if(isset($_POST['submitReserve'])){		
								try { 					
									$ticket = new ticket();	
									//inesrt sa DB
									$dateCur = date('Y-m-d H:i:s');
									$ticket->setproperties_id($viewId);  
									$ticket->setcustomer($_SESSION['username']);  
									// $ticket->setagent($_POST["agent"]);  
									$ticket->setcreated_at($dateCur);		
									$ticket->setstatus(0); 			
									$ticket->insert();

									//get previously inserted id
									$ticket->selectOneField("created_at",$dateCur);		
	
										
									//send an Email to Admin/sales
									$mailAdmin = new PHPMailer;
									$mailAdmin->From = fromSystemEmail;
									$mailAdmin->FromName = 'Suntrust';	
										
									
									$mailAdmin->addAddress(adminEmail);  //send to admin
									$mailAdmin->isHTML(true);// Set email format to HTML							
									$mailAdmin->Subject = 'Rervation Request';
									$mailAdmin->Body    = '<strong>Reservation Request</strong></br>
															<table>
																<tr>
																	<td>
																		Tracking Id :
																	</td>
																	<td>
																		' . $ticket->getid() .'
																	</td>
																</tr>
																<tr>  
																	<td>
																		Customer username :
																	</td>
																	<td>
																		' . $_SESSION['username'] .'
																	</td>
																</tr>
																<tr>
																	<td>
																		Customer Email :
																	</td>
																	<td>
																		' . $_SESSION['user_email'] .'
																	</td>
																</tr>
																<tr>
																	<td>
																		Property  ID :
																	</td>
																	<td>
																		' . $viewId .'
																	</td>
																</tr>
																<tr>
																	<td>
																		Property  Name :
																	</td>
																	<td>
																		' . $properties->gettitle() .'
																	</td>
																</tr>
																<tr>
																	<td>
																		Property Unit Type :
																	</td>
																	<td>
																		' . $properties->getunit_type() .'
																	</td>
																</tr>
																<tr>
																	<td>
																		Property  location :
																	</td>
																	<td>
																		' . $properties->getlocation() .'
																	</td>
																</tr>
																<tr>
																	<td>
																		Property  Price :
																	</td>
																	<td>
																		' . pesoFormat($properties->getprice()) .'
																	</td>
																</tr>
																<tr>
																	<td>
																		Reservation  Time :
																	</td>
																	<td>
																		' . $dateCur .'
																	</td>
																</tr>														
																
																
															</table>'								
													;
													
									$mailAdmin->send();	

									//send an Email to Customer
									$mailCustomer = new PHPMailer;
									$mailCustomer->From = fromSystemEmail;
									$mailCustomer->FromName = 'Suntrust';	
										
									
									$mailCustomer->addAddress($_SESSION['user_email']);  //send to customer
									$mailCustomer->isHTML(true);// Set email format to HTML							
									$mailCustomer->Subject = 'Rervation Request';
									$mailCustomer->Body    = '<strong>Reservation Request</strong></br>
															Your reservation request for '. $properties->gettitle() .' has been submitted</br>
															We will update you through email as soon as we process your reservation request.
															</br></br>
															Details
															<table>
																<tr>
																	<td>
																		Tracking Id :
																	</td>
																	<td>
																		' . $ticket->getid() .'
																	</td>
																</tr>
																<tr>  
																	<td>
																		Customer username :
																	</td>
																	<td>
																		' . $_SESSION['username'] .'
																	</td>
																</tr>
																<tr>
																	<td>
																		Customer Email :
																	</td>
																	<td>
																		' . $_SESSION['user_email'] .'
																	</td>
																</tr>
																<tr>
																	<td>
																		Property  ID :
																	</td>
																	<td>
																		' . $viewId .'
																	</td>
																</tr>
																<tr>
																	<td>
																		Property  Name :
																	</td>
																	<td>
																		' . $properties->gettitle() .'
																	</td>
																</tr>
																<tr>
																	<td>
																		Property Unit Type :
																	</td>
																	<td>
																		' . $properties->getunit_type() .'
																	</td>
																</tr>
																<tr>
																	<td>
																		Property  location :
																	</td>
																	<td>
																		' . $properties->getlocation() .'
																	</td>
																</tr>
																<tr>
																	<td>
																		Property  Price :
																	</td>
																	<td>
																		' . pesoFormat($properties->getprice()) .'
																	</td>
																</tr>
																<tr>
																	<td>
																		Reservation  Time :
																	</td>
																	<td>
																		' . $dateCur .'
																	</td>
																</tr>			
																
																
															</table>'								
													;
													
									$mailCustomer->send();













									
									?>		
									<div class="alert alert-success alert-dismissible" role="alert">
									  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
									  <strong>Reservation Successful</strong></br>
									  an email has been sent to <?php echo $_SESSION['user_email']; ?></br>
									  Tracking ID : <?php echo $ticket->getid(); ?>
									</div>
									<?php
									} catch (Exception $e) {
										echo $e->getMessage(); 		
								}				
							}
						
						?>
					 	<!--form role="form" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">							
							<button 						
									<?php if($properties->getstatus() != "Available"){
										echo 'style="display:none;"';
									}					
									?>	
													
							
							type="submit" class="btn btn-primary" name="submitReserve" >Reserve</button>
						</form-->
					<?php } ?>
									 
					
					</td>
						
						
				  </tr>			
				</table>				
				
			</div>
			<div class="col-md-7">
				<iframe class="pantourDiv1" src="<?php echo linkbasepath; ?>panotour/<?php echo $properties->getpanotour()?>.html" width="100%" height="500"  allowFullScreen></iframe>
			</div>
		</div>	
		</br>
	
	
			<?php 
			//********************************************************************//
			//*********************** Gallery Function***************************//
			//******************************************************************//						
						
			$gallery = new gallery();
			$gallery = $gallery->selectAll('WHERE properties_id = '. $properties->getid() .' ORDER BY arrangement');	
			//if empty hide gallery
			if(!empty($gallery)){		
				
			?>
				<hr>
				<div class="row">		
					<div class="col-md-12">
						<h1>Gallery</h1>						
						<div id="owl-example" class="owl-carousel">
						  
						 <?php foreach($gallery as $row){ ?>
							<div> <a class="group1" href="<?php echo linkbasepath; ?>images/upload/<?php echo $row->getimg_name(); ?>" title="<?php echo $row->gettitle(); ?>"><img src="<?php echo linkbasepath; ?>images/upload/<?php echo $row->getimg_name(); ?>" class="img-responsive"></a></div>
						 <?php } ?>
						</div>
					</div>
				</div>
				</br>
			<?php } ?>
			<!-- End Gallery -->
			
			
		<hr>
<?php if($properties->getlocation()== "Sta.Ana, Manila"){ ?>
		<div class="row">
			<div class="col-md-4">
				<h1>More Details</h1>
				<table class="table">
				<tr>
					<td>
						Name
					</td>
					<td>
						Suntrust Ascentia
					</td>
				  </tr>
				  <tr>
					<td>
						Location
					</td>
					<td>
						Along New Panaderos, Sta. Ana, Manila
					</td>
				  </tr>
				  <tr>
					<td>
						THEME
					</td>
					<td>
						Modern-Contemporary
					</td>
				  </tr>
				  <tr>
					<td>
						TOTAL LAND AREA
					</td>
					<td>
						5,158.21 sq.m.
					</td>
				  </tr> 
				  
				  <tr>
					<td>
						No. of Towers
					</td>
					<td>	
						3				
					</td>				
				  </tr>	
				  <tr>
					<td>
						Estimated Saleable no. of units
					</td>
					<td>	
						955 Units				
					</td>				
				  </tr>			
				</table>				
			</div>
			<div class="col-md-4">
				<img src="<?php echo linkbasepath; ?>images/ascentia.jpg" class="img-responsive">
			</div>
			<div class="col-md-4">
				<iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=14.582841%2C%20121.015254&key=AIzaSyB06ZLhFV8_-OS6ZE9dj4Ynpo2tWXjUcHs"></iframe>
			</div>
		</div>
<?php } ?>
		
<?php if($properties->getlocation()== "Ermita, Manila 1"){ ?>
		<div class="row">
			<div class="col-md-4">
				<h1>More Details</h1>
				<table class="table">
				<tr>
					<td>
						Name
					</td>
					<td>
						Suntrust Parkview
					</td>
				  </tr>
				  <tr>
					<td>
						Location
					</td>
					<td>
						Concepcion Street,Ermita,Manila</br>
						Boy Scout Of the Philippines(BSP) Compound
					</td>
				  </tr>
				  <tr>
					<td>
						THEME
					</td>
					<td>
						Modern-Contemporary Architectural Theme 
					</td>
				  </tr>
				  <tr>
					<td>
						TOTAL LAND AREA
					</td>
					<td>
						10,221.80 sq.m
					</td>
				  </tr> 
				  
				  <tr>
					<td>
						No. of Towers
					</td>
					<td>	
								6		
					</td>				
				  </tr>	
				  <tr>
					<td>
						Estimated Saleable no. of units
					</td>
					<td>	
						1612			
					</td>				
				  </tr>			
				</table>				
			</div>
			<div class="col-md-4">
				<img src="<?php echo linkbasepath; ?>images/parkview.jpg" class="img-responsive">
			</div>
			<div class="col-md-4">
				<iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=14.590908%2C%20120.983356&key=AIzaSyB06ZLhFV8_-OS6ZE9dj4Ynpo2tWXjUcHs"></iframe>
			</div>
		</div>
<?php } ?>

<?php if($properties->getlocation()== "Ermita, Manila 2"){ ?>
		<div class="row">
			<div class="col-md-4">
				<h1>More Details</h1>
				<table class="table">
				<tr>
					<td>
						Name
					</td>
					<td>
						Suntrust Solana
					</td>
				  </tr>
				  <tr>
					<td>
						Location
					</td>
					<td>
						Natividad Lopez St., Ermita, Manila
					</td>
				  </tr>
				  <tr>
					<td>
						THEME
					</td>
					<td>
						Modern Contemporary
					</td>
				  </tr>
				  <tr>
					<td>
						TOTAL LAND AREA
					</td>
					<td>
						3,213.78 sq.m.
					</td>
				  </tr> 
				  
				  <tr>
					<td>
						No. of Towers
					</td>
					<td>	
						2		
					</td>				
				  </tr>	
				  <tr>
					<td>
						Estimated Saleable no. of units
					</td>
					<td>	
						648 Units			
					</td>				
				  </tr>			
				</table>				
			</div>
			<div class="col-md-4">
				<img src="<?php echo linkbasepath; ?>images/solana.jpg" class="img-responsive">
			</div>
			<div class="col-md-4">
				<iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=14.590805%2C%20120.985533&key=AIzaSyB06ZLhFV8_-OS6ZE9dj4Ynpo2tWXjUcHs"></iframe>
			</div>
		</div>
<?php } ?>
		
		
<?php if($properties->getlocation()== "Urbank Velasco Ave, Pasig"){ ?>
		<div class="row">
			<div class="col-md-4">
				<h1>More Details</h1>
				<table class="table">
				<tr>
					<td>
						Name
					</td>
					<td>
						Suntrust Kirana
					</td>
				  </tr>
				  <tr>
					<td>
						Location
					</td>
					<td>
						Urbano Velasco Ave., Pasig City (near Pasig City Hall)
					</td>
				  </tr>
				  <tr>
					<td>
						THEME
					</td>
					<td>
						Modern Asian
					</td>
				  </tr>
				  <tr>
					<td>
						TOTAL LAND AREA
					</td>
					<td>
						7,083 sq.m.
					</td>
				  </tr> 
				  
				  <tr>
					<td>
						No. of Towers
					</td>
					<td>	
						3 towers					
					</td>				
				  </tr>	
				  <tr>
					<td>
						Estimated Saleable no. of units
					</td>
					<td>	
						592 units				
					</td>				
				  </tr>			
				</table>				
			</div>
			<div class="col-md-4">
				<img src="<?php echo linkbasepath; ?>images/kirana.jpg" class="img-responsive">
			</div>
			<div class="col-md-4">
				<iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=14.556314%2C%20121.088879&key=AIzaSyB06ZLhFV8_-OS6ZE9dj4Ynpo2tWXjUcHs"></iframe>
			</div>
		</div>
<?php } ?>

	<script>
		$(document).ready(function() {
			//carousel
		  $("#owl-example").owlCarousel();
		  
		  //colorbox
		  $(".group1").colorbox({
				rel:'group1',
				maxWidth:1070,
				// on open tago muna panotour kase nag coconflict, labas nlng uli pag close lightbox
				onOpen:function(){ $('.pantourDiv1').hide(); },
				onClosed :function(){ $('.pantourDiv1').show(); },			
			});		
		});
	</script>
		

