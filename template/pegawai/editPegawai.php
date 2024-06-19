<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_ksp");
if (isset($_POST["submit"])) {
    $user_id = $_POST['user_id'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $role_id = $_POST['role'];

    $query = "UPDATE user SET
						nama_lengkap	='$nama_lengkap',
						no_hp ='$no_hp',
                        alamat ='$alamat',
                        role_id ='$role_id'
						where user_id ='$user_id'
						";
    mysqli_query($koneksi, $query);

    header("location:page.php?mod=pegawai");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pegawai</title>

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/general.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/query.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/helper.css?v=<?php echo time(); ?>">
</head>

<body>
    <main class="modal">

        <section class="error modal-edit-data-pegawai">
            <p class="add-nasabah-heading">Edit Data Pegawai</p>

            <?php
            $koneksi = mysqli_connect("localhost", "root", "", "db_ksp");
            // Menggunakan query sql agar menampilkan data produk dan join kedalam tabel user agar mendapatkan siapa pemilik produk
            $query = "SELECT * FROM user WHERE user_id='" . $_GET['id'] . "'";
            $datas = $koneksi->query($query);
            foreach ($datas as $data) :
            ?>

            <form action="" method="POST">
                <input type="hidden" name="user_id" value="<?= $data['user_id'] ?>">
                <!-- Nama Lengkap -->
                <div class="form-input">
                    <div class="icon-placeholder">
                        <svg data-dismiss="modal" aria-label="Close" width="14" height="16" viewBox="0 0 36 38"
                            fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <path
                                d="M9,9C9,13.962 13.038,18 18,18C22.962,18 27,13.962 27,9C27,4.038 22.962,0 18,0C13.038,0 9,4.038 9,9ZM34,38L36,38L36,36C36,28.282 29.718,22 22,22L14,22C6.28,22 0,28.282 0,36L0,38L34,38Z"
                                fill="#333333" />
                        </svg>
                    </div>
                    <input type="text" placeholder="Full Name" name="nama_lengkap" required type="text"
                        value="<?= $data['nama_lengkap'] ?>">
                </div>

                <!-- Nomer Hp -->
                <div class="form-input">
                    <div class="icon-placeholder">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="black"
                                d="m19.23 15.26l-2.54-.29a1.99 1.99 0 0 0-1.64.57l-1.84 1.84a15.045 15.045 0 0 1-6.59-6.59l1.85-1.85c.43-.43.64-1.03.57-1.64l-.29-2.52a2.001 2.001 0 0 0-1.99-1.77H5.03c-1.13 0-2.07.94-2 2.07c.53 8.54 7.36 15.36 15.89 15.89c1.13.07 2.07-.87 2.07-2v-1.73c.01-1.01-.75-1.86-1.76-1.98" />
                        </svg>
                    </div>
                    <input type="text" placeholder="Nomer HP" name="no_hp" required type="text"
                        value="<?= $data['no_hp'] ?>">
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
                    <input type="text" placeholder="Alamat" name="alamat" required type="text"
                        value="<?= $data['alamat'] ?>">
                </div>

                <!-- Posisi -->
                <div class="form-input">
                    <div class="icon-placeholder">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                            <path fill="black"
                                d="M4 21q-.825 0-1.412-.587T2 19V8q0-.825.588-1.412T4 6h4V4q0-.825.588-1.412T10 2h4q.825 0 1.413.588T16 4v2h4q.825 0 1.413.588T22 8v11q0 .825-.587 1.413T20 21zm6-15h4V4h-4z" />
                        </svg>
                    </div>
                    <select name="role" required>
                        <option value="" disabled selected> Pilih Posisi Anda </option>
                        <option value="1" <?php if ($data['role_id'] == "1") echo "selected"; ?>> Kasir
                        </option>
                        <option value="2" <?php if ($data['role_id'] == "2") echo "selected"; ?>> Pegawai
                        </option>
                        <option value="3" <?php if ($data['role_id'] == "3") echo "selected"; ?>> Pimpinan
                        </option>
                    </select>
                </div>
                <button class="btn btn-login-registrasi" type="submit" name="submit">Edit Data</button>
            </form>
            <?php endforeach ?>
        </section>
    </main>
</body>

</html>