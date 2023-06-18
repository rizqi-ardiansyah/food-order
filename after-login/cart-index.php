<?php 
    ob_start();
    include('../config/constants.php');
    include('checking/login-cust-check.php');
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Cart Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/cart-style.css">
        <link rel="shortcut icon" href="../images/Icon Restoran.ico"> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
    <nav class="nav navbar-expand shadow" data-aos="fade-down" data-aos-duration="1500" style="color: #ff6b81;">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="../images/LogoRestoran.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>
            <div class="text-right collapse d-flex navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav" style="font-weight: bold;">
                    <li class="navbar-text">
                        <a class="nav-link" href="<?php echo SITEURL; ?>after-login/index-login.php">Home</a>
                    </li>
                    <li class="navbar-text">
                        <a class="nav-link" href="<?php echo SITEURL; ?>after-login/category-login.php">Categories</a>
                    </li>
                    <li class="navbar-text">
                        <a class="nav-link" href="<?php echo SITEURL; ?>after-login/foods-login.php">Foods</a>
                    </li>
					<li class="navbar-text">
                        <a class="nav-link" href="<?php echo SITEURL; ?>after-login/status-order-login.php">Ordered Status</a>
					</li>
					<li class="navbar-text">
                        <a class="nav-link" href="<?php echo SITEURL; ?>after-login/cart-index.php">Cart</a>
					</li>
                    <li class="navbar-text">
                        <a class="nav-link" href="<?php echo SITEURL; ?>after-login/customer-login.php">Logout</a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </nav>
                <div class="container-fluid mt-4">
                <?php
                    if(isset($_SESSION['update']))
                    {
                            echo $_SESSION['update']; //Display session message
                            unset($_SESSION['update']); //Removing session message
                    }
                    if(isset($_SESSION['delete']))
                    {
                            echo $_SESSION['delete']; //Display session message
                            unset($_SESSION['delete']); //Removing session message
                    }
                    if(isset($_SESSION['submit']))
                    {
                            echo $_SESSION['submit']; //Display session message
                            unset($_SESSION['submit']); //Removing session message
                    }
                    if(isset($_SESSION['order']))
                    {
                            echo $_SESSION['order']; //Display session message
                            unset($_SESSION['order']); //Removing session message
                    }
                ?>
                    <h3 class="mt-2 mb-2 container-fluid">Your Cart</h3>
                    <h4 class="mt-2 container-fluid id_tbl" name="id_tbl" id="id_tbl">ID Table : <?php echo $_SESSION['cust'];?></h4>
                    <table class="table table-striped table-bordered mt-4 container-fluid tabel table-responsive">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">Item</th>
                                <th scope="col" class="text-center">Quantity</th>
                                <th scope="col" class="text-center">Price</th>
                                <th scope="col" class="text-center">Sub Total Price</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
