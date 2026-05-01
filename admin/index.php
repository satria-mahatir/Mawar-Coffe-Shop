<?php
session_start();
include '../koneksi.php';

// Prevent browser caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// PENTING: Cek kalau belum login, tendang balik ke halaman login!
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

// Ambil data buat statistik singkat di dashboard
$total_menu   = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_menu FROM menu"));
$total_galeri = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_galeri FROM galeri"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <title>Dashboard Admin | Warkop Mawar</title>
  <?php include 'includes/header.php'; ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <?php include 'includes/navbar.php'; ?>

  <!-- Sidebar -->
  <?php include 'includes/sidebar.php'; ?>

  <!-- Konten Utama -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">Dashboard</h1>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <!-- BARIS WIDGET STATISTIK -->
        <div class="row">
          <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $total_menu; ?></h3>
                <p>Total Menu</p>
              </div>
              <div class="icon"><i class="fas fa-utensils"></i></div>
              <a href="menu.php" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $total_galeri; ?></h3>
                <p>Foto Galeri</p>
              </div>
              <div class="icon"><i class="fas fa-camera"></i></div>
              <a href="galeri.php" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-12">
            <div class="small-box bg-warning text-white">
              <div class="inner">
                <h3 class="text-white">Edit</h3>
                <p class="text-white">Konten Tentang</p>
              </div>
              <div class="icon"><i class="fas fa-pen"></i></div>
              <a href="tentang.php" class="small-box-footer">Kelola Konten <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-lg-12">
            <div class="card card-outline card-orange">
              <div class="card-body">
                <h5>Selamat datang, <b><?= $_SESSION['username']; ?></b>!</h5>
                <p>Melalui panel ini, anda bisa mengatur seluruh konten website Warkop Mawar secara *real-time*. Gunakan menu di sebelah kiri untuk navigasi.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <footer class="main-footer">
    <strong>Copyright &copy; 2026 Warkop Mawar.</strong> Dibuat oleh Tama.
  </footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>