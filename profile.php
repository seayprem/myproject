<?php 
session_start();
if(empty($_SESSION['login'])) {
	header("Location: login.php");
} else {
	$now = time(); // Checking time right now

	if($now > $_SESSION['expire']) {
		// Session destroy Please login again for visit sentexam
		header("Location: logout.php");
	}

}
$position = $_SESSION['position'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ข้อมูลส่วนตัว - ระบบส่งข้อสอบในสาขา</title>
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


	<!-- Content body -->
	<div class="container">
		<h3 class="text-center mt-5">ข้อมูลส่วนตัว</h3>
		<hr>
	</div>

	<div class="container">
		<div class="d-flex align-items-start">
			<div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				<button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">ข้อมูล</button>
				<button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">แก้ไขข้อมูลส่วนตัว</button>
			</div>
			<div class="tab-content" id="v-pills-tabContent">
				<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
					<h4 class="text-center">รายละเอียดข้อมูลส่วนตัว</h4>
					<div class="mb-3">
						<label class="form-label">รหัสประจำตัว</label>
						<input type="text" class="form-control" value="<?= $_SESSION['ids']; ?>" disabled>
					</div>
					<div class="mb-3">
						<label class="form-label">ชื่อผู้ใช้</label>
						<input type="text" class="form-control" value="<?= $_SESSION['user']; ?>" disabled>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label class="form-label">ชื่อจริง</label>
								<input type="text" class="form-control" value="<?= $_SESSION['fname']; ?>" disabled>
							</div>

						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label class="form-label">นามสกุล</label>
								<input type="text" class="form-control" value="<?= $_SESSION['lname']; ?>" disabled>
							</div>

						</div>
					</div>
					<div class="mb-3">
						<label class="form-label">เบอร์โทร</label>
						<input type="text" class="form-control" value="<?= $_SESSION['tel']; ?>" disabled>
					</div>
					<div class="mb-3">
						<label class="form-label">ตำแหน่ง</label>
						<input type="text" class="form-control" value="<?= $position; ?>" disabled>
					</div>
				</div>
				<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
					<h4 class="text-center">แก้ไขข้อมูลส่วนตัว</h4>
					<div class="row">
						<div class="col-md-6">
							<form action="controller/auth/editProfile.php" method="POST">
							<div class="mb-3">
								<label class="form-label">ชื่อจริง</label>
								<input type="text" class="form-control" name="fname" value="<?= $_SESSION['fname']; ?>">
							</div>

						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label class="form-label">นามสกุล</label>
								<input type="text" class="form-control" name="lname" value="<?= $_SESSION['lname']; ?>">
							</div>

						</div>
					</div>
					<div class="mb-3">
						<label class="form-label">เบอร์โทร</label>
						<input type="text" class="form-control" name="tel" value="<?=  $_SESSION['tel']; ?>">
					</div>
					<input type="hidden" name="ids" value="<?= $_SESSION['ids']; ?>">
					<div class="d-grid gap-2">
						<input type="submit" class="btn btn-is" name="editProfile" onclick="return confirm('คุณยืนยันที่จะแก้ไขข้อมูลส่วนตัวใช่หรือไม่? สามารถแก้ไขได้ทุกเมื่อ');" value="แก้ไขข้อมูล">
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	


	<!-- footer -->
	<?php include('includes/footer.inc.php'); ?>
</body>
</html>