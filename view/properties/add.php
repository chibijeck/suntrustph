<?php
	error_reporting(E_ERROR | E_PARSE); //force hide warning
	$properties = new properties();	
	if(isset($_POST['submitUser'])){		
		try { 		
			//image is requred
			 // if(!is_uploaded_file($_FILES['image_field']['tmp_name'])){				
				// throw new Exception('		 
					// <div class="alert alert-danger alert-dismissible" role="alert">
					  // <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					  // <strong>Image is Required</strong>
					// </div>'
				// );		 	
			 // }
			
			//settings
			$uniqName =  'img_' . date('Y-m-d-H-i-s') . '_' . uniqid();
			$uploadPath = 'images/upload';
			$uploadPathSmall = 'images/upload/small';
			
			//image upload
			$handle = new upload($_FILES['image_field']);	  
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
			$small = new upload($_FILES['image_field']);	
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
		
			//inesrt sa DB
			$properties->setpanotour($_POST["panotour"]);  
			$properties->settitle($_POST["title"]);  
			$properties->setimg_name($handle->file_dst_name);  
			$properties->setunit_type($_POST["unit_type"]);  
			$properties->setlocation($_POST["location"]);  
			$properties->setprice($_POST["price"]);  
			$properties->setstatus($_POST["status"]);  
			$properties->setcreated_at(date('Y-m-d H:i:s'));  
		
			
			$properties->insert();	
			?>		
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  <strong>Successfully Added</strong>
			</div>
			<?php
			} catch (Exception $e) {
				echo $e->getMessage(); 		
		}				
	}		
 ?>
        
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<h2>ADD NEW PROPERTIES</h2>

			<form role="form" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" data-toggle="validator" enctype="multipart/form-data">		
			  
				<div class="form-group">
					<label for="exampleInputEmail1">Panotour Name *</label>
					<input type="text" class="form-control"  name="panotour" placeholder="panotour file name"  data-error="Username is Required" required>
					<div class="help-block with-errors">
					Note: Input only the name of the file not including ".html" </br>
					Generated file of the panotour must be uploaded in \www\panotour\
					</div>
				</div>			
				<hr>
				 <div class="form-group">
						<label for="exampleInputFile">Thumbnail Image *</label>
						<input type="file"  name="image_field" id="exampleInputFile" required>
						<p class="help-block">Upload Image File Here</p>
				  </div>
				<hr>		
				<div class="form-group">
					<label for="exampleInputEmail1">Title</label>						
					<input type="text" class="form-control"  name="title" placeholder="Full Name">					
				</div>						
	
				<div class="form-group">
					<label for="exampleInputEmail1">Unit Type</label>							
					<select  class="form-control" name="unit_type" >				
							<option value="Studio">Studio</option>
							<option value="1 Bedroom">1 Bedroom</option>
							<option value="2 Bedroom">2 Bedroom</option>
					</select>								
				</div> 								

				<div class="form-group">
					<label for="exampleInputEmail1">Location</label>							
					<select  class="form-control" name="location" >				
									<option value="Sta.Ana, Manila">
											Sta.Ana, Manila
										</option>	
										<option value="Ermita, Manila 1">
											Ermita, Manila 1
										</option>	
										<option value="Ermita, Manila 2">
											Ermita, Manila 2
										</option>		
										<option value="Urbank Velasco Ave, Pasig">
											Urbank Velasco Ave, Pasig
										</option>	
					</select>								
				</div> 	
				
				<div class="form-group">
					<label for="exampleInputEmail1">Price</label>						
					<input type="text" class="form-control"  name="price" placeholder="">
					<p class="help-block">Note:dont use any comma, Example of correct input is 4500000</p>					
				</div>	
				
				
				<div class="form-group">
					<label for="exampleInputEmail1">Status</label>							
					<select  class="form-control" name="status" >				
						<option value="Available">
							Available
						</option>	
						<option value="Reserved">
							Reserved
						</option>	
						<option value="Sold">
							Sold
						</option>											
					</select>								
				</div> 	
				
			
				
				
				<button type="submit" class="btn btn-default" name="submitUser" >Submit</button>
			</form>			
	</div>		 
</div>

<script>
$(function() {

});
</script>
