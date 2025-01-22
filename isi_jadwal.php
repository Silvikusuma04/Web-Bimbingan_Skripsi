<?php
include 'koneksi.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_dosen = $_POST['nama_dosen'];
    $hari = $_POST['hari'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    $ruangan = $_POST['ruangan'];
    $keterangan = $_POST['keterangan'];

    $query = "INSERT INTO jadwal_bimbingan (nama_dosen, hari, jam_mulai, jam_selesai, ruangan, keterangan) 
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $nama_dosen, $hari, $jam_mulai, $jam_selesai, $ruangan, $keterangan);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $pesan = '<div class="alert alert-success" role="alert">Jadwal bimbingan berhasil disimpan!</div>';
    } else {
        $pesan = '<div class="alert alert-danger" role="alert">Gagal menyimpan jadwal bimbingan!</div>';
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Jadwal Bimbingan - Bimbingan Skripsi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .custom-form {
            max-width: 600px;
            margin: auto;
        }
    </style>
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
            <li class="nav-item">
                <a class="nav-link" href="balas.php">Balas Mahasiswa</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="lihat-balasan-dosen.php">Lihat Balasan Terkirim</a>
            </li>
            <li class="nav-item active">
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
<div class="container mt-4 custom-form">
    <h2>Isi Jadwal Bimbingan</h2>
    <?php echo isset($pesan) ? $pesan : ''; ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="nama_dosen">Nama Dosen:</label>
            <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" required>
        </div>
        <div class="form-group">
            <label for="hari">Hari:</label>
            <input type="text" class="form-control" id="hari" name="hari" required>
        </div>
        <div class="form-group">
            <label for="jam_mulai">Jam Mulai:</label>
            <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
        </div>
        <div class="form-group">
            <label for="jam_selesai">Jam Selesai:</label>
            <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required>
        </div>
        <div class="form-group">
            <label for="ruangan">Ruangan:</label>
            <input type="text" class="form-control" id="ruangan" name="ruangan" required>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan:</label>
            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
    </form>
</div>
</body>
<footer style="text-align: center;">
  Copyright 2024 Silvi Kusuma Wardhani Gunawan
</footer>
</html>
