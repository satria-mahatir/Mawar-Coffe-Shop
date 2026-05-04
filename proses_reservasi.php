<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_pelanggan']);
    $waktu = mysqli_real_escape_string($koneksi, $_POST['waktu_reservasi']);
    $pesanan = mysqli_real_escape_string($koneksi, $_POST['detail_pesanan']);
    
    // Insert into reservasi table
    $query = "INSERT INTO reservasi (nama_pelanggan, detail_pesanan, waktu_reservasi, status_reservasi) 
              VALUES ('$nama', '$pesanan', '$waktu', 'Pending')";
              
    if (mysqli_query($koneksi, $query)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => mysqli_error($koneksi)]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
