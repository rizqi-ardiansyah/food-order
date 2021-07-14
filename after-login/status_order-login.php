<?php 
    ob_start();
    // include('checking/menu.php');\<?php
    include('checking/constants.php');
    // include('login-cust-check.php');
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
    <!-- Bootstrap untuk invoice -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="shortcut icon" href="../images/Icon Restoran.ico">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/style.css">

</head>
            
<?php
    //Check wether order is set or not
    if(isset($_GET['order_id'])){
        //Get the food id and details of the selected foof
        $order_id = $_GET['order_id'];
        // $price_total = $_GET['price_total'];
        //Get the details of the selected food
        $sql = "SELECT * FROM tbl_order WHERE id=$order_id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count == 1){
            $row2 = mysqli_fetch_assoc($res);
            $id = $row2['id'];
			$food = $row2['food'];
			$id_table = $row2['id_table'];
			$price = $row2['price'];
			$qty = $row2['qty'];
			$total = $row2['total'];
			$order_date = $row2['order_date'];
            $delivered_date = $row2['delivered_date'];
			$status = $row2['status'];
			$customer_name = $row2['customer_name'];
			$customer_address = $row2['customer_address'];
			$customer_contact  = $row2['customer_contact'];
        }else{
            //Akan terhubung ke halaman utama
            header('location:'.SITEURL);
        }
    }else{
        $_SESSION['please-order'] = "<div class='eror text-center'>Not yet order</div>";
        header('location:'.SITEURL.'after-login/index-login.php');
    }
