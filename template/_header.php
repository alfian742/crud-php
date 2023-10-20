<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD</title>

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">

    <!-- dataTables css -->
    <link rel="stylesheet" href="vendor/datatables/css/dataTables.bootstrap4.min.css">

    <!-- Fontawesome icons -->
    <link rel="stylesheet" href="vendor/fontawesome-free/css/all.min.css">
</head>

<body>
    <div class="container">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary rounded-bottom-2 mb-4">
            <div class="container-fluid">
                <a class="navbar-brand fw-medium" href="index.php">SIAKAD</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Akademik</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Pengumuman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Pembayaran</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End of navbar -->

        <!-- List menu & content -->
        <div class="row">
            <div class="col-md-2 mb-4">
                <!-- List menu -->
                <div class="list-group">
                    <a href="index.php" class="list-group-item list-group-item-action active">Beranda</a>
                    <a href="mahasiswa-data.php" class="list-group-item list-group-item-action">Data Mahasiswa</a>
                    <a href="#" class="list-group-item list-group-item-action">Data Dosen</a>
                    <a href="#" class="list-group-item list-group-item-action">Data Kelas</a>
                    <a href="#" class="list-group-item list-group-item-action">Data Mata Kuliah</a>
                </div>
                <!-- End of list menu -->
            </div>
            <div class="col-md-10 mb-4">
                <!-- Content -->