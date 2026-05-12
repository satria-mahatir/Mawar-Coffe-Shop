    <!-- GALLERY STRIP - DINAMIS -->
    <div class="gallery-strip">
        <div class="gallery-track" id="galleryTrack">
            <?php 
            // Generate carousel items dynamically
            foreach($carousel_items as $item) {
                $image_file = $item['gambar'];
                $alt_text = htmlspecialchars($item['nama_menu']);
                echo '<div class="gallery-item"><img loading="lazy" src="images/'.htmlspecialchars($image_file).'" alt="'.$alt_text.'" onerror="this.src=\'images/placeholder.png\'"></div>';
            }
            ?>
            <!-- Duplication for infinite scroll effect -->
            <?php 
            foreach($carousel_items as $item) {
                $image_file = $item['gambar'];
                $alt_text = htmlspecialchars($item['nama_menu']);
                echo '<div class="gallery-item"><img loading="lazy" src="images/'.htmlspecialchars($image_file).'" alt="'.$alt_text.'" onerror="this.src=\'images/placeholder.png\'"></div>';
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
