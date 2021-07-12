<?php 
    include('../config/constants.php');
    include('checking/login-cust-check.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="../BS/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/stylestatus.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../images/Icon Restoran.ico">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <nav class="nav navbar-expand" data-aos="fade-down" data-aos-duration="1500" style="color: #ff6b81;">
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

    <div class="main-content">
	    <div class="wrapper">
            <h1>Status Order</h1>
            <br /><br />
			<?php
			if(isset($_SESSION['update']))
				{
					echo $_SESSION['update']; //Display session message
					unset($_SESSION['update']); //Removing session message
				}
			?>
			<br><br>	
			<table class="table">
				<thead>
				<tr class="text-center">
					<th scope="col">Id</th>
                    <th scope="col">Order Details</th>
					<th scope="col">Food/Drink</th>
					<th scope="col">Price</th>
					<th scope="col">Qty</th>
					<th scope="col">Total</th>
					<th scope="col">Order Date</th>
					<th scope="col">Status</th>
					<th scope="col">Customer Name</th>
					<th scope="col">Contact</th>
				</tr>
				</thead>
<?php
	//Proses mendapatkan data
	$id_table = $_SESSION['cust'];
	$sql = "SELECT * FROM tbl_order WHERE status != 'Delivered' AND id_table = '$id_table' ORDER BY id ASC";
	//Proses eksekusi
	$res = mysqli_query($conn, $sql);
	//Menghitung baris
	$count = mysqli_num_rows($res);
	$sn = 1; //Untuk membuat id
	if($count > 0){
		//Menunjukan ada pesanan;
		while($row = mysqli_fetch_assoc($res)){
			//Mendapatkan data
			$id = $row['id'];
            $id_table = $row['id_table'];
			$food = $row['food'];
			$price = $row['price'];
			$qty = $row['qty'];
			$total = $row['total'];
			$order_date = $row ['order_date'];
			$status = $row ['status'];
			$customer_name = $row['customer_name'];
			$customer_contact  = $row['customer_contact'];
			$customer_address = $row['customer_address'];
			?> 
			<tbody>
				<tr class="table table-striped text-start">
					<td scope="row" class="text-center"><?php echo $sn++;?></td>
                    <td><?php echo $id_table;?></td>
					<td><?php echo $food;?></td>
					<td><?php echo $price;?></td>
					<td><?php echo $qty;?></td>
					<td><?php echo $total;?></td>
					<td><?php echo $order_date;?></td>
					<td>
						<?php 
							//Jika status berhasil di pesan
							if($status == "Ordered"){
								echo "<label>$status</label>";
							}elseif($status == "On Delivery"){
								echo "<label style='color: orange;'>$status</label>";
							}elseif($status == "Delivered"){
								echo "<label style='color: green;'>$status</label>";
							}elseif($status == "Cancelled"){
								echo "<label style='color: red;'>$status</label>";
							}
						?>
					</td>
					<td><?php echo $customer_name;?></td>
					<td><?php echo $customer_contact;?></td>
				</tr>
			</tbody>
			<?php
		}
	}else{
		//Tidak ada pesanan
		echo "<tr><td colspan='12' class='eror'>Orders not available</td></tr>";
	}
	?>
		</table>
	</div>
</div>
        <script>
            AOS.init();
        </script>
    <!-- Navbar Section Ends Here -->
     <!-- footer Section Starts Here -->
     <section class="footer text-center" style="margin: auto;">
        <div class="container text-center" style="margin: auto">
            <p>Copyright &copy 2021 All rights reserved</p>
        </div>
    </section>
    <!-- footer Section Ends Here -->
    <script src="/BS/dist/js/bootstrap.min.js"></script>
</body>
</html>