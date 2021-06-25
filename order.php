<?php
    include('partials-front/menu.php');
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
            header('location:'.SITEURL);
        }
    }else{
        header('location:'.SITEURL);
    }
?>
        
    <?php 
        if(isset($_SESSION['order']))//Checking whether the session is set or not
        {
            echo $_SESSION['order']; //Display session message
            unset($_SESSION['order']); //Removing session message
        }
    ?>            


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

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
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
            //Cek apakah tombol submit berhasil di clik
            if(isset($_POST['submit'])){
                //Proses mendapatkan data
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty; // Menghitung total
                $order_date = date("Y-m-d h:i:sa");
                $status = "Ordered";
                $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
                $customer_contact  = mysqli_real_escape_string($conn, $_POST['contact']);
                $customer_email = mysqli_real_escape_string($conn, $_POST['email']);
                $customer_address = mysqli_real_escape_string($conn, $_POST['address']);

                //proses menyimpan data ke database
                $sql2 = "INSERT INTO tbl_order SET
                    food = '$food',
                    price = $price,
                    qty = $qty,
                    total = $total,
                    order_date = '$order_date',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                ";
                //proses eksekusi
                $res2 = mysqli_query($conn, $sql2);
                //Cek apakah Query berhasil
                if($res2 == true){
                    //Data akan tersimpan
                    $_SESSION['order'] = "<div class = 'sukses text-center'>Food ordered successfully</div>";
                    header('location:'.SITEURL);
                }else{
                    //Gagal di simpan
                    $_SESSION['order'] = "<div class = 'eror text-center'>Failed to order food</div>";
                    header('location:'.SITEURL);
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
    <!-- social Section Ends Here -->

<?php
    include('partials-front/footer.php');
?>