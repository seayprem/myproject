<?php 
session_start();
if(empty($_SESSION['officer'])) {
	header("Location: login.php");
} else {
	$now = time(); // Checking time right now

	if($now > $_SESSION['expire']) {
		// Session destroy Please login again for visit sentexam
		header("Location: logout.php");
	}
}
include('../config/db.php');

$sql = "SELECT * FROM officers WHERE officer_id = '".$_SESSION['id']."'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>แก้ไขข้อมูลส่วนตัว - ระบบจัดการข้อสอบ</title>
	<!-- CSS -->
	<?php include('includes/css.inc.php'); ?>
	<!-- Javascript -->
	<?php include('includes/js.inc.php'); ?>
</head>
<body>


	<!-- navbar -->
	<?php include('includes/navbar.inc.php'); ?>


	<!-- side bar -->
	<?php include('includes/sidebarContentTop.inc.php'); ?>

	<!-- Content  -->
	<div class="col py-3">
		<h1>แก้ไขข้อมูลส่วนตัว</h1>
		<hr>

		<div class="row">
			<div class="col-md-4">
				<form action="controller/profileUpdate.php?id=<?= $_SESSION['id']; ?>" method="POST">
					<div class="mb-3">
						<label class="form-label">ชื่อจริง</label>
						<input type="text" name="officer_fname" class="form-control" value="<?= $row['officer_fname']; ?>">
					</div>
					<div class="mb-3">
						<label class="form-label">นามสกุล</label>
						<input type="text" name="officer_lname" class="form-control" value="<?= $row['officer_lname']; ?>">
					</div>
					<div class="mb-3">
						<label class="form-label">เบอร์โทร</label>
						<input type="text" name="officer_tel" class="form-control" value="<?= $row['officer_tel']; ?>">
					</div>
					<div class="d-grid 2-gap">
						<input type="submit" class="btn btn-is" onclick="return confirm('คุณยืนยันที่จะแก้ไขข้อมูลหรือไม่?')" value="แก้ไขข้อมูล">
					</div>
				</form>
			</div>
		</div>

	</div>




	<?php include('includes/sidebarContentBottom.inc.php'); ?>
	<?php include('includes/footer.inc.php'); ?>
	
</body>
</html>