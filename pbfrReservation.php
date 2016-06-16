<?php 
	include("includes/header.php");
	$viewId = $_GET['id'];
	$properties = new properties();	
	$properties->selectOne($viewId);
	
	//for javascript and php mysql query
	$getBuilding = empty($_GET['building']) ? '""' : $_GET['building'];
	$getFloor = empty($_GET['floor']) ? '""' : $_GET['floor'];
	
?>	

<div class="container mainBody">
	<div class="row">	
		<div class="col-md-3">
				<img src="images/upload/<?php echo $properties->getimg_name(); ?>" class="img-responsive">
				
				<table class="table">
				  <tr>
					<td>
						Unit Type
					</td>
					<td>
						<?php echo $properties->getunit_type();?>
					</td>
				  </tr>
				  <tr>
					<td>
						Location
					</td>
					<td>
						<?php echo $properties->getlocation();?>
					</td>
				  </tr>
				  <tr>
					<td>
						Price
					</td>
					<td>
						 <?php echo pesoFormat($properties->getprice());?>
					</td>
				  </tr> 
				  <tr>
					<td>
						Status
					</td>
					<td>
						<span class="
						<?php if($properties->getstatus() == "Available"){
							echo "openStatus";
						}elseif($properties->getstatus() == "Reserved"){
							echo "reservedStatus";
						}else{
							echo "soldStatus";						
						}						
						?>						
						">
						 <?php echo $properties->getstatus()?>
						 <span>
					</td>
				  </tr>			
				</table>
		</div>		
		<div class="col-md-9">
			<h1><?php echo $properties->gettitle();?> Room Reservation</h1>
			<div class="row">	
				 <div class="col-md-5">
							Building
							<select class="form-control buildinPFilter" placeholder=".input-sm">								
								<?php 
									$pbfrBuilding = new pbfr();									
									$pbfrBuilding = $pbfrBuilding->selectAllFullQuery('SELECT DISTINCT building FROM pbfr WHERE status = 0 AND properties_id =' . $viewId . '');	
									foreach($pbfrBuilding as $row){	
								?>
										
								<option value="<?php echo $row->getbuilding();?>">
									<?php echo $row->getbuilding();?>
								</option>	
								<?php } ?>																		
							</select>
				  </div>
				<div class="col-md-5">
							Floor
							<select class="form-control floorPFilter" placeholder=".input-sm">										
										<?php 
											$pbfrFloor = new pbfr();									
											$pbfrFloor = $pbfrFloor->selectAllFullQuery('SELECT DISTINCT floor FROM pbfr WHERE status = 0 AND properties_id =' . $viewId . ' AND building = ' . $getBuilding);	
											foreach($pbfrFloor as $row){	
										?>
												
										<option value="<?php echo $row->getfloor();?>">
											<?php echo $row->getfloor();?>
										</option>	
									<?php } ?>																		
							</select>
				  </div>
					<div class="col-md-2">
						</br>
						<button type="button" class="btn btn-default pbfrFilter">							
							<span class="glyphicon glyphicon-search" aria-hidden="true"></span> Filter
						</button>
				  </div>				  
			</div>
			</br>
			Please select a room and click the button to send an reservation request.
			<?php 		
				
				$pbfrRoom = new pbfr();									
				$pbfrRoom = $pbfrRoom->selectAllFullQuery('SELECT* FROM pbfr WHERE status = 0 AND properties_id =' . $viewId . ' AND building = ' . $getBuilding . ' AND floor = ' . $getFloor . ' ORDER BY room ASC');	
				foreach($pbfrRoom as $row){	
			?>				
			<form role="form" method="post" action="pbfrReservationProcess.php">	
				<input type="hidden" value="<?php echo $row->getid();?>" name="pbfrId">
				<input type="hidden" value="<?php echo $viewId; ?>" name="propertyId">
				<input  name="submitReserve" class="btn btn-primary  btn-lg btnRoomPbfrD" type="submit" value="Unit <?php echo $row->getroom();?>"
					<?php if($row->getstatus() == 1){ echo 'disabled="disabled"'; }?>
				>
			</form>
			<?php } ?>				
		</div>			
	</div>			
</div>		


<script>		
$(function() {  
   function changeVal(){
		buildinPFilter = $('.buildinPFilter').val();
		floorPFilter = $('.floorPFilter').val();
		window.location = "pbfrReservation.php?id=<?php echo $viewId; ?>&building=" + buildinPFilter +
						"&floor=" + floorPFilter;
   
   }

	//Upon Page load, Check first if value for filter is set.
	$('select.buildinPFilter').val('<?php echo $getBuilding;?>');				
	$('select.floorPFilter').val('<?php echo $getFloor;?>');				
	
	//Event Handler
	$( ".pbfrFilter" ).click(function() {				
		changeVal();
	});		
	
	$( ".buildinPFilter" ).change(function() {
	  changeVal();
	});	
	
	$( ".floorPFilter" ).change(function() {
	  changeVal();
	});		
	
});
</script>

<?php
	include("includes/footer.php");	
?>
	