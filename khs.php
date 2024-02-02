 <!-- Content -->
 <div class="card">
     <div class="card-header text-bg-primary fw-medium">
         KHS
     </div>
     <div class="card-body">
         <?php
            include 'koneksi.php';

            if ($_SESSION['level'] == "Mahasiswa") {
                $sqlMahasiswa = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa WHERE email='$_SESSION[email]'");
                $hasilMahasiswa = mysqli_fetch_array($sqlMahasiswa);
            ?>

             <div class="row justify-content-center mb-5">
                 <div class="col-lg-6">
                     <form action="" method="POST">
                         <div class="input-group">
                             <label class="input-group-text bg-white border-0" for="filterSemester">Pilih Semester</label>
                             <select class="form-select rounded-start" id="filterSemester" name="semester">
                                 <option value="1">1</option>
                                 <option value="2">2</option>
                                 <option value="3">3</option>
                                 <option value="4">4</option>
                                 <option value="5">5</option>
                                 <option value="6">6</option>
                                 <option value="7">7</option>
                                 <option value="8">8</option>
                             </select>
                             <button class="btn btn-primary" type="submit" name="filter_semester">Tampilkan</button>
                         </div>
                     </form>
                 </div>
             </div>

             <?php
                if (isset($_POST['filter_semester'])) {
                    $semester = $_POST['semester'];
                ?>
                 <h5 class="card-title text-center mb-4">KARTU HASIL STUDI</h5>

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
                                 <td><?php echo $semester; ?></td>
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
                                            AND tb_khs.semester='$semester' 
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
                                                    AND tb_khs.semester='$semester'";

                                        $querySKS = mysqli_query($koneksi, $sqlSKS);

                                        $hasilSKS = mysqli_fetch_array($querySKS);

                                        $jumlahSKS = isset($hasilSKS['total']) ? $hasilSKS['total'] : 0;

                                        echo $jumlahSKS . " SKS";
                                        ?>
                                 </th>
                                 <th><?php echo $totalAkumulasiNilai; ?></th>
                             </tr>
                         </tbody>
                     </table>
                 </div>

                 <div class="fw-bold mb-4">
                     <?php
                        if ($jumlahSKS != 0) {
                            $ipk = $totalAkumulasiNilai / $jumlahSKS;
                            echo "Indeks Prestasi Semester Ini = " .  number_format($ipk, 2);
                        } else {
                            echo "Indeks Prestasi Semester Ini = 0.00";
                        }
                        ?>
                 </div>

                 <div class="d-flex justify-content-end gap-2">
                     <a href="khscetak.php?nim=<?php echo $hasilMahasiswa['nim']; ?>&semester=<?php echo $semester; ?>" class="btn btn-warning" target="_blank">Cetak KHS</a>
                 </div>
         <?php
                }
            }
            ?>
     </div>
 </div>
 <!-- End of content -->