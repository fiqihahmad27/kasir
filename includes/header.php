<?php 
	require_once 'php_action/db_connect.php'; 
	require_once 'php_action/core.php'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Starback</title>

	<!-- Custom fonts for this template-->
	<link rel="shortcut icon" href="assets/images/kopi.png" type="image/x-icon">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>


	<!-- Custom styles for this template-->
	<link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
	<!-- Datatables -->
	<link rel="stylesheet" type="text/css" href="assets/DataTables/css/dataTables.bootstrap4.min.css" />


</head>

<body id="page-top" style="font-family: nunito;">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #6993FF;">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
				<div class="sidebar-brand-icon rotate-n-15">
					<i class='bx bxs-coffee-togo'></i>
				</div>
				<div class="sidebar-brand-text mx-3">Starback</div>
			</a>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Nav Item - Dashboard -->
			<li class="nav-item ">
				<a class="nav-link" href="dashboard.php">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span></a>
			</li>

			<?php
			if ($_SESSION['level'] == 1) {
			?>
				<!-- Divider -->
				<hr class="sidebar-divider">
				<li class="nav-item ">
					<a class="nav-link" href="user.php">
						<i class="fas fa-fw fa-users"></i>
						<span>User</span></a>
				</li>
				<!-- Divider -->
				<hr class="sidebar-divider d-none d-md-block">

				<li class="nav-item ">
					<a class="nav-link" href="log-login.php">
						<i class="fas fa-fw fa-list"></i>
						<span>Log Login</span></a>
				</li>
			<?php
			} elseif ($_SESSION['level'] == 2) {
			?>
				<!-- Divider -->
				<hr class="sidebar-divider">
				<li class="nav-item ">
					<a class="nav-link" href="menu.php">
						<i class="fas fa-fw fa-clipboard-list"></i>
						<span>Menu</span></a>
				</li>
				<!-- Divider -->
				<hr class="sidebar-divider">
				<li class="nav-item ">
					<a class="nav-link" href="transaksi.php">
						<i class="fas fa-fw fa-chart-bar"></i>
						<span>Transaksi</span></a>
				</li>
			<?php
			} elseif ($_SESSION['level'] == 3) {
			?>
				<!-- Divider -->
				<hr class="sidebar-divider">
				<li class="nav-item ">
					<a class="nav-link" href="transaksi.php">
						<i class="fas fa-fw fa-chart-bar"></i>
						<span>Transaksi</span></a>
				</li>
			<?php
			}
			?>

			<!-- Divider -->
			<hr class="sidebar-divider d-none d-md-block">

		</ul>
		<!-- End of Sidebar -->

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column" style="background-color: #f8f8f8;">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

					<!-- Sidebar Toggler (Sidebar) -->
					<div class=" bg-white mt-2">
						<button class="border-0 bg-white btn-link" id="sidebarToggle"><i class="fa fa-bars"></i></button>
					</div>

					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">

						<div class="topbar-divider d-none d-sm-block"></div>

						<!-- Nav Item - User Information -->
						<li class="nav-item  no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img class="img-profile rounded-circle mr-2 " src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQUGcwDdGLbGiG_tLV-5bN8QlRRI3jLz6LiKA&s">
								<span class="d-none d-lg-inline text-gray-600 small"><?= $_SESSION['username'] ?></span>
							</a>
							<!-- Dropdown - User Information -->
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="logout.php">
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
									Logout
								</a>
							</div>
						</li>

					</ul>

				</nav>
				<!-- End of Topbar -->