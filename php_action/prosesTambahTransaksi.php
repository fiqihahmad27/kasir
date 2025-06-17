<?php
require_once 'db_connect.php';
session_start();

if ($_POST) {
	$id_transaksi = $_POST['id_transaksi'];
	$id_user = $_POST['id_user'];
	$id_menu = $_POST['id_menu'];
	$qty = $_POST['qty'];

	$cek = mysqli_query($connect, "SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'");
	if (mysqli_num_rows($cek) > 0) {
		$_SESSION['swal'] = 'tersedia';
		header('location: ../transaksi.php');
	} else {
		$query = mysqli_query($connect, "INSERT INTO transaksi(id_transaksi, id_user, id_menu, qty) VALUES ('$id_transaksi', '$id_user', '$id_menu', '$qty')") or die(mysqli_error($connect));
		if ($query) {
			$_SESSION['tambah'] = "Data berhasil ditambah";
			header('location: ../transaksi.php');
		} else {
			echo "<script>alert ('Error!');
		window.location.replace('../transaksi.php')</script>";
		}
	}
}
