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

// --- LOGIKA UPDATE TENTANG ---
if (isset($_POST['update_tentang'])) {
    $quote = mysqli_real_escape_string($koneksi, $_POST['quote_text']);
    
    // 1. Update teks quote
    mysqli_query($koneksi, "UPDATE tentang SET quote_text='$quote' WHERE id=1");

    // Fungsi sakti buat upload foto spesifik tanpa ribet
    function uploadKonten($inputName, $dbColumn, $koneksi) {
        if ($_FILES[$inputName]['name'] != "") {
            $nama_file = time() . '_' . $_FILES[$inputName]['name'];
            $tmp_file  = $_FILES[$inputName]['tmp_name'];
            $path      = "../images/" . $nama_file;

            if (move_uploaded_file($tmp_file, $path)) {
                // Hapus foto lama biar folder images nggak penuh sampah
                $lama = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT $dbColumn FROM tentang WHERE id=1"));
                if (file_exists("../images/" . $lama[$dbColumn])) {
                    unlink("../images/" . $lama[$dbColumn]);
                }
                // Update nama file baru ke database
                mysqli_query($koneksi, "UPDATE tentang SET $dbColumn='$nama_file' WHERE id=1");
            }
        }
    }

    // Eksekusi upload buat 4 posisi foto
    uploadKonten('foto_utama', 'foto_utama', $koneksi);
    uploadKonten('foto_1', 'foto_1', $koneksi);
    uploadKonten('foto_2', 'foto_2', $koneksi);
    uploadKonten('foto_3', 'foto_3', $koneksi);

    // Eksekusi upload buat 6 video beranda
    uploadKonten('video_1', 'video_1', $koneksi);
    uploadKonten('video_2', 'video_2', $koneksi);
    uploadKonten('video_3', 'video_3', $koneksi);
    uploadKonten('video_4', 'video_4', $koneksi);
    uploadKonten('video_5', 'video_5', $koneksi);
    uploadKonten('video_6', 'video_6', $koneksi);

    header("Location: tentang.php#content");
    exit;
}

// Ambil data terbaru
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tentang WHERE id=1"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <title>Kelola Tentang | Admin Mawar</title>
  <?php include 'includes/header.php'; ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include 'includes/navbar.php'; ?>

  <!-- Sidebar -->
  <?php include 'includes/sidebar.php'; ?>

  <!-- Konten -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid"><h1>Kelola Konten "Tentang Kami"</h1></div>
    </div>

    <section class="content">
      <div class="container-fluid">
        
        <form action="" method="POST" enctype="multipart/form-data" id="content">
          <div class="card card-outline card-orange">
            <div class="card-header"><h3 class="card-title">Teks & Quote</h3></div>
            <div class="card-body">
              <div class="form-group">
                <label>Quote Utama</label>
                <textarea name="quote_text" class="form-control" rows="3" required><?= $data['quote_text']; ?></textarea>
                <small class="text-muted">Muncul di samping foto utama section About.</small>
              </div>
            </div>
          </div>

          <div class="row">
            <!-- Foto Utama -->
            <div class="col-md-3">
              <div class="card card-outline card-orange">
                <div class="card-header text-center"><small><b>FOTO UTAMA QUOTE</b></small></div>
                <div class="card-body text-center">
                  <img src="../images/<?= $data['foto_utama']; ?>" class="img-fluid mb-2 rounded shadow-sm" style="height:150px; width:100%; object-fit:cover;">
                  <input type="file" name="foto_utama" class="form-control-file">
                </div>
              </div>
            </div>
            <!-- Foto Momen 1 -->
            <div class="col-md-3">
              <div class="card card-outline card-orange">
                <div class="card-header text-center"><small><b>FOTO MOMEN 1</b></small></div>
                <div class="card-body text-center">
                  <img src="../images/<?= $data['foto_1']; ?>" class="img-fluid mb-2 rounded shadow-sm" style="height:150px; width:100%; object-fit:cover;">
                  <input type="file" name="foto_1" class="form-control-file">
                </div>
              </div>
            </div>
            <!-- Foto Momen 2 -->
            <div class="col-md-3">
              <div class="card card-outline card-orange">
                <div class="card-header text-center"><small><b>FOTO MOMEN 2</b></small></div>
                <div class="card-body text-center">
                  <img src="../images/<?= $data['foto_2']; ?>" class="img-fluid mb-2 rounded shadow-sm" style="height:150px; width:100%; object-fit:cover;">
                  <input type="file" name="foto_2" class="form-control-file">
                </div>
              </div>
            </div>
            <!-- Foto Momen 3 -->
            <div class="col-md-3">
              <div class="card card-outline card-orange">
                <div class="card-header text-center"><small><b>FOTO MOMEN 3</b></small></div>
                <div class="card-body text-center">
                  <img src="../images/<?= $data['foto_3']; ?>" class="img-fluid mb-2 rounded shadow-sm" style="height:150px; width:100%; object-fit:cover;">
                  <input type="file" name="foto_3" class="form-control-file">
                </div>
              </div>
            </div>
          </div>

          <!-- Video Section -->
          <div class="card card-outline card-orange mt-4">
            <div class="card-header"><h3 class="card-title">Video Carousel Beranda (Otomatis Diputar)</h3></div>
            <div class="card-body">
              <p class="text-muted"><small>Unggah video (mp4/webm) untuk bagian banner beranda. Video lama akan ditimpa jika Anda mengunggah yang baru.</small></p>
              <div class="row">
                <?php for($i=1; $i<=6; $i++): ?>
                <div class="col-md-4 mb-3">
                  <div class="border rounded p-2 text-center bg-light">
                    <small><b>VIDEO <?= $i ?></b></small>
                    <video src="../images/<?= htmlspecialchars($data['video_'.$i] ?? ''); ?>" class="img-fluid mb-2 mt-1 rounded shadow-sm" style="height:150px; width:100%; object-fit:cover; background:#000;" controls></video>
                    <input type="file" name="video_<?= $i ?>" class="form-control-file" accept="video/*">
                  </div>
                </div>
                <?php endfor; ?>
              </div>
            </div>
          </div>

          <div class="card-footer bg-white mt-3">
            <button type="submit" name="update_tentang" class="btn btn-block btn-lg" style="background-color:#E8622A; color:white;"><b>SIMPAN PERUBAHAN</b></button>
          </div>
        </form>
      </div>
    </section>
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
                element.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 200);
        }
    }
});
</script>
</body>
</html>