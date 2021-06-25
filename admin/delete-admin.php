<?php
//Memasukan konstan.php
include ('../config/constants.php');
    //1. Mendapatkan id admin saat dihapus
    $id = $_GET ['id'];
    
    //2. Membuat SQL Query untuk menghapus admin
    $sql = "DELETE FROM tbl_admin WHERE id = $id";
    //Proses eksekusi
    $res = mysqli_query($conn, $sql);
    //Cek apakah database sudah terhubung
    if($res == true){
        //admin akan sukses terhapus
        //echo "admin delete";
        //Membuat session untuk menapilkan pesan
        $_SESSION ['delete'] = "<div class = 'sukses'>Admin successfully deleted</div>";
        //Menyambungkan ke manage-admin.php
        header ('location:'.SITEURL.'admin/manage-admin.php');
    }else{
        //admin gagal terhapus
        //echo "failed to delete admin";
        $_SESSION ['delete'] = "<div class = 'eror'>Admin failed to delete</div>";
        //
        header ('location:'.SITEURL.'admin/manage-admin.php');
    }
    //3. Menghubungkan ke manage-admin.php dengan menampilkan sukes atau eror


?>