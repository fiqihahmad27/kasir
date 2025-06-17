<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <title>Log Login</title>
</head>

<body onload="window.print();">
    <div class="container">
        <h1 class="text-center">Log Login</h1>
        <table class="table table-bordered table-striped">
            <thead class="text-center">
                <tr>
                    <td>No</td>
                    <td>Username</td>
                    <td>Waktu Login</td>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once '../php_action/db_connect.php';
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
</body>


<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>


</html>