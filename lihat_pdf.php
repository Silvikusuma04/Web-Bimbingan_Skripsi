<?php
include 'koneksi.php';

// Pastikan ada parameter id yang dikirimkan melalui GET
if (!isset($_GET['id'])) {
    echo "Parameter id tidak ditemukan";
    exit;
}

// Ambil nilai id dari parameter GET
$id_surat = $_GET['id'];

// Query untuk mengambil data surat dari database berdasarkan id
$query = "SELECT file_name, file_type, file_content FROM surat_disposisi WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_surat);
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
    header("Content-Disposition: inline; filename='" . $file_name . "'");
    header("Content-Length: " . strlen($file_content));

    // Tampilkan konten PDF
    echo $file_content;
} else {
    echo "Surat tidak ditemukan.";
}

// Tutup statement dan koneksi database
$stmt->close();
$conn->close();
?>
