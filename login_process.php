<?php
session_start();
include '../koneksi.php'; // Pastikan path ini sesuai

// Ambil data input
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Validasi input
if (empty($email) || empty($password)) {
    echo "<script>alert('Email dan password tidak boleh kosong!'); window.history.back();</script>";
    exit;
}

// Cek pengguna di database
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Validasi hasil query
if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verifikasi password
    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user; // Simpan data user di session
        header("Location: ../marketplacelog.html");
        exit;
    } else {
        echo "<script>alert('Password salah!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Email tidak terdaftar!'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
