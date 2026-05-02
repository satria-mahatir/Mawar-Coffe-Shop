<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #1A0F08;">
    <!-- Bagian Header Sidebar -->
    <div class="sidebar-brand d-flex align-items-center justify-content-center py-3">
        <a href="index.php" class="text-decoration-none d-flex align-items-center">
            <!-- Logo Utama (Muncul pas sidebar kebuka) -->
            <div class="sidebar-brand-icon">
                <img src="../images/logo-mawar.svg" alt="Logo Warkop Mawar" style="width: 45px; height: auto;">
            </div>
            <!-- Teks Nama (Opsional, ilang pas sidebar tertutup) -->
            <div class="sidebar-brand-text mx-2" style="color: #E8622A; font-weight: bold; font-size: 14px;">
                WARKOP MAWAR
            </div>
        </a>
    </div>
    <hr class="sidebar-divider" style="border-top: 1px solid #E8622A; opacity: 0.3; margin: 0 10px;">

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="border-bottom: 1px solid #E8622A;">
            <div class="info">
                <a href="profil.php" class="d-block">Halo, <?= $_SESSION['username']; ?>!</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column">
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" <?= (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'style="background-color: #E8622A;"' : ''; ?>>
                        <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="menu.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'menu.php') ? 'active' : ''; ?>" <?= (basename($_SERVER['PHP_SELF']) == 'menu.php') ? 'style="background-color: #E8622A;"' : ''; ?>>
                        <i class="nav-icon fas fa-coffee"></i><p>Kelola Menu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="galeri.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'galeri.php') ? 'active' : ''; ?>" <?= (basename($_SERVER['PHP_SELF']) == 'galeri.php') ? 'style="background-color: #E8622A;"' : ''; ?>>
                        <i class="nav-icon fas fa-images"></i><p>Kelola Galeri</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="tentang.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'tentang.php') ? 'active' : ''; ?>" <?= (basename($_SERVER['PHP_SELF']) == 'tentang.php') ? 'style="background-color: #E8622A;"' : ''; ?>>
                        <i class="nav-icon fas fa-info-circle"></i><p>Kelola Tentang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="qrcode.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'qrcode.php') ? 'active' : ''; ?>" <?= (basename($_SERVER['PHP_SELF']) == 'qrcode.php') ? 'style="background-color: #E8622A;"' : ''; ?>>
                        <i class="nav-icon fas fa-qrcode"></i><p>QR Code Menu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="profil.php" class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'profil.php') ? 'active' : ''; ?>" <?= (basename($_SERVER['PHP_SELF']) == 'profil.php') ? 'style="background-color: #E8622A;"' : ''; ?>>
                        <i class="nav-icon fas fa-user-cog"></i><p>Pengaturan Akun</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>