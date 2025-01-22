<?php
session_start();
include 'koneksi.php';

// Periksa sesi pengguna
if (!isset($_SESSION['user']) || $_SESSION['user'] != 'dosen') {
    header('Location: ../login.php');
    exit();
}

// Periksa apakah parameter id surat diterima
if (isset($_GET['id'])) {
    $id_surat = $_GET['id'];

    // Update status surat menjadi telah diterima
    $query = "UPDATE surat_disposisi SET status = 1 WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_surat);
    $stmt->execute();

    // Redirect kembali ke halaman lihatsurat.php setelah selesai mengubah status
    header('Location: baca.php');
    exit();
} else {
    // Jika parameter id tidak ditemukan, kembalikan ke halaman lihatsurat.php
    header('Location: baca .php');
    exit();
}

$conn->close();
?>
