<?php 
include('../../config/db.php');
if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "DELETE FROM sent_exam WHERE sent_no = '".$id."'";
	$query = mysqli_query($conn, $sql);
	if($query) {
		echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว'); window.location.href = '../sent_exam.php'</script>";
	} else {
		echo "<script>alert('ลบข้อมูลไม่สำเร็จ กรุณาตรวจสอบอีกครั้ง');</script>";
	}
}
?>