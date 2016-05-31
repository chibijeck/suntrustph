<?php
	error_reporting(E_ERROR | E_PARSE); //force hide warning
	$toUpdateId = $_GET['id'];
	$properties = new properties();	
	$properties->selectOne($toUpdateId);
	
	if(isset($_POST['submitProperties'])){		
		try { 				
			
			
			//settings
			$uniqName =  'img_' . date('Y-m-d-H-i-s') . '_' . uniqid();
			$uploadPath = 'images/upload';
			$uploadPathSmall = 'images/upload/small';
			
			
			//check if img field is set
			if(is_uploaded_file($_FILES['image_field']['tmp_name'])){
					
					//Delete first the old imgaes
					unlink('images/upload/small/'. $properties->getimg_name());				
					unlink('images/upload/'. $properties->getimg_name());
					 
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
					
					//update new name
					$properties->setimg_name($handle->file_dst_name);					
			}else{
				//retain sa dati
				$properties->setimg_name($properties->getimg_name());			
			}			 
			
		
			//inesrt sa DB
			$properties->setpanotour($_POST["panotour"]);  
			$properties->settitle($_POST["title"]);  
		  
			$properties->setunit_type($_POST["unit_type"]);  
			$properties->setlocation($_POST["location"]);  
			$properties->setprice($_POST["price"]);  
			$properties->setstatus($_POST["status"]);  
			$properties->setcreated_at(date('Y-m-d H:i:s'));  
		
			
			$properties->update($toUpdateId);	
			?>		
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  <strong>Successfully updated <?php echo $properties->gettitle(); ?> </strong>
			</div>
			<?php
			} catch (Exception $e) {
				echo $e->getMessage(); 		
		}				
	}		
 ?>
        
<!-- /.row -->
<div class="row">
	<div class="col-lg-7">
		<h2>EDIT <?php echo $properties->gettitle(); ?> </h2>

			<form role="form" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" data-toggle="validator" enctype="multipart/form-data">		
			  
				<div class="form-group">
					<label for="exampleInputEmail1">Panotour Name *</label>
					<input value="<?php echo $properties->getpanotour(); ?>" type="text" class="form-control"  name="panotour" placeholder="panotour file name"  data-error="Username is Required" required>
					<div class="help-block with-errors">
					Note: Input only the name of the file not including ".html" </br>
					Generated file of the panotour must be uploaded in \www\panotour\
					</div>
				</div>			
				<hr>
				 <div class="form-group">
						<img src="images/upload/small/<?php echo $properties->getimg_name(); ?>" width="200"></br>
						<label for="exampleInputFile">Thumbnail Image *</label>
						<input type="file"  name="image_field" id="exampleInputFile">
						<p class="help-block">Upload Image File Here</p>
				  </div>
				<hr>		
				<div class="form-group">
					<label for="exampleInputEmail1">Title</label>						
					<input value="<?php echo $properties->gettitle(); ?>" type="text" class="form-control"  name="title" placeholder="Full Name">					
				</div>						
	
				<div class="form-group">
					<label for="exampleInputEmail1">Unit Type</label>							
					<select  class="form-control" name="unit_type"  >				
							<option <?php if( $properties->getunit_type() == 'Studio' ){ ?> selected="selected" <?php } ?> value="Studio">Studio</option>
							<option <?php if( $properties->getunit_type() == '1 Bedroom' ){ ?> selected="selected" <?php } ?> value="1 Bedroom">1 Bedroom</option>
							<option <?php if( $properties->getunit_type() == '2 Bedroom' ){ ?> selected="selected" <?php } ?> value="2 Bedroom">2 Bedroom</option>
					</select>								
				</div> 								

				<div class="form-group">
					<label for="exampleInputEmail1">Location</label>							
					<select  class="form-control" name="location" >				
									<option value="Sta.Ana, Manila" <?php if( $properties->getlocation() == 'Sta.Ana, Manila' ){ ?> selected="selected" <?php } ?>>
											Sta.Ana, Manila
										</option>	
										<option value="Ermita, Manila 1" <?php if( $properties->getlocation() == 'Ermita, Manila 1' ){ ?> selected="selected" <?php } ?>>
											Ermita, Manila 1
										</option>	
										<option value="Ermita, Manila 2" <?php if( $properties->getlocation() == 'Ermita, Manila 2' ){ ?> selected="selected" <?php } ?>>
											Ermita, Manila 2
										</option>		
										<option value="Urbank Velasco Ave, Pasig" <?php if( $properties->getlocation() == 'Urbank Velasco Ave, Pasig' ){ ?> selected="selected" <?php } ?>>
											Urbank Velasco Ave, Pasig
										</option>	
					</select>								
				</div> 	
				
				<div class="form-group">
					<label for="exampleInputEmail1" >Price</label>						
					<input value="<?php echo $properties->getprice(); ?>" type="text" class="form-control"  name="price" placeholder="">
					<p class="help-block">Note:dont use any comma, Example of correct input is 4500000</p>					
				</div>	
				
				
				<div class="form-group">
					<label for="exampleInputEmail1">Status</label>							
					<select  class="form-control" name="status" >				
						<option value="Available" <?php if( $properties->getstatus() == 'Available' ){ ?> selected="selected" <?php } ?>>
							Available
						</option>	
						<option value="Reserved" <?php if( $properties->getstatus() == 'Reserved' ){ ?> selected="selected" <?php } ?>>
							Reserved
						</option>	
						<option value="Sold" <?php if( $properties->getstatus() == 'Sold' ){ ?> selected="selected" <?php } ?>>
							Sold
						</option>											
					</select>								
				</div> 		
			
				
				
				<button type="submit" class="btn btn-default" name="submitProperties" >Submit</button>
			</form>			
	</div>	
	
<!-- ****************************************************IMAGE Gallery STarts Here ******************************-->
	<div class="col-lg-5">	
		<?php include('view/properties/manageGallery.php') ?>
	</div>
</div>

<script>
$(function() {

});
</script>
