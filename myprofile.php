<?php 
	include("includes/header.php");
?>
	
	<div class="container mainBody">
			
			<div class="row">
			  <div class="col-md-2">
				<div class="panel panel-default">					
					<div class="panel-body">
						<ul class="nav nav-pills nav-stacked">
							 <li><a href="myprofile.php">Profile</a></li>
							 <li><a href="myprofile.php?action=ticket">Ticket</a></li>
							 <li><a href="myprofile.php?action=payment">Payment</a></li>				 
						 	 <li><a href="myprofile.php?action=transaction">Transactions</a></li>
						</ul>
					</div>
				</div>
				  
			  </div>
			  <div class="col-md-10">
			  	<div class="panel panel-default">
				  <div class="panel-heading"><h3>My Profile</h3></div>
				  <div class="panel-body">					
					<?php		
							if(isset($_GET['action'])){
								$action = $_GET['action'];
							}else{
								$action = "";
							}	

							switch ($action) {
								case "view":
									include(rootpath . "view/myprofile/view.php");
									break;	
								case "editpage":
									include(rootpath . "view/myprofile/editpage.php");
									break;
								case "ticket":
									include(rootpath . "view/myprofile/ticket.php");
									break;
								case "payment":
									include(rootpath . "view/myprofile/payment.php");
									break;
								case "transaction":
									include(rootpath . "view/myprofile/transactions.php");
									break;
								case "editpagepayment":
									include(rootpath . "view/myprofile/editpagepayment.php");
									break;									
								default://default homepage if no set
									include(rootpath . "view/myprofile/view.php");
							}
						?>	
				  </div>
				</div>			  
			  </div>
			</div>
	
	</div>
	
	
	

<?php
	include("includes/footer.php");
?>