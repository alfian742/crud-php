<!-- Content -->
<div class="card">
    <div class="card-header text-bg-primary fw-medium">
        DATA MAHASISWA
    </div>
    <div class="card-body">
        <h5 class="card-title mb-4">Tabel Data Mahasiswa</h5>
        <a href="?page=mhstambah" class="btn btn-primary mb-4">Tambah</a>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr class="align-middle">
                        <th>Foto</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Program Studi</th>
                        <th>Semester</th>
                        <th>L/P</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'koneksi.php'; // Import file koneksi

                    // Mengambil semua data dari tabel 
                    $mahasiswa = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa");

                    // Melakukan perulangan untuk menampilkan semua data dari tabel
                    while ($hasil = mysqli_fetch_array($mahasiswa)) {
                    ?>
                        <tr class="align-middle">
                            <td>
                                <!-- Menggunakan tag img untuk menampilkan foto -->
                                <img src="img/<?php echo $hasil['foto']; ?>" width="75" height="75" class="rounded-2 shadow-sm object-fit-cover">
                            </td>
                            <td><?php echo $hasil['nim']; ?></td>
                            <td><?php echo $hasil['nama_mahasiswa']; ?></td>
                            <td><?php echo $hasil['prodi']; ?></td>
                            <td><?php echo $hasil['semester']; ?></td>
                            <td><?php echo $hasil['jenis_kelamin']; ?></td>
                            <td>
                                <div class="d-flex gap-1 align-items-center">
                                    <a href="?page=mhsubah&&nim=<?php echo $hasil['nim']; ?>" class="btn btn-link">Ubah</a> |
                                    <a href="?page=mhshapus&&nim=<?php echo $hasil['nim']; ?>" onclick="return confirm('Data akan dihapus?')" class="btn btn-link">Hapus</a> |
                                    <a href="?page=pwreset&&email=<?php echo $hasil['email']; ?>" class="btn btn-link">Reset Password</a>
                                </div>
                            </td>
                        </tr>
                    <?php }; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End of content -->