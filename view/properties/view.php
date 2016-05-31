<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>        </th>
				<th>id          </th>
				<th>IMG   		 </th>
				<th>panotour    </th>
				<th>title       </th>
				<th>unit_type   </th>
				<th>location    </th>
				<th>price       </th>
				<th>status      </th>
				<th>created_at	</th>																	
			</tr>
		</thead>
		<tbody>
			<?php 
				$properties = new properties();						
				$properties = $properties->selectAll('ORDER BY created_at DESC');	
				foreach($properties as $row){	
				?>
			<tr>
				<td>
					<a type="button" class="btn btn-warning" href="manageProperties.php?action=viewPageProperties&id=<?php echo $row->getid(); ?>">View</button>
				</td>
				<td><?php echo $row->getid(); ?></td>			
				<td><img src="images/upload/small/<?php echo $row->getimg_name(); ?>" width="100"></td>			
				<td><?php echo $row->getpanotour(); ?></td>			
				<td><?php echo $row->gettitle(); ?></td>			
				<td><?php echo $row->getunit_type(); ?></td>			
				<td><?php echo $row->getlocation(); ?></td>			
				<td><?php echo $row->getprice(); ?></td>			
				<td><?php echo $row->getstatus(); ?></td>			
				<td><?php echo $row->getcreated_at(); ?></td>			
						
			</tr>			
			<?php
				}
				?>																					
		
		</tbody>
	</table>
</div>