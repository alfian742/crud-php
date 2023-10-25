<?php

include 'connection.php';

$nim = $_GET['nim'];

$sql = "DELETE FROM tb_mahasiswa WHERE nim = '$nim'";

$query = mysqli_query($db, $sql);

if ($query) {
    echo "<script>
            alert('Data berhasil dihapus!');
            window.location.href = 'mhs-data.php';
        </script>";
} else {
    echo "<script>
            alert('Data gagal dihapus!');
            window.location.href = 'mhs-data.php';
        </script>";
}
