   	<?php
	$toUpdateId = $_GET['id'];
	$md5 = md5($_GET['id']);
	
	if($md5 == $_GET['key']){
		$user = new user();				
		$user->activateAccount($toUpdateId);		
			
	 ?>
	<div class="container mainBody">		
			<div class="row">
			  <div class="col-md-3"></div>
			  <div class="col-md-6">	
			
				<div class="well"><h1>Your account has been activated</h1></div>
			  </div>
			  <div class="col-md-3"></div>
			</div>
	</div>
	<?php 
	}else{
		echo "<div class='container mainBody'>Invalid Key</div>";
	}?>