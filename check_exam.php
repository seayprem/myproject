<?php 
session_start();
$position = $_SESSION['position'];
if(empty($_SESSION['login'])) {
	header("Location: login.php");
} else if($position != "หัวหน้าโปรแกรมวิชา") {
	header("Location: index.php");
} else {
	$now = time(); // Checking time right now

	if($now > $_SESSION['expire']) {
		// Session destroy Please login again for visit sentexam
		header("Location: logout.php");
	}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>หัวหน้าโปรแกรมวิชา</title>
	<!-- CSS -->
	<?php include('includes/css.inc.php'); ?>
	<!-- JS -->
	<?php include('includes/js.inc.php'); ?>
</head>
<body>
	<!-- Navbar -->
	<?php include('includes/navbar.inc.php'); ?>

	<!-- Content body -->
	<br>
	<h3 class="text-center">ตรวจข้อสอบ</h3>



	<!-- footer -->
	<?php include('includes/footer.inc.php'); ?>
</body>
</html>