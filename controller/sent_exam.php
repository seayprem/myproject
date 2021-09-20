<?php 
include('../config/db.php');
if(isset($_POST['sent_exam'])) {
	$sent_no = $_POST['sent_no'];
	$sent_term = $_POST['sent_term'];
	$sent_year = $_POST['sent_time_exam'];
	$sent_date_exam = $_POST['sent_date_exam'];
	$sent_answersheet = $_POST['sent_answersheet'];
	$sent_twopage_book = $_POST['sent_twopage_book'];
	$sent_fourpage_book = $_POST['sent_fourpage_book'];
	$sent_single_copy = $_POST['sent_single_copy'];
	$sent_duplex_copy = $_POST['sent_duplex_copy'];
	$sent_num_page = $_POST['sent_num_page'];
	$teacher_id = $_POST['teacher_id'];
	$sub_id = $_POST['sub_id'];
}
?>