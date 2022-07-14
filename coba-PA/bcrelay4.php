<?php
    include "koneksi.php";

    $sql = mysqli_query($connect, "SELECT * FROM kunci");
    $data = mysqli_fetch_array($sql);
    $relay4 = $data['relay4'];
    echo $relay4;
?>