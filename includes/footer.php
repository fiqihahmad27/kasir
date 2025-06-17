<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="assets/DataTables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/DataTables/js/dataTables.bootstrap4.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<script src="assets/js/chartJs.js"></script>
<script>
  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });
</script>

<!-- Modal Value Edit Menu -->
<script>
  $(document).on("click", "#ubahModal", function() {
    let id_menu = $(this).data('id_menu');
    let nama_menu = $(this).data('nama_menu');
    let harga = $(this).data('harga');

    $("#id_menu").val(id_menu);
    $("#nama_menu").val(nama_menu);
    $("#harga").val(harga);
  });
</script>

<!-- Modal Value Edit User -->
<script>
  $(document).on("click", "#ubahModalUser", function() {
    let id_user = $(this).data('id_user');
    let username = $(this).data('username');
    let level = $(this).data('level');

    $("#id_user").val(id_user);
    $("#username").val(username);
    $("#level").val(level);
  });
</script>


<!-- Pop Up Konfirmasi Hapus Menu -->
<script>
  $(document).on('click', '#btn-hapus', function(e) {
    e.preventDefault();
    var link = $(this).attr('href');

    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Data yang dihapus tidak dapat dikembalikan!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = link;
      }
    })
  })
</script>

<!-- Pop Up Konfirmasi Hapus User -->
<script>
  $(document).on('click', '#hapusUser', function(e) {
    e.preventDefault();
    var link = $(this).attr('href');

    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Data yang dihapus tidak dapat dikembalikan!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = link;
      }
    })
  })
</script>

<!-- Pop Up Berhasil -->
<script>
  const notifikasi = $('.info-data').data('infodata');

  if (notifikasi == "Dihapus") {
    Swal.fire({
      icon: 'success',
      title: 'Sukses',
      text: 'Data berhasil dihapus'
    })
  } else if (notifikasi == "tersedia") {
    Swal.fire({
      icon: 'error',
      title: 'Maaf Id sudah digunakan',
      text: 'Silahkan gunakan Id yang berbeda'
    })
  }
</script>

<!-- Custom Datatable -->
<script>
  $('#example').dataTable({
    lengthMenu: [5, 10, 25, 50],
    language: {
      paginate: {
        next: '<i class="fas fa-angle-right"></i>',
        previous: '<i class="fas fa-angle-left"></i>'
      },
      "info": "Tampil _START_ sampai _END_ dari _TOTAL_ Data",
      "lengthMenu": "Tampilkan _MENU_ Data",
      "searchPlaceholder": "Cari...",
      "search": '<i class="fas fa-search" style="margin-top:10px;"></i>'
    },
    pageLength: 5
  });
</script>




</body>

<footer style="bottom:0; margin-top: 50px" ;>
  <nav class="navbar navbar-nav navbar-light bg-white shadow">
    <p class="text-center text-muted mt-3">&copy; Copyright 2025 <strong>Fiqih Ahmad</strong>. All Right Reserved.</p>
  </nav>
</footer>


</html>