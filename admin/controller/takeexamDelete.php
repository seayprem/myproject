<?php 
include('../../config/db.php');
if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "DELETE FROM take_exam WHERE take_no = '".$id."'";
	$query = mysqli_query($conn, $sql);
	if($query) {
		echo "<script>alert('ลบรายการข้อสอบสำเร็จ'); window.location.href = '../take_exam.php';</script>";
	} else {
		echo "<script>alert('ทำรายการไม่สำเร็จ'); window.location.href = '../take_exam.php';</script>";
	}
}
?>