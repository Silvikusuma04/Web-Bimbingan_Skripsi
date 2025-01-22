<?php
include 'koneksi.php';

// Pastikan ada parameter id_balasan yang dikirimkan melalui GET
if (!isset($_GET['id_balasan'])) {
    echo "Parameter id_balasan tidak ditemukan";
    exit;
}

// Ambil nilai id_balasan dari parameter GET
$id_balasan = $_GET['id_balasan'];

// Query untuk mengambil data surat dari database berdasarkan id_balasan
$query = "SELECT file_name, file_type, file_content FROM balasan_surat WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_balasan);
$stmt->execute();
$result = $stmt->get_result();

// Pastikan ada hasil dari query
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $file_name = $row['file_name'];
    $file_type = $row['file_type'];
    $file_content = $row['file_content'];

    // Set header agar browser mengenali konten sebagai file PDF
    header("Content-type: application/pdf");
    header("Content-Disposition: inline; filename=\"" . $file_name . "\"");
    header("Content-Length: " . strlen($file_content));

    // Tampilkan konten PDF
    echo $file_content;
} else {
    echo "Surat tidak ditemukan.";
}

$stmt->close();
$conn->close();
?>
