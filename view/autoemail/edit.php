<div class="table-responsive">
	<h2>Edit</h2>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th></th>            	
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
				<td>
					<!-- Edit Start Here Note:Change The link-->
					<a type="button" class="btn btn-success" href="manageEmailnotif.php?action=editpage&id=<?php echo $row->getid(); ?>">Edit</button>
				</td>        	 	
        	 	<td><?php echo $row->gettest();?></td>
        	 	<td><?php echo $row->getday();?></td>
			</tr>			
		<?php } ?>
		</tbody>
	</table>
</div>