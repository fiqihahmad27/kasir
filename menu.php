<?php require_once 'includes/header.php';

?>
<main role="main">

  <div class="container-fluid">
    <h4 class="mb-3 text-dark">Menu</h4>
    <div class="card shadow" style="border-radius: 10px;">
      <div class="card-body">
        <?php
        if (isset($_SESSION['tambah'])) {
        ?>
          <div class="alert alert-success alert-dismissible fade show text-dark" role="alert">
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
          <form class="d-none d-sm-inline-block form-inline mw-100 navbar-search" method="get" action="menu.php">
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Search" name="cari" required autocomplete="off">
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
                <td>Id Menu</td>
                <td>Nama Menu</td>
                <td>Harga</td>
                <td>Aksi</td>
              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($_GET['search'])) {
                $cari = $_GET['cari'];
                $result = mysqli_query(
                  $connect,
                  "SELECT * FROM menu
                 WHERE id_menu LIKE '%" . $cari . "%' OR
                 nama_menu LIKE '%" . $cari . "%' OR
                 harga LIKE '%" . $cari . "%'        
                 ORDER BY id_menu DESC"
                );
              } else {
                $result = mysqli_query(
                  $connect,
                  "SELECT * FROM menu"
                );
              }
              $no = 1;
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
              ?>
                  <tr class="text-center">
                    <td><?= $no++ ?></td>
                    <td><?= $row['id_menu'] ?></td>
                    <td><?= $row['nama_menu'] ?></td>
                    <td><?= $row['harga'] ?></td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-sm btn-success text-white" id="ubahModal" data-toggle="modal" data-target="#editModal" data-id_menu="<?= $row['id_menu'] ?>" data-nama_menu="<?= $row['nama_menu'] ?>" data-harga="<?= $row['harga'] ?>">Edit</a>
                        <a class="btn btn-sm btn-danger" href="php_action/prosesHapusMenu.php?id=<?= $row['id_menu'] ?>" id="btn-hapus">Hapus</a>
                      </div>
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
        <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="php_action/prosesTambahMenu.php" method="post">
          <div class="form-group">
            <label for="id_menu" class="text-dark" style="margin-left: 2px;">Id Menu</label>
            <input name="id_menu" type="text" maxlength="5" class="form-control" placeholder="Id Menu" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label for="nama_menu" class="text-dark" style="margin-left: 2px;">Nama Menu</label>
            <input name="nama_menu" type="text" class="form-control" placeholder="Nama Menu" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label for="harga" class="m-1 text-dark" style="margin-left: 2px;">Harga</label>
            <input name=" harga" type="number" maxlength="15" class="form-control" placeholder="Harga" autocomplete="off" required>
          </div>
      </div>
      <div class="modal-footer" style="background-color: #eee;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button class="btn btnnn" name="tambahMenu" type="submit">Tambah</button>
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
        <h5 class="modal-title text-white" id="editModalLabel">Edit Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="php_action/prosesEditMenu.php" method="post">
          <div class="form-group">
            <label for="id_menu">Id Menu</label>
            <input name="id_menu" id="id_menu" type="text" readonly maxlength="5" class="form-control" placeholder="Id Menu" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label for="nama_menu">Nama Menu</label>
            <input name="nama_menu" id="nama_menu" type="text" class="form-control" placeholder="Nama Menu" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label for="harga">Harga</label>
            <input name="harga" id="harga" type="number" maxlength="15" class="form-control" placeholder="Harga" autocomplete="off" required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button class="btn btnnn" name="editMenu" type="submit">Simpan Data</button>
      </div>
      </form>
    </div>
  </div>
</div>