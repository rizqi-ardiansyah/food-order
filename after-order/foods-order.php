<?php
    include('checking/menu.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Daftar Makanan</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="../images/Icon Restoran.ico">
    <link rel="stylesheet" href="../css/stylestatus.css">
        

    </head>
    <body>
 <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu" data-aos="fade-up" data-aos-duration="1500">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

           <?php
                //Getting food from database that are active and featured
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes'";

                //Execute query
                $res2 = mysqli_query($conn, $sql2);
                //Count rows
                $count2 = mysqli_num_rows($res2);
                //Check whether food available or not
                if($count2>0){
                    //Food available
                    while($row=mysqli_fetch_assoc($res2)){
                        //Get all value
                        $food_id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $stock = $row['stock'];
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
                            
                            <?php
                                if($stock == 0){
                                ?>
                                   <div class="btnStock">Stock Out</div>
                                <?php
                                }else{
                                ?>
                                    <a href="<?php echo SITEURL;?>after-order/order-order.php?order_id=<?php echo $id;?>&food_id=<?php echo $food_id;?>" class="btn btn-primary">Order</a>
                                    <div class="btnStock">Stock : <?php echo $stock;?></div>

                                <?php 
                                }
                            ?>

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

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <section class="social" data-aos="fade-up" data-aos-duration="1700">
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