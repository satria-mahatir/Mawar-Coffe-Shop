<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #1A0F08;">
    <!-- Logo Brand Section -->
    <div class="sidebar-brand">
        <a href="index.php" class="brand-full">
            <img src="../images/logo-mawar.png" alt="Warkop Mawar Logo">
        </a>
        <a href="index.php" class="brand-icon">
            <img src="../images/favicon-32x32.png" alt="Mawar Icon">
        </a>
    </div>

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