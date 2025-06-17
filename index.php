<?php require_once 'php_action/do_login.php';
if (isset($_SESSION['id_user'])) {
    echo '<script>alert("Maaf, anda tidak dapat mengakses laman ini. Karena sudah login coba untuk logout untuk mengaksesnya");window.location.replace("dashboard.php");</script>';
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/kopi.png" type="image/x-icon">

</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card o-hidden border-0 shadow-lg" style="margin-top: 16px;">
                    <div class="card-body p-0">
                        <div class="row justify-content-center">
                            <div class="col-lg-7 d-none d-lg-block">
                                <img class="col-lg p-0" src="https://img.freepik.com/free-vector/coffee-pattern-background_1215-608.jpg?t=st=1647746058~exp=1647746658~hmac=fb512e025f96eb72d83424225c966a447fbf3c205f56b82bd28fce09b1f42cca&w=740" alt="">
                            </div>
                            <div class="col-lg-5">
                                <div class="p-5">
                                    <div class="text-center" style="margin-top: 110px;">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                        <?php
                                        if (isset($_SESSION['success'])) {
                                        ?>
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <?= $_SESSION['success'] ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <?php
                                        }
                                        unset($_SESSION['success']);
                                        if (isset($_SESSION['danger'])) {
                                        ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <?= $_SESSION['danger'] ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <?php
                                        }
                                        unset($_SESSION['danger']);
                                        ?>
                                    </div>
                                    <form role="form" action="index.php" method="POST">
                                        <div class="form-group">
                                            <input class="form-control" style="border-radius: 10rem;" id="username" placeholder="Username" name="username" type="text" autofocus autocomplete="off" required>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" style="border-radius: 10rem;" id="password" placeholder="Password" name="password" type="password" required>
                                        </div>
                                        <input type="submit" class="btn btnnn btn-block" style="border-radius: 10rem;" name="submit" value="Login">
                                    </form>
                                    <div class="mt-5">
                                        <hr>
                                    </div>
                                    <footer>
                                        <p class="text-center text-muted mt-3">&copy; Copyright 2025 <strong>Fiqih Ahmad</strong>. All Right Reserved.</p>
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

</html>