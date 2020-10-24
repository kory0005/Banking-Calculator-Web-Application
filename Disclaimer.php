<?php include("./Lab4Common/Functions.php") ?>

<?php 

    session_start();

    if(isset($_POST["btnStart"])) {
        $TermsError = ValidateTerms($_POST["btnCheckbox"]);
        
        
        if (!empty($_POST["btnCheckbox"])) {
            $_SESSION["btnCheckbox"] = $_POST["btnCheckbox"];
            header("Location: CustomerInfo.php");
            exit();
        }
    }
    
    
?>

<?php include("./Lab4Common/Header.php"); ?>

<div class="container">
    <h1 class="text-center">Terms and Conditions</h1>
    <br />
    <ul class="list-group">
        <li class="list-group-item">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
        <li class="list-group-item">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Cursus metus aliquam eleifend mi in nulla posuere. Eleifend quam adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus.</li>
        <li class="list-group-item">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Purus in massa tempor nec feugiat nisl pretium fusce. Dictum non consectetur a erat nam.</li>
    </ul>
    
    <form action="Disclaimer.php" method="POST">
        <div class="form-check">
            <label class="error"><?php echo $TermsError ?></label>
            <br />
            <input class="form-check-input" type="checkbox" name="btnCheckbox" <?php if (isset($_POST["btnCheckbox"])) {echo "checked";} ?> >
            <label class="form-check-label">I have read and agree with the terms and conditions</label>
            <br />
        </div>
        <button type="submit" name="btnStart" class="btn btn-primary" >Start</button>
    </form>
</div>

<?php include("./Lab4Common/Footer.php"); ?>