<?php 
        $id_tbl = $_SESSION['cust'];
        $sql = "SELECT * FROM tbl_cart WHERE id_table = '$id_tbl'";
        $cek = mysqli_query($conn, $sql);
        if($cek==true){
            $count = mysqli_num_rows($cek);
            $sn = 1;
            if($count>0){
                while($row = mysqli_fetch_assoc($cek)){
                    // $id = $_row['id_table'];
                    $id_cart = $row['id_cart'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $subtotal = $qty * $price;
                    $pricetotal += $subtotal; 
?>
                            <tbody style="padding: 1%;">
                                <tr class="text-center table-striped" style="vertical-align: middle;">
                                    <td scope="row" class="text-center"><?php echo $sn++ ?></td>
                                    <td name="title"><?php echo $title;?></td>
                                    <td name="qty"><?php echo $qty;?></td>
                                    <td name="price"><?php echo $price;?></td>
                                    <td name="subtotal"><?php echo $subtotal;?></td>
                                    <td>
                                        <a class="btn btn-danger" href="<?php echo SITEURL; ?>after-login/remove-item.php?id_cart=<?php echo $id_cart ;?>" style="vertical-align: middle; background-color: #ff6b81; width: 20%;">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>   
<?php
                }
            } else {
                echo "<tr><td colspan='12' class='eror text-center'>Cart is Empty</td></tr>";
            }
        }
?>
                        <tfoot style="padding: 1%;">
                                <tr class="table-striped" style="vertical-align: middle;">
                                <td colspan="5" class="text-lg-start">Total Price</td>
                                <td scope="col-lg-7" class="text-center" name="pricetotal"><?php echo $pricetotal;?></td>
                                </tr>
                        </tfoot>
                </table>
                <form method="POST" action="" class="row g-3 mt-4 mb-4" style="padding: 1%;">
                    <div class="col-md-6">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" require>
                    </div>
                    <div class="col-md-6">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="tel" class="form-control" id="contact" name="contact" require>
                    </div>
                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" require>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Check me out
                        </label>
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <button type="submit" name="submit" class="btn btn-success input-responsive" style="width: 12%;">Checkout</button>
                    </div>
                </form>
                <?php
                if(isset($_POST['submit'])){
                    //Proses mendapatkan data
                    $id_tbl = $_SESSION['cust'];
                    $insert = "INSERT INTO tbl_order(id_table, food, price, qty, total) SELECT id_table, title, price, qty, sub_total FROM tbl_cart";
                    $check = mysqli_query($conn, $insert);
                             date_default_timezone_set("Asia/Jakarta");
                             $id_order = $_GET['id'];
                             $order_date = date("Y-m-d H:i:sa");
                             $status = "Ordered";
                             $customer_name = mysqli_real_escape_string($conn, $_POST['full_name']);
                             $customer_contact  = mysqli_real_escape_string($conn, $_POST['contact']);
                             $customer_address = mysqli_real_escape_string($conn, $_POST['address']);
                             $sql2 = "UPDATE tbl_order SET status = '$status', order_date = '$order_date', customer_name = '$customer_name', customer_contact ='$customer_contact', customer_address = '$customer_address' WHERE id_table = '$id_tbl' AND status != 'Delivered'";
                            //proses eksekusi
                    $checking = "SELECT * FROM tbl_order WHERE id = '$id_order'";
                            $res2 = mysqli_query($conn, $sql2);
                            if($res2 == true && $check == true){
                                $id = $_SESSION['cust'];
                                $sqli = "DELETE FROM tbl_cart WHERE id_table = '$id'";
                                $res = mysqli_query($conn, $sqli);
                                //Data akan tersimpan
                                $_SESSION['order'] = "<div class = 'sukses text-center'>Order food is successfully</div>";
                                header("Location: http://localhost:8080/food-order/after-login/index-login.php");
                            } else {
                                //Gagal di simpan
                                $_SESSION['order'] = "<div class = 'eror text-center'>Failed to order food</div>";
                                header("Location: http://localhost:8080/food-order/after-login/index-login.php");
                            }
                } 
?>
            </div>
            <section class="footer text-center" style="margin: auto;">
                    <div class="container text-center" style="margin: auto">
                        <p>Copyright &copy 2021 All rights reserved</p>
                    </div>
            </section>
    <script src="../BS/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../BS/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
    <?php 
        ob_flush();
    ?>
    <script>
        AOS.init();
    </script>
</body>
</html>

<!-- /* $food = "SELECT title FROM tbl_cart WHERE id_table = $id_tbl";
                    // $food_db = mysqli_query($conn, $food);
                    // $price = "SELECT price FROM tbl_cart WHERE id_table = $id_tbl";
                    // $price_db = mysqli_query($conn, $price);
                    // $qty = "SELECT qty FROM tbl_cart WHERE id_table = $id_tbl";
                    // $qty_db = mysqli_query($conn, $qty);
                    // $subtotal = "SELECT sub_total FROM tbl_cart WHERE id_table = $id_tbl";
                    // $subtotal_db = mysqli_query($conn, $subtotal); // Menghitung total
                    // $count_food = mysqli_num_rows($food_db);
                    // $count_price = mysqli_num_rows($price_db);
                    // $count_qty = mysqli_num_rows($qty_db);
                   */ $count_subtotal = mysqli_num_rows($subtotal_db); -->