<?php include "./Lab4Common/Header.php" ?>

<?php 

    session_start();
    
//    if(!isset($_SESSION["btnCheckbox"])) {
//        header("Location: Disclaimer.php");
//        exit();
//    }

    if(!isset($_SESSION["name"]) || !isset($_SESSION["phoneNumber"]) || !isset($_SESSION["email"]) || !isset($_SESSION["btnRadio2"]) ) {
        echo "<div class=\"container\"><br /><h1> Thank you for using our deposit calculation tool.</h1></div>";
    } else {
        
        ?>
        <div class="container">
            <h1> Thank you, <span class="distinct"> <?= $_SESSION["name"] ?></span>, for using our deposit calculation tool.</h1>
            <br />
            <?php

            if ($_SESSION["btnRadio2"] == "email") {
                echo "<h4 class=\"pt-2\">An email about the details of our GIC has been sent to " . $_SESSION["email"] . "</h4>";
            } else {
                $selectedTime = implode(' or ' , (array)$_SESSION["checkbox"]);
                print "<h4 class=\"pt-2\">Our customer service department will call you tomorrow " . $selectedTime . " at " . $_SESSION["phoneNumber"] . "</h4> ";
            }

            ?>
        </div>
        
       <?php 
    }
    
    session_destroy();

?>

<?php include "./Lab4Common/Footer.php"  ?>