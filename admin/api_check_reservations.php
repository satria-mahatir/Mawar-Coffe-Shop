<?php
require_once '../config/database.php';

// Menghindari browser caching agar datanya ter-update real-time
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: application/json');

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// Ambil jumlah total reservasi
$query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM reservasi");
$data = mysqli_fetch_assoc($query);

echo json_encode([
    'total' => (int)($data['total'] ?? 0)
]);
?>
