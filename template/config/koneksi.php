<?php
// Koneksi Database
$koneksi = mysqli_connect("localhost", "root", "", "db_ksp");

if (mysqli_connect_errno()) {
    // Pesan Koneksi Database Gagal
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../../assets/css/general.css">
        <link rel="stylesheet" href="../../assets/css/style.css">
        <link rel="stylesheet" href="../../assets/css/helper.css">
    </head>
    <body>
        <div class="overlay"></div>
        <section class="error">
            <p class="error-heading">Warning Error!</p>
            <p class="error-message">' . mysqli_connect_error() . '</p>
            <button class="btn btn-error">Selanjutnya</button>
        </section>
    </body>
    </html>
    ';
}
