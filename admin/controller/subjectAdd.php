<?php 
include('../../config/db.php');
if(isset($_POST['add'])) {
	$sub_id = $_POST['sub_id'];
	$sub_name = $_POST['sub_name'];
	$sub_credit = $_POST['sub_credit'];

	$sql = "INSERT INTO subjects(sub_id, sub_name, sub_credit) VALUES ('".$sub_id."', '".$sub_name."', '".$sub_credit."')";
	$query = mysqli_query($conn, $sql);
	if($query) {
		header("Location: ../subjects.php");
	} else {
		echo '<script>alert("ล้มเหลว กรุณาลองใหม่อีกครั้ง"); window.location.href="../subjects.php"</script>';
	}
}
?>