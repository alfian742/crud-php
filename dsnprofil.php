<!-- Content -->
<div class="card">
    <div class="card-header text-bg-primary fw-medium">
        PROFIL
    </div>
    <div class="card-body">
        <h5 class="card-title mb-4">Ubah Profil</h5>

        <?php
        include 'koneksi.php'; // Import file koneksi

        // Mengambil data sesuai dengan parameter
        if (isset($_GET['nidn'])) {
            $nidn = $_GET['nidn'];
            $dosen = mysqli_query($koneksi, "SELECT * FROM tb_dosen WHERE nidn = '$nidn'");
            $hasil = mysqli_fetch_array($dosen);
        } else {
            header('Location: beranda.php'); // Jika tidak sesuai dengan parameter kembali ke halaman tampil data
        }

        // Jika tombol simpan di klik eksekusi sintaks berikut
        if (isset($_POST['simpan'])) {
            // isi variable menyesuaiakan dengan name="..." yang ada pada form
            $nama_dosen = $_POST['nama_dosen'];
            $pendidikan = $_POST['pendidikan'];
            $alamat = $_POST['alamat'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $foto = $_FILES['foto']['name'];
            $tmp = $_FILES['foto']['tmp_name'];
            $size = $_FILES['foto']['size'];

            // Jika ada foto baru yang diunggah eksekusi sintaks berikut
            if (strlen($foto) > 0) {
                $ekstensiFoto = pathinfo($foto, PATHINFO_EXTENSION);

                if (!in_array($ekstensiFoto, ['jpg', 'jpeg', 'png'])) { // Cek ekstensi foto
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Format tidak didukung!</strong> Silahkan unggah foto tipe JPG/JPEG/PNG.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                } elseif ($size > 1000000) { // Cek ukuran foto 
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Ukuran foto terlalu besar!</strong> Silahkan unggah foto maksimal 1MB.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                } else {
                    // Sintaks SQL untuk ubah data jika ada foto baru yang diunggah
                    $sql = "UPDATE tb_dosen SET
                            nama_dosen = '$nama_dosen',
                            pendidikan = '$pendidikan',
                            alamat = '$alamat',
                            jenis_kelamin = '$jenis_kelamin',
                            foto = '$foto'
                            WHERE nidn = '$nidn'"; // $nidn diambil dari parameter diatas
                    $query = mysqli_query($koneksi, $sql);

                    // Pindahkan foto kedalam folder img
                    move_uploaded_file($tmp, 'img/' . $foto);

                    // Update data tb_user
                    $oldEmail = $hasil['email'];
                    $user = mysqli_query($koneksi, "UPDATE tb_user SET
                                                    nama_lengkap='$nama_dosen'
                                                    WHERE email='$oldEmail'");

                    // Alerts atau pesan
                    if ($query) {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Data berhasil disimpan!</strong> Untuk melihat data silahkan klik <a href="beranda.php">disini</a>.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                    } else {
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Data gagal disimpan!</strong> Silahkan coba kembali.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                    }
                }
            } else {
                // Sintaks SQL untuk ubah data tanpa unggah foto
                $sql = "UPDATE tb_dosen SET
                        nama_dosen = '$nama_dosen',
                        pendidikan = '$pendidikan',
                        alamat = '$alamat',
                        jenis_kelamin = '$jenis_kelamin'
                        WHERE nidn = '$nidn'"; // $nidn diambil dari parameter diatas
                $query = mysqli_query($koneksi, $sql);

                // Update data tb_user
                $oldEmail = $hasil['email'];
                $user = mysqli_query($koneksi, "UPDATE tb_user SET
                                                nama_lengkap='$nama_dosen'
                                                WHERE email='$oldEmail'");

                // Alerts atau pesan
                if ($query) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Data berhasil disimpan!</strong> Untuk melihat data silahkan klik <a href="beranda.php">disini</a>.
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
                <label for="nidn" class="col-sm-4 col-form-label">Nomor Induk Dosen Nasional <strong class="text-danger">*</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nidn" name="nidn" disabled required value="<?php echo $hasil['nidn']; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="nama_dosen" class="col-sm-4 col-form-label">Nama Dosen <strong class="text-danger">*</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" required value="<?php echo $hasil['nama_dosen']; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-sm-4 col-form-label">Email <strong class="text-danger">*</strong></label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email" disabled required value="<?php echo $hasil['email']; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="pendidikan" class="col-sm-4 col-form-label">Pendidikan</label>
                <div class="col-sm-8">
                    <select class="form-select" id="pendidikan" name="pendidikan">
                        <option value="S1 Teknik Informatika" <?php if ($hasil['pendidikan'] == "S1 Teknik Informatika") {
                                                                    echo "selected";
                                                                } ?>>S1 Teknik Informatika</option>
                        <option value="S2 Teknik Informatika" <?php if ($hasil['pendidikan'] == "S2 Teknik Informatika") {
                                                                    echo "selected";
                                                                } ?>>S2 Teknik Informatika</option>
                        <option value="S3 Teknik Informatika" <?php if ($hasil['pendidikan'] == "S3 Teknik Informatika") {
                                                                    echo "selected";
                                                                } ?>>S3 Teknik Informatika</option>
                        <option value="S1 Sistem Informasi" <?php if ($hasil['pendidikan'] == "S1 Sistem Informasi") {
                                                                echo "selected";
                                                            } ?>>S1 Sistem Informasi</option>
                        <option value="S2 Sistem Informasi" <?php if ($hasil['pendidikan'] == "S2 Sistem Informasi") {
                                                                echo "selected";
                                                            } ?>>S2 Sistem Informasi</option>
                        <option value="S3 Sistem Informasi" <?php if ($hasil['pendidikan'] == "S3 Sistem Informasi") {
                                                                echo "selected";
                                                            } ?>>S3 Sistem Informasi</option>
                        <option value="S1 Tekknologi Informasi" <?php if ($hasil['pendidikan'] == "S1 Tekknologi Informasi") {
                                                                    echo "selected";
                                                                } ?>>S1 Tekknologi Informasi</option>
                        <option value="S2 Tekknologi Informasi" <?php if ($hasil['pendidikan'] == "S2 Tekknologi Informasi") {
                                                                    echo "selected";
                                                                } ?>>S2 Tekknologi Informasi</option>
                        <option value="S3 Tekknologi Informasi" <?php if ($hasil['pendidikan'] == "S3 Tekknologi Informasi") {
                                                                    echo "selected";
                                                                } ?>>S3 Tekknologi Informasi</option>
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
                <label for="foto" class="col-sm-4 col-form-label">Foto <strong class="text-danger">*</strong></label>
                <div class="col-sm-8">
                    <img src="img/<?php echo $hasil['foto']; ?>" width="75" height="75" class="rounded-2 shadow-sm object-fit-cover mb-2">
                    <input class="form-control" type="file" id="foto" name="foto">
                </div>
            </div>

            <input type="submit" name="simpan" value="SIMPAN" class="btn btn-primary">
            <a href="beranda.php" class="btn btn-warning">BATAL</a>
        </form>
    </div>
</div>
<!-- End of content -->