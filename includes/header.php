<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warkop Mawar - Tempat Nongkrong &amp; Ngopi Asik di Bondowoso</title>
    <meta name="description" content="Kunjungi Warkop Mawar! Nikmati berbagai pilihan kopi, minuman, dan makanan lezat dengan harga bersahabat. Tempat nongkrong paling asik dengan tema oren abu-abu.">
    <meta name="keywords" content="warkop mawar, warkop bondowoso, tempat ngopi asik, kopi murah, nongkrong, cafe oren abu abu">
    <meta name="author" content="Satria Nanda Tama">

    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="images/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="images/android-chrome-512x512.png">
    <meta name="theme-color" content="#E8622A">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/norwester" rel="stylesheet">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;1,400&family=Inter:wght@300;400&display=swap" rel="stylesheet"/>

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="no-scroll">

<div id="loader">
  <!-- Floating beans -->
  <div class="bean" style="--d:11s;--dl:0s;--r0:-20deg;--r1:160deg;width:18px;height:12px;background:#5c2a08;top:15%;left:12%"></div>
  <div class="bean" style="--d:14s;--dl:2s;--r0:30deg;--r1:200deg;width:14px;height:9px;background:#7a3c12;top:22%;left:82%"></div>
  <div class="bean" style="--d:9s;--dl:4s;--r0:-40deg;--r1:140deg;width:20px;height:13px;background:#4a1e05;top:70%;left:8%"></div>
  <div class="bean" style="--d:13s;--dl:1s;--r0:15deg;--r1:190deg;width:16px;height:10px;background:#6e3510;top:75%;left:88%"></div>
  <div class="bean" style="--d:10s;--dl:6s;--r0:-10deg;--r1:170deg;width:12px;height:8px;background:#8a4a18;top:40%;left:4%"></div>
  <div class="bean" style="--d:16s;--dl:3s;--r0:50deg;--r1:220deg;width:22px;height:14px;background:#3e1804;top:50%;left:93%"></div>

  <!-- Particles -->
  <div class="particle" style="--px:20%;--pd:12s;--pdl:0s;--ps:4px"></div>
  <div class="particle" style="--px:35%;--pd:9s;--pdl:2s;--ps:6px"></div>
  <div class="particle" style="--px:55%;--pd:14s;--pdl:1s;--ps:3px"></div>
  <div class="particle" style="--px:70%;--pd:11s;--pdl:5s;--ps:5px"></div>
  <div class="particle" style="--px:80%;--pd:8s;--pdl:3s;--ps:7px"></div>
  <div class="particle" style="--px:10%;--pd:15s;--pdl:4s;--ps:4px"></div>

  <!-- Coffee Cup -->
  <div class="cup-wrap">
    <div class="steam">
      <div class="s"></div><div class="s"></div><div class="s"></div><div class="s"></div>
    </div>
    <svg class="cup-svg" width="110" height="110" viewBox="0 0 110 110" fill="none" xmlns="http://www.w3.org/2000/svg">
      <!-- Saucer -->
      <ellipse cx="55" cy="97" rx="44" ry="8" fill="#2a1205" stroke="#c8963e" stroke-width="1"/>
      <!-- Cup body -->
      <path d="M20 55 Q18 85 30 92 Q55 98 80 92 Q92 85 90 55 Z" fill="#1a0902" stroke="#c8963e" stroke-width="1.5"/>
      <!-- Cup top rim -->
      <ellipse cx="55" cy="55" rx="35" ry="8" fill="#2a1205" stroke="#c8963e" stroke-width="1.5"/>
      <!-- Coffee surface -->
      <ellipse cx="55" cy="55" rx="30" ry="6" fill="#3d1f0a"/>
      <!-- Latte art - simple swirl -->
      <path d="M48 53 Q55 50 62 53 Q58 57 55 56 Q52 55 48 53" fill="rgba(200,150,80,.35)" stroke="none"/>
      <circle cx="55" cy="54" r="4" fill="none" stroke="rgba(200,150,80,.2)" stroke-width="1"/>
      <!-- Handle -->
      <path d="M90 62 Q108 62 108 74 Q108 86 90 86" fill="none" stroke="#c8963e" stroke-width="2.5" stroke-linecap="round"/>
      <!-- Shine -->
      <path d="M32 65 Q34 75 36 82" stroke="rgba(255,220,180,.12)" stroke-width="3" stroke-linecap="round"/>
    </svg>
  </div>

  <!-- Brand -->
  <div class="brand-loader">
    <div class="brand-title">Mawar <span>Coffee</span> Shop</div>
    <div class="brand-sub">Est. — Bondowoso</div>
  </div>

  <div class="divider"></div>

  <!-- Progress -->
  <div class="progress-wrap">
    <div class="progress-track">
      <div class="progress-fill" id="fill"></div>
    </div>
    <div class="progress-label" id="pct">Menyeduh kopi...</div>
  </div>

  <div class="tagline">"Every cup tells a story"</div>
