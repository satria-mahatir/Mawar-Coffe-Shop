<?php
session_start();
include '../koneksi.php';

// Prevent browser caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Proteksi Login
if (!isset($_SESSION['admin_logged_in'])) { 
    header("Location: login.php"); 
    exit; 
}

// --- LOGIKA TAMBAH FOTO ---
if (isset($_POST['tambah_foto'])) {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $nama_file = $_FILES['gambar']['name'];
    $tmp_file  = $_FILES['gambar']['tmp_name'];
    $gambar_baru = time() . '_' . $nama_file;
    $path = "../images/" . $gambar_baru;

    if (move_uploaded_file($tmp_file, $path)) {
        mysqli_query($koneksi, "INSERT INTO galeri (judul, gambar) VALUES ('$judul', '$gambar_baru')");
        header("Location: galeri.php?status=tambah");
        exit;
    }
}

// --- LOGIKA EDIT FOTO ---
if (isset($_POST['edit_foto'])) {
    $id    = $_POST['id_galeri'];
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    
    // Cek apakah ada upload foto baru
    if ($_FILES['gambar']['name'] != "") {
        $nama_file = time() . '_' . $_FILES['gambar']['name'];
        $tmp_file  = $_FILES['gambar']['tmp_name'];
        $path      = "../images/" . $nama_file;

        if (move_uploaded_file($tmp_file, $path)) {
            // Hapus foto lama dari folder
            $lama = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT gambar FROM galeri WHERE id_galeri='$id'"));
            if (file_exists("../images/" . $lama['gambar'])) {
                unlink("../images/" . $lama['gambar']);
            }
            mysqli_query($koneksi, "UPDATE galeri SET judul='$judul', gambar='$nama_file' WHERE id_galeri='$id'");
        }
    } else {
        // Jika hanya ganti judul saja
        mysqli_query($koneksi, "UPDATE galeri SET judul='$judul' WHERE id_galeri='$id'");
    }
    header("Location: galeri.php?status=edit");
    exit;
}

// --- LOGIKA HAPUS FOTO ---
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $q = mysqli_query($koneksi, "SELECT gambar FROM galeri WHERE id_galeri='$id'");
    $d = mysqli_fetch_assoc($q);
    
    if (file_exists("../images/".$d['gambar'])) {
        unlink("../images/".$d['gambar']);
    }
    
    mysqli_query($koneksi, "DELETE FROM galeri WHERE id_galeri='$id'");
    header("Location: galeri.php?status=hapus");
    exit;
}

$result = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY id_galeri DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <title>Kelola Galeri | Admin Mawar</title>
  <?php include 'includes/header.php'; ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <?php include 'includes/navbar.php'; ?>

  <!-- Sidebar -->
  <?php include 'includes/sidebar.php'; ?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <h1 class="m-0 text-dark">Kelola Galeri Foto</h1>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        
        <?php if(isset($_GET['status'])): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil di-<b><?= $_GET['status']; ?></b>, bro!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
        <?php endif; ?>

        <div class="card card-outline card-orange">
          <div class="card-header">
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalFoto" style="background-color:#E8622A; border:none;">
                <i class="fas fa-plus"></i> Tambah Foto Baru
            </button>
          </div>
          <div class="card-body">
            <div class="row">
              <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-md-3 mb-4">
                  <div class="card h-100 shadow-sm">
                    <img src="../images/<?= $row['gambar']; ?>" class="card-img-top" style="height: 180px; object-fit: cover;">
                    <div class="card-body p-2 text-center">
                      <p class="mb-2 text-bold text-uppercase" style="font-size: 0.8rem;"><?= $row['judul']; ?></p>
                      <div class="btn-group">
                        <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#modalEdit<?= $row['id_galeri']; ?>"><i class="fas fa-edit"></i> Edit</button>
                        <a href="galeri.php?hapus=<?= $row['id_galeri']; ?>" class="btn btn-xs btn-danger" onclick="return confirm('Hapus foto ini kak?')"><i class="fas fa-trash"></i> Hapus</a>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Modal Edit Foto -->
                <div class="modal fade" id="modalEdit<?= $row['id_galeri']; ?>" tabindex="-1">
                  <div class="modal-dialog">
                    <form action="" method="POST" enctype="multipart/form-data" class="modal-content">
                      <div class="modal-header" style="background-color: #E8622A; color: white;">
                        <h5 class="modal-title">Edit Foto Galeri</h5>
                        <button type="button" class="close" data-dismiss="modal" style="color: white;"><span>&times;</span></button>
                      </div>
                      <div class="modal-body">
                        <input type="hidden" name="id_galeri" value="<?= $row['id_galeri']; ?>">
                        <div class="form-group">
                          <label>Judul/Caption</label>
                          <input type="text" name="judul" class="form-control" value="<?= $row['judul']; ?>" required>
                        </div>
                        <div class="form-group">
                          <label>Ganti Foto <small class="text-muted">(Biarkan kosong jika tidak ingin diganti)</small></label>
                          <input type="file" name="gambar" class="form-control-file">
                        </div>
                        <div class="text-center">
                           <small>Preview Sekarang:</small><br>
                           <img src="../images/<?= $row['gambar']; ?>" width="150" class="img-thumbnail">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" name="edit_foto" class="btn btn-success">Update Data</button>
                      </div>
                    </form>
                  </div>
                </div>

              <?php } ?>
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

<!-- Modal Tambah -->
<div class="modal fade" id="modalFoto" tabindex="-1">
  <div class="modal-dialog">
    <form action="" method="POST" enctype="multipart/form-data" class="modal-content">
      <div class="modal-header" style="background-color: #E8622A; color: white;">
        <h5 class="modal-title">Tambah Foto Galeri</h5>
        <button type="button" class="close" data-dismiss="modal" style="color: white;"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="form-group"><label>Judul/Caption</label><input type="text" name="judul" class="form-control" required placeholder="Contoh: Suasana Malam"></div>
        <div class="form-group"><label>File Foto</label><input type="file" name="gambar" class="form-control-file" required></div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="tambah_foto" class="btn btn-primary" style="background-color:#E8622A; border:none;">Simpan Foto</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>