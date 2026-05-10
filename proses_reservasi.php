<?php
session_start();

// CSRF check
if (!hash_equals($_SESSION['frontend_csrf_token'] ?? '', $_POST['csrf_token'] ?? '')) {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Request tidak valid']);
    exit;
}

require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Rate limiting: 1 request per 60 detik
    $now = time();
    if (isset($_SESSION['last_reservasi']) && ($now - $_SESSION['last_reservasi']) < 60) {
        http_response_code(429);
        echo json_encode(['status' => 'error', 'message' => 'Tunggu 1 menit sebelum reservasi lagi']);
        exit;
    }
    $_SESSION['last_reservasi'] = $now;

    $nama        = trim($_POST['nama_pelanggan'] ?? '');
    $waktu       = trim($_POST['waktu_reservasi'] ?? '');
    $pesanan     = trim($_POST['detail_pesanan'] ?? '');
    $total_harga = (int)($_POST['total_harga'] ?? 0);

    // Validasi input
    if (empty($nama) || strlen($nama) > 100) {
        echo json_encode(['status' => 'error', 'message' => 'Nama tidak valid']);
        exit;
    }
    if (empty($waktu) || !DateTime::createFromFormat('Y-m-d\TH:i', $waktu)) {
        echo json_encode(['status' => 'error', 'message' => 'Format waktu tidak valid']);
        exit;
    }
    if (strlen($pesanan) > 1000) {
        echo json_encode(['status' => 'error', 'message' => 'Detail pesanan terlalu panjang']);
        exit;
    }

    // Prepared statement — aman dari SQL injection
    $stmt = $koneksi->prepare(
        "INSERT INTO reservasi 
         (nama_pelanggan, detail_pesanan, waktu_reservasi, status_reservasi, total_harga)
         VALUES (?, ?, ?, 'Pending', ?)"
    );
    $stmt->bind_param("sssi", $nama, $pesanan, $waktu, $total_harga);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        error_log('Reservasi DB error: ' . $stmt->error);
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan reservasi']);
    }

    $stmt->close();

} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
