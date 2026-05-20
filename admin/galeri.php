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
        $ext = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
        $gambar_baru = time() . '_' . bin2hex(random_bytes(8)) . '.' . $ext;
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
        $ext = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
        $nama_file = time() . '_' . bin2hex(random_bytes(8)) . '.' . $ext;
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
          <div class="card-body">
            <div class="row" id="list">
              <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-12 col-sm-6 col-md-3 mb-4" id="item_<?= $row['id_galeri']; ?>">
                  <div class="card h-100 shadow" style="border-radius: 12px; overflow: hidden; border: none; transition: transform 0.2s;">
                    <div style="position: relative;">
                      <img src="../images/<?= htmlspecialchars($row['gambar']); ?>" class="card-img-top" style="height: 190px; object-fit: cover;">
                      <div style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.6); color: white; padding: 4px 8px; border-radius: 6px; font-size: 0.75rem;">
                        <i class="fas fa-image"></i>
                      </div>
                    </div>
                    <div class="card-body p-3 d-flex flex-column justify-content-between" style="background-color: #fff;">
                      <p class="mb-3 text-bold text-uppercase text-dark text-truncate" style="font-size: 0.85rem; letter-spacing: 0.5px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="<?= htmlspecialchars($row['judul']); ?>">
                        <?= htmlspecialchars($row['judul']); ?>
                      </p>
                      <div class="row no-gutters">
                        <div class="col-6 pr-1">
                          <button class="btn btn-block btn-info btn-action-mobile" data-toggle="modal" data-target="#modalEdit<?= $row['id_galeri']; ?>">
                            <i class="fas fa-edit"></i> Edit
                          </button>
                        </div>
                        <div class="col-6 pl-1">
                          <button class="btn btn-block btn-danger btn-action-mobile" onclick="konfirmasiHapusFoto(<?= $row['id_galeri']; ?>)">
                            <i class="fas fa-trash"></i> Hapus
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Modal Edit Foto (Premium) -->
                <div class="modal fade" id="modalEdit<?= $row['id_galeri']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <form action="" method="POST" enctype="multipart/form-data" class="modal-content" style="border-radius: 12px; overflow: hidden; border: none;">
                      <div class="modal-header" style="background-color: #1A0F08; color: #E8622A;">
                        <h5 class="modal-title"><i class="fas fa-edit"></i> Edit Foto Galeri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body text-left" style="background-color: #fff; color: #333;">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                        <input type="hidden" name="id_galeri" value="<?= $row['id_galeri']; ?>">
                        <div class="form-group">
                          <label>Judul/Caption</label>
                          <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($row['judul']); ?>" required>
                        </div>
                        <div class="form-group">
                          <label>Ganti Foto <small class="text-muted">(Biarkan kosong jika tidak ingin diganti)</small></label>
                          <input type="file" name="gambar" class="form-control-file mb-2" accept="image/*">
                        </div>
                        <div class="p-2 border rounded bg-light text-center">
                           <small class="d-block mb-1 text-muted">Preview Sekarang:</small>
                           <img src="../images/<?= htmlspecialchars($row['gambar']); ?>" width="120" class="img-thumbnail">
                        </div>
                      </div>
                      <div class="modal-footer" style="background-color: #F8F9FA;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="edit_foto" class="btn btn-primary" style="background-color: #E8622A; border: none;">Simpan</button>
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

<!-- Modal Tambah (Premium & Batal Berfungsi Sempurna) -->
<div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="" method="POST" enctype="multipart/form-data" class="modal-content" style="border-radius: 12px; overflow: hidden; border: none;">
      <div class="modal-header" style="background-color: #1A0F08; color: #E8622A;">
        <h5 class="modal-title"><i class="fas fa-plus-circle"></i> Tambah Foto Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-left" style="background-color: #fff; color: #333;">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
        <div class="form-group">
          <label>Judul/Caption</label>
          <input type="text" name="judul" class="form-control" required placeholder="Contoh: Suasana Sore Hari di Mawar">
        </div>
        <div class="form-group">
          <label>File Foto</label>
          <input type="file" name="gambar" class="form-control-file" required accept="image/*">
        </div>
      </div>
      <div class="modal-footer" style="background-color: #F8F9FA;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" name="tambah_foto" class="btn btn-primary" style="background-color:#E8622A; border:none;">Simpan Foto</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<script>
function konfirmasiHapusFoto(id) {
    Swal.fire({
        title: 'Hapus foto ini, bro?',
        text: "Foto bakal terhapus selamanya dari galeri!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#E8622A', // Warna oren Mawar
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "galeri.php?hapus=" + id + "&csrf_token=<?= $_SESSION['csrf_token']; ?>";
        }
    })
}

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
