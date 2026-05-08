<?php
// includes/logic.php
session_start();
include 'koneksi.php';

// Generate CSRF Token for Frontend
if (empty($_SESSION['frontend_csrf_token'])) {
    $_SESSION['frontend_csrf_token'] = bin2hex(random_bytes(32));
}

$q_minuman = mysqli_query($koneksi, "SELECT * FROM menu WHERE kategori='minuman' ORDER BY id_menu DESC");
if (!$q_minuman) { die("Error query minuman: " . mysqli_error($koneksi)); }
$minuman_all = [];
while($row = mysqli_fetch_assoc($q_minuman)) { $minuman_all[] = $row; }

$q_makanan = mysqli_query($koneksi, "SELECT * FROM menu WHERE kategori='makanan' ORDER BY id_menu DESC");
if (!$q_makanan) { die("Error query makanan: " . mysqli_error($koneksi)); }
$makanan_all = [];
while($row = mysqli_fetch_assoc($q_makanan)) { $makanan_all[] = $row; }

// ── CAROUSEL ITEMS DINAMIS (UNTUK GALLERY STRIP) ──
$carousel_items = array_merge($minuman_all, $makanan_all);
usort($carousel_items, function($a, $b) {
    return $b['id_menu'] <=> $a['id_menu'];
});
if(count($carousel_items) > 20) { 
    $carousel_items = array_slice($carousel_items, 0, 20); 
}

// ── QUERY DINAMIS UNTUK STATS BERANDA ──
$q_total_menu = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM menu");
$total_menu = mysqli_fetch_assoc($q_total_menu)['total'];

$q_min_harga = mysqli_query($koneksi, "SELECT MIN(harga) as harga_min FROM menu");
$harga_min = mysqli_fetch_assoc($q_min_harga)['harga_min'];

if ($harga_min >= 1000) {
    $harga_display = 'Rp' . round($harga_min / 1000) . 'K';
} else {
    $harga_display = 'Rp' . number_format($harga_min, 0, ',', '.');
}

$q_galeri = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY id_galeri DESC LIMIT 12");
$tentang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tentang WHERE id=1"));
$pengaturan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pengaturan WHERE id=1"));

$q_web = mysqli_query($koneksi, "SELECT * FROM pengaturan_web WHERE id_pengaturan=1");
if(mysqli_num_rows($q_web) > 0) {
    $pengaturan_web = mysqli_fetch_assoc($q_web);
} else {
    $pengaturan_web = ['link_ig' => '#', 'link_tiktok' => '#', 'link_maps' => '#'];
}
?>
