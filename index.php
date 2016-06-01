<?php 
	include("includes/header.php");
	
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page = "";
	}	

	switch ($page) {
		case "home"://home page
			include(rootpath . "view/page/home.php");
			break;
		case "about":
			include(rootpath . "view/page/about.php");
			break;
		case "contact":
			include(rootpath . "view/page/contact.php");
			break;
		case "form":
			include(rootpath . "view/page/form.php");
			break;
		default://default homepage if no set
			include(rootpath . "view/page/home.php");
	}
	
 
	include("includes/footer.php");
?>

