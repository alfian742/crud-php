<?php include 'template/_header.php'; ?>

<div class="card">
    <div class="card-header text-bg-primary">
        UBAH MAHASISWA
    </div>
    <div class="card-body">
        <h5 class="card-title mb-4">Ubah Mahasiswa</h5>

        <?php
        include "connection.php";

        $nim = $_GET['nim'];
        $mhs = mysqli_query($db, "SELECT * FROM tb_mahasiswa WHERE nim = '$nim'");
        $result = mysqli_fetch_array($mhs);

        if (isset($_POST['simpan'])) {
            $nim = $_POST['nim'];
            $nama = $_POST['nama'];
            $prodi = $_POST['prodi'];
            $semester = $_POST['semester'];
            $alamat = $_POST['alamat'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $foto = $_FILES['foto']['name'];
            $tmp = $_FILES['foto']['tmp_name'];

            $sql = "UPDATE tb_mahasiswa SET
                    nama = '$nama',
                    prodi = '$prodi',
                    semester = '$semester',
                    alamat = '$alamat',
                    jenis_kelamin = '$jenis_kelamin',
                    foto = '$foto'
                    WHERE nim = '$nim'";

            $query = mysqli_query($db, $sql);

            move_uploaded_file($tmp, "img/$foto");

            if ($query) {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Data berhasil disimpan!</strong> Untuk melihat data silahkan klik <a href='mhs-data.php'>disini</a>.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
            } else {
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Data gagal disimpan!</strong> Silahkan coba kembali.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
            }
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row mb-3">
                <label for="nim" class="col-sm-4 col-form-label">Nomor Induk Mahasiswa</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control text-bg-light" id="nim" name="nim" value="<?= $result['nim']; ?>" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <label for="nama" class="col-sm-4 col-form-label">Nama Mahasiswa</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $result['nama']; ?>" autofocus required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="prodi" class="col-sm-4 col-form-label">Program Studi</label>
                <div class="col-sm-8">
                    <select class="form-select" id="prodi" name="prodi">
                        <option value="Teknik Informatika" <?= ($result['prodi'] == 'Teknik Informatika') ? 'selected' : ''; ?>>Teknik Informatika</option>
                        <option value="Sistem Informasi" <?= ($result['prodi'] == 'Sistem Informasi') ? 'selected' : ''; ?>>Sistem Informasi</option>
                        <option value="Teknologi Informasi" <?= ($result['prodi'] == 'Teknologi Informasi') ? 'selected' : ''; ?>>Teknologi Informasi</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="semester" class="col-sm-4 col-form-label">Semester</label>
                <div class="col-sm-8">
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

            <div class="row mb-3">
                <label for="alamat" class="col-sm-4 col-form-label">Alamat Lengkap</label>
                <div class="col-sm-8">
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= $result['alamat']; ?></textarea>
                </div>
            </div>

            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-4 pt-0">Jenis Kelamin</legend>
                <div class="col-sm-8">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin1" value="L" <?= ($result['jenis_kelamin'] == 'L') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="jenis_kelamin1">
                            Laki-Laki
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kealmin2" value="P" <?= ($result['jenis_kelamin'] == 'P') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="jenis_kealmin2">
                            Perempuan
                        </label>
                    </div>
                </div>
            </fieldset>

            <div class="row mb-3">
                <label for="foto" class="col-sm-4 col-form-label">Foto</label>
                <div class="col-sm-8">
                    <input class="form-control" type="file" id="foto" name="foto" required>
                </div>
            </div>

            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-warning">Batal</button>
        </form>
    </div>
</div>

<?php include 'template/_footer.php'; ?>