<?php
// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();



    // Lakukan operasi pengecekan login di database
    require_once('config/koneksi.php');

    // Query untuk memeriksa kecocokan email dan password di tabel pengguna
    $query = "SELECT * FROM user WHERE email = '$_POST[email]' AND password ='$_POST[password]'";
    $result = $koneksi->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];

        header("location:page.php?mod=beranda");

        exit();
    } else {
        header("location:page.php?mod=home");
    }
    // Tutup koneksi database
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/general.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/query.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/helper.css?v=<?php echo time(); ?>">
</head>

<body>
    <section class="login">
        <div class="box box-color">
            <div class="logo-box">
                <h1 class="primary-heading">KSP PRIMKOPPABRI KUSUMA BANGSA</h1>
                <p class="sub-heading">Koprasi Simpan Pinjam</p>
                <div>
                    <a class="btn" href="registrasi">Registrasi</a>
                </div>
            </div>
        </div>

        <div class="box">
            <div class="registrasi-box">
                <div>
                    <p class="hallo">Hallo!</p>
                    <p class="cta">Selamat Datang</p>
                </div>
                <form action="" method="POST">
                    <div class="form-input">
                        <div class="icon-placeholder">
                            <svg width="24" height="12" viewBox="0 0 44 32" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path d="M1,2.5L2.5,1L41.5,1L43,2.5L43,29.5L41.5,31L2.5,31L1,29.5L1,2.5ZM4,5.605L4,28L40,28L40,5.608L22.93,18.7L21.1,18.7L4,5.605ZM37.09,4L6.91,4L22,15.607L37.09,4Z" clip-rule="evenodd" fill-rule="evenodd" fill="#333" />
                            </svg>
                        </div>
                        <input type="email" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="form-input">
                        <div class="icon-placeholder">
                            <svg width="12" height="20" viewBox="0 0 32 40" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path d="M32,20C32,17.794 30.206,16 28,16L26,16L26,10C26,4.486 21.514,0 16,0C10.486,0 6,4.486 6,10L6,16L4,16C1.794,16 0,17.794 0,20L0,36C0,38.206 1.794,40 4,40L28,40C30.206,40 32,38.206 32,36L32,20ZM10,10C10,6.692 12.692,4 16,4C19.308,4 22,6.692 22,10L22,16L10,16L10,10Z" fill="#333" />
                            </svg>
                        </div>
                        <input type="password" placeholder="Password" name="password" required>
                    </div>
                    <button class="btn btn-login-registrasi" type="submit">Login</button>
                </form>
            </div>

        </div>
    </section>
</body>

</html>