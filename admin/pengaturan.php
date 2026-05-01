<?php
session_start();
include '../koneksi.php';
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }

if (isset($_POST['update_web'])) {
    $wa = $_POST['wa_number'];
    $ig = $_POST['instagram_url'];
    $tt = $_POST['tiktok_url'];
    $al = mysqli_real_escape_string($koneksi, $_POST['alamat_singkat']);
    
    mysqli_query($koneksi, "UPDATE pengaturan SET wa_number='$wa', instagram_url='$ig', tiktok_url='$tt', alamat_singkat='$al' WHERE id=1");
    header("Location: pengaturan.php?status=sukses");
    exit;
}
$web = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pengaturan WHERE id=1"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Pengaturan Web | Admin Mawar</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
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
              <input type="url" name="instagram_url" class="form-control" value="<?= $web['instagram_url']; ?>">
            </div>
            <div class="form-group">
              <label>Link TikTok</label>
              <input type="url" name="tiktok_url" class="form-control" value="<?= $web['tiktok_url']; ?>">
            </div>
            <div class="form-group">
              <label>Alamat / Teks Footer</label>
              <textarea name="alamat_singkat" class="form-control" rows="2"><?= $web['alamat_singkat']; ?></textarea>
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
