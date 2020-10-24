<?php include "./Lab4Common/Functions.php" ?>

<?php 

    session_start();
    
    if(!isset($_SESSION["btnCheckbox"])) {
        header("Location: Disclaimer.php");
        exit();
    }
    
    if(!isset($_SESSION["name"]) || !isset($_SESSION["phoneNumber"]) || !isset($_SESSION["email"]) || !isset($_SESSION["btnRadio2"]) ) {
        if(!isset($_SESSION["checkbox"]))
        header("Location: CustomerInfo.php");
        exit();
    }
    
    if ($_SESSION["btnRadio2"] == "phone" && !isset($_SESSION["checkbox"])){
            header("Location: CustomerInfo.php");
            exit();
        }
    
    
    if(isset($_POST["btnCalculate"])) {
        $principalAmountError = ValidatePrincipal($_POST["principalAmount"]);
        $interestRateError = ValidateRate($_POST["interestRate"]);
        $yearsToDepositError = ValidateYears($_POST["yearsToDeposit"]);
        
        $errors = $principalAmountError . $interestRateError . $yearsToDepositError;
        
    } else {
        $principalAmountError = $interestRateError = $yearsToDepositError = "";
    }
    
    
    if (isset($_POST["btnClear"])){
        $_POST = array();
    }

?>


<?php include "./Lab4Common/Header.php" ?>

<div class="container">
    <form action="DepositCalculator.php" method="POST">
        <br />
        <h4>Enter principal amount, interest rate and select number of years to deposit</h4>
        <br />  
        
        <div class="form-group row">
            <label class = "col-sm-2 col-form-label">Principal Amount</label>
            <div class="col-sm-3">
                <input type = "text" name = "principalAmount" value="<?= $_POST["principalAmount"] ?>" class = "form-control">
            </div>
            <p class="error"><?= $principalAmountError ?></p>
        </div>
        <div class="form-group row">
            <label class = "col-sm-2 col-form-label">Interest Rate (%)</label>
            <div class="col-sm-3">
                <input type = "text" name = "interestRate" value="<?= $_POST["interestRate"] ?>" class = "form-control">
            </div>
            <p class="error"><?= $interestRateError ?></p>
        </div>
        <div class="form-group row">
            <label class = "col-sm-2 col-form-label">Years to Deposit</label>
            <div class="col-sm-3">
                <select name="yearsToDeposit" class="custom-select form-control" id="yearsToDeposit">
                    <option value="">Select...</option>

                    <?php 
                        $range = range(1, 25);
                        foreach ($range as $num) {
                            if ($_POST["yearsToDeposit"] == $num) {
                                echo "<option value='$num' selected>$num</option>";
                            }
                            echo "<option value='$num'>$num</option>";
                        }
                    ?>

                </select>
            </div>
            <p class="error"><?= $yearsToDepositError ?></p>
        </div>
        
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" name="btnCalculate" class="btn btn-primary">Calculate</button>
                <button type="submit" name="btnClear" class="btn btn-primary">Clear</button>
            </div>
        </div>
        
        <?php if(isset($_POST["btnCalculate"]) && empty($errors)) { ?>
        
        <p>The following is the result of the calculation:</p>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Year</th>
                    <th scope="col">Principal at Year Start</th>
                    <th scope="col">Interest for the Year</th>
                </tr>
            </thead>
            <tbody>

            <?php
            $interestRate = $_POST["interestRate"];
            $principalAmount = $_POST["principalAmount"];
                for($i = 1; $i <= $_POST["yearsToDeposit"]; $i++) {

                    $interest = $principalAmount * ($interestRate/100);

            ?>
                        <tr>
                            <th scope="row"><?php print("$i"); ?></th>
                            <td><?php printf( "%.2f", $principalAmount ); ?></td>
                            <td><?php printf( "%.2f", $interest ); ?></td>
                        </tr>

            <?php
                    $principalAmount += $interest;

                }
            ?>
            </tbody>
        </table>
        
        <?php } ?>

    </form>
</div>

<?php include "./Lab4Common/Footer.php" ?>