<?php include 'template/_header.php'; ?>

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
        include 'connection.php';

        $nim = $_GET['nim'];

        $mahasiswa = mysqli_query($db, "SELECT * FROM tb_mahasiswa WHERE nim = '$nim'");
        $result = mysqli_fetch_array($mahasiswa);
        ?>

        <div class="row">
            <div class="col-sm-3">
                <img src="img/<?= $result['foto']; ?>" alt="<?= $result['nama']; ?>" height="150" width="150" class="rounded-2 shadow-sm object-fit-cover d-block mx-auto  mb-4">
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
                            <td><?= ($result['jenis_kelamin'] == 'L') ? 'Laki-Laki' : ''; ?><?= ($result['jenis_kelamin'] == 'P') ? 'Perempuan' : ''; ?></td>
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

<?php include 'template/_footer.php'; ?>