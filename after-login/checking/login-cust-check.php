<?php 
    if(!isset($_SESSION['cust'])){
        $_SESSION['auto-login-cust'] = "<div class='eror text-center'>Please Login First </div>";
        header ("Location: http://localhost/food-order/after-login/customer-login.php");
    }
?>