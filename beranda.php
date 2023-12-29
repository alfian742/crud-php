<?php
session_start();
if (isset($_SESSION['email']) and isset($_SESSION['level'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SIAKAD</title>

        <!-- Bootstrap css -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    </head>

    <body>
        <div class="container">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary rounded-bottom-2 mb-4">
                <div class="container-fluid">
                    <a class="navbar-brand fw-medium" href="beranda.php">SIAKAD</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav me-auto">
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
                            <li class="nav-item">
                                <a class="nav-link active" href="logout.php">Logout</a>
                            </li>
                        </ul>
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
                            <a href="?page=krsisi" class="list-group-item list-group-item-action">Isi KRS</a>
                            <a href="#" class="list-group-item list-group-item-action">Lihat KHS</a>
                        <?php } elseif ($_SESSION['level'] == "Dosen") { ?>
                            <a href="#" class="list-group-item list-group-item-action">Cek KRS</a>
                            <a href="#" class="list-group-item list-group-item-action">Input Nilai</a>
                        <?php } elseif ($_SESSION['level'] == "Admin") { ?>
                            <a href="?page=admprofil" class="list-group-item list-group-item-action">Ubah Profil</a>
                            <a href="?page=mhsdata" class="list-group-item list-group-item-action">Data Mahasiswa</a>
                            <a href="?page=dsndata" class="list-group-item list-group-item-action">Data Dosen</a>
                            <a href="?page=mkdata" class="list-group-item list-group-item-action">Data Mata Kuliah</a>
                            <a href="#" class="list-group-item list-group-item-action">Pengaturan Website</a>
                        <?php } ?>
                    </div>
                    <!-- End of list menu -->
                </div>
                <div class="col-md-9 mb-4">
                    <?php include 'konten.php'; // Import konten di setiap halaman 
                    ?>
                </div>
            </div>
            <!-- End of list menu & content -->

            <!-- Footer -->
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center">
                            Copyright &copy; 2023 Universitas Teknologi Mataram
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of footer -->
        </div>

        <!-- Script -->
        <script src="assets/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
<?php
} else {
    echo '<div style="font-family: Arial, Helvetica, sans-serif; font-size: large; text-align: center; color: red; margin-top: 5rem;">
            <h5>Tidak dapat mengakses halaman ini, silahkan login terlebih dahulu. <a href="login.php">LOGIN</a></h5>
        </div>';
}
?>