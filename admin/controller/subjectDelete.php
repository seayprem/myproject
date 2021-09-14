<?php 
include('../../config/db.php');
if(isset($_GET['id'])) {
	$id = $_GET['id'];

	$sql = "DELETE FROM subjects WHERE sub_id = '".$id."'";
	$query = mysqli_query($conn, $sql);
	if($query) {
		header("Location: ../subjects.php");
	} else {
		echo "error";
	}
}
?>