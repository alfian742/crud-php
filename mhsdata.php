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
                            DATA MAHASISWA
                        </div>
                        <div class="card-body">
                            <h5 class="card-title mb-4">Tabel Data Mahasiswa</h5>
                            <a href="mhstambah.php" class="btn btn-primary mb-4">Tambah</a>

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="align-middle">
                                            <th>Foto</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Program Studi</th>
                                            <th>Semester</th>
                                            <th>L/P</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'koneksi.php'; // Import file koneksi

                                        // Mengambil semua data dari tabel 
                                        $mahasiswa = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa");

                                        // Melakukan perulangan untuk menampilkan semua data dari tabel
                                        while ($hasil = mysqli_fetch_array($mahasiswa)) {
                                        ?>
                                            <tr class="align-middle">
                                                <td>
                                                    <!-- Menggunakan tag img untuk menampilkan foto -->
                                                    <img src="img/<?php echo $hasil['foto']; ?>" width="75" height="75" class="rounded-2 shadow-sm object-fit-cover">
                                                </td>
                                                <td><?php echo $hasil['nim']; ?></td>
                                                <td><?php echo $hasil['nama']; ?></td>
                                                <td><?php echo $hasil['prodi']; ?></td>
                                                <td><?php echo $hasil['semester']; ?></td>
                                                <td><?php echo $hasil['jenis_kelamin']; ?></td>
                                                <td>
                                                    <!-- Mengubah dan menghapus data berdasarkan parameter -->
                                                    <a href="mhsubah.php?nim=<?php echo $hasil['nim']; ?>" class="btn btn-link">Ubah</a> |
                                                    <a href="mhshapus.php?nim=<?php echo $hasil['nim']; ?>" onclick="return confirm('Data akan dihapus?')" class="btn btn-link">Hapus</a>
                                                </td>
                                            </tr>
                                        <?php }; ?>
                                    </tbody>
                                </table>
                            </div>
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