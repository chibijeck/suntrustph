
	<?php 	
		$gallery = new gallery();
		$propertyId = $_GET["id"];
		
		//************ Add Function
		if(isset($_POST['addGallerySubmit'])){
		
			//settings
			$uniqName =  'img_' . date('Y-m-d-H-i-s') . '_' . uniqid();
			$uploadPath = 'images/upload';
			$uploadPathSmall = 'images/upload/small';
			
			//image upload
			$handle = new upload($_FILES['image_fieldGallery']);	  
			if ($handle->uploaded) {
				$handle->file_new_name_body = $uniqName;
				$handle->image_convert         = 'jpg';
				// $handle->jpeg_quality          = 50;
				$handle->process($uploadPath);		
			  if ($handle->processed) {
			  } else {
				  // echo 'error : ' . $handle->error;
			  }
			}
				
			//image upload Small Folder
			$small = new upload($_FILES['image_fieldGallery']);	
			if ($small->uploaded) {
			  $small->file_new_name_body = $uniqName;
			  $small->image_convert         = 'jpg';
			  $small->image_resize         = true;
			  $small->image_x              = 300;
			  $small->image_y              = 300;
			  $small->image_ratio_y        = true;
			  $small->process($uploadPathSmall);		
			  if ($small->processed) {				
				  $small->clean();
			  } else {
				  // echo 'error : ' . $small->error;
				  }
			}			
			
			
			$gallery->settitle($_POST["title"]);  
			$gallery->setproperties_id($propertyId);
			$gallery->setimg_name($handle->file_dst_name);			
			$gallery->setarrangement($_POST["arrangement"]);
			$gallery->insert();	
				?>		
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  <strong>Successfully Added</strong>
			</div>
			<?php
		}

		//************ Delete Function
		if(isset($_POST['deleteGallerySubmit'])){
			//small delete
			unlink('images/upload/small/'. $_POST['deleteThisImg']);				
			//normal img delete
			unlink('images/upload/'. $_POST['deleteThisImg']);
			
			$gallery->selectOne($_POST['deleteThisId']);							
			$gallery->delete($_POST['deleteThisId']);			
			?>		
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  <strong>Successfully Deleted </strong>
			</div>
			<?php		
		}
		
		//************ Edit Function
		if(isset($_POST['editGallerySubmit'])){
			if(is_uploaded_file($_FILES['image_fieldGalleryedit']['tmp_name'])){
				//Delete first the old imgaes
				unlink('images/upload/small/'. $_POST["oldimg_name"]);				
				unlink('images/upload/'. $_POST["oldimg_name"]);
					 
				
				//settings
				$uniqName =  'img_' . date('Y-m-d-H-i-s') . '_' . uniqid();
				$uploadPath = 'images/upload';
				$uploadPathSmall = 'images/upload/small';
				
				//image upload
				$handle = new upload($_FILES['image_fieldGalleryedit']);	  
				if ($handle->uploaded) {
					$handle->file_new_name_body = $uniqName;
					$handle->image_convert         = 'jpg';					
					$handle->process($uploadPath);		
				  if ($handle->processed) {
				  } else {					  
				  }
				}
					
				//image upload Small Folder
				$small = new upload($_FILES['image_fieldGalleryedit']);	
				if ($small->uploaded) {
				  $small->file_new_name_body = $uniqName;
				  $small->image_convert         = 'jpg';
				  $small->image_resize         = true;
				  $small->image_x              = 300;
				  $small->image_y              = 300;
				  $small->image_ratio_y        = true;
				  $small->process($uploadPathSmall);		
				  if ($small->processed) {				
					  $small->clean();
				  } else {					 
					  }
				}		
				
				$gallery->setimg_name($handle->file_dst_name);		
			}else{
				//retain sa dati
				$gallery->setimg_name($_POST["oldimg_name"]);				
			}			 	
		
		
			$gallery->settitle($_POST["title"]);  
			$gallery->setproperties_id($propertyId);
				
			
			
			$gallery->setarrangement($_POST["arrangement"]);
			
			$gallery->update($_POST["toeditImageId"]);	
				?>		
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  <strong>Successfully Updated</strong>
			</div>
			<?php
		}
		
	?>	
		<h2>Image Gallery 		
		<!-- Add Image -->
			<button type="button" class="btn btn-default" data-toggle="modal" data-target="#addGalModal">Add New Image</button>	
		</h2>		
		<div class="modal fade" id="addGalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <form method="post" id="delete" action="<?php echo $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data" >
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">Add New Image</h4>
				  </div>
				  <div class="modal-body">

					 <div class="form-group">
							<label for="exampleInputFile">Thumbnail Image *</label>
							<input type="file"  name="image_fieldGallery" id="exampleInputFile" required>
							<p class="help-block">Upload Image File Here</p>
					  </div>
					  
					  
						<div class="form-group">
							<label for="exampleInputEmail1">Title</label>
							<input type="text" class="form-control"  name="title" placeholder="title">
						</div>
						
						<div class="form-group">
							<label for="exampleInputEmail1">Arrangement</label>
							<input type="text" class="form-control"  name="arrangement" placeholder="Number for sorting">
						</div>			
					
					
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>			
					<button type="submit" name="addGallerySubmit" class="btn btn-primary">Submit</button>																
				  </div>
				</div>
			  </div>
		  </form>
		</div>
		<!-- View Starts Here -->		
		<table class="table">
			<thead>
				<tr>
					<th width="100"> IMG      </th>
					<th>Title          </th>
					<th width="30">Ordering</th>
					<th>  </th>
																						
				</tr>
			</thead>
			<tbody>
			<?php 		
				
				$gallery = $gallery->selectAll('WHERE properties_id = '. $propertyId .' ORDER BY arrangement');	
				foreach($gallery as $row){	
				?>
				<tr>
					<td><img src="images/upload/small/<?php echo $row->getimg_name(); ?>" class="img-responsive" width="100"></td>		
					<td><?php echo $row->gettitle(); ?></td>		
					<td><?php echo $row->getarrangement(); ?></td>		
					<td>
					
					<!-- Edit Starts Here -->	
					<button type="button" class="btn btn-success padding5" data-toggle="modal" data-target="#editModal<?php echo $row->getid(); ?>">Edit</button>											
						
					<!-- Edit Ends Here -->	
					<div class="modal fade" id="editModal<?php echo $row->getid(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <form method="post" id="edit" action="<?php echo $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data" >
						  <div class="modal-dialog">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title" id="myModalLabel">Edit <?php echo $row->gettitle(); ?></h4>
							  </div>
							  <div class="modal-body">

								 <div class="form-group">
									<img src="images/upload/small/<?php echo $row->getimg_name(); ?>" width="200"></br>
										<label for="exampleInputFile">Image *</label>
										<input type="file"  name="image_fieldGalleryedit" id="exampleInputFile">
									
								  </div>
								  
								  
									<div class="form-group">
										<label for="exampleInputEmail1">Title</label>
										<input type="text" class="form-control" value="<?php echo $row->gettitle(); ?>"  name="title" placeholder="title">
									</div>
									
									<div class="form-group">
										<label for="exampleInputEmail1">Arrangement</label>
										<input type="text" class="form-control" value="<?php echo $row->getarrangement(); ?>" name="arrangement" placeholder="Number for sorting">
									</div>			
								
									<input type="hidden" class="form-control" value="<?php echo $row->getid(); ?>" name="toeditImageId" placeholder="Number for sorting">
									<input type="hidden" class="form-control" value="<?php echo $row->getimg_name(); ?>" name="oldimg_name" placeholder="Number for sorting">
								
							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>			
								<button type="submit" name="editGallerySubmit" class="btn btn-primary">Update</button>																
							  </div>
							</div>
						  </div>
					  </form>
					</div>
					
					
					
					
					
					
					
					
					
					<!-- Delete Starts Here -->	
						<button type="button" class="btn btn-danger padding5" data-toggle="modal" data-target="#deleteModal<?php echo $row->getid(); ?>">Delete</button>											
							<div class="modal fade" id="deleteModal<?php echo $row->getid(); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <form method="post" id="delete" action="<?php echo $_SERVER['REQUEST_URI'] ?>" >
								  <div class="modal-dialog">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
										<h4 class="modal-title" id="myModalLabel">Are you sure you want to delete <?php echo $row->gettitle(); ?>?</h4>
									  </div>
									  
									  
									 <input type="hidden" name="deleteThisImg" value="<?php echo $row->getimg_name(); ?>">
									 <input type="hidden" name="deleteThisId" value="<?php echo $row->getid(); ?>">
									  <div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>				
									
										<button type="submit" name="deleteGallerySubmit" class="btn btn-primary">Delete</button>																
									  </div>
									</div>
								  </div>
							  </form>
							</div>
						<!-- Delete End Here -->	
					
					
					
					
					
					</td>		
				</tr>
			<?php } ?>
			</tbody>
		</table>
		
		
		

		
		
