<?php
require_once 'db_connect.php';
session_start();

if ($_POST) {
  $id_user = $_POST['id_user'];
  $username = $_POST['username'];
  $level = $_POST['level'];
  $password = md5($_POST['password']);

  $query = mysqli_query($connect, "UPDATE user SET
    username = '$username',
    level = '$level',
    password = '$password'
    WHERE id_user = '$id_user'") or die(mysqli_error($connect));
  if ($query) {
    $_SESSION['edit'] = "Data berhasil diedit";
    header('location: ../user.php');
  } else {
    echo "<script>alert('Error !'); window.location.replace('../user.php')</script>";
  }
}
