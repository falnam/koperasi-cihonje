<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/general.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/query.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/helper.css?v=<?php echo time(); ?>">
</head>

<?php

$id_user = rand(1, 999999999);

// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lakukan operasi penyimpanan data ke database
    require_once('config/koneksi.php');

    // Query untuk menyimpan data pengguna baru ke tabel pengguna
    $query = "INSERT INTO user (user_id, role_id, nama_lengkap, no_hp, email, password, alamat)
VALUES ($id_user, '$_POST[role]', '$_POST[nama_lengkap]', '$_POST[no_hp]', '$_POST[email]', '$_POST[password]', '$_POST[alamat]')";

    if ($koneksi->query($query) === TRUE) {
        header('location:page.php?mod=login');
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }
    // Tutup koneksi database
    $koneksi->close();
}
?>

<body>
    <section class="login">

        <div class="box box-color">
            <div class="logo-box">
                <h1 class="primary-heading">KSP PRIMKOPPABRI KUSUMA BANGSA</h1>
                <p class="sub-heading">Koprasi Simpan Pinjam</p>
                <div>
                    <a href="login" class="btn">Login</a>
                </div>
            </div>
        </div>

        <div class="box">
            <div class="registrasi-box">
                <div>
                    <p class="hallo">Hallo!</p>
                    <p class="cta">Daftar untuk memulai!</p>
                </div>
                <form action="" method="POST">
                    <div class="form-input">
                        <div class="icon-placeholder">
                            <svg width="14" height="16" viewBox="0 0 36 38" fill="none"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path
                                    d="M9,9C9,13.962 13.038,18 18,18C22.962,18 27,13.962 27,9C27,4.038 22.962,0 18,0C13.038,0 9,4.038 9,9ZM34,38L36,38L36,36C36,28.282 29.718,22 22,22L14,22C6.28,22 0,28.282 0,36L0,38L34,38Z"
                                    fill="#333333" />
                            </svg>
                        </div>
                        <input type="text" placeholder="Full Name" name="nama_lengkap" required type="text">
                    </div>

                    <div class="form-input">
                        <div class="icon-placeholder">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="black"
                                    d="m19.23 15.26l-2.54-.29a1.99 1.99 0 0 0-1.64.57l-1.84 1.84a15.045 15.045 0 0 1-6.59-6.59l1.85-1.85c.43-.43.64-1.03.57-1.64l-.29-2.52a2.001 2.001 0 0 0-1.99-1.77H5.03c-1.13 0-2.07.94-2 2.07c.53 8.54 7.36 15.36 15.89 15.89c1.13.07 2.07-.87 2.07-2v-1.73c.01-1.01-.75-1.86-1.76-1.98" />
                            </svg>
                        </div>
                        <input type="text" placeholder="Nomer HP" name="no_hp" required type="text">
                    </div>

                    <div class="form-input">
                        <div class="icon-placeholder">
                            <svg width="24" height="12" viewBox="0 0 44 32" fill="none"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path
                                    d="M1,2.5L2.5,1L41.5,1L43,2.5L43,29.5L41.5,31L2.5,31L1,29.5L1,2.5ZM4,5.605L4,28L40,28L40,5.608L22.93,18.7L21.1,18.7L4,5.605ZM37.09,4L6.91,4L22,15.607L37.09,4Z"
                                    clip-rule="evenodd" fill-rule="evenodd" fill="#333" />
                            </svg>
                        </div>
                        <input type="email" placeholder="Email Address" name="email" required type="email">
                    </div>

                    <div class="form-input">
                        <div class="icon-placeholder">
                            <svg width="12" height="20" viewBox="0 0 32 40" fill="none"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path
                                    d="M32,20C32,17.794 30.206,16 28,16L26,16L26,10C26,4.486 21.514,0 16,0C10.486,0 6,4.486 6,10L6,16L4,16C1.794,16 0,17.794 0,20L0,36C0,38.206 1.794,40 4,40L28,40C30.206,40 32,38.206 32,36L32,20ZM10,10C10,6.692 12.692,4 16,4C19.308,4 22,6.692 22,10L22,16L10,16L10,10Z"
                                    fill="#333" />
                            </svg>
                        </div>
                        <input type="password" placeholder="Password" name="password" required type="password">
                    </div>

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

                    <div class="form-input">
                        <div class="icon-placeholder">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                                <path fill="black"
                                    d="M4 21q-.825 0-1.412-.587T2 19V8q0-.825.588-1.412T4 6h4V4q0-.825.588-1.412T10 2h4q.825 0 1.413.588T16 4v2h4q.825 0 1.413.588T22 8v11q0 .825-.587 1.413T20 21zm6-15h4V4h-4z" />
                            </svg>
                        </div>
                        <select name="role" required>
                            <option value="" disabled selected> Pilih Posisi Anda </option>
                            <option value="1"> Kasir </option>
                            <option value="2"> Pegawai </option>
                            <option value="3"> Pimpinan </option>
                        </select>
                    </div>
                    <button class="btn btn-login-registrasi" type="submit">Registrasi</button>
                </form>
            </div>

        </div>
    </section>
</body>

</html>