<?php
include 'koneksi.php';

// Perbaiki menu yang harga_ice sama dengan harga (tidak masuk akal)
mysqli_query($koneksi, "UPDATE menu SET harga_ice = NULL WHERE harga_ice = harga");

echo "✅ Menu dengan harga ice sama dengan hot sudah diperbaiki\n";

// Tambahkan harga ice untuk menu yang seharusnya punya pilihan ice
// Misalnya kopi dan teh yang biasanya ada versi ice
$menu_yang_perlu_ice = [
    'Americano' => 12000,
    'Americano Orange' => 13000,
    'Vietnam Drip' => 12000,
    'Kopi Susu Dingin' => 10000, // sudah ada
    'Tubruk Arabika' => 10000,
    'Tubruk Robusta' => 8000,
    'Teh' => 5000,
    'Teh Lemon' => 7000,
    'Teh Susu' => 7000,
    'Matcha' => 15000, // sudah ada
];

foreach ($menu_yang_perlu_ice as $nama => $harga_ice) {
    mysqli_query($koneksi, "UPDATE menu SET harga_ice = $harga_ice WHERE nama_menu = '$nama' AND (harga_ice IS NULL OR harga_ice = 0)");
}

echo "✅ Menu yang seharusnya punya pilihan ice sudah ditambahkan\n";
?>