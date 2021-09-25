<?php 
include('../config/db.php');
if(isset($_POST['sent_exam'])) {

	$sub_id = $_POST['sub_id'];
	$sent_term = $_POST['sent_term'];
	$sent_year = $_POST['sent_year'];
	$sent_date_exam = $_POST['sent_date_exam'];
	$sent_time_exam = $_POST['sent_time_exam'];
	$sent_num_page = $_POST['sent_num_page'];
	$sent_single_copy = $_POST['sent_single_copy'];
	$sent_single_copy_start = $_POST['sent_single_copy_start'];
	$sent_single_copy_end = $_POST['sent_single_copy_end'];
	$sent_duplex_copy = $_POST['sent_duplex_copy'];
	$sent_duplex_copy_start = $_POST['sent_duplex_copy_start'];
	$sent_duplex_copy_end = $_POST['sent_duplex_copy_end'];
	$sent_answersheet = $_POST['sent_answersheet'];
	$sent_twopage_book = $_POST['sent_twopage_book'];
	$sent_fourpage_book = $_POST['sent_fourpage_book'];
	$sent_other = $_POST['sent_other'];
	$teacher_id = $_POST['teacher_id'];
	$sent_checked = $_POST['sent_checked'];



	if($_FILES['file']['name'] != '') {
		$filename = $_FILES['file']['name'];

		$extension = pathinfo($filename, PATHINFO_EXTENSION);

		$valid_extensions = array("pdf");

		if(in_array($extension, $valid_extensions)) {
			$new_name = rand() . "." . $extension;
			$path = '../assets/files/' . $new_name;

			if(move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
				$sql = "INSERT INTO `sent_exam` (`sent_term`, `sent_year`, `sent_time_exam`, `sent_date_exam`, `sent_answersheet`, `sent_twopage_book`, `sent_fourpage_book`, `sent_single_copy`, `sent_duplex_copy`, `sent_num_page`, `sent_checked`, `sent_files`,`teacher_id`, `sub_id`)";
				$query = mysqli_query($conn, $sql);
				if($query) {
					echo '<script>alert("อัพโหลดข้อสอบเรียบร้อยแล้ว");window.location.href = "../../index.php";</script>';
				} else {
					echo '<script>alert("อัพโหลดข้อสอบล้มเหลวกรุณาติดต่ออีกครั้ง");window.location.href = "../../index.php";</script>';
				}
			}
		}
	}
}
?>