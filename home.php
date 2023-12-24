 <!-- Content -->
 <div class="card">
     <div class="card-header text-bg-primary fw-medium">
         BERANDA
     </div>
     <div class="card-body">
         <h5 class="card-title mb-4">Hallo, <?= $_SESSION['nama_lengkap']; ?>!</h5>

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
                             <td rowspan="7"><img src="img/<?php echo $hasilMahasiswa['foto']; ?>" width="150" height="150" class="rounded-2 shadow-sm object-fit-cover"></td>
                         </tr>
                         <tr class="align-middle">
                             <td>Nomor Induk Mahasiswa</td>
                             <td>:</td>
                             <td><?php echo $hasilMahasiswa['nim']; ?></td>
                         </tr>
                         <tr class="align-middle">
                             <td>Email</td>
                             <td>:</td>
                             <td><?php echo $hasilMahasiswa['email']; ?></td>
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
                         <tr class="align-middle">
                             <td>Jenis Kelamin</td>
                             <td>:</td>
                             <td><?php if ($hasilMahasiswa['jenis_kelamin'] == "L") {
                                        echo "Laki-laki";
                                    } else {
                                        echo "Perempuan";
                                    } ?></td>
                         </tr>
                         <tr class="align-middle">
                             <td>Alamat</td>
                             <td>:</td>
                             <td><?php echo $hasilMahasiswa['alamat']; ?></td>
                         </tr>
                     </tbody>
                 </table>
             </div>

             <div class="d-flex gap-2">
                 <a href="?page=mhsprofil&&nim=<?php echo $hasilMahasiswa['nim'] ?>" class="btn btn-primary">Ubah Profil</a>
                 <a href="?page=pwresets" class="btn btn-primary">Ubah Password</a>
             </div>
         <?php } elseif ($_SESSION['level'] == "Dosen") {
                $sqlDosen = mysqli_query($koneksi, "SELECT * FROM tb_dosen WHERE email='$_SESSION[email]'");
                $hasilDosen = mysqli_fetch_array($sqlDosen);
            ?>
             <div class="table-responsive mb-4">
                 <table class="table table-borderless">
                     <tbody>
                         <tr>
                             <td>Nama</td>
                             <td>:</td>
                             <td><?php echo $hasilDosen['nama_dosen']; ?></td>
                             <td rowspan="7"><img src="img/<?php echo $hasilDosen['foto']; ?>" width="150" height="150" class="rounded-2 shadow-sm object-fit-cover"></td>
                         </tr>
                         <tr class="align-middle">
                             <td>Nomor Induk Dosen Nasional</td>
                             <td>:</td>
                             <td><?php echo $hasilDosen['nidn']; ?></td>
                         </tr>
                         <tr class="align-middle">
                             <td>Email</td>
                             <td>:</td>
                             <td><?php echo $hasilDosen['email']; ?></td>
                         </tr>
                         <tr class="align-middle">
                             <td>Program Studi</td>
                             <td>:</td>
                             <td><?php echo $hasilDosen['pendidikan']; ?></td>
                         </tr>
                         <tr class="align-middle">
                             <td>Jenis Kelamin</td>
                             <td>:</td>
                             <td><?php if ($hasilDosen['jenis_kelamin'] == "L") {
                                        echo "Laki-laki";
                                    } else {
                                        echo "Perempuan";
                                    } ?></td>
                         </tr>
                         <tr class="align-middle">
                             <td>Alamat</td>
                             <td>:</td>
                             <td><?php echo $hasilDosen['alamat']; ?></td>
                         </tr>
                     </tbody>
                 </table>
             </div>

             <div class="d-flex gap-2">
                 <a href="?page=dsnprofil&&nidn=<?php echo $hasilDosen['nidn'] ?>" class="btn btn-primary">Ubah Profil</a>
                 <a href="?page=pwresets" class="btn btn-primary">Ubah Password</a>
             </div>
         <?php } elseif ($_SESSION['level'] == "Admin") { ?>
             <p class="card-text mb-4">Selamat datang di Sistem Informasi Akademik Universitas Teknologi Mataram. Kelola informasi penting terkait akademik dengan memilih salah satu opsi di bawah ini:</p>

             <div class="row justify-content-center">
                 <div class="col-md-3 p-2 mb-4">
                     <a href="?page=mhsdata" class="btn btn-primary w-100">Data Mahasiswa</a>
                 </div>
                 <div class="col-md-3 p-2 mb-4">
                     <a href="?page=dsndata" class="btn btn-primary w-100">Data Dosen</a>
                 </div>
                 <div class="col-md-3 p-2 mb-4">
                     <a href="?page=mkdata" class="btn btn-primary w-100">Data Mata Kuliah</a>
                 </div>
                 <div class="col-md-3 p-2 mb-4">
                     <a href="#" class="btn btn-primary w-100">Pengaturan Website</a>
                 </div>
             </div>
         <?php } ?>
     </div>
 </div>
 <!-- End of content -->