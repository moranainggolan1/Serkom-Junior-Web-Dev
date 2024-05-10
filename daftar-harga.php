<?php
require_once 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Harga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class=" bg-light">
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="index.php">Produk</a>
                    <a class="nav-link active" aria-current="page" href="daftar-harga.php">Daftar Harga</a>
                    <a class="nav-link" href="tentang-kami.php">Tentang Kami</a>
                    <a class="nav-link" href="pesan-kamar.php">Pesan Kamar</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid mt-4 bg-light px-5">
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="fw-semibold text-center mb-4">DAFTAR HARGA</h2>
                <table class="table text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th class="w-50">Kamar</th>
                            <th>Harga</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM hotel";
                        $result = mysqli_query($conn, $sql);
                        while ($data = mysqli_fetch_array($result)) : ?>
                            <tr>
                                <td><?= $data['id'] ?></td>
                                <td><?= $data['tipe'] ?></td>
                                <td>Rp. <?= number_format($data['harga'], 2, '.', '.') ?>,-</td>
                                <td>
                                    <a href="detail-produk.php?id=<?= $data['id'] ?>" class="btn btn-primary">Detail</a>
                                </td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h2 class="fw-semibold text-center mb-4">TOTAL PENJUALAN</h2>
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <canvas id="total_penjualan"></canvas>
                        <script>
                            // mengambil total order setiap tipe hotel
                            <?php
                            $sql = "SELECT hotel.tipe, COUNT(orders.id) as jumlah_pesanan FROM orders RIGHT JOIN hotel ON hotel.id = orders.hotel_id GROUP BY hotel.id";
                            $result = mysqli_query($conn, $sql);
                            $labels = [];
                            $dataTotal = [];
                            while ($data = mysqli_fetch_array($result)){
                                $labels[] = $data['tipe'];
                                $dataTotal[] = $data['jumlah_pesanan'];
                            }?>

                            //memasang data ke chartjs untuk menampilkan piechart
                            var ctx = document.getElementById('total_penjualan').getContext('2d');
                            var data = {
                                labels: <?=json_encode($labels)?>,
                                datasets: [{
                                    label: 'Total Penjualan',
                                    backgroundColor: [
                                        'red',
                                        'blue',
                                        'yellow',
                                        'green',
                                        'purple',
                                        'orange'
                                    ],
                                    data: <?=json_encode($dataTotal)?>
                                }]
                            };
                            var myPieChart = new Chart(ctx, {
                                type: 'pie',
                                data: data,
                            });
                        </script>
                    </div>
                    <div class="col-4"></div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>