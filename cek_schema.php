<?php
include 'koneksi.php';
$r = mysqli_query($koneksi, 'DESCRIBE menu');
while($row = mysqli_fetch_assoc($r)) {
    echo $row['Field'] . ' | ' . $row['Type'] . ' | Default: ' . $row['Default'] . PHP_EOL;
}
?>
