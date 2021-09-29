<?php 
session_start();
if(empty($_SESSION['officer'])) {
	header("Location: ../../admin/login.php");
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
	<title>Permission Denied</title>
</head>
<body>
	<h1>Permission Denied คุณไม่มีสิทธิ์เข้าถึงหน้าต่างนี้</h1>	
	
</body>
</html>