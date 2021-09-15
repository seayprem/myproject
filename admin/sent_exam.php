<?php 
session_start();
if(empty($_SESSION['officer'])) {
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ADMIN</title>
	<!-- CSS -->
	<?php include('includes/css.inc.php'); ?>
	<!-- Javascript -->
	<?php include('includes/js.inc.php'); ?>
</head>
<body>
	
	<!-- navbar -->
	<?php include('includes/navbar.inc.php'); ?>

	<!-- side bar -->
	<?php include('includes/sidebarContentTop.inc.php'); ?>
	<div class="col py-3">
		<h1>รายการส่งข้อสอบ</h1>
		<hr>
	</div>
	<?php include('includes/sidebarContentBottom.inc.php'); ?>
	<?php include('includes/footer.inc.php'); ?>
</body>
</html>