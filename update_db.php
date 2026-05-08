<?php
include 'koneksi.php';

// Add total_harga to reservasi
$q1 = mysqli_query($koneksi, "ALTER TABLE reservasi ADD COLUMN total_harga INT(11) DEFAULT 0");
if ($q1) { echo "Berhasil tambah total_harga di reservasi\n"; } else { echo "Gagal/Sudah ada: " . mysqli_error($koneksi) . "\n"; }

// Add video columns to tentang
$video_cols = [
    'video_1' => 'vidio-2.webm',
    'video_2' => 'vidio-1.webm',
    'video_3' => 'vidio-3.webm',
    'video_4' => 'vidio-4.webm',
    'video_5' => 'vidio-5.webm',
    'video_6' => 'vidio-6.webm'
];

foreach ($video_cols as $col => $default) {
    $q = mysqli_query($koneksi, "ALTER TABLE tentang ADD COLUMN $col VARCHAR(255) DEFAULT '$default'");
    if ($q) { echo "Berhasil tambah $col di tentang\n"; } else { echo "Gagal/Sudah ada $col: " . mysqli_error($koneksi) . "\n"; }
}

echo "Selesai.\n";
?>
