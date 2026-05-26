<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari UMKM Berdasarkan Harga Menu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Cari UMKM dengan Harga Menu yang pas sesuai budget kamu!</h2>
    <p>Masukkan harga maksimal (per pcs) untuk melihat UMKM yang menyediakan menu dengan harga tersebut atau lebih murah.</p>

    <form method="GET" action="" class="form-cari">
        <div class="form-group">
            <label for="harga">Budget Maksimal (Rp)</label>
            <input type="number" id="harga" name="harga" placeholder="Contoh: 10000" value="<?= isset($_GET['harga']) ? htmlspecialchars($_GET['harga']) : '' ?>" required>
        </div>
        <button type="submit" class="btn btn-tambah">Tampilkan UMKM</button>
        <a href="index.php" class="btn btn-batal">Kembali ke Daftar UMKM</a>
    </form>
</div>

<?php
if (isset($_GET['harga']) && is_numeric($_GET['harga'])) {
    $harga_max = (int)$_GET['harga'];
    
    // Query untuk mencari UMKM yang memiliki setidaknya satu menu dengan harga <= $harga_max
    // Tampilkan informasi UMKM beserta menu termurahnya (opsional)
    $query = "SELECT DISTINCT 
                    umkm.id_umkm,
                    umkm.nama_stand,
                    umkm.nama_penjaga,
                    umkm.sertifikasi_halal,
                    lokasi.deskripsi AS lokasi,
                    jadwal.jam_buka,
                    jadwal.jam_tutup,
                    (SELECT MIN(harga_menu) FROM menu WHERE menu.id_umkm = umkm.id_umkm AND menu.harga_menu <= $harga_max) AS harga_termurah_dalam_range
                FROM umkm
                INNER JOIN lokasi ON umkm.id_lokasi = lokasi.id_lokasi
                INNER JOIN jadwal ON umkm.id_jadwal = jadwal.id_jadwal
                WHERE EXISTS (
                    SELECT 1 FROM menu WHERE menu.id_umkm = umkm.id_umkm AND menu.harga_menu <= $harga_max
                )
                ORDER BY harga_termurah_dalam_range ASC";
    
    $result = mysqli_query($koneksi, $query);
    
    if (mysqli_num_rows($result) > 0) {
        ?>
        <div class="container">
            <h3>Hasil Pencarian: UMKM dengan menu ≤ Rp <?= number_format($harga_max, 0, ',', '.') ?></h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Stand</th>
                        <th>Penjaga</th>
                        <th>Lokasi</th>
                        <th>Jam Operasional</th>
                        <th>Harga Termurah</th>
                        <th>Sertifikat Halal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $harga_tampil = $row['harga_termurah_dalam_range']
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama_stand']); ?></td>
                            <td><?= htmlspecialchars($row['nama_penjaga']); ?></td>
                            <td><?= htmlspecialchars($row['lokasi']); ?></td>
                            <td><?= $row['jam_buka']; ?> - <?= $row['jam_tutup']; ?></td>
                            <td><?= $harga_tampil; ?></td>
                            <td><?= ucfirst($row['sertifikasi_halal']); ?></td>
                            <td>
                                <a href="menu.php?id=<?= $row['id_umkm']; ?>" class="btn"> Menu</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
    } else {
        echo '<div class="container"><p class="alert">Tidak ada UMKM yang memiliki menu dengan harga ≤ Rp ' . number_format($harga_max, 0, ',', '.') . '.</p></div>';
    }
}
?>

<div class="footer">
    <p>&copy; Street Food Saparua Community</p>
    <p>Wingko Prajna</p>
</div>

</body>
</html>