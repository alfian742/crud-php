<?php
session_start();

session_destroy(); // Mengakhiri sesi

header("Location: index.php"); // Arahkan ke file index.php
