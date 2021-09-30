<?php 
include('config/db.php');
session_start();
$position = $_SESSION['position'];
if(empty($_SESSION['login'])) {
	header("Location: login.php");
} else if($position != "หัวหน้าโปรแกรมวิชา") {
	header("Location: index.php");
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
	<title>รายละเอียดข้อสอบ</title>
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

	<!-- Content Body -->
	<?php 
		if($_GET['infodetail'])	{
			$infodetail = $_GET['infodetail'];
			$sql = "SELECT * FROM sent_exam INNER JOIN teachers ON sent_exam.teacher_id = teachers.teacher_id INNER JOIN subjects ON sent_exam.sub_id = subjects.sub_id WHERE sent_exam.sent_no = '".$infodetail."' ORDER BY sent_exam.sent_no DESC";
			$query = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($query);
		} else {
			header("Location: check_exam.php");
		}
	?>
	<h4 class="text-center mt-5">รายละเอียดข้อสอบของ : <?= $row['teacher_fname'] . ' ' . $row['teacher_lname']; ?></h4>
	<hr>
	<div class="container">
		<ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">ไฟล์ข้อสอบ</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">รายละเอียดข้อสอบ</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Operations</button>
			</li>
		</ul>
		<div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
				<h4 class="text-center">เรียกดูข้อมูลไฟล์ข้อสอบ</h4>
				<div class="text-center">
					<a href="assets/files/<?= $row['sent_files']; ?>" target="_blank" class="btn btn-is btn-lg" title="ดูข้อสอบ">คลิกเพื่อดู</a>
				</div>
			</div>
			<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
				<h4 class="text-center">รายละเอียด</h4>
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
				<h4 class="text-center">การอนุมัติข้อสอบ</h4>
				<div class="text-center">
					<form action="controller/confirmexam.php" method="POST">
						<button type="submit" onclick="return confirm('คุณแน่ใจใช่แล้วหรือไม่ที่ต้องการอนุมัติข้อสอบชุดนี้');" class="btn btn-success btn-lg" value="1" name="accept">อนุมัติ</button>
						<button type="submit" onclick="return confirm('คุณแน่ใจใช่แล้วหรือไม่ที่ต้องการไม่อนุมัติข้อสอบชุดนี้');"class="btn btn-danger btn-lg" value="2" name="accept">ไม่อนุมัติ</button>
						<input type="hidden" name="id" value="<?= $row['sent_no']; ?>">
					</form>
				</div>
			</div>
		</div>
		<div class="d-grid gap-2 mt-5 mb-5">
			<a href="check_exam.php" class="btn btn-danger mt-5">ย้อนกลับ</a>
		</div>
	</div>


	<!-- footer -->
	<?php include('includes/footer.inc.php'); ?>
	
</body>
</html>