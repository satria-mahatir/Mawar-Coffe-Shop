    // ── CURSOR ──
    const cursor = document.getElementById('cursor');
    const ring = document.getElementById('cursor-ring');
    let mx = -100, my = -100, rx = -100, ry = -100;
    document.addEventListener('mousemove', e => { mx = e.clientX; my = e.clientY; });
    function animateCursor() {
        cursor.style.left = mx + 'px'; cursor.style.top = my + 'px';
        rx += (mx - rx) * 0.14; ry += (my - ry) * 0.14;
        ring.style.left = rx + 'px'; ring.style.top = ry + 'px';
        requestAnimationFrame(animateCursor);
    }
    animateCursor();
    document.querySelectorAll('a, button, .sp-img, .gm-item').forEach(el => {
        el.addEventListener('mouseenter', () => { cursor.style.width='20px'; cursor.style.height='20px'; ring.style.width='56px'; ring.style.height='56px'; ring.style.opacity='0.35'; });
        el.addEventListener('mouseleave', () => { cursor.style.width='12px'; cursor.style.height='12px'; ring.style.width='36px'; ring.style.height='36px'; ring.style.opacity='0.6'; });
    });



    // ── LIGHTBOX ──
    function openLightbox(src, caption) {
        const lb = document.getElementById('lightbox');
        document.getElementById('lb-img').src = src;
        document.getElementById('lb-caption').textContent = caption || '';
        lb.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeLightbox() {
        document.getElementById('lightbox').classList.remove('open');
        document.body.style.overflow = '';
        setTimeout(() => { document.getElementById('lb-img').src = ''; }, 450);
    }
    function handleLightboxClick(e) {
        if (e.target === document.getElementById('lightbox')) closeLightbox();
    }
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });

    // ── ECO SCREENSAVER ──
    const ecoScreen = document.getElementById('eco-screen');
    const ecoClockEl = document.getElementById('ecoClockDisplay');
    const IDLE_TIMEOUT = 3 * 60 * 1000;
    let idleTimer = null, ecoVisible = false, clockInterval = null;
    
    function updateEcoClock() {
        if (ecoVisible) {
            const now = new Date();
            ecoClockEl.textContent = String(now.getHours()).padStart(2,'0') + ':' + String(now.getMinutes()).padStart(2,'0');
        }
    }
    
    function startClockUpdates() {
        if (clockInterval) return;
        clockInterval = setInterval(updateEcoClock, 1000);
        updateEcoClock();
    }
    
    function stopClockUpdates() {
        if (clockInterval) {
            clearInterval(clockInterval);
            clockInterval = null;
        }
    }
    
    function showEcoScreen() { 
        if (ecoVisible) return; 
        ecoVisible = true; 
        ecoScreen.classList.add('visible'); 
        document.body.style.overflow = 'hidden';
        startClockUpdates();
    }
    
    function dismissEcoScreen() { 
        if (!ecoVisible) return; 
        ecoVisible = false; 
        ecoScreen.classList.remove('visible'); 
        document.body.style.overflow = ''; 
        stopClockUpdates();
        resetIdleTimer(); 
    }
    
    function resetIdleTimer() { 
        clearTimeout(idleTimer); 
        if (!ecoVisible) idleTimer = setTimeout(showEcoScreen, IDLE_TIMEOUT); 
    }
    
    ['mousemove','mousedown','keydown','scroll','touchstart','wheel','click'].forEach(evt => {
        document.addEventListener(evt, () => { if (!ecoVisible) resetIdleTimer(); }, { passive: true });
    });
    
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) { 
            stopClockUpdates();
            idleTimer = setTimeout(showEcoScreen, 30000); 
        }
        else { 
            clearTimeout(idleTimer); 
            if (ecoVisible) dismissEcoScreen(); 
            else resetIdleTimer(); 
        }
    });
    
    resetIdleTimer();

    // ── HERO VIDEO SWITCHER ──
    const heroVideos = document.querySelectorAll('.hero-video');
    const vdots = document.querySelectorAll('.vdot');
    let currentVideo = 0, videoInterval;
    function switchVideo(idx) {
        heroVideos[currentVideo].classList.remove('active'); vdots[currentVideo].classList.remove('active'); heroVideos[currentVideo].pause();
        currentVideo = idx; heroVideos[currentVideo].classList.add('active'); vdots[currentVideo].classList.add('active'); heroVideos[currentVideo].play();
    }
    function nextVideo() { switchVideo((currentVideo + 1) % heroVideos.length); }
    vdots.forEach(dot => { dot.addEventListener('click', () => { clearInterval(videoInterval); switchVideo(parseInt(dot.dataset.idx)); videoInterval = setInterval(nextVideo, 8000); }); });
    videoInterval = setInterval(nextVideo, 8000);

    // ── HAMBURGER ──
    const hamburger = document.getElementById('hamburger');
    const mobileNav = document.getElementById('mobileNav');
    hamburger.addEventListener('click', () => { hamburger.classList.toggle('open'); mobileNav.classList.toggle('open'); document.body.style.overflow = mobileNav.classList.contains('open') ? 'hidden' : ''; });
    function closeMobileNav() { hamburger.classList.remove('open'); mobileNav.classList.remove('open'); document.body.style.overflow = ''; }

    // ── SCROLL REVEAL ──
    window.observer = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('active'); window.observer.unobserve(e.target); } });
    }, { threshold: 0.1, rootMargin: "0px 0px -40px 0px" });

    window.initScrollReveal = function() {
        const reveals = document.querySelectorAll('.reveal:not(.active)');
        reveals.forEach(el => window.observer.observe(el));
    };
    
    // Initial call
    window.initScrollReveal();

    // ── DARK MODE ──
    function setTheme(dark) {
        document.body.classList.toggle('dark', dark);
        const icon = dark ? '☀️' : '🌙';
        document.getElementById('themeBtn').textContent = icon;
        document.getElementById('themeBtnM').textContent = icon;
    }
    document.getElementById('themeBtn').addEventListener('click', () => setTheme(!document.body.classList.contains('dark')));
    document.getElementById('themeBtnM').addEventListener('click', () => setTheme(!document.body.classList.contains('dark')));

    // ── TABS ──
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const target = btn.dataset.tab;
            document.querySelectorAll('.tab-content').forEach(c => { c.classList.remove('active'); if (c.id === 'tab-' + target) c.classList.add('active'); });
            document.querySelectorAll('#tab-' + target + ' .reveal').forEach(el => { el.classList.remove('active'); setTimeout(() => window.observer.observe(el), 50); });
        });
    });

    // ── SHOW MORE ──
    function toggleMore(tab) {
        const extra = document.getElementById('extra-' + tab);
        const btn = document.querySelector('.t-btn-more-' + tab);
        if (!extra) return;
        extra.classList.toggle('show');
        const isOpen = extra.classList.contains('show');
        btn.textContent = isOpen
            ? (currentLang === 'id' ? 'Tutup ▲' : 'Show Less ▲')
            : (currentLang === 'id' ? 'Lihat Menu Lainnya ▼' : 'Show More ▼');
        if (isOpen) {
            extra.querySelectorAll('.reveal').forEach(el => { el.classList.remove('active'); setTimeout(() => window.observer.observe(el), 50); });
        }
    }

    // ── LANGUAGE (Google Translate Control - Cookie Method) ──
    // ========== GOOGLE TRANSLATE TANPA UI & TANPA LOADING ==========
    function cleanGoogleTranslateUI() {
        const selectors = [
            '.goog-te-gadget', '.goog-te-banner-frame', '.goog-te-balloon-frame',
            '.skiptranslate', '.goog-te-menu-frame', '.goog-te-menu2',
            '.goog-te-gadget-icon', '.goog-te-spinner', '.goog-te-spinner-pos',
            '#goog-gt-tt', 'iframe[class*="goog"]', 'div[class*="goog-te"]',
            'img[class*="goog"]', '*[class*="goog-te-"]'
        ];
        selectors.forEach(sel => {
            document.querySelectorAll(sel).forEach(el => el.remove());
        });
        
        // Hentikan semua animasi loading yang mungkin dibuat Google
        const style = document.createElement('style');
        style.textContent = `
            .goog-te-spinner, .goog-te-spinner-pos, .goog-te-spinner-animation {
                display: none !important;
                animation: none !important;
                visibility: hidden !important;
            }
        `;
        document.head.appendChild(style);

        if (document.body.style.top !== '0px' && document.body.style.top !== '') {
            document.body.style.top = '0px';
            document.body.style.position = '';
        }
    }

    // Pantau dan bersihkan setiap 300ms selama 6 detik
    let cleanInterval = setInterval(cleanGoogleTranslateUI, 300);
    setTimeout(() => clearInterval(cleanInterval), 6000);
    document.addEventListener('DOMContentLoaded', cleanGoogleTranslateUI);

    function getTransCookie() {
        let match = document.cookie.match(/googtrans=([^;]+)/);
        return match ? match[1] : '/id/id';
    }

    let currentTrans = getTransCookie();
    let currentLang = currentTrans.includes('/id/en') ? 'en' : 'id';
    
    // Set label awal sesuai bahasa yang aktif
    const initLabel = currentLang === 'id' ? 'EN' : 'ID';
    document.getElementById('langBtn').textContent = initLabel;
    document.getElementById('langBtnM').textContent = initLabel;

    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'id',
            autoDisplay: false
        }, 'google_translate_element');
        
        if (!document.cookie.match('googtrans')) {
            document.cookie = "googtrans=/id/id; path=/";
        }
    }

    function toggleLang() {
        let targetLang = currentLang === 'id' ? '/id/en' : '/id/id';
        document.cookie = `googtrans=${targetLang}; path=/`;
        document.cookie = `googtrans=${targetLang}; path=/; domain=${window.location.hostname}`;
        location.reload();
    }
    document.getElementById('langBtn').addEventListener('click', toggleLang);
    document.getElementById('langBtnM').addEventListener('click', toggleLang);

    // ── NAVBAR SCROLL ──
    window.addEventListener('scroll', () => {
        const header = document.querySelector('header');
        header.style.boxShadow = window.scrollY > 60 ? '0 2px 24px rgba(26,15,8,0.08)' : 'none';
    });

    // ── CART ──
    let cart = [];
    let cartOpen = false;
    let toastTimer = null;
    var WA_NUMBER = window.WA_NUMBER; // Defined globally in footer.php

    function toggleCart() {
        cartOpen = !cartOpen;
        document.getElementById('cartDrawer').classList.toggle('open', cartOpen);
        document.getElementById('cartOverlay').classList.toggle('open', cartOpen);
        document.body.style.overflow = cartOpen ? 'hidden' : '';
    }
    document.getElementById('cartFab').addEventListener('click', toggleCart);
    document.getElementById('cartCloseBtn').addEventListener('click', toggleCart);
    document.getElementById('cartOverlay').addEventListener('click', toggleCart);
    document.addEventListener('keydown', e => { if (e.key === 'Escape' && cartOpen) toggleCart(); });

    function addToCart(name, price, img) {
        const existing = cart.find(i => i.name === name);
        if (existing) { existing.qty++; } else { cart.push({ name, price, qty: 1, img }); }
        renderCart();
        showToast(name);
        animateFab();
        if (!cartOpen) document.getElementById('cartFab').scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    function updateQty(name, delta) {
        const idx = cart.findIndex(i => i.name === name);
        if (idx === -1) return;
        cart[idx].qty += delta;
        if (cart[idx].qty <= 0) cart.splice(idx, 1);
        renderCart();
    }

    function removeCartItem(name) {
        cart = cart.filter(i => i.name !== name);
        renderCart();
    }

    function renderCart() {
        const totalItems = cart.reduce((s,i) => s + i.qty, 0);
        const totalPrice = cart.reduce((s,i) => s + i.price * i.qty, 0);
        document.getElementById('cartBadge').textContent = totalItems;
        document.getElementById('cartBadge').classList.toggle('show', totalItems > 0);
        const isEmpty = cart.length === 0;
        document.getElementById('cartEmpty').style.display = isEmpty ? 'flex' : 'none';
        document.getElementById('cartItemsList').style.display = isEmpty ? 'none' : 'block';
        document.getElementById('cartFooter').style.display = isEmpty ? 'none' : 'block';

        if (!isEmpty) {
            const listEl = document.getElementById('cartItemsList');
            listEl.innerHTML = cart.map((item, idx) => `
                <div class="cart-item-row" data-index="${idx}">
                    <img loading="lazy" class="cart-item-img" src="${item.img}" alt="${item.name}" onerror="this.style.background='rgba(232,98,42,0.1)';this.src=''">
                    <div class="cart-item-info">
                        <div class="cart-item-name">${item.name}</div>
                        <div class="cart-item-price">${formatRp(item.price)}</div>
                        <div class="cart-item-subtotal">Subtotal: ${formatRp(item.price * item.qty)}</div>
                    </div>
                    <div class="cart-qty-wrap">
                        <div class="qty-controls">
                            <button class="qty-btn minus" data-action="dec">−</button>
                            <span class="qty-num">${item.qty}</span>
                            <button class="qty-btn" data-action="inc">+</button>
                        </div>
                        <button class="cart-delete-btn" data-action="del" title="Hapus">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                        </button>
                    </div>
                </div>
            `).join('');
            document.getElementById('cartTotalNum').textContent = totalPrice.toLocaleString('id-ID');
            document.getElementById('cartItemCountLabel').textContent = `${totalItems} item · ${cart.length} jenis`;
            document.getElementById('btnOrderWa').disabled = (totalItems === 0);
        }
    }

    document.getElementById('cartItemsList').addEventListener('click', function(e) {
        const btn = e.target.closest('button');
        if (!btn || !btn.dataset.action) return;
        const row = btn.closest('.cart-item-row');
        if (!row) return;
        const idx = parseInt(row.dataset.index, 10);
        if (isNaN(idx) || idx < 0 || idx >= cart.length) return;
        const itemName = cart[idx].name;
        switch (btn.dataset.action) {
            case 'inc': updateQty(itemName, 1); break;
            case 'dec': updateQty(itemName, -1); break;
            case 'del': removeCartItem(itemName); break;
        }
    });

    function formatRp(n) { return 'Rp ' + n.toLocaleString('id-ID'); }
    function showToast(name) {
        const t = document.getElementById('cartToast');
        document.getElementById('cartToastName').textContent = name;
        t.classList.add('show');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => t.classList.remove('show'), 2500);
    }
    function animateFab() {
        const b = document.getElementById('cartBadge');
        b.classList.remove('pop');
        void b.offsetWidth;
        b.classList.add('pop');
    }

    document.getElementById('btnOrderWa').addEventListener('click', function() {
    if (cart.length === 0) return;
    
    const nama = document.getElementById('reservasiNama').value.trim();
    const waktu = document.getElementById('reservasiWaktu').value;
    if (!nama || !waktu) {
        alert('Silakan isi Nama dan Waktu Kedatangan terlebih dahulu!');
        return;
    }

    const note = document.getElementById('cartNote').value.trim();
    const itemLines = cart.map(i => `• ${i.name} x${i.qty}`).join('\n');
    const daftarMenu = cart.map(i => `${i.name} (x${i.qty})`).join(', ');
    const waktuFormat = waktu.replace('T', ' ');

    const msg = [
        '🌹 *Halo Warkop Mawar!*', '',
        `Saya *${nama}*, mau reservasi tempat untuk tanggal *${waktuFormat}*.`, '',
        'Pesanan saya:', itemLines, note ? `\nCatatan: ${note}` : '',
        '', '_(Reservasi via Website Warkop Mawar)_'
    ].join('\n');

    // ✅ Buka WA duluan — langsung dari user click, bebas popup blocker
    window.open(`https://wa.me/${WA_NUMBER}?text=${encodeURIComponent(msg)}`, '_blank');

    // Simpan ke DB — fire and forget
    fetch('proses_reservasi.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            nama_pelanggan: nama,
            waktu_reservasi: waktu,
            detail_pesanan: daftarMenu + (note ? ' - Catatan: ' + note : ''),
            total_harga: cart.reduce((s,i) => s + i.price * i.qty, 0),
            csrf_token: CSRF_TOKEN
        })
    }).catch(err => console.error('Reservasi error:', err));

    // Bersihkan cart
    cart = [];
    renderCart();
    document.getElementById('reservasiNama').value = '';
    document.getElementById('reservasiWaktu').value = '';
    document.getElementById('cartNote').value = '';
    toggleCart();
});

    document.getElementById('btnGrab').addEventListener('click', () => window.location.href = 'https://food.grab.com/id/id/restaurant/warkop-mawar-badean-delivery/6-C3CYEXEEBA5XR6');
    document.getElementById('btnShopee').addEventListener('click', () => window.open('https://shopee.co.id/universal-link/now-food/shop/22679728?deep_and_deferred=1&shareChannel=whatsapp', '_blank'));

    function initCartButtons() {
        document.querySelectorAll('.add-btn').forEach(btn => {
            if (btn.dataset.cartInit) return;
            btn.dataset.cartInit = '1';
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const card = this.closest('.menu-card');
                if (!card) return;
                const name = card.querySelector('.menu-card-name')?.textContent?.trim() || 'Menu';
                const priceText = card.querySelector('.menu-card-price')?.textContent || '0';
                const price = parseInt(priceText.replace(/[^0-9]/g, '')) || 0;
                const imgEl = card.querySelector('.menu-img');
                const img = imgEl ? imgEl.src : '';
                addToCart(name, price, img);
            });
        });
    }

    document.querySelectorAll('.tab-btn').forEach(btn => btn.addEventListener('click', () => { setTimeout(initCartButtons, 50); setTimeout(initTempToggle, 50); }));
    window.toggleMore = function(tab) {
        const extra = document.getElementById('extra-' + tab);
        const btn = document.querySelector('.t-btn-more-' + tab);
        if (!extra) return;
        extra.classList.toggle('show');
        const isOpen = extra.classList.contains('show');
        btn.textContent = isOpen
            ? (currentLang === 'id' ? 'Tutup ▲' : 'Show Less ▲')
            : (currentLang === 'id' ? 'Lihat Menu Lainnya ▼' : 'Show More ▼');
        if (isOpen) {
            extra.querySelectorAll('.reveal').forEach(el => { el.classList.remove('active'); setTimeout(() => window.observer.observe(el), 50); });
        }
        setTimeout(initCartButtons, 50);
        setTimeout(initTempToggle, 50);
        setTimeout(initMenuImages, 100);
    };

    // ── HOT/ICE TOGGLE LOGIC ──
    function initTempToggle() {
        document.querySelectorAll('.temp-toggle').forEach(toggle => {
            if (toggle.dataset.toggleInit) return;
            toggle.dataset.toggleInit = '1';
            const card = toggle.closest('.menu-card');
            const priceEl = card ? card.querySelector('.menu-card-price') : null;
            const hargaHot = parseInt(card?.dataset?.hargaHot || 0);
            const hargaIce = parseInt(card?.dataset?.hargaIce || 0);
            const hasIce = card?.dataset?.hasIce === '1';

            // Enable toggle jika ada harga ice yang valid
            if (hasIce && hargaIce > 0) {
                toggle.querySelectorAll('.temp-btn').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        toggle.querySelectorAll('.temp-btn').forEach(b => b.classList.remove('active'));
                        this.classList.add('active');
                        if (priceEl) {
                            const isIce = this.dataset.temp === 'ice';
                            const price = isIce ? hargaIce : hargaHot;
                            priceEl.textContent = 'Rp ' + price.toLocaleString('id-ID');
                        }
                    });
                });
            } else {
                // Jika tidak ada harga ice yang valid, sembunyikan toggle
                toggle.style.display = 'none';
            }
        });
    }
    // ── MENU IMAGE LOADING FIX ──
    function initMenuImages() {
        document.querySelectorAll('.menu-img').forEach(img => {
            if (img.dataset.imgInit) return;
            img.dataset.imgInit = '1';

            // Langsung tampilkan gambar (jangan set opacity 0)
            img.style.opacity = '1';

            img.addEventListener('error', function() {
                this.style.display = 'none';
                const placeholder = this.nextElementSibling;
                if (placeholder && placeholder.classList.contains('placeholder-menu')) {
                    placeholder.style.display = 'flex';
                }
            });

            // Handle gambar yang sudah error sebelum listener ter-attach
            if (img.complete && img.naturalHeight === 0 && img.src) {
                img.style.display = 'none';
                const placeholder = img.nextElementSibling;
                if (placeholder && placeholder.classList.contains('placeholder-menu')) {
                    placeholder.style.display = 'flex';
                }
            }
        });
    }

    initMenuImages();
    initCartButtons();
    initTempToggle();
    document.querySelectorAll('.tab-btn').forEach(btn => btn.addEventListener('click', () => setTimeout(initMenuImages, 100)));
    // ── LEAFLET JS MAP ──
    window.initMap = function() {
        var lat  = -7.9184921;
        var lng  = 113.8175745;
        
        var map = L.map('map', {
            scrollWheelZoom: false // Matikan scroll zoom agar tidak mengganggu scroll halaman
        }).setView([lat, lng], 17);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var orangeIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-orange.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        L.marker([lat, lng], {icon: orangeIcon}).addTo(map)
            .bindPopup('<b>WARKOP MAWAR</b><br>Tempat Nongkrong & Ngopi Asik<br><br><a href="https://maps.app.goo.gl/DyufcHiVK3apKeKk7" target="_blank" style="background:#E8622A;color:white;padding:6px 12px;border-radius:6px;text-decoration:none;display:inline-block;margin-top:8px;font-weight:bold;font-size:0.9rem;">Buka Google Maps</a>')
            .openPopup();
    };

