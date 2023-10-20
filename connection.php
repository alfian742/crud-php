<?php

$server      = "localhost";
$username    = "root";
$password    = "";
$database    = "siakad";

$db = mysqli_connect($server, $username, $password, $database);

if (!$db) {
    die("Koneksi ke database gagal: " . mysqli_connect_error($db));
}
