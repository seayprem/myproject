<?php 
session_start();
if(empty($_SESSION['login'])) {
	header("Location: ../login.php");
} else {
	$now = time(); // Checking time right now

	if($now > $_SESSION['expire']) {
		// Session destroy Please login again for visit sentexam
		header("Location: logout.php");
	}

}
?>