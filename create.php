<?php
include 'koneksi.php';

$is_edit = false;
$data_edit = null;

//Create
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['passwords']);


    if(isset($_POST['id']) && $_POST['id'] != '') {
        $id_to_update = $_POST['id'];
        $query = "UPDATE anggota SET
                    nama = '$nama',
                    email = '$jenis_kelamin',
                    passwords = '$hobi_escaped',
                    ";
    } else {
        $query = "INSERT INTO users (nama, email, passwords)
        values ('$nama', '$email', '$password')";
    }

    if(mysqli_query($koneksi, $query)) {
        header("location: signup.htlm");
        exit;
    } else {
        echo "Error" . mysqli_error($koneksi);
    }
}
?>