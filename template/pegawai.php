<?php
include 'config/koneksi.php';
if (isset($_POST["search-btn"])) {
    $cari = $_POST["search"];
    $query = "SELECT * FROM user LEFT JOIN role ON role.role_id = user.role_id WHERE nama_lengkap LIKE '$cari%'";
    $datas = $koneksi->query($query);
} else {
    $query = "SELECT * FROM user LEFT JOIN role ON role.role_id = user.role_id";
    $datas = $koneksi->query($query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pegawai</title>

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/general.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/query.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/helper.css?v=<?php echo time(); ?>">

    <!-- JAVASCRIPT -->
    <script defer src="assets/javascript/pegawai.js?v=<?php echo time(); ?>"></script>
</head>

<body>
    <div class="container">
        <!-- SIDEBAR -->
        <?php include 'sidebar.php'; ?>

        <!-- CONTENT -->
        <main class="content">
            <h3 class="fourth-heading mb-2rm">Pegawai</h3>

            <!-- NAVIGASI -->
            <nav class="navigation">
                <form action="" class="searching" method="POST">
                    <input type="text" class="search-input" placeholder="Search" autocomplete="off" name="search">
                    <button class="btn btn-search" name="search-btn" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                            <path fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0-14 0m18 11l-6-6" />
                        </svg>
                    </button>
                </form>
            </nav>

            <!-- NASABAH -->
            <section class="nasabah-section">
                <p class="daftar-nasabah-heading">Daftar Pegawai </p>
                <hr class="mb-1rm">

                <div class="nasabah-list">
                    <?php
                    foreach ($datas as $data) :
                    ?>
                        <div class="nasabah">
                            <div class="left-box-nasabah">
                                <p class="nama-nasabah"><?= $data['nama_lengkap'] ?></p>
                                <p>No Id: <?= $data['user_id'] ?></p>
                                <p><?= $data['alamat'] ?></p>
                            </div>
                            <div class="right-box-nasabah">
                                <div>
                                    <a href="?mod=editPegawai&id=<?php echo $data['user_id']; ?>" class="btn-update-data btn-update-data-nasabah">
                                        <svg width="26" height="18" viewBox="0 0 44 36" fill="none" class="icon mr-1rm edit-btn" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <path d="M29.616,24.258C29.469,24.399 29.469,24.539 29.469,24.68L29.469,32.625L3.536,32.625L3.536,7.875L21.291,7.875C21.439,7.875 21.586,7.875 21.733,7.734L24.091,5.484C24.459,5.133 24.165,4.5 23.649,4.5L3.536,4.5C1.547,4.5 0,6.047 0,7.875L0,32.625C0,34.524 1.547,36 3.536,36L29.469,36C31.385,36 33.005,34.524 33.005,32.625L33.005,22.43C33.005,21.938 32.342,21.656 31.974,22.008L29.616,24.258ZM41.109,10.125C42.804,8.508 42.804,5.906 41.109,4.289L37.941,1.266C36.247,-0.352 33.521,-0.352 31.827,1.266L12.524,19.687L11.788,26.086C11.567,27.914 13.187,29.461 15.103,29.25L21.807,28.547L41.109,10.125ZM33.889,12.234L20.186,25.313L15.324,25.875L15.913,21.234L29.616,8.156L33.889,12.234ZM38.604,6.68C38.973,6.961 38.973,7.383 38.678,7.734L36.394,9.914L32.121,5.766L34.331,3.656C34.626,3.305 35.142,3.305 35.437,3.656L38.604,6.68Z" fill="#828894" />
                                        </svg>
                                    </a>
                                    <a href="?mod=hapusPegawai&id=<?php echo $data['user_id']; ?>" class="btn-delete-data" type="button">
                                        <svg width="18" height="18" viewBox="0 0 34 36" fill="none" class="icon delete-btn" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <path d="M19.376,29.25L21.144,29.25C21.586,29.25 22.028,28.898 22.028,28.406L22.028,13.219C22.028,12.797 21.586,12.375 21.144,12.375L19.376,12.375C18.86,12.375 18.492,12.797 18.492,13.219L18.492,28.406C18.492,28.898 18.86,29.25 19.376,29.25ZM31.458,5.625L25.344,5.625L22.839,1.688C22.249,0.773 20.923,0 19.818,0L12.377,0C11.272,0 9.946,0.773 9.357,1.688L6.852,5.625L0.811,5.625C0.148,5.625 -0.368,6.188 -0.368,6.75L-0.368,7.875C-0.368,8.508 0.148,9 0.811,9L1.989,9L1.989,32.625C1.989,34.523 3.536,36 5.526,36L26.743,36C28.659,36 30.28,34.523 30.28,32.625L30.28,9L31.458,9C32.048,9 32.637,8.508 32.637,7.875L32.637,6.75C32.637,6.188 32.048,5.625 31.458,5.625ZM12.23,3.586C12.304,3.516 12.525,3.375 12.598,3.375L12.672,3.375L19.597,3.375C19.671,3.375 19.892,3.516 19.965,3.586L21.218,5.625L10.977,5.625L12.23,3.586ZM26.743,32.625L5.526,32.625L5.526,9L26.743,9L26.743,32.625ZM11.125,29.25L12.893,29.25C13.335,29.25 13.777,28.898 13.777,28.406L13.777,13.219C13.777,12.797 13.335,12.375 12.893,12.375L11.125,12.375C10.609,12.375 10.241,12.797 10.241,13.219L10.241,28.406C10.241,28.898 10.609,29.25 11.125,29.25Z" fill="#828894" />
                                        </svg>
                                    </a>
                                </div>
                                <p>Posisi : <?= $data['nama'] ?></p>
                                <p>Phone no : <?= $data['no_hp'] ?></p>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </section>
        </main>
    </div>

    <!-- FOOTER -->
    <?php include 'footer.php'; ?>


</body>

</body>

</html>