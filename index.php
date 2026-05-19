<?php include 'koneksi.php'; ?>

<html>
   <!DOCTYPE html>
   <html lang="id">
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<!-- ini bagian aboutnya-->
    <section id="home">
        <h1>Selamat datang di Street Food Saparua</h1>
        <p>
            Halo, para pecinta kuliner jalanan!
            Udah siap makan enak tanpa kantong bolong?
            <br>
            <br>
            Bawa teman, bawa keluarga, atau bawa badan laparmu—Saparua siap menyambut dengan senyum dan aroma sedap dari setiap panggangan.
            <br>
            <br>
            Si Dia juga bisa di ajak ke sini lhooo...
            Yuk Temuin selera makanan mu disini.
        </p>
    </section>
    <nav class="navbar">
        <a class="active" href="index.php">Daftar UMKM</a>
        <a href="tambah_umkm.php">Tambah Data</a>
        <a href="kategori.php">Kelola Kategori</a>
        <a href="#tentang">Tentang Aplikasi</a>
    </nav>
<!-- ini bagian daftar makanan nya-->
    <section id="daftar_buku">
       </head>
       <body>
    
            <div class="container">
            <h2 class="daftar_buku">Daftar UMKM</h2>
            <p class="daftar_buku">Street Food Saparua</p>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Stand</th>
                    <th>Penjaga/Pemilik</th>
                    <th>Lokasi</th>
                    <th>Jam Buka</th>
                    <th>Sertifikat Halal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Koneksi database
                $koneksi = mysqli_connect("localhost", "root", "", "data_umkm_saparua");

                // Query INNER JOIN
                $query = "SELECT 
                            umkm.id_umkm, 
                            umkm.nama_stand, 
                            umkm.nama_penjaga, 
                            lokasi.deskripsi AS lokasi,
                            jadwal.jam_buka,
                            jadwal.jam_tutup,
                            umkm.sertifikasi_halal
                        FROM umkm
                        INNER JOIN lokasi ON umkm.id_lokasi = lokasi.id_lokasi
                        INNER JOIN jadwal ON umkm.id_jadwal = jadwal.id_jadwal";

                $result = mysqli_query($koneksi, $query);
                $no = 1;

                while($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['nama_stand']; ?></td>
                    <td><?= $row['nama_penjaga']; ?></td>
                    <td><?= $row['lokasi']; ?></td>
                    <td><?= $row['jam_buka']; ?> - <?= $row['jam_tutup']; ?></td>
                    <td><?= $row['sertifikasi_halal']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
            </div>
            <div class="footer">
                <section id="contact">
                    <p>&copy;2026 Tokyo Libraly Foundation</p>
                    <p>Wingko Prajna</p>
                </section>
            </div>
    
       </body>
       </html> 
    
    </html>
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    </section>