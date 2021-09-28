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
		<h1>อาจารย์</h1>
		<hr>

		<div class="text-right">
			<a href="teachers.php?show=add" class="btn btn-is">เพิ่มข้อมูล</a>
		</div>

		<!-- add  -->
		<?php 
		if(isset($_GET['show']) == "add") {

		
		?>
			<form action="controller/teacherAdd.php" method="POST">
				<div class="mb-3">
					<label class="form-label">รหัสประจำตัว</label>
					<input type="text" name="teacher_id" class="form-control" placeholder="กรุณาป้อนรหัสประจำตัว" required>
				</div>
				<div class="mb-3">
					<label class="form-label">ชื่อผู้ใช้</label>
					<input type="text" name="teacher_user" class="form-control" placeholder="กรุณาป้อนชื่อผู้ใช้" required>
				</div>
				<div class="mb-3">
					<label class="form-label">รหัสผ่าน</label>
					<input type="text" name="teacher_pass" class="form-control" placeholder="กรุณาป้อนรหัสผ่าน" required>
				</div>
				<div class="mb-3">
					<label class="form-label">ชื่อจริง</label>
					<input type="text" name="teacher_fname" class="form-control" placeholder="กรุณาป้อนชื่อจริง" required>
				</div>
				<div class="mb-3">
					<label class="form-label">นามสกุล</label>
					<input type="text" name="teacher_lname" class="form-control" placeholder="กรุณาป้อนนามสกุล" required>
				</div>
				<div class="mb-3">
					<label class="form-label">เบอร์โทร</label>
					<input type="text" name="teacher_tel" class="form-control" placeholder="กรุณาป้อนเบอร์โทร" required>
				</div>
				<div class="mb-3">
					<label class="form-label">ตำแหน่ง</label>
					<input type="text" name="teacher_position" class="form-control" placeholder="กรุณาป้อนตำแหน่ง" required>
				</div>
				<div class="d-grid gap-2 mt-2">
					<input type="submit" name="add" class="btn btn-is" value="เพิ่มข้อมูล">
				</div>
				<div class="d-grid gap-2 mt-2">
					<a href="teachers.php" class="btn btn-danger">ยกเลิก</a>
				</div>
			</form><br><br>
		<?php } ?>

		<!-- EDIT -->
		<?php 
		if(isset($_GET['edit'])) {
			$edit_id = $_GET['edit'];
			$edit_sql = "SELECT * FROM teachers WHERE teacher_id = '".$edit_id."'";
			$edit_query = mysqli_query($conn, $edit_sql);
			$edit_row = mysqli_fetch_array($edit_query);

			if(isset($_POST['edit'])) {
				$update_teacher_id = $_POST['teacher_id'];
				$update_teacher_user = $_POST['teacher_user'];
				$update_teacher_pass = $_POST['teacher_pass'];
				$update_teacher_fname = $_POST['teacher_fname'];
				$update_teacher_lname = $_POST['teacher_lname'];
				$update_teacher_tel = $_POST['teacher_tel'];
				$update_teacher_position = $_POST['teacher_position'];
				$update_sql = "UPDATE teachers SET teacher_id = '".$update_teacher_id."', teacher_user = '".$update_teacher_user."', teacher_pass = '".$update_teacher_pass."', teacher_fname = '".$update_teacher_fname."', teacher_lname = '".$update_teacher_lname."', teacher_tel = '".$update_teacher_tel."', teacher_position = '".$update_teacher_position."' WHERE teacher_id = '".$edit_id."'";
				$update_query = mysqli_query($conn, $update_sql);
				if($update_query) {
					echo '<script>alert("แก้ไข ข้อมูลสำเร็จ"); window.location.href = "teachers.php"</script>';
				} else {
					echo '<script>alert("ล้มเหลว กรุณาลองใหม่อีกครั้ง"); window.location.href="teachers.php"</script>';
				}
			}
		?>
		<form action="teachers.php?edit=<?= $edit_row['teacher_id']; ?>" method="POST">
				<div class="mb-3">
					<label class="form-label">รหัสประจำตัว</label>
					<input type="text" name="teacher_id" class="form-control" placeholder="กรุณาป้อนรหัสประจำตัว" value="<?= $edit_row['teacher_id']; ?>" required>
				</div>
				<div class="mb-3">
					<label class="form-label">ชื่อผู้ใช้</label>
					<input type="text" name="teacher_user" class="form-control" placeholder="กรุณาป้อนชื่อผู้ใช้" value="<?= $edit_row['teacher_user']; ?>" required>
				</div>
				<div class="mb-3">
					<label class="form-label">รหัสผ่าน</label>
					<input type="text" name="teacher_pass" class="form-control" placeholder="กรุณาป้อนรหัสผ่าน" value="<?= $edit_row['teacher_pass']; ?>" required>
				</div>
				<div class="mb-3">
					<label class="form-label">ชื่อจริง</label>
					<input type="text" name="teacher_fname" class="form-control" placeholder="กรุณาป้อนชื่อจริง" value="<?= $edit_row['teacher_fname']; ?>" required>
				</div>
				<div class="mb-3">
					<label class="form-label">นามสกุล</label>
					<input type="text" name="teacher_lname" class="form-control" placeholder="กรุณาป้อนนามสกุล" value="<?= $edit_row['teacher_lname']; ?>" required>
				</div>
				<div class="mb-3">
					<label class="form-label">เบอร์โทร</label>
					<input type="text" name="teacher_tel" class="form-control" placeholder="กรุณาป้อนเบอร์โทร" value="<?= $edit_row['teacher_tel']; ?>" required>
				</div>
				<div class="mb-3">
					<label class="form-label">ตำแหน่ง</label>
					<input type="text" name="teacher_position" class="form-control" placeholder="กรุณาป้อนตำแหน่ง" value="<?= $edit_row['teacher_position']; ?>" required>
				</div>
				<div class="d-grid gap-2 mt-2">
					<input type="submit" name="edit" class="btn btn-is" value="แก้ไขข้อมูล">
				</div>
				<div class="d-grid gap-2 mt-2">
					<a href="teachers.php" class="btn btn-danger">ยกเลิก</a>
				</div>
			</form><br><br>
		<?php } ?>

		<!-- INFO -->
		<?php 
		if(isset($_GET['info'])) {
			$info_id = $_GET['info'];
			$info_sql = "SELECT * FROM teachers";
			$info_query = mysqli_query($conn, $info_sql);
			$info_row = mysqli_fetch_array($info_query);
		?>
		<h4>รายละเอียดข้อมูลของอาจารย์ <?= $info_row['teacher_fname'] . "  " . $info_row['teacher_lname']; ?></h4>
		<p>รหัสประจำตัว : <b><?= $info_row['teacher_id']; ?></b></p>
		<p>ชื่อผู้ใช้ : <b><?= $info_row['teacher_user']; ?></b></p>
		<p>รหัสผ่าน : <b><?= $info_row['teacher_pass']; ?></b></p>
		<p>ชื่อจริง : <b><?= $info_row['teacher_fname']; ?></b></p>
		<p>นามสกุล : <b><?= $info_row['teacher_lname']; ?></b></p>
		<p>เบอร์โทร : <b><?= $info_row['teacher_tel']; ?></b></p>
		<p>ตำแหน่ง : <b><?= $info_row['teacher_position']; ?></b></p>

		<br>
		<div class="d-grid gap-2 mt-2">
			<a href="teachers.php" class="btn btn-danger">ย้อนกลับ</a><br><br>
		</div>
		<?php } ?>

		<div class="row">
			<div class="col-md-12">
				<h5 class="text-center">ข้อมูลอาจารย์</h5>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr class="text-center">
								<th>รหัสประจำตัว</th>
								<th>ชื่อจริง</th>
								<th>นามสกุล</th>
								<th>เบอร์โทร</th>
								<th colspan="3">จัดการ</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$sql = "SELECT * FROM teachers";
							$query = mysqli_query($conn, $sql);
							while($row = mysqli_fetch_assoc($query)) {

							
							?>
							<tr class="text-center">
								<td><?= $row['teacher_id']; ?></td>
								<td><?= $row['teacher_fname']; ?></td>
								<td><?= $row['teacher_lname']; ?></td>
								<td><?= $row['teacher_tel']; ?></td>
								<td colspan="3">
									<a href="teachers.php?info=<?= $row['teacher_id']; ?>" class="btn btn-secondary btn-sm">ดูข้อมูล</a>
									<a href="teachers.php?edit=<?= $row['teacher_id']; ?>" class="btn btn-warning btn-sm">แก้ไข</a>
									<a href="controller/teacherDelete.php?id=<?= $row['teacher_id']; ?>" onclick="confirm('คุณแน่ใจใช่หรือไม่? ที่จะลบ <?= $row['teacher_fname']; ?> ออก')" class="btn btn-danger btn-sm">ลบ</a>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			</div>
		</div>
	</div>
	<?php include('includes/sidebarContentBottom.inc.php'); ?>
	<?php include('includes/footer.inc.php'); ?>
</body>
</html>