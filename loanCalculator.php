<?php include("includes/header.php"); ?>	
<?php $propertyId = empty($_GET['id']) ? '' : $_GET['id'];
    $payment = new payment();
    $payment->selectOne($propertyId);
    // echo "<pre>";
    // print_r($payment->getticket_id());
    $ticket = new ticket(); 
    $ticket->selectOne($payment->getticket_id());
    // echo "<pre>";
    // print_r($ticket->getagent());
    $pId = $payment->getid();
    $banks = array('pagibig' => array('5' => '6', '10' => '7', '15' => '8.5', '20' => '9.5', '25' => '10.5', '30' => '11.5'), 
                   'bdo' => array('1' => '5.5', '2-3' => '6.5', '4-5' => '6.88', '6-10' => '8.5', '11-15' => '11', '16-20' => '11.5'), 
                   'bpi' => array('1' => '5.5', '2-3' => '6.5', '4-5' => '6.88', '6-10' => '8', '11-15' => '9.5', '16-20' => '11.5'), 
                   'chinabank' => array('1' => '7.5', '2' => '8.5', '3' => '8.5', '5' => '9.0', '10' => '10.25', '15' => '11', '20' => '11.5', '25' => '11.5'), 
                   'unionbank' => array('1' => '6.5', '3' => '7.5', '5' => '8.5', '6-10' => '10.5', '11-15' => '11.5'), 
                   'suntrust' => array('3' => '8', '5' => '10', '10' => '14', '15' => '16')
                   );
    // echo "<pre>";
    // print_r($banks);
    $rateRadioBtn = empty($_GET['bank']) ? '' : $_GET['bank'];
    $rateYear = empty($_GET['rateyr']) ? '' : $_GET['rateyr'];
