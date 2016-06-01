<?php 
	include("includes/header.php");
?>	
<div class="container mainBody">			
		<div class="row">
		  <div class="col-md-2">			
			<?php adminSideMenu(); ?>
		  </div>		  
		  <div class="col-md-10">	
			
				<div class="panel panel-default">
					<div class="panel-heading">
						Manage Email Notification				
					</div>
					  <div class="panel-body">
						  <!--div style="padding:20px 10px;">
							<a class="btn btn-default" href="manageEmailnotif.php?action=view" role="button">View All</a>
							<a class="btn btn-default" href="managePayment.php?action=add" role="button">Add</a>
							<a class="btn btn-default" href="manageEmailnotif.php?action=edit" role="button">Edit</a>
							<a class="btn btn-default" href="manageEmailnotif.php?action=delete" role="button">Delete</a>
						  </div-->
						<?php		
							if(isset($_GET['action'])){
								$action = $_GET['action'];
							}else{
								$action = "";
							}	

							switch ($action) {
								case "view"://home page
									include(rootpath . "view/autoemail/view.php");
									break;
								case "add":
									include(rootpath . "view/autoemail/add.php");
									break;
								case "edit":
									include(rootpath . "view/autoemail/edit.php");
									break;
								case "editpage":
									include(rootpath . "view/autoemail/editpage.php");
									break;
								case "delete":
									include(rootpath . "view/autoemail/delete.php");
									break;
								case "sendemail":
									include(rootpath . "view/autoemail/sendemail.php");
									break;
								default://default homepage if no set
									include(rootpath . "view/autoemail/edit.php");
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