</div>

<div id="main-content" style="opacity:0; transition:opacity 1s ease;">

    <div id="cursor"></div>
    <div id="cursor-ring"></div>

    <!-- LIGHTBOX -->
    <div id="lightbox" onclick="handleLightboxClick(event)">
        <button class="lb-close" onclick="closeLightbox()">&times;</button>
        <div class="lb-img-wrap">
            <img loading="lazy" id="lb-img" src="" alt="">
        </div>
        <div class="lb-caption" id="lb-caption"></div>
    </div>

    <!-- ECO SCREENSAVER -->
    <div id="eco-screen" onclick="dismissEcoScreen()" ontouchstart="dismissEcoScreen()">
        <div class="eco-orb"></div>
        <div class="eco-orb"></div>
        <div class="eco-orb"></div>
        <div class="eco-content">
            <div class="eco-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#E8622A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 22c1.25-1.25 2.5-3.5 2.5-6.5C4.5 11 7 8.5 12 8.5s7.5 2.5 7.5 7c0 3-1.25 5.25-2.5 6.5"/>
                    <path d="M12 8.5V2"/><path d="M8 5.5l4-3.5 4 3.5"/>
                </svg>
            </div>
            <div class="eco-brand t-eco-brand">Warkop <span>Mawar</span></div>
            <div class="eco-divider"></div>
            <div class="eco-headline t-eco-headline">Hargai lingkungan dengan tindakan sederhana</div>
            <p class="eco-body t-eco-body">Ketika perangkat kamu sedang tidak digunakan atau kamu sedang menelusuri laman lain, tampilan layar ini akan muncul sehingga dapat mengurangi daya yang digunakan.</p>
            <div class="eco-cta t-eco-cta">Klik di mana saja untuk melanjutkan</div>
        </div>
        <div class="eco-clock" id="ecoClockDisplay">00:00</div>
    </div>



    <!-- TOP BAR -->
    <div class="top-bar">
        <a href="<?= htmlspecialchars($pengaturan_web['link_maps']); ?>" target="_blank" rel="noopener" class="t-topbar">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            Bondowoso, Jawa Timur — Buka di Maps
        </a>
    </div>

    <!-- HEADER -->
    <header>
        <div class="logo-wrap">
            <div class="logo-main t-logo">Warkop <span>Mawar</span></div>
            <div class="logo-tag">Bondowoso · Est. 2024</div>
        </div>
        <nav>
            <ul class="nav-links">
                <li><a href="index.php" class="t-nav-home">Beranda</a></li>
                <li><a href="#about" class="t-nav-about">Tentang</a></li>
                <li><a href="#galeri" class="t-nav-galeri">Galeri</a></li>
                <li><a href="#menu" class="t-nav-menu">Menu</a></li>
                <li><a href="#lokasi" class="t-nav-lokasi">Lokasi</a></li>
            </ul>
            <div class="controls">
                <button id="langBtn" class="icon-btn" translate="no">EN</button>
                <button id="themeBtn" class="icon-btn" translate="no">🌙</button>
                <button class="hamburger" id="hamburger" aria-label="Menu" translate="no">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </nav>
    </header>

    <!-- MOBILE NAV -->
    <div class="mobile-nav" id="mobileNav">
        <a href="index.php" class="t-nav-home" onclick="closeMobileNav()">Beranda</a>
        <a href="#about" class="t-nav-about" onclick="closeMobileNav()">Tentang</a>
        <a href="#galeri" class="t-nav-galeri" onclick="closeMobileNav()">Galeri</a>
        <a href="#menu" class="t-nav-menu" onclick="closeMobileNav()">Menu</a>
        <a href="#lokasi" class="t-nav-lokasi" onclick="closeMobileNav()">Lokasi</a>
        <div class="mobile-controls">
                <button id="langBtnM" class="icon-btn" translate="no">EN</button>
            <button id="themeBtnM" class="icon-btn" translate="no">🌙</button>
        </div>
    </div>
