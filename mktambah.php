<!-- Content -->
<div class="card">
    <div class="card-header text-bg-primary fw-medium">
        DATA MATA KULIAH
    </div>
    <div class="card-body">
        <h5 class="card-title mb-4">Tambah Data Mata Kuliah</h5>

        <?php
        include 'koneksi.php'; // Import file koneksi

        // Jika tombol simpan di klik eksekusi sintaks berikut
        if (isset($_POST['simpan'])) {
            // isi variable menyesuaiakan dengan name="..." yang ada pada form
            $kode_mk = $_POST['kode_mk'];
            $nama_mk = $_POST['nama_mk'];
            $sks = $_POST['sks'];

            $cekKodeMK = mysqli_query($koneksi, "SELECT kode_mk FROM tb_mk where kode_mk='$kode_mk'");
            if (mysqli_num_rows($cekKodeMK) > 0) { // Cek Kode MK
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Kode Mata Kuliah sudah ada!</strong> Silahkan coba kembali.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            } elseif (strlen($kode_mk) <> 8) { // Cek jumlah karakter Kode MK
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Kode Mata Kuliah harus 8 karakter!</strong> Silahkan coba kembali..
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            } else {
                // Sintaks SQL untuk tambah data
                $sql = "INSERT INTO tb_mk VALUES ('$kode_mk', '$nama_mk', '$sks')";
                $query = mysqli_query($koneksi, $sql);

                // Alerts atau pesan
                if ($query) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Data berhasil disimpan!</strong> Untuk melihat data silahkan klik <a href="?page=mkdata">disini</a>.
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
                <label for="kode_mk" class="col-sm-4 col-form-label">Kode Mata Kuliah <strong class="text-danger">*</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="kode_mk" name="kode_mk" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="nama_mk" class="col-sm-4 col-form-label">Nama Mata Kuliah <strong class="text-danger">*</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama_mk" name="nama_mk" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="sks" class="col-sm-4 col-form-label">Jumlah SKS</label>
                <div class="col-sm-8">
                    <select class="form-select" id="sks" name="sks">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                    </select>
                </div>
            </div>

            <input type="submit" name="simpan" value="SIMPAN" class="btn btn-primary">
            <input type="reset" name="reset" value="BATAL" class="btn btn-warning">
        </form>
    </div>
</div>
<!-- End of content -->