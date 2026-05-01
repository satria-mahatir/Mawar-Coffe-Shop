<?php
session_start();
include '../koneksi.php';

// Proteksi: Cegah maju-mundur browser setelah login
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

if (isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit;
}

$error = '';

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password']; // Jangan di-MD5 dulu di sini!

    // 1. Cari user berdasarkan username aja
    $query  = "SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        
        // 2. Verifikasi password BCRYPT yang diinput vs yang di database
        if (password_verify($password, $data['password'])) {
            // Kalau COCOK, bikin session
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['username'] = $data['username'];
            $_SESSION['user_id']  = $data['id_admin'];
            
            header("Location: index.php"); 
            exit;
        } else {
            $error = 'Password salah bro!';
        }
    } else {
        $error = 'Username tidak terdaftar!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <title>Login Admin | Warkop Mawar</title>
  <?php include 'includes/header.php'; ?>
  
  <style>
      /* Custom dikit biar vibe oren mawar tetep dapet */
      .card-primary.card-outline {
          border-top: 3px solid #E8622A;
      }
      .btn-primary {
          background-color: #E8622A;
          border-color: #E8622A;
      }
      .btn-primary:hover {
          background-color: #C04E1A;
          border-color: #C04E1A;
      }
      body {
          background-color: #1A0F08 !important; /* Warna background dari frontend lu */
      }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <!-- Link ini bisa diklik buat balik ke halaman utama -->
      <a href="../index.html" class="h1" style="color: #111;"><b>Admin</b>Mawar</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Login dulu brok buat masuk dashboard</p>

      <!-- Alert Bootstrap buat nampilin error -->
      <?php if($error != ''): ?>
        <div class="alert alert-danger text-center" role="alert">
          <?php echo $error; ?>
        </div>
      <?php endif; ?>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>