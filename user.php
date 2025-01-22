<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];

if ($user === 'mahasiswa') {
    header("Location: mahasiswa.php");
    exit();
} elseif ($user === 'dosen') {
    header("Location: dosen.php");
    exit();
} else {
    echo "Role tidak valid.";
    exit();
}
?>
