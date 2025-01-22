<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] != 'mahasiswa') {
    header('Location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - Bimbingan Skripsi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Bimbingan Skripsi</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="mahasiswa.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kirimsurat.php">Kirim Surat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="lihatsurat.php">Lihat Surat</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="lihat-balasan.php">Lihat Balasan</a> 
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="lihat_jadwal_m.php">Lihat Jadwal Bimbingan</a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
    <div class="jumbotron">
        <h1 class="display-4">Selamat datang, Mahasiswa</h1>
        <p class="lead">Di Website Bimbingan Skripsi</p>
        <hr class="my-4">
        <p>Anda dapat mengelola surat, balasan, dan bimbingan skripsi di sini.</p>
        <a class="btn btn-info btn-lg ml-2" href="kirimsurat.php" role="button">Kirim Surat</a>
        <a class="btn btn-info btn-lg ml-2" href="lihatsurat.php" role="button">Lihat Surat</a>
        <a class="btn btn-info btn-lg ml-2" href="lihat-balasan.php" role="button">Lihat Balasan </a>
        <a class="btn btn-info btn-lg ml-2" href="lihat_jadwal.php" role="button">Lihat Jadwal Bimbingan </a>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <footer style="text-align: center;">
         Copyright 2024 Silvi Kusuma Wardhani Gunawan
    </footer>
</body>
</html>
