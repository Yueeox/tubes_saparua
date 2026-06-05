<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Street Food Saparua</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<section id="home">
    <h1>Selamat datang di Street Food Saparua</h1>
    <p>
        Halo, para pecinta kuliner jalanan!
        Udah siap kulineran enak tanpa kantong bolong?
        <br><br>
        Bawa teman-teman kalian, bawa keluarga, atau bawa perut aja, Saparua siap menyambut dengan aroma sedap dari setiap makanan.
        <br><br>
        Si Dia juga bisa di ajak ke sini lho...
        Yuk Temuin selera makan si dia dan kamu disini.
    </p>
</section>

<nav>
    <ul>
        <li><a href="index.php">Daftar UMKM</a></li>
        <li><a href="search_harga.php">Search Harga</a></li>
    </ul>
</nav>

<div class="container">
    <h2>Daftar UMKM</h2>
    <p>Street Food Saparua</p>

    <!-- FILTER SECTION -->
    <div class="filter-section">
        <div class="filter-title"> Filter UMKM</div>
        <form method="GET" action="" id="filterForm">
            <div class="filter-group">
                <!-- Filter 1: Jam Buka -->
                <div class="filter-item">
                    <label> Buka pada jam</label>
                    <input type="time" name="filter_jam" value="<?= isset($_GET['filter_jam']) ? $_GET['filter_jam'] : '' ?>" placeholder="Contoh: 15:00">
                </div>

                <!-- Filter 2: Mitra (Skip karena sudah ada di search_harga) -->

                <!-- Filter 3: Mitra Pengiriman -->
                <div class="filter-item">
                    <label> Mitra Pengiriman</label>
                    <select name="filter_mitra">
                        <option value="">Semua</option>
                        <option value="1" <?= (isset($_GET['filter_mitra']) && $_GET['filter_mitra'] == '1') ? 'selected' : '' ?>>ShopeeFood</option>
                        <option value="2" <?= (isset($_GET['filter_mitra']) && $_GET['filter_mitra'] == '2') ? 'selected' : '' ?>>GoFood</option>
                        <option value="3" <?= (isset($_GET['filter_mitra']) && $_GET['filter_mitra'] == '3') ? 'selected' : '' ?>>GrabFood</option>
                        <option value="4" <?= (isset($_GET['filter_mitra']) && $_GET['filter_mitra'] == '4') ? 'selected' : '' ?>>WhatsApp</option>
                    </select>
                </div>

                <!-- Filter 4: Metode Pembayaran -->
                <div class="filter-item">
                    <label> Metode Pembayaran</label>
                    <select name="filter_pembayaran">
                        <option value="">Semua</option>
                        <option value="1" <?= (isset($_GET['filter_pembayaran']) && $_GET['filter_pembayaran'] == '1') ? 'selected' : '' ?>>Tunai (Cash)</option>
                        <option value="2" <?= (isset($_GET['filter_pembayaran']) && $_GET['filter_pembayaran'] == '2') ? 'selected' : '' ?>>QRIS</option>
                        <option value="3" <?= (isset($_GET['filter_pembayaran']) && $_GET['filter_pembayaran'] == '3') ? 'selected' : '' ?>>Transfer Bank</option>
                    </select>
                </div>

                <!-- Filter 5: Sertifikasi Halal -->
                <div class="filter-item">
                    <label> Sertifikasi Halal</label>
                    <select name="filter_halal">
                        <option value="">Semua</option>
                        <option value="ada" <?= (isset($_GET['filter_halal']) && $_GET['filter_halal'] == 'ada') ? 'selected' : '' ?>>Ada Sertifikat</option>
                        <option value="tidak" <?= (isset($_GET['filter_halal']) && $_GET['filter_halal'] == 'tidak') ? 'selected' : '' ?>>Belum/Tidak Ada</option>
                    </select>
                </div>

                <!-- Filter 6: Rasa -->
                <div class="filter-item">
                    <label> Rasa Menu</label>
                    <select name="filter_rasa">
                        <option value="">Semua Rasa</option>
                        <option value="Manis" <?= (isset($_GET['filter_rasa']) && $_GET['filter_rasa'] == 'Manis') ? 'selected' : '' ?>>Manis</option>
                        <option value="Gurih" <?= (isset($_GET['filter_rasa']) && $_GET['filter_rasa'] == 'Gurih') ? 'selected' : '' ?>>Gurih</option>
                        <option value="Pedas" <?= (isset($_GET['filter_rasa']) && $_GET['filter_rasa'] == 'Pedas') ? 'selected' : '' ?>>Pedas</option>
                        <option value="Segar" <?= (isset($_GET['filter_rasa']) && $_GET['filter_rasa'] == 'Segar') ? 'selected' : '' ?>>Segar</option>
                        <option value="Manis, Segar" <?= (isset($_GET['filter_rasa']) && $_GET['filter_rasa'] == 'Manis, Segar') ? 'selected' : '' ?>>Manis & Segar</option>
                    </select>
                </div>
            </div>
            <div class="filter-buttons">
                <button type="submit" class="btn-filter">Terapkan Filter</button>
                <a href="index.php" class="btn-reset">Reset Filter</a>
            </div>
        </form>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Stand</th>
                <th>Penjaga/Pemilik</th>
                <th>Lokasi</th>
                <th>Kategori</th>
                <th>Jam Buka</th>
                <th>Sertifikasi halal</th>
                <th>Menu</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Ambil nilai filter
            $filter_jam = isset($_GET['filter_jam']) && !empty($_GET['filter_jam']) ? $_GET['filter_jam'] : null;
            $filter_mitra = isset($_GET['filter_mitra']) && !empty($_GET['filter_mitra']) ? (int)$_GET['filter_mitra'] : null;
            $filter_pembayaran = isset($_GET['filter_pembayaran']) && !empty($_GET['filter_pembayaran']) ? (int)$_GET['filter_pembayaran'] : null;
            $filter_halal = isset($_GET['filter_halal']) && !empty($_GET['filter_halal']) ? $_GET['filter_halal'] : null;
            $filter_rasa = isset($_GET['filter_rasa']) && !empty($_GET['filter_rasa']) ? $_GET['filter_rasa'] : null;

            // Query dasar
            $query = "SELECT DISTINCT
                        umkm.id_umkm, 
                        umkm.nama_stand, 
                        umkm.nama_penjaga, 
                        umkm.sertifikasi_halal,
                        lokasi.deskripsi AS lokasi,
                        jadwal.jam_buka,
                        jadwal.jam_tutup,
                        kategori.jenis AS kategori,
                        GROUP_CONCAT(DISTINCT mitra.nama_mitra SEPARATOR ', ') AS daftar_mitra
                    FROM umkm
                    INNER JOIN lokasi ON umkm.id_lokasi = lokasi.id_lokasi
                    INNER JOIN jadwal ON umkm.id_jadwal = jadwal.id_jadwal
                    LEFT JOIN kategori ON umkm.id_kategori = kategori.id_kategori
                    LEFT JOIN umkm_mitra ON umkm.id_umkm = umkm_mitra.id_umkm
                    LEFT JOIN mitra ON umkm_mitra.id_mitra = mitra.id_mitra
                    LEFT JOIN umkm_pembayaran ON umkm.id_umkm = umkm_pembayaran.id_umkm
                    LEFT JOIN menu ON umkm.id_umkm = menu.id_umkm";

            $where = [];
            
            // Filter 1: Jam Buka
            if ($filter_jam) {
                $where[] = "(jadwal.jam_buka <= '$filter_jam' AND (jadwal.jam_tutup > '$filter_jam' OR (jadwal.jam_tutup = '00:00:00' AND '$filter_jam' >= jadwal.jam_buka) OR (jadwal.jam_tutup < jadwal.jam_buka AND '$filter_jam' >= jadwal.jam_buka)))";
            }
            
            // Filter 3: Mitra Pengiriman
            if ($filter_mitra) {
                $where[] = "umkm_mitra.id_mitra = $filter_mitra";
            }
            
            // Filter 4: Metode Pembayaran
            if ($filter_pembayaran) {
                $where[] = "umkm_pembayaran.id_metode = $filter_pembayaran";
            }
            
            // Filter 5: Sertifikasi Halal
            if ($filter_halal) {
                $where[] = "umkm.sertifikasi_halal = '$filter_halal'";
            }
            
            // Filter 6: Rasa
            if ($filter_rasa) {
                $where[] = "menu.deskripsi LIKE '%$filter_rasa%'";
            }
            
            if (count($where) > 0) {
                $query .= " WHERE " . implode(" AND ", $where);
            }
            
            $query .= " GROUP BY umkm.id_umkm ORDER BY umkm.nama_stand ASC";

            $result = mysqli_query($koneksi, $query);
            
            if (!$result) {
                echo "<tr><td colspan='8'>Error: " . mysqli_error($koneksi) . "</td></tr>";
            } elseif (mysqli_num_rows($result) == 0) {
                echo "<tr><td colspan='8' style='text-align: center;'>Tidak ada UMKM yang sesuai dengan filter</td></tr>";
            } else {
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $badge_halal = $row['sertifikasi_halal'] == 'ada' 
                        ? '<span class="badge badge-halal">✓ Bersertifikat</span>' 
                        : '<span class="badge badge-nonhalal">✗ Belum/Tidak</span>';
                    $mitra_list = !empty($row['daftar_mitra']) ? $row['daftar_mitra'] : '-';
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nama_stand']); ?></td>
                    <td><?= htmlspecialchars($row['nama_penjaga']); ?></td>
                    <td><?= htmlspecialchars($row['lokasi']); ?></td>
                    <td><?= htmlspecialchars($row['kategori'] ?? '-'); ?></td>
                    <td><?= $row['jam_buka']; ?> - <?= $row['jam_tutup']; ?></td>
                    <td><?= $badge_halal; ?></td>
                    <td>
                        <a href="menu.php?id=<?= $row['id_umkm']; ?>" class="btn">Menu</a>
                    </td>
                </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<div class="footer">
    <p>&copy; Street Food Saparua Community</p>
    <p>Kelompok 7</p>
</div>

</body>
</html>