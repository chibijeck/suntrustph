<?php
	//if isset so that these code will only work once
	if(isset($_SESSION['user_id'])){
		unset($_SESSION['username']);			
		unset($_SESSION['user_id']);
		redirectTo($_SERVER['REQUEST_URI']);//use REQUEST_URI to include parameters
	}			
	
?>

<div class="container mainBody">		
			<div class="row">
			  <div class="col-md-3"></div>
			  <div class="col-md-6">	
			
				<div class="well"><h1>Log Out Successful</h1></div>
			  </div>
			  <div class="col-md-3"></div>
			</div>
</div>