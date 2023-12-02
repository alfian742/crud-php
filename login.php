<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD</title>

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center mt-5">
            <div class="col-md-4">
                <div class="card">
                    <h4 class="card-header bg-transparent fw-medium text-center">
                        SILAHKAN <span class="text-primary">LOGIN</span>
                    </h4>
                    <div class="card-body">
                        <?php
                        include 'koneksi.php'; // Import file koneksi

                        if (isset($_POST['login'])) {
                            $email = $_POST['email'];
                            $password = md5($_POST['password']);

                            // Sintaks SQL untuk eksekusi login user
                            $sql = "SELECT * FROM tb_user WHERE email='$email' AND password='$password'";
                            $query = mysqli_query($koneksi, $sql);
                            $data = mysqli_fetch_array($query);
                            $row = mysqli_num_rows($query);

                            if ($row > 0) {
                                $_SESSION['email'] = $data['email'];
                                $_SESSION['level'] = $data['level'];
                                $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
                                header('Location: beranda.php');
                            } else {
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Email atau Password salah!</strong> Silahkan coba kembali.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                            }
                        }
                        ?>

                        <form action="" method="POST">
                            <div class="row mb-4">
                                <div class="col">
                                    <input type="email" class="form-control" name="email" placeholder="Ketik Email">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col">
                                    <input type="password" class="form-control" name="password" placeholder="Ketik Password">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col">
                                    <input type="submit" name="login" value="LOGIN" class="btn btn-primary w-100">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>