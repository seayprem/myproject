<?php 
include('../../config/db.php');
session_start();
if(isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$salt = 'a2a551a6458a8de22446cc76d639a9e9';
	$hash = sha1($salt.$password);

	$sql = "SELECT * FROM `officers` WHERE officer_user = '".$username."' AND officer_pass = '".$hash."'";
	$query = mysqli_query($conn, $sql);
	if(mysqli_num_rows($query) == 1) {
		$row = mysqli_fetch_array($query);
		$_SESSION['id'] = $row['officer_id'];
		$_SESSION['officer'] = $row['officer_fname'] . " " . $row['officer_lname'];
		$_SESSION['start'] = time(); // ล็อคอินตอนนี้
		// จะทำลาย session ภายใน 30 นาที
		$_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
		header("Location: ../index.php");
	} else {
		echo '<script>alert("ชื่อผู้ใช้หรือรหัสผ่านผิด"); window.history.back();</script>';
	}
}
?>