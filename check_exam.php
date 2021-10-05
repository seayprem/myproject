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
$counts_sql = "SELECT COUNT(*) AS total FROM sent_exam";
$counts_query = mysqli_query($conn, $counts_sql);
$counts_rows = mysqli_fetch_assoc($counts_query);

$counts_accept_sql = "SELECT COUNT(*) AS totalAccept FROM sent_exam WHERE sent_checked = 1";
$counts_accept_query = mysqli_query($conn, $counts_accept_sql);
$counts_accept_rows = mysqli_fetch_assoc($counts_accept_query);

$counts_unaccept_sql = "SELECT COUNT(*) AS totalUnAccept FROM sent_exam WHERE sent_checked = 2";
$counts_unaccept_query = mysqli_query($conn, $counts_unaccept_sql);
$counts_unaccept_rows = mysqli_fetch_assoc($counts_unaccept_query);

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
								<th>
									จัดการข้อมูล
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							if($counts_rows['total'] == 0)	{
								echo '
								<tr>
									<td class="text-center" colspan="5">ไม่พบข้อมูล</td>	
								</tr>	
								';
							} else {
							?>
							<?php 
								$list_sent_exam_sql = "SELECT sent_exam.sent_no, teachers.teacher_fname, teachers.teacher_lname, subjects.sub_name FROM sent_exam INNER JOIN teachers ON sent_exam.teacher_id = teachers.teacher_id INNER JOIN subjects ON sent_exam.sub_id = subjects.sub_id WHERE sent_checked = 0 ORDER BY sent_exam.sent_no DESC";
								$list_sent_exam_query = mysqli_query($conn, $list_sent_exam_sql);
								while($list_sent_exam_rows = mysqli_fetch_assoc($list_sent_exam_query)) {

								
							?>
							<tr>
								<td class="text-center"><?= $list_sent_exam_rows['sent_no']; ?></td>
								<td><?= $list_sent_exam_rows['teacher_fname'] . ' ' . $list_sent_exam_rows['teacher_lname']; ?></td>
								<td class="text-center"><?= $list_sent_exam_rows['sub_name']; ?></td>
								<td class="text-center">
									<a href="check_exam_detail.php?infodetail=<?= $list_sent_exam_rows['sent_no']; ?>" class="btn btn-secondary"><i class="fas fa-info-circle"></i></a>
								</td>
							</tr>
							<?php } ?>
						<?php } ?>
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
								<th>
									จัดการข้อมูล
								</th>
								<th>
									สถานะ
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 

								if($counts_accept_rows['totalAccept'] == 0) {
									echo '
									<tr>
										<td class="text-center" colspan="6">ไม่พบข้อมูล</td>	
									</tr>	
									';
								} else {

								$accept_sql = "SELECT sent_exam.sent_no, teachers.teacher_fname, teachers.teacher_lname, subjects.sub_name FROM sent_exam INNER JOIN teachers ON sent_exam.teacher_id = teachers.teacher_id INNER JOIN subjects ON sent_exam.sub_id = subjects.sub_id WHERE sent_checked = 1 ORDER BY sent_exam.sent_no DESC";
								$accept_query = mysqli_query($conn, $accept_sql);
								while($accept_row = mysqli_fetch_assoc($accept_query)) {
							?>
							<tr>
								<td class="text-center"><?= $accept_row['sent_no']; ?></td>
								<td><?= $accept_row['teacher_fname'] . ' ' . $accept_row['teacher_lname']; ?></td>
								<td class="text-center"><?= $accept_row['sub_name']; ?></td>
								<td class="text-center">
									<a href="#" class="btn btn-secondary">ดูข้อมูล</a>
								</td>
								<td class="text-center">
									<p class="text-success">อนุมัติแล้ว</p>
								</td>
							</tr>
							<?php } ?>
						<?php } ?>
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
								<th>
									จัดการข้อมูล
								</th>
								<th>สถานะ</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								if($counts_unaccept_rows['totalUnAccept'] == 0) {
									echo '
									<tr>
										<td class="text-center" colspan="6">ไม่พบข้อมูล</td>	
									</tr>	
									';
								} else {

								
								$unaccept_sql = "SELECT sent_exam.sent_no, teachers.teacher_fname, teachers.teacher_lname, subjects.sub_name FROM sent_exam INNER JOIN teachers ON sent_exam.teacher_id = teachers.teacher_id INNER JOIN subjects ON sent_exam.sub_id = subjects.sub_id WHERE sent_checked = 2 ORDER BY sent_exam.sent_no DESC";
								$unaccept_query = mysqli_query($conn, $unaccept_sql);
								while($unaccept_row = mysqli_fetch_assoc($unaccept_query)) {
							?>
							<tr>
								<td class="text-center"><?= $unaccept_row['sent_no']; ?></td>
								<td><?= $unaccept_row['teacher_fname'] . ' ' . $unaccept_row['teacher_lname']; ?></td>
								<td class="text-center"><?= $unaccept_row['sub_name'] ?></td>
								<td class="text-center">
									<a href="#" class="btn btn-secondary">ดูข้อมูล</a>
								</td>
								<td class='text-center'>
									<p class="text-danger">ไม่ผ่านการอนุมัติ</p>
								</td>
							</tr>
							<?php } ?>
						<?php } ?>
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