<nav class="main-header navbar navbar-expand navbar-white navbar-light" id="top-navbar">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <!-- iOS Style Dark Mode Toggle -->
        <li class="nav-item d-flex align-items-center mr-3">
            <div class="ios-toggle-container" title="Ganti Mode Terang/Gelap">
                <input type="checkbox" id="darkModeToggle" class="ios-toggle">
                <label for="darkModeToggle" class="ios-toggle-label">
                    <i class="fas fa-sun"></i>
                    <i class="fas fa-moon"></i>
                </label>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link text-danger" href="logout.php">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
        </li>
    </ul>
</nav>

<!-- Script Auto-load & Toggle Dark Mode -->
<script>
    (function() {
        const isDarkMode = localStorage.getItem('mawar_admin_dark_mode') === 'true';
        if (isDarkMode) {
            document.body.classList.add('dark-mode');
            const nav = document.getElementById('top-navbar');
            if (nav) {
                nav.classList.replace('navbar-white', 'navbar-dark');
                nav.classList.replace('navbar-light', 'navbar-dark');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('darkModeToggle');
            const navbar = document.getElementById('top-navbar');
            
            // Set state awal toggle
            if (isDarkMode && toggle) {
                toggle.checked = true;
            }
            
            // Event pas toggle di-klik
            if (toggle) {
                toggle.addEventListener('change', function() {
                    // Tambah class theme-transition buat trigger animasi mulus
                    document.body.classList.add('theme-transition');
                    
                    if (this.checked) {
                        document.body.classList.add('dark-mode');
                        navbar.classList.replace('navbar-white', 'navbar-dark');
                        navbar.classList.replace('navbar-light', 'navbar-dark');
                        localStorage.setItem('mawar_admin_dark_mode', 'true');
                    } else {
                        document.body.classList.remove('dark-mode');
                        navbar.classList.replace('navbar-dark', 'navbar-white');
                        navbar.classList.add('navbar-light');
                        localStorage.setItem('mawar_admin_dark_mode', 'false');
                    }
                    
                    // Hapus class transisi setelah animasi selesai (500ms) biar performa nggak berat
                    setTimeout(function() {
                        document.body.classList.remove('theme-transition');
                    }, 500);
                });
            }
        });
    })();
</script>