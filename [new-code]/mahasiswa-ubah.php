<?php
session_start();
if (isset($_SESSION['email']) and isset($_SESSION['level'])) {

    include 'template/_header.php';
?>

    <div class="card">
        <div class="card-header text-bg-primary">
            DATA MAHASISWA
        </div>
        <div class="card-body">
            <div class="d-flex flex-row gap-2 align-items-center mb-4">
                <a href="mahasiswa-data.php" class="btn btn-sm btn-light"><i class="fa-solid fa-arrow-left"></i></a>
                <h5 class="card-title mt-2">Ubah Mahasiswa</h5>
            </div>

            <?php
            include 'connection.php'; // Mengimpor file koneksi ke database

            $nim = $_GET['nim']; // Mendapatkan NIM mahasiswa dari parameter URL

            // Memeriksa apakah NIM telah diset
            if (isset($nim)) {
                // Mengambil data mahasiswa berdasarkan NIM dari tabel tb_mahasiswa
                $mahasiswa = mysqli_query($db, "SELECT * FROM tb_mahasiswa WHERE nim = '$nim'");
                $result = mysqli_fetch_array($mahasiswa);
            } else {
                // Jika NIM tidak diset, redirect ke halaman mahasiswa-data.php
                header('Location: mahasiswa-data.php');
            }

            // Memeriksa apakah tombol "Simpan" telah ditekan
            if (isset($_POST['simpan'])) {
                // Mengambil data dari formulir
                $nama = htmlspecialchars($_POST['nama']);
                $prodi = htmlspecialchars($_POST['prodi']);
                $semester = htmlspecialchars($_POST['semester']);
                $alamat = htmlspecialchars($_POST['alamat']);
                $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);

                // Mengambil informasi tentang file foto yang diunggah
                $namaFoto = $_FILES['foto']['name'];
                $tmp = $_FILES['foto']['tmp_name'];

                // Memeriksa apakah file foto baru diunggah
                if (strlen($namaFoto) > 0) {
                    // Mendapatkan ekstensi file foto dan membuat nama file acak untuk mencegah duplikasi
                    $ekstensiFoto = pathinfo($namaFoto, PATHINFO_EXTENSION);
                    $randomNamaGambar = uniqid() . '.' . $ekstensiFoto;

                    // Memindahkan file foto baru ke direktori 'img/' jika berhasil diunggah
                    if (move_uploaded_file($tmp, 'img/' . $randomNamaGambar)) {
                        $foto = $randomNamaGambar;

                        // Menghapus foto lama jika ada
                        if ($result['foto']) {
                            $fotoLama = 'img/' . $result['foto'];
                            if (file_exists($fotoLama))
                                unlink($fotoLama);
                        }
                    }

                    // Menyusun query untuk mengupdate data mahasiswa dengan foto baru
                    $sql = "UPDATE tb_mahasiswa SET 
                    nama = '$nama',
                    prodi = '$prodi',
                    semester = '$semester',
                    alamat = '$alamat',
                    jenis_kelamin = '$jenis_kelamin',
                    foto = '$foto'
                    WHERE nim = '$nim'";

                    // Menjalankan query
                    $query = mysqli_query($db, $sql);
                } else {
                    // Menyusun query untuk mengupdate data mahasiswa tanpa foto baru
                    $sql = "UPDATE tb_mahasiswa SET 
                    nama = '$nama',
                    prodi = '$prodi',
                    semester = '$semester',
                    alamat = '$alamat',
                    jenis_kelamin = '$jenis_kelamin'
                    WHERE nim = '$nim'";

                    // Menjalankan query
                    $query = mysqli_query($db, $sql);
                }

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
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                    <label for="nim" class="col-sm-4 col-form-label">Nomor Induk Mahasiswa</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nim" name="nim" disabled value="<?= $result['nim']; ?>">
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

                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-4 pt-0">Jenis Kelamin</legend>
                    <div class="col-sm-8">
                        <div class="d-flex flex-row gap-3">
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
                    </div>
                </fieldset>

                <div class="row mb-3">
                    <label for="alamat" class="col-sm-4 col-form-label">Alamat Lengkap</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= $result['alamat']; ?></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="foto" class="col-sm-4 col-form-label">Foto</label>
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="img/<?= $result['foto']; ?>" alt="<?= $result['nama']; ?>" class="object-fit-cover rounded-2 shadow-sm img-preview" width="100" height="100">
                            </div>
                            <div class="col-sm-9">
                                <input class="form-control" type="file" id="foto" name="foto" onchange="previewImage()">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="element-center">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="mahasiswa-data.php" class="btn btn-warning">Batal</a>
                </div>
            </form>
        </div>
    </div>

<?php
    include 'template/_footer.php';
} else {
    echo '<div style="font-family: Arial, Helvetica, sans-serif; font-size: large; text-align: center; color: red; margin-top: 5rem;">
            <h5>Tidak dapat mengakses halaman ini, silahkan login terlebih dahulu. <a href="login.php">LOGIN</a></h5>
        </div>';
} ?>