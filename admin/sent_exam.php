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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ADMIN</title>
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
	<div class="col py-3">
		<h1>รายการส่งข้อสอบ</h1>
		<hr>

		<!-- Searching -->
		<div class="input-group mb-3">
			<input type="text" class="form-control" placeholder="ค้นหาข้อมูล ชื่อผู้ส่งข้อสอบ ชื่อวิชา" aria-label="Recipient's username" aria-describedby="button-addon2">
			<button class="btn btn-outline-secondary" type="button" id="button-addon2">ค้นหาข้อมูล</button>
		</div>
		<!-- Searching -->
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr class="text-center">
						<th>ลำดับข้อสอบ</th>
						<th>ชื่อผู้ส่งข้อสอบ</th>
						<th>ข้อสอบวิชา</th>
						<th>ปีการศึกษา</th>
						<th>สถานะการอนุมัติ</th>
						<th colspan="2">การจัดการ</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="text-center">1</td>
						<td>Wanchai Saelim</td>
						<td class="text-center">คอม</td>
						<td class="text-center">2564</td>
						<td class="text-center">อนุมัติแล้ว</td>
						<td colspan="2" class="text-center">
							<a href="#" class="btn btn-sm btn-secondary">ข้อมูล</a>
							<a href="#" onclick="return confirm('คุณแน่ใจใช่แล้วหรือไม่? ที่ต้องการลบข้อมูลนี้')" class="btn btn-sm btn-danger">ลบ</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<?php include('includes/sidebarContentBottom.inc.php'); ?>
	<?php include('includes/footer.inc.php'); ?>
</body>
</html>