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
		<h1>รายการส่งข้อสอบ</h1>
		<hr>

		<!-- Searching -->
		<form action="sent_exam.php?search" method="GET">
			<div class="input-group mb-3">
				<input type="text" class="form-control" name="search" placeholder="ค้นหาข้อมูล รหัสประจำตัว ชื่อ นามสกุล เบอร์โทร" aria-label="Recipient's username" aria-describedby="button-addon2">
				<button class="btn btn-outline-secondary" type="submit" id="button-addon2">ค้นหาข้อมูล</button>
				<a href="sent_exam.php" class="btn btn-outline-secondary" id="button-addon2">รีเฟรชข้อมูล</a>
			</div>

		</form>
		<!-- Searching -->
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr class="text-center">
						<th>ลำดับข้อสอบ</th>
						<th>ชื่อผู้ส่งข้อสอบ</th>
						<th>ข้อสอบวิชา</th>
						<th>ปีการศึกษา</th>
						<th>เวลาส่ง</th>
						<th>สถานะการอนุมัติ</th>
						<th colspan="2">การจัดการ</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$sql = "SELECT * FROM sent_exam INNER JOIN teachers ON sent_exam.teacher_id = teachers.teacher_id INNER JOIN subjects ON sent_exam.sub_id = subjects.sub_id";
					$query = mysqli_query($conn, $sql);
					$numrows = mysqli_num_rows($query);
					if($numrows == 0) {
						echo '<tr class="text-center">
							<td colspan="7">ไม่พบข้อมูล</td>	
						</tr>';
					} else if(isset($_GET['search'])) {
							$search_id = $_GET['search'];
							$search_sql = "SELECT * FROM sent_exam INNER JOIN teachers ON sent_exam.teacher_id = teachers.teacher_id INNER JOIN subjects ON sent_exam.sub_id = subjects.sub_id WHERE teacher_fname LIKE '%".$search_id."%' OR sub_name LIKE '%".$search_id."%'";
							$search_query = mysqli_query($conn, $search_sql);
							if(mysqli_num_rows($search_query) == 0) {
								echo '<tr class="text-center">
									<td colspan="7">ไม่พบข้อมูลที่ค้นหา</td>	
								</tr>';
							}
							while($search_row = mysqli_fetch_assoc($search_query)) {

							
						?>
							<tr>
								<td class="text-center"><?= $search_row['sent_no']; ?></td>
								<td><?= $search_row['teacher_fname'] . " " . $search_row['teacher_lname']; ?></td>
								<td class="text-center"><?= $search_row['sub_name']; ?></td>
								<td class="text-center"><?= $search_row['sent_year']; ?></td>
								<td class="text-center"><?= $search_row['sent_checked']; ?></td>
								<td colspan="2" class="text-center">
									<a href="#" class="btn btn-sm btn-secondary">ข้อมูล</a>
									<a href="#" onclick="return confirm('คุณแน่ใจใช่แล้วหรือไม่? ที่ต้องการลบข้อมูลนี้')" class="btn btn-sm btn-danger">ลบ</a>
								</td>
							</tr>

						<?php 
						}
						
					} else {

						while($row = mysqli_fetch_assoc($query)) {

						
					?>
					
					<tr>
						<td class="text-center"><?= $row['sent_no']; ?></td>
						<td><?= $row['teacher_fname'] . " " . $row['teacher_lname']; ?></td>
						<td class="text-center"><?= $row['sub_name']; ?></td>
						<td class="text-center"><?= $row['sent_year']; ?></td>
						<td class="text-center"><?= $row['sent_checked']; ?></td>
						<td colspan="2" class="text-center">
							<a href="#" class="btn btn-sm btn-secondary">ข้อมูล</a>
							<a href="#" onclick="return confirm('คุณแน่ใจใช่แล้วหรือไม่? ที่ต้องการลบข้อมูลนี้')" class="btn btn-sm btn-danger">ลบ</a>
						</td>
					</tr>
					<?php 
					}	
				} ?>

				</tbody>
			</table>
		</div>
	</div>
	<?php include('includes/sidebarContentBottom.inc.php'); ?>
	<?php include('includes/footer.inc.php'); ?>
</body>
</html>