<?php
require_once 'db_connect.php';
session_start();

if ($_POST) {
  $id_menu = $_POST['id_menu'];
  $nama_menu = $_POST['nama_menu'];
  $harga = $_POST['harga'];

  $query = mysqli_query($connect, "UPDATE menu SET
    nama_menu = '$nama_menu',
    harga = '$harga'
    WHERE id_menu = '$id_menu'") or die(mysqli_error($connect));
  if ($query) {
    $_SESSION['edit'] = "Data berhasil diedit";
    header('location: ../menu.php');
  } else {
    echo "<script>alert('Error !'); window.location.replace('../menu.php')</script>";
  }
}
