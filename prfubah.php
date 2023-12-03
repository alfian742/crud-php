<div class="card">
    <div class="card-header text-bg-primary fw-medium">
        PROFIL
    </div>
    <div class="card-body">
        <div class="d-flex gap-2 alig-items-center mb-4">
            <h5 class="card-title my-auto">Ubah Profil</h5>
        </div>

        <?php
        include 'koneksi.php';

        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];

            $profil = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE email='$email'");
            $result = mysqli_fetch_array($profil);
        } else {
            header('Location: beranda.php');
        }

        if (isset($_POST['simpan'])) {
            $nama_lengkap = $_POST['nama_lengkap'];

            if (!empty($_POST['password'])) {
                $password = md5($_POST['password']);
            } else {
                $password = $result['password'];
            }

            $sql = "UPDATE tb_user SET
                    password='$password',
                    nama_lengkap='$nama_lengkap'
                    WHERE email='$email'";
            $query = mysqli_query($koneksi, $sql);

            if ($query) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Profil berhasil diubah.</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            } else {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Profil gagal diubah.</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }
        ?>

        <form action="" method="POST">
            <div class="row mb-3">
                <label for="email" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $result['email']; ?>" disabled required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="nama_lengkap" class="col-sm-4 col-form-label">Nama</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $result['nama_lengkap']; ?>" placeholder="Masukan Nama" autofocus required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="password" class="col-sm-4 col-form-label">Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="password" name="password" value="" placeholder="Masukkan Password Baru">
                </div>
            </div>

            <input type="submit" name="simpan" value="SIMPAN" class="btn btn-primary">
            <a href="beranda.php" class="btn btn-warning">BATAL</a>
        </form>
    </div>
</div>