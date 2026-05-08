<?php
include 'koneksi.php';

echo "=== Checking Google Maps Configuration ===\n\n";

// Get current maps URL from database
$q = mysqli_query($koneksi, "SELECT id_pengaturan, link_maps FROM pengaturan_web LIMIT 1");
$settings = mysqli_fetch_assoc($q);

if (!$settings) {
    echo "❌ ERROR: pengaturan_web table is empty!\n";
    mysqli_close($koneksi);
    exit;
}

echo "Current Maps URL in Database:\n";
echo str_repeat("=", 70) . "\n";
echo $settings['link_maps'] . "\n";
echo str_repeat("=", 70) . "\n\n";

// Check if it's a share link or embed URL
$url = $settings['link_maps'];
$is_share_link = strpos($url, 'maps.app.goo.gl') !== false || 
                 (strpos($url, 'google.com/maps') !== false && strpos($url, '@') !== false);
$is_embed_url = strpos($url, '/maps/embed') !== false;
$is_place_id = strpos($url, 'place_id=') !== false;

echo "URL Analysis:\n";
echo "- Is Share Link: " . ($is_share_link ? "✅ YES (needs conversion)" : "❌ NO") . "\n";
echo "- Is Embed URL: " . ($is_embed_url ? "✅ YES (correct format)" : "❌ NO") . "\n";
echo "- Has Place ID: " . ($is_place_id ? "✅ YES" : "❌ NO") . "\n\n";

// Known location coordinates for Bondowoso, Warkop Mawar
echo "Recommendation:\n";
echo str_repeat("=", 70) . "\n";
echo "For Google Maps embed iframe, use this URL format:\n\n";
echo "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3939.9570815843236!2d113.81366!3d-7.225983!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6c1e0b8f0c0cd%3A0x1234567890ab!2sWarkop%20Mawar!5e0!3m2!1sid!2sid!4v1234567890\n\n";

echo "Or use simplified version:\n";
echo "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3939.96!2d113.8137!3d-7.226!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6c1e0b8f0c0cd%3A0x1234567890ab!2sWarkop%20Mawar!5e0!3m2!1sid!2sid!4v1620000000\n\n";

echo "🔗 Location: Bondowoso, East Java, Indonesia\n";
echo "📍 Coordinates: -7.226 S, 113.814 E\n";

mysqli_close($koneksi);
?>
