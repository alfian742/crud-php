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
                    <h5 class="card-title text-center mb-4">KARTU HASIL STUDI</h5>

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
                                        <th>NM</th>
                                        <th>AM</th>
                                        <th>K</th>
                                        <th>AM ⨯ K</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $totalAkumulasiNilai = 0;

                                    $sqlKHS = "SELECT * FROM tb_mahasiswa, tb_mk, tb_khs 
                                        WHERE tb_mahasiswa.nim=tb_khs.nim 
                                        AND tb_mk.kode_mk=tb_khs.kode_mk 
                                        AND tb_khs.nim='$hasilMahasiswa[nim]' 
                                        AND tb_khs.semester='$hasilMahasiswa[semester]' 
                                        ORDER BY tb_mk.kode_mk ASC";

                                    $queryKHS = mysqli_query($koneksi, $sqlKHS);

                                    while ($hasilKHS = mysqli_fetch_array($queryKHS)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $hasilKHS['kode_mk']; ?></td>
                                            <td><?php echo $hasilKHS['nama_mk']; ?></td>
                                            <td><?php echo $hasilKHS['nilai'] ?></td>
                                            <td>
                                                <?php
                                                $angkaMutu = 0;

                                                if ($hasilKHS['nilai'] == "A") {
                                                    $angkaMutu = 4;
                                                } elseif ($hasilKHS['nilai'] == "B") {
                                                    $angkaMutu = 3;
                                                } elseif ($hasilKHS['nilai'] == "C") {
                                                    $angkaMutu = 2;
                                                } elseif ($hasilKHS['nilai'] == "D") {
                                                    $angkaMutu = 1;
                                                } elseif ($hasilKHS['nilai'] == "E") {
                                                    $angkaMutu = 0;
                                                } else {
                                                    $angkaMutu = 0;
                                                }

                                                echo $angkaMutu;
                                                ?>
                                            </td>
                                            <td><?php echo $hasilKHS['sks']; ?></td>
                                            <td>
                                                <?php
                                                $nilaiPerMataKuliah = $angkaMutu * $hasilKHS['sks'];

                                                echo $nilaiPerMataKuliah;

                                                $totalAkumulasiNilai += $nilaiPerMataKuliah;
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <th colspan="5">Jumlah</th>
                                        <th>
                                            <?php
                                            $sqlSKS = "SELECT SUM(sks) AS total FROM tb_mk, tb_khs 
                                                WHERE tb_mk.kode_mk=tb_khs.kode_mk 
                                                AND tb_khs.nim='$hasilMahasiswa[nim]'
                                                AND tb_khs.semester='$hasilMahasiswa[semester]'";

                                            $querySKS = mysqli_query($koneksi, $sqlSKS);

                                            $hasilSKS = mysqli_fetch_array($querySKS);

                                            $jumlahSKS = $hasilSKS['total'];

                                            echo $jumlahSKS . " SKS";
                                            ?>
                                        </th>
                                        <th><?php echo $totalAkumulasiNilai; ?></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mb-4">
                            <?php $ipk = $totalAkumulasiNilai / $jumlahSKS; ?>
                            <p>Indeks Prestasi Semester Ini = <?php echo number_format($ipk, 2); ?></p>
                        </div>

                        <div class="row justify-content-start mb-4">
                            <div class="col-12">
                                <div>
                                    <div><?= 'Mataram, ' . date('d F Y'); ?></div>
                                    <div class="pb-4">Kaprodi,</div>
                                    <div class="pt-4 fw-bold">(SALMAN, S.T., M.TI.)</div>
                                    <div class="fw-bold">NIK. 01.08.04</div>
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