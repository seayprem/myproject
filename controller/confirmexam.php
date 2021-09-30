<?php 
include('../config/db.php');
if(isset($_POST['accept'])) {
	$accept = $_POST['accept'];
	$id = $_POST['id'];
	$sql = "UPDATE sent_exam SET sent_checked = '".$accept."' WHERE sent_no = '".$id."'";
	$query = mysqli_query($conn, $sql);
	if($accept == 1) {
		$msg = "อนุมัติข้อสอบ";
	} else {
		$msg = "ไม่อนุมัติข้อสอบ";
	}
	if($query) {
		echo '<script>alert("'.$msg.' สำเร็จ");
		window.location.href = "../check_exam.php";
		</script>';
	} else {
		echo "Failed";
	}
}
?>