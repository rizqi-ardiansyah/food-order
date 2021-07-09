<?php 
	include("../config/constants.php");
	include("login-check.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Food Ordering System - Dashboard</title>
	<link rel="shortcut icon" href="../images/Icon Restoran.ico">
    <script src="../script/loginscript.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<link rel="stylesheet" href="../BS/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/admin.css">
</head>
<body>
	<!-- Menu Section Starts -->
	<div class="menu text-center">
		<div class="wrapper">
			<ul>
				<li><a href="index.php">Dashboard</a></li>
				<li><a href="manage-admin.php">Admin</a></li>
				<li><a href="manage-categories.php">Category</a></li>
				<li><a href="manage-food.php">Food</a></li>
				<li><a href="manage-order.php">Order</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</div>
	<div class="garis"></div>
	<!-- Menu Section Ends -->