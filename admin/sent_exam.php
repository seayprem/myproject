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
	<title>รายการส่งข้อสอบ - ระบบส่งข้อสอบในสาขา</title>
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
		<h1>รายการส่งข้อสอบ</h1>
		<hr>

		<!-- INFO -->
		<?php 
			if(isset($_GET['info'])) {
				$info_id = $_GET['info'];
				$info_sql = "SELECT * FROM sent_exam INNER JOIN teachers ON sent_exam.teacher_id = teachers.teacher_id INNER JOIN subjects ON sent_exam.sub_id = subjects.sub_id WHERE sent_exam.sent_no = '".$info_id."'";
				$info_query = mysqli_query($conn, $info_sql);
				$info_row = mysqli_fetch_assoc($info_query);
			
		?>
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
		<p><b>การจัดเย็บข้อสอบหน้าเดียว: </b>
			<?php if(empty($info_row['sent_single_copy'])) {
				echo "ไม่ต้องการ";
			} else {
				echo $info_row['sent_single_copy_start'] . " ถึง " . $info_row['sent_single_copy_end'];

			} ?>
		</p>
		<p><b>การจัดเย็บข้อสอบหน้าหลัง: </b>
			<?php 
				if(empty($info_row['sent_duplex_copy'])) {
					echo "ไม่ต้องการ";
				}	else {
					echo $info_row['sent_duplex_copy_start'] . " ถึง " . $info_row['sent_duplex_copy_end'];
				}
			?>
	</p>
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
			<a href="sent_exam.php" class="btn btn-danger">ย้อนกลับ</a>
		</div>
		<?php } ?>
		<!-- INFO -->

		<!-- Searching -->
		<form action="sent_exam.php?search" method="GET">
			<div class="input-group mb-3">
				<input type="text" class="form-control" name="search" placeholder="ค้นหาข้อมูล รหัสประจำตัว ชื่อ นามสกุล เบอร์โทร" aria-label="Recipient's username" aria-describedby="button-addon2" required>
				<button class="btn btn-outline-secondary" type="submit" id="button-addon2">ค้นหาข้อมูล</button>
				<a href="sent_exam.php" class="btn btn-outline-secondary" id="button-addon2">รีเฟรชข้อมูล</a>
			</div>

		</form>
		<!-- Searching -->
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr class="text-center">
						<th>ลำดับข้อสอบ</th>
						<th>ชื่อผู้ส่งข้อสอบ</th>
						<th>ข้อสอบวิชา</th>
						<th>ปีการศึกษา</th>
						<th>เวลาสอบ</th>
						<th>สถานะการอนุมัติ</th>
						<th colspan="3">การจัดการ</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$sql = "SELECT * FROM sent_exam INNER JOIN teachers ON sent_exam.teacher_id = teachers.teacher_id INNER JOIN subjects ON sent_exam.sub_id = subjects.sub_id WHERE sent_exam.sent_checked = 0 OR sent_exam.sent_checked = 1 OR sent_exam.sent_checked = 2 ORDER BY sent_exam.sent_no DESC";
					$query = mysqli_query($conn, $sql);
					$numrows = mysqli_num_rows($query);
					if($numrows == 0) {
						echo '<tr class="text-center">
							<td colspan="7">ไม่พบข้อมูล</td>	
						</tr>';
					} else if(isset($_GET['search'])) {
							$search_id = $_GET['search'];
							$search_sql = "SELECT * FROM sent_exam INNER JOIN teachers ON sent_exam.teacher_id = teachers.teacher_id INNER JOIN subjects ON sent_exam.sub_id = subjects.sub_id WHERE sent_exam.sent_checked = 0 OR sent_exam.sent_checked = 1 OR sent_exam.sent_checked = 2 OR teacher_fname LIKE '%".$search_id."%' OR sub_name LIKE '%".$search_id."%'";
							$search_query = mysqli_query($conn, $search_sql);
							if(mysqli_num_rows($search_query) == 0) {
								echo '<tr class="text-center">
									<td colspan="7">ไม่พบข้อมูลที่ค้นหา</td>	
								</tr>';
							}
							while($search_row = mysqli_fetch_assoc($search_query)) {

							
						?>
							<tr>
								<td class="text-center"><?= $search_row['sent_no']; ?></td>
								<td><?= $search_row['teacher_fname'] . " " . $search_row['teacher_lname']; ?></td>
								<td class="text-center"><?= $search_row['sub_name']; ?></td>
								<td class="text-center"><?= $search_row['sent_year']; ?></td>
								<td class="text-center"><?= $search_row['sent_time_exam']; ?></td>
								<td class="text-center">
									<?php 
									if($search_row['sent_checked'] == 1) {
										echo 'อนุมัติแล้ว';
									} else if($search_row['sent_checked'] == 2) {
										echo 'ไม่อนุมัติ';
									} else {
										echo 'ยังไม่ตรวจสอบ';
									}
									?>
								</td>
								<td colspan="2" class="text-center">
									<a href="sent_exam.php?info=<?= $search_row['sent_no']; ?>" class="btn btn-sm btn-secondary"><i class="fas fa-info-circle"></i></a>
									<a href="controller/takeexamAccept.php?id=<?= $row['sent_no']; ?>&officer_id=<?= $_SESSION['id']; ?>" onclick="return confirm('คุณแน่ใจใช่แล้วหรือไม่? ที่ต้องการรับข้อสอบ')"  class="btn btn-sm btn-secondary">รับข้อสอบ</a>
									<a href="#" onclick="return confirm('คุณแน่ใจใช่แล้วหรือไม่? ที่ต้องการลบข้อมูลนี้')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
								</td>
							</tr>

						<?php 
						}
						
					} else {

						while($row = mysqli_fetch_assoc($query)) {

						
					?>
					
					<tr>
						<td class="text-center"><?= $row['sent_no']; ?></td>
						<td><?= $row['teacher_fname'] . " " . $row['teacher_lname']; ?></td>
						<td class="text-center"><?= $row['sub_name']; ?></td>
						<td class="text-center"><?= $row['sent_year']; ?></td>
						<td class="text-center"><?= $row['sent_time_exam']; ?></td>
						<td class="text-center">
							<?php 
							if($row['sent_checked'] == 1) {
								echo 'อนุมัติแล้ว';
							} else if($row['sent_checked'] == 2) {
								echo 'ไม่อนุมัติ';
							} else {
								echo 'ยังไม่ตรวจสอบ';
							}
							?>
						</td>
						<td colspan="2" class="text-center">
							<a href="sent_exam.php?info=<?= $row['sent_no']; ?>" class="btn btn-sm btn-secondary"><i class="fas fa-info-circle"></i></a>
							<a href="controller/takeexamAccept.php?id=<?= $row['sent_no']; ?>&officer_id=<?= $_SESSION['id']; ?>" onclick="return confirm('คุณแน่ใจใช่แล้วหรือไม่? ที่ต้องการรับข้อสอบ')"  class="btn btn-sm btn-secondary">รับข้อสอบ</a>
							<a href="#" onclick="return confirm('คุณแน่ใจใช่แล้วหรือไม่? ที่ต้องการลบข้อมูลนี้')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
						</td>
					</tr>
					<?php 
					}	
				} ?>

				</tbody>
			</table>
		</div>
	</div>
	<?php include('includes/sidebarContentBottom.inc.php'); ?>
	<?php include('includes/footer.inc.php'); ?>
</body>
</html>