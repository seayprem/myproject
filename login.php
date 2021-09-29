<?php 
session_start();
if($_SESSION['login']) {
	header("Location: index.php");
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

	<!-- content -->
	<div class="container mt-5">
		<h4 class="text-is">สาขาวิชาระบบสารสนเทศ ( Information System )</h4>
		<p>คณะบริหารธุรกิจ มหาวิทยาลัยเทคโนโลยีราชมงคลอีสาน</p>
	</div>

	<!-- Login form -->
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title text-center">ลงชื่อเข้าใช้</h5>
					<form action="controller/auth/checkLogin.php" method="POST">
						<label for="username" class="form-label">ชื่อผู้ใช้งาน</label>
						<div class="input-group mb-3">
							<span class="input-group-text" id="addon-username"><i class="fas fa-user"></i></span>
							<input type="text" id="username" class="form-control" name="username" placeholder="กรุณากรอกชื่อผู้ใช้" aria-label="Username" aria-describedby="addon-username" value="" required>
						</div>
						<label for="password" class="form-label">รหัสผ่าน</label>
						<div class="input-group mb-3">
							<span class="input-group-text" id="addon-password"><i class="fas fa-key"></i></span>
							<input type="password" id="password" class="form-control" name="password" placeholder="กรุณากรอกรหัสผ่าน" aria-label="Password" aria-describedby="addon-password" value="" required>
						</div>
						
						<div class="d-grid gap-2 mt-2">
							<button type="submit" name="login" class="btn btn-is btn-lg" id="login"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</button>
						</div>
								
					</form>
					<div class="text-right">
						<br>
						<a href="admin/login.php" class="text-is">เฉพาะเจ้าหน้าที่</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br><br><br>


	<!-- footer -->
	<?php include('includes/footer.inc.php'); ?>
</body>
</html>