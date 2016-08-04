<?php include("includes/header.php"); ?>
<?php
    $banks = array('pagibig' => array('5' => '6', '10' => '7', '15' => '8.5', '20' => '9.5', '25' => '10.5', '30' => '11.5'),
                   'bdo' => array('1' => '5.5', '2-3' => '6.5', '4-5' => '6.88', '6-10' => '8.5', '11-15' => '11', '16-20' => '11.5'),
                   'bpi' => array('1' => '5.5', '2-3' => '6.5', '4-5' => '6.88', '6-10' => '8', '11-15' => '9.5', '16-20' => '11.5'),
                   'chinabank' => array('1' => '7.5', '2' => '8.5', '3' => '8.5', '5' => '9.0', '10' => '10.25', '15' => '11', '20' => '11.5', '25' => '11.5'),
                   'unionbank' => array('1' => '6.5', '3' => '7.5', '5' => '8.5', '6-10' => '10.5', '11-15' => '11.5'),
                   'suntrust' => array('3' => '8', '5' => '10', '10' => '14', '15' => '16')
                   );
    $rateRadioBtn = empty($_GET['bank']) ? '' : $_GET['bank'];
    $rateYear = empty($_GET['rateyr']) ? '' : $_GET['rateyr'];
?>
<script>
$(function() {
    function changeVal(){
        totalPrice = $('.totalPrice').val();
        dp =  $('.dp').val();
        rateRadioBtn = $('.rateRadioBtn').val();
        rateYear = $('.rateYear').val();
        //pay = <?php echo $_GET['pay'];?>

        //window.location = "/loanCalcUser.php?totalPrice="+totalPrice+"&dp="+dp+"&payable="+payable+"&cashout="+cashout+"&payDP="+payDP+"&loan="+loan+"&bank="+rateRadioBtn+"&rateyr="+rateYear+"&pay="+pay;
        window.location = "/loanCalcUser.php?bank="+rateRadioBtn+"&rateyr="+rateYear+"&totalPrice="+totalPrice+"&dp="+dp;//+"&payable="+payable;

    }

    $('select.rateRadioBtn').val('<?php echo $rateRadioBtn;?>');
    $('select.rateYear').val('<?php echo $rateYear;?>');
    //$('select.totalPrice').val('<?php echo $totalPrice;?>');

    $( ".rateRadioBtn" ).change(function() {
      changeVal();
    });
    $( ".rateYear" ).change(function() {
      changeVal();
    });

    $( ".resetCalcBtn" ).click(function() {
        window.location = "/loanCalcUser.php";
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
                         <li><a href="loanCalcUser.php">Loan Calculator</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="panel panel-info">
                <div class="panel-heading">Loan Calculator</div>
                <div class="panel-body">
                    <div class="table-responsive">
                            <form name="calc" role="form" method="POST">

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <label for="totalPrice">Total Contract Price</label>
                                            <input type="text" onkeypress='return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0' class="form-control totalPrice" value="<?php echo $_GET['totalPrice'];?>" name="totalPrice" placeholder=""  data-error="Required" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <label for="dpLabel">DP %</label>
                                            <input type="text" onkeypress='return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0 || event.charCode == 46' class="form-control dp" value="<?php echo $_GET['dp'];?>" name="dp" placeholder=""  data-error="Required" required>
                                            <div id="dpLabel" name="dpLabel" class="help-block"><?php echo "Down Payment Total: ". ($_GET['dp']/100) * $_GET['totalPrice'];?></div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div id="dpLabel" name="dpLabel" class="help-block"><?php //echo $_GET['dp'] * $_GET['totalPrice'];?></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <label for="payDpMonths">Payable within <em>(Months)</em></label>
                                            <input type="text" onkeypress='return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0' class="form-control payable" value="<?php echo $_GET['payable'];?>"  name="payable" placeholder=""  data-error="Required" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <label for="cashOut">Cashout</label>
                                            <input type="text" onkeypress='return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 0' class="form-control cashout" value="<?php echo $_GET['cashout'];?>"  name="cashout" placeholder="">
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <label for="cashOut">Monthly Payment <em>(DP)</em></label>
                                            <input type="text" class="form-control payDP" value="<?php echo $_GET['payDP'];?>"  name="payDP" placeholder="" disabled>
                                            <div class="help-block with-errors"><?php //echo $_SESSION['payDP'];?></div>
                                        </div>
                                        <div class="col-sm-4">

                                        </div>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <label for="loanAmount">Loanable Amount <em>(Amortization)</em></label>
                                            <input type="text" class="form-control loan" value="<?php echo $_GET['loan'];?>"  name="loan" placeholder="" disabled>
                                            <div class="help-block with-errors"><?php //echo $_SESSION['loan'];?></div>
                                        </div>
                                        <div class="col-sm-4">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8">
                                                <label for="termsMonth">Loan Type</label>
                                                <select class="form-control rateRadioBtn" name="bank" placeholder=".input-sm">
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
                                                <input type="hidden" name="rateYear" value="<?php echo $_GET['rateyr']; ?>"></input>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <label for="monthlyPayment">Monthly Payment <em>(Amortization)</em></label>
                                            <input type="text" class="form-control pay" value="<?php echo $_GET['pay'];?>" name="pay" placeholder="" disabled>
                                            <div class="help-block with-errors"><?php //echo $_SESSION['pay'];?></div>
                                        </div>
                                        <div class="col-sm-4">

                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary" name="calcu" value="Submit"></input>
                                <input type="reset" class="btn btn-primary resetCalcBtn" value="Reset">
                            </form>
                            <?php

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
                                    // $_SESSION['pay'] = $_POST['pay'];
                                    // $_SESSION['payDP'] = $_POST['payDP'];
                                    // $_SESSION['loan'] = $_POST['loan'];

                                    header("Location: /loanCalcUser.php?totalPrice=".$_POST['totalPrice']."&dp=".$_POST['dp']."&loan=".$_POST['loan']."&bank=".$_POST['bank']."&rateyr=".$_POST['rateYear']."&pay=".$_POST['pay']);
                                    echo "<pre>";
                                    print_r($_POST);
                                    // print_r($_SESSION);
                                }
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
