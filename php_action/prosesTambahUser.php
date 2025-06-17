<?php
require_once 'db_connect.php';
session_start();

if ($_POST) {
	$id_user = $_POST['id_user'];
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$level = $_POST['level'];

	$cek = mysqli_query($connect, "SELECT * FROM user WHERE id_user = '$id_user'");
	if (mysqli_num_rows($cek) > 0) {
		$_SESSION['swal'] = 'tersedia';
		header('location: ../user.php');
	} else {
		$query = mysqli_query($connect, "INSERT INTO user(id_user, username, password, level) VALUES ('$id_user', '$username', '$password', '$level')") or die(mysqli_error($connect));
		if ($query) {
			$_SESSION['tambah'] = "Data berhasil ditambah";
			header('location: ../user.php');
		} else {
			echo "<script>alert ('Error!');
		window.location.replace('../user.php')</script>";
		}
	}
}
