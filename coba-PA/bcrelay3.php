<?php
    include "koneksi.php";

    $sql = mysqli_query($connect, "SELECT * FROM kunci");
    $data = mysqli_fetch_array($sql);
    $relay3 = $data['relay3'];
    echo $relay3;
?>