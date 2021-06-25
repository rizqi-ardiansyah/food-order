<?php include("partials/menu.php") ?>

	<!-- Main Content Section Starts -->
	<div class="main-content">
		<div class="wrapper">
			<h1>Dashboard</h1><br><br>
            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION ['login'];
                    unset($_SESSION['login']);
                }
            ?><br><br>
            
				<div class="col-4 text-center">
				<?php
					//Query SQL
					$sql = "SELECT * FROM tbl_category";
					//Proses eksekusi
					$res = mysqli_query($conn, $sql);
					//Menghitung baris
					$hitung = mysqli_num_rows($res);
					?>
					<h1><?php echo $hitung; ?></h1>
					<br/>
					Category
				</div>
				<div class="col-4 text-center">
				<?php
					//Query SQL
					$sql = "SELECT * FROM tbl_food";
					//Proses eksekusi
					$res = mysqli_query($conn, $sql);
					//Menghitung baris
					$hitung = mysqli_num_rows($res);
					?>
					<h1><?php echo $hitung; ?></h1>
					<br/>
					Food
				</div>
				<div class="col-4 text-center">
				<?php
					//Query SQL
					$sql = "SELECT * FROM tbl_order";
					//Proses eksekusi
					$res = mysqli_query($conn, $sql);
					//Menghitung baris
					$hitung = mysqli_num_rows($res);
				?>
					<h1><?php echo $hitung; ?></h1>
					<br/>
					Total Order
				</div>
				<div class="col-4 text-center">
				<?php
					//Proses Pembuatan SQL Query menghitung pendapatan
					//Query SQL
					$sql = "SELECT SUM(total) AS Total FROM tbl_order WHERE status = 'Ordered' OR status = 'On Delivery' OR status = 'Delivered'";
					//Proses eksekusi
					$res = mysqli_query($conn, $sql);
					//Menghitung baris
					$hitung = mysqli_fetch_assoc($res);
					//Proses menghitung total
					$total_pendapatan = $hitung['Total'];
				?>
					<h1>Rp <?php echo $total_pendapatan; ?></h1>
					<br/>
					Revenue Generated
				</div>

				<div class="clearfix"></div>
		</div>
	</div>
	<!-- Main Content Section Ends -->

<?php include("partials/footer.php") ?>