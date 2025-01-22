<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus surat berdasarkan ID
    $query = "DELETE FROM surat_disposisi WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Surat berhasil dihapus!";
    } else {
        echo "Gagal menghapus surat!";
    }

    $stmt->close();
} else {
    echo "ID surat tidak diberikan.";
}

$conn->close();
header("Location: lihatsurat.php");
exit;
?>
