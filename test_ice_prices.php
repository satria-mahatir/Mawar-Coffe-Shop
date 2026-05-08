<?php
include 'koneksi.php';

echo "=== Checking Ice Prices in Database ===\n\n";

// Check minuman with ice prices
$q = mysqli_query($koneksi, "SELECT id_menu, nama_menu, harga, harga_ice FROM menu WHERE kategori='minuman' ORDER BY id_menu ASC");

if (!$q) {
    echo "Database Error: " . mysqli_error($koneksi) . "\n";
    exit;
}

echo "MINUMAN WITH ICE PRICES:\n";
echo str_repeat("=", 70) . "\n";

$count = 0;
while($r = mysqli_fetch_assoc($q)) {
    if (!empty($r['harga_ice']) && $r['harga_ice'] > 0) {
        $count++;
        echo $count . ". " . str_pad($r['nama_menu'], 25) . 
             " | Hot: Rp" . str_pad(number_format($r['harga'], 0), 10) . 
             " | Ice: Rp" . number_format($r['harga_ice'], 0) . "\n";
    }
}

echo str_repeat("=", 70) . "\n";

if ($count === 0) {
    echo "\n⚠️  WARNING: Tidak ada minuman dengan harga_ice yang ter-set!\n";
    echo "Tolong tambahkan harga_ice di admin panel untuk beverage tertentu.\n\n";
    echo "SEMUA MINUMAN:\n";
    mysqli_data_seek($q, 0);
    $i = 1;
    while($r = mysqli_fetch_assoc($q)) {
        echo $i . ". " . $r['nama_menu'] . " - Harga: Rp" . number_format($r['harga'], 0) . 
             " | Ice Price: " . (empty($r['harga_ice']) ? "NOT SET" : "Rp" . number_format($r['harga_ice'], 0)) . "\n";
        $i++;
    }
} else {
    echo "\n✅ Total: $count minuman dengan ice price\n";
}

mysqli_close($koneksi);
?>
