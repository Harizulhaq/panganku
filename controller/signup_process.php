<?php
include 'koneksi.php'; // sesuaikan path jika file koneksi berada di luar folder ini

// Ambil input
$nama = $_POST['nama'] ?? '';
$email = $_POST['email'] ?? '';
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Validasi sederhana
if (empty($email)) {
    echo "<script>alert('Email tidak boleh kosong'); window.history.back();</script>";
    exit;
}

if (strlen($password) < 8) {
    echo "<script>alert('Password minimal 8 karakter'); window.history.back();</script>";
    exit;
}

// Cek apakah email sudah digunakan
$cek = $koneksi->query("SELECT * FROM users WHERE email = '$email'");
if ($cek->num_rows > 0) {
    echo "<script>alert('Email sudah digunakan!'); window.history.back();</script>";
    exit;
}

// Masukkan ke database
$sql = "INSERT INTO users (nama, email, password) VALUES ('$nama', '$email', '$password')";
if ($koneksi->query($sql) === TRUE) {
    header("Location: ../sign.html");
    exit;
} else {
    echo "<script>alert('Gagal menyimpan data!'); window.history.back();</script>";
}
?>