<!-- Content -->
<div class="card">
    <div class="card-header text-bg-primary fw-medium">
        DATA DOSEN
    </div>
    <div class="card-body">
        <h5 class="card-title mb-4">Tambah Data Dosen</h5>

        <?php
        include 'koneksi.php'; // Import file koneksi

        // Jika tombol simpan di klik eksekusi sintaks berikut
        if (isset($_POST['simpan'])) {
            // isi variable menyesuaiakan dengan name="..." yang ada pada form
            $nidn = $_POST['nidn'];
            $nama_dosen = $_POST['nama_dosen'];
            $email = $_POST['email'];
            $password = md5('321');
            $pendidikan = $_POST['pendidikan'];
            $alamat = $_POST['alamat'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $foto = $_FILES['foto']['name'];
            $tmp = $_FILES['foto']['tmp_name'];
            $size = $_FILES['foto']['size'];
            $ekstensiFoto = pathinfo($foto, PATHINFO_EXTENSION);

            $cekNIDN = mysqli_query($koneksi, "SELECT nidn FROM tb_dosen where nidn='$nidn'");
            $cekEmail = mysqli_query($koneksi, "SELECT email FROM tb_dosen where email='$email'");

            if (mysqli_num_rows($cekNIDN) > 0) { // Cek NIDN
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>NIDN sudah ada!</strong> Silahkan coba kembali.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            } elseif (strlen($nidn) <> 10) { // Cek jumlah karakter NIDN
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>NIDN harus 10 karakter!</strong> Silahkan coba kembali.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            } elseif (mysqli_num_rows($cekEmail) > 0) { // Cek NIDN
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Email sudah ada!</strong> Silahkan coba kembali.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            } elseif (!in_array($ekstensiFoto, ['jpg', 'jpeg', 'png'])) { // Cek ekstensi foto
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Format tidak didukung!</strong> Silahkan unggah foto dengan tipe JPG/JPEG/PNG.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            } elseif ($size > 1000000) { // Cek ukuran foto
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Ukuran foto terlalu besar!</strong> Silahkan unggah foto maksimal 1MB.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            } else {
                // Sintaks SQL untuk tambah data
                $sql = "INSERT INTO tb_dosen VALUES ('$nidn', '$nama_dosen', '$email', '$pendidikan', '$alamat', '$jenis_kelamin', '$foto')";
                $query = mysqli_query($koneksi, $sql);

                // Pindahkan foto kedalam folder img
                move_uploaded_file($tmp, 'img/' . $foto);

                // Alerts atau pesan
                if ($query) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Data berhasil disimpan!</strong> Untuk melihat data silahkan klik <a href="?page=dsndata">disini</a>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                } else {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Data gagal disimpan!</strong> Silahkan coba kembali.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }

                $user = mysqli_query($koneksi, "INSERT INTO tb_user VALUES ('$email', '$password', 'Dosen', '$nama_dosen')");
            }
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row mb-3">
                <label for="nidn" class="col-sm-4 col-form-label">Nomor Induk Dosen Nasional <strong class="text-danger">*</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nidn" name="nidn" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="nama_dosen" class="col-sm-4 col-form-label">Nama Dosen <strong class="text-danger">*</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-sm-4 col-form-label">Email <strong class="text-danger">*</strong></label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="pendidikan" class="col-sm-4 col-form-label">Pendidikan</label>
                <div class="col-sm-8">
                    <select class="form-select" id="pendidikan" name="pendidikan">
                        <option value="S1 Teknik Informatika">S1 Teknik Informatika</option>
                        <option value="S2 Teknik Informatika">S2 Teknik Informatika</option>
                        <option value="S3 Teknik Informatika">S3 Teknik Informatika</option>
                        <option value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                        <option value="S2 Sistem Informasi">S2 Sistem Informasi</option>
                        <option value="S3 Sistem Informasi">S3 Sistem Informasi</option>
                        <option value="S1 Teknologi Informasi">S1 Teknologi Informasi</option>
                        <option value="S2 Teknologi Informasi">S2 Teknologi Informasi</option>
                        <option value="S3 Teknologi Informasi">S3 Teknologi Informasi</option>
                    </select>
                </div>
            </div>

            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-4 pt-0">Jenis Kelamin</legend>
                <div class="col-sm-8">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin1" value="L" checked>
                        <label class="form-check-label" for="jenis_kelamin1">
                            Laki-laki
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin2" value="P">
                        <label class="form-check-label" for="jenis_kelamin2">
                            Perempuan
                        </label>
                    </div>
                </div>
            </fieldset>

            <div class="row mb-3">
                <label for="alamat" class="col-sm-4 col-form-label">Alamat Lengkap</label>
                <div class="col-sm-8">
                    <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label for="foto" class="col-sm-4 col-form-label">Foto <strong class="text-danger">*</strong></label>
                <div class="col-sm-8">
                    <input class="form-control" type="file" id="foto" name="foto" required>
                </div>
            </div>

            <input type="submit" name="simpan" value="SIMPAN" class="btn btn-primary">
            <input type="reset" name="reset" value="BATAL" class="btn btn-warning">
        </form>
    </div>
</div>
<!-- End of content -->