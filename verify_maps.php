<?php
include 'koneksi.php';

// Check if pengaturan_web has data
$q_pengaturan = mysqli_query($koneksi, "SELECT * FROM pengaturan_web LIMIT 1");
$pengaturan_web = mysqli_fetch_assoc($q_pengaturan);

echo "=== Google Maps Configuration Status ===\n\n";

if (!$pengaturan_web) {
    echo "❌ ERROR: No pengaturan_web data!\n";
    exit;
}

echo "Database Record Found:\n";
echo "- ID: " . $pengaturan_web['id_pengaturan'] . "\n";
echo "- Maps URL: " . $pengaturan_web['link_maps'] . "\n";
echo "- Instagram: " . $pengaturan_web['link_ig'] . "\n";
echo "- TikTok: " . $pengaturan_web['link_tiktok'] . "\n\n";

// Test the function
function get_maps_embed_url($maps_link) {
    $default_embed = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.123!2d113.8175745!3d-7.9184921!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6dd629b51be97%3A0x97c4bae4a58b755d!2sWARKOP%20MAWAR!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid";
    
    if(empty($maps_link) || $maps_link == '#') {
        return $default_embed;
    }
    
    if(strpos($maps_link, 'google.com/maps/embed') !== false) {
        return $maps_link;
    }
    
    return $default_embed;
}

$maps_embed_url = get_maps_embed_url($pengaturan_web['link_maps']);

echo "Processed Maps URL:\n";
echo str_repeat("=", 70) . "\n";
echo $maps_embed_url . "\n";
echo str_repeat("=", 70) . "\n\n";

// Check if it's valid for iframe
$is_embed = strpos($maps_embed_url, 'google.com/maps/embed') !== false;
echo "✅ Valid for iframe: " . ($is_embed ? "YES" : "NO") . "\n\n";

// Show HTML preview
echo "Iframe HTML that will be generated:\n";
echo str_repeat("=", 70) . "\n";
echo '<iframe class="google-map-embed" src="' . htmlspecialchars($maps_embed_url) . '" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>' . "\n";
echo str_repeat("=", 70) . "\n";

mysqli_close($koneksi);
?>
