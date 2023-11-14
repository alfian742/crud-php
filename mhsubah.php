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
            <div class="col-md-3 mb-4">
                <!-- List menu -->
                <div class="list-group">
                    <a href="index.php" class="list-group-item list-group-item-action active">Beranda</a>
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
                        <h5 class="card-title mb-4">Ubah Data Mahasiswa</h5>

                        <?php
                        include 'koneksi.php'; // Import file koneksi

                        // Mengambil data sesuai dengan parameter
                        if (isset($_GET['nim'])) {
                            $nim = $_GET['nim'];
                            $mahasiswa = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa WHERE nim = '$nim'");
                            $hasil = mysqli_fetch_array($mahasiswa);
                        } else {
                            header('Location: mhsdata.php'); // Jika tidak sesuai dengan parameter kembali ke halaman tampil data
                        }

                        // Jika tombol simpan di klik eksekusi sintaks berikut
                        if (isset($_POST['simpan'])) {
                            // isi variable menyesuaiakan dengan name="..." yang ada pada form
                            $nama = $_POST['nama'];
                            $prodi = $_POST['prodi'];
                            $semester = $_POST['semester'];
                            $alamat = $_POST['alamat'];
                            $jenis_kelamin = $_POST['jenis_kelamin'];
                            $foto = $_FILES['foto']['name'];
                            $tmp = $_FILES['foto']['tmp_name'];

                            // Jika ada foto baru yang diunggah eksekusi sintaks berikut
                            if (strlen($foto) > 0) {
                                // Sintaks SQL untuk ubah data jika ada foto baru yang diunggah
                                $sql = "UPDATE tb_mahasiswa SET
                                        nama = '$nama',
                                        prodi = '$prodi',
                                        semester = '$semester',
                                        alamat = '$alamat',
                                        jenis_kelamin = '$jenis_kelamin',
                                        foto = '$foto'
                                        WHERE nim = '$nim'"; // $nim diambil dari parameter diatas
                                $query = mysqli_query($koneksi, $sql);

                                // Pindahkan foto kedalam folder img
                                move_uploaded_file($tmp, 'img/' . $foto);
                            } else {
                                // Sintaks SQL untuk ubah data tanpa unggah foto
                                $sql = "UPDATE tb_mahasiswa SET
                                         nama = '$nama',
                                        prodi = '$prodi',
                                        semester = '$semester',
                                        alamat = '$alamat',
                                        jenis_kelamin = '$jenis_kelamin'
                                        WHERE nim = '$nim'"; // $nim diambil dari parameter diatas
                                $query = mysqli_query($koneksi, $sql);
                            }

                            // Alerts atau pesan
                            if ($query) {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Data berhasil disimpan!</strong> Untuk melihat data silahkan klik <a href="mhsdata.php">disini</a>.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                            } else {
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Data gagal disimpan!</strong> Silahkan coba kembali.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                            }
                        }
                        ?>

                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <label for="nim" class="col-sm-4 col-form-label">Nomor Induk Mahasiswa</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nim" name="nim" disabled value="<?php echo $hasil['nim']; ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="nama" class="col-sm-4 col-form-label">Nama Mahasiswa</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $hasil['nama']; ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="prodi" class="col-sm-4 col-form-label">Program Studi</label>
                                <div class="col-sm-8">
                                    <select class="form-select" id="prodi" name="prodi">
                                        <option value="Teknik Informatika" <?php if ($hasil['prodi'] == "Teknik Informatika") {
                                                                                echo "selected";
                                                                            } ?>>Teknik Informatika</option>
                                        <option value="Sistem Informasi" <?php if ($hasil['prodi'] == "Sistem Informasi") {
                                                                                echo "selected";
                                                                            } ?>>Sistem Informasi</option>
                                        <option value="Teknologi Informasi" <?php if ($hasil['prodi'] == "Teknologi Informasi") {
                                                                                echo "selected";
                                                                            } ?>>Teknologi Informasi</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="semester" class="col-sm-4 col-form-label">Semester</label>
                                <div class="col-sm-8">
                                    <select class="form-select" id="semester" name="semester">
                                        <option value="1" <?php if ($hasil['semester'] == "1") {
                                                                echo "selected";
                                                            } ?>>1</option>
                                        <option value="2" <?php if ($hasil['semester'] == "2") {
                                                                echo "selected";
                                                            } ?>>2</option>
                                        <option value="3" <?php if ($hasil['semester'] == "3") {
                                                                echo "selected";
                                                            } ?>>3</option>
                                        <option value="4" <?php if ($hasil['semester'] == "4") {
                                                                echo "selected";
                                                            } ?>>4</option>
                                        <option value="5" <?php if ($hasil['semester'] == "5") {
                                                                echo "selected";
                                                            } ?>>5</option>
                                        <option value="6" <?php if ($hasil['semester'] == "6") {
                                                                echo "selected";
                                                            } ?>>6</option>
                                        <option value="7" <?php if ($hasil['semester'] == "7") {
                                                                echo "selected";
                                                            } ?>>7</option>
                                        <option value="8" <?php if ($hasil['semester'] == "8") {
                                                                echo "selected";
                                                            } ?>>8</option>
                                    </select>
                                </div>
                            </div>

                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-4 pt-0">Jenis Kelamin</legend>
                                <div class="col-sm-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin1" value="L" <?php if ($hasil['jenis_kelamin'] == "L") {
                                                                                                                                            echo "checked";
                                                                                                                                        } ?>>
                                        <label class="form-check-label" for="jenis_kelamin1">
                                            Laki-laki
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin2" value="P" <?php if ($hasil['jenis_kelamin'] == "P") {
                                                                                                                                            echo "checked";
                                                                                                                                        } ?>>
                                        <label class="form-check-label" for="jenis_kelamin2">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="row mb-3">
                                <label for="alamat" class="col-sm-4 col-form-label">Alamat Lengkap</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3"><?php echo $hasil['alamat'] ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="foto" class="col-sm-4 col-form-label">foto</label>
                                <div class="col-sm-8">
                                    <img src="img/<?php echo $hasil['foto']; ?>" width="75" height="75" class="rounded-2 shadow-sm object-fit-cover mb-2">
                                    <input class="form-control" type="file" id="foto" name="foto">
                                </div>
                            </div>

                            <input type="submit" name="simpan" value="SIMPAN" class="btn btn-primary">
                            <a href="mhsdata.php" class="btn btn-warning">BATAL</a>
                        </form>
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