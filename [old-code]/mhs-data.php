<?php include 'template/_header.php'; ?>

<div class="card">
    <div class="card-header text-bg-primary">
        DATA MAHASISWA
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between alig-items-center mb-4">
            <h5 class="card-title mt-1">Tabel Data Mahasiswa</h5>
            <a class="btn btn-primary" href="mhs-tambah.php" role="button">Tambah</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
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
                    include "connection.php";

                    $sql = "SELECT * FROM tb_mahasiswa ORDER BY nama ASC";

                    $query = mysqli_query($db, $sql);

                    while ($result = mysqli_fetch_array($query)) {
                    ?>
                        <tr class="align-middle">
                            <td><img src="img/<?= $result['foto']; ?>" height="50" width="50" class="rounded-2 shadow-sm object-fit-cover"></td>
                            <td><?= $result['nim']; ?></td>
                            <td><?= $result['nama']; ?></td>
                            <td><?= $result['prodi']; ?></td>
                            <td><?= $result['semester']; ?></td>
                            <td><?= $result['jenis_kelamin']; ?></td>
                            <td>
                                <a href="mhs-ubah.php?nim=<?= $result['nim']; ?>" class="btn btn-sm btn-primary">Ubah</a>
                                <a href="mhs-hapus.php?nim=<?= $result['nim']; ?>" class="btn btn-sm btn-warning" onclick="return confirm('Data akan dihapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php }; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'template/_footer.php'; ?>