<?php
require_once 'connection.php';
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}
$sql = "SELECT * FROM hotel WHERE id = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($result);
if ($data == null) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['tipe'] ?></title>
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
    <div class="container-fluid my-4 bg-light px-5">
        <div class="card">
            <div class="card-body">

                <img src="assets/<?= $data['foto'] ?>" class="w-100 rounded mb-3" />
                <h1 class="fw-bold text-center mb-4"><?= $data['tipe'] ?></h1>
                <div class="d-flex mb-4">
                    <video width="500" height="350" controls>
                        <source src="assets/<?= $data['video'] ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="ms-4 d-flex flex-column">
                        <p><?= $data['deskripsi'] ?></p>
                        <h3 class="fw-semibold text-primary-emphasis mt-auto">Rp. <?= number_format($data['harga'], 2, '.', '.') ?>,-</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>