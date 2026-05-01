<?php
session_start();
include '../koneksi.php';

// Prevent browser caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }

$admin_id = $_SESSION['user_id']; 

if (isset($_POST['update_profil'])) {
    $user = mysqli_real_escape_string($koneksi, $_POST['username']);
    $pass = $_POST['password'];
    
    if (!empty($pass)) {
        // Kalau password diisi, update username & password dengan BCRYPT
        $pass_hash = password_hash($pass, PASSWORD_BCRYPT);
        $query = "UPDATE admin SET username='$user', password='$pass_hash' WHERE id_admin='$admin_id'";
    } else {
        // Kalau password kosong, update username doang
        $query = "UPDATE admin SET username='$user' WHERE id_admin='$admin_id'";
    }

    if (mysqli_query($koneksi, $query)) {
        $_SESSION['username'] = $user; // Update nama di sidebar
        echo "<script>alert('Profil berhasil diupdate! Silakan login ulang, bro.'); window.location='logout.php';</script>";
    }
}

$res = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM admin WHERE id_admin='$admin_id'"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <title>Pengaturan Profil | Admin Mawar</title>
  <?php include 'includes/header.php'; ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <?php include 'includes/navbar.php'; ?>

  <!-- Sidebar -->
  <?php include 'includes/sidebar.php'; ?>

  <div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Pengaturan Akun</h1>
        </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="card card-orange card-outline">
          <form action="" method="POST" class="card-body">
            <div class="form-group">
              <label>Username Baru</label>
              <input type="text" name="username" class="form-control" value="<?= $res['username']; ?>" required>
            </div>
            <div class="form-group">
              <label>Password Baru (Kosongkan jika tidak diganti)</label>
              <input type="password" name="password" class="form-control">
            </div>
            <button type="submit" name="update_profil" class="btn btn-primary" style="background-color:#E8622A; border:none;">Update Akun</button>
          </form>
        </div>
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
</body>
</html>
