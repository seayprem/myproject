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
		<h1>เจ้าหน้าที่</h1>
		<hr>

		<div class="text-right">
			<a href="officers.php?show=add" class="btn btn-is">เพิ่มข้อมูล</a>
		</div>

		<!-- Add -->
		<?php if(isset($_GET['show']) == "add") { ?>
		<form action="controller/officerAdd.php" method="POST">
			<div class="mb-3">
				<label class="form-label">รหัสประจำตัว</label>
				<input type="text" name="officer_id" class="form-control" placeholder="กรุณาป้อนรหัสประจำตัว" required>
				</div>
				<div class="mb-3">
					<label class="form-label">ชื่อผู้ใช้</label>
					<input type="text" name="officer_user" class="form-control" placeholder="กรุณาป้อนชื่อผู้ใช้" required>
				</div>
				<div class="mb-3">
					<label class="form-label">รหัสผ่าน</label>
					<input type="text" name="officer_pass" class="form-control" placeholder="กรุณาป้อนรหัสผ่าน" required>
				</div>
				<div class="mb-3">
					<label class="form-label">ชื่อจริง</label>
					<input type="text" name="officer_fname" class="form-control" placeholder="กรุณาป้อนชื่อจริง" required>
				</div>
				<div class="mb-3">
					<label class="form-label">นามสกุล</label>
					<input type="text" name="officer_lname" class="form-control" placeholder="กรุณาป้อนนามสกุล" required>
				</div>
				<div class="mb-3">
					<label class="form-label">เบอร์โทร</label>
					<input type="text" name="officer_tel" class="form-control" placeholder="กรุณาป้อนเบอร์โทร" required>
				</div>
				<div class="d-grid gap-2 mt-2">
					<input type="submit" name="add" class="btn btn-is" value="เพิ่มข้อมูล">
				</div>
				<div class="d-grid gap-2 mt-2">
					<a href="officers.php" class="btn btn-danger">ย้อนกลับ</a>
				</div>
				<br><br>
		</form>

		<?php } ?>

		<!-- edit -->
		<?php 
		if(isset($_GET['edit'])) {
			$edit_id = $_GET['edit'];
			$edit_sql = "SELECT * FROM officers WHERE officer_id = '".$edit_id."'";
			$edit_query = mysqli_query($conn, $edit_sql);
			$edit_row = mysqli_fetch_array($edit_query);

			if(isset($_POST['edit'])) {
				$officer_id = $_POST['officer_id'];
				$officer_user = $_POST['officer_user'];
				$officer_pass = $_POST['officer_pass'];
				$officer_fname = $_POST['officer_fname'];
				$officer_lname = $_POST['officer_lname'];
				$officer_tel = $_POST['officer_tel'];

				$update_sql = "UPDATE officers SET officer_id = '".$officer_id."', officer_user = '".$officer_user."', officer_pass = '".$officer_pass."', officer_fname = '".$officer_fname."', officer_lname = '".$officer_lname."', officer_tel = '".$officer_tel."' WHERE officer_id = '".$officer_id."'";
				$update_query = mysqli_query($conn, $update_sql);
				if($update_query) {
					echo '<script>alert("แก้ไขข้อมูลสำเร็จ"); window.location.href="officers.php"</script>';
				} else {
					echo '<script>alert("ล้มเหลว กรุณาลองใหม่อีกครั้ง"); window.location.href="officers.php"</script>';
				}
			}
		
		?>

		<form action="officers.php?edit=<?= $edit_row['officer_id']; ?>" method="POST">
			<div class="mb-3">
				<label class="form-label">รหัสประจำตัว</label>
				<input type="text" name="officer_id" class="form-control" placeholder="กรุณาป้อนรหัสประจำตัว" value="<?= $edit_row['officer_id']; ?>" required>
				</div>
				<div class="mb-3">
					<label class="form-label">ชื่อผู้ใช้</label>
					<input type="text" name="officer_user" class="form-control" placeholder="กรุณาป้อนชื่อผู้ใช้" value="<?= $edit_row['officer_user']; ?>" required>
				</div>
				<div class="mb-3">
					<label class="form-label">รหัสผ่าน</label>
					<input type="text" name="officer_pass" class="form-control" placeholder="กรุณาป้อนรหัสผ่าน" value="<?= $edit_row['officer_pass']; ?>" required>
				</div>
				<div class="mb-3">
					<label class="form-label">ชื่อจริง</label>
					<input type="text" name="officer_fname" class="form-control" placeholder="กรุณาป้อนชื่อจริง" value="<?= $edit_row['officer_fname']; ?>" required>
				</div>
				<div class="mb-3">
					<label class="form-label">นามสกุล</label>
					<input type="text" name="officer_lname" class="form-control" placeholder="กรุณาป้อนนามสกุล" value="<?= $edit_row['officer_lname']; ?>" required>
				</div>
				<div class="mb-3">
					<label class="form-label">เบอร์โทร</label>
					<input type="text" name="officer_tel" class="form-control" placeholder="กรุณาป้อนเบอร์โทร" value="<?= $edit_row['officer_tel']; ?>" required>
				</div>
				<div class="d-grid gap-2 mt-2">
					<input type="submit" name="edit" class="btn btn-is" value="แก้ไขข้อมูล">
				</div>
				<div class="d-grid gap-2 mt-2">
					<a href="officers.php" class="btn btn-danger">ย้อนกลับ</a>
				</div>
				<br><br>

		<?php } ?>

		<!-- info -->
		<?php 
		if(isset($_GET['info'])) {
			$info_id = $_GET['info'];
			$info_sql = "SELECT * FROM officers WHERE officer_id = '".$info_id."'";
			$info_query = mysqli_query($conn, $info_sql);
			$info_row = mysqli_fetch_array($info_query);
		
		?>
		<p>รหัสประจำตัว : <b><?= $info_row['officer_id']; ?></b></p>
		<p>ชื่อผู้ใช้ : <b><?= $info_row['officer_user']; ?></b></p>
		<p>รหัสผ่าน : <b><?= $info_row['officer_pass']; ?></b></p>
		<p>ชื่อจริง : <b><?= $info_row['officer_fname']; ?></b></p>
		<p>นามสกุล : <b><?= $info_row['officer_lname']; ?></b></p>
		<p>โทรศัพท์ : <b><?= $info_row['officer_tel']; ?></b></p>
		<br>
		<div class="d-grid gap-2 mt-2">
			<a href="officers.php" class="btn btn-danger">ย้อนกลับ</a>
		</div>
		<br>
		<?php } ?>

		<div class="row">
			<div class="col-md-12">
				<h5 class="text-center">ข้อมูลเจ้าหน้าที่</h5>

				<!-- Searching -->
				<form action="officers.php?search" method="GET">
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="search" placeholder="ค้นหาข้อมูล รหัสประจำตัว ชื่อ นามสกุล เบอร์โทร" aria-label="Recipient's username" aria-describedby="button-addon2" required>
						<button class="btn btn-outline-secondary" type="submit" id="button-addon2">ค้นหาข้อมูล</button>
						<a href="officers.php" class="btn btn-outline-secondary" id="button-addon2">รีเฟรชข้อมูล</a>
					</div>

				</form>
				<!-- Searching -->
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
							$count_sql = "SELECT COUNT(*) AS totalOfficers FROM officers";
							$count_query = mysqli_query($conn, $count_sql);
							$count_row = mysqli_fetch_assoc($count_query);
							if($count_row['totalOfficers'] == 0) {
								echo '<tr>
									<td class="text-center" colspan="5">ไม่พบข้อมูล</td>	
								</tr>';
							} else if(isset($_GET['search'])) {
									$search_id = $_GET['search'];
									$search_sql = "SELECT * FROM officers WHERE officer_id LIKE '%".$search_id."%' OR officer_fname LIKE '%".$search_id."%' OR officer_lname LIKE '%".$search_id."%' OR officer_tel LIKE '%".$search_id."%'";
									$search_query = mysqli_query($conn, $search_sql);
									if(mysqli_num_rows($search_query) == 0) {
										echo '<tr class="text-center"><td colspan="5">ไม่พบข้อมูลในการค้นหา</td></tr>';
									}
									while($search_row = mysqli_fetch_assoc($search_query)) {

									
								?>
							<tr class="text-center">
								<td><?= $search_row['officer_id']; ?></td>
								<td><?= $search_row['officer_fname']; ?></td>
								<td><?= $search_row['officer_lname']; ?></td>
								<td><?= $search_row['officer_tel']; ?></td>
								<td colspan="3">
									<a href="officers.php?info=<?= $search_row['officer_id']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-info-circle"></i></a>
									<a href="officers.php?edit=<?= $search_row['officer_id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
									<a href="controller/officerDelete.php?id=<?= $search_row['officer_id']; ?>" onclick="return confirm('คุณแน่ใจใช่หรือไม่? ที่จะลบ <?= $search_row['officer_fname'] . ' ' . $row['officer_lname']; ?> ออกจากระบบ')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
								</td>
							</tr>

								<?php 
								}
							} else {

							
							$sql = "SELECT * FROM officers";
							$query = mysqli_query($conn, $sql);
							while($row = mysqli_fetch_assoc($query)) {

							
							?>
							<tr class="text-center">
								<td><?= $row['officer_id']; ?></td>
								<td><?= $row['officer_fname']; ?></td>
								<td><?= $row['officer_lname']; ?></td>
								<td><?= $row['officer_tel']; ?></td>
								<td colspan="3">
									<a href="officers.php?info=<?= $row['officer_id']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-info-circle"></i></a>
									<a href="officers.php?edit=<?= $row['officer_id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
									<a href="controller/officerDelete.php?id=<?= $row['officer_id']; ?>" onclick="return confirm('คุณแน่ใจใช่หรือไม่? ที่จะลบ <?= $row['officer_fname'] . ' ' . $row['officer_lname']; ?> ออกจากระบบ')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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
	<?php include('includes/sidebarContentBottom.inc.php'); ?>
	<?php include('includes/footer.inc.php'); ?>
</body>
</html>