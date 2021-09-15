<?php 
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
include('../config/db.php');
// COUNT TEACHER
$count_sql_teachers = "SELECT COUNT(*) AS totalTeacher FROM teachers";
$count_query_teachers = mysqli_query($conn, $count_sql_teachers);
$count_row_teachers = mysqli_fetch_assoc($count_query_teachers);
// COUNT OFFICER
$count_sql_officers = "SELECT COUNT(*) AS totalOfficer FROM officers";
$count_query_officers = mysqli_query($conn, $count_sql_officers);
$count_row_officers = mysqli_fetch_assoc($count_query_officers);
// COUNT STUDENTSCLASS
$count_sql_studentsclass = "SELECT COUNT(*) AS totalStudentClass FROM students_class";
$count_query_studentsclass = mysqli_query($conn, $count_sql_studentsclass);
$count_row_studentsclass = mysqli_fetch_assoc($count_query_studentsclass);
// COUNT SUBJECT
$count_sql_subjects = "SELECT COUNT(*) AS totalSubject FROM subjects";
$count_query_subjects = mysqli_query($conn, $count_sql_subjects);
$count_row_subjects = mysqli_fetch_assoc($count_query_subjects);
// COUNT SENT_EXAM
$count_sql_sent_exam = "SELECT COUNT(*) AS totalSentExam FROM sent_exam";
$count_query_sent_exam = mysqli_query($conn, $count_sql_sent_exam);
$count_row_sent_exam = mysqli_fetch_assoc($count_query_sent_exam);
// COUNT TAKE_EXAM
$count_sql_take_exam = "SELECT COUNT(*) AS totalTakeExam FROM take_exam";
$count_query_take_exam = mysqli_query($conn, $count_sql_take_exam);
$count_row_take_exam = mysqli_fetch_assoc($count_query_take_exam);
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
		<h1>แผงควบคุม</h1>
		<hr>

		<div class="row">
			<!-- MENU COUNT -->
			<div class="col-md-4">
				<div class="card text-white bg-is mb-3">
					<div class="card-header">อาจารย์</div>
					<div class="card-body">
						<h5 class="card-title text-center"><i class="fas fa-users"></i> จำนวนอาจารย์</h5>
						<h1 class="card-text text-center"><?= $count_row_teachers['totalTeacher']; ?></h1>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="card text-white bg-is mb-3">
					<div class="card-header">เจ้าหน้าที่</div>
					<div class="card-body">
						<h5 class="card-title text-center"><i class="fas fa-users-cog"></i> จำนวนเจ้าหน้าที่</h5>
						<h1 class="card-text text-center"><?= $count_row_officers['totalOfficer']; ?></h1>
					</div>
				</div>
			</div>


			<div class="col-md-4">
				<div class="card text-white bg-is mb-3">
					<div class="card-header">ห้องเรียน</div>
					<div class="card-body">
						<h5 class="card-title text-center"><i class="fas fa-chalkboard-teacher"></i> จำนวนห้องเรียน</h5>
						<h1 class="card-text text-center"><?= $count_row_studentsclass['totalStudentClass']; ?></h1>
					</div>
				</div>
			</div>


			<div class="col-md-4">
				<div class="card text-white bg-is mb-3">
					<div class="card-header">วิชา</div>
					<div class="card-body">
						<h5 class="card-title text-center"><i class="fas fa-book-open"></i> จำนวนวิชา</h5>
						<h1 class="card-text text-center"><?= $count_row_subjects['totalSubject']; ?></h1>
					</div>
				</div>
			</div>


			<div class="col-md-4">
				<div class="card text-white bg-is mb-3">
					<div class="card-header">รายการส่งข้อสอบ</div>
					<div class="card-body">
						<h5 class="card-title text-center"><i class="fas fa-file-pdf"></i> จำนวนรายการส่งข้อสอบ</h5>
						<h1 class="card-text text-center"><?= $count_row_sent_exam['totalSentExam']; ?></h1>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="card text-white bg-is mb-3">
					<div class="card-header">รายการรับข้อสอบ</div>
					<div class="card-body">
						<h5 class="card-title text-center"><i class="fas fa-file-alt"></i> จำนวนรายการรับข้อสอบ</h5>
						<h1 class="card-text text-center"><?= $count_row_take_exam['totalTakeExam']; ?></h1>
					</div>
				</div>
			</div>

			
			<!-- MENU COUNT -->

		</div>
	</div>
	<?php include('includes/sidebarContentBottom.inc.php'); ?>
	<?php include('includes/footer.inc.php'); ?>
</body>
</html>