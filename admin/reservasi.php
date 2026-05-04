<?php
session_start();
include '../koneksi.php';
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }

// Fetch reservations
$query = mysqli_query($koneksi, "SELECT * FROM reservasi ORDER BY waktu_order DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <title>Kelola Reservasi | Admin Mawar</title>
  <?php include 'includes/header.php'; ?>
  <style>
    .badge-pending { background-color: #ffc107; color: #000; }
    .badge-dikonfirmasi { background-color: #17a2b8; color: #fff; }
    .badge-selesai { background-color: #28a745; color: #fff; }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/sidebar.php'; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <h1 class="m-0">Kelola Reservasi & Pesanan WA</h1>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card card-outline card-orange">
          <div class="card-header">
            <h3 class="card-title">Daftar Reservasi</h3>
          </div>
          <div class="card-body p-0 table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Pelanggan</th>
                  <th>Waktu Kedatangan</th>
                  <th>Pesanan</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                while($row = mysqli_fetch_assoc($query)) { 
                    $status_class = '';
                    if ($row['status_reservasi'] == 'Pending') $status_class = 'badge-pending';
                    else if ($row['status_reservasi'] == 'Dikonfirmasi') $status_class = 'badge-dikonfirmasi';
                    else if ($row['status_reservasi'] == 'Selesai') $status_class = 'badge-selesai';
                ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><strong><?= htmlspecialchars($row['nama_pelanggan']); ?></strong><br><small class="text-muted">Dibuat: <?= date('d M Y H:i', strtotime($row['waktu_order'])); ?></small></td>
                  <td><?= date('d M Y H:i', strtotime($row['waktu_reservasi'])); ?></td>
                  <td><?= nl2br(htmlspecialchars($row['detail_pesanan'])); ?></td>
                  <td><span class="badge <?= $status_class; ?>"><?= $row['status_reservasi']; ?></span></td>
                  <td>
                    <?php if ($row['status_reservasi'] == 'Pending'): ?>
                        <a href="update_reservasi.php?id=<?= $row['id_reservasi']; ?>&status=Dikonfirmasi" class="btn btn-sm btn-info" title="Konfirmasi Reservasi">Konfirmasi</a>
                    <?php endif; ?>
                    
                    <?php if ($row['status_reservasi'] == 'Pending' || $row['status_reservasi'] == 'Dikonfirmasi'): ?>
                        <a href="update_reservasi.php?id=<?= $row['id_reservasi']; ?>&status=Selesai" class="btn btn-sm btn-success" title="Selesaikan">Selesai</a>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php } ?>
                <?php if(mysqli_num_rows($query) == 0): ?>
                <tr>
                    <td colspan="6" class="text-center">Belum ada reservasi.</td>
                </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
</body>
</html>
