<?php 
include('../../config/db.php');
if(isset($_GET['id'])) {
	$id = $_GET['id'];

	$sql = "DELETE FROM teachers WHERE teacher_id = '".$id."'";
	$query = mysqli_query($conn, $sql);
	if($query) {
		header("Location: ../teachers.php");
	} else {
		echo "error";
	}
}
?>