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
						Reports				
					</div>
					  <div class="panel-body">
						 <div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>Property Id       </th>
											<th>Title     </th>
											<th>Unit Type     </th>
											<th>Building     </th>
											<th>Floor     </th>
											<th>Status     </th>
											<th>Counts     </th>
											<th>Status     </th>
										</tr>
									</thead>
									<tbody> 
										<?php 
											$property = new properties();									
											$report = $property->countProperties();
											//var_dump($property);
											//exit();
											foreach($report as $row){	
											?>
										<tr <?php echo colorForRowTicket($row->status); ?>>
											<td><?php echo $row->properties_id; ?></td>
											<?php 
												$title = $property->getTitleName($row->properties_id);
												//var_dump($title->title);
											?>
											<td><?php if(!empty($title)){echo $title->title;} ?></td>
											<td><?php if(!empty($title)){echo $title->unit_type;} ?></td>
											<td><?php echo $row->building; ?></td>							
											<td><?php echo $row->floor; ?></td>						
											<td><?php echo ticketDisplay($row->status); ?></td>						
											<td><?php echo $row->count ?></td>						
											<td><?php if(!empty($title)){echo $title->status;} ?></td>
										</tr>
													
										<?php
											}
											?>																					
									
									</tbody>
								</table>
							</div>
																			
					  </div>
				</div>	
		  </div>
		</div>	
</div>

<?php
	include("includes/footer.php");
?>