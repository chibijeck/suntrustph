<?php 
	include("includes/header.php");
?>	
	<script>		
		$(function() {
			$( ".commissionStatusBtn" ).click(function() {				
				commissionStatusBtn = $('.commissionStatusBtn').val();
				window.location = "/manageCommission.php?commissionStatus=" + commissionStatusBtn;
			});
		});
	</script>
<div class="container mainBody">			
		<div class="row">
		  <div class="col-md-2">			
			<?php adminSideMenu(); ?>
		  </div>		  
		  <div class="col-md-10">	
			
				<div class="panel panel-default">
					<div class="panel-heading">
						Manage Commissions				
					</div>
					  <div class="panel-body">
						  <div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											
											<th>Ticket ID</th>			
											<!-- <th>Property Id</th>			 -->
											<th>Property Title</th>
											<th>Sales Agent</th>			
											<!-- <th>Customer</th>			 -->
											<th>Total Contract Price</th>
											<th>Percentage</th>
											<th>Total</th>
											<th>Distributed in<br> 20 payouts</th>
											<th>Status</th>
											<!-- <th>Type of Payment  </th>
											<th>Last Update  </th>	 -->																
										</tr>
									</thead>
									<tbody>
										<?php 
										
											// $currentUserid = $_SESSION['user_id'];
											// $currentUsername = $_SESSION['username'];
											
											$ticket = new ticket();									
											//$ticket = $ticket->selectAll("WHERE agent = '".$currentUsername."'");
											$ticket = $ticket->selectAll('ORDER BY id DESC');
											echo $_SESSION['commissionStatus'] = empty($_GET['commissionStatus']) ? '' : $_GET['commissionStatus'];
											// echo "<pre>";
											// print_r($ticket);
											

											if(!empty($ticket)){
													foreach($ticket as $row){	
													?>
													<tr>
													
													<td>
														<a href="http://suntrustph.com/myprofile.php?action=commission&uname=<?php echo $row->getagent();?>&ticketId=<?php echo $row->getid();?>"><?php echo $row->getid();?></a>
													</td>
													<!-- <td>
														<?php echo $row->getproperties_id();?>								
													</td> -->
													
													<td>
														<?php 	
															$properties = new properties();	
															$properties->selectOne($row->getproperties_id());							
															echo $properties->gettitle();				
														?>
													</td>
													<td>
														<a href="http://suntrustph.com/myprofile.php?action=commission&uname=<?php echo $row->getagent();?>">
															<?php echo $row->getagent();?>
														</a>
													</td>							
													<!-- <td>
														<?php echo $row->getcustomer();?>								
													</td>	 -->						
													<td><?php echo pesoFormat($properties->getprice()); ?></td>
													
													<td><?php echo "1.5%"; ?></td>							
													<td><?php 
														$totalCommission = $properties->getprice() * (1.5/100); 
														echo pesoFormat($totalCommission); ?>
													</td>							
													<td><?php $payouts = $totalCommission/20; 
														echo pesoFormat($payouts);?></td>
													<td>
														<button type="button" class="btn btn-<?php echo commissionColorBtn($row->getstatus());?>">	
															<?php echo commissionStatus($row->getstatus());?>
														</button>
													</td>	
													<!-- <td>
														<button type="button" class="btn btn-primary startCommissionButton">Start</button>
													</td>	 -->
													
												</tr>			
												<?php
													}
										}else{ ?>
												<div class="alert alert-danger alert-dismissible" role="alert">
												  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
												  <strong>There is no payment associated to your account. </strong>
												</div>
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