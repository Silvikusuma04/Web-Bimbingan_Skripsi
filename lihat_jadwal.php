<?php
include 'koneksi.php';

$query = "SELECT * FROM jadwal_bimbingan";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Jadwal Bimbingan - Bimbingan Skripsi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
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
                <li class="nav-item ">
                <a class="nav-link" href="isi_jadwal.php">Isi Jadwal Bimbingan</a>
                </li>
                <li class="nav-item active">
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
            <h1 class="text-center">Lihat Jadwal Bimbingan</h1>
            <hr>
        </div>
    </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Dosen</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Ruangan</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $row['nama_dosen'] . "</td>";
                        echo "<td>" . $row['hari'] . "</td>";
                        echo "<td>" . $row['jam_mulai'] . " - " . $row['jam_selesai'] . "</td>";
                        echo "<td>" . $row['ruangan'] . "</td>";
                        echo "<td>" . $row['keterangan'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Belum ada jadwal bimbingan yang tersedia.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <footer style="text-align: center;">
  Copyright 2024 Silvi Kusuma Wardhani Gunawan
</footer>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
