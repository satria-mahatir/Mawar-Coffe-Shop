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
