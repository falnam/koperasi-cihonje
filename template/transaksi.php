<?php
require_once('config/koneksi.php');

$id_transaksi = rand(1, 999999999);

// Mengaktifkan pelaporan kesalahan dan pengecualian MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// BTN ADD TRANSAKSI
if (isset($_POST["add-btn"])) {
    try {
        $query = "INSERT INTO transaksi (transaksi_id, jenis_transaksi_id, nasabah_id, nominal)
    VALUES ($id_transaksi, '$_POST[jenis_transaksi]', '$_POST[nasabah_id]', '$_POST[nominal_transaksi]')";
        if ($koneksi->query($query) === TRUE) {
            header('location:page.php?mod=transaksi');
            exit();
        } else {
            throw new Exception("Error: " . $query . "<br>" . $koneksi->error);
        }
    } catch (Exception $e) {
        header('location:page.php?mod=errorTransaksi');
        exit();
    }
}


// BTN SEARCH
if (isset($_POST["search-btn"])) {
    $cari = $_POST["search"];
    $query = "SELECT n.nama_nasabah, n.nasabah_id, j.nama AS nama_transaksi, t.nominal AS nominal_transaksi, t.tanggal, t.transaksi_id FROM nasabah n 
    JOIN transaksi t ON n.nasabah_id = t.nasabah_id JOIN jenis_transaksi j ON t.jenis_transaksi_id = j.jenis_transaksi_id WHERE n.nama_nasabah LIKE '$cari%' ORDER BY t.tanggal DESC";
    $transaksi = $koneksi->query($query);
} else if (isset($_POST["btn-day"])) {
    $query = "SELECT n.nama_nasabah, n.nasabah_id, j.nama AS nama_transaksi, t.nominal AS nominal_transaksi, t.tanggal, t.transaksi_id FROM nasabah n 
    JOIN transaksi t ON n.nasabah_id = t.nasabah_id JOIN jenis_transaksi j ON t.jenis_transaksi_id = j.jenis_transaksi_id WHERE DATE(tanggal) = CURDATE() ORDER BY t.tanggal DESC";
    $transaksi = $koneksi->query($query);
} else if (isset($_POST["btn-week"])) {
    $query = "SELECT n.nama_nasabah, n.nasabah_id, j.nama AS nama_transaksi, t.nominal AS nominal_transaksi, t.tanggal, t.transaksi_id FROM nasabah n 
    JOIN transaksi t ON n.nasabah_id = t.nasabah_id JOIN jenis_transaksi j ON t.jenis_transaksi_id = j.jenis_transaksi_id WHERE DATE(t.tanggal) >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK) ORDER BY t.tanggal DESC";
    $transaksi = $koneksi->query($query);
} else if (isset($_POST["btn-month"])) {
    $query = "SELECT n.nama_nasabah, n.nasabah_id, j.nama AS nama_transaksi, t.nominal AS nominal_transaksi, t.tanggal, t.transaksi_id FROM nasabah n 
    JOIN transaksi t ON n.nasabah_id = t.nasabah_id JOIN jenis_transaksi j ON t.jenis_transaksi_id = j.jenis_transaksi_id WHERE DATE(tanggal) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) 
 ORDER BY t.tanggal DESC";
    $transaksi = $koneksi->query($query);
} else {
    $query = "SELECT n.nama_nasabah, n.nasabah_id, j.nama AS nama_transaksi, t.nominal AS nominal_transaksi, t.tanggal, t.transaksi_id FROM nasabah n 
    JOIN transaksi t ON n.nasabah_id = t.nasabah_id JOIN jenis_transaksi j ON t.jenis_transaksi_id = j.jenis_transaksi_id ORDER BY t.tanggal DESC";
    $transaksi = $koneksi->query($query);
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/general.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/query.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/helper.css?v=<?php echo time(); ?>">

    <!-- JAVASCRIPT -->
    <script defer src="assets/javascript/transaksi.js?v=<?php echo time(); ?>"></script>
</head>

<body>
    <!-- CONTAINER -->
    <div class="container">
        <!-- SIDEBAR -->
        <?php include 'sidebar.php'; ?>

        <!-- CONTENT -->
        <main class="content">
            <h3 class="fourth-heading mb-2rm">Transaksi</h3>

            <!-- YEAR SUMMARY -->
            <section class="year-summary">
                <?php
                require_once('config/koneksi.php');
                $query = "SELECT SUM(nominal) AS pemasukan FROM transaksi WHERE jenis_transaksi_id IN (2,4) AND YEAR(tanggal) = YEAR(CURDATE()) AND MONTH(tanggal) = MONTH(CURDATE())";
                $result = $koneksi->query($query);
                if ($result->num_rows > 0) {
                    // Mengambil satu baris data hasil query
                    $data = $result->fetch_assoc();
                    // Mengakses nilai dari kolom pinjaman
                    $pemasukan = $data['pemasukan'] ?? 0;
                }
                ?>
                <div class="card card-summary">
                    <div class="keterangan-waktu">
                        <div class="svg-container">
                            <svg class="icon" width="18" height="18" viewBox="0 0 50 50" fill="none"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path
                                    d="M10.359,-0.059C10.759,-0.059 11.142,0.1 11.425,0.382C11.708,0.665 11.867,1.049 11.867,1.448L11.867,2.956L35.986,2.956L35.986,1.448C35.986,1.049 36.145,0.665 36.427,0.382C36.71,0.1 37.094,-0.059 37.493,-0.059C37.893,-0.059 38.277,0.1 38.559,0.382C38.842,0.665 39.001,1.049 39.001,1.448L39.001,2.956L42.016,2.956C43.615,2.956 45.149,3.591 46.279,4.722C47.41,5.853 48.046,7.386 48.046,8.986L48.046,42.149C48.046,43.749 47.41,45.282 46.279,46.413C45.149,47.544 43.615,48.179 42.016,48.179L5.837,48.179C4.238,48.179 2.704,47.544 1.573,46.413C0.442,45.282 -0.193,43.749 -0.193,42.149L-0.193,8.986C-0.193,7.386 0.442,5.853 1.573,4.722C2.704,3.591 4.238,2.956 5.837,2.956L8.852,2.956L8.852,1.448C8.852,1.049 9.011,0.665 9.293,0.382C9.576,0.1 9.959,-0.059 10.359,-0.059ZM5.837,5.971C5.037,5.971 4.27,6.288 3.705,6.854C3.14,7.419 2.822,8.186 2.822,8.986L2.822,12L45.031,12L45.031,8.986C45.031,8.186 44.713,7.419 44.148,6.854C43.582,6.288 42.815,5.971 42.016,5.971L5.837,5.971ZM45.031,15.015L2.822,15.015L2.822,42.149C2.822,42.949 3.14,43.716 3.705,44.281C4.27,44.847 5.037,45.164 5.837,45.164L42.016,45.164C42.815,45.164 43.582,44.847 44.148,44.281C44.713,43.716 45.031,42.949 45.031,42.149L45.031,15.015Z"
                                    fill="#212529" />
                                <path
                                    d="M26.941,22.553C26.941,22.153 27.1,21.769 27.383,21.487C27.666,21.204 28.049,21.045 28.449,21.045L45.031,21.045L45.031,27.075L28.449,27.075C28.049,27.075 27.666,26.916 27.383,26.633C27.1,26.351 26.941,25.967 26.941,25.567L26.941,22.553ZM20.911,31.597L20.911,34.612C20.911,35.012 20.753,35.395 20.47,35.678C20.187,35.961 19.804,36.12 19.404,36.12L2.822,36.12L2.822,30.09L19.404,30.09C19.804,30.09 20.187,30.249 20.47,30.531C20.753,30.814 20.911,31.197 20.911,31.597Z"
                                    fill="#212529" />
                            </svg>
                        </div>
                        <span>Pemasukan Bulanan</span>
                    </div>
                    <p class="nominal-year-summary blue-tag">Rp <?= number_format($pemasukan, 0, ",", ".") ?></p>
                </div>

                <div class="card card-summary">
                    <?php
                    require_once('config/koneksi.php');
                    $query = "SELECT SUM(nominal) AS pengeluaran FROM transaksi WHERE jenis_transaksi_id IN (1,3) AND YEAR(tanggal) = YEAR(CURDATE()) AND MONTH(tanggal) = MONTH(CURDATE())";
                    $result = $koneksi->query($query);
                    if ($result->num_rows > 0) {
                        // Mengambil satu baris data hasil query
                        $data = $result->fetch_assoc();
                        // Mengakses nilai dari kolom pinjaman
                        $pengeluaran = $data['pengeluaran'] ?? 0;
                    }
                    ?>
                    <div class="keterangan-waktu">
                        <div class="svg-container">
                            <svg class="icon" width="20" height="18" viewBox="0 0 50 38" fill="none"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path
                                    d="M45.347,36.777C45.347,36.777 48.362,36.777 48.362,33.762C48.362,30.747 45.347,21.702 33.288,21.702C21.228,21.702 18.213,30.747 18.213,33.762C18.213,36.777 21.228,36.777 21.228,36.777L45.347,36.777ZM21.294,33.762C21.272,33.759 21.25,33.755 21.228,33.75C21.231,32.954 21.732,30.645 23.519,28.564C25.184,26.614 28.108,24.717 33.288,24.717C38.464,24.717 41.389,26.617 43.056,28.564C44.844,30.645 45.341,32.957 45.347,33.75L45.323,33.756C45.309,33.758 45.295,33.76 45.281,33.762L21.294,33.762L21.294,33.762ZM33.288,15.673C34.887,15.673 36.421,15.037 37.551,13.907C38.682,12.776 39.317,11.242 39.317,9.643C39.317,8.044 38.682,6.51 37.551,5.379C36.421,4.248 34.887,3.613 33.288,3.613C31.688,3.613 30.155,4.248 29.024,5.379C27.893,6.51 27.258,8.044 27.258,9.643C27.258,11.242 27.893,12.776 29.024,13.907C30.155,15.037 31.688,15.673 33.288,15.673ZM42.332,9.643C42.332,10.831 42.098,12.007 41.644,13.104C41.189,14.202 40.523,15.199 39.683,16.038C38.843,16.878 37.846,17.545 36.749,17.999C35.652,18.454 34.475,18.688 33.288,18.688C32.1,18.688 30.924,18.454 29.826,17.999C28.729,17.545 27.732,16.878 26.892,16.038C26.052,15.199 25.386,14.202 24.931,13.104C24.477,12.007 24.243,10.831 24.243,9.643C24.243,7.244 25.196,4.944 26.892,3.247C28.588,1.551 30.889,0.598 33.288,0.598C35.686,0.598 37.987,1.551 39.683,3.247C41.379,4.944 42.332,7.244 42.332,9.643L42.332,9.643ZM21.035,22.547C19.829,22.167 18.586,21.917 17.327,21.802C16.619,21.735 15.909,21.701 15.198,21.702C3.139,21.702 0.124,30.747 0.124,33.762C0.124,35.773 1.128,36.777 3.139,36.777L15.849,36.777C15.403,35.836 15.18,34.804 15.198,33.762C15.198,30.717 16.335,27.606 18.484,25.007C19.217,24.12 20.07,23.291 21.035,22.547ZM14.957,24.717C13.173,27.398 12.209,30.542 12.183,33.762L3.139,33.762C3.139,32.978 3.633,30.657 5.43,28.564C7.073,26.647 9.928,24.778 14.957,24.72L14.957,24.717ZM4.646,11.15C4.646,8.752 5.599,6.451 7.295,4.755C8.991,3.059 11.292,2.106 13.691,2.106C16.09,2.106 18.39,3.059 20.086,4.755C21.783,6.451 22.736,8.752 22.736,11.15C22.736,13.549 21.783,15.85 20.086,17.546C18.39,19.242 16.09,20.195 13.691,20.195C11.292,20.195 8.991,19.242 7.295,17.546C5.599,15.85 4.646,13.549 4.646,11.15L4.646,11.15ZM13.691,5.121C12.092,5.121 10.558,5.756 9.427,6.887C8.296,8.017 7.661,9.551 7.661,11.15C7.661,12.75 8.296,14.283 9.427,15.414C10.558,16.545 12.092,17.18 13.691,17.18C15.29,17.18 16.824,16.545 17.955,15.414C19.085,14.283 19.721,12.75 19.721,11.15C19.721,9.551 19.085,8.017 17.955,6.887C16.824,5.756 15.29,5.121 13.691,5.121Z"
                                    fill="#212529" />
                            </svg>
                        </div>
                        <span>Pengeluaran Bulanan</span>
                    </div>
                    <p class="nominal-year-summary yellow-tag">Rp <?= number_format($pengeluaran, 0, ",", ".") ?></p>
                </div>
            </section>


            <!-- NAVIGASI -->
            <nav class="navigation">
                <!-- SEARCH -->
                <form action="" class="searching" method="POST">
                    <input type="text" class="search-input" placeholder="Search" autocomplete="off" name="search">
                    <button class="btn btn-search" name="search-btn" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                            <path fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0-14 0m18 11l-6-6" />
                        </svg>
                    </button>
                </form>

                <!-- BUTTON MOBILE NAVIGATION -->
                <div class="btn-mobile">
                    <button class="btn-mobile-nav">
                        <svg class="icon-btn-mobile-nav" name="btn-open" width="18" height="20" viewBox="0 0 30 32"
                            fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <path
                                d="M-0.626,1.373C-0.626,1.075 -0.507,0.789 -0.296,0.578C-0.085,0.367 0.201,0.248 0.499,0.248L27.499,0.248C27.798,0.248 28.084,0.367 28.295,0.578C28.506,0.789 28.624,1.075 28.624,1.373L28.624,5.873C28.624,6.151 28.522,6.418 28.336,6.625L18.499,17.555L18.499,28.373C18.499,28.609 18.425,28.839 18.287,29.031C18.148,29.222 17.954,29.365 17.73,29.44L10.98,31.69C10.811,31.746 10.631,31.762 10.455,31.735C10.278,31.708 10.111,31.639 9.967,31.535C9.822,31.431 9.704,31.294 9.623,31.136C9.542,30.977 9.499,30.802 9.499,30.623L9.499,17.555L-0.338,6.625C-0.523,6.418 -0.626,6.151 -0.626,5.873L-0.626,1.373ZM1.624,2.498L1.624,5.441L11.461,16.372C11.647,16.578 11.749,16.846 11.749,17.123L11.749,29.062L16.249,27.563L16.249,17.123C16.249,16.846 16.352,16.578 16.537,16.372L26.374,5.441L26.374,2.498L1.624,2.498Z"
                                fill="#212529" />
                        </svg>
                    </button>
                </div>

                <!-- BUTTON FILTER -->
                <div class="right-box-nav">
                    <svg class="icon-btn-mobile btn-close-mobile-nav" name="btn-close"
                        xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                        <path fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 12L7 7m5 5l5 5m-5-5l5-5m-5 5l-5 5" />
                    </svg>
                    <button class="btn-add-transaksi" type="button" data-toggle="modal"
                        data-target="#tambahTransaksiModal">
                        <div class="svg-container">
                            <svg class="icon" width="12" height="12" viewBox="0 0 26 26" fill="none"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path
                                    d="M23.5,9.375L15.625,9.375L15.625,1.5C15.625,0.57 14.805,-0.25 13.875,-0.25L12.125,-0.25C11.141,-0.25 10.375,0.57 10.375,1.5L10.375,9.375L2.5,9.375C1.516,9.375 0.75,10.195 0.75,11.125L0.75,12.875C0.75,13.859 1.516,14.625 2.5,14.625L10.375,14.625L10.375,22.5C10.375,23.484 11.141,24.25 12.125,24.25L13.875,24.25C14.805,24.25 15.625,23.484 15.625,22.5L15.625,14.625L23.5,14.625C24.43,14.625 25.25,13.859 25.25,12.875L25.25,11.125C25.25,10.195 24.43,9.375 23.5,9.375Z"
                                    fill="#FFFFFF" />
                            </svg>
                        </div>
                        <span>Tambah</span>
                    </button>
                    <form action="" method="POST">
                        <div class="btn-group">
                            <button name="btn-day"
                                class="btn-time <?php echo isset($_POST['btn-day']) ? 'btn-time-active' : ''; ?>"
                                type="submit">24 hours</button>
                            <button name="btn-week"
                                class="btn-time <?php echo isset($_POST['btn-week']) ? 'btn-time-active' : ''; ?>"
                                type="submit">7 days</button>
                            <button name="btn-month"
                                class="btn-time <?php echo isset($_POST['btn-month']) ? 'btn-time-active' : ''; ?>"
                                type="submit">30 days</button>
                        </div>
                    </form>
                </div>
            </nav>

            <!-- TABEL -->
            <section class="tabel-transaksi">
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Nominal</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody class="tbody">
                        <?php
                        foreach ($transaksi as $data) :
                        ?>
                        <tr>
                            <td class="row-container">
                                <p class="nama-tabel"><?= $data['nama_nasabah'] ?></p>
                                <p class="id"><?= $data['nasabah_id'] ?></p>
                            </td>
                            <td><?= $data['nama_transaksi'] ?></td>
                            <td class="row-container">
                                <p class="nominal-transaksi">
                                    Rp<?= number_format($data['nominal_transaksi'], 0, ',', '.')  ?>
                                </p>
                            </td>
                            <td><?= date('Y-m-d', strtotime($data['tanggal'])) ?></td>
                            <td class="crud-btn">
                                <p class="option-crud">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="3rem" height="3rem"
                                        viewBox="0 0 24 24">
                                        <path fill="black"
                                            d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0-4 0m0-6a2 2 0 1 0 4 0a2 2 0 0 0-4 0m0 12a2 2 0 1 0 4 0a2 2 0 0 0-4 0" />
                                    </svg>
                                </p>

                                <section class="crud hidden">
                                    <ul class="crud-list-items">
                                        <!-- Edit -->
                                        <li class="crud-list-item">
                                            <a href="?mod=editTransaksi&id=<?php echo $data['transaksi_id']; ?>">
                                                <svg width="18" height="18" viewBox="0 0 48 48" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <path
                                                        d="M8,40L6,40C6,41.105 6.895,42 8,42L8,40ZM16,40L16,42C16.53,42 17.039,41.79 17.414,41.415L16,40ZM37,19L38.414,20.415L38.414,20.415L37,19ZM38.657,15L40.657,15L38.657,15ZM29,11L27.586,9.586L27.586,9.586L29,11ZM8,32L6.586,30.586C6.211,30.961 6,31.47 6,32L8,32ZM8,42L16,42L16,38L8,38L8,42ZM17.414,41.415L38.414,20.415L35.586,17.586L14.586,38.586L17.414,41.415ZM38.414,20.415C39.85,18.979 40.657,17.031 40.657,15L36.657,15C36.657,15.97 36.272,16.9 35.586,17.586L38.414,20.415ZM40.657,15C40.657,12.97 39.85,11.022 38.414,9.586L35.586,12.415C36.272,13.1 36.657,14.031 36.657,15L40.657,15ZM38.414,9.586C36.978,8.15 35.031,7.344 33,7.344L33,11.344C33.97,11.344 34.9,11.729 35.586,12.415L38.414,9.586ZM33,7.344C30.969,7.344 29.022,8.15 27.586,9.586L30.414,12.415C31.1,11.729 32.03,11.344 33,11.344L33,7.344ZM27.586,9.586L6.586,30.586L9.414,33.415L30.414,12.415L27.586,9.586ZM6,32L6,40L10,40L10,32L6,32Z"
                                                        fill="#403A44" />
                                                    <path
                                                        d="M28.414,11.586C27.633,10.805 26.367,10.805 25.586,11.586C24.805,12.367 24.805,13.634 25.586,14.415L28.414,11.586ZM33.586,22.415C34.367,23.196 35.633,23.196 36.414,22.415C37.195,21.634 37.195,20.367 36.414,19.586L33.586,22.415ZM25.586,14.415L33.586,22.415L36.414,19.586L28.414,11.586L25.586,14.415Z"
                                                        fill="#403A44" />
                                                </svg>
                                                <span>Edit</span>
                                            </a>
                                        </li>
                                        <!-- Delete -->
                                        <li class="crud-list-item">
                                            <a href="?mod=hapusTransaksi&id=<?php echo $data['transaksi_id']; ?>">
                                                <svg width="18" height="18" viewBox="0 0 48 48" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <line x1="8" y1="12" x2="40" y2="12" stroke="#E75C29"
                                                        stroke-width="2" stroke-miterlimit="3.999327"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <line x1="18" y1="22" x2="18" y2="34" stroke="#E75C29"
                                                        stroke-width="2" stroke-miterlimit="3.999327"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <line x1="26" y1="22" x2="26" y2="34" stroke="#E75C29"
                                                        stroke-width="2" stroke-miterlimit="3.999327"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M11.993,13.834C11.901,12.734 10.935,11.916 9.834,12.007C8.733,12.099 7.915,13.066 8.007,14.167L11.993,13.834ZM12,38L14,38C14,37.945 13.998,37.89 13.993,37.834L12,38ZM36,38L34.007,37.834C34.002,37.89 34,37.945 34,38L36,38ZM39.993,14.167C40.085,13.066 39.267,12.099 38.166,12.007C37.065,11.916 36.099,12.734 36.007,13.834L39.993,14.167ZM8.007,14.167L10.007,38.166L13.993,37.834L11.993,13.834L8.007,14.167ZM10,38C10,39.592 10.632,41.118 11.757,42.243L14.586,39.415C14.211,39.04 14,38.531 14,38L10,38ZM11.757,42.243C12.883,43.368 14.409,44 16,44L16,40C15.47,40 14.961,39.79 14.586,39.415L11.757,42.243ZM16,44L32,44L32,40L16,40L16,44ZM32,44C33.591,44 35.117,43.368 36.243,42.243L33.414,39.415C33.039,39.79 32.53,40 32,40L32,44ZM36.243,42.243C37.368,41.118 38,39.592 38,38L34,38C34,38.531 33.789,39.04 33.414,39.415L36.243,42.243ZM37.993,38.166L39.993,14.167L36.007,13.834L34.007,37.834L37.993,38.166Z"
                                                        fill="#E75C29" />
                                                    <path
                                                        d="M16,14C16,15.105 16.895,16 18,16C19.105,16 20,15.105 20,14L16,14ZM20,6L20,4L20,6ZM28,6L28,4L28,6ZM28,14C28,15.105 28.895,16 30,16C31.105,16 32,15.105 32,14L28,14ZM20,14L20,8L16,8L16,14L20,14ZM20,8L20,8L17.172,5.172C16.421,5.922 16,6.94 16,8L20,8ZM20,8L20,8L20,4C18.939,4 17.922,4.422 17.172,5.172L20,8ZM20,8L28,8L28,4L20,4L20,8ZM28,8L28,8L30.828,5.172C30.078,4.422 29.061,4 28,4L28,8ZM28,8L28,8L32,8C32,6.94 31.579,5.922 30.828,5.172L28,8ZM28,8L28,14L32,14L32,8L28,8Z"
                                                        fill="#E75C29" />
                                                </svg>
                                                <span>Delete</span>
                                            </a>
                                        </li>
                                        <!-- Cancel -->
                                        <li class="crud-list-item">
                                            <a href="" class="cancel-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24">
                                                    <path fill="none" stroke="black" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M12 12L7 7m5 5l5 5m-5-5l5-5m-5 5l-5 5" />
                                                </svg>
                                                <span>Cancel</span>
                                            </a>
                                        </li>
                                    </ul>
                                </section>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    <!-- FOOTER -->
    <?php include 'footer.php'; ?>

    <!-- MODAL TAMBAH DATA TRANSAKSI -->
    <section class="error modal-tambah-data-transaksi hidden">
        <svg class="btn-close-transaksi btn-close" xmlns="http://www.w3.org/2000/svg" width="30" height="30"
            viewBox="0 0 24 24">
            <path fill="none" stroke="black" stroke-linecap=" round" stroke-linejoin="round" stroke-width="1.5"
                d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" />
        </svg>
        <p class="add-nasabah-heading">Tambah Transaksi</p>
        <form action="" method="POST">
            <!-- Jenis Transaksi -->
            <div class="form-input">
                <div class="icon-placeholder">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                        <path fill="black"
                            d="M4 21q-.825 0-1.412-.587T2 19V8q0-.825.588-1.412T4 6h4V4q0-.825.588-1.412T10 2h4q.825 0 1.413.588T16 4v2h4q.825 0 1.413.588T22 8v11q0 .825-.587 1.413T20 21zm6-15h4V4h-4z" />
                    </svg>
                </div>
                <select name="jenis_transaksi" required>
                    <option value="" disabled selected> Pilih Jenis Transaksi </option>
                    <option value="1"> Pinjaman </option>
                    <option value="2"> Angsuran </option>
                    <option value="3"> Pengambilan </option>
                    <option value="4"> Tabungan </option>
                </select>
            </div>

            <!-- Nasabah ID Input -->
            <div class="form-input">
                <div class="icon-placeholder">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="black"
                            d="m19.23 15.26l-2.54-.29a1.99 1.99 0 0 0-1.64.57l-1.84 1.84a15.045 15.045 0 0 1-6.59-6.59l1.85-1.85c.43-.43.64-1.03.57-1.64l-.29-2.52a2.001 2.001 0 0 0-1.99-1.77H5.03c-1.13 0-2.07.94-2 2.07c.53 8.54 7.36 15.36 15.89 15.89c1.13.07 2.07-.87 2.07-2v-1.73c.01-1.01-.75-1.86-1.76-1.98" />
                    </svg>
                </div>
                <input type="number" placeholder="ID Nasabah" name="nasabah_id" required type="number">
            </div>

            <!-- Nominal -->
            <div class="form-input">
                <div class="icon-placeholder">
                    <svg width="24" height="12" viewBox="0 0 44 32" fill="none" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <path
                            d="M1,2.5L2.5,1L41.5,1L43,2.5L43,29.5L41.5,31L2.5,31L1,29.5L1,2.5ZM4,5.605L4,28L40,28L40,5.608L22.93,18.7L21.1,18.7L4,5.605ZM37.09,4L6.91,4L22,15.607L37.09,4Z"
                            clip-rule="evenodd" fill-rule="evenodd" fill="#333" />
                    </svg>
                </div>
                <input type="number" placeholder="Nominal" name="nominal_transaksi" required type="number">
            </div>

            <button class="btn btn-login-registrasi" type="submit" name="add-btn">Tambah Transaksi</button>
        </form>
    </section>

</body>

</html>