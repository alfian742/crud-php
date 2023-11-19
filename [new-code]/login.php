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
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">

    <!-- Fontawesome icons -->
    <link rel="stylesheet" href="../vendor/fontawesome-free/css/all.min.css">
</head>

<body class="bg-light d-flex justify-content-center align-items-center w-100" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card border-0 rounded-4 shadow">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <img src="img/login.svg" alt="Login" class="h-100 w-100 d-none d-lg-block">
                            </div>
                            <div class="col-sm-6">
                                <h4 class="card-title mb-4 text-center fw-bold">LOGIN</h4>
                                <?php
                                include 'connection.php'; // Import file koneksi

                                if (isset($_POST['login'])) {
                                    $email = $_POST['email'];
                                    $password = md5($_POST['password']);

                                    // Sintaks SQL untuk eksekusi login user
                                    $query = mysqli_query($db, "SELECT * FROM tb_user WHERE email='$email' AND password='$password'");
                                    $data = mysqli_fetch_array($query);

                                    if (mysqli_num_rows($query) > 0) {
                                        $_SESSION['email'] = $data['email'];
                                        $_SESSION['level'] = $data['level'];
                                        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
                                        header("Location: beranda.php");
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
                                            <div class="input-group">
                                                <label class="input-group-text" for="email"><i class="fa-solid fa-at"></i></label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email" autofocus required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col">
                                            <div class="input-group">
                                                <label class="input-group-text" for="password"><i class="fa-solid fa-key"></i></label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col">
                                            <button type="submit" name="login" class="btn btn-primary fw-medium w-100">LOGIN</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap js bundle with @popper -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>