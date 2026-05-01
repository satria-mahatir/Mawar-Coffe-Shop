<?php
session_start();
include '../koneksi.php';

// Prevent browser caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }

// --- LOGIKA GANTI STATUS MENU ---
if (isset($_GET['status_id'])) {
    $id = $_GET['status_id'];
    $st = $_GET['st'];
    $new_status = ($st == 'tersedia') ? 'habis' : 'tersedia';
    
    mysqli_query($koneksi, "UPDATE menu SET status='$new_status' WHERE id_menu='$id'");
    header("Location: menu.php");
    exit;
}

// --- LOGIKA HAPUS ---
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $q = mysqli_query($koneksi, "SELECT gambar FROM menu WHERE id_menu='$id'");
    $d = mysqli_fetch_assoc($q);
    if (file_exists("../images/".$d['gambar'])) unlink("../images/".$d['gambar']);
    mysqli_query($koneksi, "DELETE FROM menu WHERE id_menu='$id'");
    header("Location: menu.php"); exit;
}

// --- LOGIKA TAMBAH ---
if (isset($_POST['tambah_menu'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_menu']);
    $kat  = $_POST['kategori'];
    $hrg  = $_POST['harga'];
    $desk = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $gambar = time().'_'.$_FILES['gambar']['name'];
    if (move_uploaded_file($_FILES['gambar']['tmp_name'], "../images/".$gambar)) {
        mysqli_query($koneksi, "INSERT INTO menu VALUES ('', '$nama', '$kat', '$desk', '$hrg', '$gambar')");
    }
    header("Location: menu.php"); exit;
}

// --- LOGIKA EDIT ---
if (isset($_POST['edit_menu'])) {
    $id   = $_POST['id_menu'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_menu']);
    $kat  = $_POST['kategori'];
    $hrg  = $_POST['harga'];
    $desk = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    
    if ($_FILES['gambar']['name'] != "") {
        $gambar = time().'_'.$_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../images/".$gambar);
        mysqli_query($koneksi, "UPDATE menu SET nama_menu='$nama', kategori='$kat', harga='$hrg', deskripsi='$desk', gambar='$gambar' WHERE id_menu='$id'");
    } else {
        mysqli_query($koneksi, "UPDATE menu SET nama_menu='$nama', kategori='$kat', harga='$hrg', deskripsi='$desk' WHERE id_menu='$id'");
    }
    header("Location: menu.php"); exit;
}

$result = mysqli_query($koneksi, "SELECT * FROM menu ORDER BY id_menu DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Kelola Menu | Admin Mawar</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap4.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    /* Styling Tombol Export DataTables */
    .dt-buttons .btn {
        background-color: #E8622A !important; /* Warna oren Mawar */
        border-color: #E8622A !important;
        color: white !important;
        font-weight: bold;
        border-radius: 4px;
        margin-right: 5px;
        transition: 0.3s;
    }

    .dt-buttons .btn:hover {
        background-color: #C04E1A !important; /* Warna oren lebih gelap pas di-hover */
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    /* Styling Dropdown Column Visibility */
    .buttons-columnVisibility.active {
        background-color: #1A0F08 !important; /* Cokelat tua pas aktif */
        color: #E8622A !important;
    }

    div.dt-button-collection {
        background-color: #1A0F08 !important;
        border: 1px solid #E8622A;
    }

    a.dt-button.dropdown-item.buttons-columnVisibility {
        color: white !important;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php include 'includes/navbar.php'; ?>

  <!-- Sidebar -->
  <?php include 'includes/sidebar.php'; ?>

  <div class="content-wrapper">
    <section class="content-header"><h1>Kelola Menu</h1></section>
    <section class="content">
      <div class="container-fluid">
        <?php if(isset($_GET['status'])): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil di-<b><?= $_GET['status']; ?></b>, bro!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
        <?php endif; ?>
        <div class="card">
          <div class="card-header"><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-plus"></i> Tambah Menu</button></div>
          <div class="card-body p-3">
            <table id="tabelMenu" class="table table-striped table-bordered text-center">
              <thead style="background-color: #1A0F08; color: #F5EFE4;">
                <tr>
                  <th style="width: 5%">No</th>
                  <th style="width: 15%">Gambar</th>
                  <th>Nama Menu</th>
                  <th>Kategori</th>
                  <th>Harga</th>
                  <th style="width: 20%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                while($row = mysqli_fetch_assoc($result)) { 
                ?>
                <tr>
                  <td class="align-middle"><?= $no++; ?></td>
                  <td class="align-middle">
                    <img src="../images/<?= $row['gambar']; ?>" alt="<?= $row['nama_menu']; ?>" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                  </td>
                  <td class="align-middle text-left">
                    <strong><?= $row['nama_menu']; ?></strong><br>
                    <small class="text-muted"><?= (strlen($row['deskripsi']) > 50) ? substr($row['deskripsi'], 0, 50)."..." : $row['deskripsi']; ?></small>
                  </td>
                  <td class="align-middle"><?= ucfirst($row['kategori']); ?></td>
                  <td class="align-middle font-weight-bold" style="color: #E8622A;">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                  <td class="align-middle">
                    <!-- Tombol Status -->
                    <?php if(!isset($row['status']) || $row['status'] == 'tersedia'): ?>
                        <a href="menu.php?status_id=<?= $row['id_menu']; ?>&st=tersedia" class="btn btn-xs btn-success" title="Klik untuk jadikan Habis">
                            <i class="fas fa-check-circle"></i> Tersedia
                        </a>
                    <?php else: ?>
                        <a href="menu.php?status_id=<?= $row['id_menu']; ?>&st=habis" class="btn btn-xs btn-secondary" title="Klik untuk jadikan Tersedia">
                            <i class="fas fa-times-circle"></i> Habis
                        </a>
                    <?php endif; ?>

                    <!-- Tombol Edit & Hapus lu yang lama di bawahnya -->
                    <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#modalEdit<?= $row['id_menu']; ?>">
                      <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn btn-xs btn-danger" onclick="konfirmasiHapus(<?= $row['id_menu']; ?>)">
                      <i class="fas fa-trash"></i> Hapus
                    </button>
                  </td>
                </tr>

                <!-- MODAL EDIT - VERSI PERFECT -->
                <div class="modal fade" id="modalEdit<?= $row['id_menu']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content" style="border-radius: 12px; overflow: hidden; border: none;"> <!-- PENYELAMAT: Class ini wajib ada brok! -->
                      <div class="modal-header" style="background-color: #1A0F08; color: #E8622A;">
                        <h5 class="modal-title"><i class="fas fa-edit"></i> Edit Menu: <?= $row['nama_menu']; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-body text-left" style="background-color: #fff; color: #333;">
                          <input type="hidden" name="id_menu" value="<?= $row['id_menu']; ?>">
                          
                          <div class="form-group">
                            <label>Nama Menu</label>
                            <input type="text" name="nama_menu" class="form-control" value="<?= $row['nama_menu']; ?>" required>
                          </div>
                          
                          <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori" class="form-control">
                              <option value="minuman" <?= $row['kategori']=='minuman'?'selected':''; ?>>Minuman</option>
                              <option value="makanan" <?= $row['kategori']=='makanan'?'selected':''; ?>>Makanan</option>
                            </select>
                          </div>
                          
                          <div class="form-group">
                            <label>Harga (Rp)</label>
                            <input type="number" name="harga" class="form-control" value="<?= $row['harga']; ?>" required>
                          </div>
                          
                          <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3"><?= $row['deskripsi']; ?></textarea>
                          </div>
                          
                          <div class="form-group">
                            <label>Ganti Foto <small class="text-muted">(Kosongkan jika tidak diganti)</small></label>
                            <input type="file" name="gambar" class="form-control-file mb-2">
                            <div class="p-2 border rounded bg-light text-center">
                              <small class="d-block mb-1 text-muted">Foto saat ini:</small>
                              <img src="../images/<?= $row['gambar']; ?>" width="100" class="img-thumbnail">
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer" style="background-color: #F8F9FA;">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                          <button type="submit" name="edit_menu" class="btn btn-primary" style="background-color: #E8622A; border: none;">Simpan Perubahan</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- END MODAL EDIT -->

                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<!-- Modal Tambah (Sama kayak kode lama lu) -->
<div class="modal fade" id="modalTambah" tabindex="-1">
  <div class="modal-dialog">
    <form action="" method="POST" enctype="multipart/form-data" class="modal-content">
      <div class="modal-header"><h5>Tambah Menu</h5></div>
      <div class="modal-body">
        <div class="form-group"><label>Nama Menu</label><input type="text" name="nama_menu" class="form-control" required></div>
        <div class="form-group"><label>Kategori</label><select name="kategori" class="form-control"><option value="minuman">Minuman</option><option value="makanan">Makanan</option></select></div>
        <div class="form-group"><label>Harga</label><input type="number" name="harga" class="form-control" required></div>
        <div class="form-group"><label>Deskripsi</label><textarea name="deskripsi" class="form-control" required></textarea></div>
        <div class="form-group"><label>Foto</label><input type="file" name="gambar" class="form-control-file" required></div>
      </div>
      <div class="modal-footer"><button type="submit" name="tambah_menu" class="btn btn-primary">Simpan</button></div>
    </form>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

<!-- DataTables Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>

<script>
  $(function () {
    $("#tabelMenu").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "buttons": [
        {
          extend: 'copy',
          text: '<i class="fas fa-copy"></i> Copy',
          className: 'btn-sm'
        },
        {
          extend: 'excel',
          text: '<i class="fas fa-file-excel"></i> Excel',
          className: 'btn-sm'
        },
        {
          extend: 'pdf',
          text: '<i class="fas fa-file-pdf"></i> PDF',
          className: 'btn-sm'
        },
        {
          extend: 'print',
          text: '<i class="fas fa-print"></i> Print',
          className: 'btn-sm'
        },
        {
          extend: 'colvis',
          text: '<i class="fas fa-eye"></i> Filter Kolom',
          className: 'btn-sm'
        }
      ],
      "language": {
          "search": "Cari Menu:",
          "zeroRecords": "Menu nggak ketemu bro!",
          "info": "Menampilkan _PAGE_ dari _PAGES_",
          "paginate": { "previous": "Sebelumnya", "next": "Lanjut" }
      }
    }).buttons().container().appendTo('#tabelMenu_wrapper .col-md-6:eq(0)');
  });
</script>
<script>
function konfirmasiHapus(id) {
    Swal.fire({
        title: 'Yakin mau hapus, bro?',
        text: "Data yang dihapus nggak bisa balik lagi loh!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#E8622A', // Warna oren Mawar
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, sikat!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "menu.php?hapus=" + id;
        }
    })
}
</script>
</body>
</html>