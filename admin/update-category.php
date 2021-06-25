<?php
	include('partials/menu.php');
?>

<div class="main-content">
	<div class="wrapper">
		<h1>Update Category</h1>
		<br><br>

		<?php
			//Check whether the id is set or not
		if(isset($_GET['id'])){
			//Get the id anda details
			$id =$_GET['id'];
			//Create the SQL Query to get details
			$sql="SELECT * FROM tbl_category WHERE id=$id";

			//Execute the query
			$res = mysqli_query($conn, $sql);

			//Count the rows to check wether the id is valid or not
			$count = mysqli_num_rows($res);

			if($count == 1){
				//Get the all data
				$row = mysqli_fetch_assoc($res);
				$title = $row['title'];
				$current_image = $row['image_name'];
				$featured = $row['featured'];
				$active = $row['active'];

			}else{
				//Redirect to manage-categories.php with session message
				$_SESSION['no-category-found'] = "<div class='eror'>Category not found</div>";
				header('location:'.SITEURL.'admin/manage-categories.php');
			}

		}else{
			//Redirect to manage-categories.php
			header('location:'.SITEURL.'admin/manage-categories.php');
		}
		?>

		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-30">
				<tr>
					<td>Title: </td>
					<td>
						<input type="text" name="title" value="<?php echo $title;?>">
					</td>
				</tr>
				<tr>
					<td>Current Image: </td>
					<td>
						<?php
						if($current_image !=""){
							//Display the image
							?>
							<img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image?>"
							width = 100px;>
							<?php
						}else{
							//Display message
							echo "<div class='eror'>Image not added</div>";
						}
						?>
					</td>
				</tr>
				<tr>
					<td>New Image: </td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>
				<tr>
					<td>Featured: </td>
					<td>
						<input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
						<input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
					</td>
				</tr>
				<tr>
					<td>Active: </td>
					<td>
						<input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
						<input <?php if($featured=="No"){echo "checked";}?> type="radio" name="active" value="No">No
					</td>
				</tr>
				<tr>
					<td>
					<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="submit" name="submit" value="Update Category" class="btn-secondary">
					</td>
				</tr>
			</table>
		</form>

		<?php

			if(isset($_POST['submit'])){
				
				//1. Get all the values from our form
				$id = $_POST['id'];
				$title = mysqli_real_escape_string($conn, $_POST['title']);
				$current_image = $_POST['current_image'];
				$featured = $_POST['featured'];
				$active = $_POST['active'];

				//2. Updating new image if selected;
				//Check wether the image is selected or not
				if(isset($_FILES['image']['name']))
				{
					//Get the image details
					$image_name = $_FILES['image']['name'];

					//Check wether the image is available or not
					if($image_name != "")
					{
						//Image available
						//Upload the new image

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
							header('location:'.SITEURL.'admin/manage-categories.php');
							//stop the prosses
							die();
						}

						//Remove the current image from category folder if image available
						if($current_image != "")
						{
						$remove_path = "../images/category/".$current_image;

						$remove = unlink($remove_path);

						//Check whether the inage is removed or not
						// If failed to remove then display message and stop the proccess
						if($remove==false){
							//Failed to remove image
							$_SESSION['failed-remove'] = "<div class='eror'>Failed to remove current image</div>";
							header('location:'.SITEURL.'admin/manage-categories.php');
							die();//Stop the proccess
						}

						}


					}else
					{
						$image_name = $current_image;
					}
				}
				else
				{
					$image_name = $current_image;
				}

				//3. Update the database
				$sql2 = "UPDATE tbl_category SET 
					title = '$title',
					image_name = '$image_name',
					featured = '$featured',
					active = '$active'
					WHERE id = $id
				";

				//Execute query
				$res2 = mysqli_query($conn, $sql2);


				//4. Redirect to manage-categories.php with message
				//Check whether query executed or not
				if($res2 == true)
				{
					//Category updated
					$_SESSION['update'] = "<div class = 'sukses'>Category updated successfully </div>";
					header('location:'.SITEURL.'admin/manage-categories.php');

				}else{
					//failed update data
					$_SESSION['update'] = "<div class = 'eror'>Failed to update category</div>";
					header('location:'.SITEURL.'admin/manage-categories.php');
				}
			}

		?>

	</div>
</div>

<?php
	include('partials/footer.php');
?>