<?php
// Code Pak Multazam
// include 'connection.php';

// $nim = $_GET['nim'];

// if (isset($nim)) {
//     $sql = "DELETE FROM tb_mahasiswa WHERE nim = '$nim'";

//     $query = mysqli_query($db, $sql);

//     if ($query) {
//         header('location: mhs-data.php');
//     }
// } else {
//     header('location: mhs-data.php');
// }

include 'connection.php';

$nim = $_GET['nim'];

$mahasiswa = mysqli_query($db, "SELECT foto FROM tb_mahasiswa WHERE nim = '$nim'");
$result = mysqli_fetch_array($mahasiswa);

if (isset($nim)) {
    $sql = "DELETE FROM tb_mahasiswa WHERE nim = '$nim'";

    $query = mysqli_query($db, $sql);

    if ($query) {
        if ($result['foto']) {
            $foto = 'img/' . $result['foto'];

            if (file_exists($foto))
                unlink($foto);
        }
        header('location: mhs-data.php');
    }
} else {
    header('location: mhs-data.php');
}
