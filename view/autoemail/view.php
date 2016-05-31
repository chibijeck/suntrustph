<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
            	<th>id</th>
            	<th>test</th>
            	<th>day</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$autoemail = new autoemail();									
			$autoemail = $autoemail->selectAll('');	
			foreach($autoemail as $row){	
		?>
			<tr>
        	 	<td><?php echo $row->getid();?></td>
        	 	<td><?php echo $row->gettest();?></td>
        	 	<td><?php echo $row->getday();?></td>
			</tr>			
		<?php } ?>
		</tbody>
	</table>
</div>