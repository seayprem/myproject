<?php 
include('../../config/db.php');
if(isset($_POST['add'])) {
	
	$id = $_POST['officer_id'];
	$user = $_POST['officer_user'];
	$pass = $_POST['officer_pass'];
	$fname = $_POST['officer_fname'];
	$lname = $_POST['officer_lname'];
	$tel = $_POST['officer_tel'];

	$salt = 'a2a551a6458a8de22446cc76d639a9e9';
	$hash = sha1($salt.$pass);

	$check_sql = "SELECT * FROM officers WHERE officer_user = '".$user."'";
	$check_query = mysqli_query($conn, $check_sql);
	if(mysqli_num_rows($check_query) > 0) {
		echo "Already Exists";
	} else {
		$sql = "INSERT INTO officers (officer_id, officer_user, officer_pass, officer_fname, officer_lname, officer_tel) VALUES ('".$id."', '".$user."', '".$hash."', '".$fname."', '".$lname."', '".$tel."')";
		$query = mysqli_query($conn, $sql);
		if($query) {
			header("Location: ../officers.php");
		} else {
			echo '<script>alert("ล้มเหลว กรุณาลองใหม่อีกครั้ง"); window.location.href="../officers.php"</script>';
		}
	}

}
?>