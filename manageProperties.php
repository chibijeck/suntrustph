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
						Manage Properties				
					</div>
					  <div class="panel-body">
						  <div style="padding:20px 10px;">
							<a class="btn btn-default" href="manageProperties.php?action=view" role="button">View All</a>
							<a class="btn btn-default" href="manageProperties.php?action=add" role="button">Add</a>
							<a class="btn btn-default" href="manageProperties.php?action=edit" role="button">Edit</a>
							<a class="btn btn-default" href="manageProperties.php?action=delete" role="button">Delete</a>
							<a class="btn btn-default" href="manageProperties.php?action=viewPbfr" role="button">Manage Properties Building Floor Room</a>
						  </div>
						<?php		
							if(isset($_GET['action'])){
								$action = $_GET['action'];
							}else{
								$action = "";
							}	

							switch ($action) {
								case "view"://home page
									include(rootpath . "view/properties/view.php");
									break;
								case "add":
									include(rootpath . "view/properties/add.php");
									break;
								case "edit":
									include(rootpath . "view/properties/edit.php");
									break;
								case "editpage":
									include(rootpath . "view/properties/editpage.php");
									break;
								case "viewPageProperties":
									include(rootpath . "view/properties/viewPageProperties.php");
									break;
								case "delete":
									include(rootpath . "view/properties/delete.php");
									break;
								case "viewPbfr":
									include(rootpath . "view/properties/viewPbfr.php");
									break;
								default://default homepage if no set
									include(rootpath . "view/properties/view.php");
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