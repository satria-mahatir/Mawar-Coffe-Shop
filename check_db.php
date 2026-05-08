<?php
// Sangat simple, test koneksi saja
$conn = mysqli_connect('localhost', 'root', '');

if (!$conn) {
    echo "KONEKSI GAGAL: " . mysqli_connect_error();
    exit;
}

// Cek database
$result = mysqli_query($conn, "SHOW DATABASES LIKE 'db_warkop_mawar'");
$row = mysqli_fetch_row($result);

if ($row) {
    echo "✓ Database ada\n";
    
    // Cek tabel
    mysqli_select_db($conn, 'db_warkop_mawar');
    $tables = mysqli_query($conn, "SHOW TABLES");
    $table_count = mysqli_num_rows($tables);
    echo "✓ Tabel ditemukan: " . $table_count;
} else {
    echo "✗ DATABASE TIDAK ADA! Perlu dibuat di phpMyAdmin terlebih dahulu.\n";
    echo "Atau jalankan SQL ini di phpMyAdmin:\n";
    echo "CREATE DATABASE db_warkop_mawar;";
}
?>
