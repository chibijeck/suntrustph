<?php include("includes/header.php"); ?>	
<?php $propertyId = $_GET['id']; ?>
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
                            <script>
                                function showpay() {
                                    if ( (document.calc.months.value == null || document.calc.months.value.length == 0) 
                                      || (document.calc.rate.value == null || document.calc.rate.value.length == 0) )
                                    { 
                                        document.calc.pay.value = "Incomplete data";
                                    } else {
                                        var price = document.calc.totalPrice.value;
                                        var dp = document.calc.dp.value / 100;
                                        var payable = document.calc.payable.value;
                                        var amort = price - (price * dp);
                                        //document.calc.dpLabel.value = (price * dp);
                                        document.getElementById("dpLabel").innerHTML = "Down Payment: " + (price * dp);
                                        document.calc.payDP.value = (price * dp) / payable;
                                        document.calc.loan.value = amort;
                                        var princ = amort;//document.calc.loan.value;
                                        var term  = document.calc.months.value;
                                        var intr   = document.calc.rate.value / 1200;
                                        document.calc.pay.value = princ * intr / (1 - (Math.pow(1/(1 + intr), term)));
                                    }
                                    // payment = principle * monthly interest/(1 - (1/(1+MonthlyInterest)*Months))
                                }
                            </script>
                            <form name="calc" role="form" method="POST">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8">
                        					<label for="totalPrice">Total Contract Price</label>
                        					<input type="text" onkeypress='return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0' class="form-control" value=""  name="totalPrice" placeholder=""  data-error="Required" required>
                        				</div>
                					    <div class="col-sm-4">
                        					<div class="help-block"><?php if(!empty($_POST['totalPrice'])){ echo "Contract Price: ".$_POST['totalPrice']; } ?></div>
                					    </div>
                					</div>
                				</div>
                				<div class="form-group">
                				    <div class="row">
                                        <div class="col-sm-8">
                        					<label for="dpLabel">DP %</label>
                        					<input type="text" onkeypress='return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0' class="form-control" value=""  name="dp" placeholder=""  data-error="Required" required>
                        				</div>
                					    <div class="col-sm-4">
                        					<div id="dpLabel" name="dpLabel" class="help-block"><?php if(!empty($_POST['dp'])){ echo $dp = ($_POST['dp']/100) * $_POST['totalPrice']; } ?></div>
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
                        					<div class="help-block with-errors"><?php if(!empty($_POST['payable'])){ echo $_POST['payable']." Months"; } ?></div>
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
                        					<div class="help-block with-errors"><?php if(!empty($_POST['payDP'])){ echo "Payment: ".$_POST['payDP']; } ?></div>
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
                        					<div class="help-block with-errors"><?php if(!empty($_POST['loan'])){ echo "Loan Amount: ".$_POST['loan']; } ?></div>
                				        </div>
                					</div>
                				</div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8">
                        					<label for="termsMonth">Terms <em>(in months)</em></label>
                        					<input type="text" onkeypress='return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0' class="form-control" value=""  name="months" placeholder=""  data-error="Required" required>
                        				</div>
                					    <div class="col-sm-4">
                        					<div class="help-block with-errors"><?php if(!empty($_POST['months'])){ echo "Terms: ".$_POST['months']; } ?></div>
                        				</div>
                					</div>
                				</div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8">
                        					<label for="interestRate">Interest Rate</label>
                        					<input type="text" onkeypress='return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0' class="form-control" value=""  name="rate" placeholder=""  data-error="Required" required>
                        				</div>
                					    <div class="col-sm-4">
                        					<div class="help-block with-errors"><?php if(!empty($_POST['rate'])){ echo "Rate: ".$_POST['rate']."%"; } ?></div>
                        				</div>
                					</div>
                				</div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8">
                        					<label for="monthlyPayment">Monthly Payment <em>(Amortization)</em></label>
                        					<input type="text" class="form-control" value=""  name="pay" placeholder="" readonly="readonly" data-error="Required" required>
                        				</div>
                					    <div class="col-sm-4">
                        					<div class="help-block with-errors"><?php if(!empty($_POST['pay'])){ echo "Monthly Amortization: ".$_POST['pay']; } ?></div>
                        				</div>
                					</div>
                				</div>
                                <input type="submit" class="btn btn-primary" onClick='showpay()' name="calcu" value="Calculate">
                                <input type="reset" class="btn btn-primary" value="Reset">
                            </form>
                            <?php
                            
                    			$payment = new payment();
                    			$payment->selectOne($propertyId);	
                    			$pId = $payment->getid();
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
                                    //var_dump($_POST);
                                    $file = 'print/loanCalculation.html';
                                    
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
                                    $html .=        "<img src='/images/logo.png' class='suntrust'>";
                                    $html .=            "<br><br>";
                                    $html .=            "<h5>Total Contract Price   :".$_POST['totalPrice']."</h5>";
                                    $html .=            "<h5>Down Payment Percentage: ".$_POST['dp'] ."% = ". ($_POST['dp']/100) * $_POST['totalPrice'] ."</h5>";
                                    $html .=            "<h5>Payable Within (Months): ".$_POST['payable']."</h5>";
                                    $html .=            "<h5>Monthly Payment        : ".$_POST['payDP']."</h5>";
                                    $html .=            "<h5>Loan Amount            : ".$_POST['loan']."</h5>";
                                    $html .=            "<h5>Terms                  : ".$_POST['months']." months</h5>";
                                    $html .=            "<h5>Interest               : ".$_POST['rate']."% Annual"."</h5>";
                                    $html .=            "<h5>Payment                : ".$_POST['pay']."</h5>";
                                    $html .=            '<table>
                    											<tr>
                    												<td>
                    													Details
                    												</td>
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
                    													Room :
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
                    											 									
                    										</table>	
                    
                    										<table>
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
                    											<tr>									
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
                                    // $html .=            "<br><br><br><br><br><br><br><br><br><br>";
                                    // $html .=            "<img src='/images/iconbox.jpg' class='suntrust'>Copyright 2015. Suntrust Properties, Inc. All Rights Reserved.";
                                    $html .=        "</div>";
                                    $html .=    "</body>";
                                    $html .= "</html>";
                                    $_SESSION['loanCalculation'] = $_POST;
                                    file_put_contents($file, $html);
                                }
                                
                                if(!empty($_POST['btnEmail'])){
                                    //var_dump($_SESSION['loanCalculation']);
                                    emailLoanPayment($propertyId, $_SESSION['loanCalculation']);
                                }
                                
                            ?>
                    </div>												
                </div>
			</div>	
        </div>
	</div>	
</div>

<?php include("includes/footer.php"); ?>