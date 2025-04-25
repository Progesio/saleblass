<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - Pilih Paket</title>
    <!-- Link ke Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function showPurchaseForm(product, price, quantity) {
            const formHtml = `
                <div class='text-center'>
                    <h1>Welcome to Our Service</h1>
                    <p>Click the button below to proceed with the payment.</p>
                    <form method='POST' action='{{ route('ipaymu.purchase') }}'>
                        {{ csrf_field() }}
                        <input type='hidden' name='product' value='` + product + `'>
                        <input type='hidden' name='price' value='` + price + `'>
                        <input type='hidden' name='quantity' value='` + quantity + `'>
                        <button type='submit' class='btn btn-primary'>Proceed to Payment</button>
                    </form>
                </div>
            `;
            document.getElementById('purchaseContainer').innerHTML = formHtml;
        }
    </script>
</head>
<body class="container mt-5">
    <div id="purchaseContainer">
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
                                <button class="btn btn-primary" onclick="showPurchaseForm('Paket A', 0, 1)">Pilih Paket</button>
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
                                <button class="btn btn-primary" onclick="showPurchaseForm('Paket B', 20000, 1)">Pilih Paket</button>
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
                                <button class="btn btn-primary" onclick="showPurchaseForm('Paket C', 150000, 1)">Pilih Paket</button>
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
                                <button class="btn btn-primary" onclick="showPurchaseForm('Paket Dedicated', 0, 1)">Pilih Paket</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- Link ke Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
