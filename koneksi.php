<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "uas"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>
