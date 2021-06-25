<?php
	//Mengecek user apakah berhasil login
	if(!isset($_SESSION['user']))//Kalau user tidak login 
    {
        //Menghubungkan ke login.php
        $_SESSION['login-otomatis'] = "<div class='eror text-center'>Please login first</div>"; 
        //Menghubungkan ke halaman login
        header ('location:'.SITEURL.'admin/login.php');
    }
?>