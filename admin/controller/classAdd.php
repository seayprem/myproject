<?php 
include('../../config/db.php');
if(isset($_POST['add'])) {
	$id = $_POST['class_id'];
	$amount = $_POST['class_amount'];
	$year = $_POST['class_year'];
	$sub_id = $_POST['sub_id'];

	$sql = "INSERT INTO students_class(class_code, class_amount, class_year, sub_id) VALUES('".$id."', '".$amount."', '".$year."', '".$sub_id."')";
	$query = mysqli_query($conn, $sql);
	if($query) {
		header("Location: ../class.php");
	} else {
		echo '<script>alert("ล้มเหลว กรุณาลองใหม่อีกครั้ง"); window.location.href="../class.php"</script>';
	}
}
?>