?>
<body> 

    <!-- Navbar Section Starts Here -->
    <section class="navbar"  data-aos-duration="1500">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="../images/LogoRestoran.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL;?>after-order/index-order.php?order_id=<?php echo $id;?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>after-order/categories-order.php?order_id=<?php echo $id;?>">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>after-order/foods-order.php?order_id=<?php echo $id;?>">Foods</a>
                    </li>
                    <li>
                    <a  href="<?php echo SITEURL; ?>after-order/cart-order.php?order_id=<?php echo $id;?>">Cart</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>after-login/status_order-login.php?order_id=<?php echo $id;?>">Ordered Status</a>
                    </li>
                    <li>
                    <a href="http://localhost/food-order/after-login/customer-login.php" onclick="konfirmasi()">Logout</a>
                            <!-- <p id="pesan"></p> -->
                            
                            <script>
                                function konfirmasi(){
                                    var tanya = confirm("Do you really want to get out ?");
                                    
                                    if(tanya == true) {
                                        window.location.href="http://localhost/food-order/after-login/customer-login.php";
                                    }else{
                                    return this.href == window.location;
                                    }
                            
                                    // document.getElementById("pesan").innerHTML = pesan;
                                }
                            </script>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
        <script>
            
            /** tambah class active jika di klik */

            var url = window.location;

            // ini untuk menambahkan class active pada menu yg tidak memiliki anak atau single link

            $('ul a').filter(function() {
            
            return this.href == url;
            
            }).parent().addClass('active');

            // ini untuk menu beranak, jadi otomatis akan terbuka sesuai dengan link tujuan

            $('ul.treeview-menu a').filter(function() {
            
            return this.href == url;
            
            }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

        </script>
        <script>
                AOS.init();
        </script>
    <!-- Navbar Section Ends Here -->
    <section class="food-menu">
            <div class="container">
                <h2 class="text-center">Order Status</h2>
                    <div class="status text-center" ><?php echo $status;?></div><br>
                    <!-- Checking Queue -->
                <?php
                    //Proses penghitungan total antrian
                    $sql2 = "SELECT * FROM tbl_order WHERE status != 'Delivered' AND id < '$order_id' AND 
                    id_table != '$id_table'";
                    $res2 = mysqli_query($conn, $sql2);
                    $countId = 0;
                    if ($res2 == true) {
                        $count2 = mysqli_num_rows($res2);
                        $x = 0;
                        $idTable = $row2['id_table'];

                        while ($row2 = mysqli_fetch_array($res2)) {
                            $idTable = $row2['id_table'];

                           
                            if ($countId == 0) {
                                if ($idTable != $id_table) {
                                    $countId++;
                                }
                            }else{
                                if($idTable != $idTable2){
                                    $countId++;
                                }
                            }
                            $idTable2 = $row2['id_table'];
                            $x++;
                        }
                        
                    }

                    if ($status != "Delivered") {
                        
                        ?>
                        <meta http-equiv="refresh" content="3" />
                        <h2 class="text-center">Queue Status</h2> 
                            <div class="status text-center" ><?php echo $countId; ?></div><br>
                        <?php
                    }else{
                            ?>
                        <meta http-equiv="refresh" content="59" />
                        <h2 class="text-center">Time Status</h2>                               

                 <?php
                        
                    if (function_exists('date_default_timezone_set')) {
                        date_default_timezone_set('Asia/Jakarta');
                    }   
                    
                    //Jika delivered_date belum terisi
                    if ($delivered_date == null) {
                        $sql5 = "SELECT * FROM tbl_order WHERE id=$order_id";
                        $res5 = mysqli_query($conn, $sql5);
                        
                        if ($res5 == true) {
                            $dtNow = date('Y-m-d H:i:s');
                       
                            $sql3 = "UPDATE tbl_order SET delivered_date = '$dtNow' WHERE status = 'Delivered' AND id = '$order_id'";
                                        
                            $res3 = mysqli_query($conn, $sql3);

                            $sql4 = "SELECT * FROM tbl_order WHERE id=$order_id";
                            $res4 = mysqli_query($conn, $sql4);

                            $row4 = mysqli_fetch_assoc($res4);
                            $dateNow = date('M d, Y H:i:s', strtotime($row4["delivered_date"]));
                         
                            // Menambagkan jam
                            if ($res3 == true) {
                                if (function_exists('date_default_timezone_set')) {
                                    date_default_timezone_set('Asia/Jakarta');
                                }
                                $date = date_create($dateNow);
                                date_add($date, date_interval_create_from_date_string('29 minutes'));
                                //Menyimpan hasil penambahan serta mengatur format hari agar bisa di ekseskusi di js
                                $time = date_format($date, 'M d, Y H:i:s');

                            $sql5 = "UPDATE tbl_order SET timeout = '$time' WHERE status = 'Delivered' AND id = '$order_id'";
                            $res5 = mysqli_query($conn, $sql5);

                            } else {
                                ?>
                                        <script>
                                            alert("eror");
                                        </script>
                                    <?php
                            }
                        }
                        else {
                            ?>
                                    <script>
                                        alert("eror");
                                    </script>
                                <?php
                        }
                    }else{

                        //Jika deliverd date sudah terisi
                            $sql4 = "SELECT * FROM tbl_order WHERE id=$order_id";
                            $res4 = mysqli_query($conn, $sql4);
                            
                            $row4 = mysqli_fetch_assoc($res4);
                            $dateNow = date('M d, Y H:i:s', strtotime($row4["delivered_date"]));
                           
                            if ($res4 == true) {
                                if (function_exists('date_default_timezone_set')) {
                                    date_default_timezone_set('Asia/Jakarta');
                                }
                                $date = date_create($dateNow);
                                date_add($date, date_interval_create_from_date_string('29 minutes'));
                                //Menyimpan hasil penambahan serta mengatur format hari agar bisa di ekseskusi di js
                                $time = date_format($date, 'M d, Y H:i:s');
                            }
                            $time2 =  date_format($date, 'Y-m-d H:i:s');
                            $sql5 = "UPDATE tbl_order SET timeout = '$time2' WHERE id = '$order_id'";
                            $res5 = mysqli_query($conn, $sql5);
                        }
                                    ?>
                                    
                        <div class="status text-center" id="demo" >

                        <!-- Proses menambah waktu -->
                        <script>
                            //Menyimpan tanggal sekarang dalam variabel
                            var dateOrder = new Date();

                            //Menyimpan tanggal yang ditambah 29 menit
                            var countDownDate = new Date('<?php echo $time; ?>');
                            //document.write(countDownDate);

                            // Deklarasi variabel
                            var minutes = 40;
                            var seconds = 60;
                            if(minutes > 0){
                                    var distance = countDownDate - dateOrder;
                                    minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

                            }
                            var x = setInterval(function() {

                                seconds--; 
                                    if(seconds == 0 ){
                                        seconds = 59;
                                        minutes--;
                                    }
                                
                                // Perhitungan waktu untuk hari, jam, menit dan detik
                                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  
                                // Keluarkan hasil dalam elemen dengan id = "demo"
                                document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";
                                    
                                    if (minutes <=0) {
                                        clearInterval(x);
                                        document.getElementById("demo").innerHTML = "TIMEOUT";
                                    }
                                    
                            }, 1000);

                        </script>      
                    </div><br>     
                    <?php
                    }
                 ?>
        <div class="refresh text-center" value="Reload" onClick="document.location.reload(true)">Refresh</div>

            <script>
                    function reloadpage()
                    {
                    location.reload()
                    }
            </script>
                <br>
                <div class="clearfix"></div>
            </div>

    </section>

        <!-- fOOD Menu Section Ends Here -->
        <br>
        
        <!-- <form action="" method="post"> -->
     
        <div class="container"  >
     
        <div class="container" id="print">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 body-main">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4"> <img width="90px" height="90px" class="imgPrint" alt="Invoce Template" src="../images/LogoRestoran.png" /> </div>
                            <div class="col-md-8 text-right">
                                <h4 style="color: #F81D2D;"><strong>RESTAURANT</strong></h4>
                                <p>Malang, Indonesia</p>
                                <p>1800-234-124</p>
                                <p>restaurant@gmail.com</p>
                            </div>
                        </div> <br />
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h2>INVOICE</h2>    
                            </div>
                            <div class="col-md-12 text-left">
                                <h5 style="color: #F81D2D;"><?php echo $id.$id_table;?></h5>
                                <p><?php echo $customer_name;?></p>
                                <p><?php echo $customer_contact;?></p>
                                <p><?php echo $customer_address;?></p>
                            </div>
                        </div> <br />
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <h5>Description</h5>
                                        </th>
                                        <th>
                                            <h5>Qty</h5>
                                        </th>
                                        <th>
                                            <h5>Amount</h5>
                                        </th>
                                    </tr>
                                </thead>

                                <?php
                                //Proses pembuatan nota
                                $sql6 = "SELECT * FROM tbl_order WHERE order_date = '$order_date' && id_table = '$id_table'";
                                $res6 = mysqli_query($conn, $sql6);
                                $count6 = mysqli_num_rows($res6);
                                $y = 0;
                                $total = 0;
                                while($row6 = mysqli_fetch_array($res6)){
                                    $food = $row6['food'];
                                    $qty = $row6['qty'];
                                    $price = $row6['price'];
                                    $subtotal = $row6['total'];
                                    $total+=$subtotal;
                                
                                ?>
                                    <tbody>
                                        <tr>
                                            <td class="col-md-6"><?php echo $food;?></td>
                                            <td class="col-md-3">&emsp;&nbsp;&nbsp;<?php echo $qty;?></td>
                                            <td class="col-md-6"><i class="fas fa-rupee-sign" area-hidden="true"></i> Rp. <?php echo $subtotal;?> </td>
                                        </tr>
                                    <?php
                                
                                }
                                ?>  
                                    <tr>
                                       
                                    </tr>
                                    <tr style="color: #F81D2D;">
                                        <td></td>
                                        <td class="text-right">
                                            <h6><strong>Total:</strong></h6>
                                        </td>
                                        <td class="text-left">
                                            <h6><strong><i class="fas fa-rupee-sign" area-hidden="true"></i> Rp. <?php echo $total;?></strong></h6>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <script>
                            function printContent(el){
                                // "<style type='text/css'>#btn-print{display:none;}</style>";
                                document.getElementById("btn-print").style.display = "none"
                                // document.getElementById("btn-print")
                                var restorepage = document.body.innerHTML;
                                var printcontent = document.getElementById(el).innerHTML;
                                document.body.innerHTML = printcontent;
                                window.print();
                                document.body.innerHTML = restorepage;
                                document.getElementById("btn-print").style.display = "block"
                            }
                        </script>
                        
                            <div class="col-md-12">
                                <p><b>Date :</b> <?php echo $order_date;?></p> <br />
                                <!-- <p><b>Signature</b></p> -->
                            <input type="submit" onclick="printContent('print')" class="btnPrint" id="btn-print" value="Print">
                            </div>
                           
                    </div>
                </div>
            </div>
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

