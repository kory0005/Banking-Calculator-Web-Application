<?php include("./Lab4Common/Functions.php") ?>

<?php
    session_start();
    
    if(!isset($_SESSION["btnCheckbox"])) {
        header("Location: Disclaimer.php");
        exit();
    }
    
    //var_dump($_SESSION["btnCheckbox"]);
    
    
    if(isset($_POST["btnSubmit"])) {
        $nameError = ValidateName($_POST["name"]);
        $postalCodeError = ValidatePostalCode($_POST["postalCode"]);
        $phoneNumberError = ValidatePhone($_POST["phoneNumber"]);
        $emailError = ValidateEmail($_POST["email"]);      

        if (!isset ($_POST["btnRadio2"])) {
            $btnRadio2Error = "Preferred Contact Method is required";
        } else if( $_POST["btnRadio2"] == "phone" ) {
            if (empty($_POST["checkbox"])) {
                $checkboxError = "When preffered contact method is phone, you have to select 1 or more contact times";
            }
        }
        
        $errors = $nameError . $postalCodeError . $phoneNumberError . $emailError . $btnRadio2Error . $checkboxError;
        
        
        if ($errors == "") {
            $_SESSION["name"] = $_POST["name"];
            $_SESSION["phoneNumber"] = $_POST["phoneNumber"];
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["btnRadio2"] = $_POST["btnRadio2"];
            
            if( $_SESSION["btnRadio2"] == "phone" ) {
                $_SESSION["checkbox"] = $_POST["checkbox"];
            }
            
            header ("Location: DepositCalculator.php");
            exit();
        }
        
        
    } else {
        $nameError = $postalCodeError = $phoneNumberError = $emailError = $btnRadio2Error = $checkboxError = "";
    }
    
    
    if (isset($_POST["btnClear"])) {
        $_POST = array();
    }
    
    
    
?>

<?php include ("./Lab4Common/Header.php"); ?>

<div class="container">
    <form action="CustomerInfo.php" method="POST">
        <h1 class="text-center">Customer Information</h1>
        
        <br />
        
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Your Name</label>
            <div class="col-sm-3">
                <input type = "text" name = "name" value="<?= $_POST["name"] ?>" class = "form-control">
            </div>
            <p class="error"><?= $nameError ?></p>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Postal Code</label>
            <div class="col-sm-3">
                <input type = "text" name = "postalCode" value="<?= $_POST["postalCode"] ?>" class = "form-control">
            </div>
            <p class="error"><?= $postalCodeError ?></p>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Phone Number</label>
            <div class="col-sm-3">
                <input type = "tel" name = "phoneNumber" value="<?= $_POST["phoneNumber"] ?>" class = "form-control">
            </div>
            <p class="error"><?= $phoneNumberError ?></p>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Email Address</label>
            <div class="col-sm-3">
                <input type = "email" name = "email" value="<?= $_POST["email"] ?>" class = "form-control">
            </div>
            <p class="error"><?= $emailError ?></p>
        </div>

        <hr>
        
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Preferred Contact Method</label>

            <div class="col-sm-1 offset-sm-2">                
                <input type="radio" name="btnRadio2" <?php if (!empty($_POST["btnRadio2"]) && $_POST["btnRadio2"]=="phone") {echo "checked";} ?> value="phone" >
                <label class="form-check-label">Phone</label>
            </div>
            <div class="col-sm-1 offset-sm-2">
                <input type="radio" name="btnRadio2" <?php if (!empty($_POST["btnRadio2"]) && $_POST["btnRadio2"]=="email") {echo "checked";} ?> value="email" >
                <label class="form-check-label">Email</label>
            </div>
                
            <p class="error"><?= $btnRadio2Error ?></p>
        </div>
        
        <div class="form-group row">
            <label class="col-sm-11 col-form-label">When can we contact you? (if phone is selected)</label>
            
            <br />
            
            <div class="col-sm-2 offset-sm-1">
                <input type="checkbox" name="checkbox[]" <?php if (isset($_POST["checkbox"]) && in_array("morning", $_POST["checkbox"])) {echo "checked";} ?> value="morning">
                <label>Morning</label>
            </div>
            <div class="col-sm-2 offset-sm-1">
                <input type="checkbox" name="checkbox[]" <?php if (isset($_POST["checkbox"]) && in_array("afternoon", $_POST["checkbox"])) {echo "checked";} ?> value="afternoon">
                <label>Afternoon</label>
            </div>
            <div class="col-sm-2 offset-sm-1">
                <input type="checkbox" name="checkbox[]" <?php if (isset($_POST["checkbox"]) && in_array("evening", $_POST["checkbox"])) {echo "checked";} ?> value="evening">
                <label>Evening</label>
            </div>
            <br />
            <p class="error"><?= $checkboxError ?></p>
        </div>
        
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" name="btnSubmit" class="btn btn-primary">Submit</button>
                <button type="submit" name="btnClear" class="btn btn-primary">Clear</button>
            </div>
        </div>

    </form>
</div>

<?php include("./Lab4Common/Footer.php"); ?>