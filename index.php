<?php
include 'includes/logic.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warkop Mawar - Tempat Nongkrong & Ngopi Asik di Bondowoso</title>
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

    <!-- PRELOADER -->
    <div id="preloader">
        <div class="loader-ring"></div>
        <div class="pl-wordmark t-preloader text-fade">Warkop Mawar</div>
        <div class="pl-sub">Menyeduh Kopi...</div>
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

    <!-- HERO -->
    <section id="home" class="hero">
        <div class="hero-video-container">
            <video autoplay loop muted playsinline class="hero-video active" id="hv0"><source src="images/<?= !empty($tentang['video_1']) ? htmlspecialchars($tentang['video_1']) : 'vidio-2.webm'; ?>" type="video/webm"></video>
            <video loop muted playsinline class="hero-video" id="hv1"><source src="images/<?= !empty($tentang['video_2']) ? htmlspecialchars($tentang['video_2']) : 'vidio-1.webm'; ?>" type="video/webm"></video>
            <video loop muted playsinline class="hero-video" id="hv2"><source src="images/<?= !empty($tentang['video_3']) ? htmlspecialchars($tentang['video_3']) : 'vidio-3.webm'; ?>" type="video/webm"></video>
            <video loop muted playsinline class="hero-video" id="hv3"><source src="images/<?= !empty($tentang['video_4']) ? htmlspecialchars($tentang['video_4']) : 'vidio-4.webm'; ?>" type="video/webm"></video>
            <video loop muted playsinline class="hero-video" id="hv4"><source src="images/<?= !empty($tentang['video_5']) ? htmlspecialchars($tentang['video_5']) : 'vidio-5.webm'; ?>" type="video/webm"></video>
            <video loop muted playsinline class="hero-video" id="hv5"><source src="images/<?= !empty($tentang['video_6']) ? htmlspecialchars($tentang['video_6']) : 'vidio-6.webm'; ?>" type="video/webm"></video>
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-video-dots" id="videoDots">
            <button class="vdot active" data-idx="0"></button>
            <button class="vdot" data-idx="1"></button>
            <button class="vdot" data-idx="2"></button>
            <button class="vdot" data-idx="3"></button>
            <button class="vdot" data-idx="4"></button>
            <button class="vdot" data-idx="5"></button>
        </div>
        <div class="hero-content">
            <div class="hero-eyebrow t-hero-eyebrow teks-judul-beranda">Warkop Mawar — Bondowoso</div>
            <h1 class="t-hero-title text-fade">Selamat Datang di<br>Warkop <em>Mawar</em></h1>
            <p class="hero-desc t-hero-desc text-fade">Nongkrong industrial-cozy di Bondowoso. Kopi mantap, suasana adem oren-abu, bikin betah dari senja sampe malam.</p>
            <div class="hero-actions">
                <a href="#menu" class="btn-primary t-hero-btn text-fade">
                    Lihat Menu
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8H13M13 8L9 4M13 8L9 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                <a href="#about" class="btn-ghost t-hero-ghost text-fade">Tentang Kami</a>
            </div>
        </div>
        <div class="hero-scroll">
            <div class="scroll-line"></div>
            <span class="scroll-label">Scroll</span>
        </div>
    </section>

    <!-- STATS -->
    <!-- STATS BAND - Data dinamis dari database -->
    <div class="stats-band">
        <div class="stat-item reveal"><span class="stat-num"><?= $total_menu; ?>+</span><span class="stat-label t-stat-1">Item Menu</span></div>
        <div class="stat-item reveal" style="transition-delay:0.1s"><span class="stat-num"><?= $harga_display; ?></span><span class="stat-label t-stat-2">Mulai Dari</span></div>
        <div class="stat-item reveal" style="transition-delay:0.2s"><span class="stat-num">∞</span><span class="stat-label t-stat-3">Betah Nongkrong</span></div>
        <div class="stat-item reveal" style="transition-delay:0.3s"><span class="stat-num">1</span><span class="stat-label t-stat-4">Spot Terbaik</span></div>
    </div>

    <!-- ABOUT -->
    <section id="about">
        <div class="about-hero-stmt">
            <div class="about-stmt-left reveal">
                <div class="about-stmt-label t-about-eyebrow">Cerita Kami</div>
                <h2 class="about-stmt-title t-about-title">Tentang<br>Warkop<em>Mawar</em></h2>
            </div>
            <div class="about-stmt-right">
                <p class="about-stmt-body t-about-p1 reveal" style="transition-delay:0.15s">Warkop Mawar lahir dari keyakinan sederhana — <strong>kopi yang enak seharusnya bisa dinikmati semua orang</strong>, tanpa perlu merogoh kantong dalam-dalam. Kami bukan sekadar warung kopi.</p>
                <p class="about-stmt-body t-about-p2 reveal" style="transition-delay:0.25s">Kami adalah tempat di mana <strong>ide-ide besar lahir, cerita lama dikenang</strong>, dan sore hari terasa lebih panjang. Dengan konsep industrial abu-abu yang dibalut kehangatan warna oren, setiap sudut Warkop Mawar dirancang untuk bikin kamu betah.</p>
                <div class="about-est reveal" style="transition-delay:0.35s">
                    <div class="about-est-dot"></div>
                    <span class="about-est-text">Berdiri Sejak</span>
                    <span class="about-est-year">2024</span>
                    <span class="about-est-text">· Bondowoso</span>
                </div>
            </div>
        </div>

        <!-- BAGIAN QUOTE & FOTO UTAMA (DINAMIS) -->
        <div class="about-photo-row">
            <div class="about-photo-main reveal">
                <!-- Foto ditarik dari database kolom foto_utama -->
                <img loading="lazy" src="images/<?= $tentang['foto_utama']; ?>" alt="Warkop Mawar Interior">
                <div class="about-photo-overlay"></div>
            </div>
            <div class="about-pullquote">
                <span class="pullquote-mark">"</span>
                <!-- Teks ditarik dari database kolom quote_text -->
                <p class="pullquote-text"><?= nl2br(htmlspecialchars($tentang['quote_text'])); ?></p>
                <div class="pullquote-attr">Warkop Mawar, Bondowoso</div>
            </div>
        </div>

        <div class="about-values">
            <div class="about-values-header reveal">
                <div class="section-eyebrow t-values-eyebrow">Kenapa Kami</div>
                <h3 class="section-title t-values-title">Yang Bikin <em>Kami</em><br>Berbeda</h3>
            </div>
            <div class="about-values-grid">
                <div class="value-card reveal">
                    <div class="value-num">01</div>
                    <div class="value-title t-val-1-title">Kopi Pilihan</div>
                    <div class="value-desc t-val-1-desc">Biji kopi dipilih dengan teliti untuk menghadirkan cita rasa terbaik di setiap cangkir.</div>
                </div>
                <div class="value-card reveal" style="transition-delay:0.1s">
                    <div class="value-num">02</div>
                    <div class="value-title t-val-2-title">Harga Ramah</div>
                    <div class="value-desc t-val-2-desc">Mulai dari Rp<?= number_format($harga_min, 0, ',', '.'); ?>, semua kalangan bisa menikmati kopi enak tanpa was-was soal dompet.</div>
                </div>
                <div class="value-card reveal" style="transition-delay:0.2s">
                    <div class="value-num">03</div>
                    <div class="value-title t-val-3-title">Suasana Cozy</div>
                    <div class="value-desc t-val-3-desc">Industrial minimalis abu-abu bertemu oren hangat. Cocok buat kerja, ngobrol, atau sekadar diam.</div>
                </div>
                <div class="value-card reveal" style="transition-delay:0.3s">
                    <div class="value-num">04</div>
                    <div class="value-title t-val-4-title">Open Late</div>
                    <div class="value-desc t-val-4-desc">Buka sampai tengah malam, Warkop Mawar setia menemani malam panjangmu setiap hari.</div>
                </div>
            </div>
        </div>

        <div class="about-story-strip">
            <div class="story-text">
                <div class="story-label t-story-label">Lebih Dari Sekadar Kopi</div>
                <h3 class="story-title t-story-title">Kami Ada untuk<br><em>Momen</em> Terbaik<br>Kamu</h3>
                <p class="story-body t-story-body">Dari satu cangkir kopi susu pagi hari, hingga obrolan seru tengah malam — Warkop Mawar hadir untuk semua momen. Cek juga <strong>mawar cantik di area kasir</strong>, sentuhan kecil yang jadi kebanggaan kami.</p>
                <p class="story-body t-story-body2" style="margin-top:-4px;">Kami juga melayani <strong>coffee booth untuk acara pernikahan & event</strong>. Bawa suasana kopi terbaik ke momen spesialmu.</p>
            </div>
            <!-- BAGIAN 3 FOTO MOMEN (DINAMIS) -->
            <div class="story-photos reveal" style="transition-delay:0.1s">
                <!-- Foto 1 -->
                <div class="sp-img" onclick="openLightbox('images/<?= htmlspecialchars($tentang['foto_1']); ?>','Momen 1 · Warkop Mawar')">
                    <img loading="lazy" src="images/<?= htmlspecialchars($tentang['foto_1']); ?>" alt="Suasana Warkop Mawar">
                    <div class="lb-zoom-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg></div>
                </div>
                <!-- Foto 2 -->
                <div class="sp-img" onclick="openLightbox('images/<?= htmlspecialchars($tentang['foto_2']); ?>','Momen 2 · Warkop Mawar')">
                    <img loading="lazy" src="images/<?= htmlspecialchars($tentang['foto_2']); ?>" alt="Visi Misi">
                    <div class="lb-zoom-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg></div>
                </div>
                <!-- Foto 3 -->
                <div class="sp-img" onclick="openLightbox('images/<?= htmlspecialchars($tentang['foto_3']); ?>','Momen 3 · Warkop Mawar')">
                    <img loading="lazy" src="images/<?= htmlspecialchars($tentang['foto_3']); ?>" alt="Target Pasar">
                    <div class="lb-zoom-icon"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg></div>
                </div>
            </div>
        </div>
    </section>

    <!-- GALLERY STRIP - DINAMIS -->
    <div class="gallery-strip">
        <div class="gallery-track" id="galleryTrack">
            <?php 
            // Generate carousel items dynamically
            foreach($carousel_items as $item) {
                $image_file = $item['gambar'];
                $alt_text = htmlspecialchars($item['nama_menu']);
                echo '<div class="gallery-item"><img loading="lazy" src="images/'.$image_file.'" alt="'.$alt_text.'" onerror="this.src=\'images/placeholder.png\'"></div>';
            }
            ?>
            <!-- Duplication for infinite scroll effect -->
            <?php 
            foreach($carousel_items as $item) {
                $image_file = $item['gambar'];
                $alt_text = htmlspecialchars($item['nama_menu']);
                echo '<div class="gallery-item"><img loading="lazy" src="images/'.$image_file.'" alt="'.$alt_text.'" onerror="this.src=\'images/placeholder.png\'"></div>';
            }
            ?>
        </div>
    </div>

    <!-- GALERI MASONRY (Udah Diperbaiki) -->
    <section id="galeri">
        <div class="galeri-header reveal">
            <div>
                <div class="section-eyebrow t-galeri-eyebrow">Suasana Kami</div>
                <h2 class="section-title t-galeri-title text-fade">Galeri <em>Mawar</em></h2>
            </div>
            <div class="galeri-header-right">
                <p class="galeri-desc t-galeri-desc text-fade">Intip suasana Warkop Mawar — dari sudut favorit sampai momen seru pelanggan.</p>
                <div class="galeri-count t-galeri-count">
                    <!-- Menghitung otomatis ada berapa foto di database -->
                    <?= mysqli_num_rows($q_galeri); ?>+
                </div>
            </div>
        </div>

        <div class="galeri-masonry">
            <?php 
            // Kita reset cursor databasenya biar loopingnya aman
            if(mysqli_num_rows($q_galeri) > 0) {
                mysqli_data_seek($q_galeri, 0); 
                while($g = mysqli_fetch_assoc($q_galeri)) { 
            ?>
                <!-- Tambahin onclick biar fotonya bisa di-klik & muncul gede (Lightbox) -->
                <div class="gm-item reveal" onclick="openLightbox('images/<?= htmlspecialchars($g['gambar']); ?>','<?= htmlspecialchars($g['judul']); ?>')">
                    <img loading="lazy" src="images/<?= htmlspecialchars($g['gambar']); ?>" alt="<?= htmlspecialchars($g['judul']); ?>">
                    <div class="gm-caption">
                        <span class="gm-caption-text"><?= htmlspecialchars($g['judul']); ?></span>
                    </div>
                </div>
            <?php 
                } 
            }
            ?>
        </div>
    </section>

    <!-- DYNAMIC MOTTO -->
    <div class="dynamic-motto-wrap">
        <div class="dynamic-motto">
            <span class="static-text">Warkop Mawar —</span>
            <div class="rolling-words">
                <div class="rolling-words-inner">
                    <span>Kopi Segar</span>
                    <span>Harga Teman</span>
                    <span>Seduhan Jujur</span>
                    <span>Nongkrong Asik</span>
                    <span>Kopi Segar</span>
                </div>
            </div>
        </div>
    </div>

    <!-- MENU -->
    <section id="menu">
        <div class="menu-header">
            <div class="menu-header-left reveal">
                <div class="section-eyebrow t-menu-eyebrow">Pilihan Kami</div>
                <h2 class="section-title t-menu-title text-fade">Menu <em>Andalan</em><br>Kami</h2>
            </div>
        </div>

        <div class="menu-tabs">
            <button class="tab-btn active t-tab-minuman" data-tab="minuman">☕ Minuman</button>
            <button class="tab-btn t-tab-makanan" data-tab="makanan">🍛 Makanan</button>
        </div>

        <!-- MINUMAN -->
        <div class="tab-content active" id="tab-minuman">
            <div class="menu-grid" id="grid-minuman">
                <?php 
                $count = 0;
                foreach($minuman_all as $row) { 
                    $count++;
                    if($count > 6) break;
                    $has_ice = !empty($row['harga_ice']);
                    $harga_hot = $row['harga'];
                    $harga_ice = $has_ice ? $row['harga_ice'] : 0;
                ?>
                    <div class="menu-card reveal active <?= (isset($row['status']) && $row['status'] == 'habis') ? 'sold-out' : ''; ?>" <?= $has_ice ? "data-harga-hot='$harga_hot' data-harga-ice='$harga_ice' data-has-ice='1'" : ''; ?>>
                        <div class="menu-img-wrap" style="<?= (isset($row['status']) && $row['status'] == 'habis') ? 'filter: grayscale(1);' : ''; ?>">
                            <?php if(isset($row['status']) && $row['status'] == 'habis'): ?>
                                <div class="menu-card-tag" style="background: #555 !important; position: absolute; top: 10px; left: 10px; color: white; padding: 4px 8px; border-radius: 4px; font-weight: bold; z-index: 10; font-size: 0.8rem;">SOLD OUT</div>
                            <?php endif; ?>
                            <img loading="lazy" src="images/<?= htmlspecialchars($row['gambar']); ?>" class="menu-img" alt="Menu <?= htmlspecialchars($row['nama_menu']); ?> di Warkop Mawar" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="placeholder-menu" style="display: none;">Menu Image</div>
                        </div>
                        <div class="menu-card-body" style="<?= (isset($row['status']) && $row['status'] == 'habis') ? 'opacity: 0.6;' : ''; ?>">
                            <div class="menu-card-name"><?= htmlspecialchars($row['nama_menu']); ?></div>
                            <div class="menu-card-desc"><?= htmlspecialchars($row['deskripsi']); ?></div>
                            <?php if($has_ice): ?>
                            <div class="temp-toggle">
                                <button class="temp-btn temp-btn-hot active" data-temp="hot">🔥 Hot</button>
                                <button class="temp-btn temp-btn-ice" data-temp="ice">🧊 Ice</button>
                            </div>
                            <?php endif; ?>
                            <div class="menu-card-footer">
                                <span class="menu-card-price">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></span>
                                <?php if(!isset($row['status']) || $row['status'] == 'tersedia'): ?>
                                    <button class="add-btn">+</button>
                                <?php else: ?>
                                    <button class="add-btn" disabled style="background: #ccc; cursor: not-allowed;">×</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <?php if(count($minuman_all) > 6): ?>
            <div class="menu-extra" id="extra-minuman">
                <div class="menu-grid">
                    <?php 
                    for($i = 6; $i < count($minuman_all); $i++) { 
                        $row = $minuman_all[$i];
                        $has_ice = !empty($row['harga_ice']);
                        $harga_hot = $row['harga'];
                        $harga_ice = $has_ice ? $row['harga_ice'] : 0;
                    ?>
                        <div class="menu-card reveal active <?= (isset($row['status']) && $row['status'] == 'habis') ? 'sold-out' : ''; ?>" <?= $has_ice ? "data-harga-hot='$harga_hot' data-harga-ice='$harga_ice' data-has-ice='1'" : ''; ?>>
                            <div class="menu-img-wrap" style="<?= (isset($row['status']) && $row['status'] == 'habis') ? 'filter: grayscale(1);' : ''; ?>">
                                <?php if(isset($row['status']) && $row['status'] == 'habis'): ?>
                                    <div class="menu-card-tag" style="background: #555 !important; position: absolute; top: 10px; left: 10px; color: white; padding: 4px 8px; border-radius: 4px; font-weight: bold; z-index: 10; font-size: 0.8rem;">SOLD OUT</div>
                                <?php endif; ?>
                                <img loading="lazy" src="images/<?= htmlspecialchars($row['gambar']); ?>" class="menu-img" alt="Menu <?= htmlspecialchars($row['nama_menu']); ?> di Warkop Mawar" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="placeholder-menu" style="display: none;">Menu Image</div>
                            </div>
                            <div class="menu-card-body" style="<?= (isset($row['status']) && $row['status'] == 'habis') ? 'opacity: 0.6;' : ''; ?>">
                                <div class="menu-card-name"><?= htmlspecialchars($row['nama_menu']); ?></div>
                                <div class="menu-card-desc"><?= htmlspecialchars($row['deskripsi']); ?></div>
                                <?php if($has_ice): ?>
                                <div class="temp-toggle">
                                    <button class="temp-btn temp-btn-hot active" data-temp="hot">🔥 Hot</button>
                                    <button class="temp-btn temp-btn-ice" data-temp="ice">🧊 Ice</button>
                                </div>
                                <?php endif; ?>
                                <div class="menu-card-footer">
                                    <span class="menu-card-price">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></span>
                                    <?php if(!isset($row['status']) || $row['status'] == 'tersedia'): ?>
                                        <button class="add-btn">+</button>
                                    <?php else: ?>
                                        <button class="add-btn" disabled style="background: #ccc; cursor: not-allowed;">×</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="show-more-wrap">
                <button class="btn-more t-btn-more-minuman" onclick="toggleMore('minuman')">Lihat Menu Lainnya ▼</button>
            </div>
            <?php endif; ?>
        </div> <!-- PENUTUP tab-minuman (Tadinya lu lupa naruh ini brok!) -->

        <!-- MAKANAN -->
        <div class="tab-content" id="tab-makanan">
            <div class="menu-grid" id="grid-makanan">
                <?php 
                $count = 0;
                foreach($makanan_all as $row) { 
                    $count++;
                    if($count > 6) break;
                ?>
                    <div class="menu-card reveal active <?= (isset($row['status']) && $row['status'] == 'habis') ? 'sold-out' : ''; ?>">
                        <div class="menu-img-wrap" style="<?= (isset($row['status']) && $row['status'] == 'habis') ? 'filter: grayscale(1);' : ''; ?>">
                            <?php if(isset($row['status']) && $row['status'] == 'habis'): ?>
                                <div class="menu-card-tag" style="background: #555 !important; position: absolute; top: 10px; left: 10px; color: white; padding: 4px 8px; border-radius: 4px; font-weight: bold; z-index: 10; font-size: 0.8rem;">SOLD OUT</div>
                            <?php endif; ?>
                            <img loading="lazy" src="images/<?= htmlspecialchars($row['gambar']); ?>" class="menu-img" alt="Menu <?= htmlspecialchars($row['nama_menu']); ?> di Warkop Mawar">
                        </div>
                        <div class="menu-card-body" style="<?= (isset($row['status']) && $row['status'] == 'habis') ? 'opacity: 0.6;' : ''; ?>">
                            <div class="menu-card-name"><?= htmlspecialchars($row['nama_menu']); ?></div>
                            <div class="menu-card-desc"><?= htmlspecialchars($row['deskripsi']); ?></div>
                            <div class="menu-card-footer">
                                <span class="menu-card-price">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></span>
                                <?php if(!isset($row['status']) || $row['status'] == 'tersedia'): ?>
                                    <button class="add-btn">+</button>
                                <?php else: ?>
                                    <button class="add-btn" disabled style="background: #ccc; cursor: not-allowed;">×</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <?php if(count($makanan_all) > 6): ?>
            <div class="menu-extra" id="extra-makanan">
                <div class="menu-grid">
                    <?php 
                    for($i = 6; $i < count($makanan_all); $i++) { 
                        $row = $makanan_all[$i];
                    ?>
                        <div class="menu-card reveal active <?= (isset($row['status']) && $row['status'] == 'habis') ? 'sold-out' : ''; ?>">
                            <div class="menu-img-wrap" style="<?= (isset($row['status']) && $row['status'] == 'habis') ? 'filter: grayscale(1);' : ''; ?>">
                                <?php if(isset($row['status']) && $row['status'] == 'habis'): ?>
                                    <div class="menu-card-tag" style="background: #555 !important; position: absolute; top: 10px; left: 10px; color: white; padding: 4px 8px; border-radius: 4px; font-weight: bold; z-index: 10; font-size: 0.8rem;">SOLD OUT</div>
                                <?php endif; ?>
                                <img loading="lazy" src="images/<?= htmlspecialchars($row['gambar']); ?>" class="menu-img" alt="Menu <?= htmlspecialchars($row['nama_menu']); ?> di Warkop Mawar">
                            </div>
                            <div class="menu-card-body" style="<?= (isset($row['status']) && $row['status'] == 'habis') ? 'opacity: 0.6;' : ''; ?>">
                                <div class="menu-card-name"><?= htmlspecialchars($row['nama_menu']); ?></div>
                                <div class="menu-card-desc"><?= htmlspecialchars($row['deskripsi']); ?></div>
                                <div class="menu-card-footer">
                                    <span class="menu-card-price">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></span>
                                    <?php if(!isset($row['status']) || $row['status'] == 'tersedia'): ?>
                                        <button class="add-btn">+</button>
                                    <?php else: ?>
                                        <button class="add-btn" disabled style="background: #ccc; cursor: not-allowed;">×</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="show-more-wrap">
                <button class="btn-more t-btn-more-makanan" onclick="toggleMore('makanan')">Lihat Menu Lainnya ▼</button>
            </div>
            <?php endif; ?>
        </div> <!-- PENUTUP tab-makanan -->
    </section>

    <!-- LOKASI -->
    <section id="lokasi">
        <div class="lokasi-inner">
            <div class="lokasi-map-wrap reveal" style="position: relative; z-index: 1;">
                <!-- Leaflet Map Container -->
                <div id="map" style="width: 100%; height: 100%; border:0; min-height: 400px; border-radius: 12px; z-index: 1;"></div>
            </div>
            <div class="lokasi-info">
                <div class="reveal">
                    <div class="section-eyebrow t-lokasi-eyebrow">Temukan Kami</div>
                    <h2 class="section-title t-lokasi-title text-fade">Lokasi <em>Kami</em></h2>
                </div>
                <p class="lokasi-address t-lokasi-address reveal" style="transition-delay:0.1s"><strong>Warkop Mawar</strong> berlokasi di Bondowoso, Jawa Timur. Gampang dijangkau, parkir luas, dan tempatnya adem buat nongkrong dari sore sampe malam.</p>
                <div class="lokasi-hours reveal" style="transition-delay:0.2s">
                    <div class="lokasi-hours-title t-lokasi-hours-title">Jam Buka</div>
                    <div class="lokasi-hours-row"><span class="t-lokasi-day1">Everyday</span><span>09:00 – 00:00</span></div>
                </div>
                <a href="https://maps.app.goo.gl/DyufcHiVK3apKeKk7" target="_blank" rel="noopener" class="btn-maps reveal t-lokasi-btn" style="transition-delay:0.3s">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Buka Google Maps
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="footer-inner">
            <div class="footer-brand">
                <div class="logo-main t-logo-footer">Warkop <span>Mawar</span></div>
                <p class="footer-tagline t-footer-tagline">Seduhan jujur untuk semua. Tempat santai terbaik di Bondowoso.</p>
                <div class="footer-socials">
                    <a href="<?= htmlspecialchars($pengaturan_web['link_tiktok']); ?>" target="_blank" rel="noopener" class="social-link" aria-label="TikTok">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1v-3.52a6.37 6.37 0 0 0-.79-.05A6.34 6.34 0 0 0 3.15 15a6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.34-6.34V8.7a8.16 8.16 0 0 0 4.76 1.52v-3.4a4.85 4.85 0 0 1-1-.13z"/></svg>
                    </a>
                    <a href="<?= htmlspecialchars($pengaturan_web['link_ig']); ?>" target="_blank" rel="noopener" class="social-link" aria-label="Instagram">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                    <a href="https://food.grab.com/id/id/restaurant/warkop-mawar-badean-delivery/6-C3CYEXEEBA5XR6" target="_blank" rel="noopener" class="social-link" aria-label="GrabFood" style="background: rgba(0,177,79,0.12); border-color: rgba(0,177,79,0.3);">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="color: #00b14f;"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8h-2.4v1.6h2.4c-.32 2.72-2.72 4.8-5.44 4.8-3.04 0-5.52-2.4-5.6-5.36h3.12v-1.6H5.6C5.92 5.52 8.64 3.2 11.84 3.2c1.68 0 3.2.72 4.32 1.84l-1.12 1.12c-.8-.8-1.92-1.36-3.2-1.36-2.4 0-4.4 1.76-4.8 4.08h6.48v1.6H7.04c.4 2.32 2.4 4.08 4.8 4.08 2.24 0 4.08-1.52 4.64-3.52h-3.36v-1.6h4.72c0 .24.08.56.08.8-.08-.16-.16-.32-.28-.44z"/></svg>
                    </a>
                    <a href="https://shopee.co.id/universal-link/now-food/shop/22679728?deep_and_deferred=1&shareChannel=whatsapp" target="_blank" rel="noopener" class="social-link" aria-label="ShopeeFood" style="background: rgba(238,77,45,0.12); border-color: rgba(238,77,45,0.3);">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="color: #EE4D2D;"><path d="M12 2C8.69 2 6 4.69 6 8h2c0-2.21 1.79-4 4-4s4 1.79 4 4h2c0-3.31-2.69-6-6-6zm-7 8l-1 12h16l-1-12H5zm4.5 3.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1-5 0z"/></svg>
                    </a>
                </div>
            </div>
            <div class="footer-links">
                <a href="#home" class="t-nav-home">Beranda</a>
                <a href="#about" class="t-nav-about">Tentang</a>
                <a href="#galeri" class="t-nav-galeri">Galeri</a>
                <a href="#menu" class="t-nav-menu">Menu</a>
                <a href="#lokasi" class="t-nav-lokasi">Lokasi</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p class="footer-copy t-footer">&copy; 2026 <span>Warkop Mawar</span>. Dibuat oleh Tama.</p>
            <p class="footer-copy" style="color:rgba(244,239,230,0.1)">Bondowoso · Jawa Timur</p>
        </div>
    </footer>

<!-- ══════════════════════════════════════════════════════════
     PLATFORM FLOATING BUTTONS — FIXED: logo HD, object-fit:contain
     ══════════════════════════════════════════════════════════ -->
<div class="platform-btns" id="platformBtns">
    <!-- GrabFood -->
    <button class="platform-btn platform-btn-grab" id="btnGrab" aria-label="Pesan via GrabFood">
        <div class="platform-btn-icon-wrap">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8h-2.4v1.6h2.4c-.32 2.72-2.72 4.8-5.44 4.8-3.04 0-5.52-2.4-5.6-5.36h3.12v-1.6H5.6C5.92 5.52 8.64 3.2 11.84 3.2c1.68 0 3.2.72 4.32 1.84l-1.12 1.12c-.8-.8-1.92-1.36-3.2-1.36-2.4 0-4.4 1.76-4.8 4.08h6.48v1.6H7.04c.4 2.32 2.4 4.08 4.8 4.08 2.24 0 4.08-1.52 4.64-3.52h-3.36v-1.6h4.72c0 .24.08.56.08.8-.08-.16-.16-.32-.28-.44z"/></svg>
        </div>
        <span class="platform-btn-label">GrabFood</span>
        <span class="platform-btn-tooltip">Pesan via GrabFood</span>
    </button>
    <!-- ShopeeFood -->
    <button class="platform-btn platform-btn-shopee" id="btnShopee" aria-label="Pesan via ShopeeFood">
        <div class="platform-btn-icon-wrap">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.69 2 6 4.69 6 8h2c0-2.21 1.79-4 4-4s4 1.79 4 4h2c0-3.31-2.69-6-6-6zm-7 8l-1 12h16l-1-12H5zm4.5 3.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1-5 0z"/></svg>
        </div>
        <span class="platform-btn-label">ShopeeFood</span>
        <span class="platform-btn-tooltip">Pesan via ShopeeFood</span>
    </button>
</div>

<!-- CART FAB -->
<button class="cart-fab" id="cartFab" aria-label="Keranjang">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
        <line x1="3" y1="6" x2="21" y2="6"/>
        <path d="M16 10a4 4 0 0 1-8 0"/>
    </svg>
    <span class="cart-badge" id="cartBadge">0</span>
</button>

<!-- CART OVERLAY -->
<div class="cart-overlay" id="cartOverlay"></div>

<!-- CART DRAWER -->
<div class="cart-drawer" id="cartDrawer">
    <div class="cart-drawer-header">
        <div class="cart-drawer-title">Keranjang <span>Pesanan</span></div>
        <button class="cart-close-btn" id="cartCloseBtn" aria-label="Tutup">✕</button>
    </div>
    <div class="cart-empty" id="cartEmpty">
        <svg class="cart-empty-icon" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="rgba(244,239,230,0.3)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
            <line x1="3" y1="6" x2="21" y2="6"/>
            <path d="M16 10a4 4 0 0 1-8 0"/>
        </svg>
        <div class="cart-empty-text">Belum ada pesanan<br>Yuk pilih menu dulu!</div>
    </div>
    <div class="cart-items-list" id="cartItemsList" style="display:none"></div>
    <div class="cart-drawer-footer" id="cartFooter" style="display:none">
        <div class="cart-total-row">
            <span class="cart-total-label">Total Pesanan</span>
            <div class="cart-total-amount">Rp <span id="cartTotalNum">0</span></div>
        </div>
        <span class="cart-item-count-label" id="cartItemCountLabel">0 item</span>
        <div class="cart-note-wrap" style="margin-top: 12px;">
            <label class="cart-note-label" for="reservasiNama">Nama Pemesan <span style="color:red">*</span></label>
            <input type="text" class="cart-note-input" id="reservasiNama" placeholder="Masukkan nama..." required style="width:100%; box-sizing:border-box;">
        </div>
        <div class="cart-note-wrap">
            <label class="cart-note-label" for="reservasiWaktu">Waktu Kedatangan <span style="color:red">*</span></label>
            <input type="datetime-local" class="cart-note-input" id="reservasiWaktu" required style="width:100%; box-sizing:border-box;">
        </div>
        <div class="cart-note-wrap">
            <label class="cart-note-label" for="cartNote">Catatan (opsional)</label>
            <textarea class="cart-note-input" id="cartNote" rows="2" placeholder="Contoh: tanpa es, extra pedas..."></textarea>
        </div>
        <div class="cart-platform-info">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="rgba(244,239,230,0.3)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-top:1px;flex-shrink:0">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <div class="cart-platform-info-text">
                <strong>Mau pesan via GrabFood / ShopeeFood?</strong>
                Klik tombol <span style="color:rgba(232,98,42,0.7)">hijau</span> atau <span style="color:rgba(232,98,42,0.7)">merah</span> yang ada di sudut kanan bawah layar.
            </div>
        </div>
        <div class="order-divider">Pesan via WhatsApp</div>
        <div class="order-btns">
            <button class="order-btn order-btn-wa" id="btnOrderWa">
                <svg class="order-btn-icon" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                    <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.557 4.122 1.529 5.855L.057 23.428a.5.5 0 0 0 .611.611l5.577-1.466A11.944 11.944 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.891 0-3.659-.5-5.187-1.374l-.371-.219-3.843 1.011 1.027-3.744-.238-.389A9.944 9.944 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
                </svg>
                Pesan Sekarang via WhatsApp
            </button>
        </div>
    </div>
</div>

<!-- Toast -->
<div class="cart-toast" id="cartToast">
    <span class="cart-toast-icon">🛒</span>
    <div class="cart-toast-text">
        Ditambahkan ke keranjang
        <span class="cart-toast-name" id="cartToastName"></span>
    </div>
</div>

    <script>
        const WA_NUMBER = '<?= htmlspecialchars($pengaturan['wa_number']); ?>';
        const CSRF_TOKEN = '<?= $_SESSION['frontend_csrf_token']; ?>';
    </script>
    <script src="assets/js/main.js"></script>
    
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    
    <!-- Kontainer Tersembunyi di Luar Nav/notranslate -->
    <div class="hidden-translate-container">
        <div id="google_translate_element"></div>
    </div>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script>
    const fill  = document.getElementById('fill');
    const pct   = document.getElementById('pct');
    const loader= document.getElementById('loader');
    const mainContent  = document.getElementById('main-content');

    const msgs = ['Menyeduh kopi...','Memanaskan mesin...','Menyiapkan menu...','Selamat datang! ☕'];
    let p = 0, mi = 0;

    const iv = setInterval(()=>{
      p = Math.min(p + Math.random()*4 + 1, 100);
      fill.style.width = p + '%';
      const idx = Math.floor(p / 34);
      if(idx !== mi && idx < msgs.length){ mi = idx; pct.textContent = msgs[mi]; }
      if(p >= 100){
        clearInterval(iv);
        pct.textContent = msgs[3];
        setTimeout(()=>{
          loader.classList.add('hide');
          document.body.classList.remove('no-scroll');
          if (mainContent) mainContent.style.opacity = '1';
        }, 600);
      }
    },60);
    </script>
</div> <!-- End of main-content -->
</body>
</html>
