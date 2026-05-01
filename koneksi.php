<?php
$host     = "localhost"; 
$user     = "root";      
$password = "";          
$db       = "db_warkop_mawar"; 

// Bikin koneksi
$koneksi = mysqli_connect($host, $user, $password, $db);

// Ngecek koneksi jalan apa ngga
if (!$koneksi) {
    die("Koneksi gagal brok: " . mysqli_connect_error());
} 
// echo-nya udah dihapus biar webnya rapi lagi
?>