    <?php
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Path favicon diarahkan keluar folder admin satu tingkat -->
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
    
    <!-- Warna tema oren mawar -->
    <meta name="theme-color" content="#E8622A">

    <style>
        /* Fix Scrollbar Layout Shift */
        html {
            scrollbar-gutter: stable;
        }

        /* Fix gap di sidebar untuk layout AdminLTE */
        .layout-navbar-fixed.layout-fixed .wrapper .sidebar {
            margin-top: 0 !important;
        }

        .main-sidebar { background-color: #1A0F08 !important; }
        .nav-link.active { background-color: #E8622A !important; }
        .brand-link { border-bottom: 1px solid #4B3224 !important; }
        .btn-mawar { background-color: #E8622A; color: white; border: none; }
        .btn-mawar:hover { background-color: #C04E1A; color: white; }

        /* --- Sidebar Branding Refined --- */
        .sidebar-brand { transition: all 0.3s; }
        .sidebar-brand-text { transition: opacity 0.3s; white-space: nowrap; }
        
        /* Pas sidebar diringkas (AdminLTE pake sidebar-collapse) */
        .sidebar-collapse .sidebar-brand-text {
            display: none;
        }

        .sidebar-brand-icon img {
            transition: all 0.3s;
        }

        .sidebar-collapse .sidebar-brand-icon img {
            width: 35px !important; /* Dikecilkan dikit pas tertutup */
        }
        
        .sidebar-collapse .sidebar-brand {
            padding: 15px 0 !important;
        }

        /* --- Global Scroll System for Admin Content --- */
        .mawar-scroll {
            max-height: 500px;
            overflow-y: auto;
            overflow-x: auto; /* Agar tabel lebar bisa geser kiri-kanan di HP */
            scrollbar-width: thin;
            scrollbar-color: #E8622A transparent;
            padding-right: 5px;
        }
        .mawar-scroll::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        .mawar-scroll::-webkit-scrollbar-track {
            background: transparent;
        }
        .mawar-scroll::-webkit-scrollbar-thumb {
            background: #E8622A;
            border-radius: 10px;
        }

        /* Responsivitas Card Body & Tabel di Mobile */
        .btn-action-mobile {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 6px 12px;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 6px;
            min-height: 36px;
            transition: all 0.2s ease-in-out;
        }

        .table-responsive-indicator {
            display: none;
            text-align: center;
            font-size: 0.8rem;
            color: #E8622A;
            margin-bottom: 10px;
            font-weight: 600;
            animation: mawarPulse 1.5s infinite;
        }

        @keyframes mawarPulse {
            0% { opacity: 0.5; transform: scale(0.98); }
            50% { opacity: 1; transform: scale(1); }
            100% { opacity: 0.5; transform: scale(0.98); }
        }

        @media (max-width: 768px) {
            .card-body {
                overflow-x: auto !important;
                -webkit-overflow-scrolling: touch;
            }
            .mawar-scroll {
                max-height: 400px;
            }
            .content-header h1 {
                font-size: 1.5rem;
            }
            .table-responsive-indicator {
                display: block;
            }
            
            /* Improve mobile table display */
            .table { font-size: 0.85rem; }
            .table thead th { padding: 0.6rem 0.4rem; }
            .table td { padding: 0.6rem 0.4rem; }
            
            /* Mobile friendly form layout */
            .form-group { margin-bottom: 0.75rem; }
            .form-control { font-size: 1rem; }
            
            /* Hide unnecessary columns on mobile */
            .table .d-none-sm { display: none; }
        }
        
        @media (max-width: 576px) {
            .btn-action-mobile {
                padding: 10px 16px;
                font-size: 0.9rem;
                min-height: 44px; /* Touch target standard */
            }
        }
        
        @media (max-width: 480px) {
            /* Membiarkan responsivitas sidebar bawaan AdminLTE bekerja dengan sempurna tanpa crash */
            .table { font-size: 0.78rem; }
        }

        /* --- iOS Style Dark Mode Toggle --- */
        .ios-toggle-container {
            display: flex;
            align-items: center;
        }
        .ios-toggle {
            display: none;
        }
        .ios-toggle-label {
            width: 54px;
            height: 28px;
            background-color: #cbd5e1;
            border-radius: 50px;
            position: relative;
            cursor: pointer;
            transition: background-color 0.4s ease;
            margin: 0;
            box-shadow: inset 0 0 5px rgba(0,0,0,0.1);
        }
        .ios-toggle-label::after {
            content: '';
            width: 22px;
            height: 22px;
            background-color: white;
            border-radius: 50%;
            position: absolute;
            top: 3px;
            left: 3px;
            transition: transform 0.4s cubic-bezier(0.4, 0.0, 0.2, 1);
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            z-index: 2;
        }
        .ios-toggle-label .fa-sun {
            position: absolute;
            left: 7px;
            top: 7px;
            font-size: 14px;
            color: #f59e0b;
            z-index: 1;
        }
        .ios-toggle-label .fa-moon {
            position: absolute;
            right: 7px;
            top: 7px;
            font-size: 14px;
            color: #f1f5f9;
            z-index: 1;
        }
        .ios-toggle:checked + .ios-toggle-label {
            background-color: #E8622A; /* Tema Mawar */
        }
        .ios-toggle:checked + .ios-toggle-label::after {
            transform: translateX(26px);
        }

        /* Dark Mode navbar adjustments */
        body.dark-mode .main-header {
            background-color: #1A0F08 !important;
            border-bottom-color: #4B3224 !important;
        }
        body.dark-mode .main-header .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
        }
        body.dark-mode .main-header .nav-link:hover {
            color: #fff !important;
        }

        /* --- Smooth Transition for Dark Mode --- */
        body.theme-transition,
        body.theme-transition *,
        body.theme-transition *:before,
        body.theme-transition *:after {
            transition: background-color 0.5s ease, color 0.5s ease, border-color 0.5s ease, box-shadow 0.5s ease !important;
            transition-delay: 0s !important;
        }
    </style>
