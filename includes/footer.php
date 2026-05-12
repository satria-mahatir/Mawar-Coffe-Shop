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

    <script>
        window.WA_NUMBER = '6282244019596';
        const CSRF_TOKEN = '<?= $_SESSION["frontend_csrf_token"]; ?>';
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
    let pageLoaded = false;

    window.addEventListener('load', () => { pageLoaded = true; });

    const iv = setInterval(()=>{
      if(pageLoaded) {
          p = Math.min(p + 5, 100);
      } else {
          if (p < 90) {
              p = Math.min(p + Math.random()*3 + 0.5, 90);
          }
      }

      fill.style.width = p + '%';
      const idx = Math.floor(p / 34);
      if(idx !== mi && idx < msgs.length){ mi = idx; pct.textContent = msgs[mi]; }

      if(p >= 100 && pageLoaded){
        clearInterval(iv);
        pct.textContent = msgs[3];
        setTimeout(()=>{
          if (loader) loader.classList.add('hide');
          document.body.classList.remove('no-scroll');
          if (mainContent) mainContent.style.opacity = '1';
          if(typeof window.initMap === 'function') window.initMap();
          if(typeof window.initScrollReveal === 'function') window.initScrollReveal();
        }, 600);
      }
    }, 50);
    </script>
</div> <!-- End of main-content -->
</body>
</html>
