<?php
include 'koneksi.php'; // Import file koneksi

// Mengambil data sesuai dengan parameter
if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];

    $mahasiswa = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa WHERE nim='$nim'");
    $hasil = mysqli_fetch_array($mahasiswa);
    $email = $hasil['email'];

    // Sintaks SQL untuk hapus data tb_user
    $user = mysqli_query($koneksi, "DELETE FROM tb_user WHERE email='$email'");

    // Sintaks SQL untuk hapus data
    $sql = "DELETE FROM tb_mahasiswa WHERE nim = '$nim'";
    $query = mysqli_query($koneksi, $sql);

    if ($query) {
        header('Location: ?page=mhsdata'); // Jika berhasil kembali ke tampil data
    } else {
        header('Location: ?page=mhsdata'); // Jika gagal kembali ke tampil data
    }
} else {
    header('Location: ?page=mhsdata'); // Jika tidak ada parameter kembali ke tampil data
}
