<?php

session_start();
include '../includes/koneksi.php';
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }

// Ambil statistik revenue
$stats_query = mysqli_query($koneksi, "
    SELECT 
        COUNT(*) as total_reservasi,
        COUNT(CASE WHEN status_reservasi='Selesai' THEN 1 END) as reservasi_selesai,
        COUNT(CASE WHEN status_reservasi='Pending' THEN 1 END) as reservasi_pending,
        COUNT(CASE WHEN status_reservasi='Dikonfirmasi' THEN 1 END) as reservasi_dikonfirmasi,
        SUM(CASE WHEN status_reservasi='Selesai' THEN total_harga ELSE 0 END) as total_pendapatan
    FROM reservasi
");
$stats = mysqli_fetch_assoc($stats_query);

// Fetch reservations
$query = mysqli_query($koneksi, "SELECT * FROM reservasi ORDER BY waktu_order DESC");
if (!$query) {
    error_log('DB Error (reservasi): ' . mysqli_error($koneksi));
    die("Terjadi kesalahan sistem saat memuat reservasi.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <title>Kelola Reservasi | Admin Mawar</title>
  <?php include 'includes/header.php'; ?>
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">
  <style>
    /* Styling Tombol Export DataTables */
    .dt-buttons .btn {
        background-color: #E8622A !important;
        border-color: #E8622A !important;
        color: white !important;
        font-weight: bold;
        border-radius: 4px;
        margin-right: 5px;
        transition: 0.3s;
    }
    .dt-buttons .btn:hover { background-color: #C04E1A !important; }

    .badge-pending { background-color: #ffc107; color: #000; }
    .badge-dikonfirmasi { background-color: #17a2b8; color: #fff; }
    .badge-selesai { background-color: #28a745; color: #fff; }
    
    /* Print Styles */
    @media print {
      .navbar, .sidebar, .content-header, .card-tools, .content-wrapper > .content-header,
      .btn, button, .navbar-nav, .nav-link { display: none !important; }
      body { background: white; }
      .card { border: 1px solid #333; page-break-inside: avoid; }
      .table { font-size: 11px; }
      .row.mb-3 { page-break-inside: avoid; }
      .content-wrapper { margin: 0; padding: 20px; }
      .container-fluid { max-width: 100%; }
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
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
        <!-- STATS SECTION -->
        <div class="row mb-3">
          <div class="col-12 col-md-12 mb-2">
             <div class="card card-outline" style="border-color: #28a745;">
               <div class="card-body text-center">
                 <h3 style="color: #28a745;">Rp <?= number_format($stats['total_pendapatan'] ?? 0, 0, ',', '.'); ?></h3>
                 <p class="text-muted mb-0">Total Pendapatan (Reservasi Selesai)</p>
               </div>
             </div>
          </div>
          <div class="col-md-3">
            <div class="card card-outline card-orange">
              <div class="card-body text-center">
                <h3><?= $stats['total_reservasi']; ?></h3>
                <p class="text-muted">Total Reservasi</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card card-outline" style="border-color: #28a745;">
              <div class="card-body text-center">
                <h3 style="color: #28a745;"><?= $stats['reservasi_selesai']; ?></h3>
                <p class="text-muted">Selesai</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card card-outline" style="border-color: #17a2b8;">
              <div class="card-body text-center">
                <h3 style="color: #17a2b8;"><?= $stats['reservasi_dikonfirmasi']; ?></h3>
                <p class="text-muted">Dikonfirmasi</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card card-outline" style="border-color: #ffc107;">
              <div class="card-body text-center">
                <h3 style="color: #ffc107;"><?= $stats['reservasi_pending']; ?></h3>
                <p class="text-muted">Pending</p>
              </div>
            </div>
          </div>
        </div>

        <!-- DATA TABLE SECTION -->
        <div class="card card-outline card-orange">
          <div class="card-header">
            <h3 class="card-title">Daftar Reservasi</h3>
          </div>
          <div class="card-body p-3">
            <table class="table table-striped table-hover text-nowrap" id="list">
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
                        <a href="update_reservasi.php?id=<?= $row['id_reservasi']; ?>&status=Dikonfirmasi&csrf_token=<?= $_SESSION['csrf_token']; ?>" class="btn btn-sm btn-info" title="Konfirmasi Reservasi">Konfirmasi</a>
                    <?php endif; ?>
                    
                    <?php if ($row['status_reservasi'] == 'Pending' || $row['status_reservasi'] == 'Dikonfirmasi'): ?>
                        <a href="update_reservasi.php?id=<?= $row['id_reservasi']; ?>&status=Selesai&csrf_token=<?= $_SESSION['csrf_token']; ?>" class="btn btn-sm btn-success" title="Selesaikan">Selesai</a>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php } ?>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<script>
  $(function () {
    $("#list").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "order": [[ 2, "desc" ]],
      "buttons": [
        { extend: 'excel', text: '<i class="fas fa-file-excel"></i> Excel', className: 'btn-sm' },
        { extend: 'pdf', text: '<i class="fas fa-file-pdf"></i> Cetak PDF', className: 'btn-sm' },
        { extend: 'print', text: '<i class="fas fa-print"></i> Print', className: 'btn-sm' }
      ],
      "language": {
          "search": "Cari:",
          "zeroRecords": "Tidak ada reservasi ditemukan.",
          "info": "Menampilkan _PAGE_ dari _PAGES_",
          "paginate": { "previous": "Sebelumnya", "next": "Lanjut" }
      }
    }).buttons().container().appendTo('#list_wrapper .col-md-6:eq(0)');
  });
</script>

<script>
// Auto-scroll ke anchor jika ada
document.addEventListener('DOMContentLoaded', function() {
    if (window.location.hash) {
        const hash = window.location.hash.substring(1);
        const element = document.getElementById(hash);
        if (element) {
            setTimeout(() => {
                element.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 200);
        }
    }
});
</script>
