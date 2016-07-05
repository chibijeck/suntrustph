<h3>
Commissions
</h3>
<script>		
	$(function() {
		$( ".commissionStatusBtn" ).click(function() {				
			commissionStatus = $('.commissionStatus').val();
			window.location = "/myprofile.php?action=commission&uname=<?php echo $_GET['uname'];?>&ticketId=<?php echo $_GET['ticketId'];?>&commissionStatus=" + commissionStatus;
		});
	});
</script>
<div class="table-responsive">
	<table class="table table-bordered table-hover">
	<?php 
		if(!empty($_GET['ticketId'])){
				$ticket = new ticket();									
				$ticket->selectOne($_GET['ticketId']);
				$properties = new properties();	
				$properties->selectOne($ticket->getproperties_id());
				if($ticket->getstatus() != 0 && $_GET['uname'] != $_SESSION['username']){
			?>
			<div class="row">
				<div class="col-sm-4">
					<select class="form-control commissionStatus" placeholder=".input-sm">
								<option value="2">
									Start
								</option>
								<option value="1">
									Hold
								</option>
					</select>
				</div>
				<div class="col-sm-1">
					<button type="button" class="btn btn-default commissionStatusBtn">Submit</button>
				</div>
			</div>
			<?php } ?>
			<thead>
				<tr>
					<th>#</th>
					<th>Date</th>
					<th>Payout</th>
					<th>Remarks</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$number_of_dates = 20;
			$startDate = explode(" ", $ticket->getcreated_at());
			$startDate = explode("-", $startDate[0]);
			//var_dump($startDate[0]);
			$startDate = mktime(0, 0, 0, $startDate[1], $startDate[2], $startDate[0]); // june 26, 2016
			echo "<b>Ticket #: " . $_GET['ticketId']. "</b> Status: <b>" . commissionStatus($ticket->getstatus()) ."</b>";
			echo "</br>Down Payment Received: ". $ticket->getcreated_at();
			echo "</br>Contract Price: ". pesoFormat($properties->getprice());
			$totalCommission = $properties->getprice() * (1.5/100); 
			echo "</br>Total Commission: ".pesoFormat($totalCommission); 
			$ctr = 1;
			$totalPayouts = 0;
			for ($i = 0; $i < $number_of_dates; $i++) {
			   $date = strtotime('Wednesday +' . ($i) . ' weeks', $startDate);
			   ?>
				<tr>
				<td><?php echo $ctr; $ctr++;?></td>
				<td><?php echo date('m-d-Y', $date). "<br>".PHP_EOL;?></td>
				<td><?php
						
					$totalCommission = $properties->getprice() * (1.5/100); 
					$payouts = $totalCommission/20; 
					echo pesoFormat($payouts);?>
				</td>
				<td>
					<?php if( $date <= mktime(0, 0, 0, date('m'), date('d'), date('Y')) ){ 
								$totalPayouts += $payouts; ?>
								<a class="btn btn-success" href="#" role="button">RECEIVED</a>
						<?php
						}else{ 
							if($ticket->getstatus() == 1){
						?>		<a class="btn btn-danger" href="#" role="button">HOLD</a>
						<?php 
							}else{ 
						?>		<a class="btn btn-warning" href="#" role="button">WAITING</a>
					<?php 	}
						}	
					?>
				</td>	
				</tr>
			   <?php
			}
			echo "<br>Total Received: ". pesoFormat($totalPayouts);
			$totalPending = $totalCommission - $totalPayouts;
			echo "<br>Total Pending: ". pesoFormat($totalPending);
			
			if(!empty($_GET['commissionStatus'])){
				$ticket->updateOne("status = ".$_GET['commissionStatus'], "id = ".$_GET['ticketId']);
				header("Location: /myprofile.php?action=commission&uname=".$_GET['uname']."&ticketId=".$_GET['ticketId']);
			}
		}else{
			
	?>
		<thead>
			<tr>
				<th>Ticket ID</th>			
				<!-- <th>Property Id</th>			 -->
				<th>Property Title</th>			
				<th>Customer</th>			
				<th>Total Contract Price</th>
				<th>Percentage</th>
				<th>Total</th>
				<th>Distributed in<br> 20 payouts</th>
				<th>Status</th>																
			</tr>
		</thead>
		<tbody>
			<?php 
				if(!empty($_GET['uname'])){
					$currentUsername = $_GET['uname'];
				}else{
					$currentUsername = $_SESSION['username'];
				}
				$currentUserid = $_SESSION['user_id'];
				
				$ticket = new ticket();									
				$ticket = $ticket->selectAll("WHERE agent = '".$currentUsername."' ORDER BY id DESC");
				// echo "<pre>";
				// print_r($ticket);

				if(!empty($ticket)){
						foreach($ticket as $row){	
						?>
						<tr <?php //echo colorForRowTicket($row->getstatus());?>>
						
						<td>
							<input type="hidden" class="ticket" value="<?php echo $row->getid();?>"></input>
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
							<?php echo $row->getcustomer();?>								
						</td>							
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
		<?php } ?>
	</table>
</div>