<?php 
error_reporting(0);
include('config/db.php');
if(isset($_POST['sent_exam'])) {

	$sent_term = $_POST['sent_term'];
	$sent_year = $_POST['sent_year'];
	$sent_time_exam = $_POST['sent_time_exam'];
	$sent_date_exam = $_POST['sent_date_exam'];
	$sent_answersheet = $_POST['sent_answersheet'];
	$sent_twopage_book = $_POST['sent_twopage_book'];
	$sent_fourpage_book = $_POST['sent_fourpage_book'];
	$sent_single_copy = $_POST['sent_single_copy'];
	$sent_single_copy_start = $_POST['sent_single_copy_start'];
	$sent_single_copy_end = $_POST['sent_single_copy_end'];
	$sent_duplex_copy = $_POST['sent_duplex_copy'];
	$sent_duplex_copy_start = $_POST['sent_duplex_copy_start'];
	$sent_duplex_copy_end = $_POST['sent_duplex_copy_end'];
	$sent_num_page = $_POST['sent_num_page'];
	$sent_checked = 0;
	$sent_other = $_POST['sent_other'];

	$teacher_id = $_POST['teacher_id'];
	$sub_id = $_POST['sub_id'];

	// Upload File 
	$dir = "assets/files/";
	$encode = md5("wanchaisaelim");
	$newnamefile = $encode . rand(10, 10000) . basename($_FILES['file']['name']);
	$fileUpload = $dir . basename($_FILES['file']['name']);
	$filenames = basename($_FILES['file']['name']);

	// Logic to upload pdf file only
	if($_FILES['file']['type'] != "application/pdf") {
		echo '<script>
		alert("อัพโหลดได้เฉพาะไฟล์นามสกุล PDF เท่านั้น");
		window.history.back();
		</script>';
	} else {
		if(move_uploaded_file($_FILES['file']['tmp_name'], $dir . $newnamefile)) {
			$sql = "INSERT INTO sent_exam (sent_term, sent_year, sent_time_exam, sent_date_exam, sent_answersheet, sent_twopage_book, sent_fourpage_book, sent_single_copy, sent_single_copy_start, sent_single_copy_end, sent_duplex_copy, sent_duplex_copy_start, sent_duplex_copy_end, sent_num_page, sent_checked, sent_other, sent_files, teacher_id, sub_id) VALUES ('".$sent_term."', '".$sent_year."', '".$sent_time_exam."', '".$sent_date_exam."', '".$sent_answersheet."', '".$sent_twopage_book."', '".$sent_fourpage_book."', '".$sent_single_copy."', '".$sent_single_copy_start."', '".$sent_single_copy_end."', '".$sent_duplex_copy."', '".$sent_duplex_copy_start."', '".$sent_duplex_copy_end."', '".$sent_num_page."', '".$sent_checked."', '".$sent_other."', '".$newnamefile."', '".$teacher_id."', '".$sub_id."')";
			$query = mysqli_query($conn, $sql);
			if($query) {
				echo '<script>
				alert("ส่งข้อสอบเสร็จสิ้น");
				window.location.href = "check_exam.php";
				</script>';
			} else {
				echo "Failed please re-check your database";
			}
		} else {
			echo "Failed please re check your code.";
		}
	}


}