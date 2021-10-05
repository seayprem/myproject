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
	$ass_num_regis = $_POST['ass_num_regis'];
	$ass_date_regis = $_POST['ass_date_regis'];
	$sub_id = $_POST['sub_id'];
	$class_id = $_POST['class_id'];
	$sql = "UPDATE associate SET ass_num_regis = '".$ass_num_regis."', ass_date_regis = '".$ass_date_regis."', sub_id = '".$sub_id."', class_id = '".$class_id."' WHERE ass_id = '".$id."'";
	$query = mysqli_query($conn, $sql);
	if($query) {
		echo '<script>alert("แก้ไขข้อมูลสำเร็จ"); window.location.href = "../associate.php";</script>';
	} else {
		echo '<script>alert("แก้ไขข้อมูลล้มเหลว"); window.history.back();</script>';
	}
}
?>