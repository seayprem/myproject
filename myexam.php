<?php 
include('config/db.php');
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
$counts_sql = "SELECT COUNT(*) AS total FROM sent_exam WHERE teacher_id = '".$_SESSION['ids']."'";
$counts_query = mysqli_query($conn, $counts_sql);
$counts_rows = mysqli_fetch_assoc($counts_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ตรวจการส่งข้อสอบ - ระบบส่งข้อสอบในสาขา</title>
	<!-- CSS -->
	<?php include('includes/css.inc.php'); ?>
	<!-- JS -->
	<?php include('includes/js.inc.php'); ?>
</head>
<body>
	

	<!-- Navbar -->
	<?php include('includes/navbar.inc.php'); ?>

	<!-- content -->
	<h3 class="text-center mt-5">รายการส่งข้อสอบ</h3>
	<div class="container">
		<hr>
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr class="text-center">
						<th>ลำดับข้อสอบ</th>
						<th>รายวิชาข้อสอบ</th>
						<th>สถานะการส่ง</th>
						<th>จัดการข้อมูล</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					if($counts_rows['total'] == 0) {
						echo '<tr>
						<td class="text-center" colspan="4">	
						ไม่พบข้อมูล
						</td>
						
						</tr>';
					} else {

					?>
					
					<?php 
						$sql = "SELECT sent_exam.sent_no, subjects.sub_name, sent_exam.sent_checked FROM sent_exam LEFT JOIN subjects ON sent_exam.sub_id = subjects.sub_id WHERE sent_exam.teacher_id = '".$_SESSION['ids']."' ORDER BY sent_exam.sent_no DESC";
						$query = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_assoc($query)) {
					?>
					<tr>
						<td class="text-center"><?= $row['sent_no']; ?></td>
						<td><?= $row['sub_name']; ?></td>
						<td class="text-center">
							<?php 
							if($row['sent_checked'] == 1) {
								echo "อนุมติแล้ว";
							} else if($row['sent_checked'] == 2) {
								echo "ไม่อนุมัติ";
							} else {
								echo "ยังไม่ได้ตรวจข้อสอบ";
							}
							?>
						</td>
						<td class="text-center">
							<a href="myexam_detail.php?infodetail=<?= $row['sent_no']; ?>" class="btn btn-secondary btn-sm">รายละเอียด</a>
						</td>
					</tr>
					<?php } ?>

				<?php } ?>
						
				</tbody>
			</table>
		</div>
	</div>


	<!-- footer -->
	<?php include('includes/footer.inc.php'); ?>
</body>
</html>