<?php
require_once 'config/database.php';

// Menghindari browser caching agar status menu ter-update real-time
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: application/json');

$query = mysqli_query($koneksi, "SELECT id_menu, status FROM menu");
$status_map = [];
if ($query) {
    while ($row = mysqli_fetch_assoc($query)) {
        $status_map[$row['id_menu']] = $row['status']; // 'tersedia' atau 'habis'
    }
}

echo json_encode($status_map);
?>
