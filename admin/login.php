<?php
    include ('../config/constants.php');
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link rel="stylesheet" href="../css/loginstyle.css">
        <link rel="stylesheet" href="../BS/dist/css/bootstrap.min.css">
        <link rel="shortcut icon" href="../images/Icon.ico">
        <script src="../script/loginscript.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    </head>
    <body>
        <section class="Form" style="height: 100vh;">
            <div class="container-fluid">
                <div class="row" style="height: 100vh;">
                    <div class="col-lg-7 tengah" style="background-color:#ff6b81;">
                            <div class="text-center" data-aos="zoom-in" data-aos-duration="1200">
                                <center><img class="img-fluid animated mt-4 col-lg-8 gambar" alt="image" src="../images/Content.png"></center>
                                    <h3 class="mt-3" style="color: white; font-size: 27px;">Cita Rasa <b>Indonesia</b></h3>
                                    <div class="garis text-center"></div>
                            </div>
                    </div>
                    <div class="col-lg-5 px-5 mt-3 kanan-tengah" data-aos="fade-up" data-aos-duration="1200">
                            <img src="../images/LogoRestoran.png" style="height: 80px;" class="gambar1 mb-3">
                            <?php
                                if(isset($_SESSION['login'])){
                                    echo $_SESSION ['login'];
                                    unset($_SESSION['login']);
                                }
                                if(isset($_SESSION['login-otomatis'])){
                                    echo $_SESSION ['login-otomatis'];
                                    unset($_SESSION['login-otomatis']);
                                }
                            ?>
                            <!-- Pembuatan form login -->
                            <form action="" method="POST" class="mt-3">
                                    <div class="col-lg-12 txt_field">
                                        <label for="username" class="mb-2"></label>
                                        <span></span>
                                        <input type="text" name="username" required placeholder="Enter Username">
                                    </div>
                                    <div class="col-lg-12 txt_field">
                                        <label for="password" class="mb-2"></label>
                                        <span></span>
                                        <input type="password" name="password" required placeholder="Enter password"><br>
                                    </div>
                                    <div class="col">
                                        <input type="submit" name="submit" value="Login" class="btn btn-primary mb-3">
                                    </div>
                                    <a class="btn btn-danger" href="<?php echo SITEURL;?>">Back to Menu</a>
                            </form> 
                            <!-- Batas form login -->
                            
                            <p class="text-center mt-5" style="color: inherit;">Copyright &copy 2021 All Rights Reserved.<br> Developed By - Tim Sistem Pemesanan Makanan 2021</p>
                    </div>
                    <script>
                        AOS.init();
                    </script>
                    <script src="/BS/dist/js/bootstrap.bundle.min.js"></script>
                </div>
            </div>        
        </section>                        
    </body>
</html>
<?php
    //Cek apakah tombol submit berhasil di klik
    if(isset($_POST['submit'])){
        //Proses untuk login
        //1. Mendapatkan data dari from login terlebih dahulu
            // $username = $_POST['username'];
            // $password = md5($_POST['password']);
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
