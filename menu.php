<?php
include 'koneksi.php';

// Ambil id_umkm dari URL
$id_umkm = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Jika id tidak valid, kembali ke halaman utama
if ($id_umkm <= 0) {
    header("Location: index.php");
    exit;
}

    // Ambil data nama stand untuk judul
    $query_umkm = "SELECT nama_stand FROM umkm WHERE id_umkm = $id_umkm";
    $result_umkm = mysqli_query($koneksi, $query_umkm);
    $data_umkm = mysqli_fetch_assoc($result_umkm);
    $nama_stand = $data_umkm ? $data_umkm['nama_stand'] : 'Tidak Diketahui';

    // Ambil daftar menu dari UMKM tersebut
    $query_menu = "SELECT nama_menu, harga_menu, jenis_menu 
        FROM menu WHERE id_umkm = $id_umkm ORDER BY jenis_menu, nama_menu";
    $result_menu = mysqli_query($koneksi, $query_menu);
    
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - <?= htmlspecialchars($nama_stand); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Daftar Menu</h2>
        <h3><?= htmlspecialchars($nama_stand); ?></h3>
        <p><a href="index.php" class="btn">&larr; Kembali ke Daftar UMKM</a></p>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Menu</th>
                    <th>Jenis</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result_menu) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result_menu)) {
                        // Format harga ke Rupiah
                        $harga = 'Rp ' . number_format($row['harga_menu'], 0, ',', '.');
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama_menu']); ?></td>
                            <td><?= htmlspecialchars($row['jenis_menu']); ?></td>
                            <td><?= $harga; ?></td>
                        </tr>
                <?php
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="4" style="text-align: center;">Belum ada menu untuk UMKM ini</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <section id="contact">
            <p>&copy; Street Food Saparua Community</p>
            <p>Wingko Prajna</p>
        </section>
    </div>
</body>
</html>