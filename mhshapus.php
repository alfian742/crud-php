<?php
include 'koneksi.php'; // Import file koneksi

// Mengambil data sesuai dengan parameter
if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];

    // Sintaks SQL untuk hapus data
    $sql = "DELETE FROM tb_mahasiswa WHERE nim = '$nim'";
    $query = mysqli_query($koneksi, $sql);

    if ($query) {
        header("Location: ?page=mhsdata"); // Jika berhasil kembali ke tampil data
    } else {
        header("Location: ?page=mhsdata"); // Jika gagal kembali ke tampil data
    }
} else {
    header("Location: ?page=mhsdata"); // Jika tidak ada parameter kembali ke tampil data
}
