<?php
    include('checking/menu.php');
?>  
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Beranda Restoran</title>
        <link rel="stylesheet" href="/BS/dist/css/bootstrap.min.css">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="images/Icon.ico">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    </head>
    <body>
            <!-- fOOD sEARCH Section Starts Here -->
                <section class="food-search text-center">
                    <div class="container">
                        <form action="<?php echo SITEURL;?>after-login/food-search-login.php" method="POST">
                            <input type="search" name="search" placeholder="Search for Food.." required>
                            <input type="submit" name="submit" value="Search" class="btn btn-primary">
                        </form>

                    </div>
                </section>
                <?php
                    if(isset($_SESSION['login-cust'])){
                        echo $_SESSION ['login-cust'];
                        unset($_SESSION['login-cust']);
                    }
                ?>
                <!-- fOOD sEARCH Section Ends Here -->
                <?php 
                    if(isset($_SESSION['order']))//Checking whether the session is set or not
                    {
                        echo $_SESSION['order']; //Display session message
                        unset($_SESSION['order']); //Removing session message
                    }
                ?>      
                <!-- CAtegories Section Starts Here -->
                <section class="categories">
                    <div class="container">
                        <h2 class="text-center">Explore Foods</h2>

                        <?php
                        //Create SQL Query to display categories
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured ='Yes' LIMIT 3";
                        //Execute the query
                        $res = mysqli_query($conn, $sql);
                        //Count rows ro check whether the category is available or not
                        $count = mysqli_num_rows($res);

                        if($count>0){
                            //Category is available
                            while($row = mysqli_fetch_assoc($res)){
                                //Get the value 
                                $id = $row['id'];
                                $title =$row['title'];
                                $image_name = $row['image_name'];
                                ?>

                                <a href="<?php echo SITEURL;?>after-login/category-foods-login.php?category_id=<?php echo $id;?>">
                                <div class="box-3 float-container" data-aos="zoom-in" data-aos-duration="1500">
                                    <?php
                                        //Check whether image is available or not
                                        if($image_name == ""){
                                            //Display message
                                            echo "<div class='eror'>Image is not available</div>";
                                        }else{
                                            //Image available
                                            ?>
                                                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name?>" alt="Pizza" class="img-responsive img-curve">

                                            <?php
                                        }
                                    ?>
                                
                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                                </a>

                                <?php
                            }
                        }else{
                            //Category is not available
                            echo "<div class='eror'>Category not added</div>";
                        }
                        ?>

                        <div class="clearfix"></div>
                    </div>
                </section>
                <!-- Categories Section Ends Here -->

                <!-- fOOD MEnu Section Starts Here -->
                <section class="food-menu" data-aos="fade-up" data-aos-duration="1500">
                    <div class="container">
                        <h2 class="text-center">Food Menu</h2>

                    
                        <?php
                            //Getting food from database that are active and featured
                            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

                            //Execute query
                            $res2 = mysqli_query($conn, $sql2);
                            //Count rows
                            $count2 = mysqli_num_rows($res2);
                            //Check whether food available or not
                            if($count2>0){
                                //Food available
                                while($row=mysqli_fetch_assoc($res2)){
                                    //Get all value
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    $price = $row['price'];
                                    $description = $row['description'];
                                    $image_name = $row['image_name'];
                        ?>
                                    <div class="food-menu-box">
                                        <div class="food-menu-img">
                                            <?php
                                                //Check whether image is available or not
                                                if($image_name==""){
                                                    //Image not available
                                                    echo "<div class='eror'>Image not available</div>";
                                                }else{
                                                    //Image available
                                                    ?>
                                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                                    <?php
                                                }
                                            ?>
                                            
                                        </div>
                                        <div class="food-menu-desc">
                                            <h4><?php echo $title;?></h4>
                                            <p class="food-price">Rp <?php echo $price;?></p>
                                            <p class="food-detail">
                                                <?php echo $description;?>
                                            </p>
                                            <br>
                                            <a href="<?php echo SITEURL;?>after-login/order-login.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                                        </div>
                                    </div>
                            <?php
                                }
                            }else{
                                //Food not available
                                echo "<div class='eror'>Food not available</div>";
                            }
                        ?>


                        <div class="clearfix"></div>

                        

                    </div>

                    <p class="text-center">
                        <a href="#">See All Foods</a>
                    </p>
                </section>
                <!-- fOOD Menu Section Ends Here -->

                <!-- social Section Starts Here -->
                <section class="social" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="1500">
                    <div class="container text-center">
                        <ul>
                            <li>
                                <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                            </li>
                            <li>
                                <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                            </li>
                            <li>
                                <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                            </li>
                        </ul>
                    </div>
                </section>
                <!-- social Section Ends Here -->
                    <script>
                        AOS.init();
                    </script>
            <?php
                include('../partials-front/footer.php');
            ?>

        <script src="" async defer></script>
  