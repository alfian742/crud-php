<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if (file_exists("$page.php")) {
        include "$page.php";
    } else {
        echo "<h3>Halaman tidak ditemukan.</h3>";
    }
} else {
    include "home.php";
}
