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
                             <th class="text-center">Aksi</th>
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
                                 <td class="text-center">
                                     <a href="krshapus.php?nim=<?php echo $hasilMahasiswa['nim']; ?>&&semester=<?php echo $hasilMahasiswa['semester']; ?>&&kode_mk=<?php echo $hasilKRS['kode_mk']; ?>" onclick="return confirm('Data akan dihapus?')" class="btn btn-sm btn-warning">Hapus</a>
                                 </td>
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

             <div class="d-flex justify-content-end">
                 <a href="?page=krstambah&&nim=<?php echo $hasilMahasiswa['nim']; ?>" class="btn btn-primary">Tambah Mata Kuliah</a>
             </div>
         <?php } ?>
     </div>
 </div>
 <!-- End of content -->