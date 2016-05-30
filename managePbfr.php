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
						Manage Properties Building Floor Room	 		
					</div>
					  <div class="panel-body">
						  <div style="padding:20px 10px;">
							<a class="btn btn-default" href="managePbfr.php?action=view&id=<?php echo $_GET['id']; ?>" role="button">View All</a>
							<a class="btn btn-default" href="managePbfr.php?action=add&id=<?php echo $_GET['id']; ?>"" role="button">Add</a>
							<a class="btn btn-default" href="managePbfr.php?action=edit&id=<?php echo $_GET['id']; ?>"" role="button">Edit</a>
							<a class="btn btn-default" href="managePbfr.php?action=delete&id=<?php echo $_GET['id']; ?>"" role="button">Delete</a>
						  </div>
						<?php		
							if(isset($_GET['action'])){
								$action = $_GET['action'];
							}else{
								$action = "";
							}	

							switch ($action) {
								case "view"://home page
									include(rootpath . "view/pbfr/view.php");
									break;
								case "add":
									include(rootpath . "view/pbfr/add.php");
									break;
								case "edit":
									include(rootpath . "view/pbfr/edit.php");
									break;
								case "editpage":
									include(rootpath . "view/pbfr/editpage.php");
									break;
								case "delete":
									include(rootpath . "view/pbfr/delete.php");
									break;
								default://default homepage if no set
									include(rootpath . "view/pbfr/view.php");
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