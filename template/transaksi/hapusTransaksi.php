<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_ksp");
mysqli_query(
    $koneksi,
    "DELETE FROM transaksi WHERE transaksi_id='" . $_GET['id'] . "'"
);
header("location:page.php?mod=transaksi");
