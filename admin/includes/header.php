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
        .main-sidebar { background-color: #1A0F08 !important; }
        .nav-link.active { background-color: #E8622A !important; }
        .brand-link { border-bottom: 1px solid #4B3224 !important; }
        .btn-mawar { background-color: #E8622A; color: white; border: none; }
        .btn-mawar:hover { background-color: #C04E1A; color: white; }

        /* --- Sidebar Branding Custom --- */
        .sidebar-brand {
            border-bottom: 1px solid #E8622A;
            padding: 15px 10px;
            text-align: center;
            transition: all 0.3s;
        }
        .brand-full img { max-width: 150px; height: auto; }
        .brand-icon img { width: 32px; height: 32px; }

        /* Kondisi Sidebar Normal */
        .brand-full { display: block; }
        .brand-icon { display: none; }

        /* Kondisi Sidebar Collapsed (AdminLTE pake sidebar-collapse di body) */
        .sidebar-collapse .brand-full { display: none !important; }
        .sidebar-collapse .brand-icon { display: block !important; }
        
        .sidebar-collapse .sidebar-brand {
            padding: 15px 0;
        }
    </style>
