<?php

$server = 'localhost';
$user = 'root';
$password = '';
$dbname = 'panganku';

$koneksi = mysqli_connect($server, $user, $password, $dbname);

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli.connect_error());
}
?>