<?php
require_once 'connection.php';
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
                        <h2 class="fw-semibold text-center mb-5">FORM PEMESANAN</h2>
                        <?php
                        //kalau menekan tombol submit
                        if (isset($_POST["submit"])) :
                            //simpan ke database order
                            $sql = "INSERT INTO orders VALUES (
											null,
                                            '" . $_POST["nama"] . "',
                                            '" . $_POST["jenis_kelamin"] . "',
                                            '" . $_POST["nomor_identitas"] . "',
                                            " . $_POST["tipe_kamar"] . ",
                                            '" . $_POST["tanggal_pesan"] . "',
                                            '" . $_POST["durasi_menginap"] . "',
											" . ($_POST["breakfast"] ?? 0) . ")";
                            if (mysqli_query($conn, $sql)) :
                                //kalau berhasil, pergi ke hasil-pesan-kamar
                                $last_insert_id = mysqli_insert_id($conn);
                                header("Location: hasil-pesan-kamar.php?id=$last_insert_id");
                            else : 
                                //kalau gagal, tampilkan pesan gagal
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    Gagal memesan kamar
                                </div>
                        <?php endif;
                        endif;
                        ?>
                        <form method="POST">
                            <div class="row mb-3">
                                <label for="nama" class="col-md-3 col-form-label">Nama</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-form-label me-2">Jenis Kelamin</label>
                                <div class="form-check col-md-2 d-flex align-items-center">
                                    <input class="form-check-input me-2" type="radio" name="jenis_kelamin" id="laki" value="Laki-laki" checked>
                                    <label class="form-check-label" for="laki">
                                        Laki-laki
                                    </label>
                                </div>
                                <div class="form-check col-md-2 d-flex align-items-center">
                                    <input class="form-check-input me-2" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan">
                                    <label class="form-check-label" for="perempuan">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nomor_identitas" class="col-md-3 col-form-label">Nomor Identitas</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="nomor_identitas" name="nomor_identitas" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tipe_kamar" class="col-md-3 col-form-label">Tipe Kamar</label>
                                <div class="col-md-9">
                                    <select class="form-select" id="tipe_kamar" name="tipe_kamar" required onchange="getHarga()">
                                        <?php
                                        $hotels = [];
                                        $sql = "SELECT * FROM hotel";
                                        $result = mysqli_query($conn, $sql);
                                        while ($data = mysqli_fetch_array($result)) : ?>
                                            <option value="<?= $data['id'] ?>"><?= $data['tipe'] ?></option>
                                        <?php
                                            $hotels[$data['id']] = $data['harga'];
                                        endwhile
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="harga" class="col-md-3 col-form-label">Harga</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="harga" name="harga" required disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tanggal_pesan" class="col-md-3 col-form-label">Tanggal Pesan</label>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" id="tanggal_pesan" name="tanggal_pesan" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="durasi_menginap" class="col-md-3 col-form-label">Durasi Menginap</label>
                                <div class="col-md-7">
                                    <input type="number" class="form-control" id="durasi_menginap" name="durasi_menginap" required min="1" value="1">
                                </div>
                                <label class="col-md-2 col-form-label">Hari</label>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-3 col-form-label me-2">Termasuk Breakfast</label>
                                <div class="form-check col-md-6 d-flex align-items-center">
                                    <input class="form-check-input me-2" type="checkbox" name="breakfast" id="breakfast" value="1">
                                    <label class="form-check-label" for="breakfast">
                                        Ya
                                    </label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="total_bayar" class="col-md-3 col-form-label">Total Bayar</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="total_bayar" name="total_bayar" required disabled>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" onclick="getTotal()">Hitung Total</button>
                                <button type="submit" value="submit" name="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-danger">Cancel</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>

    </div>
    <script>
        const hotels = <?= json_encode($hotels) ?>;
        const tipeKamar = document.getElementById("tipe_kamar");
        const breakfast = document.getElementById("breakfast");
        const durasiMenginap = document.getElementById("durasi_menginap");
        const harga = document.getElementById("harga");
        const total = document.getElementById("total_bayar");

        function getHarga() {
            harga.value = hotels[tipeKamar.value];
        }

        function getTotal() {
            total.value = (durasiMenginap.value>=3?0.9:1)*((harga.value * durasiMenginap.value) + (breakfast.checked ? 80000 : 0));
        }

        getHarga();
    </script>
</body>

</html>