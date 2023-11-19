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
            <div class="d-flex justify-content-between alig-items-center mb-4">
                <h5 class="card-title">Tabel Data Mahasiswa</h5>
                <a href="mahasiswa-tambah.php" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i><span class="ms-2 d-none d-lg-inline">Tambah</span></a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover" id="example">
                    <thead>
                        <tr class="align-middle">
                            <th scope="col">Foto</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Nama Mahasiswa</th>
                            <th scope="col">Program Studi</th>
                            <th scope="col">Semester</th>
                            <th scope="col">L/P</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "connection.php"; // Mengimpor file koneksi ke database

                        // Mengambil data mahasiswa dari tabel tb_mahasiswa dan mengurutkannya berdasarkan nama secara ascending
                        $mahasiswa = mysqli_query($db, "SELECT * FROM tb_mahasiswa ORDER BY nama ASC");

                        // Mengambil setiap baris hasil query dan mengekstrak informasinya menggunakan mysqli_fetch_array
                        while ($result = mysqli_fetch_array($mahasiswa)) {
                        ?>
                            <tr class="align-middle">
                                <td><img src="img/<?= $result['foto']; ?>" height="50" width="50" class="rounded-2 shadow-sm object-fit-cover"></td>
                                <td><?= $result['nim']; ?></td>
                                <td><?= $result['nama']; ?></td>
                                <td><?= $result['prodi']; ?></td>
                                <td><?= $result['semester']; ?></td>
                                <td><?= $result['jenis_kelamin']; ?></td>
                                <td>
                                    <div class="d-flex flex-row gap-2">
                                        <a href="mahasiswa-detail.php?nim=<?= $result['nim']; ?>" class="btn btn-sm btn-success"><i class="fa-solid fa-info-circle"></i></a>
                                        <a href="mahasiswa-ubah.php?nim=<?= $result['nim']; ?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-pencil"></i></a>
                                        <a href="mahasiswa-hapus.php?nim=<?= $result['nim']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Data akan dihapus?')"><i class="fa-solid fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php }; ?>
                    </tbody>
                </table>
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