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
		<div class="text-right">
			<div class="mb-3">
				<a href="mpdf.php" target="_blank" class="btn btn-success">รายงาน</a>
			</div>
		</div>

		<!-- INFO  -->
		<?php
		if(isset($_GET['info'])) {
			$info_id = $_GET['info'];
			$info_sql = "SELECT * FROM take_exam INNER JOIN officers ON take_exam.officer_id = officers.officer_id INNER JOIN sent_exam ON take_exam.sent_no = sent_exam.sent_no INNER JOIN teachers ON sent_exam.teacher_id = teachers.teacher_id INNER JOIN subjects ON sent_exam.sub_id = subjects.sub_id WHERE take_no = '".$info_id."'";					 
			$info_query = mysqli_query($conn, $info_sql);
			$info_row = mysqli_fetch_assoc($info_query);
		

		?>
		<!-- INFO  -->
		<p><b>ชื่อไฟล์: </b><?= $info_row['sent_files']; ?></p>
		<p><a href="../assets/files/<?= $info_row['sent_files']; ?>" target="_blank">คลิกเพื่อดูไฟล์</a></p>
		<p><b>รหัสข้อสอบ: </b><?= $info_row['sent_no']; ?></p>
		<p><b>รหัสวิชา: </b><?= $info_row['sub_id']; ?></p>
		<p><b>ชื่อวิชา: </b><?= $info_row['sub_name']; ?></p>
		<p><b>หน่วยกิต: </b><?= $info_row['sub_credit']; ?></p>
		<p><b>ปีการศึกษา: </b><?= $info_row['sent_year']; ?></p>
		<p><b>ภาคการศึกษา: </b><?= $info_row['sent_term']; ?></p>
		<p><b>เวลาสอบ: </b><?= $info_row['sent_time_exam']; ?></p>
		<p><b>วันที่สอบ: </b><?= $info_row['sent_date_exam']; ?></p>
		<p><b>ความต้องการกระดาษคำตอบ: </b><?= $info_row['sent_answersheet']; ?></p>
		<p><b>การจัดเย็บข้อสอบหน้าเดียว: </b><?= $info_row['sent_single_copy']; ?></p>
		<p><b>การจัดเย็บข้อสอบหน้าหลัง: </b><?= $info_row['sent_duplex_copy']; ?></p>
		<p><b>สีกระดาษคำตอบ สีเขียวชุดละ 2 แผ่น: </b>
		<?php 
			if($info_row['sent_twopage_book'] == "เขียว")	{
				echo "ต้องการ";
			} else {
				echo "ไม่ต้องการ";
			}
		?>
		</p>
		<p><b>สีกระดาษคำตอบ สีฟ้าชุดละ 4 แผ่น: </b>
		<?php 
			if($info_row['sent_fourpage_book'] == "ฟ้า") {
				echo "ต้องการ";
			} else {
				echo "ไม่ต้องการ";
			}
		?>
		</p>
		<p><b>รายละเอียดเพิ่มเติม: </b><?= $info_row['sent_other']; ?></p>
		<p><b>สถานะการส่ง: </b>
			<?php 
				if($info_row['sent_checked'] == 1) {
					echo "อนุมัติแล้ว";
				} else if($info_row['sent_checked'] == 2) {
					echo "ไม่อนุมัติแล้ว";
				} else {
					echo "ยังไม่ได้ตรวจสอบ";
				}
			?>
		</p>
		<div class="d-grid 2-gap mb-3">
			<a href="take_exam.php" class="btn btn-danger">ย้อนกลับ</a>
		</div>
		<?php } ?>

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
						$sql = "SELECT * FROM take_exam INNER JOIN officers ON take_exam.officer_id = officers.officer_id INNER JOIN sent_exam ON take_exam.sent_no = sent_exam.sent_no INNER JOIN teachers ON sent_exam.teacher_id = teachers.teacher_id INNER JOIN subjects ON sent_exam.sub_id = subjects.sub_id WHERE sent_exam.sent_checked = 3";					 
						$query = mysqli_query($conn, $sql);
						if(mysqli_num_rows($query) == 0) {
							echo '<tr><td colspan="7" class="text-center">ไม่พบข้อมูล</td></tr>';
						} else if(isset($_GET['search'])) {
								$search_id = $_GET['search'];
								$search_sql = "SELECT * FROM take_exam INNER JOIN officers ON take_exam.officer_id = officers.officer_id INNER JOIN sent_exam ON take_exam.sent_no = sent_exam.sent_no INNER JOIN teachers ON sent_exam.teacher_id = teachers.teacher_id INNER JOIN subjects ON sent_exam.sub_id = subjects.sub_id WHERE teachers.teacher_fname LIKE '%".$search_id."%' OR teachers.teacher_lname LIKE '%".$search_id."%' OR subjects.sub_name LIKE '%".$search_id."%'";					 
								
								$search_query = mysqli_query($conn, $search_sql);
								if(mysqli_num_rows($search_query) == 0) {
									echo '<tr><td colspan="7" class="text-center">ไม่พบข้อมูลที่ค้นหา</td></tr>';
								}
								while($search_row = mysqli_fetch_assoc($search_query)) {

								
								
							?>

							<tr>
								<td class="text-center"><?= $search_row['sent_no']; ?></td>
								<td><?= $search_row['teacher_fname'] . ' ' . $search_row['teacher_lname']; ?></td>
								<td><?= $search_row['officer_fname'] . ' ' . $search_row['officer_lname']; ?></td>
								<td class="text-center"><?= $search_row['sub_name']; ?></td>
								<td class="text-center"><?= $search_row['sent_year']; ?></td>
								<td class="text-center"><?= $search_row['take_date']; ?></td>
								<td colspan="3" class="text-center">
									<a href="take_exam.php?info=<?= $search_row['take_no']; ?>" class="btn btn-secondary btn-sm">ดูข้อมูล</a>
									<a href="../assets/files/<?= $search_row['sent_files']; ?>" target="_blank" class="btn btn-success btn-sm">ปริ้นข้อสอบ</a>
									<a href="controller/takeexamDelete.php?id=<?= $search_row['take_no']; ?>" onclick="return confirm('ยืนยันที่จะลบใช่หรือไม่?')" class="btn btn-danger btn-sm">ลบ</a>
								</td>
							</tr>
							<?php 
							}
	 					} else {



						while($row = mysqli_fetch_assoc($query)) {
						

						
					?>
					<tr>
						<td class="text-center"><?= $row['sent_no']; ?></td>
						<td><?= $row['teacher_fname'] . ' ' . $row['teacher_lname']; ?></td>
						<td><?= $row['officer_fname'] . ' ' . $row['officer_lname']; ?></td>
						<td class="text-center"><?= $row['sub_name']; ?></td>
						<td class="text-center"><?= $row['sent_year']; ?></td>
						<td class="text-center"><?= $row['take_date']; ?></td>
						<td colspan="3" class="text-center">
							<a href="take_exam.php?info=<?= $row['take_no']; ?>" class="btn btn-secondary btn-sm">ดูข้อมูล</a>
							<a href="../assets/files/<?= $row['sent_files']; ?>" target="_blank" class="btn btn-success btn-sm">ปริ้นข้อสอบ</a>
							<a href="controller/takeexamDelete.php?id=<?= $row['take_no']; ?>" onclick="return confirm('ยืนยันที่จะลบใช่หรือไม่?')" class="btn btn-danger btn-sm">ลบ</a>
						</td>
					</tr>
					<?php }
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<?php include('includes/sidebarContentBottom.inc.php'); ?>
	<?php include('includes/footer.inc.php'); ?>
</body>