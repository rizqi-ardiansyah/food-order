<?php
    include('checking/menu.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Kategori Makanan</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="../images/Icon Restoran.ico">

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

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

          
            <?php
                //Create SQL Query to display categories
            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
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

                    <a href="<?php echo SITEURL;?>after-login/category-foods-login.php?category_id=<?php echo $id;?>" data-aos="zoom-in" data-aos-duration="2000">
                    <div class="box-3 float-container">
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