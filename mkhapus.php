<?php
include 'koneksi.php'; // Import file koneksi

// Mengambil data sesuai dengan parameter
if (isset($_GET['kode_mk'])) {
    $kode_mk = $_GET['kode_mk'];

    // Sintaks SQL untuk hapus data
    $sql = "DELETE FROM tb_mk WHERE kode_mk = '$kode_mk'";
    $query = mysqli_query($koneksi, $sql);

    if ($query) {
        header('Location: ?page=mkdata'); // Jika berhasil kembali ke tampil data
    } else {
        header('Location: ?page=mkdata'); // Jika gagal kembali ke tampil data
    }
} else {
    header('Location: ?page=mkdata'); // Jika tidak ada parameter kembali ke tampil data
}
