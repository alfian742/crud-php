<div class="card">
    <div class="card-header text-bg-primary fw-medium">
        KRS
    </div>
    <div class="card-body">
        <h5 class="card-title mb-4">Tambah Mata Kuliah Ke KRS</h5>
        <?php
        include 'koneksi.php';

        if (isset($_GET['nim'])) {
            $nim = $_GET['nim'];

            $sqlMahasiswa = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa WHERE nim='$nim'");
            $hasilMahasiswa = mysqli_fetch_array($sqlMahasiswa);
        } else {
            header('Location: ?page=krs');
        }
        ?>

        <div class="row mb-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr class="align-middle">
                                <th>Kode</th>
                                <th>Nama Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Semester</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $semester = $hasilMahasiswa['semester'];

                            $sqlMK = "SELECT * FROM tb_mk";
                            $queryMK = mysqli_query($koneksi, $sqlMK);

                            while ($hasilMK = mysqli_fetch_array($queryMK)) {
                            ?>
                                <tr class="align-middle">
                                    <td><?php echo $hasilMK['kode_mk']; ?></td>
                                    <td><?php echo $hasilMK['nama_mk']; ?></td>
                                    <td><?php echo $hasilMK['sks']; ?></td>
                                    <td><?php echo $hasilMK['semester']; ?></td>
                                    <td class="text-center">
                                        <?php
                                        $kode_mk = $hasilMK['kode_mk'];

                                        $sqlKRS = "SELECT * FROM tb_khs WHERE nim='$nim' AND semester='$semester' AND kode_mk='$kode_mk'";
                                        $queryKRS = mysqli_query($koneksi, $sqlKRS);

                                        if (mysqli_num_rows($queryKRS) > 0) {
                                            echo "<span class='text-success'>&#x2713</span>";
                                        } else {
                                            echo "<a href='krsinput.php?nim=$nim&&semester=$semester&&kode_mk=$kode_mk' class='btn btn-sm btn-primary'>Pilih</a>";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="element-center">
            <a href="?page=krsisi" class="btn btn-primary fw-medium">SELESAI</a>
        </div>
    </div>
</div>