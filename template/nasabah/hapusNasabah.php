<?php
// Mengaktifkan pelaporan kesalahan dan pengecualian MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$koneksi = mysqli_connect("localhost", "root", "", "db_ksp");

try {
    mysqli_query(
        $koneksi,
        "DELETE FROM nasabah WHERE nasabah_id='" . $_GET['id'] . "'"
    );
    header("location:page.php?mod=nasabah");
} catch (Exception $e) {
    header("location:page.php?mod=errorDeleteNasabah");
}
