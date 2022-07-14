<?php
    include "koneksi.php";

    $sql = mysqli_query($connect, "SELECT * FROM kunci");
    $data = mysqli_fetch_array($sql);
    $relay2 = $data['relay2'];
    echo $relay2;
?>