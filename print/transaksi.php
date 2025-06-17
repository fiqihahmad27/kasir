<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <title>Laporan Transaksi Starback</title>
</head>

<body onload="window.print();">
    <div class="container">
        <h1 class="text-center">Laporan Transaksi Starback</h1>
        <table class="table table-bordered table-striped">
            <thead class="text-center">
                <tr>
                    <td>No</td>
                    <td>Id Transaksi</td>
                    <td>Id User</td>
                    <td>Nama Menu</td>
                    <td>Qty</td>
                    <td>Harga</td>
                    <td>Jumlah</td>
                    <td>Waktu Transaksi</td>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once '../php_action/db_connect.php';
                $no = 1;
                $query = mysqli_query($connect, "SELECT transaksi.id_transaksi, user.username, menu.id_menu, menu.nama_menu, transaksi.qty, transaksi.waktu_transaksi, menu.harga, transaksi.qty*menu.harga AS jumlah FROM menu JOIN transaksi ON transaksi.id_menu=menu.id_menu JOIN user ON transaksi.id_user=user.id_user;");
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_array($query)) {
                ?>
                        <tr class="text-center">
                            <td><?= $no++ ?></td>
                            <td><?= $row['id_transaksi'] ?></td>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['nama_menu'] ?></td>
                            <td><?= $row['qty'] ?></td>
                            <td><?= $row['harga'] ?></td>
                            <td><?= $row['jumlah'] ?></td>
                            <td><?= $row['waktu_transaksi'] ?></td>
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