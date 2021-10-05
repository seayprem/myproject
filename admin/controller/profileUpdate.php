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
	$officer_fname = $_POST['officer_fname'];
	$officer_lname = $_POST['officer_lname'];
	$officer_tel = $_POST['officer_tel'];
	
	$sql = "UPDATE officers SET officer_fname = '".$officer_fname."', officer_lname = '".$officer_lname."', officer_tel = '".$officer_tel."' WHERE officer_id = '".$id."'";
	$query = mysqli_query($conn, $sql);
	if($query) {
		echo '<script>alert("แก้ไขข้อมูลเสร็จสิ้น"); window.location.href = "../profile.php"</script>';
	} else {
		echo '<script>alert("แก้ไขข้อมูลล้มเหลว"); window.history.back();</script>';
	}
}
?>