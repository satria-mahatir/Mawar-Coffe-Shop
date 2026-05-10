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
                <p class="story-body t-story-body2" style="margin-top:-4px;">Kami juga melayani <strong>coffee booth untuk acara pernikahan &amp; event</strong>. Bawa suasana kopi terbaik ke momen spesialmu.</p>
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
