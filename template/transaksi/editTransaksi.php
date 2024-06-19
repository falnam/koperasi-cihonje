<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_ksp");
if (isset($_POST["submit"])) {
    $transaksi_id = $_POST['transaksi_id'];
    $jenis_transaksi_id = $_POST['jenis_transaksi_id'];
    $nasabah_id = $_POST['nasabah_id'];
    $nominal = $_POST['nominal'];

    $query = "UPDATE transaksi SET
						transaksi_id	='$transaksi_id',
						jenis_transaksi_id ='$jenis_transaksi_id',
                        nasabah_id ='$nasabah_id',
                        nominal ='$nominal'
						where transaksi_id ='$transaksi_id'
						";
    mysqli_query($koneksi, $query);

    header("location:page.php?mod=transaksi");
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
            <p class="add-nasabah-heading">Edit Data Nasabah</p>

            <?php
            $koneksi = mysqli_connect("localhost", "root", "", "db_ksp");
            // Menggunakan query sql agar menampilkan data produk dan join kedalam tabel user agar mendapatkan siapa pemilik produk
            $query = "SELECT * FROM transaksi WHERE transaksi_id='" . $_GET['id'] . "'";
            $datas = $koneksi->query($query);
            foreach ($datas as $data) :
            ?>

            <form action="" method="POST">
                <input type="hidden" name="transaksi_id" value="<?= $data['transaksi_id'] ?>">

                <!-- Jenis Transaksi -->
                <div class="form-input">
                    <div class="icon-placeholder">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                            <path fill="black"
                                d="M4 21q-.825 0-1.412-.587T2 19V8q0-.825.588-1.412T4 6h4V4q0-.825.588-1.412T10 2h4q.825 0 1.413.588T16 4v2h4q.825 0 1.413.588T22 8v11q0 .825-.587 1.413T20 21zm6-15h4V4h-4z" />
                        </svg>
                    </div>
                    <select name="jenis_transaksi_id" required>
                        <option value="" disabled selected> Pilih Jenis Transaksi </option>
                        <option value="1" <?php if ($data['jenis_transaksi_id'] == "1") echo "selected"; ?>> Pinjaman
                        </option>
                        <option value="2" <?php if ($data['jenis_transaksi_id'] == "2") echo "selected"; ?>> Angsuran
                        </option>
                        <option value="3" <?php if ($data['jenis_transaksi_id'] == "3") echo "selected"; ?>> Pengambilan
                        <option value="4" <?php if ($data['jenis_transaksi_id'] == "4") echo "selected"; ?>> Tabungan
                        </option>

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
                    <input type="number" placeholder="ID Nasabah" name="nasabah_id" required type="number"
                        value="<?= $data['nasabah_id'] ?>">
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
                    <input type="number" placeholder="Nominal" name="nominal" required type="number"
                        value="<?= $data['nominal'] ?>">
                </div>

                <button class="btn btn-login-registrasi" type="submit" name="submit">Edit Data</button>
            </form>
            <?php endforeach ?>
        </section>
    </main>
</body>

</html>