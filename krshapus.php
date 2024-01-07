<?php
include 'koneksi.php';

if (isset($_GET['nim']) && isset($_GET['kode_mk'])) {
    $nim = $_GET['nim'];
    $semester = $_GET['semester'];
    $kode_mk = $_GET['kode_mk'];

    $sql = "DELETE FROM tb_khs WHERE nim='$nim' AND semester='$semester' AND kode_mk='$kode_mk'";
    $query = mysqli_query($koneksi, $sql);

    if ($query) {
        echo "<script>
                alert('Mata kuliah berhasil dihapus!')
                document.location='beranda.php?page=krsisi';
            </script>";
    }
} else {
    header('Location: beranda.php');
}
