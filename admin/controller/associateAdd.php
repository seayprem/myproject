<?php 
include('../../config/db.php');
if(isset($_POST['add'])) {
	$ass_num_regis = $_POST['ass_num_regis'];
	$ass_date_regis = $_POST['ass_date_regis'];
	$sub_id = $_POST['sub_id'];
	$class_id = $_POST['class_id'];

	$sql = "INSERT INTO associate (ass_num_regis, ass_date_regis, sub_id, class_id) VALUES ('".$ass_num_regis."', '".$ass_date_regis."', '".$sub_id."', '".$class_id."')";
	$query = mysqli_query($conn, $sql);
	if($query) {
		// echo '<script>alert("เพิ่มข้อมูลสำเร็จ"); window.location.href = "../associate.php"</script>';
		header("Location: ../associate.php");
	} else {
		echo '<script>alert("เพิ่มข้อมูล ล้มเหลว"); window.history.back();</script>';
	}
}
?>