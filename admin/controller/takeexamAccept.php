<?php 
include('../../config/db.php');
if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$get_sql = "SELECT * FROM sent_exam WHERE sent_no = '".$id."'";
	$get_query = mysqli_query($conn, $get_sql);
	$get_row = mysqli_fetch_assoc($get_query);
	$sent_no = $get_row['sent_no'];
	$officer_id = $_GET['officer_id'];
	$sql = "UPDATE sent_exam SET sent_checked = 3 WHERE sent_no = '".$id."'";
	$query = mysqli_query($conn, $sql);
	if($query) {
		$insert_sql = "INSERT INTO take_exam (take_date, officer_id, sent_no) VALUES ('test', '".$officer_id."', '".$sent_no."')";
		$insert_query = mysqli_query($conn, $insert_sql);
		if($insert_query) {
			echo "<script>alert('รับข้อสอบสำเร็จ'); window.location.href = '../take_exam.php';</script>";
		} else {
			echo "<script>alert('รับข้อสอบไม่สำเร็จ'); window.location.href = '../sent_exam.php';</script>";
		}
	} else {
		echo "Failed";
	}
}
?>