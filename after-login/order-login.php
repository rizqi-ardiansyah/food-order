<?php
    ob_start();
    include('checking/menu.php'); 
?>
    <?php
    //Check wether food is set or not
    if(isset($_GET['food_id'])){
        //Get the food id and details of the selected foof
        $food_id = $_GET['food_id'];
        //Get the details of the selected food
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count == 1){
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];

        }else{
            //Akan terhubung ke halaman utama
            header('location:'.SITEURL.'after-login/index-login.php');
        }
    }else{
        header('location:'.SITEURL.'after-login/index-login.php');
    } ?>  
    <?php 
        if(isset($_SESSION['order']))//Checking whether the session is set or not
        {
            echo $_SESSION['order']; //Display session message
            unset($_SESSION['order']); //Removing session message
        }
    ?>            
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search" data-aos="zoom-in" data-aos-duration="1200">
        <div class="container">
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
            <form action="" method="POST" class="order">
                <fieldset>
                    <legend style="color: white;">Selected Food</legend>
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
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="title" value="<?php echo $title;?>">

                        <!-- <input type="hidden" name="id" value="<?php echo $food_id;?>"> -->

                        <p class="food-price">Rp <?php echo $price;?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>

                        <h4>ID Table : <?php echo $_SESSION['cust'];?></h4>
                        <input type="hidden" name="id_table" value="<?php echo $_SESSION['cust'];?>">
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend style="color: white;">Delivery Details</legend>
                    <!--  <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Full Name" class="input-responsive form-control" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="Phone Number" class="input-responsive form-control" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="form-control input-responsive" required></textarea> -->

                    <input type="submit" name="submit" value="Add to Chart" class="btn btn-primary">

                </fieldset>
            </form>

            <?php
                //Cek apakah tombol submit berhasil di clik
                if(isset($_POST['submit'])){
                    //Proses mendapatkan data
                    $id = $_GET['id_cart'];
                    $id_tbl = $_POST['id_table'];
                    $food = $_POST['title'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $sub_total = $price * $qty;
                    $sqli = "SELECT * FROM tbl_cart WHERE title = '$food' AND id_table = '$id_tbl'";
                    $qry = mysqli_query($conn, $sqli);
                    $rowCheck = mysqli_num_rows($qry);
                    //If data exist in table
                    if($rowCheck > 0) {
                        $update = "UPDATE tbl_cart SET qty = '$qty' WHERE id_table = '$id_tbl' AND title = '$food'";
                        $change = mysqli_query($conn, $update);
                        if($change == true){
                            $_SESSION['order'] = "<div class = 'sukses text-center'>Food successfully update to Cart</div>";
                            header("Location: http://localhost:8080/food-order/after-login/order-login.php");
                        } else {
                            //Gagal di simpan
                            $_SESSION['order'] = "<div class = 'eror text-center'>Failed to added food</div>";
                            header("Location: http://localhost:8080/food-order/after-login/index-login.php");
                        }
                    } else {
                        $sql2 = "INSERT INTO tbl_cart(id_table, title, price, qty, sub_total) 
                        VALUES('$id_tbl','$food', '$price', '$qty', '$sub_total')";
                        //proses eksekusi
                        $res2 = mysqli_query($conn, $sql2);
                        if($res2 == true){
                            //Data akan tersimpan
                            $_SESSION['order'] = "<div class = 'sukses text-center'>Food successfully added to Cart</div>";
                            header("Location: http://localhost:8080/food-order/after-login/order-login.php");
                        } else {
                            //Gagal di simpan
                            $_SESSION['order'] = "<div class = 'eror text-center'>Failed to added food</div>";
                            header("Location: http://localhost:8080/food-order/after-login/index-login.php");
                        }
                    }
                } 
               ?>
               
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

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
    <script>
        AOS.init();
    </script>
    <!-- social Section Ends Here -->
<?php
    include('../partials-front/footer.php');
    ob_flush();
?>
    <!-- // Menghitung total
    // date_default_timezone_set("Asia/Jakarta");
    // $order_date = date("Y-m-d H:i:sa");
    // $status = "Ordered";
    // $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
    // $customer_contact  = mysqli_real_escape_string($conn, $_POST['contact']);
    // $customer_address = mysqli_real_escape_string($conn, $_POST['address']);
    // $sql2 = "INSERT INTO tbl_order(id_table, food, price, qty, total, order_date, status, customer_name, customer_contact, customer_address) VALUES('$id_tbl', '$food', '$price', '$qty', '$total', '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_address')"; -->
