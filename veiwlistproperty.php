<?php 
	include("includes/header.php");
?>	
	<script>		
		$(function() {
			$( ".searchFilterButton" ).click(function() {				
				statusFilter = $('.statusFilter').val();
				bldgFilter = $('.bldgFilter').val();
				window.location = "/veiwlistproperty.php?status=" + statusFilter + "&bldg=" + bldgFilter;
			});
			$( ".clearFilterButton" ).click(function() {				
				window.location = "/veiwlistproperty.php";
			});
		});
	</script>
	<div class="container mainBody">
	<!-- <form method="POST"> -->
		<div class="row">
			<div class="col-md-4">
			Filter by:
				<select class="form-control statusFilter" placeholder=".input-sm">
							<option value="">
								Availability
							</option>	
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
			<div class="col-md-4">
			<br>
				<select class="form-control bldgFilter" placeholder=".input-sm">
							<option value="">
								Project
							</option>	
							<option value="Ascentia">
								Suntrust Ascentia
							</option>	
							<option value="Kirana">
								Suntrust Kirana
							</option>	
							<option value="Parkview">
								Suntrust Parkview
							</option>
				</select>
			</div>
			<div class="col-md-1">
				<br>
				<button type="button" class="btn btn-default searchFilterButton">							
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span> Submit
				</button>
			</div>
			<div class="col-md-1">
				<br>
				<button type="button" class="btn btn-default clearFilterButton">							
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span> Clear
				</button>
			</div>
			<div class="col-md-6"></div>
		</div>
	<!-- </form> -->
		<br>
		<div class="row">		
			
				<?php 			
				$statusFilter = empty($_GET['status']) ? '' : $_GET['status'];
				$bldgFilter = empty($_GET['bldg']) ? '' : $_GET['bldg'];

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
				if(!empty($statusFilter) || !empty($bldgFilter)){
					$queryProperty .= "WHERE ";
				}
				if(!empty($statusFilter)){
					//$queryProperty .= "WHERE ";
					$queryProperty .= "status = '".$statusFilter."'";
				}
				if(!empty($statusFilter) && !empty($bldgFilter)){
					$queryProperty .= " AND ";
				}
				if(!empty($bldgFilter)){
					$queryProperty .= "title LIKE '%".$bldgFilter."%'";
				}

				$properties = $properties->selectAll( $queryProperty . " ORDER BY created_at DESC");

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