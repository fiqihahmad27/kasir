<?php
require_once 'db_connect.php';

session_start();

if ($_POST) {
	$id_menu = $_POST['id_menu'];
	$nama_menu = $_POST['nama_menu'];
	$harga = $_POST['harga'];

	$cek = mysqli_query($connect, "SELECT * FROM menu WHERE id_menu = '$id_menu'");
	if (mysqli_num_rows($cek) > 0) {
		$_SESSION['swal'] = 'tersedia';
		header('location: ../menu.php');
	} else {
		$query = mysqli_query($connect, "INSERT INTO menu(id_menu, nama_menu, harga) VALUES ('$id_menu', '$nama_menu', '$harga')") or die(mysqli_error($connect));
		if ($query) {
			$_SESSION['tambah'] = "Data berhasil ditambah";
			header('location: ../menu.php');
		} else {
			echo "<script>alert ('Error!');
		window.location.replace('../menu.php')</script>";
		}
	}
}
