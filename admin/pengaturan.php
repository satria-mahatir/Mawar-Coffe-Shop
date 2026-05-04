<?php
session_start();
include '../koneksi.php';
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }

if (isset($_POST['update_web'])) {
    $wa = $_POST['wa_number'];
    $ig = $_POST['link_ig'];
    $tt = $_POST['link_tiktok'];
    $maps = mysqli_real_escape_string($koneksi, $_POST['link_maps']);
    
    // Update wa_number in pengaturan
    mysqli_query($koneksi, "UPDATE pengaturan SET wa_number='$wa' WHERE id=1");
    
    // Check if pengaturan_web row exists
    $cek = mysqli_query($koneksi, "SELECT * FROM pengaturan_web WHERE id_pengaturan=1");
    if(mysqli_num_rows($cek) > 0) {
        mysqli_query($koneksi, "UPDATE pengaturan_web SET link_ig='$ig', link_tiktok='$tt', link_maps='$maps' WHERE id_pengaturan=1");
    } else {
        mysqli_query($koneksi, "INSERT INTO pengaturan_web (id_pengaturan, link_ig, link_tiktok, link_maps) VALUES (1, '$ig', '$tt', '$maps')");
    }
    
    header("Location: pengaturan.php?status=sukses");
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
        <form action="" method="POST" class="card card-outline card-orange">
          <div class="card-body">
            <div class="form-group">
              <label>Nomor WhatsApp (Gunakan format 62...)</label>
              <input type="text" name="wa_number" class="form-control" value="<?= $web['wa_number']; ?>" required>
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
</div>
</body>
</html>
