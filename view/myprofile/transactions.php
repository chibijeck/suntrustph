<h3>
Transactions / Payment History
</h3>
<script>
    $(function()
    {
           $( ".datepicker" ).datepicker({
              showOn: "button",
              buttonImage: "images/iconbox.jpg",
              buttonImageOnly: true
            });
    });   

    </script>
<form method="POST">
	<input type="text" class="datepicker" name='from' size='9' value="" />
    <input type="text" class="datepicker" name='to' size='9' value="" />
	<!--Filter By:-->
	<!--<input type="date" id="datepicker" name='from' value="" /> -->
	<input type="submit" name="datePick" value="Submit"/>
</form>

<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				
				<!--<th>Edit Payment Details</th>			-->
				<th>Property Id   </th>			
				<th>Property Title   </th>			
				<th width="130">Price          </th>
				<th>Building      </th>
				<th>Floor          </th>
				<th>Room Number      </th>
				<th>Type of Payment  </th>
				<th>Last Update  </th>																	
			</tr>
		</thead>
		<tbody>
			<?php 
				$currentUserid = $_SESSION['user_id'];
				$currentUsername = $_SESSION['username'];
				$payment = new payment();									
					
				if(!empty($_POST['datePick'])){
					$from = explode("/",$_POST['from']);
					$from = $from[2].'-'.$from[0].'-'.$from[1];
					$to = explode("/",$_POST['to']);
					$to = $to[2].'-'.$to[0].'-'.$to[1];
					$payment = $payment->selectAll('WHERE user_id = "'.$currentUserid.'" AND DATE(created_at) >= "'.$from.'" AND DATE(created_at) <= "'.$to.'" ORDER BY id DESC');
					
				}else {
					$payment = $payment->selectAll('WHERE user_id = "'.$currentUserid.'" ORDER BY id DESC');	
				}
				
				if(!empty($payment)){
						foreach($payment as $row){	
						?>
						<tr>
						<!--<td>-->
							<!-- Edit Start Here -->
						<!--	<a type="button" class="btn btn-success" href="myprofile.php?action=editpagepayment&id=<?php echo $row->getid(); ?>">Edit</button>-->
							<!-- Edit End Here -->
						<!--</td>-->
						
						<td>
							<?php echo $row->getproperties_id();?>								
						</td>
						
						<td>
							<?php 	
								$properties = new properties();	
								$properties->selectOne($row->getproperties_id());							
								echo $properties->gettitle();				
							?>
						</td>							
													
						<td><?php echo pesoFormat($row->getprice()); ?></td>

						<?php 
							//Bridge Ticketid - PropertyId
							$ticket = new ticket();									
							$ticket->selectOne($row->getticket_id());	//get pbfr_id from ticket		
							
							$pbfr = new pbfr();									
							$pbfr->selectOne($ticket->getpbfr_id());									
						?>		
						
						<td><?php echo $pbfr->getbuilding(); ?></td>							
						<td><?php echo $pbfr->getfloor(); ?></td>							
						<td><?php echo $pbfr->getroom(); ?></td>	


						
						<td>
							<?php echo typeofpaymentDisplay($row->gettype_of_payment()); ?>				
						</td>							
						<td>
							<?php echo $row->getcreated_at(); ?>				
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
	</table>
</div>