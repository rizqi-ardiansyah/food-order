<?php
    include('config/constants.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="images/Icon Restoran.ico">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar" data-aos="fade-down" data-aos-duration="1500">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/LogoRestoran.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                    </li>
                    <li>
                    <div class="dropdown">
                    <button class="dropbtn" style="font-weight: 400;"><b>Customer</b> <i class=" fa fa-caret-down"></i></button>
                        <div class="dropdown-content">
                            <a href="<?php echo SITEURL;?>after-login/customer-login.php">Login</a>
                            <a href="<?php echo SITEURL;?>status-order.php">Ordered Status</a>
                        </div>
                    </div>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>admin/login.php">Login</a>
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

   