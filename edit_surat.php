<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM surat_disposisi WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Surat tidak ditemukan!";
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
        // Update file PDF dan juga informasi teks di database
        $query = "UPDATE surat_disposisi SET nama_mahasiswa = ?, subjek = ?, file_name = ?, file_type = ?, file_size = ?, file_content = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssbsi", $nama_mahasiswa, $subjek, $file_name, $file_type, $file_size, $file_content, $id);
    } else {
        $query = "UPDATE surat_disposisi SET nama_mahasiswa = ?, subjek = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $nama_mahasiswa, $subjek, $id);
    }

    if ($stmt->execute()) {
        echo "Surat berhasil diupdate!";
        header("Location: lihatsurat.php");
        exit;
    } else {
        echo "Gagal mengupdate surat!";
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
    <title>Edit Surat - Bimbingan Skripsi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h3>Edit Surat</h3>
                    </div>
                    <div class="card-body">
                        <form action="edit_surat.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
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
                            <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
