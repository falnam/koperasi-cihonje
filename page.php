<?php

if ($_GET['mod'] == 'home') {
    include "template/landingpage.php";
} else if ($_GET['mod'] == 'beranda') {
    include "template/beranda.php";
} else if ($_GET['mod'] == 'transaksi') {
    include "template/transaksi.php";
} else if ($_GET['mod'] == 'nasabah') {
    include "template/nasabah.php";
} else if ($_GET['mod'] == 'pegawai') {
    include "template/pegawai.php";
} else if ($_GET['mod'] == 'registrasi') {
    include "template/registrasi.php";
} else if ($_GET['mod'] == 'login') {
    include "template/login.php";
} else if ($_GET['mod'] == 'logout') {
    include "template/landingpage.php";
} else if ($_GET['mod'] == 'editPegawai') {
    include "template/pegawai/editPegawai.php";
} else if ($_GET['mod'] == 'hapusPegawai') {
    include "template/pegawai/hapusPegawai.php";
} else if ($_GET['mod'] == 'editNasabah') {
    include "template/nasabah/editNasabah.php";
} else if ($_GET['mod'] == 'hapusNasabah') {
    include "template/nasabah/hapusNasabah.php";
} else if ($_GET['mod'] == 'editTransaksi') {
    include "template/transaksi/editTransaksi.php";
} else if ($_GET['mod'] == 'hapusTransaksi') {
    include "template/transaksi/hapusTransaksi.php";
} else if ($_GET['mod'] == 'errorTransaksi') {
    include "template/errorMessage/errorTransaksi.php";
} else if ($_GET['mod'] == 'errorDeleteNasabah') {
    include "template/errorMessage/errorDeleteNasabah.php";
}
