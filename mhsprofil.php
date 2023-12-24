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
        if (isset($_GET['nim'])) {
            $nim = $_GET['nim'];
            $mahasiswa = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa WHERE nim = '$nim'");
            $hasil = mysqli_fetch_array($mahasiswa);
        } else {
            header('Location: beranda.php'); // Jika tidak sesuai dengan parameter kembali ke halaman beranda
        }

        // Jika tombol simpan di klik eksekusi sintaks berikut
        if (isset($_POST['simpan'])) {
            // isi variable menyesuaiakan dengan name="..." yang ada pada form
            $nama_mahasiswa = $_POST['nama_mahasiswa'];
            $prodi = $_POST['prodi'];
            $semester = $_POST['semester'];
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
                    $sql = "UPDATE tb_mahasiswa SET
                            nama_mahasiswa = '$nama_mahasiswa',
                            prodi = '$prodi',
                            semester = '$semester',
                            alamat = '$alamat',
                            jenis_kelamin = '$jenis_kelamin',
                            foto = '$foto'
                            WHERE nim = '$nim'"; // $nim diambil dari parameter diatas
                    $query = mysqli_query($koneksi, $sql);

                    // Pindahkan foto kedalam folder img
                    move_uploaded_file($tmp, 'img/' . $foto);

                    // Update data tb_user
                    $oldEmail = $hasil['email'];
                    $user = mysqli_query($koneksi, "UPDATE tb_user SET
                                                    nama_lengkap='$nama_mahasiswa'
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
                $sql = "UPDATE tb_mahasiswa SET
                        nama_mahasiswa = '$nama_mahasiswa',
                        prodi = '$prodi',
                        semester = '$semester',
                        alamat = '$alamat',
                        jenis_kelamin = '$jenis_kelamin'
                        WHERE nim = '$nim'"; // $nim diambil dari parameter diatas
                $query = mysqli_query($koneksi, $sql);

                // Update data tb_user
                $oldEmail = $hasil['email'];
                $user = mysqli_query($koneksi, "UPDATE tb_user SET
                                                nama_lengkap='$nama_mahasiswa'
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
                <label for="nim" class="col-sm-4 col-form-label">Nomor Induk Mahasiswa <strong class="text-danger">*</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nim" name="nim" disabled required value="<?php echo $hasil['nim']; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="nama_mahasiswa" class="col-sm-4 col-form-label">Nama Mahasiswa <strong class="text-danger">*</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" required value="<?php echo $hasil['nama_mahasiswa']; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-sm-4 col-form-label">Email <strong class="text-danger">*</strong></label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email" disabled required value="<?php echo $hasil['email']; ?>">
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