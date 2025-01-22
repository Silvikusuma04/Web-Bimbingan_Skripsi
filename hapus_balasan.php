<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM balasan_surat WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Balasan berhasil dihapus!";
    } else {
        echo "Gagal menghapus balasan!";
    }

    $stmt->close();
} else {
    echo "ID balasan tidak diberikan.";
}

$conn->close();

header("Location: lihat-balasan-dosen.php");
exit;
?>
