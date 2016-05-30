<?php 
	include("includes/header.php");
?>	

	<div class="container mainBody">		
		<div class="row">		
			
				<?php 			
				
				$properties = new properties();	
				
				//filter query starts here
				 $unitType = empty($_GET['unitType']) ? '' : $_GET['unitType'];
				 $location = empty($_GET['location']) ? '' : $_GET['location'];
				 $price = empty($_GET['price']) ? '' : $_GET['price'];
				
				//queryBuilder
				if($unitType != '' || $location != '' || $price != '' ){
					$queryProperty = 'WHERE';
				}else{
					$queryProperty = '';
				}
				
				//if unit type is not empty, add this filter
				
				//*** Unit Type ***//
				if($unitType != ''){
					$queryProperty .= ' unit_type = "' . $unitType . '"';
				}
				
				//*** Location ***//
				if($location != ''){
					if($unitType != ''){
						$queryProperty .= ' AND';
					}				
					$queryProperty .= ' location = "' . $location . '"';
				}	

				//*** Price ***//
				if($price != ''){
						// //case1 unit=set location=unset
						// if($unitType != '' && $location == ''){
							// //case 2 unit=set location=set
							// $queryProperty .= ' AND';							
						// }	
						// //case 2 unit=unset location=set
						// if($unitType == '' && $location != ''){
							// //case 2 unit=set location=set
							// $queryProperty .= ' AND';							
						// }
						// //case 3 unit=set location=set
						// if($unitType != '' && $location != ''){
							// //case 2 unit=set location=set
							// $queryProperty .= ' AND';							
						// }					
				
						if($unitType != '' || $location != ''){							
							$queryProperty .= ' AND';							
						}				
				
				
						switch ($price) {
							case "500K - 1M":
								$queryProperty .= ' price BETWEEN 500000 AND 1000000';
								break;
							case "1M - 2M":
								$queryProperty .= ' price BETWEEN 1000000 AND 2000000';
								break;
							case "2M - 3M":
								$queryProperty .= ' price BETWEEN 2000000 AND 3000000';
								break;
							case "3M - 4M":
								$queryProperty .= ' price BETWEEN 3000000 AND 4000000';
								break;
							case "4M - 5M":
								$queryProperty .= ' price BETWEEN 4000000 AND 5000000';
								break;
							default:
								$queryProperty .= ' price BETWEEN 5000000 AND 1000000';
						}				
				}	
				
				$properties = $properties->selectAll( $queryProperty . ' ORDER BY created_at DESC');
				if(count($properties) != 0){
					foreach($properties as $row){
					?>
					<div class="col-md-3">
						<a href="viewProperty.php?action=viewPageProperties&id=<?php echo $row->getid(); ?>" class="propertiesList">		
							<img src="images/upload/small/<?php echo $row->getimg_name(); ?>" class="img-responsive">
							<table class="table table-striped">
							  <tr>
								<td>Title	 </td> <td><?php echo $row->gettitle(); ?></td>
							  </tr><tr>
								<td>Unit Type </td> <td><?php echo $row->getunit_type(); ?></td>
							  </tr><tr>
								<td>Location  </td> <td><?php echo $row->getlocation(); ?></td>
							  </tr><tr>
								<td>Price	  </td> <td><?php echo pesoFormat($row->getprice()); ?></td>
							</tr>
							<tr>
								<td>
									Status
								</td>
								<td>
									<span class="
									<?php if($row->getstatus() == "Available"){
										echo "openStatus";
									}elseif($row->getstatus() == "Reserved"){
										echo "reservedStatus";
									}else{
										echo "soldStatus";						
									}						
									?>						
									">
									 <?php echo $row->getstatus()?>
									 <span>
								</td>
							  </tr>
							</table>
						</a>
					
					</div>				
					<?php }
				
				}else{	?>
				
				<p style="padding:20px;" class="bg-danger">No Property Found</p>
				<?php }	?>
				
		</div>
	</div>
	<script>
	
	</script>
<?php
	include("includes/footer.php");
?>