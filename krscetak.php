<?php
session_start();
if (isset($_SESSION['email']) and isset($_SESSION['level'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SIAKAD</title>

        <!-- Bootstrap css -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    </head>

    <body onload="window.print()">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h5 class="card-title text-center mb-4">KARTU RENCANA STUDI</h5>

                    <?php
                    include 'koneksi.php';

                    if ($_SESSION['level'] == "Mahasiswa") {
                        $sqlMahasiswa = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa WHERE email='$_SESSION[email]'");
                        $hasilMahasiswa = mysqli_fetch_array($sqlMahasiswa);
                    ?>
                        <div class="table-responsive mb-4">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td><?php echo $hasilMahasiswa['nama_mahasiswa']; ?></td>
                                        <td rowspan="7"><img src="img/<?php echo $hasilMahasiswa['foto']; ?>" width="150" height="150" class="rounded-2 shadow-sm object-fit-cover d-block ms-auto"></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Nomor Induk Mahasiswa</td>
                                        <td>:</td>
                                        <td><?php echo $hasilMahasiswa['nim']; ?></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Program Studi</td>
                                        <td>:</td>
                                        <td><?php echo $hasilMahasiswa['prodi']; ?></td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Semester</td>
                                        <td>:</td>
                                        <td><?php echo $hasilMahasiswa['semester']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode</th>
                                        <th>Nama Mata Kuliah</th>
                                        <th>SKS</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;

                                    $sqlKRS = "SELECT * FROM tb_mahasiswa, tb_mk, tb_khs 
                                                WHERE tb_mahasiswa.nim=tb_khs.nim 
                                                AND tb_mk.kode_mk=tb_khs.kode_mk 
                                                AND tb_khs.nim='$hasilMahasiswa[nim]' 
                                                AND tb_khs.semester='$hasilMahasiswa[semester]' 
                                                ORDER BY tb_mk.kode_mk ASC";

                                    $queryKRS = mysqli_query($koneksi, $sqlKRS);

                                    while ($hasilKRS = mysqli_fetch_array($queryKRS)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $hasilKRS['kode_mk']; ?></td>
                                            <td><?php echo $hasilKRS['nama_mk']; ?></td>
                                            <td><?php echo $hasilKRS['sks']; ?></td>
                                            <td></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <th colspan="3">Jumlah</th>
                                        <th colspan="2">
                                            <?php
                                            $sqlSKS = "SELECT SUM(sks) AS total FROM tb_mk, tb_khs 
                                                        WHERE tb_mk.kode_mk=tb_khs.kode_mk 
                                                        AND tb_khs.nim='$hasilMahasiswa[nim]'
                                                        AND tb_khs.semester='$hasilMahasiswa[semester]'";

                                            $querySKS = mysqli_query($koneksi, $sqlSKS);

                                            $hasilSKS = mysqli_fetch_array($querySKS);

                                            $jumlah = $hasilSKS['total'];

                                            echo $jumlah . " SKS";
                                            ?>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="row justify-content-center mb-4">
                            <div class="col-7">
                                <div class="text-center">
                                    <div>Mengesahkan</div>
                                    <div class="pb-4">Dosen Wali,</div>
                                    <div class="pt-4 fw-bold text-decoration-underline">Dr. Muhammad Multazam, S.Kom., M.Kom.</div>
                                    <div class="fw-bold">NIK. 01.08.04</div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="text-center">
                                    <div><?= 'Mataram, ' . date('d F Y'); ?></div>
                                    <div class="pb-4">Mahasiswa Yang Bersangkutan,</div>
                                    <div class="pt-4 fw-bold text-decoration-underline"><?= $hasilMahasiswa['nama_mahasiswa']; ?></div>
                                    <div class="fw-bold"><?= 'NIM. ' . $hasilMahasiswa['nim']; ?></div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- Script -->
        <script src="assets/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
<?php
} else {
    echo '<div style="font-family: Arial, Helvetica, sans-serif; font-size: large; text-align: center; color: red; margin-top: 5rem;">
            <h5>Tidak dapat mengakses halaman ini, silahkan login terlebih dahulu. <a href="login.php">LOGIN</a></h5>
        </div>';
}
?>