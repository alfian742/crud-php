<?php include 'template/_header.php'; ?>

<div class="card">
    <div class="card-header text-bg-primary">
        DATA MAHASISWA
    </div>
    <div class="card-body">
        <div class="d-flex flex-row gap-2 align-items-center mb-4">
            <a href="mahasiswa-data.php" class="btn btn-sm btn-light"><i class="fa-solid fa-arrow-left"></i></a>
            <h5 class="card-title mt-2">Tambah Mahasiswa</h5>
        </div>

        <?php
        include 'connection.php'; // Mengimpor file koneksi ke database

        // Memeriksa apakah tombol "Simpan" telah ditekan
        if (isset($_POST['simpan'])) {
            // Mengambil data dari formulir
            $nim = htmlspecialchars($_POST['nim']);
            $nama = htmlspecialchars($_POST['nama']);
            $prodi = htmlspecialchars($_POST['prodi']);
            $semester = htmlspecialchars($_POST['semester']);
            $alamat = htmlspecialchars($_POST['alamat']);
            $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);

            // Mengambil informasi tentang file foto yang diunggah
            $namaFoto = $_FILES['foto']['name'];
            $tmp = $_FILES['foto']['tmp_name'];

            // Memeriksa apakah NIM sudah terdaftar sebelumnya
            $cekNIM = mysqli_query($db, "SELECT nim FROM tb_mahasiswa WHERE nim = '$nim'");
            if (mysqli_num_rows($cekNIM) > 0) {
                // Menampilkan pesan kesalahan jika NIM sudah terdaftar
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>NIM sudah terdaftar!</strong> Silahkan coba kembali.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            } else {
                // Mendapatkan ekstensi file foto dan membuat nama file acak untuk mencegah duplikasi
                $ekstensiFoto = pathinfo($namaFoto, PATHINFO_EXTENSION);
                $randomNamaFoto = uniqid() . '.' . $ekstensiFoto;

                // Memindahkan file foto ke direktori 'img/' jika berhasil diunggah
                if (move_uploaded_file($tmp, 'img/' . $randomNamaFoto)) {
                    $foto = $randomNamaFoto;
                };

                // Menyusun query untuk menyimpan data mahasiswa ke tabel tb_mahasiswa
                $sql = "INSERT INTO tb_mahasiswa VALUES ('$nim', '$nama', '$prodi', '$semester', '$alamat', '$jenis_kelamin', '$foto')";

                // Menjalankan query
                $query = mysqli_query($db, $sql);

                // Menampilkan pesan berhasil atau gagal sesuai dengan hasil query
                if ($query) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Data berhasil disimpan!</strong> Untuk melihat data silahkan klik <a href="mahasiswa-data.php">disini</a>.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                } else {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Data gagal disimpan!</strong> Silahkan coba kembali.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
            }
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row mb-3">
                <label for="nim" class="col-sm-4 col-form-label">Nomor Induk Mahasiswa</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nim" name="nim" autofocus required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="nama" class="col-sm-4 col-form-label">Nama Mahasiswa</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="prodi" class="col-sm-4 col-form-label">Program Studi</label>
                <div class="col-sm-8">
                    <select class="form-select" id="prodi" name="prodi">
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Teknologi Informasi">Teknologi Informasi</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="semester" class="col-sm-4 col-form-label">Semester</label>
                <div class="col-sm-8">
                    <select class="form-select" id="semester" name="semester">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                    </select>
                </div>
            </div>

            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-4 pt-0">Jenis Kelamin</legend>
                <div class="col-sm-8">
                    <div class="d-flex flex-row gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin1" value="L" checked>
                            <label class="form-check-label" for="jenis_kelamin1">
                                Laki-Laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kealmin2" value="P">
                            <label class="form-check-label" for="jenis_kealmin2">
                                Perempuan
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <div class="row mb-3">
                <label for="alamat" class="col-sm-4 col-form-label">Alamat Lengkap</label>
                <div class="col-sm-8">
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label for="foto" class="col-sm-4 col-form-label">Foto</label>
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="img/default.png" alt="<?= $result['nama']; ?>" class="object-fit-cover rounded-2 shadow-sm img-preview" width="100" height="100">
                        </div>
                        <div class="col-sm-9">
                            <input class="form-control" type="file" id="foto" name="foto" required onchange="previewImage()">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-warning">Batal</button>
        </form>
    </div>
</div>

<?php include 'template/_footer.php'; ?>