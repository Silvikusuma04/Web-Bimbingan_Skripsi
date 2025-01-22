<?php
session_start();
include 'koneksi.php';

// Periksa sesi pengguna
if (!isset($_SESSION['user']) || $_SESSION['user'] != 'dosen') {
    header('Location: ../login.php');
    exit();
}

// Query untuk mengambil semua data surat yang telah dikirim
$query = "SELECT * FROM surat_disposisi";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Surat Mahasiswa - Bimbingan Skripsi</title>
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
                <li class="nav-item active ">
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
                <li class="nav-item ">
                <a class="nav-link" href="lihat_jadwal.php">Lihat Jadwal Bimbingan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Daftar Surat yang Dikirim oleh Mahasiswa</h2>
        <hr>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Subjek</th>
                            <th>File PDF</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . $row['nama_mahasiswa'] . "</td>";
                                echo "<td>" . $row['subjek'] . "</td>";
                                echo "<td><a href='lihat_pdf.php?id=" . $row['id'] . "' target='_blank'>" . $row['file_name'] . "</a></td>";
                                echo "<td>";
                                if ($row['status'] == 1) {
                                    echo "<span class='badge badge-success'>Telah Diterima</span>";
                                } else {
                                    echo "<a href='ubah-status.php?id=" . $row['id'] . "' class='btn btn-success btn-sm'>Tandai Telah Diterima</a>";
                                }
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Belum ada surat yang dikirim.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <footer style="text-align: center;">
  Copyright 2024 Silvi Kusuma Wardhani Gunawan
</footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
