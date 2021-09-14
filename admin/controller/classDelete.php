<?php 
include('../../config/db.php');
if(isset($_GET['id'])) {
	$id = $_GET['id'];

	$sql = "DELETE FROM students_class WHERE class_id = '".$id."'";
	$query = mysqli_query($conn, $sql);
	if($query) {
		header("Location: ../class.php");
	} else {
		echo "error";
	}
}
?>