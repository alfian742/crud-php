<?php
session_start();
if (isset($_SESSION['email']) and isset($_SESSION['level'])) {

    include 'template/_header.php';
?>

    <div class="card">
        <div class="card-header text-bg-primary fw-medium">
            DATA MAHASISWA
        </div>
        <div class="card-body">
            <div class="d-flex flex-row gap-2 align-items-center mb-4">
                <a href="mahasiswa-data.php" class="btn btn-sm btn-light"><i class="fa-solid fa-arrow-left"></i></a>
                <h5 class="card-title mt-2">Detail Mahasiswa</h5>
            </div>

            <?php
            include 'connection.php'; // Mengimpor file koneksi ke database

            $nim = $_GET['nim']; // Mendapatkan NIM mahasiswa dari parameter URL

            // Mengambil data mahasiswa berdasarkan NIM dari tabel tb_mahasiswa
            $mahasiswa = mysqli_query($db, "SELECT * FROM tb_mahasiswa WHERE nim = '$nim'");

            // Mengambil hasil query dan menyimpannya dalam bentuk array
            $result = mysqli_fetch_array($mahasiswa);
            ?>

            <div class="row">
                <div class="col-sm-3">
                    <img src="img/<?= $result['foto']; ?>" alt="<?= $result['nama']; ?>" class="rounded-2 shadow-sm object-fit-cover img-detail">
                </div>
                <div class="col-sm-9">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tr>
                                <td>Nomor Induk Mahasiswa</td>
                                <td>:</td>
                                <td><?= $result['nim']; ?></td>
                            </tr>
                            <tr>
                                <td>Nama Mahasiswa</td>
                                <td>:</td>
                                <td><?= $result['nama']; ?></td>
                            </tr>
                            <tr>
                                <td>Program Studi</td>
                                <td>:</td>
                                <td><?= $result['prodi']; ?></td>
                            </tr>
                            <tr>
                                <td>Semester</td>
                                <td>:</td>
                                <td><?= $result['semester']; ?></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td><?= ($result['jenis_kelamin'] == 'L') ? 'Laki-Laki' : (($result['jenis_kelamin'] == 'P') ? 'Perempuan' : ''); ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><?= $result['alamat']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    include 'template/_footer.php';
} else {
    echo '<div style="font-family: Arial, Helvetica, sans-serif; font-size: large; text-align: center; color: red; margin-top: 5rem;">
            <h5>Tidak dapat mengakses halaman ini, silahkan login terlebih dahulu. <a href="login.php">LOGIN</a></h5>
        </div>';
} ?>