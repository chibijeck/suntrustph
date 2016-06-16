<?php 
	ob_start();
	session_start();
	error_reporting(-1);
	ini_set('display_errors', 'On');
	date_default_timezone_set('Asia/Manila');
	
	//Define Variables
	$basepath = ""; 	
	$linkbasepath = $_SERVER['SERVER_NAME']; 	
	define("rootpath", $basepath );	
	define("linkbasepath", "http://" . $linkbasepath . "/");	
	define("adminEmail", "bjpcapstone@gmail.com");	
	define("fromSystemEmail", "from@suntrust.com");										
	//**********************************//
	//******** Constant Variables ****//
	//**********************************//
	//linkbasepath = www.localhost.com 
	//rootpath = C:/Suntrust/wamp/www/		
	//adminEmail = all notification will be sent here

	//Class, Functions and database
	include( rootpath . 'class/compile.php');	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--meta name="viewport" content="width=device-width, initial-scale=1"-->
    <title>Suntrust</title>
	
	<link rel="shortcut icon" type="image/png" href="favicon.png"/>

    <!-- CSS -->      
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
	
	<!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/validator.js"></script>
	<script src="js/jquery.printPage.js" type="text/javascript"></script>


	<!-- Plugins -->		
		<!-- font Awesome -->
		<link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- Slider -->
		<link href="plugins/slider/nivo-slider.css" rel="stylesheet" type="text/css" />	
		<link href="plugins/slider/themes/default/default.css" rel="stylesheet" type="text/css" />
		<script src="plugins/slider/jquery.nivo.slider.pack.js" type="text/javascript"></script>
		<!-- Carousel -->
		<link href="plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
		<link href="plugins/owl-carousel/owl.theme.css" rel="stylesheet">
		<script src="plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
		<!-- Lightbox -->
		<link href="plugins/colorbox-master/example3/colorbox.css" rel="stylesheet">
		<script src="plugins/colorbox-master/jquery.colorbox-min.js"></script>
		
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<div class="container-fluid mainContainer">
	<!-- Menu -->
		<div class="emailNotif text-center"></div>
		<nav class="navbar navbar-inverse">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div id="navbar" class="navbar-collapse collapse" >
				  <ul class="nav navbar-nav">
					<li><a href="index.php">Home </a></li>
					<li><a href="veiwlistproperty.php">Properties </a></li>
					<li><a href="index.php?page=about">About Us</a></li>
					<?php if(isset($_SESSION['user_id'])){ ?>
						<li><a href="index.php?page=form">Download Form</a></li>
					<?php } ?>
					 <li><a href="index.php?page=contact">Contact Us</a></li>
				  </ul>	
					<!-- Login --> 
					<ul class="nav navbar-nav navbar-right">
							<li>
								<span class="serverTime" style="display:block;margin:5px 15px;">
									Server Time:</br>
									<span class="updateThisTime"><?php echo date('Y-m-d H:i:s'); ?></span>
								</span>
							  </li>
						<?php if(!isset($_SESSION['user_id'])){ ?>
						<a href="login.php" type="button" class="btn btn-default navbar-btn pull-right">Sign in</a>						
						<?php }else{ ?>
							
							<li class="dropdown">
							  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome, <?php echo $_SESSION['username']; ?>  <span class="caret"></span></a>
							  <ul class="dropdown-menu" role="menu">
								<li><a href="myprofile.php?id=<?php echo $_SESSION['user_id'];?>">My Profile</a></li>
								
								<?php if(	$_SESSION['role_id'] == 2 || 
											$_SESSION['role_id'] == 3 || 
											$_SESSION['role_id'] == 4 || 											
											$_SESSION['role_id'] == 6  
										){ ?>
									<li><a href="manageUser.php">Manage User</a></li>					
									<li><a href="manageProperties.php">Manage Properties</a></li>					
									<li><a href="manageTicket.php">Manage Ticket</a></li>
									<li><a href="managePayment.php">Manage Payment</a></li>
									<!--<li><a href="manageReport.php">Manage Reports</a></li>-->
									<li><a href="manageEmailnotif.php?action=editpage&id=1">Scheduled Notification</a></li>
									<li><a href="manageEmailnotif.php?action=sendemail">Resend Email</a></li>
								<?php } ?>
								
								<li><a href="login.php?action=logout">Log Out</a></li>							
							  </ul>
							</li>			
							
					
						
								<?php if( $_SESSION['role_id'] == 6  ){ ?>
										<li class="dropdown">
										  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
											<i class="fa fa-bell"></i>
											(<?php 
											$ticket = new ticket();						
											
											echo  $ticket->countTicket(0);
											?>)
										  </a>
										  <ul class="dropdown-menu" role="menu">									
											<li><a href="manageTicket.php"><?php 								
											echo  $ticket->countTicket(0);
											?> New Pending Reservation Request</a></li>	
																		
										  </ul>
										</li>
									<?php } ?>
							<?php } ?>
					  </ul>
				</div><!-- /.navbar-collapse -->		
			</div><!-- container -->		
		</nav>		
		
		<div class="header">
			<div class="container">
				<div class="row">
				  <div class="col-md-2"><a href="/"><img src="images/logo.png" class="img-responsive"></a></div>
				  <div class="col-md-10">
					 <div class="row">
						 
						  <div class="col-md-4">
							Unit Type
							<select class="form-control unit_typeFilter" placeholder=".input-sm">
										<option value="">-</option>
										<option value="Studio">Studio</option>
										<option value="1 Bedroom">1 Bedroom</option>
										<option value="2 Bedroom">2 Bedroom</option>							
							</select>
						  </div>
						  <div class="col-md-4">
							Location
							<select class="form-control locationFilter" placeholder=".input-sm">
										<option value="">
											-
										</option>	
										<option value="Sta.Ana, Manila">
											Sta.Ana, Manila
										</option>	
										<option value="Ermita, Manila 1">
											Ermita, Manila 1
										</option>	
										<option value="Ermita, Manila 2">
											Ermita, Manila 2
										</option>		
										<option value="Urbank Velasco Ave, Pasig">
											Urbank Velasco Ave, Pasig
										</option>							
							</select>
						  </div>
						  <div class="col-md-3">
							Price Range
							<select class="form-control priceFilter" placeholder=".input-sm">
										<option value="">
											-
										</option>										
										<option value="500K - 1M">
											500K - 1M
										</option>										
										<option value="1M - 2M">
											1M - 2M											
										</option>										
										<option value="2M - 3M">
											2M - 3M	
										</option>									
										<option value="3M - 4M">
											3M - 4M	
										</option>									
										<option value="4M - 5M">
											4M - 5M	
										</option>										
							</select>							
						  </div>
						  <div class="col-md-1">
							</br>
							<button type="button" class="btn btn-default serachFilterButton">							
								<span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search
							</button>
						  </div>
					</div>		  
				  
				  </div>
				</div>
			</div>			
		</div>			
		
		
		<script>		
		$(function() {
			// Server time clock			 
		   function theFunction(){		    
			   $('.updateThisTime').load('includes/clock.php');
			   $('.emailNotif').load('billNotif.php');
			   $('.emailNotif').load('sendEmailLapsed.php');
			}          
		   
		   //run every 1 second        
		   setInterval(theFunction, 1000);
			
			//Upon Page load, Check first if value for filter is set.
			$('select.unit_typeFilter').val('<?php echo empty($_GET['unitType']) ? '' : $_GET['unitType'];?>');
			$('select.locationFilter').val('<?php echo empty($_GET['location']) ? '' : $_GET['location'];?>');
			$('select.priceFilter').val('<?php echo empty($_GET['price']) ? '' : $_GET['price'];?>');			
			
			$( ".serachFilterButton" ).click(function() {				
				unit_typeFilter = $('.unit_typeFilter').val();
				locationFilter = $('.locationFilter').val();
				priceFilter = $('.priceFilter').val();
				window.location = "/veiwlistproperty.php";
				window.location = "/veiwlistproperty.php?unitType=" + unit_typeFilter +
								"&location=" + locationFilter +
								"&price=" + priceFilter;
			});
		});
		</script>