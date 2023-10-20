<?php
include 'connection.php';

$nim = $_GET['nim'];

$mahasiswa = mysqli_query($db, "SELECT foto FROM tb_mahasiswa WHERE nim = '$nim'");
$result = mysqli_fetch_array($mahasiswa);

$query = "DELETE FROM tb_mahasiswa WHERE nim = '$nim'";
$delete = mysqli_query($db, $query);

// Delete file
if ($delete) {
    if ($result['foto'] !== 'default.jpg') {
        $oldFoto = 'img/' . $result['foto'];
        if (file_exists($oldFoto)) {
            unlink($oldFoto);
        }
    }
    echo '<script>
        alert("Data berhasil dihapus");
        window.location.href = "mahasiswa-data.php";
    </script>';
} else {
    echo '<script>
        alert("Data gagal dihapus");
        window.location.href = "mahasiswa-data.php";
    </script>';
}
