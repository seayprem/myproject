<?php 
include('../../config/db.php');
if(isset($_GET['id'])) {
	$id = $_GET['id'];

	$sql = "DELETE FROM officers WHERE officer_id = '".$id."'";
	$query = mysqli_query($conn, $sql);
	if($query) {
		header("Location: ../officers.php");
	} else {
		echo "error";
	}
}
?>