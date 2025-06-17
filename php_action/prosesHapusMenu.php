<?php
require_once 'db_connect.php';
session_start();

$id = $_GET['id'];
$query = mysqli_query($connect, "DELETE FROM menu WHERE id_menu = '$id'") or die(mysqli_error($connect));
if ($query) {
    $_SESSION['swal'] = 'Dihapus';
    echo "<script>document.location.href='../menu.php'</script>";
} else {
    echo "<script>alert('Error ! '); window.location.replace('../menu.php')</script>";
}
