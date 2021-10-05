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
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ระบบส่งข้อสอบในสาขา</title>
	<!-- CSS -->
	<?php include('includes/css.inc.php'); ?>
	<!-- JS -->
	<?php include('includes/js.inc.php'); ?>

	<style>
		button.nav-link {
			color: black;
		}
		
		button.active {
			background: #f271cf !important;
		}
	</style>

</head>
<body>

<!-- Navbar -->
<?php include('includes/navbar.inc.php'); ?>

<!-- Content body -->
<br>
<!-- FORM  -->
	<div class="container">
		<h1 class="text-center">ส่งข้อสอบ</h1>
		<?php if($position == "หัวหน้าโปรแกรมวิชา") { ?>
		<div class="text-right">
			<a href="check_exam.php" class="btn btn-is">ตรวจข้อสอบ</a>
		</div>
		<?php } ?>
		<hr>
		<!-- Grid  -->
		<form action="sent_exam.php" method="POST" enctype="multipart/form-data">
		
			<!-- Nav tabs -->
			<ul class="nav nav-tabs nav-pills nav-justified" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Upload Files</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">ข้อสอบเกี่ยวกับรายวิชาที่สอบ</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">ความต้องการอุปกรณ์ในการสอบ</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="other-tab" data-bs-toggle="tab" data-bs-target="#other" type="button" role="tab" aria-controls="other" aria-selected="false">รายละเอียดอื่นๆ</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">ยืนยันในการส่งข้อสอบ</button>
				</li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
					<br>
					<h3 class="text-center">อัพโหลดได้เฉพาะไฟล์ PDF เท่านั้น</h3>

					<div class="form">
						<div class="mb-3">
							<label for="formFile" class="form-label">อัพโหลดได้เฉพาะไฟล์ PDF เท่านั้น</label>
							<input class="form-control" name="file" type="file" id="formFile">
						</div>
					</div>
				</div>
				<div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<br>
					<h3 class="text-center">ข้อสอบเกี่ยวกับรายวิชาที่สอบ</h3>

					<div class="row">
						<div class="col-md-12">
							<div class="mb-3">
								<label class="form-label">กรุณาเลือกรายชื่อวิชา</label>
								<select name="sub_id" class="form-select">
									<option selected disabled>-- กรุณาเลือกรายวิชา --</option>
									<?php 
										$sub_id_sql = "SELECT sub_id, sub_name FROM subjects";
										$sub_id_query = mysqli_query($conn, $sub_id_sql);
										while($sub_id_row = mysqli_fetch_assoc($sub_id_query)) {
									?>
									<option value="<?= $sub_id_row['sub_id']; ?>" ><?= $sub_id_row['sub_name']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label class="form-label">กรุณาเลือกภาคการศึกษา</label>
								<select name="sent_term" class="form-select">
									<option selected disabled>-- กรุณาเลือกภาคการศึกษา -- </option>
									<option value="2564">2564</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label class="form-label">กรุณาเลือกปีการศึกษา</label>
								<select name="sent_year" class="form-select">
									<option selected disabled>-- กรุณาเลือกปีการศึกษา --</option>
									<option value="2564">2564</option>
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label class="form-label">กรุณาเลือกวันที่สอบ</label>
								<input type="date" name="sent_date_exam" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label class="form-label">กรุณาเลือกเวลาสอบ</label>
								<input type="text" name="sent_time_exam" class="form-control" placeholder="เช่น 14:00">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label class="form-label">จำนวนหน้าข้อสอบ</label>
								<input type="number" class="form-control" name="sent_num_page">
							</div>
						</div>

						<div class="col-md-6">
							<div class="options-sheet">
							<b>เลือกการจัดเย็บข้อสอบ</b>
							<br>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" name="sent_single_copy" value="1" id="flexCheckDefault">
								<label class="form-check-label" for="flexCheckDefault">
									หน้าเดียว
								</label>
							</div>
							<div class="mb-3">
								<label class="form-label">แผ่นที่</label>
								<input type="number" class="form-control" name="sent_single_copy_start" value="0">
							</div>
							<div class="mb-3">
								<label class="form-label">ถึง</label>
								<input type="number" class="form-control" name="sent_single_copy_end" value="0">
							</div>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" name="sent_duplex_copy" value="1" id="flexCheckChecked">
								<label class="form-check-label" for="flexCheckChecked">หน้าหลัง</label>
							</div>
							<div class="mb-3">
								<label class="form-label">แผ่นที่</label>
								<input type="number" class="form-control" name="sent_duplex_copy_start" value="0">
							</div>
							<div class="mb-3">
								<label class="form-label">ถึง</label>
								<input type="number" class="form-control" name="sent_duplex_copy_end" value="0">
							</div>
							<!-- <div class="form-check">
								<input class="form-check-input" name="sent_single_copy" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
								<label class="form-check-label" for="flexRadioDefault1">
									หน้าเดียว
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" name="sent_duplex_copy" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
								<label class="form-check-label" for="flexRadioDefault2">หน้าหลัง</label>
							</div> -->
						</div>

					</div>

						</div>
					</div>
				<div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
					<br>
					<h3 class="text-center">ความต้องการอุปกรณ์ในการสอบ</h3><br>
					<p>เรียน อาจารย์ผู้สอน
    ขอความอนุเคราห์กรอกข้อมูลให้ครบถ้วนเพื่อความสะดวกในการจัดทำข้อสอบ (สาเหตุต้องมีแบบฟอร์มเพิ่มเนื่องจาก แบบฟอร์ม PM ไม่สามารถใส่ข้อความเพิ่มเติมหรือแก้ไขข้อมูลอื่นใดได้)</p>
					
					<div class="options-sheet">
						<b>ความต้องการในอุปกรณ์</b>
						<br><br>
						<select id="selected" class="form-select">
							<option selected disabled>เลือกความต้องการ</option>
							<option value="1">ต้องการ</option>
							<option>ไม่ต้องการ</option>
						</select>
					</div><br>
					
					<div class="options-sheet" id="show-options">
						<b>เลือกประเภทกระดาษคำตอบ</b>
						<br>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="sent_answersheet_1" value="กากบาท" id="flexCheckDefault">
							<label class="form-check-label" for="flexCheckDefault">
								กากบาท
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="sent_answersheet_2" value="สมุดแบบเส้น" id="flexCheckDefault">
							<label class="form-check-label" for="flexCheckDefault">
								สมุดแบบเส้น
							</label>
						</div>		
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="sent_answersheet_3" value="แบบเขียน" id="flexCheckDefault">
							<label class="form-check-label" for="flexCheckDefault">
								แบบเขียน
							</label>
						</div>		
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="sent_answersheet_4" value="กระดาษกราฟ" id="flexCheckDefault">
							<label class="form-check-label" for="flexCheckDefault">
								กระดาษกราฟ
							</label>
						</div>		
					</div>
	
					
					<br>
					<div class="color-sheet" id="show-options-1">
						<b>เลือกสีกระดาษคำตอบ</b>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="sent_twopage_book" value="เขียว" id="flexCheckDefault">
							<label class="form-check-label" for="flexCheckDefault">
									สีเขียว ชุดละ 2 แผ่น
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="sent_fourpage_book" value="ฟ้า" id="flexCheckDefault">
							<label class="form-check-label" for="flexCheckDefault">
									สีฟ้า ชุดละ 4 แผ่น
							</label>
						</div>
						<hr>
					</div>

				</div>
				<div class="tab-pane" id="other" role="tabpanel" aria-labelledby="other-tab">
					<br>
					<h3 class="text-center">รายละเอียดอื่นๆ</h3>
					<div class="mb-3">
						<textarea name="sent_other" class="form-control" id="" cols="30" rows="10"></textarea>
					</div>
				</div>
				<div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">
					<input type="hidden" name="teacher_id" value="<?= $_SESSION['ids']; ?>">
					<input type="hidden" name="sent_checked" value="0">
					<br>
					<h3 class="text-center">ยืนยันในการส่งข้อสอบ</h3>
					<br>
					<div class="d-grid gap-2 mb-3">
						<input type="submit" class="btn btn-is btn-lg" onclick="return confirm('คุณแน่ใจใช่แล้วหรือไม่? ถ้ากดยืนยันไปแล้วจะไม่สามารถกลับมาแก้ไขได้อีก')" name="sent_exam" value="ส่งข้อสอบ">
					</div>
				</div>
			</div>
		<!-- <div class="row">
			<div class="col-md-4">
				<h5 class="text-center">UPLOAD FILES</h5>
				<hr>
				<div class="form">
				<div class="mb-3">
					<label for="formFile" class="form-label">อัพโหลดได้เฉพาะไฟล์ PDF เท่านั้น</label>
					<input class="form-control" type="file" id="formFile">
				</div>
				</div>
			</div>
			<div class="col-md-4">
				<h5 class="text-center">ข้อสอบเกี่ยวกับรายวิชาที่สอบ</h5>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="mb-3">
							<label class="form-label">กรุณาเลือกรหัสวิชา</label>
							<select name="sub_id" class="form-select">
								<option selected disabled>-- กรุณาเลือกรหัสวิชา --</option>
								<option value="" >รหัสวิชา</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="mb-3">
							<label class="form-label">กรุณาเลือกชื่อวิชา</label>
							<select name="sub_name" class="form-select">
								<option selected disabled>-- กรุณาเลือกชื่อวิชา --</option>
								<option value="" >ชื่อวิชา</option>
							</select>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-md-6">
						<div class="mb-3">
							<label class="form-label">กรุณาเลือกภาคการศึกษา</label>
							<select name="class_year" class="form-select">
								<option selected disabled>-- กรุณาเลือกภาคการศึกษา -- </option>
								<option value="" >2564</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="mb-3">
							<label class="form-label">กรุณาเลือกปีการศึกษา</label>
							<select name="class_year" class="form-select">
								<option selected disabled>-- กรุณาเลือกปีการศึกษา --</option>
								<option value="" >2564</option>
							</select>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="mb-3">
							<label class="form-label">กรุณาเลือกวันที่สอบ</label>
							<input type="date" name="date" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="mb-3">
							<label class="form-label">กรุณาเลือกเวลาสอบ</label>
							<input type="time" name="time" class="form-control">
						</div>
					</div>
				</div>

				<div class="mb-3">
					<label class="form-label">กรุณาเลือกสาขาวิชา</label>
					<select name="class_department" class="form-select">
						<option selected disabled>-- กรุณาเลือกสาขาวิชา --</option>
						<option value="" >เทคโนโลยีสารสนเทศ</option>
					</select>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label class="form-label">กรุณาเลือกชั้นปี</label>
						<select name="select_year" class="form-select">
							<option selected disabled>-- กรุณาเลือกชั้นปี --</option>
							<option value="" >2564</option>
						</select>
					</div>
					<div class="col-md-6">
						<label class="form-label">จำนวนนักศึกษา</label>
						<input type="number" class="form-control" value="0">
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="mb-3">
							<label class="form-label">จำนวนนักศึกษา</label>
							<input type="number" name="class_amount" class="form-control" value="0">
						</div>
					</div>
					<div class="col-md-6">
						<div class="mb-3">
							<label class="form-label">จำนวนข้อสอบ</label>
							<input type="number" name="test_amount" class="form-control" value="0">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="mb-3">
							<label class="form-label">จำนวนหน้าของข้อสอบ</label>
							<input type="number" name="test_page_amount" class="form-control" value="0">
						</div>
					</div>

					<div class="col-md-6">
						<div class="mb-3">
							<label class="form-label">เย็บข้อสอบ</label>
							<select name="yeb_test" class="form-select">
								<option selected disabled>-- กรุณาเลือกการเย็บข้อสอบ -- </option>
								<option value="" >หน้าเดียว</option>
								<option value="" >หน้าหลัง</option>
							</select>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="mb-3">
							<label class="form-label">จากหน้า</label>
							<input type="number" class="form-control" name="form_page" value="0" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="mb-3">
							<label class="form-label">ถึงหน้า</label>
							<input type="number" class="form-control" name="end_page" value="0" required>
						</div>
					</div>
				</div>
				

			</div>
			
			
			<div class="col-md-4">
				<h5 class="text-center">ความต้องการอุปกรณ์ในการสอบ</h5>
				<hr>

				<div class="d-grid gap-2">
					<a href="#" class="btn btn-is btn-sm">กระดาษคำตอบ</a>
				</div>				

				<div class="options-sheet">
					<br>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="กากบาท" id="flexCheckDefault">
						<label class="form-check-label" for="flexCheckDefault">
							กากบาท
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="สมุดแบบเส้น" id="flexCheckDefault">
						<label class="form-check-label" for="flexCheckDefault">
							สมุดแบบเส้น
						</label>
					</div>		
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="แบบเขียน" id="flexCheckDefault">
						<label class="form-check-label" for="flexCheckDefault">
							แบบเขียน
						</label>
					</div>		
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="กระดาษกราฟ" id="flexCheckDefault">
						<label class="form-check-label" for="flexCheckDefault">
							กระดาษกราฟ
						</label>
					</div>		
				</div>

				<hr>
				
				<div class="d-grid gap-2">
					<a href="#" class="btn btn-is btn-sm">สีกระดาษข้อสอบ</a>
				</div>
				<br>
				<div class="color-sheet">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="เขียว" id="flexCheckDefault">
						<label class="form-check-label" for="flexCheckDefault">
								เขียว
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="เขียว" id="flexCheckDefault">
						<label class="form-check-label" for="flexCheckDefault">
								ฟ้า
						</label>
					</div>
					<hr>
					<div class="mb-3">
						<div class="d-grid gap-2">
							<input type="submit" class="btn btn-is btn-lg" name="send_exam" value="ส่งข้อสอบ">
						</div>
					</div>
				</div>

			</div>
		</div> -->

	</div>



</form>

<br>
<br>

<!-- footer -->
<?php include('includes/footer.inc.php'); ?>
<script>
	$(document).ready(function() {
		$('#show-options').hide();
		$('#show-options-1').hide();
		$('#selected').change(function() {
			if($('#selected').val() == 1) {
				$('#show-options').show();
				$('#show-options-1').show();
			} else {
				$('#show-options').hide();
				$('#show-options-1').hide();
			}
		})
	})
</script>
</body>
</html>