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
                        <input type="hidden" name="food" value="<?php echo $title;?>">

                        <p class="food-price">Rp <?php echo $price;?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                        <div class="order-label">Id Table</div>
                        <input type="text" name="id_table" class="input-responsive" placeholder="Id Table" required>
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend style="color: white;">Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Full Name" class="input-responsive form-control" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="Phone Number" class="input-responsive form-control" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="form-control input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php
                //Cek apakah tombol submit berhasil di clik
                if(isset($_POST['submit'])){
                    //Proses mendapatkan data
                    $id_tbl = $_POST['id_table'];
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty; // Menghitung total
                    date_default_timezone_set("Asia/Jakarta");
                    $order_date = date("Y-m-d H:i:sa");
                    $status = "Ordered";
                    $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
                    $customer_contact  = mysqli_real_escape_string($conn, $_POST['contact']);
                    $customer_address = mysqli_real_escape_string($conn, $_POST['address']);
                    $sql2 = "INSERT INTO tbl_order(id_table, food, price, qty, total, order_date, status, customer_name, customer_contact, customer_address) VALUES('$id_tbl', '$food', '$price', '$qty', '$total', '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_address')";
                    //proses eksekusi
                    $res2 = mysqli_query($conn, $sql2);
                    if($res2 == true){
                        // $query = "SELECT id_table FROM tbl_meja WHERE id_table = $id_tbl";
                        // $res3 = mysqli_query($conn, $query);
                        //Data akan tersimpan
                        $_SESSION['order'] = "<div class = 'sukses text-center'>Food ordered successfully</div>";
                        header("Location: http://localhost/food-order/after-login/index-login.php");
                    } else {
                        //Gagal di simpan
                        $_SESSION['order'] = "<div class = 'eror text-center'>Failed to order food</div>";
                        header("Location: http://localhost/food-order/after-login/index-login.php");
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