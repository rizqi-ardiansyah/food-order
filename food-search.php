<?php
    include('partials-front/menu.php');
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <?php
                 //Get the search keyword
                //$search = $_POST['search'];
                $search = mysqli_real_escape_string($conn, $_POST['search']);
            ?>

            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
               
                //SQL Query to get food or search keyword
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE'%$search%'";

                //Execute the query
                $res = mysqli_query($conn, $sql);

                //Count rows
                $count = mysqli_num_rows($res);

                if($count>0){
                    //Food available
                    while($row=mysqli_fetch_assoc($res)){
                        //Get details
                        $food_id = $row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $stock=$row['stock'];
                        $description=$row['description'];
                        $image_name=$row['image_name'];
                        ?>

                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        //Check whether image is available or not
                                        if($image_name == ""){
                                            //Display message
                                            echo "<div class='eror'>Image is not available</div>";
                                        }else{
                                            //Image available
                                            ?>
                                             <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name?>" alt="Pizza" class="img-responsive img-curve">
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
                                            <a href="<?php echo SITEURL;?>after-login/customer-login.php" class="btn btn-primary">Order</a>
                                            <div class="btnStock">Stock : <?php echo $stock;?></div>

                                        <?php 
                                        }
                                    ?>
                                    <!-- <a href="#" class="btn btn-primary">Order Now</a> -->
                                </div>
                            </div>

                        <?php
                    }
                }else{
                    //Food not available
                    echo "<div class='eror'>Food not found</div>";
                }
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <section class="social">
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

<?php
    include('partials-front/footer.php');
?>