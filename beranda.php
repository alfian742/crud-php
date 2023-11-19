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
        <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
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
                        <a href="mhsdata.php" class="list-group-item list-group-item-action">Data Mahasiswa</a>
                        <a href="#" class="list-group-item list-group-item-action">Data Dosen</a>
                        <a href="#" class="list-group-item list-group-item-action">Data Kelas</a>
                        <a href="#" class="list-group-item list-group-item-action">Data Mata Kuliah</a>
                    </div>
                    <!-- End of list menu -->
                </div>
                <div class="col-md-9 mb-4">
                    <!-- Content -->
                    <div class="card">
                        <div class="card-header text-bg-primary fw-medium">
                            BERANDA
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Selamat Datang di Halaman Admin!</h5>
                            <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis ea esse maxime placeat reiciendis reprehenderit accusamus! Incidunt tempora consequuntur ratione laboriosam numquam ex nisi vel vero earum! Aperiam saepe placeat, unde facilis quidem, perferendis quis, voluptate excepturi quos sit beatae? Illum libero, dolores vitae amet ipsum ab sint aliquam exercitationem officia, delectus, suscipit placeat culpa quod deleniti accusantium dolorem reprehenderit cumque unde pariatur quaerat nam alias. Molestias, nobis. Ipsam natus pariatur ipsum dolorum voluptatum voluptas.</p>
                            <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis ea esse maxime placeat reiciendis reprehenderit accusamus! Incidunt tempora consequuntur ratione laboriosam numquam ex nisi vel vero earum! Aperiam saepe placeat, unde facilis quidem, perferendis quis, voluptate excepturi quos sit beatae? Illum libero, dolores vitae amet ipsum ab sint aliquam exercitationem officia, delectus, suscipit placeat culpa quod deleniti accusantium dolorem reprehenderit cumque unde pariatur quaerat nam alias. Molestias, nobis. Ipsam natus pariatur ipsum dolorum voluptatum voluptas.</p>
                            <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis ea esse maxime placeat reiciendis reprehenderit accusamus! Incidunt tempora consequuntur ratione laboriosam numquam ex nisi vel vero earum! Aperiam saepe placeat, unde facilis quidem, perferendis quis, voluptate excepturi quos sit beatae? Illum libero, dolores vitae amet ipsum ab sint aliquam exercitationem officia, delectus, suscipit placeat culpa quod deleniti accusantium dolorem reprehenderit cumque unde pariatur quaerat nam alias. Molestias, nobis. Ipsam natus pariatur ipsum dolorum voluptatum voluptas.</p>
                        </div>
                    </div>
                    <!-- End of content -->
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
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
<?php
} else {
    echo '<div style="font-family: Arial, Helvetica, sans-serif; font-size: large; text-align: center; color: red; margin-top: 5rem;">
            <h5>Tidak dapat mengakses halaman ini, silahkan login terlebih dahulu. <a href="login.php">LOGIN</a></h5>
        </div>';
}
?>