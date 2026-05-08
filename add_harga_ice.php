<?php
include 'koneksi.php';

// Cek dulu apakah kolom harga_ice sudah ada
$check = mysqli_query($koneksi, "SHOW COLUMNS FROM menu LIKE 'harga_ice'");
if (mysqli_num_rows($check) == 0) {
    // Belum ada, tambahkan
    $sql = "ALTER TABLE menu ADD COLUMN harga_ice INT NULL DEFAULT NULL AFTER harga";
    if (mysqli_query($koneksi, $sql)) {
        echo "✅ Kolom harga_ice berhasil ditambahkan!<br>";
    } else {
        echo "❌ Gagal: " . mysqli_error($koneksi);
    }
} else {
    echo "ℹ️ Kolom harga_ice sudah ada.";
}
?>
