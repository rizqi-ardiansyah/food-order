<?php
	//include constanta.pgp
	include('../config/constants.php');
	//echo "Delete Page";
	//Check whether the id and image_name value is set or not
	if(isset($_GET['id']) AND isset($_GET['image_name'])){
		//Get the value and delete
		$id = $_GET['id'];
		$image_name = $_GET['image_name'];

		//Remove the physical image file if available 
		if($image_name != ""){
			//Image is available so remove it
			$path = "../images/category/$image_name";
			//Remove the image
			$remove = unlink($path);

			//if failed to remove image then add an error message and stop the process
			if($remove == false){
				//Set the session message
				$_SESSION['remove'] = "<div class='eror'>Failed to remove category image</div>";
				header('location:'.SITEURL.'admin/manage-categories.php');
				//Redirect to manage-category.php
				//Stop the process
				die();
			}
		}
		//Delete data from database
		//SQL Query to delete data from database
		$sql = "DELETE FROM tbl_category where id=$id";

		//Execute the query
		$res = mysqli_query($conn, $sql);

		//Check whether the data is delete from database or not
		if($res == true){
			//Set success message and redirect
			$_SESSION['delete'] = "<div class='sukses'>Category successfully deleted</div>";
			//Redirect to manage category
			header('location:'.SITEURL.'admin/manage-categories.php');
		}else{
			//Set fail message and redirect
			//Set success message and redirect
			$_SESSION['delete'] = "<div class='eror'>Failed to delete category/div>";
			//Redirect to manage-category.php
			header('location:'.SITEURL.'admin/manage-categories.php');
		}


		//Redirect to manage-categories.php
	}else{
		//Redirect ti manage-categories.php
		header('location:'.SITEURL.'admin/manage-categories.php');
	}
?>