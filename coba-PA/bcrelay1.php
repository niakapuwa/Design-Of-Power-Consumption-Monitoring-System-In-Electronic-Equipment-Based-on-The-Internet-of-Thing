<?php
    include "koneksi.php";

    $sql = mysqli_query($connect, "SELECT * FROM kunci");
    $data = mysqli_fetch_array($sql);
    $relay1 = $data['relay1'];
    echo $relay1;
?>