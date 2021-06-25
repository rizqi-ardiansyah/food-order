<?php
    include ('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Password</h1>
        <br><br>
        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>
                        Current password: 
                    </td>
                    <td>
                        <input type="password" name="password_sekarang" placeholder="Current password"> 
                    </td>
                </tr>
                <tr>
                    <td>New password:
                    </td>
                    <td>
                        <input type="password" name="password_baru" placeholder="New password">
                    </td>
                </tr>
                <tr>
                    <td>Confirmation Password:
                    </td>
                    <td>
                        <input type="password" name="konfirmasi_password" placeholder="Confirmation Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" class="btn-secondary" value="Change Password">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
    //Cek apakah tombol submit sudah bisa di clik
    //echo "terhubung";
    if(isset($_POST['submit'])){
        //1. Ambil data dari from
            $id = $_POST['id'];
            $password_sekarang = mysqli_real_escape_string($conn, md5($_POST['password_sekarang']));
            $password_baru = mysqli_real_escape_string($conn, md5($_POST['password_baru']));
            $konfirmasi_password = mysqli_real_escape_string($conn, md5($_POST['konfirmasi_password']));
        //2. Cek apakah user bisa menggunakan fiture change
            $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$password_sekarang'";
            //Eksekusi Query
            $res= mysqli_query($conn, $sql);
            if($res == true){
                //Cek apakah data tersedia
                $count=mysqli_num_rows($res);
                if($count == 1){
                    //User akan muncul password akan terganti
                    //echo "User di Temukan";
                    if($password_baru == $konfirmasi_password){
                        //Update password
                        $sql2 = "UPDATE tbl_admin SET
                            password = '$password_baru'
                            WHERE id = $id  
                        ";
                        //Proses eksekusi
                        $res2 = mysqli_query($conn, $sql2);
                        //Cek apakah Query ter eksekusi
                        if($res2 == true){
                            //Menampilkan pesan sukses
                            $_SESSION['ubah-password'] = "<div class = 'sukses'>Password successfully added</div>";
                            header ('location:'.SITEURL.'admin/manage-admin.php');
                        }else{
                            //Menampilkan pesan eror
                            $_SESSION['ubah-password'] = "<div class = 'eror'>Password failed  to update</div>";
                            header ('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    }else{
                        //User tidak muncul
                        $_SESSION['pwd-tdk-sesuai'] = "<div class = 'eror'>Password does not match</div>";
                        header ('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }else{
                    //User tidak akan muncul
                    $_SESSION['user-hilang'] = "<div class = 'eror'>User not found</div>";
                    header ('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        //3. Apakah password baru dan konfirmasi sesuai atau tidak

        //4. Ubah Password
    }
?>
<?php
     include ('partials/footer.php');
?>