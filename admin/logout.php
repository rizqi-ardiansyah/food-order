<?php
    //Memasukan constansts.php
    include ('../config/constants.php');
    //1. Menghentikan semua session
        session_destroy();
    //2. Menghubungan login.php
        header ('location:'.SITEURL.'admin/login.php');

?>