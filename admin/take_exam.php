<?php 
include('../config/db.php');
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
		<h1>รายการรับข้อสอบ</h1>
		<hr>

		<!-- INFO  -->
		<?php
		if(isset($_GET['info'])) {
			$info_id = $_GET['info'];
			$info_sql = "SELECT * FROM take_exam INNER JOIN officers ON take_exam.officer_id = officers.officer_id INNER JOIN sent_exam ON take_exam.sent_no = sent_exam.sent_no WHERE take_no = '".$info_id."'";					 
			$info_query = mysqli_query($conn, $sql);
			$info_row = mysqli_fetch_assoc($info_query);
		}
		?>
		<!-- INFO  -->

		<!-- Searching -->
		<form action="take_exam.php?search" method="GET">
			<div class="input-group mb-3">
				<input type="text" class="form-control" name="search" placeholder="ค้นหาข้อมูล รหัสประจำตัว ชื่อ นามสกุล เบอร์โทร" aria-label="Recipient's username" aria-describedby="button-addon2">
				<button class="btn btn-outline-secondary" type="submit" id="button-addon2">ค้นหาข้อมูล</button>
				<a href="take_exam.php" class="btn btn-outline-secondary" id="button-addon2">รีเฟรชข้อมูล</a>
			</div>

		</form>
		<!-- Searching -->
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr class="text-center">
						<th>ลำดับข้อสอบ</th>
						<th>ชื่อผู้ส่งข้อสอบ</th>
						<th>ชื่อเจ้าหน้าที่รับข้อสอบ</th>
						<th>ข้อสอบวิชา</th>
						<th>ปีการศึกษา</th>
						<th>เวลารับข้อสอบ</th>
						<th colspan="3">การจัดการ</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sql = "SELECT * FROM take_exam INNER JOIN officers ON take_exam.officer_id = officers.officer_id INNER JOIN sent_exam ON take_exam.sent_no = sent_exam.sent_no WHERE sent_exam.sent_checked = 3";					 
						$query = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($query)) {

						
					?>
					<tr>
						<td><?= $row['sent_no']; ?></td>
						<td><?= $row['teacher_fname'] . ' ' . $row['teacher_lname']; ?></td>
						<td><?= $row['officer_fname'] . ' ' . $row['officer_lname']; ?></td>
						<td><?= $row['sub_name']; ?></td>
						<td><?= $row['sent_year']; ?></td>
						<td><?= $row['take_date']; ?></td>
						<td colspan="3">
							<a href="#" class="btn btn-secondary">ดูข้อมูล</a>
							<a href="#" class="btn btn-success">ปริ้นข้อสอบ</a>
							<a href="#" class="btn btn-danger">ลบ</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<?php include('includes/sidebarContentBottom.inc.php'); ?>
	<?php include('includes/footer.inc.php'); ?>
</body>