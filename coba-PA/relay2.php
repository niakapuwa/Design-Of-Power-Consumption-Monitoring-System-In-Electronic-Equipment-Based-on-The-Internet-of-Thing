<?php
include "koneksi.php";

    $stat = $_GET['stat'];
    if($stat == "ON")
    {
        mysqli_query($connect, "UPDATE kunci SET relay2=1");
        echo "ON";
    }
    else {
        mysqli_query($connect, "UPDATE kunci SET relay2=0");
        echo "OFF";  
    }

?>