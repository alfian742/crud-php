<?php
error_reporting(0); //Menyembunyikan error

include 'koneksi.php'; //Import file koneksi

if (isset($_GET['nim']) && isset($_GET['kode_mk'])) {
    $nim = $_GET['nim'];
    $semester = $_GET['semester'];
    $kode_mk = $_GET['kode_mk'];

    // Total SKS lama
    $sqlSKSLama = "SELECT SUM(sks) AS sks_lama FROM tb_mk, tb_khs 
                    WHERE tb_mk.kode_mk=tb_khs.kode_mk
                    AND tb_khs.nim='$nim' 
                    AND tb_khs.semester='$semester'";
    $querySKSLama = mysqli_query($koneksi, $sqlSKSLama);
    $hasilSKSLama = mysqli_fetch_array($querySKSLama);

    // Total SKS baru
    $sqlSKSBaru = "SELECT sks AS sks_baru FROM tb_mk WHERE kode_mk='$kode_mk'";
    $querySKSBaru = mysqli_query($koneksi, $sqlSKSBaru);
    $hasilSKSBaru = mysqli_fetch_array($querySKSBaru);

    // Hitung total SKS
    $totalSKS = $hasilSKSLama['sks_lama'] + $hasilSKSBaru['sks_baru'];

    if ($totalSKS > 24) {
        echo "<script>
                alert('Maaf, mata kuliah tidak dapat ditambahkan ke KRS karena melebihi 24 SKS!');
                document.location='beranda.php?page=krstambah&&nim=$nim';
            </script>";
    } else {
        $sql = "INSERT INTO tb_khs VALUES ('NULL', '$nim', '$kode_mk', '$semester', '')";
        $query = mysqli_query($koneksi, $sql);

        if ($query) {
            echo "<script>
                    alert('Mata kuliah berhasil ditambahkan ke KRS!');
                    document.location='beranda.php?page=krstambah&&nim=$nim';
                </script>";
        } else {
            echo "<script>
                    alert('Mata kuliah gagal ditambahkan ke KRS!');
                    document.location='beranda.php?page=krstambah&&nim=$nim';
                </script>";
        }
    }
}
