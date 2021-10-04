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
		<h1>ห้องเรียน</h1>
		<hr>

		<div class="text-right">
			<a href="class.php?show=add" class="btn btn-is">เพิ่มข้อมูล</a>
		</div>

		<h5 class="text-center">ห้องเรียน</h5>


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
					echo '<script>alert("แก้ไข ข้อมูลสำเร็จ"); window.location.href = "class.php"</script>';
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

		<!-- Searching -->
		<form action="class.php?search" method="GET">
			<div class="input-group mb-3">
				<input type="text" class="form-control" name="search" placeholder="ค้นหาข้อมูล รหัสประจำตัว ชื่อ นามสกุล เบอร์โทร" aria-label="Recipient's username" aria-describedby="button-addon2">
				<button class="btn btn-outline-secondary" type="submit" id="button-addon2">ค้นหาข้อมูล</button>
				<a href="class.php" class="btn btn-outline-secondary" id="button-addon2">รีเฟรชข้อมูล</a>
			</div>

		</form>
		<!-- Searching -->


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
					$count_sql = "SELECT COUNT(*) AS totalClass FROM students_class";
					$count_query = mysqli_query($conn, $count_sql);
					$count_row = mysqli_fetch_assoc($count_query);
					if($count_row['totalClass'] == 0) {
						echo '<tr>
							<td class="text-center" colspan="5">ไม่พบข้อมูล</td>	
						</tr>';
					} else if (isset($_GET['search'])) {
							$search_id = $_GET['search'];
						
						?>


				<?php 
					} else {

					
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
							<a href="class.php?edit=<?= $row['class_id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
							<a href="controller/classDelete.php?id=<?= $row['class_id']; ?>" onclick="return confirm('คุณแน่ใจใช่แล้วหรือไม่? ที่ต้องการลบ')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
						</td>
					</tr>
					<?php } ?>
				<?php } ?>
				</tbody>
			</table>
		</div>

	</div>
	<?php include('includes/sidebarContentBottom.inc.php'); ?>
	<?php include('includes/footer.inc.php'); ?>
</body>
</html>