<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - Pilih Paket</title>
    <!-- Link ke Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <header class="text-center mb-4">
            <h1>Selamat Datang di Progresio</h1>
            <p>Pilih paket yang sesuai dengan kebutuhan Anda.</p>
        </header>

        <!-- Bagian Paket -->
        <section>
            <h2 class="text-center mb-4">Pilih Paket Anda</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <!-- Paket A -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Paket A</h5>
                            <p><strong>Token:</strong> 10 token/minggu</p>
                            <p><strong>Harga:</strong> Rp 0</p>
                            <p><strong>Deskripsi:</strong> Paket gratis untuk penggunaan dasar.</p>
                            <button class="btn btn-primary" onclick="alert('Pilih Paket A')">Pilih Paket</button>
                        </div>
                    </div>
                </div>

                <!-- Paket B -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Paket B</h5>
                            <p><strong>Token:</strong> 1000 token/minggu</p>
                            <p><strong>Harga:</strong> Rp 20.000</p>
                            <p><strong>Deskripsi:</strong> Paket untuk kebutuhan yang lebih intensif dengan lebih banyak token.</p>
                            <button class="btn btn-primary" onclick="alert('Pilih Paket B')">Pilih Paket</button>
                        </div>
                    </div>
                </div>

                <!-- Paket C -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Paket C</h5>
                            <p><strong>Token:</strong> 10.000 token/minggu</p>
                            <p><strong>Harga:</strong> Rp 150.000</p>
                            <p><strong>Deskripsi:</strong> Paket premium untuk kebutuhan lebih tinggi dengan token lebih banyak.</p>
                            <button class="btn btn-primary" onclick="alert('Pilih Paket C')">Pilih Paket</button>
                        </div>
                    </div>
                </div>

                <!-- Paket Dedicated -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Paket Dedicated</h5>
                            <p><strong>Token:</strong> Nolimit (Sesuaikan dengan kebutuhan)</p>
                            <p><strong>Harga:</strong> Sesuai kesepakatan</p>
                            <p><strong>Deskripsi:</strong> Paket dengan nomor pribadi atau pilihan dedicated untuk pengguna dengan kebutuhan khusus.</p>
                            <button class="btn btn-primary" onclick="alert('Pilih Paket Dedicated')">Pilih Paket</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Link ke Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
