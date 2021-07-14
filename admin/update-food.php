<?php
	include('partials/menu.php');
?>

<?php
	//Check whether id is set or not
	if(isset($_GET['id'])){
		//Get all details
		$id = $_GET['id'];
		//SQL Query to get selected folder
		$sql2 = "SELECT * FROM tbl_food WHERE id=$id";
		//Execute the query
		$res2 = mysqli_query($conn, $sql2);
		//Get the value based on query executed
		$row2 = mysqli_fetch_assoc($res2);
		//Get the individual values of selected food
		$title = $row2['title'];
		$description = $row2['description'];
		$price = $row2['price'];
		$stock = $row2['stock'];
		$current_image = $row2['image_name'];
		$current_category = $row2['category_id'];
		$featured = $row2['featured'];
		$active = $row2['active'];
	}else
	{
		//Redirect to manage-food.php
		header('location:'.SITEURL.'admin/manage-food.php');
	}
?>

<div class="main-content">
	<div class="wrapper">
		<h1>Update Food</h1>
		<br><br>

		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-30">
				<tr>
					<td>Title: </td>
					<td>
						<input type="text" name="title" value="<?php echo $title;?>">
					</td>
				</tr>
				<tr>
					<td>Description: </td>
					<td>
						<textarea name="description" cols = "30" rows = "5" ><?php echo $description;?></textarea>
					</td>
				</tr>
				<tr>
					<td>Price: </td>
					<td>
						<input type="number" name="price" value="<?php echo $price;?>">
					</td>
				</tr>
				<tr>
					<td>Stock: </td>
					<td>
						<input type="number" name="stock" value="<?php echo $stock;?>">
					</td>
				</tr>
				<tr>
					<td>Current Image: </td>
					<td>
						<?php 
							if($current_image == ""){
								//Image not available
								echo "<div class='eror'>Image not available</div>";
							}else{
								?>
								<img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" width="150px">
								<?php
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Select new image: </td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>
				<tr>
					<td>Category: </td>
					<td>
						<select name="category">

						<?php
							//Query ti get active category
							$sql = "SELECT * FROM tbl_category WHERE active='Yes'";
							//Execute the query
							$res = mysqli_query($conn, $sql);
							//Count rows
							$count = mysqli_num_rows($res);
							//Check whether category is available or not
							if($count>0){
								//Category available
								while($row=mysqli_fetch_assoc($res)){
									//Get the category title and id
									$category_title = $row['title'];
									$category_id = $row['id'];
									?>
									<option <?php if($current_category==$category_id){echo 'selected';}?>
									value="<?php echo $category_id; ?>"><?php echo $category_title;?></option>";
									<?php
								}
							}else{
								//Category not available
								echo "<option value='0'>Category not available</option>";
							}
						?>

							
						</select>
					</td>
				</tr>
				<tr>
					<td>Featured: </td>
					<td>
						<input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes"> Yes
						<input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No"> No
					</td>
				</tr>
				<tr>
					<td>Active: </td>
					<td>
						<input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes"> Yes
						<input <?php if($active=="No"){echo "checked";}?> 	type="radio" name="active" value="No"> No
					</td>
				</tr>
				<tr>
					<td>
						<input type="hidden" name="id" value="<?php echo $id;?>">
						<input type="hidden" name="current_image" value="<?php echo $current_image;?>">
						<input type="submit" name="submit" value="Update Food" class="btn-secondary">
					</td>
				</tr>
			</table>
		</form>

		<?php 
			if(isset($_POST['submit'])){

				//1. Get all details from the form 
				$id = $_POST['id'];
				$title = mysqli_real_escape_string($conn, $_POST['title']);
				$description = mysqli_real_escape_string($conn, $_POST['description']);
				$price = mysqli_real_escape_string($conn, $_POST['price']);
				$stock = mysqli_real_escape_string($conn, $_POST['stock']);
				$current_image = $_POST['current_image'];
				$category = $_POST['category'];
				$featured = $_POST['featured'];
				$active = $_POST['active'];
				//2. Upload the image is selected
				// Whether upload button is clicked or not
				if(isset($_FILES['image']['name'])){
					//Upload button clicke
					$image_name = $_FILES['image']['name']; //New image name
					//Check the file is available or not
					if($image_name != ""){
						//Image is available
						//A. Uploading new image
						//Rename the image
						$ext = end(explode('.', $image_name));//Gets the extension of the image
						$image_name = "Food-Name-".rand(0000, 9999).'.'.$ext;//This will rename image

						//Get the source path and destination path
						$src_path = $_FILES['image']['tmp_name'];//Source path
						$dst_path = "../images/food/".$image_name;//Destination path

						//Upload the image
						$upload = move_uploaded_file($src_path, $dst_path);
						//Check whether the image is uploaded or not
						if($upload==false){
							//Failed to uploaded
							$_SESSION['upload'] = "<div class='eror'>Failed to upload new image</div>";
							//Redirect to manage-admin.php
							header('location:'.SITEURL.'admin/manage-food.php');
							//Stop the proccess
							die();
						}
						//3. Remove the image if uploaded
						//B. Remove the current image
						if($current_image != ""){
							//Current image is available
							//Remove the image
							$remove_path = "../images/food/".$current_image;

							$remove = unlink($remove_path);

							//Check whether the image is removed or not
								if($remove==false){
									//Failed to remove image
									$_SESSION['remove-failed'] = "<div class='eror'>Failed to remove current image</div>";
									//Redirect to manage-food.php
									header('location:'.SITEURL.'admin/manage-food.php');
									//Stop proccess
									die();
								}

						}
					}else{
						$image_name = $current_image;//Default image when inage is not selected
					}
				}else{
					$image_name = $current_image;//Default image when button is not clicked
				}
		
				//4. Update food in database
				$sql3 = "UPDATE tbl_food SET

				title = '$title',
				description = '$description',
				price = $price,
				stock = $stock,
				image_name = '$image_name',
				category_id = '$category',
				featured = '$featured',
				active = '$active'
				WHERE id=$id
				";

				//Execute the SQL Query
				$res3 = mysqli_query($conn, $sql3);
				//Check whether the query is executed or not
				if($res3==true){
					//Query executed and food updated
					$_SESSION['update'] = "<div class='sukses'>Food updated successfully</div>";
					//Redirect to manage-food.php
					header('location:'.SITEURL.'admin/manage-food.php');
				}else{
					//Query executed and food updated
					$_SESSION['update'] = "<div class='eror'>Failed to update food</div>";
					//Redirect to manage-food.php
					header('location:'.SITEURL.'admin/manage-food.php');
				}
				//Redirect to manage-food.php
			}else{

			}
		?>

	</div>
</div>

<?php
	include('partials/footer.php');
?>