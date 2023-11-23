<!-- Content -->
<div class="card">
    <div class="card-header text-bg-primary fw-medium">
        DATA MAHASISWA
    </div>
    <div class="card-body">
        <h5 class="card-title mb-4">Tambah Data Mahasiswa</h5>

        <?php
        include 'koneksi.php'; // Import file koneksi

        // Jika tombol simpan di klik eksekusi sintaks berikut
        if (isset($_POST['simpan'])) {
            // isi variable menyesuaiakan dengan name="..." yang ada pada form
            $nim = $_POST['nim'];
            $nama = $_POST['nama'];
            $prodi = $_POST['prodi'];
            $semester = $_POST['semester'];
            $alamat = $_POST['alamat'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $foto = $_FILES['foto']['name'];
            $tmp = $_FILES['foto']['tmp_name'];

            // Sintaks SQL untuk tambah data
            $sql = "INSERT INTO tb_mahasiswa VALUES ('$nim', '$nama', '$prodi', '$semester', '$alamat', '$jenis_kelamin', '$foto')";
            $query = mysqli_query($koneksi, $sql);

            // Pindahkan foto kedalam folder img
            move_uploaded_file($tmp, 'img/' . $foto);

            // Alerts atau pesan
            if ($query) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Data berhasil disimpan!</strong> Untuk melihat data silahkan klik <a href="?page=mhsdata">disini</a>.
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
                    <input type="text" class="form-control" id="nim" name="nim">
                </div>
            </div>

            <div class="row mb-3">
                <label for="nama" class="col-sm-4 col-form-label">Nama Mahasiswa</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama" name="nama">
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
                <label for="foto" class="col-sm-4 col-form-label">Foto</label>
                <div class="col-sm-8">
                    <input class="form-control" type="file" id="foto" name="foto">
                </div>
            </div>

            <input type="submit" name="simpan" value="SIMPAN" class="btn btn-primary">
            <input type="reset" name="reset" value="BATAL" class="btn btn-warning">
        </form>
    </div>
</div>
<!-- End of content -->