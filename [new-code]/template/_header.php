<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD</title>

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">

    <!-- dataTables css -->
    <link rel="stylesheet" href="../vendor/datatables/css/dataTables.bootstrap4.min.css">

    <!-- Fontawesome icons -->
    <link rel="stylesheet" href="../vendor/fontawesome-free/css/all.min.css">

    <!-- Custom css -->
    <style>
        .img-detail {
            width: 180px;
            height: 180px;
            margin-top: 0.8rem;
        }

        .img-preview {
            width: 100px;
            height: 100px;
        }

        @media (max-width: 575px) {

            .img-detail,
            .img-preview {
                display: block;
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 1rem;
                width: 150px;
                height: 150px;
            }

            .element-center {
                display: flex;
                flex-direction: row;
                gap: 0.5rem;
                justify-content: center;
                align-items: center;
            }
        }

        @media (max-width: 991px) {
            .btn-block {
                width: 100%;
            }

            .img-detail {
                width: 120px;
                height: 120px;
                margin-top: 0.8rem;
            }
        }
    </style>
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
                    <ul class="navbar-nav text-center me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="beranda.php">Beranda</a>
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
                    <a href="logout.php" class="btn btn-sm btn-outline-light btn-block">Logout</a>
                </div>
            </div>
        </nav>
        <!-- End of navbar -->

        <!-- List menu & content -->
        <div class="row">
            <div class="col-md-3 mb-4">
                <!-- List menu -->
                <div class="list-group">
                    <a href="beranda.php" class="list-group-item list-group-item-action active">Beranda</a>
                    <?php if ($_SESSION['level'] == "Mahasiswa") { ?>
                        <a href="#" class="list-group-item list-group-item-action">Update Profile</a>
                        <a href="#" class="list-group-item list-group-item-action">Isi KRS</a>
                        <a href="#" class="list-group-item list-group-item-action">Jadwal Kuliah</a>
                        <a href="#" class="list-group-item list-group-item-action">Lihat KHS</a>
                        <a href="#" class="list-group-item list-group-item-action">Pembayaran</a>
                    <?php } elseif ($_SESSION['level'] == "Dosen") { ?>
                        <a href="#" class="list-group-item list-group-item-action">Update Profile</a>
                        <a href="#" class="list-group-item list-group-item-action">Cek KRS</a>
                        <a href="#" class="list-group-item list-group-item-action">Jadwal Mengajar</a>
                        <a href="#" class="list-group-item list-group-item-action">Input Nilai</a>
                    <?php } elseif ($_SESSION['level'] == "Admin") { ?>
                        <a href="mahasiswa-data.php" class="list-group-item list-group-item-action">Data Mahasiswa</a>
                        <a href="#" class="list-group-item list-group-item-action">Data Dosen</a>
                        <a href="#" class="list-group-item list-group-item-action">Reset Password</a>
                        <a href="#" class="list-group-item list-group-item-action">Pengaturan Website</a>
                    <?php } ?>
                </div>
                <!-- End of list menu -->
            </div>
            <div class="col-md-9 mb-4">
                <!-- Content -->