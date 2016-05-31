<div class="row">
	<div class="col-md-12">
	<h2>Manage Properties Building Floor Room	 </h2>
			<?php 
				$properties = new properties();						
				$properties = $properties->selectAll('ORDER BY created_at DESC');	
				foreach($properties as $row){	
				?>
		<div class="col-md-4 text-center" style="margin-bottom:20px;">
			<a  href="managePbfr.php?action=view&id=<?php echo $row->getid(); ?>">				
				<img src="images/upload/small/<?php echo $row->getimg_name(); ?>" width="">				
				<span><?php echo $row->gettitle(); ?></span>				
			</a>						
		</div>				
			<?php
				}
				?>																				
		
	</div>
</div>