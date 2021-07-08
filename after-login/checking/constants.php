<?php 
		//start session
		session_start();


		//Create Constatnts to store non repeating values
		define('SITEURL', 'http://localhost/food-order/after-login/');
		define('LOCALHOST',  'localhost');
		define('DB_USERNAME',  'root');
		define('DB_PASSWORD', 'ZeroTwo02');
		define('DB_NAME', 'food_order');

		$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD); //database connections

		$db_select = mysqli_select_db($conn, DB_NAME) or die (mysqli_error()); //connecting database
?>