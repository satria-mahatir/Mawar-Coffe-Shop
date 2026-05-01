<?php
session_start();
include '../koneksi.php';

// Anti-Bypass & Cek Login
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }

// Tentukan link website lu (sesuaikan kalau nanti sudah online/hosting)
// Karena lu pake Laragon, biasanya linknya namafolder.test atau localhost/folder
$link_website = "http://tugas-akhir-mawar.test"; 

// API QR Code (Ukuran 300x300)
$api_qr = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=" . $link_website;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <title>QR Code Menu | Admin Mawar</title>
  <?php include 'includes/header.php'; ?>
  <style>
      @media print {
          .btn, .main-sidebar, .main-header, .main-footer, .content-header { display: none !important; }
          .content-wrapper { margin-left: 0 !important; }
          .no-print { display: none !important; }
          .card { border: none !important; box-shadow: none !important; }
      }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/sidebar.php'; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid"><h1>Cetak QR Code Menu</h1></div>
    </section>

    <section class="content">
      <div class="container-fluid text-center">
        <div class="card card-outline card-orange d-inline-block" style="max-width: 500px;">
          <div class="card-body">
            <h4 class="mb-4">Scan untuk Lihat Menu</h4>
            
            <!-- Tampilan QR Code dari API -->
            <div class="p-4 bg-white border rounded mb-4">
                <img src="<?= $api_qr; ?>" alt="QR Code Warkop Mawar" class="img-fluid">
            </div>

            <p class="text-muted">Link: <code><?= $link_website; ?></code></p>
            <hr>
            <button onclick="window.print()" class="btn btn-primary btn-block no-print" style="background-color: #E8622A; border:none;">
                <i class="fas fa-print"></i> Cetak QR Code
            </button>
            <small class="text-muted mt-2 d-block no-print">Tempelkan cetakan ini di setiap meja pelanggan brok!</small>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
