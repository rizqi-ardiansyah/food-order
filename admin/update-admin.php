<?php
    include ('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>
        <?php
            //1. Mendapatkan id dari admin yang dipilih
                $id = $_GET['id'];
            //2. Membuat SQL Query untuk mendapatkan detail adminya
                $sql = "SELECT * FROM tbl_admin WHERE id=$id";
            //3. Mengeksekusi Query
                $res = mysqli_query($conn, $sql);
            //Cek apakah Query ter eksekusi
                if($res == true){
                    //Cek apakah data ada atau tidak
                    $count = mysqli_num_rows($res);
                    //Cek apakah mempunyai data admin atau tidak
                    if($count == 1){
                        //Akan mendapatkan detail data
                        //echo "Data Admin Ada";
                        $row = mysqli_fetch_assoc($res);
                        $full_name = $row['full_name'];
                        $username = $row['username'];
                    }else{
                        //Akan terhubung ke manage-admin
                        header ('location:'.SITEURL.'admin/manage-admin.php');

                    }
                }             
        ?>
        <form action="" method="POST
        `">
            <table class="tbl-30">
                <tr>
                    <td>Nama Lengkap:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name;?>">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username;?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
    //Cek apakah tombol submit berhasil
    if(isset($_POST['submit'])){
        //echo "Tombol sudah di klik";
        //Mendapatkan value dari data yang di update
        $id = $_POST['id'];
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        //Pembuatan SQL Query untuk update
        $sql = "UPDATE tbl_admin SET
            full_name = '$full_name',
            username = '$username'
            WHERE id = '$id'
        ";
        //Pengeksekusia Query
        $res = mysqli_query($conn, $sql);

        //Cek apakah Query berhasil di eksekusi
        if($res == true){
            //Query berhasil di eksekusi
            $_SESSION['update'] = "<div class = 'sukses'>Admin successfully added</div>";
            //Terhubung ke manage-admin
            header ('location:'.SITEURL.'admin/manage-admin.php');
        }else{
            //Gagal mengupdate
            $_SESSION['update'] = "<div class = 'eror'>Admin failed to add</div>";
            //Terhubung ke manage-admin
            header ('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
?>
<?php
    include ('partials/footer.php');
?>

