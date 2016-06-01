<?php 
	include("includes/header.php");
	
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page = "";
	}	

	switch ($page) {
		case "1-bedroom"://home page
			include(rootpath . "view/moreinfo/1-bedroom.php");
			break;
		case "2-bedroom":
			include(rootpath . "view/moreinfo/2-bedroom.php");
			break;
		case "studio":
			include(rootpath . "view/moreinfo/studio.php");
			break;
		default://default homepage if no set
			include(rootpath . "view/page/home.php");
	}
	
 
	include("includes/footer.php");
?>

