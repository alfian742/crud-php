<?php
include 'koneksi.php'; // Import file koneksi

// Mengambil data sesuai dengan parameter
if (isset($_GET['nidn'])) {
    $nidn = $_GET['nidn'];

    $dosen = mysqli_query($koneksi, "SELECT * FROM tb_dosen WHERE nidn='$nidn'");
    $hasil = mysqli_fetch_array($dosen);
    $email = $hasil['email'];

    // Sintaks SQL untuk hapus data tb_user
    $user = mysqli_query($koneksi, "DELETE FROM tb_user WHERE email='$email'");

    // Sintaks SQL untuk hapus data tb_dosen
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
