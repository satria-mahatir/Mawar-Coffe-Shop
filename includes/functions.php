<?php
// includes/functions.php
// Berisi semua query pengambilan data untuk halaman utama (index.php)
// Session, CSRF, dan koneksi DB sudah dihandle oleh config/database.php

// ── QUERY MENU (DENGAN CACHE) ──
$cache_file = sys_get_temp_dir() . '/warkop_menu_cache.json';
$cache_ttl = 300; // 5 menit

if (file_exists($cache_file) && (time() - filemtime($cache_file)) < $cache_ttl) {
    // Gunakan Cache
    $menu_data = json_decode(file_get_contents($cache_file), true);
    $minuman_all = $menu_data['minuman'] ?? [];
    $makanan_all = $menu_data['makanan'] ?? [];
} else {
    // Ambil dari Database
    $q_minuman = mysqli_query($koneksi, "SELECT id_menu, nama_menu, deskripsi, harga, harga_ice, gambar, kategori, status FROM menu WHERE kategori='minuman' ORDER BY id_menu DESC");
    if (!$q_minuman) { error_log('DB Error: ' . mysqli_error($koneksi)); die("Terjadi kesalahan sistem."); }
    $minuman_all = [];
    while ($row = mysqli_fetch_assoc($q_minuman)) { $minuman_all[] = $row; }

    $q_makanan = mysqli_query($koneksi, "SELECT id_menu, nama_menu, deskripsi, harga, harga_ice, gambar, kategori, status FROM menu WHERE kategori='makanan' ORDER BY id_menu DESC");
    if (!$q_makanan) { error_log('DB Error: ' . mysqli_error($koneksi)); die("Terjadi kesalahan sistem."); }
    $makanan_all = [];
    while ($row = mysqli_fetch_assoc($q_makanan)) { $makanan_all[] = $row; }

    // Simpan ke Cache
    $menu_data = [
        'minuman' => $minuman_all,
        'makanan' => $makanan_all
    ];
    // Tulis ke file cache
    file_put_contents($cache_file, json_encode($menu_data));
}

// ── CAROUSEL ITEMS DINAMIS (UNTUK GALLERY STRIP) ──
$carousel_items = array_merge($minuman_all, $makanan_all);
usort($carousel_items, function($a, $b) {
    return $b['id_menu'] <=> $a['id_menu'];
});
if (count($carousel_items) > 20) {
    $carousel_items = array_slice($carousel_items, 0, 20);
}

// ── QUERY DINAMIS UNTUK STATS BERANDA ──
$q_stats = mysqli_query($koneksi, "SELECT COUNT(*) as total, MIN(harga) as harga_min FROM menu");
$stats = mysqli_fetch_assoc($q_stats);
$total_menu = $stats['total'];
$harga_min = $stats['harga_min'];

if ($harga_min >= 1000) {
    $harga_display = 'Rp' . round($harga_min / 1000) . 'K';
} else {
    $harga_display = 'Rp' . number_format($harga_min, 0, ',', '.');
}

// ── GALERI, TENTANG, PENGATURAN ──
$q_galeri    = mysqli_query($koneksi, "SELECT id_galeri, judul, gambar FROM galeri ORDER BY id_galeri DESC LIMIT 12");
$tentang     = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tentang WHERE id=1"));
$pengaturan  = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pengaturan WHERE id=1"));

$q_web = mysqli_query($koneksi, "SELECT * FROM pengaturan_web WHERE id_pengaturan=1");
if (mysqli_num_rows($q_web) > 0) {
    $pengaturan_web = mysqli_fetch_assoc($q_web);
} else {
    $pengaturan_web = ['link_ig' => '#', 'link_tiktok' => '#', 'link_maps' => '#'];
}
