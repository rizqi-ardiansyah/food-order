<?php
	
	include('../config/constants.php');

	if(isset($_GET['id']) && isset($_GET['image_name']))//Either user '&&' or ANS
	{
		//Proccess to delete
		//1. Get Id and image name
		$id = $_GET['id'];
		$image_name = $_GET['image_name'];
		//2. Remove the image if available
		//Check whether the image is available
		if($image_name != "")
		{
			//it has and need to remove image
			$path = "../images/food/".$image_name;

			//Remove file from folder
			$remove = unlink($path);

			//Check whether the image is remove or not
			if($remove==false)
			{
				//Failed to remove image
				$_SESSION['upload'] = "<div class='eror'>Failed to remove image file</div>";
				header('location:'.SITEURL.'admin/manage-food.php');
				//Stop the proccess
				die();
			}
		}			
		//3. Delete food from database
		$sql = "DELETE FROM tbl_food WHERE id=$id";
		//Execute the query
		$res = mysqli_query($conn,$sql);

		//Check whether  the query executed or not and set the session message
		//4. Redirect to manage food with session message
		if($res == true)
		{
			//Food deleted
			$_SESSION['delete'] = "<div class='sukses'>Food deleted successfully</div>";
			header('location:'.SITEURL.'admin/manage-food.php');
		}else{
			//Failed to delete food
			$_SESSION['delete'] = "<div class='eror'>Failed to delete food</div>";
			header('location:'.SITEURL.'admin/manage-food.php');
		}
		

	}else
	{
		//Redirect to manage-food.php
		$_SESSION['unauthorized'] = "<div class='eror'>Unauthorized access</div>";
		header('location:'.SITEURL.'admin/manage-food.php');
	}
?>