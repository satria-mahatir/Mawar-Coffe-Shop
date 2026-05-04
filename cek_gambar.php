<?php
include 'koneksi.php';

echo "<h2>Diagnostic Gambar & Menu</h2>";

// 1. Cek Folder images
$folder = 'images/';
if (is_dir($folder)) {
    echo "<p>✅ Folder <b>images/</b> ditemukan.</p>";
    $files = scandir($folder);
    echo "<p>Jumlah file di images/: " . (count($files) - 2) . "</p>";
} else {
    echo "<p>❌ Folder <b>images/</b> TIDAK ditemukan!</p>";
}

// 2. Cek Data di Database
$q = mysqli_query($koneksi, "SELECT kategori, COUNT(*) as jumlah FROM menu GROUP BY kategori");
if ($q) {
    echo "<h3>Data di Tabel Menu:</h3><ul>";
    while ($row = mysqli_fetch_assoc($q)) {
        echo "<li>" . $row['kategori'] . ": " . $row['jumlah'] . " item</li>";
    }
    echo "</ul>";
} else {
    echo "<p>❌ Gagal query tabel menu: " . mysqli_error($koneksi) . "</p>";
}

// 3. Cek Spesifik Gambar Broken
$q2 = mysqli_query($koneksi, "SELECT nama_menu, gambar FROM menu LIMIT 20");
echo "<h3>Cek 20 Gambar Pertama:</h3><table border='1' cellpadding='5'>";
echo "<tr><th>Nama Menu</th><th>Nama File di DB</th><th>Status File</th></tr>";
while ($row = mysqli_fetch_assoc($q2)) {
    $exists = file_exists($folder . $row['gambar']) ? "✅ Ada" : "❌ HILANG";
    echo "<tr><td>{$row['nama_menu']}</td><td>{$row['gambar']}</td><td>$exists</td></tr>";
}
echo "</table>";

echo "<br><p><i>Hapus file ini setelah selesai cek ya brok!</i></p>";
?>
