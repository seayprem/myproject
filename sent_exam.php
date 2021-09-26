<?php 
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
	// $sent_checked = $_POST['sent_checked']; // Not add to SQL because i will be set to 0
	$sent_other = $_POST['sent_other'];

	$teacher_id = $_POST['teacher_id'];
	$sub_id = $_POST['sub_id'];

	// Upload File 
	// $dir = "assets/files/";
	// $fileUpload = $dir . basename($_FILES['file']['name']);
	// $filenames = basename($_FILES['file']['name']);
	// if(move_uploaded_file($_FILES['file']['tmp_name'], $fileUpload)) {
	// 	echo "Successfully " . $filenames;
	// } else {
	// 	echo "Failed please re check your code.";
	// }

}