<?php 
include('../../config/db.php');
if(isset($_POST['add'])) {
	$id = $_POST['teacher_id'];
	$user = $_POST['teacher_user'];
	$pass = $_POST['teacher_pass'];
	$fname = $_POST['teacher_fname'];
	$lname = $_POST['teacher_lname'];
	$tel = $_POST['teacher_tel'];
	$position = $_POST['teacher_position'];

	$salt = 'a2a551a6458a8de22446cc76d639a9e9';
	$hash = sha1($salt.$pass);

	$sql = "INSERT INTO teachers(teacher_id, teacher_user, teacher_pass, teacher_fname, teacher_lname, teacher_tel, teacher_position) VALUES ('".$id."', '".$user."', '".$hash."', '".$fname."', '".$lname."', '".$tel."', '".$position."')";
	$query = mysqli_query($conn, $sql);
	if($query) {
		header("Location: ../teachers.php");
	} else {
		echo '<script>alert("ล้มเหลว กรุณาลองใหม่อีกครั้ง"); window.location.href="../teachers.php"</script>';
	}
}
?>