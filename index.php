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
            Udah siap kulineran enak tanpa kantong bolong?
            <br>
            <br>
            Bawa teman-teman kalian, bawa keluarga, atau bawa perut aja, Saparua siap menyambut dengan aroma sedap dari setiap makanan.
            <br>
            <br>
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

<!-- ini bagian daftar makanan nya-->
    <section id="daftar">
       </head>
       <body>
    
            <div class="container">
            <h2 class="daftar">Daftar UMKM</h2>
            <p class="daftar">Street Food Saparua</p>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Stand</th>
                    <th>Penjaga/Pemilik</th>
                    <th>Lokasi</th>
                    <th>Jam Buka</th>
                    <th>Menu</th>
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
                            jadwal.jam_tutup
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
                    <td>
                        <a href="menu.php?id=<?= $row['id_umkm']; ?>" class="btn">Menu</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
            </div>
            <div class="footer">
                <section id="contact">
                    <p>&copy;Stree Food Saparua Comunity</p>
                    <p>Wingko Prajna</p>
                </section>
            </div>
    
       </body>
       </html> 
    
    </html>
    
    <link rel="stylesheet" href="style.css">
    
    </section>