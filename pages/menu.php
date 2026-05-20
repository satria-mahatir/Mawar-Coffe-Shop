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
                    <div class="menu-card reveal active <?= (isset($row['status']) && $row['status'] == 'habis') ? 'sold-out' : ''; ?>" data-id="<?= $row['id_menu']; ?>" <?= $has_ice ? "data-harga-hot='$harga_hot' data-harga-ice='$harga_ice' data-has-ice='1'" : ''; ?>>
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
                        <div class="menu-card reveal active <?= (isset($row['status']) && $row['status'] == 'habis') ? 'sold-out' : ''; ?>" data-id="<?= $row['id_menu']; ?>" <?= $has_ice ? "data-harga-hot='$harga_hot' data-harga-ice='$harga_ice' data-has-ice='1'" : ''; ?>>
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
                    <div class="menu-card reveal active <?= (isset($row['status']) && $row['status'] == 'habis') ? 'sold-out' : ''; ?>" data-id="<?= $row['id_menu']; ?>">
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
                        <div class="menu-card reveal active <?= (isset($row['status']) && $row['status'] == 'habis') ? 'sold-out' : ''; ?>" data-id="<?= $row['id_menu']; ?>">
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
