<?php
    include ('../config/constants.php');
?>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1><br><br>
            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION ['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['login-otomatis'])){
                    echo $_SESSION ['login-otomatis'];
                    unset($_SESSION['login-otomatis']);
                }
            ?><br><br>
            <!-- Pembuatan form login -->
            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter username"><br><br>
                Password: <br>
                <input type="password" name="password" placeholder="Enter password"><br><br>
                <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
                <a href="<?php echo SITEURL;?>">Kembali ke menu utama</a>
                <br><br>
            </form>
            <!-- Batas form login -->
            
            <p class="text-center">2021 All Rights Reserved, Developed By- <a href="#">Tim Sistem Pemesanan Makanan 2021    </a></p>
        </div>
    </body>
</html>
<?php
    //Cek apakah tombol submit berhasil di klik
    if(isset($_POST['submit'])){
        //Proses untuk login
        //1. Mendapatkan data dari from login terlebih dahulu
            //$username = $_POST['username'];
            //$password = md5($_POST['password']);
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $raw_password = md5($_POST['password']);
            $password = mysqli_real_escape_string($conn, $raw_password);
        //2. SQL untuk mengecek data pengguna dengan username dan password
            $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        //3. Proses eksekusi
            $res = mysqli_query($conn, $sql);
        //4. Menghitung baris untuk mengecek data data user
        $count = mysqli_num_rows($res);
        if($count == 1){
            //Login sukses
            $_SESSION['login'] = "<div class = 'sukses'>Successfully login</div>";
            $_SESSION['user'] = $username;//Untuk mengecek apakah user berhasil login
            header ('location:'.SITEURL.'admin/');
        }else{
            //Login gagal
            $_SESSION['login'] = "<div class = 'eror text-center'>Username and passsword do not match</div>";
            header ('location:'.SITEURL.'admin/login.php');
        }

    }
?>
