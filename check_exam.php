<?php 
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
	<title>หัวหน้าโปรแกรมวิชา</title>


	<style>
		button.nav-link {
			color: black;
		}
		
		button.active {
			background: #f271cf !important;
		}
	</style>

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
	<h3 class="text-center">ตรวจข้อสอบ</h3>
	<div class="container">
		<hr>
		<ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">รายการข้อสอบ</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">ข้อสอบที่อนุมัติ</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">ข้อสอบที่ไม่อนุมัติ</button>
			</li>
		</ul>
		<div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead class="text-center">
							<tr>
								<th>หมายเลขลำดับข้อสอบ</th>
								<th>ชื่อผู้ส่งข้อสอบ</th>
								<th>รายวิชาข้อสอบ</th>
								<th>เวลาที่ส่ง</th>
								<th>
									จัดการข้อมูล
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center">1</td>
								<td>วันชัย แซ่ลิ้ม</td>
								<td class="text-center">โปรแกรมเมอร์</td>
								<td class="text-center">13:00</td>
								<td class="text-center">
									<a href="#" class="btn btn-secondary">ดูข้อมูล</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead class="text-center">
							<tr>
								<th>หมายเลขลำดับข้อสอบ</th>
								<th>ชื่อผู้ส่งข้อสอบ</th>
								<th>รายวิชาข้อสอบ</th>
								<th>เวลาที่ส่ง</th>
								<th>
									จัดการข้อมูล
								</th>
								<th>
									สถานะ
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center">1</td>
								<td>วันชัย แซ่ลิ้ม</td>
								<td class="text-center">โปรแกรมเมอร์</td>
								<td class="text-center">13:00</td>
								<td class="text-center">
									<a href="#" class="btn btn-secondary">ดูข้อมูล</a>
								</td>
								<td class="text-center">
									<p class="text-success">อนุมัติแล้ว</p>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead class="text-center">
							<tr>
								<th>หมายเลขลำดับข้อสอบ</th>
								<th>ชื่อผู้ส่งข้อสอบ</th>
								<th>รายวิชาข้อสอบ</th>
								<th>เวลาที่ส่ง</th>
								<th>
									จัดการข้อมูล
								</th>
								<th>สถานะ</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center">1</td>
								<td>วันชัย แซ่ลิ้ม</td>
								<td class="text-center">โปรแกรมเมอร์</td>
								<td class="text-center">13:00</td>
								<td class="text-center">
									<a href="#" class="btn btn-secondary">ดูข้อมูล</a>
								</td>
								<td class='text-center'>
									<p class="text-danger">ไม่ผ่านการอนุมัติ</p>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>	
	</div>



	<!-- footer -->
	<?php include('includes/footer.inc.php'); ?>
</body>
</html>