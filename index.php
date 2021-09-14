<?php 
session_start();
if(empty($_SESSION['login'])) {
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ระบบส่งข้อสอบในสาขา</title>
	<!-- CSS -->
	<?php include('includes/css.inc.php'); ?>
	<!-- JS -->
	<?php include('includes/js.inc.php'); ?>

</head>
<body>

<!-- Navbar -->
<?php include('includes/navbar.inc.php'); ?>

<!-- Content body -->
<br>
<!-- FORM  -->
<form action="#" method="POST" enctype="multipart/form-data">
	<div class="container">
		<h1 class="text-center">ส่งข้อสอบ</h1>
		<hr>
		<!-- Grid  -->
		<div class="row">
			<div class="col-md-4">
				<h5 class="text-center">UPLOAD FILES</h5>
				<hr>
				<p></p>
			</div>
			<div class="col-md-4">
				<h5 class="text-center">ข้อสอบเกี่ยวกับรายวิชาที่สอบ</h5>
				<hr>
				<p>- รหัสวิชา</p>
				<p>- ชื่อวิชา</p>
				<p>- ภาคการศึกษา</p>
				<p>- ปีการศึกษา</p>
				<p>- วันที่สอบ</p>
				<p>- เวลาที่สอบ</p>
				<p>- สาขาวิชา</p>
				<p>- ชั้นปี</p>
				<p>- จำนวนนักศึกษา</p>
				<p>- จำนวนข้อสอบ มีกี่หน้า</p>
			</div>
			<div class="col-md-4">
				<h5 class="text-center">ความต้องการอุปกรณ์ในการสอบ</h5>
				<hr>
				<p>ต้องการอุปกรณ์ในการสอบ</p>
				<p>- กระดาษคำตอบ กากบาท</p>
				<p>- กระดาษคำตอบ สมุดแบบเส้น</p>
				<p>- กระดาษคำตอบ แบบเขียน</p>
				<p>- กระดาษคำตอบ (สีเขียวหรือสีฟ้า)</p>
				<p>- กระดาษกราฟ</p>
				<br>

			</div>
		</div>

	</div>
</form>

<!-- footer -->
<?php include('includes/footer.inc.php'); ?>
</body>
</html>