<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM balasan_surat WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Balasan tidak ditemukan!";
        exit;
    }

    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_mahasiswa = $_POST['nama_mahasiswa'];
    $subjek = $_POST['subjek'];
    
    $file_uploaded = false;
    if ($_FILES['file']['error'] == 0) {
        $file_name = $_FILES['file']['name'];
        $file_type = $_FILES['file']['type'];
        $file_size = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_content = file_get_contents($file_tmp);

        if ($file_type == 'application/pdf') {
            $file_uploaded = true;
        } else {
            echo "File harus berupa PDF!";
            exit;
        }
    }

    if ($file_uploaded) {
        $query = "UPDATE balasan_surat SET nama_mahasiswa = ?, subjek = ?, file_name = ?, file_type = ?, file_size = ?, file_content = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssbsi", $nama_mahasiswa, $subjek, $file_name, $file_type, $file_size, $file_content, $id);
    } else {
        $query = "UPDATE balasan_surat SET nama_mahasiswa = ?, subjek = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $nama_mahasiswa, $subjek, $id);
    }

    if ($stmt->execute()) {
        echo "Balasan berhasil diupdate!";
        header("Location: lihat-balasan-dosen.php");
        exit;
    } else {
        echo "Gagal mengupdate balasan!";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Balasan - Bimbingan Skripsi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Balasan</h2>
        <form action="edit_balasan.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_mahasiswa">Nama Mahasiswa</label>
                <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" value="<?php echo htmlspecialchars($row['nama_mahasiswa']); ?>" required>
            </div>
            <div class="form-group">
                <label for="subjek">Subjek</label>
                <input type="text" class="form-control" id="subjek" name="subjek" value="<?php echo htmlspecialchars($row['subjek']); ?>" required>
            </div>
            <div class="form-group">
                <label for="file">File PDF (Biarkan kosong jika tidak ingin mengubah)</label>
                <input type="file" class="form-control" id="file" name="file">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Update</button>
        </form>
    </div>
    <footer style="text-align: center; margin-top: 20px;">
        Copyright 2024 Silvi Kusuma Wardhani Gunawan
    </footer>
</body>
</html>
