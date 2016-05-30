<?php 
	include("includes/header.php");
?>
<?php		
	if(isset($_GET['action'])){
		$action = $_GET['action'];
	}else{
		$action = "";
	}	

	switch ($action) {
		case "login"://home page
			include(rootpath . "view/login/login.php");
			break;
		case "register"://register page
			include(rootpath . "view/login/register.php");
			break;
		case "activate"://register page
			include(rootpath . "view/login/activate.php");
			break;
		case "logout"://logout page
			include(rootpath . "view/login/logout.php");
			break;	
		default://default homepage if no set
			include(rootpath . "view/login/login.php");
	}
?>	
<?php
	include("includes/footer.php");
?>