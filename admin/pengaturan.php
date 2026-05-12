<?php
require_once '../config/database.php';

// Prevent browser caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }

if (isset($_POST['update_web'])) {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF Token Invalid!");
    }
    $wa = trim($_POST['wa_number']);
    $ig = trim($_POST['link_ig']);
    $tt = trim($_POST['link_tiktok']);
    $maps = trim($_POST['link_maps']);
    
    // Update wa_number in pengaturan
    $stmt = $koneksi->prepare("UPDATE pengaturan SET wa_number=? WHERE id=1");
    $stmt->bind_param("s", $wa);
    $stmt->execute();
    $stmt->close();
    
    // Check if pengaturan_web row exists
    $cek = mysqli_query($koneksi, "SELECT * FROM pengaturan_web WHERE id_pengaturan=1");
    if(mysqli_num_rows($cek) > 0) {
        $stmt = $koneksi->prepare("UPDATE pengaturan_web SET link_ig=?, link_tiktok=?, link_maps=? WHERE id_pengaturan=1");
        $stmt->bind_param("sss", $ig, $tt, $maps);
        $stmt->execute();
        $stmt->close();
    } else {
        $stmt = $koneksi->prepare("INSERT INTO pengaturan_web (id_pengaturan, link_ig, link_tiktok, link_maps) VALUES (1, ?, ?, ?)");
        $stmt->bind_param("sss", $ig, $tt, $maps);
        $stmt->execute();
        $stmt->close();
    }
    
    header("Location: pengaturan.php#form");
    exit;
}
$web = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pengaturan WHERE id=1"));

$q_web2 = mysqli_query($koneksi, "SELECT * FROM pengaturan_web WHERE id_pengaturan=1");
if(mysqli_num_rows($q_web2) > 0) {
    $web2 = mysqli_fetch_assoc($q_web2);
} else {
    $web2 = ['link_ig' => '', 'link_tiktok' => '', 'link_maps' => ''];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <title>Pengaturan Web | Admin Mawar</title>
  <?php include 'includes/header.php'; ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">
  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/sidebar.php'; ?>

  <div class="content-wrapper">
    <section class="content-header"><h1>Pengaturan Website</h1></section>
    <section class="content">
      <div class="container-fluid">
        <form action="" method="POST" class="card card-outline card-orange" id="form">
          <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
          <div class="card-body">
            <div class="form-group">
              <label>Nomor WhatsApp (Gunakan format 62...)</label>
              <input type="text" name="wa_number" class="form-control" value="<?= htmlspecialchars($web['wa_number']); ?>" required>
            </div>
            <div class="form-group">
              <label>Link Instagram</label>
              <input type="url" name="link_ig" class="form-control" value="<?= htmlspecialchars($web2['link_ig']); ?>">
            </div>
            <div class="form-group">
              <label>Link TikTok</label>
              <input type="url" name="link_tiktok" class="form-control" value="<?= htmlspecialchars($web2['link_tiktok']); ?>">
            </div>
            <div class="form-group">
              <label>Link Google Maps</label>
              <textarea name="link_maps" class="form-control" rows="2" placeholder="Contoh: https://maps.app.goo.gl/..."><?= htmlspecialchars($web2['link_maps']); ?></textarea>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" name="update_web" class="btn btn-primary" style="background-color:#E8622A; border:none;">Simpan Perubahan</button>
          </div>
        </form>
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
</body>
</html>
