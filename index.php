<?php
require_once 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body class=" bg-light">
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="index.php">Produk</a>
                    <a class="nav-link" href="daftar-harga.php">Daftar Harga</a>
                    <a class="nav-link" href="tentang-kami.php">Tentang Kami</a>
                    <a class="nav-link" href="pesan-kamar.php">Pesan Kamar</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid mt-4 bg-light px-5">
        <?php
        //ambil seluruh data hotel dan menampilkannya
        $sql = "SELECT * FROM hotel";
        $result = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_array($result)) : ?>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex">
                        <img src="assets/<?= $data['foto'] ?>" class="home-image rounded" />
                        <div class="ms-4 d-flex flex-column">
                            <h3 class="fw-bold"><?= $data['tipe'] ?></h3>
                            <p><?= $data['deskripsi'] ?></p>
                            <h5 class="fw-semibold text-primary-emphasis ms-2">Rp. <?= number_format($data['harga'], 2, '.', '.') ?>,-</h5>
                            <a href="detail-produk.php?id=<?= $data['id'] ?>" class="btn btn-primary mt-auto">DETAIL</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile ?>
    </div>
</body>

</html>