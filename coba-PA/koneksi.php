<?php

$dbname = 'test_ta';
$dbuser = 'root';  
$dbpass = ''; 
$dbhost = 'localhost'; 

$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(!$connect){
	echo "Error: " . mysqli_connect_error();
	exit();
}

//echo "Connection Success!<br><br>";

$Voltage = "";
$Current = "";
$Power = "";
$Energy = "";
$Frequency = "";
$powerf = "";
if (isset($_GET['Voltage']) && $_GET['Voltage'] != 0 && 
    isset($_GET['Current']) && $_GET['Current'] != 0 && 
	isset($_GET['Power']) && $_GET['Power'] != 0 && 
	isset($_GET['Energy']) && $_GET['Energy'] != 0 && 
    isset($_GET['Frequency']) && $_GET['Frequency'] != 0 && 
	isset($_GET['powerf']) && $_GET['powerf'] != 0) {

	$Voltage = $_GET["Voltage"];
	$Current = $_GET["Current"]; 
	$Power = $_GET["Power"]; 
	$Energy = $_GET["Energy"];
	$Frequency = $_GET["Frequency"]; 
	$powerf = $_GET["powerf"]; 
	$query = "INSERT INTO datapzem (voltage, current, power, energy, frequency, powerf)
			VALUES ('$Voltage', '$Current','$Power','$Energy', '$Frequency','$powerf') ";
	$result = mysqli_query($connect, $query);
}
?>
