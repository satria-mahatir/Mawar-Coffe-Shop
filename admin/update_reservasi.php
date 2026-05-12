<?php
require_once '../config/database.php';
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }

if (isset($_GET['id']) && isset($_GET['status'])) {
    if (!isset($_GET['csrf_token']) || $_GET['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF Token Invalid!");
    }
    $id = (int)$_GET['id'];
    $status = $_GET['status'];
    
    // Validasi status
    $allowed_status = ['Pending', 'Dikonfirmasi', 'Selesai'];
    if (in_array($status, $allowed_status)) {
        $stmt = $koneksi->prepare("UPDATE reservasi SET status_reservasi = ? WHERE id_reservasi = ?");
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        $stmt->close();
    }
}
header("Location: reservasi.php#list");
exit;
?>
