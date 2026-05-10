<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Matikan display_errors di semua environment
// Error tetap dicatat ke log server, bukan ditampilkan ke user
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

$host     = "localhost";
$user     = "root";
$password = "";
$db       = "db_warkop_mawar";

$koneksi = mysqli_connect($host, $user, $password, $db);

if (!$koneksi) {
    error_log('Koneksi DB gagal: ' . mysqli_connect_error());
    die("Terjadi kesalahan sistem. Silakan coba lagi.");
}
?>
