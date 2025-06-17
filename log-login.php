<?php require_once 'includes/header.php';
if ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) {
    echo '<script>alert("Maaf, anda tidak dapat mengakses laman ini. Karena anda bukan admin");window.location.replace("dashboard.php");</script>';
}
?>

<main role="main">
    <div class="container-fluid">
        <h4 class="mb-3 text-dark">Log Login</h4>
        <div class="card shadow" style="border-radius: 10px;">
            <div class="card-body">
                <div class="float-left p-1 mb-3" style="padding-bottom:20px;">
                    <a href="javascript:void;" onclick="javascript:window.open('print/log-login.php');" class="btn btn-danger">Print</a>
                </div>
                <div class="table-responsive p-1">
                    <table id="example" class="table table-borderless table-striped" style="width: 100%;">
                        <thead class="text-center">
                            <tr>
                                <td>No</td>
                                <td>Username</td>
                                <td>Waktu Login</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = mysqli_query($connect, "SELECT user.username, userlog.loginTime FROM user, userlog WHERE user.id_user = userlog.id_user");
                            if (mysqli_num_rows($query) > 0) {
                                while ($row = mysqli_fetch_array($query)) {
                            ?>
                                    <tr class="text-center">
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['username'] ?></td>
                                        <td><?= $row['loginTime'] ?></td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="text-center" colspan="6">
                                        <h1>-- Tidak ada data --</h1>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once 'includes/footer.php'; ?>