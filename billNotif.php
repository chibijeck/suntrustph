<?php 
//Define Variables
$basepath = ""; 	
$linkbasepath = $_SERVER['SERVER_NAME']; 	
define("rootpath", $basepath );	
define("linkbasepath", "http://" . $linkbasepath . "/");	
define("adminEmail", "bjpcapstone@gmail.com");	
define("fromSystemEmail", "from@suntrust.com");	
	
include('class/compile.php');	
date_default_timezone_set('Asia/Manila');

$datCur = date('Y-m-d H:i:s');
// $datTarget = "2015-11-20 01:35:58";


$autoemail = new autoemail();									
$autoemail = $autoemail->selectAll('');	
foreach($autoemail as $row){		
	if( $row->gettest() != 0 ){
		$datTarget =  $row->gettest();
	}	
	if( $row->getday() != 0 ){
		$datTarget =  date('Y-m-'.$row->getday().' 00:00:00');
	}	
} 


if( $datCur == $datTarget){		
	//visual effect
?>	
	<script>
		emailnotifEmail = "<?php 
					$payment = new payment();									
					$payment = $payment->selectAll('ORDER BY created_at DESC');	
					foreach($payment as $row){	
						$user = new user();
						$user->selectOne($row->getuser_id());
						echo $user->getemail() . "," ;
					}	
				?>";

		alert ("Upcoming bill has been sent successfully to \n\n" + emailnotifEmail + "\n\n");
	</script>
<?php
	// send emai
	$payment = new payment();									
	$payment = $payment->selectAll('ORDER BY created_at DESC');
	foreach($payment as $row){		
		
		upcomingbillEmail($row->getid());	
	}	
}

			
?>	