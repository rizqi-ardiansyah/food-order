<?php include("partials/menu.php")?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Admin</h1>

		<br><br>

		<?php 
				if(isset($_SESSION['add']))//Checking whether the session is set or not
				{
					echo $_SESSION['add']; //Display session message
					unset($_SESSION['add']); //Removing session message
				}
			?>

		<form action="" method="POST">
			
			<table class="tbl-30">
				<tr>
					<td>Full Name: </td>
					<td><input type="text" name="full_name" placeholder="Enter full name"></td>	
				</tr>

				<tr>
					<td>Username: </td>
					<td><input type="text" name="username" placeholder="Enter username">
				</tr>

				<tr>
					<td>Password: </td>
					<td><input type="password" name="password" placeholder="Enter password">
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Admin" class="btn-secondary">
					</td>
				</tr>
			</table>

		</form>
	</div>
</div>

<?php include("partials/footer.php")?>

<?php 
	//Proccess the value from form and save it in database
	//Check wheter submit button is clicked or not

	if(isset($_POST['submit']))
	{
		//Button clicked
		//echo "Button Clicked";

		//1. Get the data from form
		$full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, md5($_POST['password'])); //Password Encryption with md5

		//2. SQL Query to save the data into database
		$sql = "INSERT INTO tbl_admin SET 
		full_name = '$full_name', 
		username = '$username', 
		password = '$password'
		";

		//3. Executing query and saving data into database
		$res = mysqli_query($conn, $sql) or die(mysqli_error());

		//4. Check whether the (Query is executed) data is inserted or not and display appropriate
		//message
		if($res == true){
			//data sorted
			//echo "Data Inserted";
			//Create a session variable to display message
			$_SESSION['add'] = "<div class = 'sukses'>Admin successfully added</div>";
			//Redirect Page to manage-admin.php
			header("location:".SITEURL.'admin/manage-admin.php');
		}
		else{
			//Failed to insert data
			//echo "Failed to insert data";
			//Create a session variable to display message
			$_SESSION['add'] = "<div class = 'eror'>Admin failed to add</div>";
			//Redirect Page to add-admin.php
			header("location:".SITEURL.'admin/add-admin.php');
		}

	}
?>