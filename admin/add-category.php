<?php 
	include('partials/menu.php');
?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Category</h1>

		<br><br>

		<?php
			if(isset($_SESSION['add'])){
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			}
		?>


		<?php
			if(isset($_SESSION['upload'])){
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
			}
		?>

		<?php
			if(isset($_SESSION['same-title'])){
				echo $_SESSION['same-title'];
				unset($_SESSION['same-title']);
			}
		?>

		<?php
			if(isset($_SESSION['validation-image'])){
				echo $_SESSION['validation-image'];
				unset($_SESSION['validation-image']);
			}
		?>

		<br><br>
		<!-- Add form category -->
		<form action="" method="POST" enctype="multipart/form-data"> 
			<!-- enctype berfungsi untuk mengizinkan upload data -->
			<table class="tbl-30">
				<tr>
					<td>Name: </td>
					<td>
						<input type="text" name="title" placeholder="Enter your category name" required>
					</td>
				</tr>

				<tr>
					<td>Choose image: </td>
					<td>
						<input type="file" name="image" required>
					</td>
				</tr>


				<tr>
					<td>Featured: </td>
					<td>
						<input type="radio" name="featured" value="Yes"> Yes
						<input type="radio" name="featured" value="No"> No
					</td>
				</tr>

				<tr>
					<td>Active: </td>
					<td>
						<input type="radio" name="active" value="Yes"> Yes
						<input type="radio" name="active" value="No"> No
					</td>
				</tr>

				<tr>
					<td colspan="2">
					<input type="submit" name="submit" value="Add Category" class="btn-secondary">
					</td>
				</tr>
			</table>
		</form>
		<!-- Batas form kategori -->


		<?php
			//Cek apakah button di klik
			if(isset($_POST['submit'])){

			//1. Mendapatkan value dari form kategori
			$title = mysqli_real_escape_string($conn, $_POST['title']);

			//Category name validation
			$sql2 = "SELECT * FROM tbl_category";

			$res2 = mysqli_query($conn, $sql2);
			$count = mysqli_num_rows($res2);
			
			if($count > 0){
				while($row = mysqli_fetch_assoc($res2)){
					$title2 = $row['title'];
					if($title == $title2){
						$_SESSION['same-title'] = "<div class = 'eror'>Category name already exist!</div>";
						header("location:".SITEURL.'admin/add-category.php');
						die();
					}
				}
			}


			//Untuk radio, perlu pengecekan apakah terpilih atau tidak
			if(isset($_POST['featured']))
			{
				$featured = $_POST['featured'];
			}else{
				//set the value
				$featured = "No";
			}

			if(isset($_POST['active']))
			{
				$active = $_POST['active'];
			}else{
				$active = "No";
			}

			//Cek apakah image sudah dipilih atau belum dan set the value untuk image
			//print_r($_FILES['image']); // untuk menampilkan array, karena dengan echo tidak bisa

			//die();//break the code
			if(isset($_FILES['image']['name']))
			{	
				//Validation image
				//Get image dimension
				$fileinfo = @getimagesize($_FILES['image']['tmp_name']);
				$width = $fileinfo[0];
				$height = $fileinfo[1];
				
				$allowed_image_extension = array(
					"png",
					"jpg",
					"jpeg"
				);
				
				// Get image file extension
				$file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
			
				// Validate file input to check if is with valid extension
				if (! in_array($file_extension, $allowed_image_extension)) {
					
					$_SESSION['validation-image'] = "<div class='eror'>Upload valid images. Only PNG and 
					JPEG are allowed</div>";
					header("location:".SITEURL.'admin/add-category.php');
					die();

				}    // Validate image file size
				else if (($_FILES["image"]["size"] > 2000000)) {
					
					$_SESSION['validation-image'] = "<div class='eror'>Image size exceeds 
					2MB</div>";
					header("location:".SITEURL."admin/add-category.php");
					die();

				}    // Validate image file dimension
				else if ($width != "400" && $height != "500") {
			
					$_SESSION['validation-image'] = "<div class='eror'>Image dimension should be 
					400X500</div>";
					header("location:".SITEURL."admin/add-category.php");
					die();
				}
				else{

				//Upload the image
				//Untuk upload image, kita perlu nama image, source path dan destination path
				$image_name = $_FILES['image']['name'];

				//Upload image only if image is selected
				if($image_name != "")
				{

					//Section to auto rename our image
					//Get the extension off our image(jpg, png, gif, etc) e.g. food1.jpg
					$ext = end(explode('.', $image_name));

					//rename the image 
					$image_name = "Food_Category_".rand(000, 999).'.'.$ext; // e.g. Food_Category_834.jpg

					$source_path = $_FILES['image']['tmp_name'];

					$destination_path = "../images/category/".$image_name;

					//Akhirnya dapat upload image
					$upload = move_uploaded_file($source_path, $destination_path);

					//Cek apakah image telah ter-upload atau tidak
					//Jika image tidak ter-upload, maka proses akan terhenti dan redirect dengan pesan eror
					if($upload == false)
					{
						//set message
						$_SESSION['upload'] = "<div class='eror'>Failed to upload image</div>";	
						//redirect ke halaman kategori
						header('location:'.SITEURL.'admin/add-category.php');
						//stop the prosses
						die();
				}
				}
			}
			}
			else
			{
				//Gagal upload dan value akan kosong
				$image_name = "";
			}

			//2. Membuat SQL Query untuk memasukkan database
			$sql = "INSERT INTO tbl_category SET
			title = '$title',
			image_name = '$image_name',
			featured = '$featured',
			active = '$active'
			";

			//3. Ekseskusi query dan menyimpan di database
			$res = mysqli_query($conn, $sql);

			//4. Cek apakah query berhasil dieksekusi
			if($res == true)
			{
				//Query dieksekusi dan menambahkan kategori
				$_SESSION['add'] = "<div class='sukses'>Category successfull added</div>";
				//Menghubungkan ke manage-category
				header('location:'.SITEURL.'admin/manage-categories.php');
			}else{
				//gagal menambahkan
				$_SESSION['add'] = "<div class='eror'>Category failed to add</div>";
				//Menghubungkan ke manage-category
				header('location:'.SITEURL.'admin/manage-categories.php');				
			}
		}
		?>
	</div>
</div>

<?php
	include('partials/footer.php');
?>