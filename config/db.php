<?php 
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'exam';

$conn = mysqli_connect($host, $user, $pass, $dbname);
mysqli_set_charset($conn, 'utf8');
date_default_timezone_set('Asia/Bangkok');
if(!$conn) {
	echo "Connection error ";
}
?>