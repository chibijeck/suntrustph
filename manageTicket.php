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
						Manage Ticket				
					</div>
					  <div class="panel-body">
						  <div style="padding:20px 10px;">
							<a class="btn btn-default" href="manageTicket.php?action=view" role="button">View All</a>
							<!--a class="btn btn-default" href="manageTicket.php?action=add" role="button">Add</a-->
							<a class="btn btn-default" href="manageTicket.php?action=edit" role="button">Edit</a>
							<a class="btn btn-default" href="manageTicket.php?action=delete" role="button">Delete</a>
						  </div>
						<?php		
							if(isset($_GET['action'])){
								$action = $_GET['action'];
							}else{
								$action = "";
							}	

							switch ($action) {
								case "view"://home page
									include(rootpath . "view/ticket/view.php");
									break;
								case "add":
									include(rootpath . "view/ticket/add.php");
									break;
								case "edit":
									include(rootpath . "view/ticket/edit.php");
									break;
								case "editpage":
									include(rootpath . "view/ticket/editpage.php");
									break;
								case "delete":
									include(rootpath . "view/ticket/delete.php");
									break;
								default://default homepage if no set
									include(rootpath . "view/ticket/view.php");
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