<?php 
include('../../config/db.php');
session_start();
if(isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$salt = 'a2a551a6458a8de22446cc76d639a9e9';
	$hash = sha1($salt.$password);

	$sql = "SELECT * FROM `teachers` WHERE teacher_user = '".$username."' AND teacher_pass = '".$hash."'";
	$query = mysqli_query($conn, $sql);
	if(mysqli_num_rows($query)) {
		$row = mysqli_fetch_array($query);
		$_SESSION['login'] = $row['teacher_fname'] . " " . $row['teacher_lname'];
		$_SESSION['position'] = $row['teacher_position'];
		$_SESSION['ids'] = $row['teacher_id'];
		$_SESSION['user'] = $row['teacher_user'];
		$_SESSION['fname'] = $row['teacher_fname'];
		$_SESSION['lname'] = $row['teacher_lname'];
		$_SESSION['tel'] = $row['teacher_tel'];
		$_SESSION['start'] = time(); // ล็อคอินตอนนี้
		// จะทำลาย session ภายใน 30 นาที
		$_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
		header("Location: ../../index.php");
	} else {
		// echo '<script>';
		// echo 'alert("การทำงานของระบบผิดพลาด โปรดติดต่อเจ้าหน้าที่")';
		// echo 'window.location = "../../login.php"';
		// echo '</script>';
		header("Location: ../../index.php");
	}
}
?>