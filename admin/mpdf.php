<?php 
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
require_once('../config/db.php');
require_once("vendor/autoload.php"); 


// Call Fonts Thai Language
$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

// How to use
$mpdf = new \Mpdf\Mpdf([
	'fontDir' => array_merge($fontDirs, [
		__DIR__ . '/custom/font/directory',
	]),
	'mode' => 'utf-8',
	'format' => [190, 236],
	'orientation' => 'P',
	'fontdata' => $fontData + [
		'frutiger' => [
				'R' => 'THSarabun Bold.ttf',
				'I' => 'THSarabun Italic.ttf',
			]
		],
		'default_font' => 'frutiger'
]);



$content = "<h1 style='text-align: center;'>รายการรับข้อสอบ</h1>";

$sql = "SELECT * FROM take_exam";
$query = mysqli_query($conn, $sql);
if(mysqli_num_rows($query) == 0) {
	$content .= "<h2 align='center'>ไม่พบรายการรับข้อสอบ</h2>";
}
while($row = mysqli_fetch_assoc($query)) {
	$content .= "<table border='1' style='border-collapse: collapse;' width='100%'>";
	$content .= "<tr>";
	$content .= "<th>ลำดับข้อสอบ</th>";
	$content .= "<th>รหัสเจ้าหน้าที่</th>";
	$content .= "<th>เวลารับข้อสอบ</th>";
	$content .= "</td>";
	$content .= "<tr>";
	$content .= "<td style='text-align: center;'>".$row['sent_no']."</td>";
	$content .= "<td>".$row['officer_id']."</td>";
	$content .= "<td>".$row['take_date']."</td>";
	$content .= "</td>";
	$content .= "</table>";

}


$mpdf->WriteHTML($content);
$mpdf->Output();
?>