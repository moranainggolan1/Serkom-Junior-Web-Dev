<?php
require_once 'connection.php';
if (!isset($_GET['id'])) {
    header("Location: pesan-kamar.php");
    exit();
}
$sql = "SELECT orders.*, hotel.tipe, hotel.harga FROM orders LEFT JOIN hotel ON hotel.id = orders.hotel_id WHERE orders.id = " . $_GET['id'];
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($result);
if ($data == null) {
    header("Location: pesan-kamar.php");
    exit();
}
$discount = $data['durasi'] >= 3 ? 10 : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kamar</title>
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
                    <a class="nav-link" aria-current="page" href="index.php">Produk</a>
                    <a class="nav-link" href="daftar-harga.php">Daftar Harga</a>
                    <a class="nav-link" href="tentang-kami.php">Tentang Kami</a>
                    <a class="nav-link active" href="pesan-kamar.php">Pesan Kamar</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid mt-4 bg-light px-5">
        <div class="row">
            <div class="col-2"></div>
            <div class="col">
                <div class="card">
                    <div class="card-body px-5">
                        <h2 class="fw-semibold text-center mb-5">HASIL PEMESANAN</h2>
                        <div class="row mb-3">
                            <label for="nama" class="col-md-3 col-form-label">Nama Pemesan</label>
                            <p class="col-md-9"> : <?= $data['nama'] ?></p>
                        </div>
                        <div class="row mb-3">
                            <label for="nomor_identitas" class="col-md-3 col-form-label">Nomor Identitas</label>
                            <p class="col-md-9"> : <?= $data['nomor_identitas'] ?></p>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Jenis Kelamin</label>
                            <p class="col-md-9"> : <?= $data['jenis_kelamin'] ?></p>
                        </div>

                        <div class="row mb-3">
                            <label for="tipe_kamar" class="col-md-3 col-form-label">Tipe Kamar</label>
                            <p class="col-md-9"> : <?= $data['tipe'] ?></p>
                        </div>
                        <div class="row mb-3">
                            <label for="durasi_menginap" class="col-md-3 col-form-label">Durasi Menginap</label>
                            <p class="col-md-9"> : <?= $data['durasi'] ?> Hari</p>
                        </div>
                        <div class="row mb-3">
                            <label for="harga" class="col-md-3 col-form-label">Discount</label>
                            <p  class="col-md-9"> : <?= $discount ?>% </p>
                        </div>
                        <div class="row mb-3">
                            <label for="tanggal_pesan" class="col-md-3 col-form-label">Total Bayar</label>
                            <p  class="col-md-9"> : Rp. <?= number_format((1 - ($discount / 100)) * (($data['harga'] * $data['durasi']) + ($data['breakfast'] == 1 ? 80000 : 0)), 2, '.', '.')  ?>,-</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>

    </div>
</body>

</html>