<?php include("partials/menu.php")?>

<div class="main-content">
	<div class="wrapper">
	<h1>Add Category</h1>

			<br /><br />

				<?php
					if(isset($_SESSION['add'])){
						echo $_SESSION['add'];
						unset($_SESSION['add']);
					}
				?>

				<?php
					if(isset($_SESSION['remove'])){
						echo $_SESSION['remove'];
						unset($_SESSION['remove']);
					}
				?>
				<?php
					if(isset($_SESSION['delete'])){
						echo $_SESSION['delete'];
						unset($_SESSION['delete']);
					}
				?>
				<?php
					if(isset($_SESSION['no-category-found'])){
						echo $_SESSION['no-category-found'];
						unset($_SESSION['no-category-found']);
					}
				?>
				<?php
					if(isset($_SESSION['update'])){
						echo $_SESSION['update'];
						unset($_SESSION['update']);
					}
				?>
				<?php
					if(isset($_SESSION['upload'])){
						echo $_SESSION['upload'];
						unset($_SESSION['upload']);
					}
				?>
				<?php
					if(isset($_SESSION['failed-remove'])){
						echo $_SESSION['failed-remove'];
						unset($_SESSION['failed-remove']);
					}
				?>

			<br><br>

			<!-- Button to add Admin -->
			<a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
			<br /><br /><br />

			<table class="tbl-full">
				<tr>
					<th>Id</th>
					<th>Title</th>
					<th>Image</th>
					<th>Featured</th>
					<th>Active</th>
					<th>Actions</th>
				</tr>

				<?php

					// Euery untuk membandingkan
					$sql = "SELECT * FROM tbl_category";

					//eksekusi
					$res = mysqli_query($conn, $sql);

					//count rows
					$count = mysqli_num_rows($res);

					//Create serial number/id value and assign value as 1
					$sn = 1;

					//Check wheter we have data in database or not
					if($count > 0){
						//We have data in database
						//get the data and dispalay
						while($row = mysqli_fetch_assoc($res))
						{
							$id = $row['id'];
							$title = $row['title'];
							$image_name = $row['image_name'];
							$featured = $row['featured'];
							$active = $row['active'];

							?>

							<tr>
								<td><?php echo $sn++;?></td>
								<td><?php echo $title;?></td>
								<td>
									<?php
										//check wether image name as available or not
									if($image_name!=""){
										//display the image
										?>

										<img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" width="100px">
										<?php

									}else{
										//display the message
										echo "<div class='eror'>Image not added</div>";
									}
									?>
								</td>
								<td><?php echo $featured;?></td>
								<td><?php echo $active;?></td>
								<td>
									<a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
									<a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete</a>
								</td>
							</tr>

							<?php

						}
					}else
					{
						//we do not have and data
						//we will display pesan
						?>

							<tr>
								<td colspan="6"><div class="eror">No category added</div></td>
							</tr>
						<?php
					}
					

				?>


			</table>
	</div>
</div>

<?php include("partials/footer.php")?>