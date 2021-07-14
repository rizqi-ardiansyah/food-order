<?php 
    if(!isset($_SESSION['cust'])){
        $_SESSION['auto-login-cust'] = "<div class='eror text-center'>Please Login First </div>";
        header ("location:".SITEURL.'after-login/customer-login.php');
    }
?>