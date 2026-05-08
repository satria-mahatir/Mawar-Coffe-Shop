<?php
include 'koneksi.php';

$desc = mysqli_query($koneksi, "DESCRIBE menu");
while ($col = mysqli_fetch_assoc($desc)) {
    echo $col['Field'] . " - " . $col['Type'] . "\n";
}
?>
