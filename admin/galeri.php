<?php
require_once '../config/database.php';

// Prevent browser caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Proteksi Login
if (!isset($_SESSION['admin_logged_in'])) { 
    header("Location: login.php"); 
    exit; 
}

// Whitelist ekstensi file yang diizinkan
$allowed_img_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
function isAllowedImageGaleri($filename) {
    global $allowed_img_ext;
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    return in_array($ext, $allowed_img_ext);
}

// --- LOGIKA TAMBAH FOTO ---
if (isset($_POST['tambah_foto'])) {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF Token Invalid!");
    }
    $judul = trim($_POST['judul']);
    $nama_file = $_FILES['gambar']['name'];
    $tmp_file  = $_FILES['gambar']['tmp_name'];
    
    if ($nama_file != "" && isAllowedImageGaleri($nama_file)) {
        $gambar_baru = time() . '_' . $nama_file;
        $path = "../images/" . $gambar_baru;

        if (move_uploaded_file($tmp_file, $path)) {
            $stmt = $koneksi->prepare("INSERT INTO galeri (judul, gambar) VALUES (?, ?)");
            $stmt->bind_param("ss", $judul, $gambar_baru);
            $stmt->execute();
            $stmt->close();
            header("Location: galeri.php#list");
            exit;
        }
    }
}

// --- LOGIKA EDIT FOTO ---
if (isset($_POST['edit_foto'])) {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF Token Invalid!");
    }
    $id    = (int)$_POST['id_galeri'];
    $judul = trim($_POST['judul']);
    
    // Cek apakah ada upload foto baru
    if ($_FILES['gambar']['name'] != "" && isAllowedImageGaleri($_FILES['gambar']['name'])) {
        $nama_file = time() . '_' . $_FILES['gambar']['name'];
        $tmp_file  = $_FILES['gambar']['tmp_name'];
        $path      = "../images/" . $nama_file;

        if (move_uploaded_file($tmp_file, $path)) {
            // Hapus foto lama dari folder
            $stmt = $koneksi->prepare("SELECT gambar FROM galeri WHERE id_galeri=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $lama = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            if ($lama && file_exists("../images/" . $lama['gambar'])) {
                unlink("../images/" . $lama['gambar']);
            }
            $stmt = $koneksi->prepare("UPDATE galeri SET judul=?, gambar=? WHERE id_galeri=?");
            $stmt->bind_param("ssi", $judul, $nama_file, $id);
            $stmt->execute();
            $stmt->close();
        }
    } else {
        // Jika hanya ganti judul saja
        $stmt = $koneksi->prepare("UPDATE galeri SET judul=? WHERE id_galeri=?");
        $stmt->bind_param("si", $judul, $id);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: galeri.php#item_$id");
    exit;
}

// --- LOGIKA HAPUS FOTO ---
if (isset($_GET['hapus'])) {
    if (!isset($_GET['csrf_token']) || $_GET['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF Token Invalid!");
    }
    $id = (int)$_GET['hapus'];
    $stmt = $koneksi->prepare("SELECT gambar FROM galeri WHERE id_galeri=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $d = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    
    if ($d && file_exists("../images/".$d['gambar'])) {
        unlink("../images/".$d['gambar']);
    }
    
    $stmt = $koneksi->prepare("DELETE FROM galeri WHERE id_galeri=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: galeri.php#list");
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
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
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
        
        <div class="card card-outline card-orange">
          <div class="card-header">
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalFoto" style="background-color:#E8622A; border:none;">
                <i class="fas fa-plus"></i> Tambah Foto Baru
            </button>
          </div>
          <div class="card-body mawar-scroll">
            <div class="row" id="list">
              <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-md-3 col-6 mb-4" id="item_<?= $row['id_galeri']; ?>">
                  <div class="card h-100 shadow-sm">
                    <img src="../images/<?= htmlspecialchars($row['gambar']); ?>" class="card-img-top" style="height: 180px; object-fit: cover;">
                    <div class="card-body p-2 text-center">
                      <p class="mb-2 text-bold text-uppercase" style="font-size: 0.8rem;"><?= htmlspecialchars($row['judul']); ?></p>
                      <div class="btn-group">
                        <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#modalEdit<?= $row['id_galeri']; ?>"><i class="fas fa-edit"></i> Edit</button>
                        <a href="galeri.php?hapus=<?= $row['id_galeri']; ?>&csrf_token=<?= $_SESSION['csrf_token']; ?>" class="btn btn-xs btn-danger" onclick="return confirm('Hapus foto ini kak?')"><i class="fas fa-trash"></i> Hapus</a>
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
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                        <input type="hidden" name="id_galeri" value="<?= $row['id_galeri']; ?>">
                        <div class="form-group">
                          <label>Judul/Caption</label>
                          <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($row['judul']); ?>" required>
                        </div>
                        <div class="form-group">
                          <label>Ganti Foto <small class="text-muted">(Biarkan kosong jika tidak ingin diganti)</small></label>
                          <input type="file" name="gambar" class="form-control-file" accept="image/*">
                        </div>
                        <div class="text-center">
                           <small>Preview Sekarang:</small><br>
                           <img src="../images/<?= htmlspecialchars($row['gambar']); ?>" width="150" class="img-thumbnail">
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
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
        <div class="form-group"><label>Judul/Caption</label><input type="text" name="judul" class="form-control" required placeholder="Contoh: Suasana Malam"></div>
        <div class="form-group"><label>File Foto</label><input type="file" name="gambar" class="form-control-file" required accept="image/*"></div>
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

<script>
// Auto-scroll ke anchor jika ada
document.addEventListener('DOMContentLoaded', function() {
    if (window.location.hash) {
        const hash = window.location.hash.substring(1);
        const element = document.getElementById(hash);
        if (element) {
            setTimeout(() => {
                element.scrollIntoView({ behavior: 'smooth', block: 'center' });
                // Highlight item yang di-scroll
                if (hash.startsWith('item_')) {
                    element.querySelector('.card').style.boxShadow = '0 0 20px rgba(232, 98, 42, 0.6)';
                    setTimeout(() => {
                        element.querySelector('.card').style.boxShadow = '';
                        element.querySelector('.card').style.transition = 'box-shadow 0.5s ease';
                    }, 1500);
                }
            }, 200);
        }
    }
});
</script>
</body>
</html>
