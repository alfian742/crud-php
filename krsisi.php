 <!-- Content -->
 <div class="card">
     <div class="card-header text-bg-primary fw-medium">
         KRS
     </div>
     <div class="card-body">
         <h5 class="card-title text-center mb-4">KARTU RENCANA STUDI</h5>

         <?php
            include 'koneksi.php';

            if ($_SESSION['level'] == "Mahasiswa") {
                $sql = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa WHERE email='$_SESSION[email]'");
                $data = mysqli_fetch_array($sql);
            ?>
             <div class="table-responsive mb-4">
                 <table class="table table-borderless">
                     <tbody>
                         <tr>
                             <td>Nama</td>
                             <td>:</td>
                             <td><?php echo $data['nama_mahasiswa']; ?></td>
                             <td rowspan="7"><img src="img/<?php echo $data['foto']; ?>" width="150" height="150" class="rounded-2 shadow-sm object-fit-cover d-block ms-auto"></td>
                         </tr>
                         <tr class="align-middle">
                             <td>Nomor Induk Mahasiswa</td>
                             <td>:</td>
                             <td><?php echo $data['nim']; ?></td>
                         </tr>
                         <tr class="align-middle">
                             <td>Program Studi</td>
                             <td>:</td>
                             <td><?php echo $data['prodi']; ?></td>
                         </tr>
                         <tr class="align-middle">
                             <td>Semester</td>
                             <td>:</td>
                             <td><?php echo $data['semester']; ?></td>
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
                             <th>Aksi</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            $i = 1;

                            $sqlKRS = "SELECT * FROM tb_mahasiswa, tb_mk, tb_khs 
                                        WHERE tb_mahasiswa.nim=tb_khs.nim 
                                        AND tb_mk.kode_mk=tb_khs.kode_mk 
                                        AND tb_khs.nim='$data[nim]' 
                                        ORDER BY tb_mk.kode_mk ASC";

                            $queryKRS = mysqli_query($koneksi, $sqlKRS);

                            while ($dt = mysqli_fetch_array($queryKRS)) {
                            ?>
                             <tr>
                                 <td><?= $i++; ?></td>
                                 <td><?= $dt['kode_mk']; ?></td>
                                 <td><?= $dt['nama_mk']; ?></td>
                                 <td><?= $dt['sks']; ?></td>
                                 <td>
                                     <a href="krshapus.php?nim=<?= $data['nim']; ?>&&kode_mk=<?= $dt['kode_mk']; ?>" onclick="return confirm('Data akan dihapus?')">Hapus</a>
                                 </td>
                             </tr>
                         <?php } ?>
                         <tr>
                             <th colspan="3">Jumlah</th>
                             <th colspan="2">
                                 <?php
                                    $sqlSKS = "SELECT SUM(sks) AS total FROM tb_mk, tb_khs 
                                                WHERE tb_mk.kode_mk=tb_khs.kode_mk 
                                                AND tb_khs.semester='$data[semester]'";

                                    $querySKS = mysqli_query($koneksi, $sqlSKS);

                                    $dtSKS = mysqli_fetch_array($querySKS);

                                    $jumlah = $dtSKS['total'];

                                    echo $jumlah . " SKS";
                                    ?>
                             </th>
                         </tr>
                     </tbody>
                 </table>
             </div>

             <div class="d-flex justify-content-end">
                 <a href="#" class="btn btn-primary">Tambah Mata Kuliah</a>
             </div>
         <?php } ?>
     </div>
 </div>
 <!-- End of content -->