<div id="purchaseContainer">
    <div class="container mt-5">
        <!-- Bagian Paket -->
        <section>
            <h2 class="text-center mb-4">Pilih Paket Anda</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
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
                            <p><strong>Token:</strong> 100 token/minggu</p>
                            <p><strong>Harga:</strong> Rp 50.000</p>
                            <p><strong>Deskripsi:</strong> Paket untuk kebutuhan yang lebih intensif dengan lebih banyak token.</p>
                            <button class="btn btn-primary" onclick="showPurchaseForm('Paket B - Hit Api Token Sebanyaak 100 Kali', 50000, 1)">Pilih Paket</button>
                        </div>
                    </div>
                </div>

                <!-- Paket C -->
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Paket C</h5>
                            <p><strong>Token:</strong> 1000 token/minggu</p>
                            <p><strong>Harga:</strong> Rp 150.000</p>
                            <p><strong>Deskripsi:</strong> Paket premium untuk kebutuhan lebih tinggi dengan token lebih banyak.</p>
                            <button class="btn btn-primary" onclick="showPurchaseForm('Paket C - Hit Api Token Sebanyaak 100 Kali ', 150000, 1)">Pilih Paket</button>
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
<script>
    function showPurchaseForm(product, price, quantity) {
        if (product === 'Paket A') {
            window.location.href = '{{ route('register') }}';
            return;
        }

        if (product === 'Paket Dedicated') {
            const waUrl = 'https://wa.me/6282111424592?text=' + encodeURIComponent('Saya hendak membeli paket dedicated wa blass');
            window.location.href = waUrl;
            return;
        }

        const formHtml = `
            <div class='text-center'>
                <h1>Welcome to Our Service</h1>
                <p>Fill in your details and click the button below to proceed with the payment.</p>
                <form method='POST' action='{{ route('ipaymu.purchase') }}'>
                    {{ csrf_field() }}
                    <input type='hidden' name='product' value='` + product + `'>
                    <input type='hidden' name='price' value='` + price + `'>
                    <input type='hidden' name='quantity' value='` + quantity + `'>
                    <div class='mb-3'>
                        <label for='buyerName' class='form-label'>Name:</label>
                        <input type='text' id='buyerName' name='buyerName' class='form-control' required>
                    </div>
                    <div class='mb-3'>
                        <label for='buyerEmail' class='form-label'>Email:</label>
                        <input type='email' id='buyerEmail' name='buyerEmail' class='form-control' required>
                    </div>
                    <div class='mb-3'>
                        <label for='buyerPhone' class='form-label'>Phone Number:</label>
                        <input type='text' id='buyerPhone' name='buyerPhone' class='form-control' required>
                    </div>
                    <button type='submit' class='btn btn-primary'>Proceed to Payment</button>
                </form>
            </div>
        `;
        document.getElementById('purchaseContainer').innerHTML = formHtml;
    }
</script>
