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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>เวลาลงทะเบียนกลุ่มเรียน - ระบบจัดการข้อสอบ</title>
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

	<!-- Content  -->
	<div class="col py-3">
		<h1>ลงทะเบียนกลุ่มเรียน</h1>
		<hr>


		<!-- ADD -->
		<div class="text-right">
			<a href="associate.php?add" class="btn btn-is">เพิ่มข้อมูล</a>
		</div>

		<?php 
		
		if(isset($_GET['add']))	{

		
		?>
		<form class="my-3" action="controller/associateAdd.php" method="POST">	
			<div class="mb-3">
				<label class="form-label">จำนวนนักศึกษาที่ลงทะเบียน</label>
				<input type="number" class="form-control" name="ass_num_regis" value="0" required>
			</div>
			<div class="mb-3">
				<label class="form-label">เวลาลงทะเบียนกลุ่มเรียน</label>
				<input type="text" class="form-control" name="ass_date_regis" required>
			</div>
			<div class="mb-3">
				<label class="form-label">รายวิชา</label>
				<select name="sub_id" class="form-select">
					<option value="" disabled selected>--- กรุณาเลือกรายวิชา ---</option>
					<?php 
					$list_sub_sql = "SELECT sub_id, sub_name FROM subjects";
					$list_sub_query = mysqli_query($conn, $list_sub_sql);
					while($list_sub_row = mysqli_fetch_assoc($list_sub_query)) {

					
					?>
					<option value="<?= $list_sub_row['sub_id']; ?>"><?= $list_sub_row['sub_name']; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="mb-3">
				<label class="form-label">ห้องเรียน</label>
				<select name="class_id" class="form-select">
					<option value="" disabled selected>--- กรุณาเลือกห้องเรียน ---</option>
					<?php 
					$list_class_sql = "SELECT class_id, class_code FROM students_class";
					$list_class_query = mysqli_query($conn, $list_class_sql);
					while($list_class_row = mysqli_fetch_assoc($list_class_query)) {

					
					?>
					<option value="<?= $list_class_row['class_id']; ?>"><?= $list_class_row['class_code']; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="mb-3 d-grid 2-gap">
				<input type="submit" name="add" class="btn btn-is" value="เพิ่มข้อมูล">
			</div>
		</form>
		<div class="mb-3 d-grid 2-gap">
			<a href="associate.php" class="btn btn-danger">ย้อนกลับ</a>
		</div>
		<?php } ?>

		<!-- ADD -->

		<!-- EDIT -->
		<?php 
			if(isset($_GET['edit'])) {
				$edit_id = $_GET['edit'];
				$edit_sql = "SELECT * FROM associate INNER JOIN subjects ON associate.sub_id = subjects.sub_id INNER JOIN students_class ON associate.class_id = students_class.class_id WHERE associate.ass_id = '".$edit_id."'";
				$edit_query = mysqli_query($conn, $edit_sql);
				$edit_row = mysqli_fetch_assoc($edit_query);
			
		?>


		<form class="my-3" action="controller/associateUpdate.php?id=<?= $edit_row['ass_id']; ?>" method="POST">	
			<div class="mb-3">
				<label class="form-label">จำนวนนักศึกษาที่ลงทะเบียน</label>
				<input type="number" class="form-control" name="ass_num_regis" value="<?= $edit_row['ass_num_regis']; ?>" required>
			</div>
			<div class="mb-3">
				<label class="form-label">เวลาลงทะเบียนกลุ่มเรียน</label>
				<input type="text" class="form-control" name="ass_date_regis" value="<?= $edit_row['ass_date_regis']; ?>" required>
			</div>
			<div class="mb-3">
				<label class="form-label">รายวิชา</label>
				<select name="sub_id" class="form-select">
					<option value="<?= $edit_row['sub_id']; ?>" selected><?= $edit_row['sub_name']; ?></option>
					<option value="" disabled>--- กรุณาเลือกรายวิชา ---</option>
					<?php 
					$list_sub_sql = "SELECT sub_id, sub_name FROM subjects";
					$list_sub_query = mysqli_query($conn, $list_sub_sql);
					while($list_sub_row = mysqli_fetch_assoc($list_sub_query)) {

					
					?>
					<option value="<?= $list_sub_row['sub_id']; ?>"><?= $list_sub_row['sub_name']; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="mb-3">
				<label class="form-label">ห้องเรียน</label>
				<select name="class_id" class="form-select">
					<option value="<?= $edit_row['class_id']; ?>" selected><?= $edit_row['class_code']; ?></option>
					<option value="" disabled>--- กรุณาเลือกห้องเรียน ---</option>
					<?php 
					$list_class_sql = "SELECT class_id, class_code FROM students_class";
					$list_class_query = mysqli_query($conn, $list_class_sql);
					while($list_class_row = mysqli_fetch_assoc($list_class_query)) {

					
					?>
					<option value="<?= $list_class_row['class_id']; ?>"><?= $list_class_row['class_code']; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="mb-3 d-grid 2-gap">
				<input type="submit" name="edit" class="btn btn-is" value="แก้ไขข้อมูล">
			</div>
		</form>
		<div class="mb-3 d-grid 2-gap">
			<a href="associate.php" class="btn btn-danger">ย้อนกลับ</a>
		</div>


		<?php } ?>

		<!-- EDIT -->


		<!-- Searching -->
		<h5 class="text-center">ลงทะเบียนกลุ่มเรียน</h5>
		<form action="associate.php?search" method="GET">
			<div class="input-group mb-3">
				<input type="text" class="form-control" name="search" placeholder="ค้นหาข้อมูล ชื่อวิชา" aria-label="Recipient's username" aria-describedby="button-addon2" required>
				<button class="btn btn-outline-secondary" type="submit" id="button-addon2">ค้นหาข้อมูล</button>
				<a href="associate.php" class="btn btn-outline-secondary" id="button-addon2">รีเฟรชข้อมูล</a>
			</div>

		</form>
		<!-- Searching -->

		<!-- table -->
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr class="text-center">
						<th>ลำดับ</th>
						<th>ห้องเรียน</th>
						<th>รายวิชา</th>
						<th>จำนวนนักศึกษาที่ลงทะเบียน</th>
						<th>วันเวลา</th>
						<th colspan="2">จัดการ</th>
					</tr>
				</thead>
					
				<tbody>
					<?php 
					$sql = "SELECT * FROM associate INNER JOIN subjects ON associate.sub_id = subjects.sub_id INNER JOIN students_class ON associate.class_id = students_class.class_id ORDER BY associate.ass_id DESC";
					$query = mysqli_query($conn, $sql);
					if(mysqli_num_rows($query) == 0) {
						echo '<tr><td colspan="6" class="text-center">ไม่พบข้อมูล</td></tr>';
					} else if(isset($_GET['search'])) {
							$search_id = $_GET['search'];
							$search_sql = "SELECT * FROM associate INNER JOIN subjects ON associate.sub_id = subjects.sub_id INNER JOIN students_class ON associate.class_id = students_class.class_id WHERE subjects.sub_name LIKE '%".$search_id."%' OR students_class.class_code LIKE '%".$search_id."%'";
							$search_query = mysqli_query($conn, $search_sql);
							if(mysqli_num_rows($search_query) == 0) {
								echo '<tr><td colspan="6" class="text-center">ไม่ข้อมูลที่ค้นหา</td></tr>';
							}
							while($search_row = mysqli_fetch_assoc($search_query)) {

							

						?>
						<tr>
							<td class="text-center"><?= $search_row['ass_id']; ?></td>
							<td class="text-center"><?= $search_row['class_code']; ?></td>
							<td><?= $search_row['sub_name']; ?></td>
							<td class="text-center"><?= $search_row['ass_num_regis']; ?></td>
							<td class="text-center"><?= $search_row['ass_date_regis']; ?></td>
							<td class="text-center">
								<a href="associate.php?edit=<?= $search_row['ass_id']; ?>" class="btn btn-warning btn-sm">แก้ไข</a>
								<a href="controller/associateDelete.php?id=<?= $search_row['ass_id']; ?>" onclick="return confirm('คุณแน่ใจใช่แล้วหรือไม่ ที่ต้องการลบข้อมูลกลุ่มเรียน')" class="btn btn-danger btn-sm">ลบ</a>
							</td>
						</tr>

						<?php 
						}
					}  else {
						while($row = mysqli_fetch_assoc($query)) {
					?>
					<tr>
						<td class="text-center"><?= $row['ass_id']; ?></td>
						<td class="text-center"><?= $row['class_code']; ?></td>
						<td><?= $row['sub_name']; ?></td>
						<td class="text-center"><?= $row['ass_num_regis']; ?></td>
						<td class="text-center"><?= $row['ass_date_regis']; ?></td>
						<td class="text-center">
							<a href="associate.php?edit=<?= $row['ass_id']; ?>" class="btn btn-warning btn-sm">แก้ไข</a>
							<a href="controller/associateDelete.php?id=<?= $row['ass_id']; ?>" onclick="return confirm('คุณแน่ใจใช่แล้วหรือไม่ ที่ต้องการลบข้อมูลกลุ่มเรียน')" class="btn btn-danger btn-sm">ลบ</a>
						</td>
					</tr>
					<?php 
						}
				} ?>
				</tbody>


			</table>

		</div>
		<!-- table -->
	</div>

	<?php include('includes/sidebarContentBottom.inc.php'); ?>
	<?php include('includes/footer.inc.php'); ?>
	
</body>
</html>