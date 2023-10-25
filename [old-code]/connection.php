<?php

$db = mysqli_connect("localhost", "root", "", "siakad");

if (!$db) {
    die('Koneksi ke database gagal: ' . mysqli_connect_error($db));
}
