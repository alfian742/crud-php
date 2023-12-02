<?php
include 'koneksi.php'; // Import file koneksi

// Mengambil data sesuai dengan parameter
if (isset($_GET['nidn'])) {
    $nidn = $_GET['nidn'];

    // Sintaks SQL untuk hapus data
    $sql = "DELETE FROM tb_dosen WHERE nidn = '$nidn'";
    $query = mysqli_query($koneksi, $sql);

    if ($query) {
        header('Location: ?page=dsndata'); // Jika berhasil kembali ke tampil data
    } else {
        header('Location: ?page=dsndata'); // Jika gagal kembali ke tampil data
    }
} else {
    header('Location: ?page=dsndata'); // Jika tidak ada parameter kembali ke tampil data
}
