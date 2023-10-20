<?php include 'template/_header.php'; ?>

<div class="card">
    <div class="card-header text-bg-primary fw-medium">
        DATA MAHASISWA
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mt-2">Tabel Data Mahasiswa</h5>
            <a href="mahasiswa-tambah.php" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i> Tambah</a>
        </div>
        <div class="table-responsive">
            <table class="table table-sm table-hover" id="example">
                <thead>
                    <tr class="align-middle">
                        <th>No.</th>
                        <th>Nomor Induk Mahasiswa</th>
                        <th>Nama Mahasiswa</th>
                        <th>Program Studi</th>
                        <th>Semester</th>
                        <th>L/P</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'connection.php';

                    $i = 1;

                    $mahasiswa = mysqli_query($db, "SELECT * FROM tb_mahasiswa ORDER BY nama ASC");

                    while ($result = mysqli_fetch_array($mahasiswa)) {
                    ?>
                        <tr class="align-middle">
                            <td><?= $i++; ?></td>
                            <td><?= $result['nim']; ?></td>
                            <td><?= $result['nama']; ?></td>
                            <td><?= $result['prodi']; ?></td>
                            <td><?= $result['semester']; ?></td>
                            <td><?= $result['jenis_kelamin']; ?></td>
                            <td>
                                <a href="mahasiswa-detail.php?nim=<?= $result['nim']; ?>" class="btn btn-sm btn-success"><i class="fa-solid fa-circle-info"></i></a>
                                <a href="mahasiswa-ubah.php?nim=<?= $result['nim']; ?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-pencil"></i></a>
                                <a href="mahasiswa-hapus.php?nim=<?= $result['nim']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Data akan dihapus?')"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php }; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'template/_footer.php'; ?>