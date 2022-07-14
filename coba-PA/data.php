<?php
header('Content-Type: application/json');
session_start();
include('koneksi.php');

$sqlQuery = "SELECT `energy`, `time` FROM datapzem ORDER BY `id` DESC LIMIT 20";
$result = mysqli_query($connect,$sqlQuery);
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($connect);

echo json_encode($data);
?>