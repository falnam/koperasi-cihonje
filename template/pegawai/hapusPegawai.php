<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_ksp");
mysqli_query(
    $koneksi,
    "DELETE FROM user WHERE user_id='" . $_GET['id'] . "'"
);
header("location:page.php?mod=pegawai");
