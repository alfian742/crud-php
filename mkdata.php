<!-- Content -->
<div class="card">
    <div class="card-header text-bg-primary fw-medium">
        DATA MATA KULIAH
    </div>
    <div class="card-body">
        <h5 class="card-title mb-4">Tabel Data Mata Kuliah</h5>
        <a href="?page=mktambah" class="btn btn-primary mb-4">Tambah</a>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr class="align-middle">
                        <th>Kode MK</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'koneksi.php'; // Import file koneksi

                    // Mengambil semua data dari tabel 
                    $mk = mysqli_query($koneksi, "SELECT * FROM tb_mk");

                    // Melakukan perulangan untuk menampilkan semua data dari tabel
                    while ($hasil = mysqli_fetch_array($mk)) {
                    ?>
                        <tr class="align-middle">
                            <td><?php echo $hasil['kode_mk']; ?></td>
                            <td><?php echo $hasil['nama_mk']; ?></td>
                            <td><?php echo $hasil['sks']; ?></td>
                            <td>
                                <!-- Mengubah dan menghapus data berdasarkan parameter -->
                                <a href="?page=mkubah&&kode_mk=<?php echo $hasil['kode_mk']; ?>" class="btn btn-link">Ubah</a> |
                                <a href="?page=mkhapus&&kode_mk=<?php echo $hasil['kode_mk']; ?>" onclick="return confirm('Data akan dihapus?')" class="btn btn-link">Hapus</a>
                            </td>
                        </tr>
                    <?php }; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End of content -->