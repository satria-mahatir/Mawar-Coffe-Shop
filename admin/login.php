<?php

require_once '../config/database.php';

// Proteksi: Cegah maju-mundur browser setelah login
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: index.php");
    exit;
}

$error = '';

// Proteksi Brute Force: Cek apakah terkunci
if (isset($_SESSION['lockout_time']) && time() < $_SESSION['lockout_time']) {
    $remaining = ceil(($_SESSION['lockout_time'] - time()) / 60);
    $error = "Terlalu banyak percobaan login. Akun terkunci, coba lagi dalam $remaining menit.";
}

if (empty($error) && isset($_POST['submit'])) {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['frontend_csrf_token']) {
        die("CSRF Token Invalid!");
    }
    $username = trim($_POST['username']);
    $password = $_POST['password']; // Jangan di-MD5 dulu di sini!

    // 1. Cari user berdasarkan username menggunakan prepared statement
    $stmt = $koneksi->prepare("SELECT * FROM admin WHERE username = ? LIMIT 1");
    if (!$stmt) {
        error_log('Admin login prepare error: ' . $koneksi->error);
        $error = 'Terjadi kesalahan sistem.';
    } else {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    }

    if (empty($error) && isset($result)) {
        $data = mysqli_fetch_assoc($result);
        
        // 2. Verifikasi password BCRYPT yang diinput vs yang di database
        if ($data && password_verify($password, $data['password'])) {
            // Kalau COCOK, bikin session dan reset hitungan lockout
            unset($_SESSION['login_attempts']);
            unset($_SESSION['lockout_time']);
            
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['username'] = $data['username'];
            $_SESSION['user_id']  = $data['id_admin'];
            
            header("Location: index.php"); 
            exit;
        } else {
            // Jika gagal, tambah hitungan percobaan
            $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
            
            if ($_SESSION['login_attempts'] >= 5) {
                $_SESSION['lockout_time'] = time() + 600; // Lockout 10 menit
                $error = 'Terlalu banyak percobaan login. Akun dikunci selama 10 menit.';
            } else {
                $sisa = 5 - $_SESSION['login_attempts'];
                $error = ($data) ? "Password salah bro! (Sisa percobaan: $sisa)" : "Username tidak terdaftar! (Sisa percobaan: $sisa)";
            }
        }
    } else if (empty($error)) {
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
      <a href="../index.php" class="h1" style="color: #111;"><b>Admin</b>Mawar</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Login dulu brok buat masuk dashboard</p>
 
      <!-- Alert Bootstrap buat nampilin error -->
      <?php if($error != ''): ?>
        <div class="alert alert-danger text-center" role="alert">
          <?php echo htmlspecialchars($error); ?>
        </div>
      <?php endif; ?>

      <form action="" method="post">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['frontend_csrf_token']; ?>">
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
