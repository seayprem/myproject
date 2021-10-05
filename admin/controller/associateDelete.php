<?php 
include('../../config/db.php');
session_start();
if(empty($_SESSION['officer'])) {
	header("Location: login.php");
} else {
	$now = time(); // Checking time right now

	if($now > $_SESSION['expire']) {
		// Session destroy Please login again for visit sentexam
		header("Location: logout.php");
	}
}

if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "DELETE FROM associate WHERE ass_id = '".$id."'";
	$query = mysqli_query($conn, $sql);
	if($query) {
		echo '<script>alert("ลบข้อมูลสำเร็จ"); window.location.href = "../associate.php";</script>';
	} else {
		echo '<script>alert("ลบข้อมูลไม่สำเร็จ"); window.history.back();</script>';
	}
}
?>
