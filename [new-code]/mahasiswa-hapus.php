<?php
include 'connection.php'; // Mengimpor file koneksi ke database

$nim = $_GET['nim']; // Mendapatkan NIM mahasiswa dari parameter URL

// Mengambil nama file foto mahasiswa berdasarkan NIM
$mahasiswa = mysqli_query($db, "SELECT foto FROM tb_mahasiswa WHERE nim = '$nim'");
$result = mysqli_fetch_array($mahasiswa);

// Menghapus data mahasiswa dari tabel berdasarkan NIM
$sql = "DELETE FROM tb_mahasiswa WHERE nim = '$nim'";
$query = mysqli_query($db, $sql);

// Memeriksa apakah penghapusan berhasil
if ($query) {
    // Jika foto tersedia, hapus file foto dari direktori 'img/'
    if ($result['foto']) {
        $foto = 'img/' . $result['foto'];

        // Memeriksa dan menghapus file foto jika ada
        if (file_exists($foto)) {
            unlink($foto);
        }
    }

    // Redirect ke halaman data mahasiswa setelah penghapusan berhasil
    header('Location: mahasiswa-data.php');
} else {
    // Redirect ke halaman data mahasiswa jika penghapusan gagal
    header('Location: mahasiswa-data.php');
}
