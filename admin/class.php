<?php 
include('../config/db.php');
session_start();
if(empty($_SESSION['officer'])) {
	header("Location: login.php");
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
		<h1>ห้องเรียน</h1>
		<hr>

		<div class="text-right">
			<a href="class.php?show=add" class="btn btn-is">เพิ่มข้อมูล</a>
		</div>

		<br>

		<!-- ADD -->
		<?php 
		if(isset($_GET['show']) == "add") {

		?>

		<form action="controller/classAdd.php" method="POST">
			<div class="mb-3">
				<label class="form-label">รหัสห้องเรียน</label>
				<input type="text" class="form-control" name="class_id" placeholder="กรุณาป้อนรหัสห้องเรียน" required>
			</div>
			<div class="mb-3">
				<label class="form-label">จำนวนนักศึกษา</label>
				<input type="text" class="form-control" name="class_amount" placeholder="กรุณาป้อนจำนวนนักศึกษา" required>
			</div>
			<div class="mb-3">
				<label class="form-label">ชั้นปี</label>
				<input type="text" class="form-control" name="class_year" placeholder="กรุณาป้อนชั้นปี" required>
			</div>
			<div class="mb-3">
				<label class="form-label">เลือกรายวิชา</label>
				<select name="sub_id" class="form-control">
					<option value="0">------- กรุณาเลือกรายวิชา -------</option>
					<?php 
					$sub_sql = "SELECT * FROM subjects";
					$sub_query = mysqli_query($conn, $sub_sql);
					while($sub_row = mysqli_fetch_assoc($sub_query)) {

					
					?>
					<option value="<?= $sub_row['sub_id']; ?>"><?= $sub_row['sub_name']; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="mb-3">
				<div class="d-grid 2-gap">
					<input type="submit" name="add" class="btn btn-is" value="เพิ่มข้อมูล">
				</div>
			</div>
			<div class="d-grid 2-gap">
				<a href="class.php" class="btn btn-danger">ย้อนกลับ</a>
			</div>
			<br><br>
		</form>

		<?php } ?>

		<!-- EDIT -->
		<?php 
		if(isset($_GET['edit'])) {
			$edit_id = $_GET['edit'];
			$edit_sql = "SELECT * FROM students_class WHERE class_id = '".$edit_id."'";
			$edit_query = mysqli_query($conn, $edit_sql);
			$edit_row = mysqli_fetch_array($edit_query);

			if(isset($_POST['edit'])) {
				$class_id = $_POST['class_id'];
				$class_amount = $_POST['class_amount'];
				$class_year = $_POST['class_year'];
				$sub_id = $_POST['sub_id'];

				$update_sql = "UPDATE students_class SET class_id = '".$class_id."', class_amount = '".$class_amount."', class_year = '".$class_year."' WHERE class_id = '".$edit_id."' ";
				$update_query = mysqli_query($conn, $update_sql);
				if($update_query) {
					header("Location: class.php");
				} else {
					echo '<script>alert("ล้มเหลว กรุณาลองใหม่อีกครั้ง"); window.location.href="class.php"</script>';
				}
			}
		
		?>
		<form action="class.php?edit=<?= $edit_row['class_id']; ?>" method="POST">
		<div class="mb-3">
				<label class="form-label">รหัสห้องเรียน</label>
				<input type="text" class="form-control" name="class_id" placeholder="กรุณาป้อนรหัสห้องเรียน" value="<?= $edit_row['class_id']; ?>" required>
			</div>
			<div class="mb-3">
				<label class="form-label">จำนวนนักศึกษา</label>
				<input type="text" class="form-control" name="class_amount" placeholder="กรุณาป้อนจำนวนนักศึกษา" value="<?= $edit_row['class_amount']; ?>" required>
			</div>
			<div class="mb-3">
				<label class="form-label">ชั้นปี</label>
				<input type="text" class="form-control" name="class_year" placeholder="กรุณาป้อนชั้นปี" value="<?= $edit_row['class_year']; ?>" required>
			</div>
			<div class="mb-3">
				<label class="form-label">เลือกรายวิชา</label>
				<select name="sub_id" class="form-control">
					<?php  
					$sub_edit_sql_id = "SELECT * FROM students_class LEFT JOIN subjects ON students_class.sub_id = subjects.sub_id WHERE students_class.class_id = '".$edit_id."'";
					$sub_edit_query_id = mysqli_query($conn, $sub_edit_sql_id);
					$sub_edit_row = mysqli_fetch_array($sub_edit_query_id);
					?>
					<option value="<?= $sub_edit_row['sub_id'] ?>"><?= $sub_edit_row['sub_name']; ?></option>
					<option value="0">------- กรุณาเลือกรายวิชา -------</option>
					<?php 
					$sub_edit_sql = "SELECT * FROM subjects";
					$sub_edit_query = mysqli_query($conn, $sub_edit_sql);
					while($sub_edit_row = mysqli_fetch_assoc($sub_edit_query)) {

					
					?>
					<option value="<?= $sub_edit_row['sub_id']; ?>"><?= $sub_edit_row['sub_name']; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="mb-3">
				<div class="d-grid 2-gap">
					<input type="submit" name="edit" class="btn btn-is" value="แก้ไขข้อมูล">
				</div>
			</div>
			<div class="d-grid 2-gap">
				<a href="class.php" class="btn btn-danger">ย้อนกลับ</a>
			</div>
			<br><br>
		</form>
		<?php } ?>


		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr class="text-center">
						<th>รหัสห้องเรียน</th>
						<th>จำนวนนักศึกษา</th>
						<th>ชั้นปี</th>
						<th>รหัสวิชา</th>
						<th colspan="2">จัดการ</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$sql = "SELECT * FROM students_class";
					$query = mysqli_query($conn, $sql);
					while($row = mysqli_fetch_assoc($query)) {
					?>
					<tr class="text-center">
						<td><?= $row['class_id']; ?></td>
						<td><?= $row['class_amount']; ?></td>
						<td><?= $row['class_year']; ?></td>
						<td><?= $row['sub_id']; ?></td>
						<td>
							<a href="class.php?edit=<?= $row['class_id']; ?>" class="btn btn-warning btn-sm">แก้ไข</a>
							<a href="controller/classDelete.php?id=<?= $row['class_id']; ?>" onclick="return confirm('คุณแน่ใจใช่แล้วหรือไม่? ที่ต้องการลบ')" class="btn btn-danger btn-sm">ลบ</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

	</div>
	<?php include('includes/sidebarContentBottom.inc.php'); ?>
</body>
</html>