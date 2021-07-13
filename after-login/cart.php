<?php
    ob_start();

    if(isset($_POST['food'], $_POST['submit'])){
        $nama = $_POST['food'];
        $beli = $_POST['submit'];

        $sql = mysqli_query($conn, "SELECT * FROM tbl_food WHERE title = '$nama'");
        $dt_produk = $sql->fetch_assoc();

        if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
        $idx = 1;
        $cart = unserialize(serialize($_SESSION['cart']));

        //If product available in cart, the order will be update
        for($i=0;$i<count($cart);$i++){
            if($cart[$i]['food'] == $nama){
                $idx = $i;
                $_SESSION['cart'][$i]['submit'] = $beli;
                break;
            }
        }

        //If product is not available in this cart
        if($idx==-1){
            $_SESSION['cart'][] = [
                'food' => $dt_produk['food'],
                'price' => $dt_produk['price'],
                'qty' => $qty
            ];
        }
    }
    if(!empty($_SESSION['cart'])){
?>
    <h4>Daftar Belanja Anda</h4>
    <br>
    <table class="table table-bordered">
    <tr align="center">
    <th>#</th>
    <th>Nama Produk</th>
    <th>Qty</th>
    <th>Harga</th>
    <th>Total</th>
    <th>Aksi</th>
   </tr>
<?php 
        if(isset($_SESSION['cart'])){
            $cart = unserialize(serialize($_SERVER['cart']));
            $idx = 0;
            $no = 1;
            $total = 0;
            $total_bayar = 0;

            for($i=0;$i<count($cart);$i++){
                $total = $_SESSION['cart'][$i]['price'] * $_SESSION['cart'][$i]['qty'];
                $total_bayar += $total;
            ?>
            <tr>
                <td align="center"><?= $no++; ?></td>
                <td><?= $cart[$i]['nama_produk']; ?></td>
                <td align="center"><?= $cart[$i]['pembelian']; ?></td>
                <td><?= $cart[$i]['harga']; ?></td>
                <td><?= $total; ?></td>
                <td align="center">
                <a href="?index=<?= $index; ?>">
                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                </a>  
                </td>
            </tr>
<?php  
            $idx++;
            }
            if(isset($_GET['index'])){
                $cart = unserialize(serialize($_SESSION['cart']));
                unset($cart[$_GET['index']]);
                $cart = array_values($cart);
                $_SESSION['cart'] = $cart;
            }
        }
?>
        <tr>
        <td colspan="4" align="right"><strong>Total Bayar</strong></td>
        <td><strong><?= $total_bayar; ?></strong></td>
        <td align="center">
        <a href="transaksi.php">
        <button class="btn btn-success btn-sm">Checkout</button>
        </a>
        </td>
        </tr>
        </table>
        <br><hr>
<?php 
    }
    if(isset($_GET['index'])){
        header('Location: http://localhost/food-order/after-login/index-login.php');
    }
?>