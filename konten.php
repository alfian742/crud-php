<?php
if (isset($_GET['page'])) {
	$page = $_GET['page'];
	if (file_exists("$page.php")) {
		include "$page.php";
	} else {
		echo '<div class="alert alert-warning" role="alert">
                <strong>Halaman tidak ditemukan!</strong>
            </div>';
	}
} else {
	include "home.php";
}
