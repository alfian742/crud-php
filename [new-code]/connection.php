<?php
// Konfigurasi koneksi ke database
$server     = "localhost";    // Nama server database
$username   = "root";         // Nama pengguna database
$password   = "";             // Kata sandi database
$database   = "crud_siakad";  // Nama database

// Membuat koneksi ke database menggunakan mysqli
$db = mysqli_connect($server, $username, $password, $database);

// Memeriksa apakah koneksi berhasil
if (!$db) {
    // Jika koneksi gagal, tampilkan pesan error dan hentikan eksekusi script
    die('Koneksi ke database gagal: ' . mysqli_connect_error($db));
}
