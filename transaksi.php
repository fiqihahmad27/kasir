<?php require_once 'includes/header.php';

?>
<main role="main">
    <div class="container-fluid">
        <h4 class="mb-3 text-dark">Transaksi</h4>
        <div class="card shadow" style="border-radius: 10px;">
            <div class="card-body">
                <?php
                if (isset($_SESSION['tambah'])) {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['tambah']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                }
                unset($_SESSION['tambah']);
                if (isset($_SESSION['ulang'])) {
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['ulang']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                }
                unset($_SESSION['ulang']);
                ?>
                <div class="info-data" data-infodata="<?php if (isset($_SESSION['swal'])) {
                                                            echo $_SESSION['swal'];
                                                        }
                                                        unset($_SESSION['swal']); ?>"></div>
                <div class="float-left p-1 mb-3" style="padding-bottom:20px;">
                <?php if ($_SESSION['level'] == 3): ?>
                    <button type="button" class="btn btnnn" data-toggle="modal" data-target="#exampleModal">Tambah</button>
                <?php endif; ?>
                    <a href="javascript:void;" onclick="javascript:window.open('print/transaksi.php');" class="btn btn-danger">Print</a>
                </div>
                <!-- <div class="float-right">
                    <form class="d-none d-sm-inline-block form-inline mw-100 navbar-search" method="get" action="transaksi.php">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Search" name="cari" required>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" name="search">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div> -->
                <div class="table-responsive p-1">
                    <table id="example" class="table table-borderless table-striped" style="width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <td>No</td>
                                <td>Id Transaksi</td>
                                <td>Kasir</td>                                
                                <td>Nama Menu</td>
                                <td>Qty</td>
                                <td>Harga</td>
                                <td>Jumlah</td>
                                <td>Waktu Transaksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_GET['search'])) {
                                $cari = $_GET['cari'];
                                $result = mysqli_query(
                                    $connect,
                                    "SELECT * FROM transaksi
                                    WHERE id_transaksi LIKE '%" . $cari . "%' OR
                                    id_user LIKE '%" . $cari . "%' OR
                                    id_menu LIKE '%" . $cari . "%'        
                                    ORDER BY id_transaksi DESC"
                                );
                            } else {
                                $result = mysqli_query(
                                    $connect,
                                    "SELECT transaksi.id_transaksi, user.username, menu.id_menu, menu.nama_menu, transaksi.qty, transaksi.waktu_transaksi, menu.harga, transaksi.qty*menu.harga AS jumlah FROM menu JOIN transaksi ON transaksi.id_menu=menu.id_menu JOIN user ON transaksi.id_user=user.id_user;"
                                );
                            }
                            $no = 1;
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
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
                                        <!-- <td><a class="btn btn-sm btn-danger" href="php_action/prosesHapusTransaksi.php?id=<?= $row['id_transaksi'] ?>" id="btn-hapus">Hapus</a></td> -->
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <h3>Tidak ada data</h3>
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

<!-- Modal Tambah-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-modal">
                <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="php_action/prosesTambahTransaksi.php" method="post">
                    <div class="form-group">
                        <label for="id_transaksi">Id Transaksi</label>
                        <input name="id_transaksi" type="text" maxlength="5" class="form-control" placeholder="Id Transaksi" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="id_user">Pengguna</label>
                        <!-- <input name="id_user" type="text" class="form-control" placeholder="Id User" autocomplete="off" required> -->
                        <select name="id_user" class="form-control" required>
                            <option value="" readonly selected>Pilih Kasir</option>
                            <?php
                            $menu = mysqli_query($connect, "SELECT * FROM user WHERE level = 3") or die(mysqli_error($connect));
                            while ($id_user = mysqli_fetch_array($menu)) {
                                echo ' <option value="' . $id_user['id_user'] . '">' . $id_user['username'] . '</option> ';
                            }
                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_menu">Nama Menu</label>
                        <select name="id_menu" class="form-control" required>
                            <option value="" readonly selected>Pilih Menu</option>
                            <?php
                            $menu = mysqli_query($connect, "SELECT * FROM menu") or die(mysqli_error($connect));
                            while ($id_menu = mysqli_fetch_array($menu)) {
                                echo ' <option value="' . $id_menu['id_menu'] . '">' . $id_menu['nama_menu'] . '</option> ';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="qty">Jumlah</label>
                        <input name="qty" type="number" maxlength="15" class="form-control" placeholder="Jumlah" autocomplete="off" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btnnn" name="transaksi" type="submit">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>