<?php
session_start();
header('Content-Type: application/json');
include 'includes/koneksi.php';

// CSRF validation
if (!hash_equals(
    $_SESSION['frontend_csrf_token'] ?? '',
    $_POST['csrf_token'] ?? ''
)) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Request tidak valid']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama        = trim($_POST['nama_pelanggan'] ?? '');
    $pesanan     = trim($_POST['detail_pesanan'] ?? '');
    $waktu       = trim($_POST['waktu_reservasi'] ?? '');
    $total_harga = (int)($_POST['total_harga'] ?? 0);

    // Input validation
    if (empty($nama) || mb_strlen($nama) > 100) {
        echo json_encode(['status' => 'error', 'message' => 'Nama tidak valid']);
        exit;
    }
    if (!preg_match('/^\d{4}-\d{2}-\d{2}[T ]\d{2}:\d{2}/', $waktu)) {
        echo json_encode(['status' => 'error', 'message' => 'Format waktu tidak valid']);
        exit;
    }
    if ($total_harga < 0) {
        echo json_encode(['status' => 'error', 'message' => 'Total harga tidak valid']);
        exit;
    }

    // Prepared statement — no string interpolation
    $stmt = $koneksi->prepare(
        "INSERT INTO reservasi 
         (nama_pelanggan, detail_pesanan, waktu_reservasi, status_reservasi, total_harga)
         VALUES (?, ?, ?, 'Pending', ?)"
    );

    if ($stmt) {
        $stmt->bind_param("sssi", $nama, $pesanan, $waktu, $total_harga);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            error_log('Reservasi DB error: ' . $stmt->error);
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan reservasi.']);
        }
        $stmt->close();
    } else {
        error_log('Reservasi prepare error: ' . $koneksi->error);
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan reservasi.']);
    }
} else {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method tidak diizinkan']);
}
?>
