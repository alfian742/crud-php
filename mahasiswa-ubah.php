<?php include 'template/_header.php'; ?>

<div class="card">
    <div class="card-header text-bg-primary fw-medium">
        DATA MAHASISWA
    </div>
    <div class="card-body">
        <div class="d-flex flex-row gap-2 align-items-center mb-4">
            <a href="mahasiswa-data.php" class="btn btn-sm btn-light"><i class="fa-solid fa-arrow-left"></i></a>
            <h5 class="card-title mt-2">Ubah Data Mahasiswa</h5>
        </div>

        <?php
        include 'connection.php';

        $nim = $_GET['nim'];

        $mahasiswa = mysqli_query($db, "SELECT * FROM tb_mahasiswa WHERE nim = '$nim'");
        $result = mysqli_fetch_array($mahasiswa);

        if (isset($_POST['submit'])) {
            $nim = mysqli_real_escape_string($db, $_POST['nim']);
            $nama = mysqli_real_escape_string($db, $_POST['nama']);
            $prodi = mysqli_real_escape_string($db, $_POST['prodi']);
            $semester = mysqli_real_escape_string($db, $_POST['semester']);
            $alamat = mysqli_real_escape_string($db, $_POST['alamat']);
            $jenis_kelamin = mysqli_real_escape_string($db, $_POST['jenis_kelamin']);
            $foto = '';

            // Upload file
            $file = $_FILES['foto'];
            if (isset($file) && $file['error'] === 0) {
                $allowedFormats = ['image/jpeg', 'image/jpg', 'image/png'];
                $maxSize = 1 * 1024 * 1024;
                if (in_array($file['type'], $allowedFormats) && $file['size'] <= $maxSize) {
                    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
                    $randomFileName = uniqid() . '.' . $fileExtension;
                    $targetPath = 'img/' . $randomFileName;

                    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                        $foto = $randomFileName;
                        $oldFoto = $result['foto'];
                        if ($oldFoto != 'default.jpg') {
                            $oldFilePath = 'img/' . $oldFoto;
                            if (file_exists($oldFilePath)) {
                                unlink($oldFilePath);
                            }
                        }
                    } else {
                        echo "<script>
                                alert('Gagal mengunggah gambar! Silahkan mencoba kembali.');
                                window.location.href = 'mahasiswa-ubah.php?nim=$nim';
                            </script>";
                        exit;
                    }
                } else {
                    echo "<script>
                            alert('Format atau ukuran gambar tidak sesuai! Harap unggah gambar dengan format JPG/JPEG/PNG dan ukuran maksimal 1 MB.');
                            window.location.href = 'mahasiswa-ubah.php?nim=$nim';
                        </script>";
                    exit;
                }
            }

            // Uodate data
            $query = "UPDATE tb_mahasiswa SET
                    nama = '$nama',
                    prodi = '$prodi',
                    semester = '$semester',
                    alamat = '$alamat',
                    jenis_kelamin = '$jenis_kelamin',
                    foto = '$foto'
                    WHERE nim = '$nim'";
            $update = mysqli_query($db, $query);
            if ($update) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Data berhasil diubah!</strong> Untuk melihat data silahkan klik <a href="mahasiswa-data.php">disini</a>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            } else {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Data gagal diubah!</strong> Silahkan coba kembali.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row mb-4">
                <label for="nim" class="col-sm-3 col-form-label">Nomor Induk Mahasiswa</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control bg-light" id="nim" name="nim" value="<?= $result['nim']; ?>" readonly>
                </div>
            </div>

            <div class="row mb-4">
                <label for="nama" class="col-sm-3 col-form-label">Nama Mahasiswa</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $result['nama']; ?>" autofocus required>
                </div>
            </div>

            <div class="row mb-4">
                <label for="prodi" class="col-sm-3 col-form-label">Program Studi</label>
                <div class="col-sm-9">
                    <select class="form-select" id="prodi" name="prodi">
                        <option value="Teknik Informatika" <?= ($result['prodi'] == 'Teknik Informatika') ? 'selected' : ''; ?>>Teknik Informatika</option>
                        <option value="Sistem Informasi" <?= ($result['prodi'] == 'Sistem Informasi') ? 'selected' : ''; ?>>Sistem Informasi</option>
                        <option value="Teknologi Informasi" <?= ($result['prodi'] == 'Teknologi Informasi') ? 'selected' : ''; ?>>Teknologi Informasi</option>
                    </select>
                </div>
            </div>

            <div class="row mb-4">
                <label for="semester" class="col-sm-3 col-form-label">Semester</label>
                <div class="col-sm-9">
                    <select class="form-select" id="semester" name="semester">
                        <option value="1" <?= ($result['semester'] == '1') ? 'selected' : ''; ?>>1</option>
                        <option value="2" <?= ($result['semester'] == '2') ? 'selected' : ''; ?>>2</option>
                        <option value="3" <?= ($result['semester'] == '3') ? 'selected' : ''; ?>>3</option>
                        <option value="4" <?= ($result['semester'] == '4') ? 'selected' : ''; ?>>4</option>
                        <option value="5" <?= ($result['semester'] == '5') ? 'selected' : ''; ?>>5</option>
                        <option value="6" <?= ($result['semester'] == '6') ? 'selected' : ''; ?>>6</option>
                        <option value="7" <?= ($result['semester'] == '7') ? 'selected' : ''; ?>>7</option>
                        <option value="8" <?= ($result['semester'] == '8') ? 'selected' : ''; ?>>8</option>
                    </select>
                </div>
            </div>

            <div class="row mb-4">
                <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="alamat" rows="3" name="alamat"><?= $result['alamat']; ?></textarea>
                </div>
            </div>

            <fieldset class="row mb-4">
                <legend class="col-form-label col-sm-3 pt-0">Jenis Kelamin</legend>
                <div class="col-sm-9">
                    <div class="d-flex flex-row gap-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="jenis_kelamin1" value="L" name="jenis_kelamin" <?= ($result['jenis_kelamin'] == 'L') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="jenis_kelamin1">
                                Laki-Laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="jenis_kelamin2" value="P" name="jenis_kelamin" <?= ($result['jenis_kelamin'] == 'P') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="jenis_kelamin2">
                                Perempuan
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <div class="row mb-4">
                <label for="foto" class="col-sm-3 col-form-label">Foto</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-9 mb-4">
                            <input class="form-control" type="file" id="foto" name="foto" accept=".jpg, .jpeg, .png" onchange="previewImage()">
                            <div class="text-muted mt-2" style="font-size: 14px;"><span class="text-danger">*</span> Format foto JPG/JPEG/PNG dan ukuran maksimal 1 MB.</div>
                        </div>
                        <div class="col-sm-3">
                            <img src="img/<?= $result['foto']; ?>" height="100" width="100" class="img-preview d-block mx-auto rounded-2 shadow-sm object-fit-cover">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" name="submit" class="btn btn-primary" style="width: 80px;">Simpan</button>
            <button type="submit" name="reset" class="btn btn-warning" style="width: 80px;">Batal</button>
        </form>
    </div>
</div>

<?php include 'template/_footer.php'; ?>