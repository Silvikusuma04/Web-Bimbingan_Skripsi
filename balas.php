<?php
include 'koneksi.php';

$pesan = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_mahasiswa = $_POST['nama_mahasiswa'];
    $subjek = $_POST['subjek'];
    $catatan = $_POST['catatan'];

    if ($_FILES['file']['error'] == 0) {
        $file_name = $_FILES['file']['name'];
        $file_type = $_FILES['file']['type'];
        $file_size = $_FILES['file']['size'];
        $file_content = file_get_contents($_FILES['file']['tmp_name']);

        if ($file_type == 'application/pdf') {
            $query = "INSERT INTO balasan_surat (nama_mahasiswa, subjek, catatan, file_name, file_type, file_size, file_content) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssssss", $nama_mahasiswa, $subjek, $catatan, $file_name, $file_type, $file_size, $file_content);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $pesan = '<div class="alert alert-success" role="alert">Surat berhasil dikirim!</div>';
            } else {
                $pesan = '<div class="alert alert-danger" role="alert">Gagal mengirim surat!</div>';
            }
        } else {
            $pesan = '<div class="alert alert-danger" role="alert">File harus berupa PDF!</div>';
        }
    } else {
        $pesan = '<div class="alert alert-danger" role="alert">Gagal upload file!</div>';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Surat - Bimbingan Skripsi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Ensure this path is correct -->
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Bimbingan Skripsi</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="dosen.php">Dashboard</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="baca.php">Baca Surat Mahasiswa</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="balas.php">Balas Mahasiswa</a>
                </li>
                <li class="nav-item ">
                <a class="nav-link" href="lihat-balasan-dosen.php">Lihat Balasan Terkirim</a>
                </li>
                <li class="nav-item ">
                <a class="nav-link" href="isi_jadwal.php">Isi Jadwal Bimbingan</a>
                </li>
                <li class="nav-item ">
                <a class="nav-link" href="lihat_jadwal.php">Lihat Jadwal Bimbingan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Kirim Surat Balasan</h1>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <?php echo $pesan; ?> 
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama_mahasiswa">Nama Mahasiswa:</label>
                    <input type="text" id="nama_mahasiswa" name="nama_mahasiswa" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="subjek">Subjek:</label>
                    <input type="text" id="subjek" name="subjek" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="catatan">Catatan:</label>
                    <textarea id="catatan" name="catatan" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="file">File PDF:</label>
                    <input type="file" id="file" name="file" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Kirim Surat</button>
            </form>
        </div>
    </div>
</div>
<footer style="text-align: center;">
  Copyright 2024 Silvi Kusuma Wardhani Gunawan
</footer>
</body>
</html>
