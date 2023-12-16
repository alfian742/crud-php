<!-- Content -->
<div class="card">
    <div class="card-header text-bg-primary fw-medium">
        DATA MATA KULIAH
    </div>
    <div class="card-body">
        <h5 class="card-title mb-4">Ubah Data Mata Kuliah</h5>

        <?php
        include 'koneksi.php'; // Import file koneksi

        // Mengambil data sesuai dengan parameter
        if (isset($_GET['kode_mk'])) {
            $kode_mk = $_GET['kode_mk'];
            $mk = mysqli_query($koneksi, "SELECT * FROM tb_mk WHERE kode_mk = '$kode_mk'");
            $hasil = mysqli_fetch_array($mk);
        } else {
            header('Location: ?page=mkdata'); // Jika tidak sesuai dengan parameter kembali ke halaman tampil data
        }

        // Jika tombol simpan di klik eksekusi sintaks berikut
        if (isset($_POST['simpan'])) {
            // isi variable menyesuaiakan dengan name="..." yang ada pada form
            $nama_mk = $_POST['nama_mk'];
            $sks = $_POST['sks'];

            // Sintaks SQL untuk ubah data
            $sql = "UPDATE tb_mk SET
                    nama_mk = '$nama_mk',
                    sks = '$sks'
                    WHERE kode_mk = '$kode_mk'"; // $kode_mk diambil dari parameter diatas

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
        ?>

        <form action="" method="POST">
            <div class="row mb-3">
                <label for="kode_mk" class="col-sm-4 col-form-label">Kode Mata Kuliah <strong class="text-danger">*</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="kode_mk" name="kode_mk" disabled value="<?php echo $hasil['kode_mk']; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="nama_mk" class="col-sm-4 col-form-label">Nama Mata Kuliah <strong class="text-danger">*</strong></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama_mk" name="nama_mk" required value="<?php echo $hasil['nama_mk']; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="sks" class="col-sm-4 col-form-label">Jumlah SKS</label>
                <div class="col-sm-8">
                    <select class="form-select" id="sks" name="sks">
                        <option value="1" <?php if ($hasil['sks'] == "1") {
                                                echo "selected";
                                            } ?>>1</option>
                        <option value="2" <?php if ($hasil['sks'] == "2") {
                                                echo "selected";
                                            } ?>>2</option>
                        <option value="3" <?php if ($hasil['sks'] == "3") {
                                                echo "selected";
                                            } ?>>3</option>
                        <option value="4" <?php if ($hasil['sks'] == "4") {
                                                echo "selected";
                                            } ?>>4</option>
                        <option value="5" <?php if ($hasil['sks'] == "5") {
                                                echo "selected";
                                            } ?>>5</option>
                        <option value="6" <?php if ($hasil['sks'] == "6") {
                                                echo "selected";
                                            } ?>>6</option>
                        <option value="7" <?php if ($hasil['sks'] == "7") {
                                                echo "selected";
                                            } ?>>7</option>
                        <option value="8" <?php if ($hasil['sks'] == "8") {
                                                echo "selected";
                                            } ?>>8</option>
                        <option value="9" <?php if ($hasil['sks'] == "9") {
                                                echo "selected";
                                            } ?>>9</option>
                    </select>
                </div>
            </div>

            <input type="submit" name="simpan" value="SIMPAN" class="btn btn-primary">
            <a href="?page=mkdata" class="btn btn-warning">BATAL</a>
        </form>
    </div>
</div>
<!-- End of content -->