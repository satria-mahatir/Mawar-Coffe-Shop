<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "=== TEST KONEKSI DATABASE ===\n\n";

// Test koneksi
include 'koneksi.php';

if ($koneksi) {
    echo "✓ Koneksi database BERHASIL\n\n";
    
    // Cek database
    $db_selected = mysqli_select_db($koneksi, "db_warkop_mawar");
    if ($db_selected) {
        echo "✓ Database dipilih\n\n";
        
        // Cek tabel menu
        $result = mysqli_query($koneksi, "SHOW TABLES");
        if ($result) {
            echo "Tabel yang ada:\n";
            while ($row = mysqli_fetch_row($result)) {
                echo "  - " . $row[0] . "\n";
            }
        } else {
            echo "✗ Error saat query SHOW TABLES: " . mysqli_error($koneksi) . "\n";
        }
    } else {
        echo "✗ Database tidak ditemukan: " . mysqli_error($koneksi) . "\n";
    }
} else {
    echo "✗ Koneksi GAGAL: " . mysqli_connect_error() . "\n";
}
?>
