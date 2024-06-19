<?php

$id_nasabah = rand(1, 999999999);

// Koneksi Database
require_once('config/koneksi.php');

// Fungsionalitas Tambah data nasabah
if (isset($_POST["add-btn"])) {


    // Query untuk menyimpan data pengguna baru ke tabel pengguna
    $query = "INSERT INTO nasabah (nasabah_id, nama_nasabah, no_hp_nasabah, email_nasabah, alamat_nasabah)
VALUES ($id_nasabah, '$_POST[nama_lengkap]', '$_POST[no_hp]', '$_POST[email]', '$_POST[alamat]')";

    if ($koneksi->query($query) === TRUE) {
        header('location:page.php?mod=nasabah');
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }
}


// Fungsionalitas Seacrhing
if (isset($_POST["search-btn"])) {
    $cari = $_POST["search"];
    $query = "SELECT * FROM nasabah WHERE nama_nasabah LIKE '$cari%'";
    $datas = $koneksi->query($query);
} else {
    // Menggunakan query sql agar menampilkan data produk dan join kedalam tabel user agar mendapatkan siapa pemilik produk
    $query = "SELECT * FROM nasabah ORDER BY nama_nasabah ASC";
    $datas = $koneksi->query($query);
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nasabah</title>

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/general.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/query.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/helper.css?v=<?php echo time(); ?>">

    <!-- JAVASCRIPT -->
    <script defer src="assets/javascript/nasabah.js?v=<?php echo time(); ?>"></script>

</head>

<body>
    <div class="container">
        <!-- SIDEBAR -->
        <?php include 'sidebar.php'; ?>

        <!-- CONTENT -->
        <main class="content">
            <h3 class="fourth-heading mb-2rm">Nasabah</h3>

            <!-- NAVIGASI -->
            <nav class="navigation">
                <form action="" class="searching" method="POST">
                    <input type="text" class="search-input" placeholder="Search" autocomplete="off" name="search">
                    <button class="btn btn-search" name="search-btn" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                            <path fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0-14 0m18 11l-6-6" />
                        </svg>
                    </button>
                </form>

                <button class="btn-add-transaksi btn-add-nasabah" type="button">
                    <svg width="12" height="12" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <path
                            d="M23.5,9.375L15.625,9.375L15.625,1.5C15.625,0.57 14.805,-0.25 13.875,-0.25L12.125,-0.25C11.141,-0.25 10.375,0.57 10.375,1.5L10.375,9.375L2.5,9.375C1.516,9.375 0.75,10.195 0.75,11.125L0.75,12.875C0.75,13.859 1.516,14.625 2.5,14.625L10.375,14.625L10.375,22.5C10.375,23.484 11.141,24.25 12.125,24.25L13.875,24.25C14.805,24.25 15.625,23.484 15.625,22.5L15.625,14.625L23.5,14.625C24.43,14.625 25.25,13.859 25.25,12.875L25.25,11.125C25.25,10.195 24.43,9.375 23.5,9.375Z"
                            fill="#FFFFFF" />
                    </svg>
                    <span>Tambah Nasabah</span>
                </button>
            </nav>

            <!-- NASABAH -->
            <section class="nasabah-section">
                <p class="daftar-nasabah-heading">Daftar Nasabah</p>
                <hr class="mb-1rm">

                <div class="nasabah-list">
                    <?php
                    foreach ($datas as $data) :
                    ?>
                    <div class="nasabah">
                        <div class="left-box-nasabah">
                            <p class="nama-nasabah"><?= $data['nama_nasabah'] ?></p>
                            <p>No : <?= $data['nasabah_id'] ?></p>
                            <p><?= $data['alamat_nasabah'] ?></p>
                        </div>
                        <div class="right-box-nasabah">
                            <div>
                                <a href="?mod=editNasabah&id=<?php echo $data['nasabah_id']; ?>"
                                    class="btn-update-data btn-update-data-nasabah">
                                    <svg width="26" height="18" viewBox="0 0 44 36" fill="none"
                                        class="icon mr-1rm edit-btn" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <path
                                            d="M29.616,24.258C29.469,24.399 29.469,24.539 29.469,24.68L29.469,32.625L3.536,32.625L3.536,7.875L21.291,7.875C21.439,7.875 21.586,7.875 21.733,7.734L24.091,5.484C24.459,5.133 24.165,4.5 23.649,4.5L3.536,4.5C1.547,4.5 0,6.047 0,7.875L0,32.625C0,34.524 1.547,36 3.536,36L29.469,36C31.385,36 33.005,34.524 33.005,32.625L33.005,22.43C33.005,21.938 32.342,21.656 31.974,22.008L29.616,24.258ZM41.109,10.125C42.804,8.508 42.804,5.906 41.109,4.289L37.941,1.266C36.247,-0.352 33.521,-0.352 31.827,1.266L12.524,19.687L11.788,26.086C11.567,27.914 13.187,29.461 15.103,29.25L21.807,28.547L41.109,10.125ZM33.889,12.234L20.186,25.313L15.324,25.875L15.913,21.234L29.616,8.156L33.889,12.234ZM38.604,6.68C38.973,6.961 38.973,7.383 38.678,7.734L36.394,9.914L32.121,5.766L34.331,3.656C34.626,3.305 35.142,3.305 35.437,3.656L38.604,6.68Z"
                                            fill="#828894" />
                                    </svg>
                                </a>
                                <a href="?mod=hapusNasabah&id=<?php echo $data['nasabah_id']; ?>"
                                    class="btn-delete-data">
                                    <svg width="18" height="18" viewBox="0 0 34 36" fill="none" class="icon delete-btn"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <path
                                            d="M19.376,29.25L21.144,29.25C21.586,29.25 22.028,28.898 22.028,28.406L22.028,13.219C22.028,12.797 21.586,12.375 21.144,12.375L19.376,12.375C18.86,12.375 18.492,12.797 18.492,13.219L18.492,28.406C18.492,28.898 18.86,29.25 19.376,29.25ZM31.458,5.625L25.344,5.625L22.839,1.688C22.249,0.773 20.923,0 19.818,0L12.377,0C11.272,0 9.946,0.773 9.357,1.688L6.852,5.625L0.811,5.625C0.148,5.625 -0.368,6.188 -0.368,6.75L-0.368,7.875C-0.368,8.508 0.148,9 0.811,9L1.989,9L1.989,32.625C1.989,34.523 3.536,36 5.526,36L26.743,36C28.659,36 30.28,34.523 30.28,32.625L30.28,9L31.458,9C32.048,9 32.637,8.508 32.637,7.875L32.637,6.75C32.637,6.188 32.048,5.625 31.458,5.625ZM12.23,3.586C12.304,3.516 12.525,3.375 12.598,3.375L12.672,3.375L19.597,3.375C19.671,3.375 19.892,3.516 19.965,3.586L21.218,5.625L10.977,5.625L12.23,3.586ZM26.743,32.625L5.526,32.625L5.526,9L26.743,9L26.743,32.625ZM11.125,29.25L12.893,29.25C13.335,29.25 13.777,28.898 13.777,28.406L13.777,13.219C13.777,12.797 13.335,12.375 12.893,12.375L11.125,12.375C10.609,12.375 10.241,12.797 10.241,13.219L10.241,28.406C10.241,28.898 10.609,29.25 11.125,29.25Z"
                                            fill="#828894" />
                                    </svg>
                                </a>
                            </div>
                            <p>Phone no : <?= $data['no_hp_nasabah'] ?></p>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </section>
        </main>
    </div>

    <!-- FOOTER -->
    <?php include 'footer.php'; ?>

    <!-- MODAL TAMBAH DATA NASABAH -->
    <section class="error modal-tambah-data-nasabah hidden">
        <svg class="btn-close-nasabah btn-close" xmlns="http://www.w3.org/2000/svg" width="30" height="30"
            viewBox="0 0 24 24">
            <path fill="none" stroke="black" stroke-linecap=" round" stroke-linejoin="round" stroke-width="1.5"
                d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" />
        </svg>
        <p class="add-nasabah-heading">Tambah Nasabah</p>
        <form action="" method="POST">
            <!-- Nama Lengkap -->
            <div class="form-input">
                <div class="icon-placeholder">
                    <svg width="14" height="16" viewBox="0 0 36 38" fill="none" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <path
                            d="M9,9C9,13.962 13.038,18 18,18C22.962,18 27,13.962 27,9C27,4.038 22.962,0 18,0C13.038,0 9,4.038 9,9ZM34,38L36,38L36,36C36,28.282 29.718,22 22,22L14,22C6.28,22 0,28.282 0,36L0,38L34,38Z"
                            fill="#333333" />
                    </svg>
                </div>
                <input type="text" placeholder="Full Name" name="nama_lengkap" required type="text">
            </div>

            <!-- No HP -->
            <div class="form-input">
                <div class="icon-placeholder">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="black"
                            d="m19.23 15.26l-2.54-.29a1.99 1.99 0 0 0-1.64.57l-1.84 1.84a15.045 15.045 0 0 1-6.59-6.59l1.85-1.85c.43-.43.64-1.03.57-1.64l-.29-2.52a2.001 2.001 0 0 0-1.99-1.77H5.03c-1.13 0-2.07.94-2 2.07c.53 8.54 7.36 15.36 15.89 15.89c1.13.07 2.07-.87 2.07-2v-1.73c.01-1.01-.75-1.86-1.76-1.98" />
                    </svg>
                </div>
                <input type="text" placeholder="Nomer HP" name="no_hp" required type="text">
            </div>

            <!-- Email -->
            <div class="form-input">
                <div class="icon-placeholder">
                    <svg width="24" height="12" viewBox="0 0 44 32" fill="none" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <path
                            d="M1,2.5L2.5,1L41.5,1L43,2.5L43,29.5L41.5,31L2.5,31L1,29.5L1,2.5ZM4,5.605L4,28L40,28L40,5.608L22.93,18.7L21.1,18.7L4,5.605ZM37.09,4L6.91,4L22,15.607L37.09,4Z"
                            clip-rule="evenodd" fill-rule="evenodd" fill="#333" />
                    </svg>
                </div>
                <input type="email" placeholder="Email Address" name="email" required type="email">
            </div>

            <!-- Alamat -->
            <div class="form-input">
                <div class="icon-placeholder">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 24 24">
                        <path fill="black" fill-rule="evenodd"
                            d="M7 2a2 2 0 0 0-2 2v1a1 1 0 0 0 0 2v1a1 1 0 0 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zm3 8a3 3 0 1 1 6 0a3 3 0 0 1-6 0m-1 7a3 3 0 0 1 3-3h2a3 3 0 0 1 3 3a1 1 0 0 1-1 1h-6a1 1 0 0 1-1-1"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" placeholder="Alamat" name="alamat" required type="text">
            </div>

            <button class="btn btn-login-registrasi" type="submit" name="add-btn">Tambah Nasabah</button>
        </form>
    </section>
</body>

</html>