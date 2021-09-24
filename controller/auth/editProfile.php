<?php 
include('../../config/db.php');
if(isset($_POST['editProfile'])) {
	$id = $_POST['ids'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$tel = $_POST['tel'];

	$sql = "UPDATE `teachers` SET `teacher_fname` = '".$fname."', `teacher_lname` = '".$lname."', `teacher_tel` = '".$tel."' WHERE teacher_id = '".$id."'";
	$query = mysqli_query($conn, $sql);
	if($query) {
		echo '<script>alert("แก้ไขข้อมูลส่วนตัวเรียบร้อยแล้ว");window.location.href = "../../profile.php";</script>';
	} else {
		echo '<script>alert("เกิดข้อผิดพลาด กรุณาติดต่อเจ้าหน้าที่");window.location.href = "../../profile.php";</script>';
	}
}
?>