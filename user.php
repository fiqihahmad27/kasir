<?php require_once 'includes/header.php';

?>
<main role="main">
    <div class="container-fluid">
        <h4 class="mb-3 text-dark">User</h4>
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
                if (isset($_SESSION['edit'])) {
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['edit']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                }
                unset($_SESSION['edit']);
                ?>
                <div class="info-data" data-infodata="<?php if (isset($_SESSION['swal'])) {
                                                            echo $_SESSION['swal'];
                                                        }
                                                        unset($_SESSION['swal']); ?>"></div>
                <div class="float-left p-1 mb-3" style="padding-bottom:20px;">
                    <button type="button" class="btn btnnn" data-toggle="modal" data-target="#exampleModal">Tambah</button>
                </div>
                <!-- <div class="float-right">
                    <form class="d-none d-sm-inline-block form-inline mw-100 navbar-search" method="get" action="user.php">
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
                                <td>Id User</td>
                                <td>Username</td>
                                <td>Role</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_GET['search'])) {
                                $cari = $_GET['cari'];
                                $result = mysqli_query(
                                    $connect,
                                    "SELECT * FROM user
                                    WHERE id_user LIKE '%" . $cari . "%' OR
                                    username LIKE '%" . $cari . "%' OR
                                    level LIKE '%" . $cari . "%'        
                                    ORDER BY id_user DESC"
                                );
                            } else {
                                $result = mysqli_query(
                                    $connect,
                                    "SELECT * FROM user"
                                );
                            }
                            $no = 1;
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                            ?>
                                    <tr class="text-center">
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['id_user'] ?></td>
                                        <!--Kode-->
                                        <td><?= $row['username'] ?></td>

                                        <!--Nama-->
                                        <td><?php
                                            if ($row['level'] == 1) {
                                                echo "Administrator";
                                            }
                                            if ($row['level'] == 2) {
                                                echo "Manajer";
                                            }
                                            if ($row['level'] == 3) {
                                                echo "Kasir";
                                            }
                                            ?></td>
                                        <!--Alamat-->
                                        <td>
                                            <?php
                                            if ($row['level'] == 1) {
                                            ?>
                                                <div class="btn btn-group">
                                                    <button class="btn btn-sm btnnn"><i class="fa fa-fw fa-user-lock"></i> Administrator</button>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="btn-group">
                                                    <a class="btn btn-sm btn-success text-white" id="ubahModalUser" data-toggle="modal" data-target="#editModal" data-id_user="<?= $row['id_user'] ?>" data-username="<?= $row['username'] ?>" data-level="<?= $row['level'] ?>">Edit</a>
                                                    <a class="btn btn-sm btn-danger" href="php_action/prosesHapusUser.php?id=<?= $row['id_user'] ?>" id="hapusUser">Hapus</a>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </td>
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
                <h5 class="modal-title text-white" id="exampleModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="php_action/prosesTambahUser.php" method="post">
                    <div class="form-group">
                        <label for="id_user">Id User</label>
                        <input name="id_user" type="text" maxlength="5" class="form-control" placeholder="Id User" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input name="username" type="text" class="form-control" placeholder="Username" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" maxlength="15" class="form-control" placeholder="Password" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select name="level" class="form-control" required>
                            <option value="" readonly selected>Level</option>
                            <option value="2">Manajer</option>
                            <option value="3">Kasir</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btnnn" name="tambahUser" type="submit">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title text-white" id="editModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="php_action/prosesEditUser.php" method="post">
                    <div class="form-group">
                        <label for="id_user">Id User</label>
                        <input name="id_user" id="id_user" value="<?= $row['id_user'] ?>" type="text" readonly maxlength="5" class="form-control" placeholder="Id User" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input name="username" id="username" value="<?= $row['username'] ?>" type="text" class="form-control" placeholder="Username" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select name="level" id="level" class="form-control" required>
                            <option value="" readonly selected>- Level -</option>
                            <option value="2">Manajer</option>
                            <option value="3">Kasir</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" maxlength="15" class="form-control" placeholder="Password" autocomplete="off" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary" name="editUser" type="submit">Simpan Data</button>
            </div>
            </form>
        </div>
    </div>
</div>