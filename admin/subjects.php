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
	<title>รายวิชา - ระบบส่งข้อสอบในสาขา</title>
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
		<h1>รายวิชา</h1>
		<hr>

		<div class="text-right">
			<a href="subjects.php?show=add" class="btn btn-is">เพิ่มข้อมูล</a>
		</div>

		<!-- ADD -->
		<?php if(isset($_GET['show']) == "add") { ?>
			<form action="controller/subjectAdd.php" method="POST">
				<div class="mb-3">
					<label class="form-label">รหัสวิชา</label>
					<input type="text" name="sub_id" class="form-control" placeholder="กรุณาป้อนรหัสวิชา" required>
				</div>
				<div class="mb-3">
					<label class="form-label">ชื่อวิชา</label>
					<input type="text" name="sub_name" class="form-control" placeholder="กรุณาป้อนชื่อวิชา" required>
				</div>
				<div class="mb-3">
					<label class="form-label">หน่วยกิต</label>
					<input type="number" name="sub_credit" class="form-control" value="0" placeholder="กรุณาป้อนหน่วยกิต" required>
				</div>
				<div class="d-grid gap-2 mt-2">
					<input type="submit" name="add" class="btn btn-is" value="เพิ่มข้อมูล">
				</div>
				<div class="d-grid gap-2 mt-2">
					<a href="subjects.php" class="btn btn-danger">ยกเลิก</a>
				</div>
			</form>
			<br><br>
			<?php } ?>

			<!-- EDIT -->
			<?php if(isset($_GET['edit'])) { 
				$id = $_GET['edit'];

				$edit_sql = "SELECT * FROM subjects WHERE sub_id = '".$id."'";
				$edit_query = mysqli_query($conn, $edit_sql);
				$edit_row = mysqli_fetch_array($edit_query);

				

				if(isset($_POST['edit'])) {
					$update_sub_id = $_POST['sub_id'];
					$update_sub_name = $_POST['sub_name'];
					$update_sub_credit = $_POST['sub_credit'];
					$update_sql = "UPDATE subjects SET sub_id = '".$update_sub_id."', sub_name = '".$update_sub_name."' , sub_credit = '".$update_sub_credit."' WHERE sub_id = '".$id."' ";
					$update_query = mysqli_query($conn, $update_sql);
					if($update_query) {
						echo '<script>alert("แก้ไข ข้อมูลสำเร็จ"); window.location.href = "subjects.php"</script>';
					} else {
						echo '<script>alert("ล้มเหลว กรุณาลองใหม่อีกครั้ง"); window.location.href="../subjects.php"</script>';
					}
				}
				?>
			
			<form action="subjects.php?edit=<?= $edit_row['sub_id']; ?>" method="POST">
				<div class="mb-3">
					<label class="form-label">รหัสวิชา</label>
					<input type="text" name="sub_id" class="form-control" placeholder="กรุณาป้อนรหัสวิชา" value="<?= $edit_row['sub_id']; ?>" required>
				</div>
				<div class="mb-3">
					<label class="form-label">ชื่อวิชา</label>
					<input type="text" name="sub_name" class="form-control" placeholder="กรุณาป้อนชื่อวิชา" value="<?= $edit_row['sub_name']; ?>" required>
				</div>
				<div class="mb-3">
					<label class="form-label">หน่วยกิต</label>
					<input type="number" name="sub_credit" class="form-control" placeholder="กรุณาป้อนหน่วยกิต" value="<?= $edit_row['sub_credit']; ?>" required>
				</div>
				<div class="d-grid gap-2 mt-2">
					<input type="submit" name="edit" class="btn btn-is" value="แก้ไขข้อมูล">
				</div>
				<div class="d-grid gap-2 mt-2">
					<a href="subjects.php" class="btn btn-danger">ยกเลิก</a>
				</div>
			</form>
			<br><br>
			<?php } ?>


				<h5 class="text-center">ข้อมูลรายวิชา</h5>
				<!-- Searching -->
				<form action="subjects.php?search" method="GET">
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="search" placeholder="ค้นหาข้อมูล รหัสวิชา ชื่อวิชา" aria-label="Recipient's username" aria-describedby="button-addon2">
						<button class="btn btn-outline-secondary" type="submit" id="button-addon2">ค้นหาข้อมูล</button>
						<a href="subjects.php" class="btn btn-outline-secondary" id="button-addon2">รีเฟรชข้อมูล</a>
					</div>

				</form>
		<!-- Searching -->
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr class="text-center">
								<th>รหัสวิชา</th>
								<th>ชื่อวิชา</th>
								<th>หน่วยกิต</th>
								<th colspan="2">จัดการ</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$count_sql = "SELECT COUNT(*) as totalSubjects FROM subjects";
								$count_query = mysqli_query($conn, $count_sql);
								$count_row = mysqli_fetch_assoc($count_query);
								if($count_row['totalSubjects'] == 0) {
									echo '<tr>
										<td class="text-center" colspan="4">ไม่พบข้อมูล</td>	
									</tr>';
								} else if(isset($_GET['search'])) {
										$search_id = $_GET['search'];
										$search_sql = "SELECT * FROM subjects WHERE sub_id LIKE '%".$search_id."%' OR sub_name LIKE '%".$search_id."%'";
										$search_query = mysqli_query($conn, $search_sql);
										while($search_row = mysqli_fetch_assoc($search_query)) {

										
									?>
									<tr>
										<td class="text-center"><?= $search_row['sub_id']; ?></td>
										<td><?= $search_row['sub_name']; ?></td>
										<td class="text-center"><?= $search_row['sub_credit']; ?></td>
										<td colspan="2" class="text-center">
											<a href="subjects.php?edit=<?= $search_row['sub_id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
											<a href="controller/subjectDelete.php?id=<?= $search_row['sub_id']; ?>" onclick="return confirm('คุณแน่ใจใช่หรือไม่? ที่จะลบ <?= $search_row['sub_name']; ?> ออก')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
										</td>
									</tr>


									<?php
									}
								} else {

								
								$sql = "SELECT * FROM subjects";
								$query = mysqli_query($conn, $sql);
								$active = 'active';
							
								while($row = mysqli_fetch_assoc($query)) {

							
							?>
							<tr>
								<td class="text-center"><?= $row['sub_id']; ?></td>
								<td><?= $row['sub_name']; ?></td>
								<td class="text-center"><?= $row['sub_credit']; ?></td>
								<td colspan="2" class="text-center">
									<a href="subjects.php?edit=<?= $row['sub_id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
									<a href="controller/subjectDelete.php?id=<?= $row['sub_id']; ?>" onclick="return confirm('คุณแน่ใจใช่หรือไม่? ที่จะลบ <?= $row['sub_name']; ?> ออก')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
								</td>
							</tr>
							<?php } ?>
						<?php } ?>
						</tbody>
					</table>
					<!-- <ul class="pagination justify-content-center">
						<li class="page-item disabled">
							<a class="page-link" href="" tabindex="-1" aria-disabled="true">Previous</a>
						</li>
						<li class="page-item <?= $active; ?>"><a class="page-link" href="subjects.php?pageno=1">1</a></li>
						<li class="page-item" aria-current="page">
							<a class="page-link" href="#">2</a>
						</li>
						<li class="page-item"><a class="page-link" href="#">3</a></li>
						<li class="page-item">
							<a class="page-link" href="#">Next</a>
						</li>
					</ul> -->
				</div>
			</div>
	<?php include('includes/sidebarContentBottom.inc.php'); ?>
	<?php include('includes/footer.inc.php'); ?>
</body>
</html>