?>
<script>        
$(function() {  
    function changeVal(){
        rateRadioBtn = $('.rateRadioBtn').val();
        rateYear = $('.rateYear').val();
        window.location = "/loanCalculator.php?id=<?php echo $_GET['id'];?>&bank="+rateRadioBtn+"&rateyr="+rateYear;
    }

    $('select.rateRadioBtn').val('<?php echo $rateRadioBtn;?>');
    $('select.rateYear').val('<?php echo $rateYear;?>');
    
    $( ".rateRadioBtn" ).change(function() {
      changeVal();
    });
    $( ".rateYear" ).change(function() {
      changeVal();
    });

});
</script>
<div class="container mainBody">			
	<div class="row">
        <div class="col-md-2">			
            <div class="panel panel-default">					
				<div class="panel-body">
					<ul class="nav nav-pills nav-stacked">
						 <li><a href="myprofile.php">Profile</a></li>
						 <li><a href="myprofile.php?action=ticket">Ticket</a></li>
						 <li><a href="myprofile.php?action=payment">Payment</a></li>				 
					 	 <li><a href="myprofile.php?action=transaction">Transactions</a></li>
					</ul>
				</div>
			</div>
        </div>		  
        <div class="col-md-10">	
		    <div class="panel panel-info">
			    <div class="panel-heading">Loan Calculator</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <span style="float: right;">
                            <script>  
                                $(document).ready(function() {
                                    $(".btnPrint").printPage();
                                });
                            </script>
                            <!--<button type="submit" class="btn btn-info" name="btnPrint">Print</button>-->
                            <form role="form" method="POST">
                                <a class="btn btn-info btnPrint" href='print/loanCalculation.html'>Print</a>
                                <input type="submit" class="btn btn-info" name="btnEmail" value="Email">
                            </form>
                        </span>
                        </br>
                           <!--  <script>
                                function showpay() {
                                    if ( (document.calc.months.value == null || document.calc.months.value.length == 0) 
                                      || (document.calc.rate.value == null || document.calc.rate.value.length == 0) )
                                    { 
                                        document.calc.pay.value = "Incomplete data";
                                    } else {
                                        var price = document.calc.totalPrice.value;
                                        var dp = document.calc.dp.value / 100;
                                        var payable = document.calc.payable.value;
                                        window.alert(payable);
                                        var amort = price - (price * dp);
                                        //document.calc.dpLabel.value = (price * dp);
                                        var downPayment = price * dp;
                                        document.getElementById("dpLabel").innerHTML = "Down Payment: " + downPayment;
                                        var cashout = document.calc.cashout.value;
                                        var finalDownPayment = downPayment - cashout;
                                        if(cashout != 0){
                                            document.calc.payDP.value = parseFloat(finalDownPayment / payable).toFixed(2);
                                        }else{
                                            document.calc.payDP.value = parseFloat(downPayment / payable).toFixed(2);
                                            document.calc.cashout.value = 0;
                                        }
                                        document.calc.loan.value = amort;
                                        var princ = amort;//document.calc.loan.value;
                                        //var rateYear = document.calc.rateYear.value;
                                        var rateYear = "<?php echo $_POST['rateyr'] ?>";//document.getElementById("rateYearId").value;
                                        window.alert(payable);
                                        var rateyr = rateYear.split("|");
                                        var termyr = rateyr[0].split("-");
                                        var term  = termyr[1]; //document.calc.months.value;
                                        var intr   = rateyr[1] / 1200;//document.calc.rate.value / 1200;
                                        document.calc.pay.value = parseFloat(princ * intr / (1 - (Math.pow(1/(1 + intr), term)))).toFixed(2);
                                    }
                                    // payment = principle * monthly interest/(1 - (1/(1+MonthlyInterest)*Months))
                                }
                            </script> -->
                            
                            <form name="calc" role="form" method="POST">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <label for="preparedBy">Prepared By: </label>
                                            <input type="text" onkeypress='return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0' class="form-control" value="<?php echo $ticket->getagent(); ?>" readonly="readonly" name="preparedBy" placeholder=""  data-error="Required" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8">
                        					<label for="totalPrice">Total Contract Price</label>
                        					<input type="text" onkeypress='return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0' class="form-control" value="<?php echo $payment->getprice(); ?>" readonly="readonly" name="totalPrice" placeholder=""  data-error="Required" required>
                        				</div>
                					    <div class="col-sm-4">
                        					<div class="help-block"><?php if(!empty($_SESSION['loanCalculation']['totalPrice'])){ echo pesoFormat($_SESSION['loanCalculation']['totalPrice']); } ?></div>
                					    </div>
                					</div>
                				</div>
                				<div class="form-group">
                				    <div class="row">
                                        <div class="col-sm-8">
                        					<label for="dpLabel">DP %</label>
                        					<input type="text" onkeypress='return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0 || event.charCode == 46' class="form-control" value=""  name="dp" placeholder=""  data-error="Required" required>
                        				</div>
                					    <div class="col-sm-4">
                        					<div id="dpLabel" name="dpLabel" class="help-block"><?php if(!empty($_SESSION['loanCalculation']['dp'])){ $dp = ($_SESSION['loanCalculation']['dp']/100) * $_SESSION['loanCalculation']['totalPrice']; echo pesoFormat($dp);} ?></div>
                	                    </div>
                					</div>
                				</div>
                				<div class="form-group">
                				    <div class="row">
                                        <div class="col-sm-8">
                        					<label for="payDpMonths">Payable within <em>(Months)</em></label>
                        					<input type="text" onkeypress='return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0' class="form-control" value=""  name="payable" placeholder=""  data-error="Required" required>
                        				</div>
                					    <div class="col-sm-4">	
                        					<div class="help-block with-errors"><?php if(!empty($_SESSION['loanCalculation']['payable'])){ echo $_SESSION['loanCalculation']['payable']." Months"; } ?></div>
                        				</div>
                					</div>	
                				</div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <label for="cashOut">Cashout</label>
                                            <input type="text" onkeypress='return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0' class="form-control" value=""  name="cashout" placeholder="">
                                        </div>
                                        <div class="col-sm-4">  
                                            <div class="help-block with-errors"><?php if(!empty($_SESSION['loanCalculation']['cashout'])){ echo pesoFormat($_SESSION['loanCalculation']['cashout']); } ?></div>
                                        </div>
                                    </div>  
                                </div>
                				<div class="form-group">
                				    <div class="row">
                                        <div class="col-sm-8">
                        					<label for="monthlyPayment">Monthly Payment <em>(DP)</em></label>
                        					<input type="text" class="form-control" value=""  name="payDP" placeholder="" readonly="readonly" data-error="Required" required>
                        				</div>
                					    <div class="col-sm-4">
                        					<div class="help-block with-errors"><?php if(!empty($_SESSION['loanCalculation']['payDP'])){ echo pesoFormat($_SESSION['loanCalculation']['payDP']); } ?></div>
                				        </div>
                					</div>
                				</div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8">
                        					<label for="loanAmount">Loanable Amount <em>(Amortization)</em></label>
                        					<input type="text" onkeypress='return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0' readonly="readonly" class="form-control" value=""  name="loan" placeholder=""  data-error="Required" required>
                        				</div>
                					    <div class="col-sm-4">
                        					<div class="help-block with-errors"><?php if(!empty($_SESSION['loanCalculation']['loan'])){ echo pesoFormat($_SESSION['loanCalculation']['loan']); } ?></div>
                				        </div>
                					</div>
                				</div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8">
                                                <label for="termsMonth">Loan Type</label>
                                                <select class="form-control rateRadioBtn" placeholder=".input-sm">
                                                    <option value="">
                                                        ---
                                                    </option>
                                                    <option value="Pag-Ibig">
                                                        Pag-Ibig
                                                    </option>
                                                    <option value="BDO">
                                                        BDO
                                                    </option>
                                                    <option value="BPI">
                                                        BPI
                                                    </option>
                                                    <option value="China Bank">
                                                        China Bank
                                                    </option>
                                                    <option value="Union Bank">
                                                        Union Bank
                                                    </option>
                                                    <option value="Suntrust">
                                                        Suntrust
                                                    </option>
                                                </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8">
                        					<label for="interestRate">Interest Rate</label>
                        					<!-- <input type="text" onkeypress='return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0 || event.charCode == 46' class="form-control" value=""  name="rate" placeholder=""  data-error="Required" required> -->
                                                <!-- <br>
                                                <input type="radio" class="rateRadioBtn" name="gender" value="Pag-Ibig"> Pag-Ibig<br>
                                                <input type="radio" class="rateRadioBtn" name="gender" value="BDO"> BDO<br>
                                                <input type="radio" class="rateRadioBtn" name="gender" value="BPI"> BPI<br>
                                                <input type="radio" class="rateRadioBtn" name="gender" value="China Bank"> China Bank<br>
                                                <input type="radio" class="rateRadioBtn" name="gender" value="Union Bank"> Union Bank<br>
                                                <input type="radio" class="rateRadioBtn" name="gender" value="Suntrust"> Suntrust<br> -->

                                                <select class="form-control rateYear" placeholder=".input-sm">
                                                <?php 
                                                    if($_GET['bank'] == 'Pag-Ibig'){
                                                        $bank = $banks['pagibig'];
                                                    }elseif($_GET['bank'] == 'BDO'){
                                                        $bank = $banks['bdo'];
                                                    }elseif($_GET['bank'] == 'BPI'){
                                                        $bank = $banks['bpi'];
                                                    }elseif($_GET['bank'] == 'Union Bank'){
                                                        $bank = $banks['unionbank'];
                                                    }elseif($_GET['bank'] == 'China Bank') {
                                                        $bank = $banks['chinabank'];
                                                    }elseif($_GET['bank'] == 'Suntrust'){
                                                        $bank = $banks['suntrust'];
                                                    }
                                                    
                                                    foreach ($bank as $key => $value) {
                                                ?>
                                                    
                                                    <option value="<?php echo $key.'|'.$value; ?>">
                                                        <?php echo $value."% --- ".$key."yr"; ?>
                                                    </option>
                                                <?php } ?>
                                                </select>
                                                <input type="hidden" id="rateYearId" name="rateYear" value="<?php echo $_GET['rateyr']; ?>"></input>
                                                
                        				</div>
                					    <div class="col-sm-4">
                        					<div class="help-block with-errors"></div>
                        				</div>
                					</div>
                				</div>
                                <!-- <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <label for="termsMonth">Terms <em>(in Years)</em></label>
                                            <input type="text" onkeypress='return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0' class="form-control" value=""  name="months" placeholder=""  data-error="Required" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="help-block with-errors"><?php if(!empty($_POST['months'])){ echo "Terms: ".$_POST['months']; } ?></div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8">
                        					<label for="monthlyPayment">Monthly Payment <em>(Amortization)</em></label>
                        					<input type="text" class="form-control" value=""  name="pay" placeholder="" readonly="readonly" data-error="Required" required>
                        				</div>
                					    <div class="col-sm-4">
                        					<div class="help-block with-errors"><?php if(!empty($_SESSION['loanCalculation']['pay'])){ echo pesoFormat($_SESSION['loanCalculation']['pay']); } ?></div>
                        				</div>
                					</div>
                				</div>
                                <input type="submit" class="btn btn-primary" onClick='showpay()' name="calcu" value="Submit">
                                <input type="reset" class="btn btn-primary" value="Reset">
                            </form>
                            <?php
                            
                    			
                    			if(!empty($pId)){
                    				pesoFormat($payment->getprice()); 
                    			
                    				//properties
                    				$properties = new properties();	
                    				$properties->selectOne($payment->getproperties_id());
                    				 
                    				//get ticket
                    				$ticket = new ticket();				
                    				$ticket->selectOne($payment->getticket_id());			
                    				
                    				
                    				//user
                    				$userId = new user();	
                    				$userId->selectOne($payment->getuser_id());
                    				
                    				//get from ticket
                    				$pbfr = new pbfr();	
                    				$pbfr->selectOne($ticket->getpbfr_id());		
                    		    }
                                													
                                if(isset($_POST['calcu'])){
                                    $price = $_POST['totalPrice'];//document.calc.totalPrice.value;
                                    $dp = $_POST['dp'] / 100;
                                    $payable = $_POST['payable'];;
                                    $amort = $price - ($price * $dp);
                                    //document.calc.dpLabel.value = (price * dp);
                                    $downPayment = $price * $dp;
                                    $cashout = $_POST['cashout'];//document.calc.cashout.value;
                                    $finalDownPayment = $downPayment - $cashout;
                                    if($cashout != 0){
                                        $_POST['payDP'] = round($finalDownPayment / $payable, 2);
                                    }else{
                                        $_POST['payDP'] = round($downPayment / $payable, 2);
                                        $_POST['cashout'] = 0;
                                    }
                                    $_POST['loan'] = $amort;
                                    //$princ = amort;//document.calc.loan.value;
                                    //$rateYear = document.calc.rateYear.value;
                                    $rateYear = $_POST['rateYear'];//document.getElementById("rateYearId").value;
                                    //window.alert(payable);
                                    $rateyr = explode("|", $rateYear);
                                    //print_r($rateyr);
                                    $termyr = explode("-", $rateyr[0]);
                                    //print_r($termyr);
                                    if(!empty($termyr[1])){
                                        $term  = $termyr[1] * 12; //document.calc.months.value;
                                    }else{
                                        $term  = $termyr[0] * 12; //document.calc.months.value;
                                    }
                                    $intr   = $rateyr[1] / 1200;//document.calc.rate.value / 1200;
                                    $_POST['pay'] = round($amort * $intr / (1 - (pow(1/(1 + $intr), $term))), 2);

                                    $rateYear = explode("|", $_POST['rateYear']);
                                    
                                    $html = "<!DOCTYPE html>";
                                    $html .= "<html lang='en'>";
                                    $html .=    "<head>";
                                    $html .=        "<meta charset='utf-8'>";
                                    $html .=        "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
                                    $html .=        "<title>Suntrust</title>";
                                    $html .=        "<link rel='shortcut icon' type='image/png' href='favicon.png'/>";
                                    $html .=    "</head>";
                                    $html .=    "<body>";
                                    $html .=        "<div class='container-fluid mainContainer'>";
                                    $html .=        "<img src='http://suntrustph.com/images/logo.png' class='suntrust'>";
                                    $html .=            "<br><br>";
                                    $html .=            "<table>";
                                    $html .=            "<tr><td>Total Contract Price</td><td>".pesoFormat($_POST['totalPrice'])."</td></tr>";
                                    $html .=            "<tr><td>Down Payment Percentage</td><td>".pesoFormat(($_POST['dp']/100) * $_POST['totalPrice'])." (".$_POST['dp']."% of Contract Price)</td></tr>";
                                    $html .=            "<tr><td>Payable Within (Months)</td><td>".$_POST['payable']."</td></tr>";
                                    $html .=            "<tr><td>Cashout        </td><td>".pesoFormat($_POST['cashout'])."</td></tr>";
                                    $html .=            "<tr><td>Monthly Payment        </td><td>".pesoFormat($_POST['payDP'])."</td></tr>";
                                    $html .=            "<tr><td>Loanable Amount            </td><td>".pesoFormat($_POST['loan'])."</td></tr>";
                                    $html .=            "<tr><td>Terms                  </td><td>".$rateYear[0]." years</td></tr>";
                                    $html .=            "<tr><td>Interest               </td><td>".$rateYear[1]."% Annual"."</td></tr>";
                                    $html .=            "<tr><td>Payment                </td><td>".pesoFormat($_POST['pay'])."</td></tr>";
                                    $html .=            "</table>";
                                    $html .=            "<br><br>";
                                    $html .=            '<table>
                    											<tr>
                    												<td>Details</td>
                    											</tr>
                    											<tr>
                    												<td>
                    													Tracking Id :
                    												</td>
                    												<td>
                    													' . $payment->getticket_id() .'
                    												</td>
                    											</tr>
                    											<tr>  
                    												<td>
                    													Customer username :
                    												</td>
                    												<td>
                    													' . $userId->getusername() .'
                    												</td>
                    											</tr>
                    											<tr>
                    												<td>
                    													Customer Email :
                    												</td>
                    												<td>
                    													' . $userId->getemail() .'
                    												</td>
                    											</tr>
                    										
                    											<tr>
                    												<td>
                    													Property  Name :
                    												</td>
                    												<td>
                    													' . $properties->gettitle() .'
                    												</td>
                    											</tr>
                    											<tr>
                    												<td>
                    													Property Unit Type :
                    												</td>
                    												<td>
                    													' . $properties->getunit_type() .'
                    												</td>
                    											</tr>
                    											<tr>
                    												<td>
                    													Property  location :
                    												</td>
                    												<td>
                    													' . $properties->getlocation() .'
                    												</td>
                    											</tr>
                    											<tr>
                    												<td>
                    													Property  Price :
                    												</td>
                    												<td>
                    													' . pesoFormat($properties->getprice()) .'
                    												</td>
                    											</tr>
                    											
                    											<tr>
                    												<td>
                    													Building :
                    												</td>
                    												<td>
                    													' . $pbfr->getbuilding() .'
                    												</td>
                    											</tr>
                    											<tr>
                    												<td>
                    													Floor :
                    												</td>
                    												<td>
                    													' . $pbfr->getfloor() .'
                    												</td>
                    											</tr>
                    											<tr>
                    												<td>
                    													Unit :
                    												</td>
                    												<td>
                    													' . $pbfr->getroom() .'
                    												</td>
                    											</tr>
                    											<tr>
                    												<td>
                    													Date Updated :
                    												</td>
                    												<td>
                    													' . date('Y-m-d H:i:s') .'
                    												</td>
                    											</tr>	
                                                                <tr>
                                                                    <td>
                                                                        &nbsp;
                                                                    </td>
                                                                    <td>
                                                                       &nbsp;
                                                                    </td>
                                                                </tr> 
                                                                <tr>                                    
                                                                    <td>
                                                                        &nbsp;
                                                                    </td>
                                                                </tr>   
                                                                <tr>                                    
                                                                    <td>
                                                                        &nbsp;
                                                                    </td>
                                                                </tr> 
                                                            </table>';
                                    
                                    
                                    
                                    $payment = new payment();   
                                    $payment->selectOne($propertyId);
                                    $payment->setproperties_id($properties->getid());        
                                    $payment->setuser_id($userId->getid());    
                                    $payment->setprice($_POST["totalPrice"]);    
                                    $payment->setcreated_at(date('Y-m-d H:i:s'));
                                    $payment->settype_of_payment(5);            
                                    $payment->insert(); 
                                    
                                    $_SESSION['loanCalculation'] = $_POST;
                                    //$_SESSION['loanCalculation']['term'] = $_GET;
                                    // echo "<pre>";
                                    // print_r($_SESSION['loanCalculation']);
                                    // Payment Schedule for Monthly Down Payment
                                    $balance = (($_SESSION['loanCalculation']['dp'] / 100) * $_SESSION['loanCalculation']['totalPrice']) - $_SESSION['loanCalculation']['cashout'];
                                    $payment = $_SESSION['loanCalculation']['payDP'];
                                    
                                    $monthYear = array();
                                    $month = strtotime(date('Y-m-d'));
                                    $end = strtotime(date("Y-m-d", mktime(0, 0, 0, $_SESSION['loanCalculation']['payable']+6, 10)));//strtotime('2011-01-01');
                                    
                                    while($month < $end)
                                    {
                                         $monthYear[] = date('F Y', $month);
                                         $month = strtotime("+1 month", $month);
                                    }
                                    $html .= "MONTHLY DOWN PAYMENT";
                                    $html .= "<table border=1 style='width:100%'>";
                                    $html .= "<tr><th>#</th><th>Month</th><th>Balance</th><th>Payment</th></tr>";
                                    $ctr = 1;
                                    for ($i=0; $i < $_SESSION['loanCalculation']['payable']; $i++) { 
                                        $html .= "<tr><td>".$ctr."</td><td>".$monthYear[$i]."</td><td>&#8369; ".round($balance,2)."</td><td>&#8369; ".$payment."</td></tr>";
                                        $balance = $balance - $payment;
                                        
                                        if(round($balance,2) < 0){
                                            break;
                                        }
                                        $ctr++;
                                    }
                                    $html .= "</table>";

                                    // Payment Schedule for Monthly Amortization
                                    $balance = $_SESSION['loanCalculation']['loan'];
                                    $payment = $_SESSION['loanCalculation']['pay'];
                                    $rateYear = explode("|", $_SESSION['loanCalculation']['rateYear']);
                                    //print_r($rateYear);
                                    $interest = $rateYear[1];
                                    $interest = ($interest / 1200) * $balance;
                                    $principal = $payment - $interest;
                                    
                                    $mYear =  explode("-", $rateYear[0]);
                                    //print_r($rateYear);
                                    if(!empty($mYear[1])){
                                        $months = $mYear[1] * 12;
                                    }else{
                                        $months = $mYear[0] * 12;
                                    }
                                    $monthYear = array();
                                    $month = strtotime(date("Y-m-d", $end));
                                    $end = strtotime(date("Y-m-d", mktime(0, 0, 0, $months + $_SESSION['loanCalculation']['payable']+6, 10)));//strtotime('2011-01-01');
                                    while($month < $end)
                                    {
                                         $monthYear[] = date('F Y', $month);
                                         $month = strtotime("+1 month", $month);
                                    }
                                    $html .= "<br><br>";
                                    $html .= "MONTHLY AMORTIZATION";
                                    $html .= "<table border=1 style='width:100%'>";
                                    $html .= "<tr><th>#</th><th>Month</th><th>Balance</th><th>Principal</th><th>Interest</th><th>Payment</th></tr>";
                                    $ctr = 1;
                                    for ($i=0; $i < $months; $i++) { 
                                        
                                        $html .= "<tr><td>".$ctr."</td><td>".$monthYear[$i]."</td><td>".round($balance,2)."</td><td>".round($principal,2)."</td><td>".round($interest,2)."</td><td>".$payment."</td></tr>";
                                        
                                        
                                            $balance = $balance - $principal;
                                            $interest = ($rateYear[1] / 1200) * $balance;
                                            $principal = $payment - $interest;
                                        
                                        if(round($interest,2) < 0){
                                            break;
                                        }
                                        $ctr++;
                        
                                    }
                                    $html .= "</table>";

                                    $html .=            '<table>
                                                            <tr>                                    
                                                                <td>
                                                                    &nbsp;
                                                                </td>
                                                                <td>
                                                                    &nbsp;
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Prepared By:
                                                                </td>
                                                                <td>
                                                                    '.$_POST['preparedBy'].'
                                                                </td>
                                                            </tr>    
                                                            <tr>                                    
                                                                <td>
                                                                    &nbsp;
                                                                </td>
                                                                <td>
                                                                    &nbsp;
                                                                </td>
                                                            </tr>  
                                                            <tr>                                    
                                                                <td>
                                                                    &nbsp;
                                                                </td>
                                                                <td>
                                                                    &nbsp;
                                                                </td>
                                                            </tr>  
                                                            <tr>                                    
                                                                <td>
                                                                    &nbsp;
                                                                </td>
                                                                <td>
                                                                    &nbsp;
                                                                </td>
                                                            </tr>   
                                                        </table>
                                                        
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <img src="http://suntrustph.com/images/iconbox.jpg" class="suntrust">
                                                                </td>
                                                                <td>
                                                                    &nbsp;Copyright 2015. Suntrust Properties, Inc. All Rights Reserved.
                                                                </td>
                                                            </tr>   
                                                        </table>';
                                    $html .=        "</div>";
                                    $html .=    "</body>";
                                    $html .= "</html>";
                                    $file = 'print/loanCalculation.html';
                                    file_put_contents($file, $html);
                                    $_SESSION['html'] = $html;
                                }

                                if(!empty($_POST['btnEmail'])){
                                    //var_dump($_SESSION['loanCalculation']);
                                    emailLoanPayment($propertyId, $_SESSION['loanCalculation'], $_SESSION['html']);
                                }
                                
                            ?>
                    </div>												
                </div>
			</div>	
        </div>
	</div>	
</div>

<?php include("includes/footer.php"); ?>