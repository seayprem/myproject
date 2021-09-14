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
	if(mysqli_num_rows($query)) {
		$row = mysqli_fetch_array($query);
		$_SESSION['officer'] = $row['officer_fname'] . " " . $row['officer_lname'];
		header("Location: ../index.php");
	} else {
		header("Location: ../login.php");
	}
}
?>