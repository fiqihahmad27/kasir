<?php

$connect = new mysqli("localhost", "root", "", "kasir");

if ($connect->connect_error) {
	die("Koneksi Gagal" . $connect->connect_error);
} else {
	//echo "Koneksi Berhasil";
}
