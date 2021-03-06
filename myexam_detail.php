<?php 
include('config/db.php');
session_start();
$position = $_SESSION['position'];
if(empty($_SESSION['login'])) {
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
	<title>รายละเอียดตรวจการส่งข้อสอบ - ระบบส่งข้อสอบในสาขา</title>
	<!-- CSS -->
	<?php include('includes/css.inc.php'); ?>
	<!-- JS -->
	<?php include('includes/js.inc.php'); ?>

	<style>
		button.nav-link {
			color: black;
		}
		
		button.active {
			background: #f271cf !important;
		}
	</style>
</head>
<body>

	<!-- Navbar -->
	<?php include('includes/navbar.inc.php'); ?>

	<!-- contentbody -->
	<?php 
	if($_GET['infodetail'])	{
		$infodetail = $_GET['infodetail'];
		$sql = "SELECT * FROM sent_exam INNER JOIN teachers ON sent_exam.teacher_id = teachers.teacher_id INNER JOIN subjects ON sent_exam.sub_id = subjects.sub_id WHERE sent_exam.sent_no = '".$infodetail."' AND sent_exam.teacher_id = '".$_SESSION['ids']."' ORDER BY sent_exam.sent_no DESC";
		$query = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($query);
	} else {
		header("Location: myexam.php");
	}
	?>
	<div class="container">
		<h4 class="text-center mt-5">รายละเอียดข้อสอบ</h4>
		<hr>
		<ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">ไฟล์ข้อสอบที่อัพโหลด</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">รายละเอียดข้อสอบ</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">สถานะการส่งข้อสอบ</button>
			</li>
		</ul>
		<div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
				<h5>ชื่อไฟล์: <b><?= $row['sent_files']; ?></b></h5>
				<h5>ดูข้อมูล: <b><a href="assets/files/<?= $row['sent_files']; ?>" target="_blank" class="text-is" title="ดูข้อสอบ">คลิกเพื่อดู</a></b></h5>
			</div>
			<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
				<div class="row">
					<div class="col-md-4">
						<p><b>รหัสข้อสอบ: </b><?= $row['sent_no']; ?></p>
						<p><b>รหัสวิชา: </b><?= $row['sub_id']; ?></p>
						<p><b>ชื่อวิชา: </b><?= $row['sub_name']; ?></p>
						<p><b>หน่วยกิต: </b><?= $row['sub_credit']; ?></p>
						<p><b>ปีการศึกษา: </b><?= $row['sent_year']; ?></p>
						<p><b>ภาคการศึกษา: </b><?= $row['sent_term']; ?></p>
						<p><b>เวลาสอบ: </b><?= $row['sent_time_exam']; ?></p>
						<p><b>วันที่สอบ: </b><?= $row['sent_date_exam']; ?></p>
					</div>
					<div class="col-md-4">
						<p><b>ความต้องการกระดาษคำตอบ: </b><?= $row['sent_answersheet']; ?></p>
						<p><b>การจัดเย็บข้อสอบหน้าเดียว: </b><?php 
							if($row['sent_single_copy'] == 1)	{
								echo "ต้องการจากหน้า " . $row['sent_single_copy_start'] . " ถึง " . $row['sent_single_copy_end'];
							} else {
								echo "ไม่ต้องการ";
							}
						?></p>
						<p><b>การจัดเย็บข้อสอบหน้าหลัง: </b><?php 
							if($row['sent_duplex_copy'] == 1)	{
								echo "ต้องการจากหน้า " . $row['sent_duplex_copy_start'] . " ถึง " . $row['sent_duplex_copy_end'];
							} else {
								echo "ไม่ต้องการ";
							}
						?></p>
						<p><b>ประเภทกระดาษคำตอบ: </b><?= $row['sent_twopage_book']; ?></p>
						<p><b>สีกระดาษคำตอบ สีเขียวชุดละ 2 แผ่น: 
						</b>
							<?php if(empty($row['sent_twopage_book'])) {
								echo "ไม่ต้องการ";
							} else {
								echo "ต้องการ";
							} ?>
					</p>
						<p><b>สีกระดาษคำตอบ สีฟ้าชุดละ 4 แผ่น: </b>
					
							<?php if(empty($row['sent_fourpage_book'])) {
								echo "ไม่ต้องการ";
							} else {
								echo "ต้องการ";
							} ?>
					</p>
					</div>

					<div class="col-md-4">
						<p><b>รายละเอียดอื่นๆที่ต้องการเพิ่มเติม: </b>
							<?= $row['sent_other']; ?>
						</p>
					</div>

				</div>
			</div>
			<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
				<h5>สถานะตอนนี้: <?php
				if($row['sent_checked'] == 1) {
					echo "<b class='text-success'>อนุมัติข้อสอบแล้ว</b></h5>";
				} else if($row['sent_checked'] == 2) {
					echo "<b class='text-danger'>ไม่อนุมัติข้อสอบ</b></h5>";
				} else {
					echo "ยังไม่ได้ตรวจข้อสอบ";
				}
				?></b></h5>
			</div>
		</div>

		<div class="d-grid gap-2 my-5">
			<a href="myexam.php" class="btn btn-danger">ย้อนกลับ</a>
		</div>

	</div>

	<!-- footer -->
	<?php include('includes/footer.inc.php'); ?>

</body>
</html>