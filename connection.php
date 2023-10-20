<?php

$db = mysqli_connect("localhost", "root", "", "mahasiswa");

if (!$db) {
    die("Koneksi ke database gagal: " . mysqli_connect_error($db));
}
