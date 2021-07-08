<?php include("partials/menu.php")?>
    <div class="main-content">
        <div class="wrapper">
        <h1>Update Order</h1>
    <br><br>
<?php
    //Cek apakah id terdeteksi
    if(isset($_GET['id'])){
        //Mendapatkan data pesanan
        $id = $_GET['id'];
        //Mendapatkan semua data berdasarkan id
        //Proses mendapatkan data
        $sql="SELECT * FROM tbl_order WHERE id=$id";
        //Proses eksekusi
        $res = mysqli_query($conn, $sql);
        //Menghitung baris
        $count = mysqli_num_rows($res);
        if($count == 1){
            //Ada data
            $row = mysqli_fetch_assoc($res);
            $food = $row['food'];
			$price = $row['price'];
			$qty = $row['qty'];
			// $total = $row['total'];
			// $order_date = $row ['order_date'];
			$status = $row ['status'];
			$customer_name = $row['customer_name'];
			$customer_contact  = $row['customer_contact'];
			$customer_address = $row['customer_address']; 
        }else{
            header ('location:'.SITEURL.'admin/manage-order.php');
        }
    }else{
        //Menghubungkan ke halaman manage-order
        header ('location:'.SITEURL.'admin/manage-order.php');
    }
?>
<form action="" method="POST" >
    <table class="tbl-30">
        <tr>
            <td>Food: </td>
            <td><b><?php echo $food;?></b></td>
        </tr>
        <tr>
            <td>Price: </td>
            <td><b>Rp <?php echo $price;?></b></td>
        </tr>
        <tr>
            <td>Qty: </td>
            <td> 
                <input type="number" name="qty" value="<?php echo $qty;?>">
            </td>
        </tr>
        <tr>
            <td>Status</td>
            <td>
                <select name="status">
                    <option <?php if($status == "Ordered") {echo "selected";}?> value="Ordered"> Ordered</option>
                    <option <?php if($status == "On Delivery") {echo "selected";}?> value="On Delivery"> On Delivery</option>
                    <option <?php if($status == "Delivered") {echo "selected";}?> value="Delivered"> Delivered</option>
                    <option <?php if($status == "Cancelled") {echo "selected";}?> value="Cancelled"> Cancelled</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>Customer Name: </td>
            <td>
                <input type="text" name="customer_name" value="<?php echo $customer_name;?>">
            </td>
        </tr>
        <tr>
            <td>Contact</td>
            <td>
                <input type="text" name="customer_contact" value="<?php echo $customer_contact;?>">
            </td>
        </tr>
        <tr>
            <td>Address</td>
            <td>
                <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address;?></textarea>
            </td>
        </tr>
        <tr>
            <td colspan ="2">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="hidden" name="price" value="<?php echo $price;?>">
                <input type="submit" name="submit" value="Perbarui Pesanan" class="btn-secondary">
            </td>
        </tr>

    </table>
</form>
<?php
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        // $food = $_POST['food'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $price * $qty;
        //$order_date = $p ['order_date'];
        $status = $_POST ['status'];
        $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
        $customer_contact  = mysqli_real_escape_string($conn, $_POST['customer_contact']);
        $customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
        $customer_address = mysqli_real_escape_string($conn, $_POST['customer_address']);
        //Proses update
        $sql2 = "UPDATE tbl_order SET 
            qty = $qty,
            total = $total,
            status = '$status',
            customer_name = '$customer_name',
            customer_contact = '$customer_contact',
            customer_address = '$customer_address'
            WHERE id = $id
        ";
        //Proses eksekusi
        $res2 = mysqli_query($conn, $sql2);
        //Cek update berhasil atau tidak dan menghubungkan ke halaman manage-order
        if($res2 == true){
            //Berhasil di perbaruio
            $_SESSION['update'] = "<div class='sukses'>Order successfully updated</div>";
            header('location:'.SITEURL.'admin/manage-order.php');
        }else{
            //Gagal di perbarui
            $_SESSION['update'] = "<div class='eror'>Failed to update order</div>";
            header('location:'.SITEURL.'admin/manage-order.php');
        }
    }
?>
</div></div>


<?php include("partials/footer.php")?>