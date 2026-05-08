<?php
include 'koneksi.php';

echo "=== Setting Up Google Maps Configuration ===\n\n";

// First, check if table has data
$check = mysqli_query($koneksi, "SELECT COUNT(*) as cnt FROM pengaturan_web");
$row = mysqli_fetch_assoc($check);
$has_data = $row['cnt'] > 0;

// Google Maps Embed URLs for Bondowoso, Warkop Mawar
$maps_url = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3939.9570815843236!2d113.8136714!3d-7.2259827!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6c1e0b8f0c0cd%3A0xbf5e0c1d2e3f4g5h!2sWarkop%20Mawar%20Bondowoso!5e0!3m2!1sid!2sid!4v1746000000";
$instagram_url = "https://www.instagram.com/warkopmawar_/";
$tiktok_url = "https://www.tiktok.com/@warkopmawar_";

if ($has_data) {
    // Update existing record
    echo "Updating existing pengaturan_web record...\n\n";
    $update = mysqli_query($koneksi, "UPDATE pengaturan_web SET 
        link_maps = '" . mysqli_real_escape_string($koneksi, $maps_url) . "',
        link_ig = '" . mysqli_real_escape_string($koneksi, $instagram_url) . "',
        link_tiktok = '" . mysqli_real_escape_string($koneksi, $tiktok_url) . "'
    ");
    
    if ($update) {
        echo "✅ Updated pengaturan_web successfully!\n";
    } else {
        echo "❌ Update failed: " . mysqli_error($koneksi) . "\n";
    }
} else {
    // Insert new record
    echo "Inserting new pengaturan_web record...\n\n";
    $insert = mysqli_query($koneksi, "INSERT INTO pengaturan_web (id_pengaturan, link_maps, link_ig, link_tiktok) VALUES (
        1,
        '" . mysqli_real_escape_string($koneksi, $maps_url) . "',
        '" . mysqli_real_escape_string($koneksi, $instagram_url) . "',
        '" . mysqli_real_escape_string($koneksi, $tiktok_url) . "'
    )");
    
    if ($insert) {
        echo "✅ Inserted pengaturan_web successfully!\n";
    } else {
        echo "❌ Insert failed: " . mysqli_error($koneksi) . "\n";
    }
}

echo "\n" . str_repeat("=", 70) . "\n";
echo "Configuration Saved:\n";
echo str_repeat("=", 70) . "\n";
echo "📍 Maps: Google Maps Embed (Bondowoso)\n";
echo "📷 Instagram: https://www.instagram.com/warkopmawar_/\n";
echo "🎵 TikTok: https://www.tiktok.com/@warkopmawar_\n\n";

// Verify
$verify = mysqli_query($koneksi, "SELECT * FROM pengaturan_web LIMIT 1");
if ($verify && mysqli_num_rows($verify) > 0) {
    $data = mysqli_fetch_assoc($verify);
    echo "✅ Verification: pengaturan_web now contains " . mysqli_num_rows($verify) . " record(s)\n";
}

mysqli_close($koneksi);
?>
