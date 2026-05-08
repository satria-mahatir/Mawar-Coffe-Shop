<?php
session_start();
include 'includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['frontend_csrf_token']) {
        echo json_encode(['status' => 'error', 'message' => 'CSRF Token Invalid']);
        exit;
    }
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_pelanggan']);
    $waktu = mysqli_real_escape_string($koneksi, $_POST['waktu_reservasi']);
    $pesanan = mysqli_real_escape_string($koneksi, $_POST['detail_pesanan']);
    $total_harga = isset($_POST['total_harga']) ? (int)$_POST['total_harga'] : 0;
    
    // Insert into reservasi table with prepared statement
    $stmt = $koneksi->prepare("INSERT INTO reservasi (nama_pelanggan, detail_pesanan, waktu_reservasi, status_reservasi, total_harga) VALUES (?, ?, ?, 'Pending', ?)");
    if ($stmt) {
        $stmt->bind_param("sssi", $nama, $pesanan, $waktu, $total_harga);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => $koneksi->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
