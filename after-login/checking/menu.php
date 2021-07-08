<?php
    include('../config/constants.php');
    include('login-cust-check.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../images/Icon Restoran.ico">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar" data-aos="fade-down" data-aos-duration="1500">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="../images/LogoRestoran.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL;?>after-login/index-login.php?">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>after-login/category-login.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>after-login/foods-login.php">Foods</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>after-login/status-order-login.php">Ordered Status</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>after-login/customer-login.php">Logout</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
        <script>
                AOS.init();
        </script>
    <!-- Navbar Section Ends Here -->

   