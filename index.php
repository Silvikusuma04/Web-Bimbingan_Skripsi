<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    if ($username == 'silvi' && $password == '1234' && $role == 'mahasiswa') {
        $_SESSION['user'] = 'mahasiswa';
        $_SESSION['username'] = $username; // Menyimpan username ke session
        header('Location: mahasiswa.php');
        exit();
    } elseif ($username == 'lulu' && $password == '1234' && $role == 'dosen') {
        $_SESSION['user'] = 'dosen';
        $_SESSION['username'] = $username; // Menyimpan username ke session
        header('Location: dosen.php');
        exit();
    } else {
        echo "Login gagal!";
    }
}
?>
