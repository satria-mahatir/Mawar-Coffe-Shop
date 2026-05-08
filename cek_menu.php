<?php
include 'koneksi.php';

// Cek menu dengan harga_ice
echo "=== MENU DENGAN HARGA ICE ===\n";
$result = mysqli_query($koneksi, "SELECT nama_menu, harga, harga_ice FROM menu WHERE harga_ice IS NOT NULL AND harga_ice > 0 ORDER BY id_menu DESC");
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['nama_menu'] . " - Hot: Rp" . number_format($row['harga']) . " - Ice: Rp" . number_format($row['harga_ice']) . "\n";
}

echo "\n=== MENU TANPA HARGA ICE ===\n";
$result2 = mysqli_query($koneksi, "SELECT nama_menu, harga FROM menu WHERE harga_ice IS NULL OR harga_ice = 0 ORDER BY id_menu DESC");
while ($row = mysqli_fetch_assoc($result2)) {
    echo $row['nama_menu'] . " - Harga: Rp" . number_format($row['harga']) . "\n";
}
?>