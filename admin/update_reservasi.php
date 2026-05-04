<?php
session_start();
include '../koneksi.php';
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = (int)$_GET['id'];
    $status = $_GET['status'];
    
    // Validasi status
    $allowed_status = ['Pending', 'Dikonfirmasi', 'Selesai'];
    if (in_array($status, $allowed_status)) {
        $query = "UPDATE reservasi SET status_reservasi = '$status' WHERE id_reservasi = $id";
        mysqli_query($koneksi, $query);
    }
}
header("Location: reservasi.php");
exit;
?>
